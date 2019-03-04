<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Account Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Accounts_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
		$this->load->library(array(
		    'form_validation',
		    'email',
		    '__prjadminlib/Template_lib',
		    '__commonlib/Optimized',
		    '__commonlib/Security_lib'
		));
		
		$this->load->helper('form');
		
		$siteLang = 'en';
		
		$this->lang->load('__admin_user/User', $siteLang);
		$this->lang->load('common', $siteLang);
		
		if(!$this->session->has_userdata('user')) {
		    redirect('admin/account/login');
		} 
    }
    
    public function index() {
        $search_conditions = array();
        $search_company_legal_name = $this->input->get('search_company_legal_name');
        if($this->input->get('search_company_legal_name')) {
            $search_conditions['search_company_legal_name'] = trim($search_company_legal_name);
            $this->_pdata['search_company_legal_name'] = trim($search_company_legal_name);
        } else {
            $search_conditions['search_company_legal_name'] = null;
            $this->_pdata['search_company_legal_name'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if(!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->_pdata['agents'] = array();
        
        $this->load->model('__admin_agent/Accounts_mdl');
        $this->_pdata['agents'] = $this->Accounts_mdl->get_agents($search_conditions, $start, $limit);
        $this->_pdata['total_agents'] = $this->Accounts_mdl->get_total_agents($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/agent/accounts', $this->_pdata['total_agents'], $limit);
		
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_uname'] = $this->lang->line('text_uname');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add'] = $this->lang->line('text_add');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        $this->_pdata['text_email'] = $this->lang->line('text_uemail');
        $this->_pdata['text_type'] = $this->lang->line('text_type');
        $this->_pdata['text_status'] = $this->lang->line('text_status');
        
        $this->template_lib->load_view($this, '__admin_agent/Agent_list_view', $this->_pdata);
    }
    
    function check_unique_agent_leave_current() {
        if($this->input->post('current_agent_email') == $this->input->post('email')) {
            return true; // WHEN EVER YOU WANT TO ALLOW SUCH CONDITION MARK TRUE
        } else {
            $this->db->select('*')->from('tv_agent_tbl')->where('email', $this->input->post('email'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false; // NOT ALLOWED
            } else {
                return true; // ALLOWED
            }
        }
    }
    
    function check_unique_admin_leave_current() {
        if($this->input->post('current_admin_email') == $this->input->post('admin_email')) {
            return true; // WHEN EVER YOU WANT TO ALLOW SUCH CONDITION MARK TRUE
        } else {
            $this->db->select('*')->from('tv_agent_tbl')->where('admin_email', $this->input->post('email'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false; // NOT ALLOWED
            } else {
                return true; // ALLOWED
            }
        }
    }
    
    public function add() {
        $this->load->model('__admin_agent/Accounts_mdl');
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
        
        
        if($this->input->post()) {
            $this->form_validation->set_rules('company_legal_name', 'Company Legal name', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an Company Legal name',
                'min_length' => 'Company Legal name should have minimum 3 characters.',
                'max_length' => 'Company Legal name cannot be more than 100 characters.'
            ));
            
            $this->form_validation->set_rules('tax_id', 'Tax Id', 'trim|min_length[3]|max_length[100]', array(
                'min_length' => 'Tax Id should have minimum 3 characters.',
                'max_length' => 'Tax Id cannot be more than 100 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Company Email', 'trim|required|min_length[3]|max_length[150]|is_unique[tv_agent_tbl.email]', array(
                'required' => 'You must provide a/an Company Email',
                'min_length' => 'Company Email should have minimum 3 characters.',
                'max_length' => 'Company Email name cannot be more than 100 characters.',
                'is_unique' => 'Email Already Exists'
            ));
            
            $this->form_validation->set_rules('address', 'Company Address', 'trim|required|min_length[3]|max_length[200]', array(
                'required' => 'You must provide a/an Company Address',
                'min_length' => 'Company Address name should have minimum 3 characters.',
                'max_length' => 'Company Address name cannot be more than 200 characters.',
            ));
            
            
            $this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an City',
                'min_length' => 'City name should have minimum 3 characters.',
                'max_length' => 'City name  cannot be more than 100 characters.',
            ));
            
            
            $this->form_validation->set_rules('country', 'Country', 'trim|required', array(
                'required' => 'You must provide a/an Country'
            ));
            
            $this->form_validation->set_rules('state', 'State', 'trim|required', array(
                'required' => 'You must provide a/an State'
            ));
            
            $this->form_validation->set_rules('postal', 'Post Code', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an Post Code',
                'min_length' => 'City name should have minimum 3 characters.',
                'max_length' => 'City name  cannot be more than 100 characters.',
            ));
            
            
            $this->form_validation->set_rules('telephone', 'Telephone Number', 'trim|required|min_length[10]|max_length[10]', array(
                'required' => 'You must provide a/an Telephone Number',
                'min_length' => 'Telephone Number should have minimum 10 characters.',
                'max_length' => 'Telephone Number cannot be more than 10 characters.',
            ));
            
            $this->form_validation->set_rules('admin_fullname', 'Admin Name', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an Admin Name',
                'min_length' => 'Admin Name should have minimum 3 characters.',
                'max_length' => 'Admin Name cannot be more than 100 characters.',
            ));
            
            $this->form_validation->set_rules('admin_contact', 'Admin Contact', 'trim|required', array(
                'required' => 'You must provide a/an Admin Contact'
            ));
            
            $this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|is_unique[tv_agent_tbl.admin_email]', array(
                'required' => 'You must provide a/an State',
                'is_unique' => 'Admin Email Already Exists!'
            ));
            
            $this->form_validation->set_rules('business_type[]', 'Business Type', 'required', array(
                'required' => 'You must provide a/an Business Type',
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Accounts_mdl->add_agent($this->input->post());
                redirect('admin/agent/accounts');
            }
        }
        
        $this->template_lib->load_view($this, '__admin_agent/Agent_add_view', $this->_pdata);
    }
    
    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $agent_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_agent/Accounts_mdl');
        
        if($this->input->post()) {
            
            $this->form_validation->set_rules('company_legal_name', 'Company Legal name', 'trim|required|min_length[3]|max_length[255]', array(
                'required' => 'You must provide a/an Company Legal name',
                'min_length' => 'Company Legal name should have minimum 3 characters.',
                'max_length' => 'Company Legal name cannot be more than 100 characters.'
            ));
            
            $this->form_validation->set_rules('tax_id', 'Tax Id', 'trim|min_length[3]|max_length[100]', array(
                'min_length' => 'Tax Id should have minimum 3 characters.',
                'max_length' => 'Tax Id cannot be more than 100 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Company Email', 'trim|min_length[3]|max_length[150]|required|valid_email|callback_check_unique_agent_leave_current', array(
                'required' => 'You must provide a/an Company Email',
                'valid_email' => 'Email Must Be valid Email.',
                'min_length' => 'Company Email name should have minimum 3 characters.',
                'max_length' => 'Company Email name cannot be more than 150 characters.',
                'check_unique_agent_leave_current' => 'Email Already Exists'
            ));
            
            $this->form_validation->set_rules('address', 'Company Address', 'trim|required|min_length[3]|max_length[200]', array(
                'required' => 'You must provide a/an Company Address',
                'min_length' => 'Company Address name should have minimum 3 characters.',
                'max_length' => 'Company Address name cannot be more than 200 characters.',
            ));
            
            $this->form_validation->set_rules('city', 'City', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an City',
                'min_length' => 'City name should have minimum 3 characters.',
                'max_length' => 'City name  cannot be more than 100 characters.',
            ));
            
            
            $this->form_validation->set_rules('country', 'Country', 'trim|required', array(
                'required' => 'You must provide a/an Country'
            ));
            
            $this->form_validation->set_rules('state', 'State', 'trim|required', array(
                'required' => 'You must provide a/an State',
            ));
            
            $this->form_validation->set_rules('postal', 'Post Code', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an Post Code',
                'min_length' => 'City name should have minimum 3 characters.',
                'max_length' => 'City name  cannot be more than 100 characters.',
            ));
            
            $this->form_validation->set_rules('telephone', 'Telephone Number', 'trim|required|min_length[10]|max_length[10]', array(
                'required' => 'You must provide a/an Telephone Number',
                'min_length' => 'Telephone Number should have minimum 10 characters.',
                'max_length' => 'Telephone Number cannot be more than 10 characters.',
            ));
            
            $this->form_validation->set_rules('admin_fullname', 'Admin Name', 'trim|required|min_length[3]|max_length[100]', array(
                'required' => 'You must provide a/an Admin Name',
                'min_length' => 'Admin Name should have minimum 3 characters.',
                'max_length' => 'Admin Name cannot be more than 100 characters.',
            ));
            
            $this->form_validation->set_rules('admin_contact', 'Admin Contact', 'trim|required|min_length[10]|max_length[10]', array(
                'required' => 'You must provide a/an Admin Contact',
                'min_length' => 'Admin Contact should have minimum 10 characters.',
                'max_length' => 'Admin Contact cannot be more than 10 characters.',
            ));
            
            $this->form_validation->set_rules('admin_email', 'Admin Email', 'trim|required|callback_check_unique_admin_leave_current', array(
                'required' => 'You must provide a/an State',
                'check_unique_admin_leave_current' => 'Admin Email Already Exists!'
            ));
            
            $this->form_validation->set_rules('business_type[]', 'Business Type', 'required', array(
                'required' => 'You must provide a/an Business Type',
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Accounts_mdl->update_agent($this->input->post(), $agent_id);
                redirect('admin/agent/accounts');
            }
        }
        
        $this->_pdata['agent'] = $this->Accounts_mdl->get_agent($agent_id);
        
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        $this->template_lib->load_view($this, '__admin_agent/Agent_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $agent_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_agent/Accounts_mdl');
        $this->Accounts_mdl->delete_agent($agent_id);
        
        redirect('admin/agent/accounts');
    }
	
