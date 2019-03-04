<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Manage Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Manage_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            'form_validation',
            '__prjvendorlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized'
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'file'
        ));
        
        if (!$this->session->has_userdata('vendor')) {
            redirect('vendor/account/login');
        }
    }
    
    public function company_file_size() {
        if ($_FILES['company_logo_image']['error'] == 1 || $_FILES['company_logo_image']['size'] >= 3000000) {
            $this->form_validation->set_message('company_file_size', 'Please Upload Image Less Than 3MB.');
            return false;
        }
    }
    
    public function admin_file_size() {
        if ($_FILES['admin_image_image']['error'] == 1 || $_FILES['admin_image_image']['size'] >= 3000000) {
            $this->form_validation->set_message('admin_file_size', 'Please Upload Image Less Than 3MB.');
            return false;
        }
    }
    
    public function file_company_check($str) {
        
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['company_logo_image']['name']);
        
        if(isset($_FILES['company_logo_image']['name']) && $_FILES['company_logo_image']['name'] != "") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_company_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_company_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    public function file_admin_check($str) {
        if ($_FILES['admin_image_image']['size'] >= 3000000) {
            $this->form_validation->set_message('file_admin_check', 'Please Upload Image Less Than 3MB.');
            return false;
        }
        
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['admin_image_image']['name']);
        
        if(isset($_FILES['admin_image_image']['name']) && $_FILES['admin_image_image']['name'] != "") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_admin_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_admin_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    public function index() {
        $vendor = $this->session->userdata('vendor');
        
        $this->load->model('__vendor_account/Manage_mdl');
        $this->_pdata['vendor'] = $this->Manage_mdl->get_account_details($vendor['id']);
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->template_lib->load_view($this, '__vendor_account/Manage_view', $this->_pdata);
    }
    
    public function edit() {
        
        $secure_token = $this->input->get('secure_token');
        $vendor_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__vendor_account/Manage_mdl');
        
        if($this->input->post()) {
         /* 
            $this->form_validation->set_rules(
                'company_legal_name', 
                'Company Legal Name', 
                'trim|required|max_length[255]', array(
                    'required' => 'Error: Company Legal Name is Required.',
                    'max_length' => 'Error: Company Legal Name cannot more than 255 characters.'
                )
            );
             */
            $this->form_validation->set_rules('email', 'Company Email', 'trim|required|max_length[255]', array(
                    'required' => 'Company Email is Required.',
                    'max_length' => 'Company Email cannot more than 255 characters.'
                )
            );
            
            $this->form_validation->set_rules('upload_image', '', 'callback_company_file_size');
            
            $this->form_validation->set_rules('company_logo_image', '', 'callback_company_file_size');
            $this->form_validation->set_rules('admin_image_image', '', 'callback_admin_file_size');
            
            if(empty($_FILES['company_logo_image']['name']) && !$this->input->post('company_logo_image_check')) {
                $this->form_validation->set_rules('company_logo_image', '', 'callback_file_company_check');
            }
            
            if(empty($_FILES['admin_image_image']['name']) && !$this->input->post('admin_image_image_check')) {
                $this->form_validation->set_rules('admin_image_image', '', 'callback_file_admin_check');
            }
            
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
            } else {
                
                $image_path = 'content/image/main/vendor/';
                
                $config['upload_path']          = './' . $image_path;
                $config['allowed_types']        = 'gif|jpg|png|jpeg';
                $config['file_name']            = 'company_logo_' . time();
                
                $this->load->library('upload', $config);
                
                if (! $this->upload->do_upload('company_logo_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = $this->upload->data();
                    
                    if(isset($data['file_name'])) {
                        $company_logo_image = $image_path . $data['file_name'];
                    }
                }
                
                $image_path = 'content/image/main/vendor/';
                
                $config1['upload_path']          = './' . $image_path;
                $config1['allowed_types']        = 'gif|jpg|png|jpeg';
                $config1['file_name']            = 'admin_img_' . time();
                
                $this->load->library('upload', $config1);
                
                if (! $this->upload->do_upload('admin_image_image')) {
                    $error = array('error' => $this->upload->display_errors());
                } else {
                    $data = $this->upload->data();
                    
                    if(isset($data['file_name'])) {
                        $admin_image_image = $image_path . $data['file_name'];
                    }
                }
                
                $post_data = [
                    /* 'company_legal_name' => $this->input->post('company_legal_name'), */
                    /* 'email' => $this->input->post('email'), */
                    'address' => $this->input->post('address'),
                    'city' => $this->input->post('city'),
                    'country' => $this->input->post('country'),
                    'state' => $this->input->post('state'),
                    'business_type' => $this->input->post('business_type'),
                    /* 'admin_email' => $this->input->post('admin_email'), */
                    'admin_password' => $this->input->post('admin_password'),
                    /* 'salt' => $this->input->post('salt'), */
                    /* 'access_token' => $this->input->post('access_token'), */
                    'admin_contact' => $this->input->post('admin_contact'),
                    'postal' => $this->input->post('admin_fullname'),
                    /* 'telephone' => $this->input->post('telephone'), */
                    'tax_id' => $this->input->post('tax_id'),
                    'payment_details' => $this->input->post('payment_details'),
                    'credit_debit_payal' => $this->input->post('credit_debit_payal'),
                    'card_number' => $this->input->post('card_number'),
                    'expiry_cvv' => $this->input->post('expiry_cvv'),
                   /*  'status' => $this->input->post('status'), */
                    /* 'approved' => $data['approved'], */
                    
                ];
                
                if(isset($company_logo_image)) {
                    $post_data['company_logo'] = $company_logo_image;
                }
                
                if(isset($admin_image_image)) {
                    $post_data['admin_image'] = $admin_image_image;
                }   
               
                
                $this->Manage_mdl->update_account_details($post_data, $vendor_id);
                
                redirect('vendor/account/manage');
            }
        }
        
        $this->_pdata['edit_permission'] = TRUE;
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->_pdata['vendor'] = $this->Manage_mdl->get_account_details($vendor_id);
        //pr($this->_pdata['vendor']);
        // VIEW FILE CALLED BELOW
        $this->template_lib->load_view($this, '__vendor_account/Manage_edit_view', $this->_pdata);
    }
}