<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function count_cart_items($count_cart_items = array()) {
	$count = 0;
	
	foreach($count_cart_items['trip_type'] as $key_2 => $trip_type) {
		foreach($trip_type['_pid'] as $key => $_pid) {
			if(!empty($key_2)) {
				$count = $count+1;
			}
		}
	}
	
	return $count;
}

function tour_cart_price_calculator($adult_count, $child_count, $tour_id, $siteLang) {
	
	// Get a reference to the controller object
    $CI = get_instance();
    
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__checkout/Cart_mdl');
	
	$price_subtotal = '';
	$row = $CI->Cart_mdl->get_tour_details_by_tour_id($tour_id, $siteLang);
	$adult_price = $row['adult_deal_price'] > '0' ? $row['adult_deal_price'] : $row['adult_price'];
	$child_price = $row['child_deal_price'] > '0' ? $row['child_deal_price'] : $row['child_price'];
	$price_subtotal = ($adult_count * $adult_price) + ($child_count * $child_price);
	
	return $price_subtotal;
}
	
function shared_trip_cart_price_calculator($adult_count, $trans_trip_type, $hotel_id, $airport_id, $tripid, $siteLang) { 
	// Get a reference to the controller object
    $CI = get_instance();
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__catalog/Transportation_mdl');
	$result = 0;
	if($trans_trip_type=="round_trip"){
		$sum_shared_price = array();
		$sum_private_price = array();
		
		$condition= array("t1.from_location_id"=>$airport_id,"t1.to_location_id"=>$hotel_id);
		
		$condition2=array("t1.to_location_id"=>$airport_id,"t1.from_location_id"=>$hotel_id);
		
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
				
		$query1 = $CI->db->get();
		$row1 = $query1->row_array();
		
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition2);
				
		$query2 = $CI->db->get();
		$row2 = $query2->row_array();
		
		if(!empty($row1) && !empty($row2)){
			$sum_shared_price[] = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
			
			$sum_shared_price[] = $row2['shared_deal_price_per_passenger'] > '0' ? $row2['shared_deal_price_per_passenger'] : $row2['shared_price_per_passenger'];
			
			$result = array_sum($sum_shared_price);
		}	
	}
	else if($trans_trip_type=="air_to_htl_trip"){
		$condition= array("t1.from_location_id"=>$airport_id,"t1.to_location_id"=>$hotel_id);
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
		$query = $CI->db->get();
		$row1 = $query->row_array();
		if(!empty($row1)){				
			$result = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
		}	
	}
	else if($trans_trip_type=="htl_to_air_trip"){
		$condition= array("t1.to_location_id"=>$airport_id,"t1.from_location_id"=>$hotel_id);
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
		$query = $CI->db->get();
		$row1 = $query->row_array();
		if(!empty($row1)){				
			$result = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
		}
	}
	return $result * $adult_count;	
}
	
function private_trip_cart_price_calculator($adult_count, $trans_trip_type, $hotel_id, $airport_id, $tripid, $siteLang){
    
    // Get a reference to the controller object
    $CI = get_instance();
    
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__catalog/Transportation_mdl');
	
	$result = 0;
	
	if($trans_trip_type=="round_trip"){
		$sum_shared_price = array();
		$sum_private_price = array();
		
		$condition= array("t1.from_location_id"=>$airport_id,"t1.to_location_id"=>$hotel_id);
		
		$condition2=array("t1.to_location_id"=>$airport_id,"t1.from_location_id"=>$hotel_id);
		
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
				
		$query1 = $CI->db->get();
		$row1 = $query1->row_array();
		
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition2);
				
		$query2 = $CI->db->get();
		$row2 = $query2->row_array();
		
		if(!empty($row1) && !empty($row2)){
			
			$sum_private_price[] = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
			
			$sum_private_price[] = $adult_price = $row2['private_deal_price_per_passenger'] > '0' ? $row2['private_deal_price_per_passenger'] : $row2['private_price_per_passenger'];
			
			$result = array_sum($sum_private_price);
		}
		
	}
	else if($trans_trip_type=="air_to_htl_trip"){
		$condition= array("t1.from_location_id"=>$airport_id,"t1.to_location_id"=>$hotel_id);
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
		$query = $CI->db->get();
		$row1 = $query->row_array();
		if(!empty($row1)){				
			$result = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
		}	
	}
	else if($trans_trip_type=="htl_to_air_trip"){
		$condition= array("t1.to_location_id"=>$airport_id,"t1.from_location_id"=>$hotel_id);
		$CI->db->select("t1.*")
			->from("tv_transportation_tbl as t1")
				->where($condition);
		$query = $CI->db->get();
		$row1 = $query->row_array();
		if(!empty($row1)){				
			$result = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
		}
	}
	return $result * $adult_count;
}
	
function golf_cart_price_calculator($adult_count,$golf_id, $siteLang){
	
	// Get a reference to the controller object
    $CI = get_instance();
    
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__checkout/Cart_mdl');
	
	$price_subtotal = '';
	$row = $CI->Cart_mdl->get_golf_details_by_golf_id($golf_id, $siteLang);
	$adult_price = $row['adult_deal_price'];
	$price_subtotal = ($adult_count * $adult_price);
	
	return $price_subtotal;
}
	
