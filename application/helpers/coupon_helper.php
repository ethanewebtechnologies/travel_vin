<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function validate_coupon($coupon_code){
	// Get a reference to the controller object
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__checkout/Cart_mdl');
	
	$coupon_details = $CI->Cart_mdl->get_coupon_details_by_coupon_code($coupon_code);
	
	if(empty($coupon_details)){
		return false;
	}
	elseif($coupon_details['no_of_coupon']==0){
		return false;
	}
	elseif(time() < strtotime($coupon_details['coupon_start_date'])){
		return false;
	}
	elseif(time() > strtotime($coupon_details['coupon_end_date'])){
		return false;
	}
	else{
		return true;
	}
}