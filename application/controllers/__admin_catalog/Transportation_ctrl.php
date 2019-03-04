<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: TRANSPORTATION CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA,Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Transportation_ctrl extends CI_Controller {
    
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
            '__commonlib/Optimized'
        ));
        
        $this->load->helper(array(
            'form', 
            'date', 
            'dt',
            'file'
        ));
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_title = $this->input->get('search_title');
        
        if (isset($search_title)) {
            $search_conditions['search_title'] = trim($search_title);
            $this->_pdata['search_title'] = trim($search_title);
        } else {
            $search_conditions['search_title'] = null;
            $this->_pdata['search_title'] = null;
        }
        
        $search_park = $this->input->get('search_park');
        
        if (isset($search_park)) {
            $search_conditions['search_park'] = trim($search_park);
            $this->_pdata['search_park'] = trim($search_park);
        } else {
            $search_conditions['search_park'] = null;
            $this->_pdata['search_park'] = null;
        }
        
        $search_private_price_per_passenger = $this->input->get('search_private_price_per_passenger');
        
        if (isset($search_private_price_per_passenger)) {
            $search_conditions['search_private_price_per_passenger'] = trim($search_private_price_per_passenger);
            $this->_pdata['search_private_price_per_passenger'] = trim($search_private_price_per_passenger);
        } else {
            $search_conditions['search_private_price_per_passenger'] = null;
            $this->_pdata['search_private_price_per_passenger'] = null;
        }
        
        $search_shared_price_per_passenger = $this->input->get('search_shared_price_per_passenger');
        
        if (isset($search_shared_price_per_passenger)) {
            $search_conditions['search_shared_price_per_passenger'] = trim($search_shared_price_per_passenger);
            $this->_pdata['search_shared_price_per_passenger'] = trim($search_shared_price_per_passenger);
        } else {
            $search_conditions['search_shared_price_per_passenger'] = null;
            $this->_pdata['search_shared_price_per_passenger'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->_pdata['transportations'] = array();
        
        $this->load->model('__admin_catalog/Transportation_mdl');
        $this->_pdata['transportations'] = $this->Transportation_mdl->get_transportations($search_conditions, $start, $limit);
        $this->_pdata['total_transportations'] = $this->Transportation_mdl->get_total_transportations($search_conditions);
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/catalog/transportation', $this->_pdata['total_transportations'], $limit);
        
        $this->template_lib->load_view($this, '__admin_catalog/Transportation_list_view', $this->_pdata);
    }
    
    public function private_file_size() {
        if ($_FILES['private_vehical_image']['error'] == 1 || $_FILES['private_vehical_image']['size'] >= TV_MAX_IMG_UPLOAD_SIZE) {
            $this->form_validation->set_message('private_file_size', 'Please Upload Image Less Than '.TV_MAX_IMG_UPLOAD_SIZE_TEXT);
            return false;
        }
    }
    
    public function shared_file_size() {
        if ($_FILES['shared_vehical_image']['error'] == 1 || $_FILES['shared_vehical_image']['size'] >= TV_MAX_IMG_UPLOAD_SIZE) {
            $this->form_validation->set_message('shared_file_size', 'Please Upload Image Less Than '.TV_MAX_IMG_UPLOAD_SIZE_TEXT);
            return false;
        }
    }
    
    public function file_private_check($str) {
        
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['private_vehical_image']['name']);
        
        if(isset($_FILES['private_vehical_image']['name']) && $_FILES['private_vehical_image']['name'] != "") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_private_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_private_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    public function file_shared_check($str) {
        if ($_FILES['shared_vehical_image']['size'] >= TV_MAX_IMG_UPLOAD_SIZE) {
            $this->form_validation->set_message('file_shared_check', 'Please Upload Image Less Than '.TV_MAX_IMG_UPLOAD_SIZE_TEXT);
            return false;
        }
        
        $allowed_mime_type_arr = array('image/gif','image/jpeg','image/pjpeg','image/png','image/x-png');
        $mime = get_mime_by_extension($_FILES['shared_vehical_image']['name']);
        
        if(isset($_FILES['shared_vehical_image']['name']) && $_FILES['shared_vehical_image']['name'] != "") {
            if(in_array($mime, $allowed_mime_type_arr)) {
                return true;
            } else {
                $this->form_validation->set_message('file_shared_check', 'Please select only gif/jpg/png file.');
                return false;
            }
        } else {
            $this->form_validation->set_message('file_shared_check', 'Please choose a file to upload.');
            return false;
        }
    }
    
    public function add() {
        
        if ($this->input->post()) {
            
               $this->form_validation->set_rules('from_location_id', 'Location', 'required', array(
                   'required' => ' Please Select Location'
                   ));
               $this->form_validation->set_rules('to_location_id', 'Location', 'required', array(
                   'required' => ' Please Select Location'
                   ));
               $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                    'required' => ' Please Select Country'
                     ));
               $this->form_validation->set_rules('city_id', 'city', 'required', array(
                    'required' => ' Please Select City'
                ));
               $this->form_validation->set_rules('agent_id', 'Park', 'required', array(
                    'required' => ' Please Select Park'
                ));
               $this->form_validation->set_rules('private_cost_per_passenger', 'Private Cost Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Private Cost Per Passenger is Required.',
                        'max_length' => 'Priavte Price Per Passenger cannot more than 19 characters.'
                    ));
               $this->form_validation->set_rules('shared_cost_per_passenger', 'Shared Cost Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Shared Cost Per Passenger is Required.',
                        'max_length' => 'Shared Cost Per Passenger cannot more than 19 characters.'
                        
                    ));
               $this->form_validation->set_rules('private_price_per_passenger', 'Priavte Price Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Priavte Price Per Passenger is Required.',
                        'max_length' => 'Priavte Price Per Passenger cannot more than 19 characters.'
                    ));
               $this->form_validation->set_rules('shared_price_per_passenger', 'Shared Deal Price Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Shared Deal Price  Per Passenger is Required.',
                        'max_length' => 'Shared Deal Price Per Passengercannot more than 19 characters.'
                    ));
               $this->form_validation->set_rules('private_deal_price_per_passenger', 'Private Deal Price Per Passenger', 'trim|max_length[19]',
                    array(
                        'max_length' => 'Private Deal Price Per Passenger cannot more than 19 characters.'
                    ));
               $this->form_validation->set_rules('shared_deal_price_per_passenger', 'Shared Deal Price Per Passenger', 'trim|max_length[19]',
                    array(
                        'max_length' => 'Private Deal Price Per Passenger cannot more than 19 characters.'
                    ));
               $this->form_validation->set_rules('details[en][shared_title]', 'Title', 'trim|required|min_length[3]|max_length[255]',
                    array(
                        'required' => 'Shared Vehical Title required for English atleast.',
                        'min_length' => 'Title should have minimum 3 characters.',
                        'max_length' => 'Title Name cannot more than 255 characters.',
                    ));
               $this->form_validation->set_rules('details[en][private_title]', 'Title', 'trim|required',
                    array(
                        'required' => 'Private Vehical Title required for English atleast.',
                        'min_length' => 'Title should have minimum 3 characters.',
                        'max_length' => 'Title Name cannot more than 255 characters.',
                    ));
               $this->form_validation->set_rules('private_vehical_image', '', 'callback_private_file_size|callback_file_private_check');
               $this->form_validation->set_rules('shared_vehical_image', '', 'callback_shared_file_size|callback_file_shared_check');
                
                   if ($this->form_validation->run() == FALSE) {
                        $this->session->set_flashdata('validation_error', TRUE);
                   } else {
                            $image_path = 'content/image/main/transportation/';
                            $config['upload_path']          = './' . $image_path;
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';
                            $config['file_name']            = 'private_img_' . time();
                            $this->load->library('upload', $config);
                            
                            if (! $this->upload->do_upload('private_vehical_image')) {
                                $error = array('error' => $this->upload->display_errors());
                            } else {
                                $data = $this->upload->data();
                                $private_vehical_image = $image_path . $data['file_name'];
                            }
                            
                            $image_path = 'content/image/main/transportation/';
                            
                            $config['upload_path']          = './' . $image_path;
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';
                            $config['file_name']            = 'shared_img_' . time();
                            
                            $this->load->library('upload', $config);
                            
                            if (! $this->upload->do_upload('shared_vehical_image')) {
                                $error = array('error' => $this->upload->display_errors());
                            } else {
                                $data = $this->upload->data();
                                $shared_vehical_image = $image_path . $data['file_name'];
                            }
                            
                            $post_data = $this->input->post();
                            
                            $post_data['private_image'] = isset($private_vehical_image) && strlen($private_vehical_image) > 0 ? $private_vehical_image : '';
                            $post_data['shared_image'] = isset($shared_vehical_image) && strlen($shared_vehical_image) > 0 ? $shared_vehical_image : '';
                            
                            $this->load->model('__admin_catalog/Transportation_mdl');
                            $this->Transportation_mdl->add_transportation($post_data);
                            redirect('admin/catalog/transportation');
                      }
        }
        $this->load->model('__admin_settings/Utility_mdl');
        $countries = $this->Utility_mdl->get_countries();
        
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $cities = $this->Utility_mdl->get_cities();
        $this->_pdata['cities'][''] = '--- Please Select City ---';
        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }
        
        $locations = $this->Utility_mdl->get_locations();
        $this->_pdata['locations'][''] = '--- Please Select Location ---';
        foreach ($locations as $location) {
            $this->_pdata['locations'][$location['id']] = $location['name'];
        }
        
        $agents = $this->Utility_mdl->get_agents();
        $this->_pdata['agents'][''] = '--- Please Select Park ---';
        foreach ($agents as $agent) {
            $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
        }
        
        $this->_pdata['languages'] = $this->Utility_mdl->get_languages();
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->template_lib->load_view($this, '__admin_catalog/Transportation_add_view', $this->_pdata);
    }
    
    public function edit() {
        
        $secure_token = $this->input->get('secure_token');
        $transportation_id = $this->security_lib->decrypt($secure_token);
        $this->load->model('__admin_catalog/Transportation_mdl');
        
        if ($this->input->post()) {
            
                $this->form_validation->set_rules('from_location_id', 'Location', 'required', array(
                    'required' => ' Please Select Location'
                ));
                $this->form_validation->set_rules('to_location_id', 'Location', 'required', array(
                    'required' => ' Please Select Location'
                ));
                $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                    'required' => ' Please Select Country'
                ));
                $this->form_validation->set_rules('city_id', 'city', 'required', array(
                    'required' => ' Please Select City'
                ));
                $this->form_validation->set_rules('agent_id', 'Park', 'required', array(
                    'required' => ' Please Select Park'
                ));
                $this->form_validation->set_rules('private_cost_per_passenger', 'Private Cost Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Private Cost Per Passenger is Required.',
                        'max_length' => 'Priavte Price Per Passenger cannot more than 19 characters.'
                    ));
                $this->form_validation->set_rules('shared_cost_per_passenger', 'Shared Cost Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Shared Cost Per Passenger is Required.',
                        'max_length' => 'Shared Cost Per Passenger cannot more than 19 characters.'
                        
                    ));
                $this->form_validation->set_rules('private_price_per_passenger', 'Priavte Price Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Priavte Price Per Passenger is Required.',
                        'max_length' => 'Priavte Price Per Passenger cannot more than 19 characters.'
                    ));
                $this->form_validation->set_rules('shared_price_per_passenger', 'Shared Deal Price Per Passenger', 'trim|required|max_length[19]',
                    array(
                        'required' => 'Shared Deal Price  Per Passenger is Required.',
                        'max_length' => 'Shared Deal Price Per Passengercannot more than 19 characters.'
                    ));
                $this->form_validation->set_rules('private_deal_price_per_passenger', 'Private Deal Price Per Passenger', 'trim|max_length[19]',
                    array(
                        'max_length' => 'Private Deal Price Per Passenger cannot more than 19 characters.'
                    ));
                $this->form_validation->set_rules('shared_deal_price_per_passenger', 'Shared Deal Price Per Passenger', 'trim|max_length[19]',
                    array(
                        'max_length' => 'Private Deal Price Per Passenger cannot more than 19 characters.'
                    ));
                $this->form_validation->set_rules('details[en][shared_title]', 'Title', 'trim|required|min_length[3]|max_length[255]',
                    array(
                        'required' => 'Shared Vehical Title required for English atleast.',
                        'min_length' => 'Title should have minimum 3 characters.',
                        'max_length' => 'Title Name cannot more than 255 characters.',
                    ));
                $this->form_validation->set_rules('details[en][private_title]', 'Title', 'trim|required',
                    array(
                        'required' => 'Private Vehical Title required for English atleast.',
                        'min_length' => 'Title should have minimum 3 characters.',
                        'max_length' => 'Title Name cannot more than 255 characters.',
                    ));
                $this->form_validation->set_rules('private_vehical_image', '', 'callback_private_file_size');
                $this->form_validation->set_rules('shared_vehical_image', '', 'callback_shared_file_size');
                
                    if(empty($_FILES['private_vehical_image']['name']) && !$this->input->post('private_vehical_image_check')) {
                        $this->form_validation->set_rules('private_vehical_image', '', 'callback_file_private_check');
                    }
                    if(empty($_FILES['shared_vehical_image']['name']) && !$this->input->post('shared_vehical_image_check')) { 
                        $this->form_validation->set_rules('shared_vehical_image', '', 'callback_file_shared_check');
                    }
                    if ($this->form_validation->run() == FALSE) {
                        $this->session->set_flashdata('validation_error', TRUE);
                    } else {
                            $image_path = 'content/image/main/transportation/';
                            
                            $config['upload_path']          = './' . $image_path;
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';
                            $config['file_name']            = 'private_img_' . time();
                            
                            $this->load->library('upload', $config);
                            
                            if (! $this->upload->do_upload('private_vehical_image')) {
                                $error = array('error' => $this->upload->display_errors());
                            } else {
                                    $data = $this->upload->data();
                                    
                                    if(isset($data['file_name'])) {
                                        $private_vehical_image = $image_path . $data['file_name'];
                                    }
                            }
                            
                            $image_path = 'content/image/main/transportation/';
                            
                            $config['upload_path']          = './' . $image_path;
                            $config['allowed_types']        = 'gif|jpg|png|jpeg';
                            $config['file_name']            = 'shared_img_' . time();
                            
                            $this->load->library('upload', $config);
                            
                            if (! $this->upload->do_upload('shared_vehical_image')) {
                                $error = array('error' => $this->upload->display_errors());
                            } else {
                                    $data = $this->upload->data();
                                    
                                    if(isset($data['file_name'])) {
                                        $shared_vehical_image = $image_path . $data['file_name'];
                                    }
                        }
                        
                        $post_data = [
                            'from_location_id' => $this->input->post('from_location_id'),
                            'to_location_id' => $this->input->post('to_location_id'),
                            'country_id' => $this->input->post('country_id'),
                            'city_id' => $this->input->post('city_id'),
                            'agent_id' => $this->input->post('agent_id'),
                            'private_cost_per_passenger' => $this->input->post('private_cost_per_passenger'),
                            'shared_cost_per_passenger' => $this->input->post('shared_cost_per_passenger'),
                            'private_price_per_passenger' => $this->input->post('private_price_per_passenger'),
                            'shared_price_per_passenger' => $this->input->post('shared_price_per_passenger'),
                            'private_deal_price_per_passenger' => $this->input->post('private_deal_price_per_passenger'),
                            'shared_deal_price_per_passenger' => $this->input->post('shared_deal_price_per_passenger'),
                            'details' => $this->input->post('details'),
                            'block_transport_dates' => $this->input->post('block_transport_dates')
                        ];
                        
                        if(isset($private_vehical_image)) {
                            $post_data['private_image'] = $private_vehical_image;
                        }
                        if(isset($shared_vehical_image)) {
                            $post_data['shared_image'] = $shared_vehical_image;
                        }                
                        if($this->input->post('status')) {
                            $data['status'] = $this->input->post('status');
                        }
                        $this->Transportation_mdl->update_transportation($post_data, $transportation_id);
                        
                        $this->session->set_flashdata('updated_successfully', TRUE);
                        redirect('admin/catalog/transportation');
                    }
        }
        
        $this->_pdata['transportation'] = $this->Transportation_mdl->get_transportation($transportation_id);
        $transportation_details = $this->Transportation_mdl->get_transportation_details_by_transportation_id($transportation_id);
        
        foreach ($transportation_details as $transportation_detail) {
            $this->_pdata['transportation_details'][$transportation_detail['language_code']] = $transportation_detail;
        }
        
        $this->load->model('__admin_settings/Utility_mdl');
        
        $countries = $this->Utility_mdl->get_countries();
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $cities = $this->Utility_mdl->get_cities_by_country_id($this->_pdata['transportation']['country_id']);
        $this->_pdata['cities'][''] = '--- Please Select City ---';
        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }
        
        $agents = $this->Utility_mdl->get_agents();
        $this->_pdata['agents'][''] = '--- Please Select Park ---';
        foreach ($agents as $agent) {
            $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
        }
        
        $locations = $this->Utility_mdl->get_locations();
        $this->_pdata['locations'][''] = '--- Please Select Location ---';
        foreach ($locations as $location) {
            $this->_pdata['locations'][$location['id']] = $location['name'];
        }
        
        $blockdates = $this->Transportation_mdl->get_block_dates($transportation_id);
        $this->_pdata['blocked_dates'] = '';
        foreach ($blockdates as $blockdate) {
            $this->_pdata['blocked_dates'] .=  d_to_lu($blockdate['block_date']) . ",";
        }
        
        $this->_pdata['languages'] = $this->Utility_mdl->get_languages();
        
        $this->_pdata['optimized'] = $this->optimized;
        
        $this->template_lib->load_view($this, '__admin_catalog/Transportation_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $transportation_id = $this->security_lib->decrypt($secure_token);
        $this->load->model('__admin_catalog/Transportation_mdl');
        $this->Transportation_mdl->delete_transportation($transportation_id);
        
        redirect('admin/catalog/Transportation/index');
    }
    
    public function get_cities_by_country_id() {
        $country_id = $this->input->get('country_id');
        
        $this->load->model('__admin_settings/Utility_mdl');
        $data['cities'] = $this->Utility_mdl->get_cities_by_country_id($country_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
    
}
