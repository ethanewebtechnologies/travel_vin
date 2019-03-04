<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Login Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Login_ctrl extends CI_Controller {
    /* private instance an array */
    
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation', 
            '__prjlib/Template_lib'
        ));
        
        $this->load->helper(array(
            'form', 
            'dt'
        ));
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__customer/Login', $siteLang);
        $this->lang->load('__default/Home', $siteLang);
        $this->lang->load('form_validation', $siteLang);
    }
    
    public function index() {
        if($this->input->is_ajax_request() && $this->input->post('user_submit') == 'Login') {
            $this->form_validation->set_rules('user_email', 'lang:text_email', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
            
            $this->form_validation->set_rules('user_password', 'lang:text_password', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
            
            if($this->form_validation->run()) {
                $this->load->model('__customer/Account_mdl');
                $flag = $this->Account_mdl->verify_customer($this->input->post());
                
                if ($flag) {
                    $current_path = $this->input->post('current_path');
                    
                    if(isset($current_path) && strlen($current_path) > 0) {
                        $url = $current_path;
                    } else {
                        $url = 'customer/dashboard';
                    }
					$php_data['url'] = $url;
                    //redirect($url, 'refresh');
                } 
				else {
                    $php_data['verification_error'] = $this->lang->line('text_verification_error');
                }
            } 
			else {
                $php_data['validation_error'] = $this->lang->line('text_validation_error');
                $php_data['email_error'] = $this->lang->line('text_email_error');
                $php_data['password_error'] = $this->lang->line('text_password_error');
				
            }
        }
        
        $php_data['secure_token'] = $this->security->get_csrf_token_name();
        $php_data['secure_hash'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
    }
	
	public function logout(){
		$this->session->unset_userdata('customer');
		$this->session->unset_userdata('__idCus');
		$this->session->unset_userdata('__transactionCusId');
		$current_path = $this->input->post('current_path'); 
		if(isset($current_path) && strlen($current_path) > 0) {
			$url = $current_path;
		} 
		else {
			$url = base_url();
		}
	
		// SUCCESS
		$result = array(
			'type' => 'success',
			'url' => $url,
			'secure_token' => $this->security->get_csrf_token_name(),
			'secure_hash' => $this->security->get_csrf_hash()
		);
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}