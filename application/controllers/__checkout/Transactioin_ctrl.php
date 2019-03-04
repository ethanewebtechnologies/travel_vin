<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transaction Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Transaction_ctrl extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            '__commonlib/Security_lib',
        ));
        
        $this->load->helper(array('cookie', 'dt'));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->load->model('__checkout/Transaction_mdl');
	}
    
    public function init() {
		echo('gfgv');
        if ($this->input->is_ajax_request()) {
            $transaction_no = $this->Transaction_mdl->init();
            $cookie_token = get_cookie('_cart_token');
            
            /* FETCH CUSTOMER ID FROM SESSION AND THEN SET */
			$customer_id = $this->session->userdata('__transactionCusId');
            
            $_xtn_cs_init = $cookie_token + "-+-" + $customer_id + "-+-" + $transaction_no;
            
            $php_data = array(
                'xtn_cs_init' => $this->security_lib->encrypt($_xtn_cs_init),
                'security_token' => $this->security->get_csrf_token_name(),
                'security_hash' => $this->security->get_csrf_hash()
            );
			
            $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
        }
    }
    
    public function pending() {
        $this->Transaction_mdl->pending($transaction_no);
    }
    
    public function failed() {
        $this->Transaction_mdl->failed($transaction_no);
    }
    
    public function complete() {
        $this->Transaction_mdl->complete($transaction_no);
    }
} 