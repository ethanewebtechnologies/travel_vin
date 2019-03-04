<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Customer_ctrl extends CI_Controller {
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
        
        $this->lang->load('__admin_user/User', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
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
        
        $this->_pdata['hotels'] = array();
        $this->load->model('__admin_customer/Customer_mdl');
        
        /* FETCHING DATA */
        $this->_pdata['customers'] = $this->Customer_mdl->get_customers($search_conditions, $start, $limit);
        $this->_pdata['total_customers'] = $this->Customer_mdl->get_total_customers($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/customer/customer', $this->_pdata['total_customers'], $limit);
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_list_view', $this->_pdata);
    }
    
    public function check_unique_email() {
        $this->db->select('*')->from('tv_customer_tbl')->where('email', $this->input->post('email'));
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return false; // NOT ALLOWED
        } else {
            return true; // ALLOWED
        }
    }
    
    public function check_unique_email_leaving_current() {
        if($this->input->post('email') == $this->input->post('current_email')) {
            return true; // ALLOWED
        } else {
            $this->db->select('*')->from('tv_customer_tbl')->where('email', $this->input->post('email'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false; // NOT ALLOWED
            } else {
                return true; // ALLOWED
            }
        }
    }
    
    public function change_string_case($your_string) {
        return mb_convert_case($your_string, MB_CASE_TITLE, 'UTF-8');
    }
    
    public function add() {
        $this->load->model('__admin_customer/Customer_mdl');
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
        
        if ($this->input->post()) {
            
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[255]|callback_change_string_case[name]', array(
                'required' => 'First Name is Required.',
                'min_length' => 'First Name should be more than 3 characters.',
                'max_length' => 'First Name not more than 255 characters.'
            ));
            
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|min_length[3]|max_length[255]|callback_change_string_case[name]', array(
                'min_length' => 'Last Name should be more than 3 characters.',
                'max_length' => 'Last Name not more than 255 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_unique_email', array(
                'required' => 'Email is Required.',
                'check_unique_email' => 'Email already Exists!'
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                
                $this->Customer_mdl->add_customer($this->input->post());
               
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/customer/customer');
            }
        }
        
        $this->load->model('__admin_settings/Utility_mdl');
        $customer_types = $this->Utility_mdl->get_customer_types();
        
        foreach ($customer_types as $customer_type) {
            $this->_pdata['customer_types'][$customer_type['id']] = $customer_type['type_name'];
        }
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_add_view', $this->_pdata);
    }
    
    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $customer_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_customer/Customer_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        if ($this->input->post()) {
            $this->form_validation->set_rules('firstname', 'First Name', 'trim|required|min_length[3]|max_length[255]|callback_change_string_case[name]', array(
                'required' => 'First Name is Required.',
                'min_length' => 'First Name should be more than 3 characters.',
                'max_length' => 'First Name not more than 32 characters.'
            ));
            
            $this->form_validation->set_rules('lastname', 'Last Name', 'trim|min_length[3]|max_length[255]|callback_change_string_case[name]', array(
                'min_length' => 'Last Name should be more than 3 characters.',
                'max_length' => 'Last Name not more than 32 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|callback_check_unique_email_leaving_current', array(
                'required' => 'Email is Required.',
                'check_unique_email' => 'Email already Exists!'
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                
                $this->Customer_mdl->update_customer($this->input->post(), $customer_id);
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/customer/customer');
            }
        }
        
        $this->_pdata['customer'] = $this->Customer_mdl->get_customer($customer_id);
        $this->_pdata['customer_addresses'] = $this->Customer_mdl->get_customer_addresses($customer_id);
        
        $this->load->model('__admin_settings/Utility_mdl');
        $customer_types = $this->Utility_mdl->get_customer_types();
        
        foreach ($customer_types as $customer_type) {
            $this->_pdata['customer_types'][$customer_type['id']] = $customer_type['type_name'];
        }
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $customer_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_customer/Customer_mdl');
        $this->Customer_mdl->delete_customer($customer_id);
        
        redirect('admin/customer/customer');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $customer_id = $this->security_lib->decrypt($secure_token);
        
        if($customer_id) {
            $this->load->model('__admin_customer/Customer_mdl');
            $this->Customer_mdl->change_customer_status($customer_id, $this->input->get('change_status'));
            
            redirect('admin/customer/customer');
        }
    }
}