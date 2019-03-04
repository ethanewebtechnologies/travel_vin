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
        
        if($this->session->has_userdata('customer')) {
            redirect(base_url(), 'refresh');
        }
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjlib/Template_lib'
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
        
        $this->lang->load(array(
            '__customer/Forget_password', 
            'form_validation'
        ), $siteLang);
    }
    
    public function index() {
        
        if($this->input->post()) {
            $this->form_validation->set_rules('email', 'lang:text_email', 'trim|required', array(
                'required' => $this->lang->line('required')
            ));
            
            if($this->form_validation->run()) {
                $this->load->model('__customer/Account_mdl');
                $access_token = $this->Account_mdl->validate_customer_email($this->input->post('email'));
                
                if($access_token) {
                    $this->change_password_request($this->input->post('email'), $access_token);
                    redirect('customer/forget-password/request-accepted', 'referesh');
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
        $this->_pdata['text_label_email_your_password_change']=  $this->lang->line('text_label_email_your_password_change');
        
        $this->template_lib->load_view($this, '__customer/Forget_password_view', $this->_pdata);
    }
    
    public function request_accepted() {
        $this->_pdata['text_email_your_password_change']    =  $this->lang->line('text_email_your_password_change');
        $this->template_lib->load_view($this, '__customer/Request_accepted_view', $this->_pdata);
    }
    
    private function change_password_request($email, $access_token) {
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load(array(
            '__customer/Forget_password', 
            'common'), 
        $siteLang);
       
        $this->load->model('__customer/Account_mdl');
        $customer = $this->Account_mdl->get_user_details_by_email($email);
        
        $change_password_link = base_url('customer/change-password?access_token=' . $access_token);
        
        $this->_pdata = array(
            'customer_name' => $customer['firstname'] . ' ' . $customer['lastname'],
            'change_password_link' => $change_password_link,
        );
        
        $this->_pdata['text_reset_password']  = $this->lang->line('text_reset_password');
        $this->_pdata['text_reset_your_password']  = $this->lang->line('text_reset_your_password');
        $this->_pdata['text_click_here']  = $this->lang->line('text_click_here');
        $this->_pdata['text_hey']  = $this->lang->line('text_hey');
        $this->_pdata['text_email_thanks']  = $this->lang->line('text_email_thanks');
        $this->_pdata['text_email_admin']  = $this->lang->line('text_email_admin');
        $this->_pdata['text_email_poweredby']  = $this->lang->line('text_email_poweredby');
        $this->_pdata['text_ethane_web_technologies']  = $this->lang->line('text_ethane_web_technologies');
        
        
        $from = ADMIN_EMAIL;
        $from_title = $this->lang->line('text_sunshine_administrator');
        $to = $email;
        $subject = $this->lang->line('text_change_password_link');
        $body = $this->load->view('__email_template/Customer_change_password_email', $this->_pdata, TRUE);
        
        if($to != "") {
            $this->load->library('__commonlib/Email_lib');
            $this->email_lib->send($from, $to, $subject, $body, $from_title, '');
        } else {
            exit('SYSTEM ERROR');
        }
    }
}
