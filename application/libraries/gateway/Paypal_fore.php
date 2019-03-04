<?php
class Paypal_fore {
    
    private $cfo; // WHERE cfo - Codeigniter Framenwork Object
    private $paypal;
    
    public function __construct() {
        $this->cfo = &get_instance();
        $this->cfo->load('library/Paypal_lib');
        $this->paypal = $this->cfo->Paypal_lib;
    }
    
    public function init($data) {
        //Set variables for paypal form
        $returnURL = base_url() . 'gateway-payment/paypal/success'; //payment success url
        $cancelURL = base_url() . 'gateway-payment/paypal/cancel'; //payment cancel url
        $notifyURL = base_url() . 'gateway-payment/paypal/ipn'; //ipn url
        
        $this->paypal->add_field('return', $returnURL);
        $this->paypal->add_field('cancel_return', $cancelURL);
        $this->paypal->add_field('notify_url', $notifyURL);
        $this->paypal->add_field('item_name', $data['name']);
        $this->paypal->add_field('custom', $data['userid']);
        $this->paypal->add_field('item_number',  $data['id']);
        $this->paypal->add_field('amount',  $data['price']);
        $this->paypal->image($data['image']);
        
        $this->paypal->paypal_auto_form();
    }
}