public function change_status() {
		$this->load->model('__admin_agent/Accounts_mdl');
	    $secure_token = $this->input->get('secure_token');
	    $agent_id = $this->security_lib->decrypt($secure_token);
	    $this->load->library('__commonlib/Email_lib');
		
        if($agent_id) {
			$email_data = array();
            $agent_detail = $this->Accounts_mdl->get_agent($agent_id);
           $this->Accounts_mdl->change_agent_status($agent_id, $this->input->get('change_status'), $agent_detail);
        }
		redirect('admin/agent/accounts');
    } 
    
	public function approve_agent() {
		$this->load->model('__admin_agent/Accounts_mdl');
	    $secure_token = $this->input->get('secure_token');
	    $agent_id = $this->security_lib->decrypt($secure_token);
	    $this->load->library('__commonlib/Email_lib');
		
        if($agent_id) {
			$email_data = array();
            $agent_detail = $this->Accounts_mdl->get_agent($agent_id);
            $access_token = $this->Accounts_mdl->change_agent_approval($agent_id, $this->input->get('approved'), $agent_detail);
			if($access_token) { 
			// vendor mail for reset password
			$to = $agent_detail['admin_email'];
			$from = ADMIN_EMAIL;
			$from_title = $this->lang->line('From_title_email');
			 $subject = $this->lang->line('password_reset_subject');
			 $email_data['vendor_name'] = $agent_detail['admin_fullname'];
			 $email_data['message'] = $this->lang->line('password_reset_message');
			 $email_data['click_text'] = $this->lang->line('click_text');
			 $email_data['text_page_tittle_vendor'] = $this->lang->line('text_page_tittle_vendor');
			 $email_data['text_customer_greeting'] = $this->lang->line('text_customer_greeting');
			 $email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
			 $email_data['text_email_admin'] = $this->lang->line('text_email_admin');
			 $email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
			 $email_data['reset_link'] = base_url('vendor/account/create-password/?access_token=' . $access_token);
			   $body = $this->load->view('__email_template/Vendor_change_password_email', $email_data, TRUE);
			    if($to != "" &&  $this->input->get('approved') == 1) {
                    
                    $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
                }	
			}
        }
		redirect('admin/agent/accounts');
    }
}