<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Airport Controller
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_airport_ctrl extends CI_Controller {

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
    }

    public function index() {

        $search_conditions = array();

        $search_airport_name = $this->input->get('search_airport_name');

        if (isset($search_airport_name)) {
            $search_conditions['search_airport_name'] = trim($search_airport_name);
            $this->_pdata['search_airport_name'] = trim($search_airport_name);
        } else {
            $search_conditions['search_airport_name'] = null;
            $this->_pdata['search_airport_name'] = null;
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

        $this->_pdata['airports'] = array();

        $this->load->model('__admin_listing/Main_airport_mdl');

        /* FETCHING DATA */
        $this->_pdata['airports'] = $this->Main_airport_mdl->get_airports($search_conditions, $start, $limit);
        $this->_pdata['total_airports'] = $this->Main_airport_mdl->get_total_airports($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/listing/main-airport', $this->_pdata['total_airports'], $limit);

        $this->load->model('__admin_settings/Utility_mdl');
        $countries = $this->Utility_mdl->get_countries();

        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }

        $cities = $this->Utility_mdl->get_cities();

        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }

        $this->template_lib->load_view($this, '__admin_listing/Main_airport_list_view', $this->_pdata);
    }
    
    function check_unique_airport() {
		$this->db->select('*')
            ->from('tv_location_tbl')
                ->where('type', 1)
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
	
	function check_unique_airport_leave_current() {
		
		$can = $this->input->post('current_airport_name');
		$cc = $this->input->post('current_city');
		$cy = $this->input->post('current_country');
		
		$n = $this->input->post('name');
		$ci = $this->input->post('city_id');
		$yi = $this->input->post('country_id');
		
		
		if($can . '_' . $cc . '_' . $cy == $n . '_' . $ci . '_' . $yi) {
			return true; // ALLOWED
		} else {
			$this->db->select('*')->from('tv_location_tbl')->where('type', 1)
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
        $this->load->model('__admin_listing/Main_airport_mdl');
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');

        if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_airport', array(
				'required' => 'Airport Name is Required.',
				'min_length' => 'Airport Name Contain Should  Be At Least  3 Character.',
				'max_length' => 'Airport Name Contain Should Not Be 255 Character.',
				'check_unique_airport' => 'Airport already exist.'
				)
			);

			$this->form_validation->set_rules('country_id', 'Country', 'required', array(
				'required' => 'Please Select Country'));

			$this->form_validation->set_rules('city_id', 'City', 'required', array(
				'required' => 'Please Select City'));

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_airport_mdl->add_airport($this->input->post());
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/listing/main-airport');
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

        $this->template_lib->load_view($this, '__admin_listing/Main_airport_add_view', $this->_pdata);
    }

    public function edit() {

        $secure_token = $this->input->get('secure_token');
        $airport_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_airport_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');

        if ($this->input->post()) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required|min_length[3]|max_length[255]|callback_check_unique_airport_leave_current', array(
				'required' => 'Airport Name is Required.',
				'min_length' => 'Airport Name Contain Should  Be At Least 3 Character.',
				'max_length' => 'Airport Name Contain Should Not Be 255 Character.',
				'check_unique_airport_leave_current' => 'Airport already exist.'
				)
			);
				
			$this->form_validation->set_rules('country_id', 'Country', 'required', array(
				'required' => 'Please Select Country'));

			$this->form_validation->set_rules('city_id', 'City', 'required', array(
				'required' => 'Please Select City'));

			if ($this->form_validation->run() == FALSE) {
			    $this->session->set_flashdata('validation_error', TRUE);
			} else {
				$this->Main_airport_mdl->update_airport($this->input->post(), $airport_id);
				
				$this->session->set_flashdata('updated_successfully', TRUE);
				redirect('admin/listing/main-airport/index');
			}
        }

        $this->_pdata['airport'] = $this->Main_airport_mdl->get_airport($airport_id);

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

        $this->template_lib->load_view($this, '__admin_listing/Main_airport_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $airport_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_airport_mdl');
        $this->Main_airport_mdl->delete_airport($airport_id);

        redirect('admin/listing/main-airport');
    }

    public function get_cities_by_country_id() {
        $country_id = $this->input->get('country_id');

        $this->load->model('__admin_settings/Utility_mdl');
        $data['cities'] = $this->Utility_mdl->get_cities_by_country_id($country_id);

        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $airport_id = $this->security_lib->decrypt($secure_token);
        
        if($airport_id) {
            $this->load->model('__admin_listing/Main_airport_mdl');
            $this->Main_airport_mdl->change_user_status($airport_id, $this->input->get('change_status'));
            
            redirect('admin/listing/main-airport');
        }
    }
}
