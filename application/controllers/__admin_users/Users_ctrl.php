<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: User Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Users_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            'email',
            '__commonlib/Security_lib',
            '__prjadminlib/Template_lib'
        ));
        
        $this->load->helper(array(
            'form', 
            'name_sanatizer', 
            'dt', 
            'Encryption_helper'
        ));
        
        $this->lang->load('__admin_user/User',DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        
        $search_conditions = array();
        
        $search_user = $this->input->get('search_user');
        
        if (isset($search_user)) {
            $search_conditions['search_user'] = trim($search_user);
            $this->_pdata['search_user'] = trim($search_user);
        } else {
            $search_conditions['search_user'] = null;
            $this->_pdata['search_user'] = null;
        }
        
        $search_user_email = $this->input->get('search_user_email');
        
        if (isset($search_user_email)) {
            $search_conditions['search_user_email'] = trim($search_user_email);
            $this->_pdata['search_user_email'] = trim($search_user_email);
        } else {
            $search_conditions['search_user_email'] = null;
            $this->_pdata['search_user_email'] = null;
        }
        
        $search_user_group = $this->input->get('search_user_group');
        
        if (isset($search_user_group)) {
            $search_conditions['search_user_group'] = trim($search_user_group);
            $this->_pdata['search_user_group'] = trim($search_user_group);
        } else {
            $search_conditions['search_user_group'] = null;
            $this->_pdata['search_user_group'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->load->model('__admin_users/User_mdl');
        
        $this->_pdata['users'] = array();
        $this->_pdata['users'] = $this->User_mdl->get_users($search_conditions, $start, $limit);
        $this->_pdata['total_users'] = $this->User_mdl->get_total_users($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/users/users', $this->_pdata['total_users'], $limit);
        
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
        
        $this->load->model('__admin_settings/Utility_mdl');
        $user_groups = $this->Utility_mdl->get_user_groups();
        
        $this->_pdata['user_groups'] = array("---- Select User Group ----");
        
        foreach ($user_groups as $user_group) {
            $this->_pdata['user_groups'][$user_group['id']] = $user_group['gp_name'];
        }
        
        $this->template_lib->load_view($this, '__admin_users/User_list_view', $this->_pdata);
    }
    
    function check_unique_user_leave_current() {
        if($this->input->post('current_user_email') == $this->input->post('email')) {
            return true; // WHEN EVER YOU WANT TO ALLOW SUCH CONDITION MARK TRUE
        } else {
            $this->db->select('*')->from('tv_user_tbl')->where('email', $this->input->post('email'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false; // NOT ALLOWED
            } else {
                return true; // ALLOWED
            }
        }
    }
	
    public function add() {
        $this->load->model('__admin_users/User_mdl');
        
        if($this->input->post()) {
            $this->form_validation->set_rules('fname', 'First Name', 'trim|required|max_length[32]', array(
                'required' => 'This is Required.',
                'max_length' => 'First Name should not be more than 32 characters.'
            ));
            
            $this->form_validation->set_rules('lname', 'Last Name', 'trim|max_length[32]', array(
                'max_length' => 'Last Name should not be more than 32 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[tv_user_tbl.email]', array(
                'required' => 'Email is Required.',
                'valid_email' => 'Email Must Be valid Email.',
                'is_unique' => 'User With Same Email is already exist.'
            ));
            
            if($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $email_data = array();
                $email_data = $this->User_mdl->adduser($this->input->post());
                $this->User_mdl->add_user_permission($this->input->post('restrictions'), $email_data['user_id'], $this->input->post('user_group_id'));
				
				
				//language
				$email_data['text_customer_greeting'] = $this->lang->line('text_customer_greeting');
				$email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
				$email_data['text_email_admin'] = $this->lang->line('text_email_admin');
				$email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
				$email_data['text_msg_click_here'] = $this->lang->line('text_msg_click_here');
				$email_data['text_page_tittle'] = $this->lang->line('text_page_tittle');
				$email_data['text_msg_confirm'] = $this->lang->line('text_msg_confirm');
                
                //$from = 'lobodanny0@gmail.com';
                $from = ADMIN_EMAIL;
                $from_title = $this->lang->line('From_title_email');
                $to = $this->input->post('email');
                $subject = $this->lang->line('text_email_subject');
                $body = $this->load->view('__email_template/Admin_user_confirmation_email', $email_data, TRUE);
                
                if($to != "") {
                    $this->load->library('__commonlib/Email_lib');
                    $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
                }
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/users/users');
            }						
        }
        
        $this->load->model('__admin_settings/Utility_mdl');
        $user_groups = $this->Utility_mdl->get_user_groups();
        
        foreach ($user_groups as $user_group) {
            $this->_pdata['user_groups'][$user_group['id']] = $user_group['gp_name'];
        }
        
        $this->_pdata['text_h3_add_heading'] = $this->lang->line('text_h3_add_heading');
        $this->_pdata['text_add_ufname'] = $this->lang->line('text_add_ufname');
        $this->_pdata['text_add_ulname'] = $this->lang->line('text_add_ulname');
        $this->_pdata['text_add_uemail'] = $this->lang->line('text_add_uemail');
        $this->_pdata['text_add_upwd'] = $this->lang->line('text_add_upwd');
        $this->_pdata['text_add_ucpwd'] = $this->lang->line('text_add_ucpwd');
        $this->_pdata['text_add_utype'] = $this->lang->line('text_add_utype');
        $this->_pdata['text_submit'] = $this->lang->line('text_submit');
        $this->_pdata['text_add_puname'] = $this->lang->line('text_add_puname');
        $this->_pdata['text_add_plname'] = $this->lang->line('text_add_plname');
        $this->_pdata['text_add_pemail'] = $this->lang->line('text_add_pemail');
        $this->_pdata['text_add_ppwd'] = $this->lang->line('text_add_ppwd');
        $this->_pdata['text_add_pcpwd'] = $this->lang->line('text_add_pcpwd');
        $this->_pdata['text_status'] = $this->lang->line('text_status');	
        
        $this->template_lib->load_view($this, '__admin_users/User_add_view', $this->_pdata);
	}

	public function edit() {
	    
	    $secure_token = $this->input->get('secure_token');
	    $user_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_users/User_mdl');
		
        if($this->input->post()) {
            $this->form_validation->set_rules('fname', 'Firstname', 'trim|required|max_length[32]', array(
                'required' => 'First Name is Required.',
                'max_length' => 'First Name should not be more than 32 characters.'
            ));
            
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|callback_check_unique_user_leave_current', array(
                'required' => 'Email is Required.',
                'valid_email' => 'Email Must Be valid Email.',
                'check_unique_user_leave_current' => 'Email already exist.'
            ));			

            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->User_mdl->update_user($this->input->post(), $user_id);
                $this->User_mdl->add_user_permission($this->input->post('restrictions'), $user_id, $this->input->post('user_group_id'));
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/users/users');
            }
        }
        
		$this->_pdata['userdata'] = $this->User_mdl->get_user_by_user_id($user_id);
		$user_group_id = $this->User_mdl->get_user_group_by_user_id($user_id);
		$user_permissions = $this->User_mdl->get_user_permission($user_id, $user_group_id);
		
		$this->_pdata['user_permissions'] = array();
		 
		if(!empty($user_permissions)) {
            foreach ($user_permissions as $user_permission) {
		        $this->_pdata['user_permissions'][] = $user_permission['restrictied_zone_id'];
            }
		}
		
		$this->load->model('__admin_settings/Utility_mdl');
		$user_groups = $this->Utility_mdl->get_user_groups();
		
		foreach ($user_groups as $user_group) {
		    $this->_pdata['user_groups'][$user_group['id']] = $user_group['gp_name'];
		}
		
		$this->_pdata['restricted_zones'] = $this->User_mdl->get_restricted_zones();
		
		$this->_pdata['text_h3_edit_heading'] = $this->lang->line('text_h3_edit_heading');
		$this->_pdata['text_add_ufname'] = $this->lang->line('text_add_ufname');
		$this->_pdata['text_add_ulname'] = $this->lang->line('text_add_ulname');
		$this->_pdata['text_add_uemail'] = $this->lang->line('text_add_uemail');
		$this->_pdata['text_add_upwd'] = $this->lang->line('text_add_upwd');
		$this->_pdata['text_add_ucpwd'] = $this->lang->line('text_add_ucpwd');
		$this->_pdata['text_add_utype'] = $this->lang->line('text_add_utype');
		$this->_pdata['text_submit'] = $this->lang->line('text_submit');
		$this->_pdata['text_add_puname'] = $this->lang->line('text_add_puname');
		$this->_pdata['text_add_plname'] = $this->lang->line('text_add_plname');
		$this->_pdata['text_add_pemail'] = $this->lang->line('text_add_pemail');
		$this->_pdata['text_add_ppwd'] = $this->lang->line('text_add_ppwd');
		$this->_pdata['text_add_pcpwd'] = $this->lang->line('text_add_pcpwd');
		$this->_pdata['text_status'] = $this->lang->line('text_status');  
		
        $this->template_lib->load_view($this, '__admin_users/User_edit_view', $this->_pdata);
    }
	
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $user_id = $this->security_lib->decrypt($secure_token);
        
        if($user_id) {
            $this->load->model('__admin_users/User_mdl');
            $this->User_mdl->change_user_status($user_id, $this->input->get('change_status'));
            redirect('admin/users/users');
        }
    }
	
	public function delete_user() {
	    $secure_token = $this->input->get('secure_token');
	    $user_id = $this->security_lib->decrypt($secure_token);
	    
        $this->load->model('__admin_users/User_mdl');
		
        if($user_id) {
            $this->User_mdl->delete_user($user_id);
            redirect('admin/users/users');
        }
    }
    
    public function user_permission_load() {
        $user_group_id = $this->input->get('user_group_id');
        
        if($user_group_id) {
        
            $this->load->model('__admin_users/User_mdl');
            $this->load->model('__admin_users/User_group_mdl');
            
            $this->_pdata['restricted_zones'] = $this->User_mdl->get_restricted_zones();
            
            $user_group_permissions = $this->User_group_mdl->get_user_group_permission($user_group_id);
            
            $this->_pdata['user_group_permissions'] = array();
            
            if(!empty($user_group_permissions)) {
                foreach ($user_group_permissions as $user_group_permission) {
                    $this->_pdata['user_group_permissions'][] = $user_group_permission['restrictied_zone_id'];
                }
            }
        }
        
        $this->load->view('__admin_users/User_permission_load', $this->_pdata);
    }
}