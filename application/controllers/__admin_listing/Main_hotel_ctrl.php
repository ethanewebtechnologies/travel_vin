<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: HOTEl CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_hotel_ctrl extends CI_Controller {

    private $_pdata = array();

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }

        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib'
        ));

        $this->load->helper(array('form', 'dt'));

        $this->lang->load('__admin_listing/Hotel', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }

    public function index() {

        $search_conditions = array();

        $search_hotel_name = $this->input->get('search_hotel_name');

        if (isset($search_hotel_name)) {
            $search_conditions['search_hotel_name'] = trim($search_hotel_name);
            $this->_pdata['search_hotel_name'] = trim($search_hotel_name);
        } else {
            $search_conditions['search_hotel_name'] = null;
            $this->_pdata['search_hotel_name'] = null;
        }
        
        $search_city_name = $this->input->get('search_city_name');
        
        if (isset($search_city_name)) {
            $search_conditions['search_city_name'] = trim($search_city_name);
            $this->_pdata['search_city_name'] = trim($search_city_name);
        } else {
            $search_conditions['search_city_name'] = null;
            $this->_pdata['search_city_name'] = null;
        }
        
        $search_country_name = $this->input->get('search_country_name');
        
        if (isset($search_country_name)) {
            $search_conditions['search_country_name'] = trim($search_country_name);
            $this->_pdata['search_country_name'] = trim($search_country_name);
        } else {
            $search_conditions['search_country_name'] = null;
            $this->_pdata['search_country_name'] = null;
        }

        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['hotels'] = array();
        $this->load->model('__admin_listing/Main_hotel_mdl');

        /* FETCHING DATA */
        $this->_pdata['hotels'] = $this->Main_hotel_mdl->get_hotels($search_conditions, $start, $limit);
        $this->_pdata['total_hotels'] = $this->Main_hotel_mdl->get_total_hotels($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/listing/main-hotel', $this->_pdata['total_hotels'], $limit);

        $this->load->model('__admin_settings/Utility_mdl');
        $countries = $this->Utility_mdl->get_countries();
        
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $cities = $this->Utility_mdl->get_cities();
        
        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }
        
        $this->template_lib->load_view($this, '__admin_listing/Main_hotel_list_view', $this->_pdata);
    }
	
	function check_unique_hotel() {
	    $this->db->select('*')->from('tv_location_tbl')->where('type', 2)
			->where('name', $this->input->post('name'))
				->where('country_id', $this->input->post('country_id'))
					->where('city_id', $this->input->post('city_id'));
		$query = $this->db->get();
				
		if($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function check_unique_hotel_leave_current() {
		
		$chn = $this->input->post('current_hotel_name');
		$cc = $this->input->post('current_city');
		$cy = $this->input->post('current_country');
		
		$n = $this->input->post('name');
		$ci = $this->input->post('city_id');
		$yi = $this->input->post('country_id');
		
		
		if($chn . '_' . $cc . '_' . $cy == $n . '_' . $ci . '_' . $yi) {
			return true; // ALLOWED
		} else {
		    $this->db->select('*')->from('tv_location_tbl')->where('type', 2)
				->where('name', $n)
					->where('country_id', $yi)
						->where('city_id', $ci);
			
			$query = $this->db->get();
				
			if($query->num_rows() > 0) {
				return false; // NOT ALLOWED
			} else {
				return true; // ALLOWED 
			}
		}
	}

    public function add() {
        $this->load->model('__admin_listing/Main_hotel_mdl');
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');

        if ($this->input->post()) {

            $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_hotel', array(
                'required' => 'Hotel Name is Required.',
                'min_length' => 'Hotel Name should be more than 3 characters.',
                'max_length' => 'Hotel not more than 255 characters.',
                'check_unique_hotel' => 'Hotel already exist.'
            ));
            
            $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                'required' => 'Please Select Country'));

            $this->form_validation->set_rules('city_id', 'City', 'required', array(
                'required' => 'Please Select City'));
			
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_hotel_mdl->add_hotel($this->input->post());
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/listing/main-hotel');
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

        $this->template_lib->load_view($this, '__admin_listing/Main_hotel_add_view', $this->_pdata);
    }

    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $hotel_id = $this->security_lib->decrypt($secure_token);


        $this->load->model('__admin_listing/Main_hotel_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');

        if ($this->input->post()) {

           $this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_hotel_leave_current', array(
                'required' => 'Hotel Name is Required.',
                'min_length' => 'Hotel Name should be more than 3 characters.',
                'max_length' => 'Hotel not more than 255 characters.',
				'check_unique_hotel_leave_current' => 'Hotel already exist.'
            ));

            $this->form_validation->set_rules('country_id', 'Country', 'required', array(
			     'required' => 'Please Select Country'));

            $this->form_validation->set_rules('city_id', 'City', 'required', array(
			     'required' => 'Please Select City'));
			
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_hotel_mdl->update_hotel($this->input->post(), $hotel_id);
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/listing/main-hotel');
            }
        }

        $this->_pdata['hotel'] = $this->Main_hotel_mdl->get_hotel($hotel_id);

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

        $this->template_lib->load_view($this, '__admin_listing/Main_hotel_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $hotel_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_hotel_mdl');
        $this->Main_hotel_mdl->delete_hotel($hotel_id);

        redirect('admin/listing/main-hotel/index');
    }

    public function get_cities_by_country_id() {
        $country_id = $this->input->get('country_id');

        $this->load->model('__admin_settings/Utility_mdl');
        $data['cities'] = $this->Utility_mdl->get_cities_by_country_id($country_id);

        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $hotel_id = $this->security_lib->decrypt($secure_token);
        
        if($hotel_id) {
            $this->load->model('__admin_listing/Main_hotel_mdl');
            $this->Main_hotel_mdl->change_user_status($hotel_id, $this->input->get('change_status'));
            
            redirect('admin/listing/main-hotel');
        }
    }

}
