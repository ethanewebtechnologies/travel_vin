<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Cart Controller
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, MANSI JAIN, BIJENDRA SINGH, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Cart_ctrl extends CI_Controller {
    private $_pdata = array();
    private $_cartToken;
	private $siteLang;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
			'form_validation',
            '__prjlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized'
        ));
        
        $this->load->helper(array(
            'form', 
            'cookie', 
            'dt', 
            'cart_price_calculator', 
            'coupon'
        ));
        
        //$this->siteLang = $this->session->userdata('site_lang');
		
		if(!$this->session->has_userdata('site_lang')) {
            $this->siteLang = 'en';
        } else {
            $this->siteLang = $this->session->userdata('site_lang');
        }
		
        $this->lang->load('__checkout/Cart', $this->siteLang);
    }
	
	public function index() {
		$this->load->model('__checkout/Cart_mdl');
		$this->_pdata['view_cart_data'] = '';
		
		$this->_pdata['text_shopping_cart'] = $this->lang->line('text_shopping_cart');
		$this->_pdata['text_your_information'] = $this->lang->line('text_your_information');
		$this->_pdata['text_confirmation'] = $this->lang->line('text_confirmation');
		$this->_pdata['text_payment_method'] = $this->lang->line('text_payment_method');
		$this->_pdata['text_continue'] = $this->lang->line('text_continue');
		
		$this->template_lib->load_view($this, '__checkout/Cart_view', $this->_pdata);
    }
	
	public function get_ajax_cart_data() {
		$this->load->model('__checkout/Cart_mdl');
		$this->_pdata['text_th_title'] = $this->lang->line('text_th_title');
		$this->_pdata['text_th_adults'] = $this->lang->line('text_th_adults');
		$this->_pdata['text_th_children'] = $this->lang->line('text_th_children');
		$this->_pdata['text_th_amount'] = $this->lang->line('text_th_amount');
		$this->_pdata['text_th_action'] = $this->lang->line('text_th_action');
		$this->_pdata['text_na'] = $this->lang->line('text_na');
		$this->_pdata['text_promo_code'] = $this->lang->line('text_promo_code');
		$this->_pdata['text_remove_coupon'] = $this->lang->line('text_remove_coupon');
		$this->_pdata['text_apply_coupon'] = $this->lang->line('text_apply_coupon');
		$this->_pdata['text_coupon'] = $this->lang->line('text_coupon');
		$this->_pdata['text_empty_cart'] = $this->lang->line('text_empty_cart');
		$this->_pdata['text_confirm_modal'] = $this->lang->line('text_confirm_modal');
		$this->_pdata['text_modal_delete'] = $this->lang->line('text_modal_delete');
		$this->_pdata['text_modal_delete_yes'] = $this->lang->line('text_modal_delete_yes');
		$this->_pdata['text_modal_delete_no'] = $this->lang->line('text_modal_delete_no');
		$this->_pdata['text_placeholder_promocode'] = $this->lang->line('text_placeholder_promocode');
		$this->_pdata['text_sub_total'] = $this->lang->line('text_sub_total');
		$this->_pdata['text_continue'] = $this->lang->line('text_continue');
		$this->_pdata['text_statement'] = $this->lang->line('text_statement');
		$this->_pdata['text_success'] = $this->lang->line('text_success');
		$this->_pdata['text_error'] = $this->lang->line('text_error');
		if($this->input->is_ajax_request()) {
			$this->_cartToken = get_cookie('_cart_token');
			$this->_pdata['view_cart_data'] = $this->Cart_mdl->get_cart_data_by_cart_token($this->_cartToken);
			$this->_pdata['only_cart_data'] = json_decode($this->_pdata['view_cart_data']['_cart_data__'], true);
			
			$price_grandtotal = 0;
			
			if(!empty($this->_pdata['view_cart_data']['_coupon_code__'])) {
				$has_coupon_code = $this->_pdata['view_cart_data']['_coupon_code__'];
				$is_valid_coupon = validate_coupon($has_coupon_code);
			} else {
				$is_valid_coupon = false;
			}
			
			if(isset($this->_pdata['only_cart_data']) && $this->_pdata['only_cart_data'] != '') {
				
			    $total_cart_items = count_cart_items($this->_pdata['only_cart_data']);
				
				foreach($this->_pdata['only_cart_data']['trip_type'] as $key_2 => $value1) {
					
				    foreach($value1['_pid'] as $key => $value) {
						
				        if(strtolower($key_2) == "sharing") {
							$single_item_price = shared_trip_cart_price_calculator($value['no_of_adults'], $value['transport_trip_type'], $value['hotel_id'], $value['airport_id'], $key, $this->siteLang);
						} else if(strtolower($key_2) == "private") {
							$single_item_price = private_trip_cart_price_calculator($value['no_of_adults'], $value['transport_trip_type'], $value['hotel_id'], $value['airport_id'], $key, $this->siteLang);
						} else if(strtolower($key_2) == "golf") {
						    $single_item_price = golf_cart_price_calculator($value['no_of_adults'], $key, $this->siteLang);
						} else if(strtolower($key_2) == "restaurant") {
						    $single_item_price = restaurant_cart_price_calculator($value['no_of_adults'], $key, $this->siteLang);
						} else if(strtolower($key_2) == "tour") {
							$single_item_price = tour_cart_price_calculator($value['no_of_adults'], $value['no_of_childs'], $key, $this->siteLang);
						} else if(strtolower($key_2) == "club_and_bar") {
							$single_item_price = club_and_bar_cart_price_calculator($value['no_of_adults'], $key, $this->siteLang);
						}
						
						if(strtolower($key_2) == "sharing") {
							$row = $this->Cart_mdl->get_shared_transportation_details_by_trip_id($key, $this->siteLang);
						} else if(strtolower($key_2) == "private") {
							$row = $this->Cart_mdl->get_private_transportation_details_by_trip_id($key, $this->siteLang);
						} else if(strtolower($key_2) == "golf") { 
						    $row = $this->Cart_mdl->get_golf_details_by_golf_id($key, $this->siteLang);
						} else if(strtolower($key_2) == "restaurant") {
						    $row = $this->Cart_mdl->get_restaurant_details_by_restaurant_id($key, $this->siteLang);
						} else if(strtolower($key_2) == "tour") {
							$row = $this->Cart_mdl->get_tour_details_by_tour_id($key,$this->siteLang);
						} else if(strtolower($key_2) == "club_and_bar") {
							$row = $this->Cart_mdl->get_club_and_bar_details_by_club_and_bar_id($key, $this->siteLang);
						}
						
						$price_subtotal = $this->_pdata['only_cart_data']['trip_type'][$key_2]['_pid'][$key]['subtotal_price'] = $single_item_price;
						
						if(strtolower($key_2) == "sharing" || strtolower($key_2) == "private") {
							if($value['transport_trip_type'] == 'round_trip') {
								$trip_type = 'Round Trip';
							}
							
							if($value['transport_trip_type'] == 'air_to_htl_trip') {
								$trip_type = 'Airport To Hotel';
							}
							
							if($value['transport_trip_type'] == 'htl_to_air_trip') {
								$trip_type = 'Hotel To Airport';
							}
							
							$airport = $this->Cart_mdl->get_airport($value['airport_id']);
							$hotel = $this->Cart_mdl->get_hotel($value['hotel_id']);
							
							$title = ucfirst($key_2) . ', ' . '('.$trip_type .',' . $airport['name'] . ' To ' . $hotel['name'] . ')';
							$this->_pdata['only_cart_data']['trip_type'][$key_2]['_pid'][$key]['title'] = $title;
						} else {
							$this->_pdata['only_cart_data']['trip_type'][$key_2]['_pid'][$key]['title'] = isset($row['title']) ? $row['title'] . ', ' . $row['country_name'] . ', ' . $row['city_name'] : '';
						}
						
						$this->_pdata['only_cart_data']['trip_type'][$key_2]['_pid'][$key]['image'] = $row['image'];
						
						$price_grandtotal += $price_subtotal;
					}
				}
				
				if($is_valid_coupon) {
					
				    $coupon_details = $this->Cart_mdl->get_coupon_details_by_coupon_code($has_coupon_code);
					
					$return_total_amount = json_decode(apply_coupon_on_total_amount($coupon_details, $price_grandtotal), true);
					
					$this->_pdata['coupon_name'] = $coupon_details['coupon_name'];
					$this->_pdata['coupon_value'] = $return_total_amount['coupon_type_discount'];
					$this->_pdata['sub_total'] = $price_grandtotal;
					$this->_pdata['coupon_discount_amount'] = $return_total_amount['discount'];
					$this->_pdata['grand_total'] = 	$return_total_amount['total'];
				} else {
					$this->_pdata['grand_total'] = $price_grandtotal;
				}
			}
			
			$this->_pdata['text_your_payment'] = $this->lang->line('text_your_payment');
			$this->_pdata['optimized'] = new Optimized();
			if(isset($_GET['view']) && $_GET['view'] == 'traveller_info') {
				echo $this->load->view('__checkout/Travel_body_view', $this->_pdata, TRUE);
			} else {
				echo $this->load->view('__checkout/Cart_body_view', $this->_pdata, TRUE);
			}
        } else {
		    exit('No direct script access allowed');
		}
	}
	
	public function update_cart_data() {
	    $this->load->model('__checkout/Cart_mdl');
	    
	    if($this->input->is_ajax_request()) {
			$_cart_data_array = array();
			$date_added = '';
			$date_modified = '';
			$date_modified = lu_to_d(date('Y-m-d H:i:s'));
			
			$this->_cartToken = get_cookie('_cart_token');
			$_cart_data_mdl = $this->Cart_mdl->get_cart_data_by_cart_token($this->_cartToken);
			
			$date_added = $_cart_data_mdl['date_added'];
			
			$_cart_data_array = json_decode($_cart_data_mdl['_cart_data__'], true);
			
			$_cart_data_array['trip_type'][$this->input->post('trip_type')]['_pid'][$this->input->post('key')][$this->input->post('type')] = $this->input->post('value');
			
			$adult_count_cart = $_cart_data_array['trip_type'][$this->input->post('trip_type')]['_pid'][$this->input->post('key')]['no_of_adults'];
			
			$child_count_cart = $_cart_data_array['trip_type'][$this->input->post('trip_type')]['_pid'][$this->input->post('key')]['no_of_childs'];
			
			if($adult_count_cart+$child_count_cart>TV_MAX_ADULT_ALLOWED){
				// SUCCESS
				$result = array(
					'type' => 'error',
					'_CTN' => $this->security->get_csrf_token_name(),
					'_CTH' => $this->security->get_csrf_hash(),
					'_Qty' => $this->lang->line('text_max_qty'),
					'_oops' => $this->lang->line('text_error'),
				);
			}
			else{
				$data = array(
					'_cart_token__' => $this->_cartToken,
					'_cart_data__' => json_encode($_cart_data_array),
					'date_added' => $date_added,
					'date_modified' => $date_modified,
				);
				
				$this->Cart_mdl->add_data_to_cart($data);
				
				// SUCCESS
				$result = array(
					'type' => 'success',
					'_CTN' => $this->security->get_csrf_token_name(),
					'_CTH' => $this->security->get_csrf_hash(),
				);
			}
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		} 
		else {
		    exit('No direct script access allowed');
		}
	}
	
	public function delete_cart_data() { 
	    $this->load->model('__checkout/Cart_mdl');
	    
	    if($this->input->is_ajax_request()) {
			$_cart_data_array = array();
			
			$date_modified = lu_to_d(date('Y-m-d H:i:s'));
			
			$this->_cartToken = get_cookie('_cart_token');
			$_cart_data_mdl = $this->Cart_mdl->get_cart_data_by_cart_token($this->_cartToken);
			
			$date_added = $_cart_data_mdl['date_added'];
			$_cart_data_array = json_decode($_cart_data_mdl['_cart_data__'], true);
			
			unset($_cart_data_array['trip_type'][$this->input->post('trip_type')]['_pid'][$_POST['key']]);
			
			if(empty($_cart_data_array['trip_type'][$this->input->post('trip_type')]['_pid'])) {
				unset($_cart_data_array['trip_type'][$this->input->post('trip_type')]);
			}
			
			if(count($_cart_data_array['trip_type']) > 0) {
				$data = array(
					'_cart_token__' => $this->_cartToken,
					'_cart_data__' => json_encode($_cart_data_array),
					'date_added' => $date_added,
					'date_modified' => $date_modified,
				);
				
				$this->Cart_mdl->add_data_to_cart($data);
			} else {
				$return = $this->Cart_mdl->delete_data_from_cart($this->_cartToken);
				
				if($return) {
					delete_cookie('_cart_token');
				}
			}
			
			// SUCCESS
			$result = array(
				'type' => 'success',
				'_CTN' => $this->security->get_csrf_token_name(),
				'_CTH' => $this->security->get_csrf_hash(),
			);

			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		} else {
		    exit('No direct script access allowed');
		}
	}
	
	public function apply_coupon_in_cart() { 
	    
	    $this->load->model('__checkout/Cart_mdl');
	    
	    if($this->input->is_ajax_request()) {
			$date_modified = lu_to_d(date('Y-m-d H:i:s'));
			$this->_cartToken = get_cookie('_cart_token');
			
			$coupon_exist = $this->Cart_mdl->check_coupon_exists($this->input->post('coupon'));
			$coupon_details = $this->Cart_mdl->get_coupon_details_by_coupon_code($this->input->post('coupon'));
			
			$invalid_discount_amount = false;
			$total_cart_amount = get_total_cart_amount();
			if(strtolower($coupon_details['coupon_type']) == 'value') {
				$discount = $coupon_details['coupon_value'];
				if($discount>$total_cart_amount){
					$invalid_discount_amount = true;
				}
			} else {
				$percentage = (int)$coupon_details['coupon_value'];
				$discount = ($percentage / 100) * $total_cart_amount;
				if($discount>$total_cart_amount){
					$invalid_discount_amount = true;
				}
			}
			
			if($this->input->post('coupon') == '') {
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_invalid_coupon'));
			} 
			elseif($invalid_discount_amount){
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_coupon_invalid_amount'));
			}
			elseif($coupon_exist > 0) {
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_coupon_exist'));
			} 
			elseif(empty($coupon_details)) {
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_invalid_coupon'));
			} 
			elseif($coupon_details['no_of_coupon'] == 0) {
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_invalid_coupon'));
			} 
			elseif(time() < strtotime($coupon_details['coupon_start_date'])) {
				$this->session->set_flashdata('__cp_error',$this->lang->line('text_error_invalid_coupon'));
			} 
			elseif(time() > strtotime($coupon_details['coupon_end_date'])) {
				$this->session->set_flashdata('__cp_error',$this->lang->line('text_error_coupon_expiredt'));
			} 
			else {
				$data = array(
					'_cart_token__' 	=> 	$this->_cartToken,
					'_coupon_code__' 	=>	$this->input->post('coupon'),
					'date_modified' 	=>	$date_modified,
				);
				
				$flag = $this->Cart_mdl->add_coupon_to_card($data);
				
				if($flag) {
					$this->session->set_flashdata('__cp_success', $this->lang->line('text_error_coupon_applied'));
				} else {
					$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_coupon_not_applied'));
				}
			}
			
			// SUCCESS
			$result = array(
				'type' => 'success',
				'_CTN' => $this->security->get_csrf_token_name(),
				'_CTH' => $this->security->get_csrf_hash(),
			);
			
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		} else {
		    exit($this->lang->line('text_access_invalid'));
		}
	}
	
	public function remove_coupon_from_cart() { 
	    $this->load->model('__checkout/Cart_mdl');
	    if($this->input->is_ajax_request()) {
			$date_modified = lu_to_d(date('Y-m-d H:i:s'));
			$this->_cartToken = get_cookie('_cart_token');
			
			$data = array(
				'_cart_token__' 	=> 	$this->_cartToken,
				'_coupon_code__' 	=>	'',
				'date_modified' 	=>	$date_modified,
			);
			
			$flag = $this->Cart_mdl->add_coupon_to_card($data);
			
			if($flag) {
				$this->session->set_flashdata('__cp_success', $this->lang->line('text_error_coupon_removed'));
			} else {
				$this->session->set_flashdata('__cp_error', $this->lang->line('text_error_coupon_not_removed'));
			}
			
			// SUCCESS
			$result = array(
				'type' => 'success',
				'_CTN' => $this->security->get_csrf_token_name(),
				'_CTH' => $this->security->get_csrf_hash(),
			);
			
			$this->output->set_content_type('application/json')->set_output(json_encode($result));
		} else {
		    exit('No direct script access allowed');
		}
	}
	
	public function get_cart_item_count(){
		$this->load->model('__checkout/Cart_mdl');
		$_cartToken = get_cookie('_cart_token');
		$this->_pdata['view_cart_data'] = $this->Cart_mdl->get_cart_data_by_cart_token($_cartToken);
		$this->_pdata['only_cart_data'] = json_decode($this->_pdata['view_cart_data']['_cart_data__'], true);
		if(isset($this->_pdata['only_cart_data']) && $this->_pdata['only_cart_data'] != '') {
			 $this->_pdata['cart_total'] = count_cart_items($this->_pdata['only_cart_data']);
		}
		else{
			$this->_pdata['cart_total'] = null;
		}
		
		// SUCCESS
		$result = array(
			'type' => 'success',
			'_CTN' => $this->security->get_csrf_token_name(),
			'_CTH' => $this->security->get_csrf_hash(),
			'_CART_TOTAL' => $this->_pdata['cart_total'],
		);
		
		$this->output->set_content_type('application/json')->set_output(json_encode($result));
	}
}