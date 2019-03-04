<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Payumoney Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Payumoney extends CI_Controller {
    public function  __construct() {
        parent::__construct();
        $this->load->library('paypal_lib');
        $this->load->model('product');
    }
    
    public function success() {
        $data['registerid'] = $this->input->post('udf1');
        $data['txnid'] = $this->input->post('txnid');
        
        $_POST['tourURL'] = $this->product->updatePaymentStatus($data);
        
        $this->load->view('__gatwway_payment/payumoney_success');
    }
    
    public function failure() {
        $data['registerid'] = $this->input->post('udf1');
        $data['txnid'] = $this->input->post('txnid');
        
        $_POST['tourURL'] = $this->product->updatePaymentFStatus($data);
        $this->load->view('__gatwway_payment/payumoney_failure');
    }
}