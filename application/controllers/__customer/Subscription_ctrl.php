<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Subscription Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Subscription_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            '__prjlib/Template_lib',
            'form_validation',
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'encryption'
        ));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load('__customer/Registration', $siteLang);
        $this->lang->load('form_validation', $siteLang);
    }
    
    public function index() {
        if($this->input->is_ajax_request()) {
            $this->form_validation->set_rules('subscriber_email', 'lang:text_email', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
            if($this->form_validation->run()) {
                $this->load->model('__customer/Subscription_mdl');
				if($this->is_subscribed($this->input->post())){
					$this->session->set_flashdata('__es_error', $this->lang->line('text_error_subscription_exist'));
				}
				else{
					$flag = $this->Subscription_mdl->subscribe_email($this->input->post());
					if ($flag) {
						$this->session->set_flashdata('__es_success', $this->lang->line('text_success_subscription'));
					} 
					else {
						$this->session->set_flashdata('__es_error', $this->lang->line('text_error_subscription'));
					}
				}
				$current_path = $this->input->post('current_path');
				if(isset($current_path) && strlen($current_path) > 0) {
					$url = $current_path;
				} else {
					$url = base_url();
				}
				$php_data['url'] = $url;
            } 
			else {
                $php_data['validation_error'] = 'TRUE';
                $php_data['email_error'] = validation_errors();
            }
        }
        $php_data['secure_token'] = $this->security->get_csrf_token_name();
        $php_data['secure_hash'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
    }
	
	public function is_subscribed($post_data){
		$this->load->model('__customer/Subscription_mdl');
        $count = $this->Subscription_mdl->verify_subscriber($post_data);
		if($count>0){
			return true;
		}
		else{
			return false;
		}
	}
}