function restaurant_cart_price_calculator($adult_count, $restaurant_id, $siteLang){
	
	// Get a reference to the controller object
    $CI = get_instance();
    
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__checkout/Cart_mdl');
	
	$price_subtotal = '';
	$row = $CI->Cart_mdl->get_restaurant_details_by_restaurant_id($restaurant_id, $siteLang);
	$adult_price = $row['adult_deal_price'];
	$price_subtotal = ($adult_count * $adult_price);
	
	return $price_subtotal;
}

function club_and_bar_cart_price_calculator($adult_count, $club_and_bar_id, $siteLang) {
	
	// Get a reference to the controller object
    $CI = get_instance();
    
    // You may need to load the model if it hasn't been pre-loaded
    $CI->load->model('__checkout/Cart_mdl');
	
	$price_subtotal = '';
	$row = $CI->Cart_mdl->get_club_and_bar_details_by_club_and_bar_id($club_and_bar_id, $siteLang);
	$adult_price = $row['adult_deal_price'];
	$price_subtotal = ($adult_count * $adult_price);
	
	return $price_subtotal;
}

function apply_coupon_on_single_cart_item($coupon_details, $amount, $coupon_count) {
	
    if(strtolower($coupon_details['coupon_type']) == 'value') {
		$discount = ($coupon_details['coupon_value']) / (int)$coupon_count;
		$total = $amount-$discount;
		
		$return_json = array(
		    'discount' => $discount,
		    'total' => $total,
		    'coupon_type_discount' => null
		);
		
		return json_encode($return_json);
	} else {
		$percentage = (int)$coupon_details['coupon_value'];
		$discount = ($percentage / 100) * $amount;
		$total = $amount-$discount;
		
		$return_json = array(
		    'discount' => $discount,
		    'total' => $total,
		    'coupon_type_discount' => $percentage
		);
		
		return json_encode($return_json);
	}
}

function apply_coupon_on_total_amount($coupon_details,$total_amount) {
	if(strtolower($coupon_details['coupon_type']) == 'value') {
		$discount = $coupon_details['coupon_value'];
		if($discount>$total_amount){
			$total = $total_amount;
		}
		else{
			$total = $total_amount-$discount;
		}
		
		$return_json = array(
		    'discount' => $discount,
		    'total' => $total,
		    'coupon_type_discount' => null
		);
		
		return json_encode($return_json);
	} else {
		$percentage = (int)$coupon_details['coupon_value'];
		$discount = ($percentage / 100) * $total_amount;
		if($discount>$total_amount){
			$total = $total_amount;
		}
		else{
			$total = $total_amount-$discount;
		}
		
		$return_json = array(
		    'discount' => $discount,
		    'total' => $total,
		    'coupon_type_discount' => $percentage
		);
		
		return json_encode($return_json);
	}
}

function get_total_cart_amount() {
	
	$CI = get_instance();
	
	if(!$CI->session->has_userdata('site_lang')) {
		$siteLang = 'en';
	} else {
		$siteLang = $CI->session->userdata('site_lang');
	}
	
	$CI->load->model('__checkout/Cart_mdl');
	$CI->load->helper('cookie');
	 
	$cartToken = get_cookie('_cart_token');
	$view_cart_data = $CI->Cart_mdl->get_cart_data_by_cart_token($cartToken);
	$only_cart_data = json_decode($view_cart_data['_cart_data__'], true);
	
	$price_grandtotal = 0;
	
	if(isset($only_cart_data) && $only_cart_data != '') {
		
		$total_cart_items = count_cart_items($only_cart_data);
		
		foreach($only_cart_data['trip_type'] as $key_2 => $value1) {
			
			foreach($value1['_pid'] as $key => $value) {
				
				if(strtolower($key_2) == "sharing") {
					$single_item_price = shared_trip_cart_price_calculator($value['no_of_adults'], $value['transport_trip_type'], $value['hotel_id'], $value['airport_id'], $key, $siteLang);
				} else if(strtolower($key_2) == "private") {
					$single_item_price = private_trip_cart_price_calculator($value['no_of_adults'], $value['transport_trip_type'], $value['hotel_id'], $value['airport_id'], $key, $siteLang);
				} else if(strtolower($key_2) == "golf") {
					$single_item_price = golf_cart_price_calculator($value['no_of_adults'], $key, $siteLang);
				} else if(strtolower($key_2) == "restaurant") {
					$single_item_price = restaurant_cart_price_calculator($value['no_of_adults'], $key, $siteLang);
				} else if(strtolower($key_2) == "tour") {
					$single_item_price = tour_cart_price_calculator($value['no_of_adults'], $value['no_of_childs'], $key, $siteLang);
				} else if(strtolower($key_2) == "club_and_bar") {
					$single_item_price = club_and_bar_cart_price_calculator($value['no_of_adults'], $key, $siteLang);
				}
				
				$price_grandtotal += $single_item_price;
			}
		}
	}
	
	return $price_grandtotal;
}	
