<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Banner Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA,Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Banner_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized',
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'file'
        ));
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_title = $this->input->get('search_title');
        
        if (isset($search_title)) {
            $search_conditions['search_title'] = $search_title;
            $this->_pdata['search_title'] = $search_title;
        } else {
            $search_conditions['search_title'] = null;
            $this->_pdata['search_title'] = null;
        }
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->load->model('__admin_settings/Banner_mdl');
        $this->_pdata['banners'] = $this->Banner_mdl->get_banners($search_conditions, $start, $limit);
        $this->_pdata['total_banners'] = $this->Banner_mdl->get_total_banners($search_conditions);
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/settings/banner', $this->_pdata['total_banners'], $limit);
        
        $this->_pdata['optimized'] = $this->optimized;
        $this->template_lib->load_view($this, '__admin_settings/Banner_list_view', $this->_pdata);
    }
    
    public function file_check($str) {
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['upload_image']['name']);
        
        if(isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] != "") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    public function private_file_size() {
        if ($_FILES['upload_image']['error'] == 1 || $_FILES['upload_image']['size'] >= 3000000) {
            $this->form_validation->set_message('private_file_size', 'Please Upload Image Less Than 3MB.');
            return false;
        }
    }
    
    public function add() {
        $this->load->model('__admin_settings/Banner_mdl');
        
            if($this->input->post()) {
                 $this->form_validation->set_rules('category', 'Category', 'required', array(
                    'required' => 'Please Select Category'
                 ));
                $this->form_validation->set_rules('section', 'Section', 'required', array(
                    'required' => 'Please Select Section'
                ));
                $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[255]', array(
                    'required' => 'Title Name required.',
                    'min_length' => 'Title should have minimum 3 characters.',
                    'max_length' => 'Title Name cannot more than 255 characters.',
                ));
                $this->form_validation->set_rules('alt', 'Alternative Title ', 'trim|max_length[255]', array(
                    'max_length'=>'Meta Title cannot more than 255 characters.'
                ));
                $this->form_validation->set_rules('upload_image', '', 'callback_private_file_size|callback_file_check');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_error', TRUE);
                } else {
                        $image_path = 'content/image/main/banner/';
                        $config['upload_path']          = './' . $image_path;
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';
                        $config['file_name']            = 'banner_img_' . time();
                        
                        $this->load->library('upload', $config);
                        
                        if (! $this->upload->do_upload('upload_image')) {
                            $error = array('error' => $this->upload->display_errors());
                        } else {
                            $data = $this->upload->data();
                            $filename = $data['file_name'];
                        }
                        $post_data = [
                            'category' => $this->input->post('category'),
                            'section' => $this->input->post('section'),
                            'title' => $this->input->post('title'),
                            'alt' => $this->input->post('alt')
                        ];
                        if($this->input->post('status')) {
                            $post_data['status'] = $this->input->post('status');
                        }
                        if(isset($filename)) {
                            $post_data['image'] = $image_path . $filename;
                        }
                        $this->Banner_mdl->add_banner($post_data);
                        redirect('admin/settings/banner');
                 }
            }
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->template_lib->load_view($this, '__admin_settings/Banner_add_view', $this->_pdata);
    }
    
    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $banner_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_settings/Banner_mdl');
        
        if($this->input->post()) {
            
            $this->form_validation->set_rules('category', 'Category', 'required', array(
                'required' => 'Please Select Category'
            ));
            $this->form_validation->set_rules('section', 'Section', 'required', array(
                'required' => 'Please Select Section'
            ));
            $this->form_validation->set_rules('title', 'Title', 'trim|required|min_length[3]|max_length[255]', array(
                'required' => 'Title Name required.',
                'min_length' => 'Title should have minimum 3 characters.',
                'max_length' => 'Title Name cannot more than 255 characters.',
            ));
            $this->form_validation->set_rules('alt', 'Alternative Title ', 'trim|max_length[255]', array(
                'max_length'=>'Meta Title cannot more than 255 characters.'
            ));
            
            if(isset($_FILES['upload_image'])) {
                $this->form_validation->set_rules('upload_image', '', 'callback_private_file_size');
            }
            
            if(empty($_FILES['upload_image']['name']) && $this->input->post('upload_image')) {
                $this->form_validation->set_rules('upload_image', '', 'callback_file_check');
            }
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                    $image_path = 'content/image/main/banner/';
                    $config['upload_path']          = './' . $image_path;
                    $config['allowed_types']        = 'gif|jpg|png|jpeg';
                    $config['file_name']            = 'banner_img_' . time();
                    
                    $this->load->library('upload', $config);
                    
                    if (! $this->upload->do_upload('upload_image')) {
                        $error = array('error' => $this->upload->display_errors());
                    } else {
                        $data = $this->upload->data();
                        $filename = $data['file_name'];
                    }
                    $post_data = [
                        'image' => $this->input->post('upload_image_check'),
                        'category' => $this->input->post('category'),
                        'section' => $this->input->post('section'),
                        'title' => $this->input->post('title'),
                        'alt' => $this->input->post('alt')
                    ];
                    if($this->input->post('status')) {
                        $post_data['status'] = $this->input->post('status');
                    }
                    if(isset($filename)) {
                        $post_data['image'] = $image_path . $filename;
                    }
                    $this->Banner_mdl->update_banner($post_data, $banner_id);
                    redirect('admin/settings/banner');
        }
      }
        $this->_pdata['banner'] = $this->Banner_mdl->get_banner($banner_id);
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->template_lib->load_view($this, '__admin_settings/Banner_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $banner_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_settings/Banner_mdl');
        $this->Banner_mdl->delete_banner($banner_id);
        redirect('admin/settings/banner');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $banner_id = $this->security_lib->decrypt($secure_token);
        
        if($banner_id) {
            $this->load->model('__admin_settings/Banner_mdl');
            $this->Banner_mdl->change_banner_status($banner_id, $this->input->get('change_status'));
            
            redirect('admin/settings/banner');
        }
    }
}