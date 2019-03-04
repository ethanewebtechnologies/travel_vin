<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Paypal Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Paypal extends CI_Controller {
	
	private $_pdata = array();
    private $_cartToken;
    private $siteLang;
    
    public function __construct() {
        parent::__construct();
		
        $this->load->library(array(
            '__prjlib/Template_lib',
            '__commonlib/Security_lib',
			'gateway/Payment',
			'gateway/Paypal_lib'
        ));
        
        $this->load->helper(array('cookie', 'dt', 'cart_price_calculator', 'coupon'));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        $siteLang = $this->session->userdata('site_lang');
    }
	
	public function index(){
		if($this->input->is_ajax_request()) {
		    $this->_pdata['paypalUrl'] = "https://www.sandbox.paypal.com/cgi-bin/webscr";
			$this->_pdata['paypal_id'] = 'gauravsh8790@gmail.com';
			$this->_pdata['item_name'] = 'Travel Vin';
			$this->_pdata['return_url'] = base_url('gateway/payment/paypal/success');
			
			$siteLanguage = $this->session->userdata('site_lang');
			$cart_token = get_cookie('_cart_token');
			
			$this->load->model('__checkout/Cart_mdl');
			$cart_data = $this->Cart_mdl->get_cart_data_by_cart_token($cart_token);
			
			if(!empty($cart_data['_coupon_code__'])){
				$has_coupon_code = $cart_data['_coupon_code__'];
				$is_valid_coupon = validate_coupon($has_coupon_code);
			}
			else{
				$is_valid_coupon = false;
			}
			
			$only_cart_data = json_decode($cart_data['_cart_data__'], true);
			
			$adult['price'] = array();
			
			foreach($only_cart_data['trip_type'] as $key_2 => $value1) {
				foreach($value1['_pid'] as $key => $data) {
					if(strtolower($key_2)=="sharing"){
						$adult['price'][] = shared_trip_cart_price_calculator($data['no_of_adults'], $data['transport_trip_type'], $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
					}else if(strtolower($key_2)=="private"){
						$adult['price'][] = private_trip_cart_price_calculator($data['no_of_adults'], $data['transport_trip_type'], $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
					}else if(strtolower($key_2)=="golf"){
						$adult['price'][] = golf_cart_price_calculator($data['no_of_adults'],$key,$siteLanguage);
					}
					else if(strtolower($key_2)=="tour"){
						$adult['price'][] = tour_cart_price_calculator($data['no_of_adults'],$data['no_of_childs'],$key,$siteLanguage);
					}else if(strtolower($key_2)=="restaurant"){
					    $adult['price'][] = restaurant_cart_price_calculator($data['no_of_adults'],$key,$siteLanguage);
					}else if(strtolower($key_2)=="club_and_bar"){
					    $adult['price'][] = club_and_bar_cart_price_calculator($data['no_of_adults'],$key,$siteLanguage);
					}
					
				}
			}
			
			$adultprice = array_sum($adult['price']);
			
			if($is_valid_coupon){
				$coupon_details = $this->Cart_mdl->get_coupon_details_by_coupon_code($has_coupon_code);
				$price_grandtotal = $adultprice;
				$return_total_amount = json_decode(apply_coupon_on_total_amount($coupon_details,$price_grandtotal),true);
				$this->_pdata['totalprice'] = $return_total_amount['total'];				
			}
			else{
				$this->_pdata['totalprice'] = $adultprice;
			}
			
			$this->_pdata['html'] = $this->load->view('__gateway_payment/Paypal', $this->_pdata, TRUE);
			
			$this->output->set_content_type('application/json')->set_output($this->_pdata['html']);
		}
		else {
		    exit('No direct script access allowed');
		}
	}
    
    public function success() {
        $xtn_cs_init = $this->input->get('_xtn_cs_init');
        $this->payment->success($xtn_cs_init);
    }
         
    public function cancel() {
        $this->load->view('__gatwway_payment/paypal_cancel');
    }
         
    function ipn() {
        //paypal return transaction details array
        $paypalInfo = $this->input->post();

        $data['user_id'] = $paypalInfo['custom'];
        $data['product_id'] = $paypalInfo["item_number"];
        $data['txn_id']    = $paypalInfo["txn_id"];
        $data['payment_gross'] = $paypalInfo["payment_gross"];
        $data['currency_code'] = $paypalInfo["mc_currency"];
        $data['payer_email'] = $paypalInfo["payer_email"];
        $data['payment_status'] = $paypalInfo["payment_status"];

        $paypalURL = $this->paypal_lib->paypal_url;        
        $result    = $this->paypal_lib->curlPost($paypalURL, $paypalInfo);
            
        //check whether the payment is verified
        if(preg_match("/VERIFIED/i", $result)) {
            //insert the transaction data into the database
            $this->product->insertTransaction($data);
        }
    }
}
