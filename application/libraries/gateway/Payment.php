<?php

class Payment {
    
    private $cfo; // WHERE cfo - Codeigniter Framenwork Object
    private $gateway;
    
    public function __construct() {
        $this->cfo = &get_instance();
        $this->cfo->load->helper(array(
            'form', 
            'cookie',
            'dt', 
            'cart_price_calculator', 
            'coupon'
        ));
		
		$this->cfo->load->library(array(
            'form_validation',
            '__prjlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized',
			'gateway/Payment'
        ));
		if($this->cfo->session->has_userdata('site_lang')) {
            $siteLanguage = $this->cfo->session->userdata('site_lang');
        } else {
            $siteLanguage = 'en';
        }
		$this->cfo->lang->load('__checkout/Checkout', $siteLanguage);
		$this->cfo->lang->load('common', $siteLanguage);
    }
 
    public function init($data, $gateway = null) {
        $this->set_gateway($gateway);
        $this->gateway->init($data);
    }
    
    public function success($xtn_cs_init) {
		if($this->cfo->session->has_userdata('site_lang')) {
            $siteLanguage = $this->cfo->session->userdata('site_lang');
        } else {
            $siteLanguage = 'en';
        }
		
		if($xtn_cs_init==''){
			$this->cfo->session->unset_userdata('__transactionCusId');
			redirect(base_url());
		}
        
		$_xtn_cs_init = $this->cfo->security_lib->decrypt($xtn_cs_init);
        $post_data = explode("-+-", $_xtn_cs_init);
		
        $customer_id = $post_data[1];
        $cart_token = $post_data[0];
        $transaction_no = $post_data[2];
		
		$this->cfo->load->model(array(
		    '__checkout/Audit_mdl',
		    '__checkout/Cart_mdl',
		    '__checkout/Bookings_mdl',
		    '__checkout/Tour_bookings_mdl',
		    '__checkout/Golf_bookings_mdl',
		    '__checkout/Transportation_bookings_mdl',
            '__checkout/Restaurant_bookings_mdl',
		    '__checkout/Club_and_bar_bookings_mdl',
		    '__checkout/Invoice_mdl'
			
		));
		
		$cart_data = $this->cfo->Cart_mdl->get_cart_data_by_cart_token($cart_token);
		$only_cart_data = json_decode($cart_data['_cart_data__'], true);
		
		if(empty($cart_data)){
			$this->cfo->session->unset_userdata('__transactionCusId');
			redirect(base_url());
		}
		
		if(!empty($cart_data['_coupon_code__'])) {
			$has_coupon_code = $cart_data['_coupon_code__'];
			$is_valid_coupon = validate_coupon($has_coupon_code);
		} else {
			$is_valid_coupon = false;
		}
		
		$customer_data = $this->cfo->Audit_mdl->get_customer_details_by_customer_id($customer_id);

		$post_data = array();
		$booking_data = array();
		$booking_ids = array();
		
		$grand_total = 0;
		$emails = array();
		foreach($only_cart_data['trip_type'] as $key_2 => $value) {
			if(strtolower($key_2) == "tour") {
			    foreach($value['_pid'] as $key => $data) {
					$total = 0;
					$tourinfo = $this->cfo->Tour_bookings_mdl->get_tour($key, $siteLanguage);
					$total  = tour_cart_price_calculator($data['no_of_adults'], $data['no_of_childs'], $key, $siteLanguage);
					$grand_total += $total;
					
					$bookings_post_data = array(
					    'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => $tourinfo['agent_id'],
						'booking_type'          => 'tour',
					);
					
					$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
					
					$booking_ids[] = $booking_id;
					
					if($booking_id) {
						$tour_bookings_post_data = array(
							'tour_id'               => $key,
							'tour_start_date'       => lu_to_d($data['tour_start_date']),
							'tour_end_date'         => lu_to_d($data['tour_end_date']),
							'booking_id'            => $booking_id,
							'pickup_time'           => $data['pickup_time'],
							'booking_adults'        => $data['no_of_adults'],
							'booking_child'         => $data['no_of_childs']
						);
						
						$tourbookingid = $this->cfo->Tour_bookings_mdl->add_data_into_tour_booking_tbl($tour_bookings_post_data);
					}
					
					$post_data = array(
						'booking_id' 			=> $booking_id,
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'tour_start_date'       => lu_to_d($data['tour_start_date']),
						'tour_end_date'         => lu_to_d($data['tour_end_date']),
						'pickup_time'           => $data['pickup_time'],
					    'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => 'USD',
						'agent_id'              => $tourinfo['agent_id'],
						'item_title'			=> $tourinfo['title'],
						'item_type'				=> 'Tour',
					);
					
					$booking_data[] = array(
						"bookingdata" => $post_data,
						"customerdata" => $customer_data,
						"tourdata" => $tourinfo
					);
					//$agent_info = $this->cfo->Bookings_mdl->get_agent($tourinfo['agent_id']);
					//$emails = 
				}
			} elseif(strtolower($key_2) == "golf") {
                foreach($value['_pid'] as $key => $data) {
					$total = 0;
					$total  = golf_cart_price_calculator($data['no_of_adults'], $key, $siteLanguage);
					$grand_total += $total;	
					$golfInfo = $this->cfo->Golf_bookings_mdl->get_golf($key, $siteLanguage);
					
					$bookings_post_data = array(
					    'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => $golfInfo['agent_id'],
						'booking_type'          => 'golf',
					);
					
					$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
					$booking_ids[] = $booking_id;
					
					if($booking_id) {
						$golf_bookings_post_data = array(
							'golf_id'               => $key,
							'start_date'            => lu_to_d($data['tour_start_date']),
							'booking_id'            => $booking_id,
							'pickup_time'           => $data['pickup_time'],
							'booking_adults'        => $data['no_of_adults']
						);
						
						$golfbookingid = $this->cfo->Golf_bookings_mdl->add_data_into_golf_booking_tbl($golf_bookings_post_data);						
					}
					
					$post_data = array(
						'booking_id' 			=> $booking_id,
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'tour_start_date'       => lu_to_d($data['tour_start_date']),
						'tour_end_date'         => '',
						'pickup_time'           => $data['pickup_time'],
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => $golfInfo['agent_id'],
						'item_title'			=> $golfInfo['title'],
						'item_type'				=> 'Golf',
					);
					
					$booking_data[] = array(
						"bookingdata" => $post_data,
						"customerdata" => $customer_data,
						"tourdata" => $golfInfo
					);
				}
			}elseif(strtolower($key_2) == "restaurant") {
			    foreach($value['_pid'] as $key => $data) {
			        $total = 0;
			        $total  = restaurant_cart_price_calculator($data['no_of_adults'], $key, $siteLanguage);
			        $grand_total += $total;
			        
			        $restaurantInfo = $this->cfo->Restaurant_bookings_mdl->get_restaurant($key, $siteLanguage);
			        
			        $bookings_post_data = array(
			            'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
			            'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
			            'booking_customer_id'   => $customer_id,
			            'booking_amount_paid'   => $total,
			            'booking_txn_id'        => $transaction_no,
			            'booking_curr_code'     => $_GET['cc'],
			            'agent_id'              => $restaurantInfo['agent_id'],
			            'booking_type'          => 'restaurant',
			        );
			        
			        $booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
					$booking_ids[] = $booking_id;
			        
			        if($booking_id) {
			            $restaurant_bookings_post_data = array(
			                'restaurant_id'               => $key,
			                'start_date'            => lu_to_d($data['tour_start_date']),
			                'booking_id'            => $booking_id,
			                'pickup_time'           => $data['pickup_time'],
			                'booking_adults'        => $data['no_of_adults']
			            );
			            
			            $restaurantbookingid = $this->cfo->Restaurant_bookings_mdl->add_data_into_restaurant_booking_tbl($restaurant_bookings_post_data);
			        }
			        $post_data = array(
			            'booking_id' 			=> $booking_id,
			            'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
			            'booking_customer_id'   => $customer_id,
			            'booking_amount_paid'   => $total,
			            'tour_start_date'       => lu_to_d($data['tour_start_date']),
			            'tour_end_date'         => '',
			            'pickup_time'           => $data['pickup_time'],
			            'booking_txn_id'        => $transaction_no,
			            'booking_curr_code'     => $_GET['cc'],
			            'agent_id'              => $restaurantInfo['agent_id'],
			            'item_title'			=> $restaurantInfo['title'],
						'item_type'				=> 'Restaurant',
			        );
			        
			        $booking_data[] = array(
			            "bookingdata" => $post_data,
			            "customerdata" => $customer_data,
			            "tourdata" => $restaurantInfo
			        );
			    }
			}elseif(strtolower($key_2) == "club_and_bar") {
                foreach($value['_pid'] as $key => $data) {
					$total = 0;
					$total  = club_and_bar_cart_price_calculator($data['no_of_adults'], $key, $siteLanguage);
					$grand_total += $total;					
					$club_and_barInfo = $this->cfo->Club_and_bar_bookings_mdl->get_club_and_bar($key, $siteLanguage);
					$bookings_post_data = array(
					    'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
					    'agent_id'              => $club_and_barInfo['agent_id'],
						'booking_type'          => 'club_and_bar',
					);
					
					$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
					$booking_ids[] = $booking_id;
					
					if($booking_id) {
						$club_and_bar_bookings_post_data = array(
							'club_and_bar_id'               => $key,
							'start_date'            => lu_to_d($data['tour_start_date']),
							'booking_id'            => $booking_id,
							'pickup_time'           => $data['pickup_time'],
							'booking_adults'        => $data['no_of_adults']
						);
						
						$club_and_barbookingid = $this->cfo->Club_and_bar_bookings_mdl->add_data_into_club_and_bar_booking_tbl($club_and_bar_bookings_post_data);						
					}
					
					$post_data = array(
						'booking_id' 			=> $booking_id,
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'tour_start_date'       => lu_to_d($data['tour_start_date']),
						'tour_end_date'         => '',
						'pickup_time'           => $data['pickup_time'],
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => $club_and_barInfo['agent_id'],
						'item_title'			=> $club_and_barInfo['title'],
						'item_type'				=> 'Club And Bar',
					);
					
					$booking_data[] = array(
						"bookingdata" => $post_data,
						"customerdata" => $customer_data,
					    "tourdata" => $club_and_barInfo
					);
				}
			} elseif(strtolower($key_2) == "sharing") {
				foreach($value['_pid'] as $key => $data) {
					$total = 0;
					$transportationInfo = $this->cfo->Transportation_bookings_mdl->get_transportation($key);
					
					$airport = $this->cfo->Cart_mdl->get_airport($data['airport_id']);
					$hotel = $this->cfo->Cart_mdl->get_hotel($data['hotel_id']);
					
					if($data['transport_trip_type'] == 'round_trip') {
						
						$trip_type = 'Round Trip';
						
						$result_air_to_htl = $this->cfo->Transportation_bookings_mdl->get_transportation_by_air_2_htl($data['airport_id'],$data['hotel_id']);
						
						$result_htl_to_air = $this->cfo->Transportation_bookings_mdl->get_transportation_by_htl_2_air($data['airport_id'],$data['hotel_id']);
						
						$air_to_htl_price  = shared_trip_cart_price_calculator($data['no_of_adults'], 'air_to_htl_trip', $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						
						$htl_to_air_price  = shared_trip_cart_price_calculator($data['no_of_adults'], 'htl_to_air_trip', $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						
						$total = $air_to_htl_price+$htl_to_air_price;
						
						$grand_total = $grand_total+$total;
						
						$item_title = ucfirst($key_2) . ', ' . '('.$trip_type .',' . $airport['name'] . ' To ' . $hotel['name'] . ')';
						
						$bookings_post_data = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $air_to_htl_price,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $result_air_to_htl['agent_id'],
							'booking_type'          => 'transportation',
						);
						
						$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
						$booking_ids[] = $booking_id;
						
						if($booking_id) {
							$shared_transportation_bookings_data_air_2_htl = array(
								'transportation_id'     => $result_air_to_htl['id'],
								'booking_id'       		=> $booking_id,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'shared',
								'flight_arrival_date'   => lu_to_d($data['tour_start_date']),
								'flight_arrival_time'   => $data['pickup_time'],
								'flight_arrival_name'	=> $data['arr_flight_name'],
								'flight_arrival_num'	=> $data['arr_flight_num'],
								'flight_departure_date' => '',
								'flight_departure_time' => null,
								'flight_departure_name'	=> null,
								'flight_departure_num'	=> null,
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($shared_transportation_bookings_data_air_2_htl);						
						}
						
						$result_booking_tbl = $this->cfo->Bookings_mdl->get_booking($booking_id);
						
						$bookings_post_data_with_booking_no = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $htl_to_air_price,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $result_htl_to_air['agent_id'],
							'booking_type'          => 'transportation',
							'booking_no'          	=> $result_booking_tbl['booking_no'],
						);
						
						$booking_id_2 = $this->cfo->Bookings_mdl->insert_into_booking_tbl_with_booking_no($bookings_post_data_with_booking_no);
						$booking_ids[] = $booking_id_2;
						
						if($booking_id_2){
							$shared_transportation_bookings_data_htl_2_air = array(
								'transportation_id'     => $result_htl_to_air['id'],
								'booking_id'       		=> $booking_id_2,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'shared',
								'flight_arrival_date'   => '',
								'flight_arrival_time'   => null,
								'flight_arrival_name'	=> null,
								'flight_arrival_num'	=> null,
								'flight_departure_date' => lu_to_d($data['tour_end_date']),
								'flight_departure_time' => $data['drop_time'],
								'flight_departure_name'	=> $data['dept_flight_name'],
								'flight_departure_num'	=> $data['dept_flight_num'],
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid2 = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($shared_transportation_bookings_data_htl_2_air);
						}
						
					}
					else{
						
						if($data['transport_trip_type'] == 'air_to_htl_trip') {
							$trip_type = 'Airport To Hotel';
						}
						
						if($data['transport_trip_type'] == 'htl_to_air_trip') {
							$trip_type = 'Hotel To Airport';
						}
						
						$total  = shared_trip_cart_price_calculator($data['no_of_adults'], $data['transport_trip_type'], $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						$grand_total = $grand_total+$total;
						
						$item_title = ucfirst($key_2) . ', ' . '('.$trip_type .',' . $airport['name'] . ' To ' . $hotel['name'] . ')';
						
						$bookings_post_data = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $total,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $transportationInfo['agent_id'],
							'booking_type'          => 'transportation',
						);
						$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
						$booking_ids[] = $booking_id;
						
						if($booking_id) {
							$shared_transportation_bookings_post_data = array(
								'transportation_id'     => $key,
								'booking_id'       		=> $booking_id,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'shared',
								'flight_arrival_date'   => $data['tour_start_date']!=''?lu_to_d($data['tour_start_date']):'',
								'flight_arrival_time'   => $data['pickup_time'],
								'flight_arrival_name'	=> $data['arr_flight_name'],
								'flight_arrival_num'	=> $data['arr_flight_num'],
								'flight_departure_date' => $data['tour_end_date']!=''?lu_to_d($data['tour_end_date']):'',
								'flight_departure_time' => $data['drop_time'],
								'flight_departure_name'	=> $data['dept_flight_name'],
								'flight_departure_num'	=> $data['dept_flight_num'],
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($shared_transportation_bookings_post_data);						
						}
						
					}
					$post_data = array(
						'booking_id' 			=> $booking_id,
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'tour_start_date'       => lu_to_d($data['tour_start_date']),
						'tour_end_date'         => '',
						'pickup_time'           => $data['pickup_time'],
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => '',
						'item_title'			=> $item_title,
						'item_type'				=> 'Transportation',
					);
					$booking_data[] = array(
						"bookingdata" => $post_data,
						"customerdata" => $customer_data,
						"tourdata" => $transportationInfo
					);
				}
			} elseif(strtolower($key_2) == "private") {
                foreach($value['_pid'] as $key => $data) {
                    $total = 0;
					$transportationInfo = $this->cfo->Transportation_bookings_mdl->get_transportation($key);
					
					$airport = $this->cfo->Cart_mdl->get_airport($data['airport_id']);
					$hotel = $this->cfo->Cart_mdl->get_hotel($data['hotel_id']);
					
					if($data['transport_trip_type'] == 'round_trip') {
						$trip_type = 'Round Trip';
						
						$result_air_to_htl = $this->cfo->Transportation_bookings_mdl->get_transportation_by_air_2_htl($data['airport_id'],$data['hotel_id']);
						
						$result_htl_to_air = $this->cfo->Transportation_bookings_mdl->get_transportation_by_htl_2_air($data['airport_id'],$data['hotel_id']);
						
						$air_to_htl_price  = private_trip_cart_price_calculator($data['no_of_adults'], 'air_to_htl_trip', $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						
						$htl_to_air_price  = private_trip_cart_price_calculator($data['no_of_adults'], 'htl_to_air_trip', $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						
						$total = $air_to_htl_price+$htl_to_air_price;
						
						$grand_total = $grand_total+$total;
						
						$item_title = ucfirst($key_2) . ', ' . '('.$trip_type .',' . $airport['name'] . ' To ' . $hotel['name'] . ')';
						
						$bookings_post_data = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $air_to_htl_price,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $result_air_to_htl['agent_id'],
							'booking_type'          => 'transportation',
						);
						
						$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
						$booking_ids[] = $booking_id;
						if($booking_id) {
							$shared_transportation_bookings_data_air_2_htl = array(
								'transportation_id'     => $result_air_to_htl['id'],
								'booking_id'       		=> $booking_id,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'private',
								'flight_arrival_date'   => lu_to_d($data['tour_start_date']),
								'flight_arrival_time'   => $data['pickup_time'],
								'flight_arrival_name'	=> $data['arr_flight_name'],
								'flight_arrival_num'	=> $data['arr_flight_num'],
								'flight_departure_date' => '',
								'flight_departure_time' => null,
								'flight_departure_name'	=> null,
								'flight_departure_num'	=> null,
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($shared_transportation_bookings_data_air_2_htl);						
						}
						
						$result_booking_tbl = $this->cfo->Bookings_mdl->get_booking($booking_id);
						
						$bookings_post_data_with_booking_no = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $htl_to_air_price,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $result_htl_to_air['agent_id'],
							'booking_type'          => 'transportation',
							'booking_no'          	=> $result_booking_tbl['booking_no'],
						);
						
						$booking_id_2 = $this->cfo->Bookings_mdl->insert_into_booking_tbl_with_booking_no($bookings_post_data_with_booking_no);
						$booking_ids[] = $booking_id_2;
						
						if($booking_id_2){
							$shared_transportation_bookings_data_htl_2_air = array(
								'transportation_id'     => $result_htl_to_air['id'],
								'booking_id'       		=> $booking_id_2,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'private',
								'flight_arrival_date'   => '',
								'flight_arrival_time'   => null,
								'flight_arrival_name'	=> null,
								'flight_arrival_num'	=> null,
								'flight_departure_date' => lu_to_d($data['tour_end_date']),
								'flight_departure_time' => $data['drop_time'],
								'flight_departure_name'	=> $data['dept_flight_name'],
								'flight_departure_num'	=> $data['dept_flight_num'],
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid2 = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($shared_transportation_bookings_data_htl_2_air);
						}
					}
					else{
						if($data['transport_trip_type'] == 'air_to_htl_trip') {
							$trip_type = 'Airport To Hotel';
						}
						
						if($data['transport_trip_type'] == 'htl_to_air_trip') {
							$trip_type = 'Hotel To Airport';
						}
						
						$total  = private_trip_cart_price_calculator($data['no_of_adults'], $data['transport_trip_type'], $data['hotel_id'], $data['airport_id'], $key, $siteLanguage);
						$grand_total = $grand_total+$total;
						
						$item_title = ucfirst($key_2) . ', ' . '('.$trip_type .',' . $airport['name'] . ' To ' . $hotel['name'] . ')';
						
						$bookings_post_data = array(
							'booking_date'          => lu_to_d(date('Y-m-d H:i:s')),
							'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
							'booking_customer_id'   => $customer_id,
							'booking_amount_paid'   => $total,
							'booking_txn_id'        => $transaction_no,
							'booking_curr_code'     => $_GET['cc'],
							'agent_id'              => $transportationInfo['agent_id'],
							'booking_type'          => 'transportation',
						);
						
						$booking_id = $this->cfo->Bookings_mdl->add_data_into_booking_tbl($bookings_post_data);
						$booking_ids[] = $booking_id;
						
						if($booking_id){
							$private_transportation_bookings_post_data = array(
								'transportation_id'     => $key,
								'booking_id'       		=> $booking_id,
								'trip_type'				=> $data['transport_trip_type'],
								'transportation_type'	=> 'private',
								'flight_arrival_date'   => $data['tour_start_date']!=''?lu_to_d($data['tour_start_date']):'',
								'flight_arrival_time'   => $data['pickup_time'],
								'flight_arrival_name'	=> $data['arr_flight_name'],
								'flight_arrival_num'	=> $data['arr_flight_num'],
								'flight_departure_date' => $data['tour_end_date']!=''?lu_to_d($data['tour_end_date']):'',
								'flight_departure_time' => $data['drop_time'],
								'flight_departure_name'	=> $data['dept_flight_name'],
								'flight_departure_num'	=> $data['dept_flight_num'],
								'no_of_passenger'   	=> $data['no_of_adults']
							);
							
							$transportationbookingid = $this->cfo->Transportation_bookings_mdl->add_data_into_transportation_booking_tbl($private_transportation_bookings_post_data);						
						}
					}
					
					$post_data = array(
						'booking_id' 			=> $booking_id,
						'date_added'            => lu_to_d(date('Y-m-d H:i:s')),
						'booking_customer_id'   => $customer_id,
						'booking_amount_paid'   => $total,
						'tour_start_date'       => lu_to_d($data['tour_start_date']),
						'tour_end_date'         => '',
						'pickup_time'           => $data['pickup_time'],
						'booking_txn_id'        => $transaction_no,
						'booking_curr_code'     => $_GET['cc'],
						'agent_id'              => $transportationInfo['agent_id'],
						'item_title'			=> $item_title,
						'item_type'				=> 'Transportation',
					);
					
					$booking_data[] = array(
						"bookingdata" => $post_data,
						"customerdata" => $customer_data,
						"tourdata" => $transportationInfo
					);
				}
			}
		}
		
		if($is_valid_coupon) {
			$coupon_details = $this->cfo->Cart_mdl->get_coupon_details_by_coupon_code($has_coupon_code);
			
			$return_total_amount = json_decode(apply_coupon_on_total_amount($coupon_details,$grand_total),true);
			$coupon_data = array(
				'coupon_name' => $coupon_details['coupon_name'],
				'coupon_value' => $return_total_amount['coupon_type_discount'],
				'sub_total' => $grand_total,
				'coupon_discount_amount' => $return_total_amount['discount'],
				'grand_total' => $return_total_amount['total']
			);
		}
		else{
			$coupon_data = array(
				'grand_total' => $grand_total
			);
		}
		
        $customer_invoice_no = CUSTOMER_INVOICE_PREFIX . date('Y') . '-' . $booking_data[0]['bookingdata']['booking_id'] . '-'. str_pad($booking_data[0]['bookingdata']['booking_customer_id'], INVOICE_PAD_LIMIT, INVOICE_PAD_VALUE, STR_PAD_LEFT);
		
        $path = TV_CUSTOMER_INVOICE_DIR . date('Y');
        
        if (!is_dir(str_replace('\\','/', getcwd()) . '/' . $path)) {
            @mkdir(str_replace('\\', '/', getcwd()) . '/' . $path, 0777);
        }
        
        $this->cfo->load->library('__commonlib/Security_lib');
        
        $invoice_file = $customer_invoice_no . TV_PDF_EXT;
        
        $invoice_file_with_path = $path . '/' . $invoice_file;
		
		$in = 0;
        
		foreach($booking_data as $invoice) {			
			$booking_data[$in]['bookingdata']['customer_invoice_no'] = $customer_invoice_no;
			
			$invoice_file_data = array(
		        "booking_id" => $invoice['bookingdata']['booking_id'],
		        "invoice_no" => $customer_invoice_no,
		        "invoice_amount" => $invoice['bookingdata']['booking_amount_paid'],
		        "invoice_type" => 'customer',
		        "invoice_path" => $invoice_file_with_path,
				'date_generated' => lu_to_d(date('Y-m-d H:i:s'))
		    );
            
			$this->cfo->Invoice_mdl->add_invoice_details($invoice_file_data);
			$in++;
        }
        
        $invoicepdfdata['invoicedata'] = $booking_data;
        $invoicepdfdata['couponitems'] = $coupon_data;
        
        $invoicepdfdata['text_sunshine_invoice'] = $this->cfo->lang->line('text_sunshine_invoice');
        $invoicepdfdata['text_invoice'] = $this->cfo->lang->line('text_invoice');
        $invoicepdfdata['text_created'] = $this->cfo->lang->line('text_created');
        $invoicepdfdata['text_item_type'] = $this->cfo->lang->line('text_item_type');
        $invoicepdfdata['text_item_title'] = $this->cfo->lang->line('text_item_title');
        $invoicepdfdata['text_item_amount'] = $this->cfo->lang->line('text_item_amount');
        $invoicepdfdata['text_sub'] = $this->cfo->lang->line('text_sub');
        $invoicepdfdata['text_coupon'] = $this->cfo->lang->line('text_coupon');
        $invoicepdfdata['text_total'] = $this->cfo->lang->line('text_total');
        $invoicepdfdata['text_grand_total'] = $this->cfo->lang->line('text_grand_total');
        $invoicepdfdata['text_mail_invoice'] = $this->cfo->lang->line('text_mail_invoice');
        $invoicepdfdata['text_greeting_customer'] = $this->cfo->lang->line('text_greeting_customer');
        $invoicepdfdata['text_greeting_admin'] = $this->cfo->lang->line('text_greeting_admin');
        $invoicepdfdata['text_greeting_vendor'] = $this->cfo->lang->line('text_greeting_vendor');
        $invoicepdfdata['text_customer_booking_message'] = $this->cfo->lang->line('text_customer_booking_message');
        $invoicepdfdata['text_admin_booking_message'] = $this->cfo->lang->line('text_admin_booking_message');
        $invoicepdfdata['text_email_poweredby'] = $this->cfo->lang->line('text_email_poweredby');
        $invoicepdfdata['text_invoice_admin_details'] = $this->cfo->lang->line('text_invoice_admin_details');
        
        $invoice_content = $this->cfo->load->view('__invoice_template/Customer_invoice', $invoicepdfdata, TRUE);
        
        // METHOD NO. 1
        // $stylesheet = file_get_contents('assets/pdf_css/customer_invoice.css');
        // $this->m_pdf->pdf->WriteHTML($pdf_data);
        // $this->m_pdf->pdf->WriteHTML($stylesheet,1);
        
        // METHOD NO. 2
        $this->cfo->load->library('m_pdf');
        $this->cfo->m_pdf->pdf->WriteHTML($invoice_content);
        $this->cfo->m_pdf->pdf->Output($invoice_file_with_path, "F");
        
		
		/*
		 *	Customer email
		 */
        $from = ADMIN_EMAIL;
        $from_title = $this->cfo->lang->line('text_from_title_customer');
        $to = $customer_data[0]['email'];
        $subject = $this->cfo->lang->line('text_subject_booking_customer');
        $body = $this->cfo->load->view('__email_template/Customer_email', $invoicepdfdata, TRUE);
        
        if($to != "") {
            $this->cfo->load->library('__commonlib/Email_lib');
            $this->cfo->email_lib->send($from, $to, $subject, $body, $from_title, $invoice_file_with_path);
        }
		/*
		 *	Customer email end
		 */
		foreach($booking_ids as $bookingid){
			$row_bookings = $this->cfo->Bookings_mdl->get_booking($bookingid);
			$invoicepdfdata['item_booking_number'] = $row_bookings['booking_no'];
			$invoicepdfdata['item_booking_type'] = $row_bookings['booking_type'];
			$row_agents = $this->cfo->Bookings_mdl->get_agent($row_bookings['agent_id']);
			$from_customer = $customer_data[0]['email'];
			/*
			 *	Admin email
			 */
			$from_title_admin = $this->cfo->lang->line('text_from_title_admin');
			$to_admin = ADMIN_EMAIL;
			$subject_admin = $this->cfo->lang->line('text_subject_booking_admin');
			$body_admin = $this->cfo->load->view('__email_template/Admin_booking_email', $invoicepdfdata, TRUE);
			
			if($to_admin != "") {
				$this->cfo->load->library('__commonlib/Email_lib');
				$this->cfo->email_lib->send($from_customer, $to_admin, $subject_admin, $body_admin, $from_title_admin,null);
			}
			/*
			 *	Admin email end
			 */
			 
			/*
			 *	Vendor email
			 */
			$from_title_vendor = $this->cfo->lang->line('text_from_title_vendor');
			$to_vendor = $row_agents['admin_email'];
			$subject_vendor = $this->cfo->lang->line('text_subject_booking_vendor');
			$body_vendor = $this->cfo->load->view('__email_template/Vendor_booking_email', $invoicepdfdata, TRUE);
			
			if($to_vendor != "") {
				$this->cfo->load->library('__commonlib/Email_lib');
				$this->cfo->email_lib->send($from_customer, $to_vendor, $subject_vendor, $body_vendor, $from_title_vendor,null);
			}
			/*
			 *	Vendor email end
			 */
		}
		
		$data['pdf_path'] = $invoice_file_with_path;
		$data['text_all_set'] = $this->cfo->lang->line('text_all_set');
		$data['text_booking'] = $this->cfo->lang->line('text_booking');
		$data['text_being_awesome'] = $this->cfo->lang->line('text_being_awesome');
		$data['text_enjoy_purchase'] = $this->cfo->lang->line('text_enjoy_purchase');
		$data['text_download_invoice'] = $this->cfo->lang->line('text_download_invoice');
		
		$transaction_data = array(
			'transaction_no' => $transaction_no,
			'status' => 'complete',
		);
		
		$this->cfo->Audit_mdl->update_after_payment_transactionid_status($transaction_data);
        $this->cfo->Cart_mdl->delete_data_from_cart($cart_token);
        
        delete_cookie('_cart_token');
		$this->cfo->session->unset_userdata('__transactionCusId');
       
        $this->cfo->template_lib->load_view($this->cfo, '__checkout/Success_view', $data);
    }
    
    public function error() {
        // ERROR FUNCTIONALITY WILL BE IMPLEMENTED HERE
    }
    
    public function cancel() {
        // CANCEL FUNCTIONALITY WILL BE IMPLEMENTED HERE
    }
    
    private function set_gateway($gateway) {
        $this->gateway = ucfirst($gateway) . '_fore';
        $this->cfo->load->library('gateway/' . $this->gateway);
    } 
}