<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
* APPLICATION 		: Transportation Controller
* AUTHOR			: VINAY KUMAR SHARMA
* CONTRIBUTION     : VINAY KUMAR SHARMA
* VERSION			: 1.0
* COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
*/

class Transportation_ctrl extends CI_Controller {
	public function __construct() {
		parent::__construct();
		// ANY DEFAULT LOADING HERE
		$this->load->library(array(
			'form_validation',
			'__prjlib/Template_lib',
			'__commonlib/Security_lib',
			'__commonlib/Optimized',
            '__commonlib/Breadcrumbs',
		));
		$this->load->helper(array('form','dt'));
		if(!$this->session->has_userdata('site_lang')) {
			$this->session->set_userdata('site_lang', 'en');
		}
		$siteLang = $this->session->userdata('site_lang');
		$this->lang->load('__catalog/Transportation', $siteLang);
		$this->lang->load('form_validation', $siteLang);
		$this->load->model('__catalog/Transportation_mdl');
		$this->load->model('__catalog/Tours_mdl');
	}

	public function index($country_slug = null,$city_slug = null){
		$this->load->model('__settings/Utility_mdl');
		
		$this->_pdata['text_trip_information'] = $this->lang->line('text_trip_information');
		$this->_pdata['text_description'] = $this->lang->line('text_description');
		$this->_pdata['text_previous'] = $this->lang->line('text_previous');
		$this->_pdata['text_next'] = $this->lang->line('text_next');
		$this->_pdata['text_shared_transportation'] = $this->lang->line('text_shared_transportation');
		$this->_pdata['text_private_transportation'] = $this->lang->line('text_private_transportation');
		$this->_pdata['text_choose_transportation_type'] = $this->lang->line('text_choose_transportation_type');
		$this->_pdata['text_sharing'] = $this->lang->line('text_sharing');
		$this->_pdata['text_from_usd'] = $this->lang->line('text_from_usd');
		$this->_pdata['text_include_passenger'] = $this->lang->line('text_include_passenger');
		$this->_pdata['text_private'] = $this->lang->line('text_private');
		$this->_pdata['text_passenger'] = $this->lang->line('text_passenger');
		$this->_pdata['text_arrival_date'] = $this->lang->line('text_arrival_date');
		$this->_pdata['text_dept_date'] = $this->lang->line('text_dept_date');
		$this->_pdata['text_submit'] = $this->lang->line('text_submit');
		$this->_pdata['text_cart_button'] = $this->lang->line('text_cart_button');
		
		$this->_pdata['select_transportation_type'] = $this->lang->line('select_transportation_type');
		$this->_pdata['select_airport'] = $this->lang->line('select_airport');
		$this->_pdata['select_hotel'] = $this->lang->line('select_hotel');
		
		$this->_pdata['option_round_trip'] = $this->lang->line('option_round_trip');
		$this->_pdata['option_air_to_htl'] = $this->lang->line('option_air_to_htl');
		$this->_pdata['option_htl_to_air'] = $this->lang->line('option_htl_to_air');
		
		$this->_pdata['label_transportation_type'] = $this->lang->line('label_transportation_type');
		$this->_pdata['label_airport'] = $this->lang->line('label_airport');
		$this->_pdata['label_hotel'] = $this->lang->line('label_hotel');
		
		$this->_pdata['dv_transportation_type'] = $this->lang->line('dv_transportation_type');
		$this->_pdata['dv_airport'] = $this->lang->line('dv_airport');
		$this->_pdata['dv_hotel'] = $this->lang->line('dv_hotel');
		$this->_pdata['dv_passenger'] = $this->lang->line('dv_passenger');
		
		$this->_pdata['dv_arrival_date'] = $this->lang->line('dv_arrival_date');
		$this->_pdata['dv_arrival_time'] = $this->lang->line('dv_arrival_time');
		$this->_pdata['dv_arrival_flight_name'] = $this->lang->line('dv_arrival_flight_name');
		$this->_pdata['dv_arrival_flight_number'] = $this->lang->line('dv_arrival_flight_number');
		$this->_pdata['dv_departure_date'] = $this->lang->line('dv_departure_date');
		$this->_pdata['dv_departure_time'] = $this->lang->line('dv_departure_time');
		$this->_pdata['dv_departure_flight_name'] = $this->lang->line('dv_departure_flight_name');
		$this->_pdata['dv_departure_flight_number'] = $this->lang->line('dv_departure_flight_number');
		$this->_pdata['dv_length'] = $this->lang->line('dv_length');

		$this->_pdata['search'] = $this->lang->line('search');$this->_pdata['airline'] = $this->lang->line('text_airline');
		$this->_pdata['flightnumber'] = $this->lang->line('text_flightnumber');
		$this->_pdata['arrivaltime'] = $this->lang->line('text_arrivaltime');
		$this->_pdata['departuretime'] = $this->lang->line('text_departuretime');
		$this->_pdata['fillinformation'] = $this->lang->line('text_fill_information');
		$this->_pdata['text_prefered_location'] = $this->lang->line('text_prefered_location');
		$this->_pdata['text_payment_message']  = $this->lang->line('text_payment_message');

		$search_conditions = array();
		
		if(!$this->session->has_userdata('site_lang')) {
			$search_conditions['language_code'] = 'en';
		} 
		else {
			$search_conditions['language_code'] = $this->session->userdata('site_lang');
		}
		
		if(!$this->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $this->session->userdata('site_lang');
        }

		if(isset($country_slug)) {
			$search_conditions['country_slug'] = $country_slug;
			$this->_pdata['country_slug'] = $country_slug;
		} 
		else {
			$search_conditions['country_slug'] = null;
			$this->_pdata['country_slug'] = null;
		}

		if(isset($city_slug)) {
			$search_conditions['city_slug'] = $city_slug;
			$this->_pdata['city_slug'] = $city_slug;
		} 
		else {
			$search_conditions['city_slug'] = null;
			$this->_pdata['city_slug'] = null;
		}

		$hotels = $this->Transportation_mdl->get_hotels($this->_pdata['country_slug'],$this->_pdata['city_slug']);

		//$this->_pdata['hotels'] = array('--- Select Hotels ---');

		foreach ($hotels as $hotel) {
			$this->_pdata['hotels'][$hotel['id']] = $hotel['name']; 
		}

		$airports = $this->Transportation_mdl->get_airports( $this->_pdata['country_slug'],$this->_pdata['city_slug']);

		//$this->_pdata['airports'] = array('--- Select Airports ---');

		foreach ($airports as $airport) {
			$this->_pdata['airports'][$airport['id']] = $airport['name']; 
		}
		
		$this->_pdata['arr_blocked_dates'] = '';
		$this->_pdata['dep_blocked_dates'] = '';
		
		if($this->input->get('form_search_btn') && $this->input->get('form_search_btn')=='search form'){

			/* $this->form_validation->set_rules('transport_type', 'Transportation Type', 'trim|required',
				array(
					'required'=>'Please select Transportation Type',
				)
			);
			$this->form_validation->set_rules('airport_id', 'Airport', 'trim|required',
				array(
					'required'=>'Please select Airport',
				)
			);
			$this->form_validation->set_rules('hotel_id', 'Hotel', 'trim|required',
				array(
					'required'=>'Please select Hotel',
				)
			);
			if ($this->form_validation->run() == FALSE) {
	            $this->session->set_flashdata('msg-error', validation_errors());
	        } 
			else { */
				//pr($this->input->get());
				$this->_pdata['p_transport_type'] = $transport_type= $this->input->get('transport_type');
				$this->_pdata['p_airport_id'] = $airport_id= $this->input->get('airport_id');
				$this->_pdata['p_hotel_id'] = $hotel_id= $this->input->get('hotel_id');
				
				$searchdata = array(
					"transport_type"=>$transport_type,
					"hotel_id"=>$hotel_id,
					"airport_id"=>$airport_id
				);

				$this->_pdata['transportations']= $this->Transportation_mdl->search_transportations($searchdata, $search_conditions['language_code']);
				
				if($transport_type=='round_trip' || $transport_type=='air_to_htl_trip'){
					$air_2_htl = $this->Transportation_mdl->get_transportation_by_air_2_htl($airport_id,$hotel_id);
					if(!empty($air_2_htl)){
						$blockdates = $this->Transportation_mdl->get_block_dates($air_2_htl['id']);
						$this->_pdata['arr_blocked_dates'] = '';
						foreach ($blockdates as $blockdate) {
							$this->_pdata['arr_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
						}
						$this->_pdata['arr_blocked_dates'] = chop($this->_pdata['arr_blocked_dates'], ",");
					}
				}
				
				if($transport_type=='round_trip' || $transport_type=='htl_to_air_trip'){
					$htl_2_air = $this->Transportation_mdl->get_transportation_by_htl_2_air($airport_id,$hotel_id);
					if(!empty($htl_2_air)){
						$blockdates = $this->Transportation_mdl->get_block_dates($htl_2_air['id']);
						$this->_pdata['dep_blocked_dates'] = '';
						foreach ($blockdates as $blockdate) {
							$this->_pdata['dep_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
						}
						$this->_pdata['dep_blocked_dates'] = chop($this->_pdata['dep_blocked_dates'], ",");
					}
				}
			//}
		}
		
		if($this->input->post('travel_form_btn') && $this->input->post('travel_form_btn')=='travel form'){
			$this->_pdata['p_transport_type'] = $triptype= $this->input->post('triptype');
			$this->_pdata['p_airport_id'] = $airportid= $this->input->post('airportid');
			$this->_pdata['p_hotel_id'] = $hotelid= $this->input->post('hotelid');
			
			$searchdata = array(
				"transport_type"=>$triptype,
				"hotel_id"=>$hotelid,
				"airport_id"=>$airportid
			);

			$this->_pdata['transportations']= $this->Transportation_mdl->search_transportations($searchdata, $search_conditions['language_code']);
			
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='air_to_htl_trip'){
				$air_2_htl = $this->Transportation_mdl->get_transportation_by_air_2_htl($this->input->post('airportid'),$this->input->post('hotelid'));
				if(!empty($air_2_htl)){
					$blockdates = $this->Transportation_mdl->get_block_dates($air_2_htl['id']);
					$this->_pdata['arr_blocked_dates'] = '';
					foreach ($blockdates as $blockdate) {
						$this->_pdata['arr_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
					}
					$this->_pdata['arr_blocked_dates'] = chop($this->_pdata['arr_blocked_dates'], ",");
				}
			}
			
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='htl_to_air_trip'){
				$htl_2_air = $this->Transportation_mdl->get_transportation_by_htl_2_air($this->input->post('airportid'),$this->input->post('hotelid'));
				if(!empty($htl_2_air)){
					$blockdates = $this->Transportation_mdl->get_block_dates($htl_2_air['id']);
					$this->_pdata['dep_blocked_dates'] = '';
					foreach ($blockdates as $blockdate) {
						$this->_pdata['dep_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
					}
					$this->_pdata['dep_blocked_dates'] = chop($this->_pdata['dep_blocked_dates'], ",");
				}
			}
			
			$this->form_validation->set_rules('passenger_number', 'lang:text_passenger', 'trim|required|numeric', array(
	            'required'=>$this->lang->line('required'),
	            'numeric'=>'Only digits allowed (1-9)',
	        ));
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='air_to_htl_trip'){
				$this->form_validation->set_rules('air_line_name', 'lang:text_airline', 'trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('flight_number','lang:text_flightnumber','trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('arrival_time','lang:text_arrivaltime', 'trim|required', array(
					'required'=>$this->lang->line('required'),
				));
				$this->form_validation->set_rules('arrival_date', 'lang:text_arrival_date', 'trim|required',array(
					'required'=>$this->lang->line('required'),
				));
			}
	        
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='htl_to_air_trip'){
				$this->form_validation->set_rules('departure_date', 'lang:text_dept_date', 'trim|required',array(
					'required'=>$this->lang->line('required'),
				));
				$this->form_validation->set_rules('dept_air_line_name', 'lang:text_airline', 'trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('dept_flight_number','lang:text_flightnumber','trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('departure_time','lang:text_departuretime', 'trim|required', array(
					'required'=>$this->lang->line('required'),
				));
			}
	        if($this->form_validation->run() == FALSE) {
	            $this->session->set_flashdata('msg-error', validation_errors());
	        } else {
	            $_cart_data_array = array();
	            
	            $this->load->helper(array('cookie','dt'));
	            $cookie_data = get_cookie('_cart_token');
	            
	            $date_added = '';
	            $date_modified = '';
	            
	            if(isset($cookie_data)) {
					$this->_cartToken = $cookie_data;
	                $this->load->model('__checkout/Cart_mdl');
	                $_cart_data_mdl = $this->Cart_mdl->get_cart_data_by_cart_token($this->_cartToken);
					$_cart_data_array = json_decode($_cart_data_mdl['_cart_data__'], true);
	                
	                // KINDLY VALIDATE DATA BEFORE SUBMISSION
	                 $_cart_data_new_array = array(
						'transport_trip_type'=>	$this->input->post('triptype'),
						'airport_id'=>	$this->input->post('airportid'),
						'hotel_id'=>	$this->input->post('hotelid'),
						'no_of_adults' => $this->input->post('passenger_number'),
	                    'no_of_childs' => null,
						'arr_flight_name'=>	$this->input->post('air_line_name'),
						'arr_flight_num'=>	$this->input->post('flight_number'),
	                    'tour_start_date' => $this->input->post('arrival_date')!=''?lu_to_d($this->input->post('arrival_date')):'',
	                    'pickup_time' => $this->input->post('arrival_time'),
						'dept_flight_name'=>	$this->input->post('dept_air_line_name'),
						'dept_flight_num'=>	$this->input->post('dept_flight_number'),
	                    'tour_end_date' => $this->input->post('departure_date')!=''?lu_to_d($this->input->post('departure_date')):'',
	                    'drop_time' => $this->input->post('departure_time'),
	                );
	                $pid = $this->input->post('_pid');
	                $_cart_data_array['trip_type'][$this->input->post('trans_type')]['_pid'][$pid] = $_cart_data_new_array;
	                
	                $date_modified = lu_to_d(date('Y-m-d H:i:s'));
	                $date_added = $_cart_data_mdl['date_added'];
	            }else {
					$price= ($this->input->post('trans_type')=="private")?$this->input->post('privateprice'):$this->input->post('sharingprice');
					$date_added = lu_to_d(date('Y-m-d H:i:s'));
	                $date_modified = lu_to_d(date('Y-m-d H:i:s'));
	                $this->_cartToken = time().uniqid();
	                $this->_cartToken = $this->security_lib->encrypt($this->_cartToken);
	                set_cookie('_cart_token', $this->_cartToken, time() + (10 * 365 * 24 * 60 * 60));
	                $_cart_data_new_array = array(
						'transport_trip_type'=>	$this->input->post('triptype'),
						'airport_id'=>	$this->input->post('airportid'),
						'hotel_id'=>	$this->input->post('hotelid'),
						'no_of_adults' => $this->input->post('passenger_number'),
	                    'no_of_childs' => null,
						'arr_flight_name'=>	$this->input->post('air_line_name'),
						'arr_flight_num'=>	$this->input->post('flight_number'),
	                    'tour_start_date' => $this->input->post('arrival_date')!=''?lu_to_d($this->input->post('arrival_date')):'',
	                    'pickup_time' => $this->input->post('arrival_time'),
						'dept_flight_name'=>	$this->input->post('dept_air_line_name'),
						'dept_flight_num'=>	$this->input->post('dept_flight_number'),
	                    'tour_end_date' => $this->input->post('departure_date')!=''?lu_to_d($this->input->post('departure_date')):'',
	                    'drop_time' => $this->input->post('departure_time'),
	                );
	                $pid = $this->input->post('_pid');
	                $_cart_data_array['trip_type'][$this->input->post('trans_type')]['_pid'][$pid] = $_cart_data_new_array;
	            }
	            
	            $data = array(
	                '_cart_token__' => $this->_cartToken,
	                '_cart_data__' => json_encode($_cart_data_array),
	                'date_added' => $date_added,
	                'date_modified' => $date_modified,
	            );
	           $this->load->model('__checkout/Cart_mdl');
	           $this->Cart_mdl->add_data_to_cart($data);
	           redirect('cart');
	        }
	    }

		$countries = $this->Utility_mdl->get_countries();
		foreach ($countries as $key => $row){$name[$key] = $row['name'];}
		array_multisort($name, SORT_ASC, $countries);
		$country_ids_array = array();
		$this->_pdata['country_name'] = $countries;
		foreach ($countries as $key => $country) {
			$country_ids_array[] = $country['id'];
			if($country['seo_url'] == $this->_pdata['country_slug']){
				$this->_pdata['country_display_name'] = $country['name'];
			}
		}
		$cities = $this->Utility_mdl->get_cities_by_country_ids($country_ids_array);
		foreach ($cities as $key => $row){
			$cityname[$key] = $row['name'];
		}
		array_multisort($cityname, SORT_ASC, $cities);
		foreach ($cities as $key => $city) {
			if($city['seo_url'] == $this->_pdata['city_slug']){
				$this->_pdata['city_display_name'] = $city['name'];
			}
		}
		$this->_pdata['city_name'] = $cities;
		
		$configurations = $this->Utility_mdl->get_settings('transportation');
		
		foreach ($configurations as $configuration) {
		    if($configuration['key'] == 'details_' . $language_code) {
		        $config = json_decode($configuration['value'], TRUE);
		        //$this->_pdata['transportation_configuration']['main_title'] = isset($config['main_title']) ? $config['main_title'] : '';
		        $this->_pdata['transportation_configuration']['private_dsc'] = isset($config['private_dsc']) ? $config['private_dsc'] : '';
		        $this->_pdata['transportation_configuration']['shared_dsc'] = isset($config['shared_dsc']) ? $config['shared_dsc'] : '';
		        $this->_pdata['transportation_configuration']['dsc'] = isset($config['dsc']) ? $config['dsc'] : '';
		    }
		}
		
		//get class
		$class_name = $this->router->class;
    	$class_title = ucwords(str_replace('_', ' ', str_replace('_ctrl', '', $class_name)));
    	$class_link = strtolower(str_replace(' ', '-', $class_title));
		// add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push($class_title, $class_link.'/'.$this->_pdata['country_slug'].'/'.$this->_pdata['city_slug']);
		// output
		$this->_pdata['output_breadcrumb'] = $this->breadcrumbs->show();
		
		$this->_pdata['optimized'] = $this->optimized;
		
		$transportation_banners = $this->Transportation_mdl->get_transportation_banners();
	
		foreach ($transportation_banners as $transportation_banner) {
		    $this->_pdata['transportation_banners'][$transportation_banner['section']][] = array(
		        'image' => $transportation_banner['image'],
		        'title' => $transportation_banner['title']
		    );
		}
		$this->template_lib->load_view($this,'__catalog/Transportation_list_view', $this->_pdata);
	}


	public function get($country_slug = null, $city_slug = null, $transportation_slug = null) {
		$this->load->model('__settings/Utility_mdl');
	    if($this->input->post()) {
			$this->form_validation->set_rules('passenger_number', 'lang:text_passenger', 'trim|required|numeric', array(
	            'required'=>$this->lang->line('required'),
	            'numeric'=>'Only digits allowed (1-9)',
	        ));
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='air_to_htl_trip'){
				$this->form_validation->set_rules('air_line_name', 'lang:text_airline', 'trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('flight_number','lang:text_flightnumber','trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('arrival_time','lang:text_arrivaltime', 'trim|required', array(
					'required'=>$this->lang->line('required'),
				));
				$this->form_validation->set_rules('arrival_date', 'lang:text_arrival_date', 'trim|required',array(
					'required'=>$this->lang->line('required'),
				));
			}
	        
			if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='htl_to_air_trip'){
				$this->form_validation->set_rules('departure_date', 'lang:text_dept_date', 'trim|required',array(
					'required'=>$this->lang->line('required'),
				));
				$this->form_validation->set_rules('dept_air_line_name', 'lang:text_airline', 'trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('dept_flight_number','lang:text_flightnumber','trim|required|min_length[3]|max_length[32]', array(
					'required'=>$this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('departure_time','lang:text_departuretime', 'trim|required', array(
					'required'=>$this->lang->line('required'),
				));
			}
	        if($this->form_validation->run() == FALSE) {
	            $this->session->set_flashdata('msg-error', validation_errors());
	        } else {
	            $_cart_data_array = array();
	            
	            $this->load->helper(array('cookie','dt'));
	            $cookie_data = get_cookie('_cart_token');
	            
	            $date_added = '';
	            $date_modified = '';
	            
	            if(isset($cookie_data)) {
					$this->_cartToken = $cookie_data;
	                $this->load->model('__checkout/Cart_mdl');
	                $_cart_data_mdl = $this->Cart_mdl->get_cart_data_by_cart_token($this->_cartToken);
					$_cart_data_array = json_decode($_cart_data_mdl['_cart_data__'], true);
	                
	                // KINDLY VALIDATE DATA BEFORE SUBMISSION
	                 $_cart_data_new_array = array(
						'transport_trip_type'=>	$this->input->post('triptype'),
						'airport_id'=>	$this->input->post('airportid'),
						'hotel_id'=>	$this->input->post('hotelid'),
						'no_of_adults' => $this->input->post('passenger_number'),
	                    'no_of_childs' => null,
						'arr_flight_name'=>	$this->input->post('air_line_name'),
						'arr_flight_num'=>	$this->input->post('flight_number'),
	                    'tour_start_date' => $this->input->post('arrival_date')!=''?lu_to_d($this->input->post('arrival_date')):'',
	                    'pickup_time' => $this->input->post('arrival_time'),
						'dept_flight_name'=>	$this->input->post('dept_air_line_name'),
						'dept_flight_num'=>	$this->input->post('dept_flight_number'),
	                    'tour_end_date' => $this->input->post('departure_date')!=''?lu_to_d($this->input->post('departure_date')):'',
	                    'drop_time' => $this->input->post('departure_time'),
	                );
	                $pid = $this->input->post('_pid');
	                $_cart_data_array['trip_type'][$this->input->post('trans_type')]['_pid'][$pid] = $_cart_data_new_array;
	                
	                $date_modified = lu_to_d(date('Y-m-d H:i:s'));
	                $date_added = $_cart_data_mdl['date_added'];
	            }else {
					$price= ($this->input->post('trans_type')=="private")?$this->input->post('privateprice'):$this->input->post('sharingprice');
					$date_added = lu_to_d(date('Y-m-d H:i:s'));
	                $date_modified = lu_to_d(date('Y-m-d H:i:s'));
	                $this->_cartToken = time().uniqid();
	                $this->_cartToken = $this->security_lib->encrypt($this->_cartToken);
	                set_cookie('_cart_token', $this->_cartToken, time() + (10 * 365 * 24 * 60 * 60));
	                $_cart_data_new_array = array(
						'transport_trip_type'=>	$this->input->post('triptype'),
						'airport_id'=>	$this->input->post('airportid'),
						'hotel_id'=>	$this->input->post('hotelid'),
						'no_of_adults' => $this->input->post('passenger_number'),
	                    'no_of_childs' => null,
						'arr_flight_name'=>	$this->input->post('air_line_name'),
						'arr_flight_num'=>	$this->input->post('flight_number'),
	                    'tour_start_date' => $this->input->post('arrival_date')!=''?lu_to_d($this->input->post('arrival_date')):'',
	                    'pickup_time' => $this->input->post('arrival_time'),
						'dept_flight_name'=>	$this->input->post('dept_air_line_name'),
						'dept_flight_num'=>	$this->input->post('dept_flight_number'),
	                    'tour_end_date' => $this->input->post('departure_date')!=''?lu_to_d($this->input->post('departure_date')):'',
	                    'drop_time' => $this->input->post('departure_time'),
	                );
	                $pid = $this->input->post('_pid');
	                $_cart_data_array['trip_type'][$this->input->post('trans_type')]['_pid'][$pid] = $_cart_data_new_array;
	            }
	            
	            $data = array(
	                '_cart_token__' => $this->_cartToken,
	                '_cart_data__' => json_encode($_cart_data_array),
	                'date_added' => $date_added,
	                'date_modified' => $date_modified,
	            );
	           $this->load->model('__checkout/Cart_mdl');
	           $this->Cart_mdl->add_data_to_cart($data);
	           redirect('cart');
	        }
	    }
	    
	    // WHAT EVER THE LANGUAGE SELECTED BY TOUR
	    if(!$this->session->has_userdata('site_lang')) {
	        $search_conditions['language_code'] = 'en';
	    } else {
	        $search_conditions['language_code'] = $this->session->userdata('site_lang');
	    }
	    
	    if(isset($country_slug)) {
	        $search_conditions['country_slug'] = $country_slug;
	        $this->_pdata['country_slug'] = $country_slug;
	    } else {
	        $search_conditions['country_slug'] = null;
	        $this->_pdata['country_slug'] = null;
	    }
	    
	    if(isset($city_slug)) {
	        $search_conditions['city_slug'] = $city_slug;
	        $this->_pdata['city_slug'] = $city_slug;
	    } else {
	        $search_conditions['city_slug'] = null;
	        $this->_pdata['city_slug'] = null;
	    }
	    
	    if(isset($transportation_slug)) {
	        $search_conditions['transportation_slug'] = $transportation_slug;
	        $this->_pdata['transportation_slug'] = $transportation_slug;
	    } else {
	        $search_conditions['transportation_slug'] = null;
	        $this->_pdata['transportation_slug'] = null;
	    }
		
		$hotels = $this->Transportation_mdl->get_hotels($this->_pdata['country_slug'],$this->_pdata['city_slug']);

		//$this->_pdata['hotels'] = array('--- Select Hotels ---');

		foreach ($hotels as $hotel) {
			$this->_pdata['hotels'][$hotel['id']] = $hotel['name']; 
		}

		$airports = $this->Transportation_mdl->get_airports( $this->_pdata['country_slug'],$this->_pdata['city_slug']);

		//$this->_pdata['airports'] = array('--- Select Airports ---');

		foreach ($airports as $airport) {
			$this->_pdata['airports'][$airport['id']] = $airport['name']; 
		}
		
		$this->_pdata['arr_blocked_dates'] = '';
		$this->_pdata['dep_blocked_dates'] = '';
		
		$countries = $this->Utility_mdl->get_countries();
		foreach ($countries as $key => $row){$name[$key] = $row['name'];}
		array_multisort($name, SORT_ASC, $countries);
		$country_ids_array = array();
		$this->_pdata['country_name'] = $countries;
		foreach ($countries as $key => $country) {
			$country_ids_array[] = $country['id'];
			if($country['seo_url'] == $this->_pdata['country_slug']){
				$this->_pdata['country_display_name'] = $country['name'];
			}
		}
		$cities = $this->Utility_mdl->get_cities_by_country_ids($country_ids_array);
		foreach ($cities as $key => $row){
			$cityname[$key] = $row['name'];
		}
		array_multisort($cityname, SORT_ASC, $cities);
		foreach ($cities as $key => $city) {
			if($city['seo_url'] == $this->_pdata['city_slug']){
				$this->_pdata['city_display_name'] = $city['name'];
			}
		}
		$this->_pdata['city_name'] = $cities;
		
		$this->_pdata['p_transport_type'] = $triptype= $this->input->post('triptype');
		$this->_pdata['p_airport_id'] = $airportid= $this->input->post('airportid');
		$this->_pdata['p_hotel_id'] = $hotelid= $this->input->post('hotelid');
		
		$searchdata = array(
			"transport_type"=>$triptype,
			"hotel_id"=>$hotelid,
			"airport_id"=>$airportid
		);

		$this->_pdata['transportations']= $this->Transportation_mdl->search_transportations($searchdata, $search_conditions['language_code']);
		
		if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='air_to_htl_trip'){
			$air_2_htl = $this->Transportation_mdl->get_transportation_by_air_2_htl($this->input->post('airportid'),$this->input->post('hotelid'));
			if(!empty($air_2_htl)){
				$blockdates = $this->Transportation_mdl->get_block_dates($air_2_htl['id']);
				$this->_pdata['arr_blocked_dates'] = '';
				foreach ($blockdates as $blockdate) {
					$this->_pdata['arr_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
				}
				$this->_pdata['arr_blocked_dates'] = chop($this->_pdata['arr_blocked_dates'], ",");
			}
		}
		
		if($this->input->post('triptype')=='round_trip' || $this->input->post('triptype')=='htl_to_air_trip'){
			$htl_2_air = $this->Transportation_mdl->get_transportation_by_htl_2_air($this->input->post('airportid'),$this->input->post('hotelid'));
			if(!empty($htl_2_air)){
				$blockdates = $this->Transportation_mdl->get_block_dates($htl_2_air['id']);
				$this->_pdata['dep_blocked_dates'] = '';
				foreach ($blockdates as $blockdate) {
					$this->_pdata['dep_blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
				}
				$this->_pdata['dep_blocked_dates'] = chop($this->_pdata['dep_blocked_dates'], ",");
			}
		}
	     
	    $this->_pdata['text_transfer_type'] = $this->lang->line('text_transfer_type');
		$this->_pdata['text_airport'] = $this->lang->line('text_airport');
		$this->_pdata['text_hotel'] = $this->lang->line('text_hotel');
		$this->_pdata['text_passenger'] = $this->lang->line('text_passenger');

		$this->_pdata['text_arrival_date'] = $this->lang->line('text_arrival_date');
		$this->_pdata['text_dept_date'] = $this->lang->line('text_dept_date');
		$this->_pdata['text_submit'] = $this->lang->line('text_submit');
		$this->_pdata['search'] = $this->lang->line('search');$this->_pdata['airline'] = $this->lang->line('text_airline');
		$this->_pdata['flightnumber'] = $this->lang->line('text_flightnumber');
		$this->_pdata['arrivaltime'] = $this->lang->line('text_arrivaltime');
		$this->_pdata['departuretime'] = $this->lang->line('text_departuretime');
		$this->_pdata['cartbutton'] = $this->lang->line('text_cart_button');
		$this->_pdata['fillinformation'] = $this->lang->line('text_fill_information');
		$this->_pdata['text_prefered_location']             = $this->lang->line('text_prefered_location');
	    
		//pr($this->_pdata);
		
	    $this->template_lib->load_view($this,'__catalog/Transportation_list_view', $this->_pdata);	
	}
}