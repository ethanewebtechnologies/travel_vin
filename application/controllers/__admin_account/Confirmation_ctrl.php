<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Confirmation Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Confirmation_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib',
        ));
        
        $this->load->helper(array(
            'form', 
            'encryption',
            'dt'
        ));
        
        $this->load->model('__admin_account/Account_mdl');
        $this->lang->load('__admin_account/Login', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
		
		
		
        $secure_token = $this->input->get('token');
        
        $this->load->model('__admin_account/Account_mdl');
        $user_status = $this->Account_mdl->reg_validate($secure_token);
        
        $token = $this->security_lib->decrypt($secure_token);
        
        $token_data = explode('/', $token);
        $this->_pdata['user_mail'] = $token_data[2];
        $this->_pdata['uid'] = $token_data[0];
        $this->_pdata['token'] = $this->input->get('token');
        
        if($user_status == 1) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Setpassword_view', $this->_pdata);
        } else if($user_status == 2) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_expired_view', $this->_pdata);
        } else {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_invalid_view', $this->_pdata);
        }
    }
    
    public function set_password() {
        $secure_token = $this->input->get('token');
        
        $this->load->model('__admin_account/Account_mdl');
        $user_status = $this->Account_mdl->reg_validate($secure_token);
        
        $token = $this->security_lib->decrypt($secure_token);
        $token_data = explode('/', $token);
        $this->_pdata['user_mail'] = $token_data[2];
        $this->_pdata['uid'] = $token_data[0];
        $this->_pdata['token'] = $this->input->get('token');
        
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]',
                array(
                    'required' => 'Password is Required.',
                    'min_length' => 'Password must contain minimum 5 characters.
                '));
            
            $this->form_validation->set_rules('cpassword', 'Confirm Password','required|matches[password]',
                array(
                    'required' => 'Password Confirmation is Required.',
                    'matches' => 'Password Not Confirm'
                ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors());
            } else {
                $setupd = $this->Account_mdl->set_useraccess($this->input->post());
                $this->session->set_flashdata('msg-success', 'Your Password is set Successfully Now You Eligible to Login');
                
                redirect('admin/account/login');
            }
        }
        
        if($user_status == 1) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Setpassword_view', $this->_pdata);
        } else if($user_status == 2) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_expired_view', $this->_pdata);
        } else {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_invalid_view', $this->_pdata);
        }
    }
}