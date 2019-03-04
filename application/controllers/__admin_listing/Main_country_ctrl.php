<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Country Controller
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_country_ctrl extends CI_Controller {

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
		
        $this->load->helper(array('form', 'date', 'dt'));
    }
		
    public function index() {

        $search_conditions = array();

        $search_name = $this->input->get('search_name');

        if (isset($search_name)) {
            $search_conditions['search_name'] = $search_name;
            $this->_pdata['search_name'] = $search_name;
        } else {
            $search_conditions['search_name'] = null;
            $this->_pdata['search_name'] = null;
        }

        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['countries'] = array();

        $this->load->model('__admin_listing/Main_country_mdl');

        /* FETCHING DATA */
        $this->_pdata['countries'] = $this->Main_country_mdl->get_countries($search_conditions, $start, $limit);
        $this->_pdata['total_countries'] = $this->Main_country_mdl->get_total_countries($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/listing/main-country', $this->_pdata['total_countries'], $limit);

        $this->template_lib->load_view($this, '__admin_listing/Main_country_list_view', $this->_pdata);
    }
	
	function check_unique_country_leave_current() {
		if($this->input->post('current_country_name') == $this->input->post('name')) {
			return true; // WHEN EVER YOU WANT TO ALLOW SUCH CONDITION MARK TRUE
		} else {
			$this->db->select('*')->from('tv_main_country_tbl')->where('name', $this->input->post('name'));
				
			$query = $this->db->get();
					
			if($query->num_rows() > 0) {
				return false; // NOT ALLOWED
			} else {
				return true; // ALLOWED
			}
		}
	}

    public function add() {
        $this->load->model('__admin_listing/Main_country_mdl');
        $this->_pdata['static_countries'] = $this->Main_country_mdl->get_static_countries();

        if ($this->input->post()) {
            
            $this->form_validation->set_rules('continent', 'Continent', 'required', array(
                'required' => 'Please Select Continent'
            ));

			$this->form_validation->set_rules('countries[]', 'Country', 'required|is_unique[tv_main_country_tbl.name]', array(
                'required' => 'Please Select Country',
                'is_unique' => 'Country already exist'
			));

			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
			} else {
                $this->Main_country_mdl->add_country($this->input->post());
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/listing/main-country');
			}
        }

        $this->_pdata['static_continents'] = $this->Main_country_mdl->get_static_continents();
        $this->template_lib->load_view($this, '__admin_listing/Main_country_add_view', $this->_pdata);
    }

	
    public function edit() {

        $secure_token = $this->input->get('secure_token');
        $country_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_country_mdl');
        $this->_pdata['static_countries'] = $this->Main_country_mdl->get_static_countries();

        if ($this->input->post()) {

			$this->form_validation->set_rules('name', 'Country', 'required|min_length[3]|max_length[255]|callback_check_unique_country_leave_current', array(
               
                'required' => 'Country Name is Required.',
                'min_length' => 'Country Name should be less than 3 characters.',
                'max_length' => 'Country not more than 255 characters.',
				'check_unique_country_leave_current' => 'Country already exist.'
            ));


            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Main_country_mdl->update_country($this->input->post(), $country_id);
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/listing/main-country');
            }
        }


        $this->_pdata['country'] = $this->Main_country_mdl->get_country($country_id);
        $this->template_lib->load_view($this, '__admin_listing/Main_country_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $country_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_listing/Main_country_mdl');
        $this->Main_country_mdl->delete_country($country_id);

        redirect('admin/listing/main-country');
    }

    public function get_country() {
        $this->load->model('__admin_listing/Main_country_mdl');
        $continent_code = $this->input->get('continent_code');
        $this->_pdata['countries'] = $this->Main_country_mdl->get_countries_by_continent_code($continent_code);
        $this->output->set_content_type('application/json')->set_output(json_encode($this->_pdata['countries']));
    }

    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $country_id = $this->security_lib->decrypt($secure_token);
        
        if($country_id) {
            $this->load->model('__admin_listing/Main_country_mdl');
            $this->Main_country_mdl->change_user_status($country_id, $this->input->get('change_status'));
            
            redirect('admin/listing/main-country');
        }
    }
   
}
