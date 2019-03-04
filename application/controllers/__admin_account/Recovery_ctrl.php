<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: RECOVER CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Recovery_ctrl extends CI_Controller {
    
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
            'form', 'Encryption_helper', 'dt'
        ));
        
        $this->load->model('__admin_account/Account_mdl');
        $this->lang->load('__admin_account/Login', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        if($this->session->has_userdata('user')) {
            redirect('admin/default/dashboard');
        }
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email', array(
                    'required' => 'Your Email is Not Valid.',
                    'valid_email' => 'Not a valid Email'
                ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('error_msg', validation_errors());
            } else {
                $check_email = $this->Account_mdl->check_email_forget_password($this->input->post('email'));
                
                if (!empty($check_email)) {
                    $now = date('Y-m-d H:i:s');
                    $access_token = $this->security_lib->encrypt($check_email['id'] . '/' . $now . '/' . $check_email['email']);
                    
                    $update = $this->Account_mdl->add_accesstoken($access_token, $check_email);
                    
                    if ($update) {
                        $message['customer_name'] = $check_email['firstname'] . ' ' . $check_email['lastname'];
                        $message['access_token'] = $access_token;                      
                        $from = 'mansi@ethanetechnologies.org';
                        $from_title = 'Sunshine Administrator';
                        $to = $check_email['email'];
                        $subject = "Reset Password";

						$body = $this->load->view('__email_template/Change_password_email', $message, TRUE);
                        
                        if($to != "") {
                            $this->load->library('__commonlib/Email_lib');
                            $this->email_lib->send($from, $to, $subject, $body, $from_title);
                        }
                        
                        $this->session->set_flashdata('msg-success', "You request has been submitted successfully! We will send you a mail with a recovery link.");
                        redirect(base_url('admin/account/login'));
                    }
                } else {
                    $this->session->set_flashdata('error_msg', 'You have not provided a Registered Email.');
                    redirect(base_url('admin/account/recovery'));
                }
            }
        }
        
        $this->template_lib->load_view_before_login($this, '__admin_account/Password_recover_view', array());
    }
    
    public function reset_password() {
        $userstatus = $this->Account_mdl->reg_validate2($this->input->get('token'));
        $token = $this->security_lib->decrypt($this->input->get('token'));
        $data['token'] = $this->input->get('token');
        $token_data = explode('/', $token);
        $data['user_mail'] = $token_data[2];
        $data['u_entityid'] = $token_data[0];
        
        if ($this->input->post()) {
            
            $this->form_validation->set_rules('password', 'Password', 'trim|required', array(
                'required' => 'Password is Required.'
            ));
            
            $this->form_validation->set_rules('confirm_password', 'Password Confirmation', 'trim|required|matches[password]', array(
                'required' => 'Password Confirmation is Required.', 
                'matches' => 'Password Not Confirm'
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('password_required', TRUE);
            } else {
                $post_data = array(
                    'password' => $this->input->post('password'),
                    'userid' => $data['u_entityid'],
                    'usermail' => $data['user_mail']
                );
                
                $setupd = $this->Account_mdl->set_useraccess($post_data, $data['token']);
                $this->session->set_flashdata('reset_password_successfully', TRUE);
                redirect('admin/account/login');
            }
        }
        
        if ($userstatus == 1) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Reset_password_view', $data);
        } else if ($userstatus == 2) {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_expired_view', $this->_pdata);
        } else {
            $this->template_lib->load_view_before_login($this, '__admin_account/Token_invalid_view', $this->_pdata);
        }
    }
}