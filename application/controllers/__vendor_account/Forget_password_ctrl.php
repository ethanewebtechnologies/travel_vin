<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Forget Password Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Forget_password_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if($this->session->has_userdata('vendor')) {
            redirect(base_url(), 'refresh');
        }
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjlib/Template_lib',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'encryption'
        ));
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__vendor_account/Forget_password', $siteLang);
        $this->lang->load('form_validation', $siteLang);
		$this->lang->load('common', $siteLang);
    }
    
    public function index() {
        
        if($this->input->post()) {
            $this->form_validation->set_rules('email', 'lang:text_email', 'trim|required', array(
                'required' => $this->lang->line('required')
            ));
            
            if($this->form_validation->run()) {
                $this->load->model('__vendor_account/Manage_mdl');
                $access_token = $this->Manage_mdl->validate_vendor_email($this->input->post('email'));
                
                if($access_token) {
                    $this->change_password_request($this->input->post('email'), $access_token);
                    redirect('vendor/account/forget-password/request-accepted', 'referesh');
                } else {
                    $this->_pdata['invalid_email'] = $this->lang->line('text_email_not_exist');
                    $this->session->set_flashdata('validation_failed', TRUE);
                }
            } else {
                $this->session->set_flashdata('validation_failed', TRUE);
            }
        }
        
        $this->_pdata['text_email']                         =  $this->lang->line('text_email');
        $this->_pdata['text_validation_errors']             =  $this->lang->line('text_validation_errors');
        $this->_pdata['text_confirm_email_title']           =  $this->lang->line('text_confirm_email_title');
        $this->_pdata['text_content_submit']                =  $this->lang->line('text_content_submit');
        
        $this->_pdata['text_placeholder_email']             =  $this->lang->line('text_placeholder_email');
        $this->_pdata['text_placeholder_repeat_email']      =  $this->lang->line('text_placeholder_repeat_email');
        
        $this->_pdata['text_label_email']                   =  $this->lang->line('text_label_email');
        $this->_pdata['text_label_repeat_email']            =  $this->lang->line('text_label_repeat_email');
        

        $this->template_lib->load_view($this, '__vendor_account/Forget_password_view', $this->_pdata);
    }
    
    public function request_accepted() {
		$this->_pdata['text_request_accept_msg'] =  $this->lang->line('text_request_accept_msg');
        $this->template_lib->load_view($this, '__vendor_account/Request_accepted_view', $this->_pdata);
    }
    
    private function change_password_request($email, $access_token) {
        
        $this->load->model('__vendor_account/Manage_mdl');
        $vendor = $this->Manage_mdl->get_vendor_details_by_email($email);
        $change_password_link = base_url('vendor/account/change-password?access_token=' . $access_token);
        
        $data = array(
            'vendor_name' => $vendor['company_legal_name'],
            'reset_link' => $change_password_link,
			'click_text' => $this->lang->line('click_text'),
			'message' => $this->lang->line('password_reset_message'),
			'text_email_thanks' => $this->lang->line('text_email_thanks'),
			'text_email_admin' => $this->lang->line('text_email_admin'),
			'text_email_poweredby' => $this->lang->line('text_email_poweredby'),
			'text_customer_greeting' => $this->lang->line('text_customer_greeting'),
			
        );
        
        $from = ADMIN_EMAIL;
        $from_title = $this->lang->line('From_title_email');
        $to = $email;
        $subject = $this->lang->line('password_reset_subject');
        $body = $this->load->view('__email_template/Vendor_change_password_email', $data, TRUE);
        
        if($to != "") {
            $this->load->library('__commonlib/Email_lib');
            $this->email_lib->send($from, $to, $subject, $body, $from_title, '');
        } else {
            exit('SYSTEM ERROR');
        }
    }
	
}
