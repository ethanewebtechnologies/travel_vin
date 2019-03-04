<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: City Controller
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_city_ctrl extends CI_Controller {

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
		$this->load->database();
    }

    public function index() {

        $search_conditions = array();

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

        $this->_pdata['cities'] = array();

        $this->load->model('__admin_listing/Main_city_mdl');

        /* FETCHING DATA */
        $this->_pdata['cities'] = $this->Main_city_mdl->get_cities($search_conditions, $start, $limit);
        $this->_pdata['total_cities'] = $this->Main_city_mdl->get_total_cities($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/listing/main-city', $this->_pdata['total_cities'], $limit);

        $countries = $this->Main_city_mdl->get_countries();
        
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }

        $this->template_lib->load_view($this, '__admin_listing/Main_city_list_view', $this->_pdata);
   }
	
	
    function check_unique_city() {
		$this->db->select('*')->from('tv_main_city_tbl')
			->where('name', $this->input->post('name'))
				->where('country_id', $this->input->post('country_id'));
				
		$query = $this->db->get();
				
		if($query->num_rows() > 0) {
			return false; // NOT ALLOWED
		} else {
			return true; // ALLOWED
		}
	}
	
	function check_unique_city_leave_current() {
		$cc = $this->input->post('current_city_name');
		$chc = $this->input->post('name');
		
		$cy = $this->input->post('current_country');
		$chy = $this->input->post('country_id');
		
		if( $cc . '_' . $cy == $chc . '_' . $chy) {
			return true; // ALLOWED
		} else { 
			$this->db->select('*')
				->from('tv_main_city_tbl')
					->where('name', $chc)
						->where('country_id', $chy);
			
			$query = $this->db->get();
				
			if($query->num_rows() > 0) {
				return false; // NOT ALLOWED
			} else {
				return true; // ALLOWED
			}
		}
	}
    public function add() {

        $this->load->model('__admin_listing/Main_city_mdl');

        if ($this->input->post()) {
			
			$this->form_validation->set_rules('name', 'City', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_city', array(
                'required' => 'City Name is Required.',
                'min_length' => 'City Name should be more than 3 characters.',
                'max_length' => 'City not more than 255 characters.',
				'check_unique_city' => 'City already exist.'
             ));
			
			$this->form_validation->set_rules('country_id', 'Country', 'required', array(
                'required' => 'Country must be selected'
			));

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_city_mdl->add_city($this->input->post());
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/listing/main-city');
            }
        }

        $countries = $this->Main_city_mdl->get_countries();
        
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        
		foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }

        $this->template_lib->load_view($this, '__admin_listing/Main_city_add_view', $this->_pdata);
    }

    public function edit() {
        $this->load->model('__admin_listing/Main_city_mdl');
        $countries = $this->Main_city_mdl->get_countries();
        
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $secure_token = $this->input->get('secure_token');
        $city_id = $this->security_lib->decrypt($secure_token);
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('name', 'City', 'required|callback_check_unique_city_leave_current', array(
			    'required' => 'Please Enter City ',
			    'check_unique_city_leave_current' => 'City already exist.'
            ));
            
            $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                'required' => 'Country must be selected'
            ));

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_city_mdl->update_city($this->input->post(), $city_id);
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/listing/main-city');
            }
        }

        $this->_pdata['city'] = $this->Main_city_mdl->get_city($city_id);
        
        $this->template_lib->load_view($this, '__admin_listing/Main_city_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $city_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_city_mdl');
        $this->Main_city_mdl->delete_city($city_id);

        redirect('admin/listing/main-city');
    }
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $city_id = $this->security_lib->decrypt($secure_token);
        
        if($city_id) {
            $this->load->model('__admin_listing/Main_city_mdl');
            $this->Main_city_mdl->change_user_status($city_id, $this->input->get('change_status'));
            
            redirect('admin/listing/main-city');
        }
    }

}
