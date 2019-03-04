<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: INFORMATION CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Information_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib', 
            '__commonlib/Optimized',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array('form','dt','file'));
        $this->lang->load('common', 'en');
    }
	
	public function index() {
        
        $search_conditions = array();
        
        $search_title_name = $this->input->get('search_title_name');
        
        if(isset($search_title_name)) {
            $search_conditions['search_title_name'] = trim($search_title_name);
            $this->_pdata['search_title_name'] =  trim($search_title_name);
        } else {
            $search_conditions['search_title_name'] = null;
            $this->_pdata['search_title_name'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if(!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->_pdata['informations'] = array();
        
        $this->load->model('__admin_catalog/Information_mdl');
       
        $this->_pdata['informations'] = $this->Information_mdl->get_informations($search_conditions, $start, $limit);	
      
        $this->_pdata['total_informations'] = $this->Information_mdl->get_total_informations($search_conditions); 			     
        $this->load->helper('paginator');
		$this->_pdata['pagination'] = generate_pagination($this, 'admin/catalog/information', $this->_pdata['total_informations'], $limit);
        $this->template_lib->load_view($this, '__admin_catalog/Information_list_view', $this->_pdata) ; 
    }
    
    public function check_unique_title() {
    	$this->db->select('*')
    	   ->from('tv_information_tbl')
    	       ->where('country_id', $this->input->post('country_id'))
    	           ->where('city_id', $this->input->post('city_id'));
    			
    	$query = $this->db->get();
    				
		if($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
    }
    
    public function check_unique_title_leave_current() {
        $cc = $this->input->post('current_city');
        $cy = $this->input->post('current_country');
        
        $ci = $this->input->post('city_id');
        $yi = $this->input->post('country_id');
        
        if($cc . '_' . $cy == $ci . '_' . $yi) {
            return true; // ALLOWED
        } else {
            $this->db->select('*')
                ->from('tv_information_tbl')
                    ->where('country_id', $this->input->post('country_id'))
                        ->where('city_id', $this->input->post('city_id'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false;
            } else {
                return true;
            }
        }
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
        if ($_FILES['upload_image']['error'] == 1 || $_FILES['upload_image']['size'] >= TV_MAX_IMG_UPLOAD_SIZE) {
            $this->form_validation->set_message('private_file_size', 'Please Upload Image Less Than'.TV_MAX_IMG_UPLOAD_SIZE_TEXT);
            return false;
        }
    }
  
    public function add() {	
        $this->load->model('__admin_catalog/Information_mdl');
        
            if($this->input->post()) {
                $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                   'required' => 'Please Select Country'
                ));
                $this->form_validation->set_rules('city_id', 'City', 'required', array(
                	'required' => 'Please Select City'
                ));
                $this->form_validation->set_rules('details[en][title]', 'Title', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_title', array(
                    'required' => 'Title Name required for English atleast.',
                    'min_length' => 'Title should have minimum 3 characters.',
                    'max_length' => 'Title Name cannot more than 255 characters.',
                	'check_unique_title' => 'For the same city and country information already exist.'
                ));
                $this->form_validation->set_rules('details[en][meta_title]', 'Meta Title', 'trim|max_length[255]', array(
                    'max_length'=>'Meta Title cannot more than 255 characters.'
                ));
                $this->form_validation->set_rules('details[en][meta_dsc]', 'Meta Description', 'trim|max_length[255]', array(
                    'max_length'=>'Meta Title cannot more than 255 characters.'
                ));
                $this->form_validation->set_rules('details[en][meta_keywords]', 'Meta Keyword', 'trim|max_length[255]', array(
                    'max_length'=>'Meta Keyword  not more than 255 characters.'
                ));	
                $this->form_validation->set_rules('upload_image', '', 'callback_private_file_size|callback_file_check');
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('validation_error', TRUE);
                } else {
                        $image_path = 'content/image/main/information/';
                        $config['upload_path']          = './' . $image_path;
                        $config['allowed_types']        = 'gif|jpg|png|jpeg';
                        $config['file_name']            = 'information_img_' . time();
                        
                        $this->load->library('upload', $config);
                        
                        if (! $this->upload->do_upload('upload_image')) {
                            $error = array('error' => $this->upload->display_errors());
                        } else {
                            $data = $this->upload->data();
                            $filename = $data['file_name'];
                        }
                       $data = [
                            'country_id' => $this->input->post('country_id'),
                            'city_id' => $this->input->post('city_id'),
                            'lattitude' => $this->input->post('lattitude'),
                            'longitude' => $this->input->post('longitude'),
                            'details' => $this->input->post('details')
                        ];
                        if($this->input->post('status')) {
                            $data['status'] = $this->input->post('status');
                        }
                        if(isset($filename)) {
                            $data['image'] = $image_path . $filename;
                            $this->_pdata['upload_image_path'] = $image_path . $filename;
                        }
                        $this->Information_mdl->add_information($data);
                        $this->session->set_flashdata('added_successfully', TRUE);
                        redirect('admin/catalog/information/index');
                }
    		}
		
		$this->load->model('__admin_settings/Utility_mdl');
		
		$this->_pdata['languages'] = $this->Utility_mdl->get_languages();
		
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
        $this->template_lib->load_view($this, '__admin_catalog/Information_add_view', $this->_pdata);
  	}
  	
	public function edit() {
	    $secure_token = $this->input->get('secure_token');
	    $information_id = $this->security_lib->decrypt($secure_token);
	    
	    $this->load->model('__admin_catalog/Information_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        
	    if($this->input->post()) {
			
	        $this->form_validation->set_rules('country_id', 'Country', 'required', array(
				'required' => 'Please Select Country'
            ));
	        $this->form_validation->set_rules('city_id', 'City', 'required', array(
				'required' => 'Please Select City'
            ));
	        $this->form_validation->set_rules('details[en][title]', 'Title', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_title_leave_current', array(
			    'required' => 'Title Name required for English atleast.',
			    'min_length' => 'Title should have minimum 3 characters.',
			    'max_length' => 'Title Name cannot more than 255 characters.',
				'check_unique_title_leave_current' => 'For the same city and country information already exist.'
			));
	        $this->form_validation->set_rules('details[en][meta_title]', 'Meta Title', 'trim|max_length[255]', array(
                'max_length' => 'Meta Title Name cannot more than 255 characters.'
            ));
	        $this->form_validation->set_rules('details[en][meta_dsc]', 'Meta Description', 'trim|max_length[255]', array(
                'max_length' => 'Meta Description cannot more than 255 characters.'
            ));
	        $this->form_validation->set_rules('details[en][meta_keywords]', 'Meta Keyword', 'trim|max_length[255]', array(
                'max_length' => 'Meta Keyword cannot more than 255 characters.'
	        ));
	        $this->form_validation->set_rules('upload_image', '', 'callback_private_file_size');
	           if(empty($_FILES['upload_image']['name']) && $this->input->post('upload_image')) {
	           $this->form_validation->set_rules('upload_image', '', 'callback_file_check');
	        }
	        if ($this->form_validation->run() == FALSE) {
	            $this->session->set_flashdata('validation_error', TRUE);
	        } else {
    	            $image_path = 'content/image/main/information/';
    	            $config['upload_path']          = './' . $image_path;
    	            $config['allowed_types']        = 'gif|jpg|png|jpeg';
    	            $config['file_name']            = 'information_img_' . time();
    	            
    	            $this->load->library('upload', $config);
    	            
    	            if (! $this->upload->do_upload('upload_image')) {
    	                $error = array('error' => $this->upload->display_errors());
    	                $filename = null;
    	            } else {
    	                $data = $this->upload->data();
    	                $filename = $data['file_name'];
    	            }
    	            $data = [
    	                'image' => $this->input->post('image'),
    	                'country_id' => $this->input->post('country_id'),
    	                'city_id' => $this->input->post('city_id'),
    	                'lattitude' => $this->input->post('lattitude'),
    	                'longitude' => $this->input->post('longitude'),
    	                'details' => $this->input->post('details')
    	            ];
    	            if($this->input->post('status')) {
    	                $data['status'] = $this->input->post('status');
    	            }
    	            if(isset($filename)) {
    	                $data['image'] = $image_path . $filename;
    	            }
    	            $this->Information_mdl->update_information($data, $information_id);
    	            $this->session->set_flashdata('updated_successfully', TRUE);
    	            redirect('admin/catalog/information');
	         }
	    }
	    
	    $this->_pdata['information'] = $this->Information_mdl->get_information($information_id);
		$information_details = $this->Information_mdl->get_information_details($information_id);
		
		foreach($information_details as $information_detail) {
			$this->_pdata['information_details'][$information_detail['language_code']] = $information_detail;
		}
		$this->load->model('__admin_settings/Utility_mdl');
		
		$this->_pdata['languages'] = $this->Utility_mdl->get_languages();
		
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
		
		$this->template_lib->load_view($this, '__admin_catalog/Information_edit_view', $this->_pdata);
	}
	
	public function delete() {
	    $secure_token = $this->input->get('secure_token');
	    $information_id = $this->security_lib->decrypt($secure_token);
	    
        $this->load->model('__admin_catalog/Information_mdl');	
        $this->Information_mdl->delete_information($information_id);
        
        redirect('admin/catalog/information');
    }
	
    public function get_cities() {
        $country_id = $this->input->get('country_id');
        
        $this->load->model('__admin_catalog/Information_mdl');
        $data['cities'] = $this->Information_mdl->get_cities_by_country($country_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
	
    public function get_cities_by_country_id() {
        $country_id = $this->input->get('country_id');
        
        $this->load->model('__admin_settings/Utility_mdl');
        $data['cities'] = $this->Utility_mdl->get_cities_by_country_id($country_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
	 
	public function get_row_information_tbl_by_city_id() {
		$this->load->model('__admin_catalog/Information_mdl');
		$city_id = $this->input->get('city_id');
		
		if($this->Information_mdl->get_row_information_tbl_by_city_id_db($city_id)){
			$data['response'] = 'TRUE';
		} else {
			$data['response'] = 'FALSE';
		}
		
		$this->output->set_content_type('application/json')->set_output(json_encode($data['response']));
	}
    
    public function get_long_latt_by_city_id() {
        $city_id = $this->input->get('city_id');
        
        $this->load->model('__admin_catalog/Information_mdl');
        $data['lat_long'] = $this->Information_mdl->get_long_latt_by_city_id($city_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['lat_long']));
    }
}
