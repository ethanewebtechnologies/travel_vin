<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Change Password Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Change_password_ctrl extends CI_Controller {
    
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
            '__prjlib/Template_lib',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'encryption'
        ));
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__customer/Change_password', $siteLang);
        $this->lang->load('form_validation', $siteLang);
    }
    
    public function index() {
        if ($this->input->post()) {
            $this->form_validation->set_rules('password', 'lang:text_placeholder_password', 'trim|required', array(
                'required' => $this->lang->line('required')
            ));
                
            $this->form_validation->set_rules('repeat_password', 'lang:text_placeholder_repeat_password', 'required|matches[password]', array(
                'required' => $this->lang->line('required'),
                'matches' => $this->lang->line('matches'),
            ));
                
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->load->model('__customer/Account_mdl');
                $this->Account_mdl->change_password($this->input->post(), $this->input->post('customer_id'));
               redirect('customer/change-password/change_password_success', 'referesh');
            }
        }
        
        if($this->input->get('access_token')) {
            $access_token = $this->input->get('access_token');
            $token = $this->security_lib->decrypt($access_token);
            $token_data = explode('/', $token);
        
            if(count($token_data) == 3) {
                $this->load->model('__customer/Account_mdl');
                $token_status = $this->Account_mdl->audit_token($access_token, $token);    
                if($token_status == 1) {
                    $this->_pdata['token'] = $this->input->get('access_token');
                    
                    $this->_pdata['customer_id']            = $token_data[0];
                    $this->_pdata['token_generated_date']   = $token_data[1];
                    $this->_pdata['customer_email']         = $token_data[2];
                    
                    $this->_pdata['text_update_password']                   = $this->lang->line('text_update_password');
                    $this->_pdata['text_content_submit']                    = $this->lang->line('text_content_submit');
                    
                    $this->_pdata['text_label_password']                    = $this->lang->line('text_label_password');
                    $this->_pdata['text_label_repeat_password']             = $this->lang->line('text_label_repeat_password');
                    
                    $this->_pdata['text_placeholder_password']              = $this->lang->line('text_placeholder_password');
                    $this->_pdata['text_placeholder_repeat_password']       = $this->lang->line('text_placeholder_repeat_password');

                    $this->template_lib->load_view($this, '__customer/Change_password_form_view', $this->_pdata);
                    
                } else if($token_status == 2) {
                    $this->_pdata['text_token_expired'] = $this->lang->line('text_token_expire');
                    $this->template_lib->load_view($this, '__customer/Change_password_denied_view', $this->_pdata);
                } else {
                     $this->_pdata['text_token_expired'] = $this->lang->line('text_token_invalid');
                    $this->template_lib->load_view($this, '__customer/Change_password_denied_view', $this->_pdata);
                }
            } else {
                $this->load->library(array(
                    '__prjlib/Header_lib',
                    '__prjlib/Footer_lib'
                ));
                
                // LOAD VIEW
                $this->header_lib->get_header($this);
                $this->load->view('error401_view');
                $this->footer_lib->get_footer($this);
            }
        } else {
            $this->load->library(array(
                '__prjlib/Header_lib',
                '__prjlib/Footer_lib'
            ));
            
            // LOAD VIEW
            $this->header_lib->get_header($this);
            $this->load->view('error401_view');
            $this->footer_lib->get_footer($this);
        }
    }
	public function change_password_success() {
		$this->_pdata['text_message'] = $this->lang->line('text_message');
		$this->_pdata['text_success_message'] = $this->lang->line('text_success_message');
		$this->_pdata['text_day'] = $this->lang->line('text_day');
        $this->template_lib->load_view($this, '__customer/Change_password_success_view', $this->_pdata);
    }
}