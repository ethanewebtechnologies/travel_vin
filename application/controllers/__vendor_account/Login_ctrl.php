<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Vendor Login Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Login_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjvendorlib/Template_lib',
            '__commonlib/Security_lib',
        ));
        
        $this->load->helper(array(
            'form',
            'html'
        ));
		$siteLang = $this->session->userdata('site_lang');
		$this->lang->load('__customer/Login', $siteLang);
    }
    
    public function index() {
        if($this->session->has_userdata('vendor')) {
            redirect('vendor/home/dashboard');
        }
        
        $this->load->model('__vendor_account/Login_mdl');
        
        if($this->Login_mdl->has_any_vendor()) {
            if ($this->input->post()) {
                
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required');
                
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('error_msg', validation_errors());
                } else {
                    $flag = $this->Login_mdl->validate_vendor($this->input->post('email'), $this->input->post('password'), $this->input->post('remember'));
                    
                    if ($flag) {
                        
                        $vendor = $this->session->userdata('vendor');
                        
                        if($vendor['approved'] == 1 && $vendor['status'] == 1) {
                            $prevurl = $this->session->userdata('prev_url');
                            
                            if(isset($prevurl) && strlen($prevurl) > 0) {
                                $url = $prevurl;
                            } else {
                                $url = 'vendor/home/dashboard';
                            }
                            
                            redirect($url, 'refresh');
                        } else if($vendor['approved'] == 1) { 
                            $this->session->set_flashdata('error_msg', 'Your account is suspended! Contact Administrator.');
                            $this->session->unset_userdata('vendor');
                        } else {
                            $this->session->set_flashdata('error_msg', 'Your Account has not approved by Admin Yet. Kindly contact to Administrator.');
                            $this->session->unset_userdata('vendor');
                        }
                    } else {
                        $this->session->set_flashdata('error_msg', 'Invalid Login Credentials');
                    }
                }
            }
        }
        
        $this->template_lib->load_view_before_login($this, '__vendor_account/Login_view');
    }
    
    public function ajax_login() {
        if($this->input->is_ajax_request() && $this->input->post('vendor_submit') == 'Login') {
            $this->form_validation->set_rules('vendor_email', 'Vendor Email', 'trim|required', array(
                'required' => 'Email Required',
            ));
            
            $this->form_validation->set_rules('vendor_password', 'Vendor Password', 'trim|required', array(
                'required' => 'Password Required',
            ));
            
            if($this->form_validation->run()) {
                
                $this->load->model('__vendor_account/Login_mdl');
                $flag = $this->Login_mdl->validate_vendor($this->input->post('vendor_email'), $this->input->post('vendor_password'), FALSE);
                
                if ($flag) {
                    //$current_path = $this->input->post('current_path');
                    $php_data['url'] = base_url('vendor/home/dashboard');
                } else {
                    $php_data['verification_error'] = $this->lang->line('text_verification_error');
                }
            } else {
                $php_data['validation_error'] = $this->lang->line('text_validation_error');
               $php_data['email_error'] = $this->lang->line('text_email_error');
                $php_data['password_error'] = $this->lang->line('text_password_error');
            }
        }
        $php_data['secure_token'] = $this->security->get_csrf_token_name();
        $php_data['secure_hash'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
    }
}