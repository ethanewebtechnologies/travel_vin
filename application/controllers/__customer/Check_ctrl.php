<?php
class Check_ctrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        //get particular product data
        $product = $this->product->getRows($id);
        $userID = 1; //current user id
        $logo = base_url().'assets/images/codexworld-logo.png';
        
        $payment_data['name'] = $product['name'];
        $payment_data['id'] = $product['id'];
        $payment_data['price'] = $product['price'];
        $payment_data['userid'] = $userID;
        $payment_data['image'] = $logo;
        
        $this->load->library('gateway/payment');
        $this->payment->init($payment_data, 'paypal');
    }
}