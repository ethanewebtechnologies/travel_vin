<?php
class Payumoney_fore {
    private $cfo; // WHERE cfo - Codeigniter Framenwork Object
    private $payumoney;
    
    public function __construct() {
        $this->cfo = &get_instance();
        $this->cfo->load('library/Payumoney_lib');
        $this->payumoney = $this->cfo->Payumoney_lib;
    }
    
    public function init($data) {
        //Set variables for payumoney form
        $returnURL = base_url() . 'gateway-payment/payumoney/success'; //payment success url
        $cancelURL = base_url() . 'gateway-payment/payumoney/cancel'; //payment cancel url
        
        $post_data['key']				= 'rjQUPktU';
        $post_data['txnid']				= $data['txnid'];
        $post_data['firstname'] 		= $firstname;
        $post_data['amount']			= $total;
        $post_data['surl'] 				= base_url('tournament/register/payUPaymentSuccess');
        $post_data['furl'] 				= base_url('tournament/register/payUPaymentFailure');
        $post_data['service_provider'] 	= 'payu_paisa';
        $post_data['udf1']				= $data['registerid'];
        
        $this->payumoney->payumoney_auto_form($post_data);
    }
}