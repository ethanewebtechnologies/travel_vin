<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Restaurants CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS	    : VINAY KUMAR SHARMA, NEERAJ, BIJENDRA SINGH,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restaurants_ctrl extends CI_Controller {
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
        
        $this->load->helper(array(
            'form'
        ));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__catalog/Restaurant', $siteLang);
		$this->lang->load('form_validation', $siteLang);
    }
    
    public function index($country_slug = null, $city_slug = null) {
		$this->load->model('__settings/Utility_mdl');
        $search_conditions = array();
        
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
		
		if($this->input->get('sort_title')) {
        
            $search_conditions['sort_title'] = $this->input->get('sort_title');
            $this->_pdata['sort_title'] = $this->input->get('sort_title');
        } else {
            $search_conditions['sort_title'] = null;
            $this->_pdata['sort_title'] = null;
        }
        if($this->input->get('search_category_id')) {
            $search_conditions['search_category_id'] = $this->input->get('search_category_id');
            $this->_pdata['search_category_id'] = $this->input->get('search_category_id');
        } else {
            $search_conditions['search_category_id'] = null;
            $this->_pdata['search_category_id'] = null;
        }
        if($this->input->get('search_title')) {
            $search_conditions['search_title'] = $this->input->get('search_title');
            $this->_pdata['search_title'] = $this->input->get('search_title');
        } else {
            $search_conditions['search_title'] = null;
            $this->_pdata['search_title'] = null;
        }
        
        if($this->input->get('search_min_price')) {
            $search_conditions['search_min_price'] = $this->input->get('search_min_price');
            $this->_pdata['search_min_price'] = $this->input->get('search_min_price');
        } else {
            $search_conditions['search_min_price'] = null;
            $this->_pdata['search_min_price'] = null;
        }
        
        if($this->input->get('search_max_price')) {
            $search_conditions['search_max_price'] = $this->input->get('search_max_price');
            $this->_pdata['search_max_price'] = $this->input->get('search_max_price');
        } else {
            $search_conditions['search_max_price'] = null;
            $this->_pdata['search_max_price'] = null;
        }
		
		$this->_pdata['text_next']               		= $this->lang->line('text_next');
		$this->_pdata['text_previous']               	= $this->lang->line('text_previous');
		$this->_pdata['text_Destination'] = $this->lang->line('text_Destination');
        $this->_pdata['text_SortBy'] = $this->lang->line('text_SortBy');
        $this->_pdata['text_assending_name'] = $this->lang->line('text_assending_name');
        $this->_pdata['text_descending_name'] = $this->lang->line('text_descending_name');
        $this->_pdata['text_assending_price'] = $this->lang->line('text_assending_price');
        $this->_pdata['text_descending_price'] = $this->lang->line('text_descending_price');
        $this->_pdata['text_Price_Range'] = $this->lang->line('text_Price_Range');
        $this->_pdata['text_All'] = $this->lang->line('text_All');
        $this->_pdata['text_by_category'] = $this->lang->line('text_by_category');
        $this->_pdata['text_Search'] = $this->lang->line('text_Search');
        $this->_pdata['text_Book_Now'] = $this->lang->line('text_Book_Now');
        $this->_pdata['text_result']                  = $this->lang->line('text_result');
        $this->_pdata['text_results']                  = $this->lang->line('text_results');
        $this->_pdata['text_no_result']                  = $this->lang->line('text_no_result');
        $this->_pdata['text_found_for']                  = $this->lang->line('text_found_for');
        $this->_pdata['text_from_usd']                  = $this->lang->line('text_from_usd');
        $this->_pdata['text_price_range_1']             = $this->lang->line('text_price_range_1');
        $this->_pdata['text_price_range_2']             = $this->lang->line('text_price_range_2');
        $this->_pdata['text_price_range_3']             = $this->lang->line('text_price_range_3');
        $this->_pdata['text_price_range_4']             = $this->lang->line('text_price_range_4');
        $this->_pdata['text_price_range_5']             = $this->lang->line('text_price_range_5');
		$this->_pdata['option_default']                  = $this->lang->line('option_default');
		$this->_pdata['text_prefered_location']             = $this->lang->line('text_prefered_location');
        
        $start = $this->input->get('per_page');
        
        if(!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        $this->load->model('__catalog/Restaurant_mdl');
        $restaurants = $this->Restaurant_mdl->get_restaurants($search_conditions, $start, $limit);
        
        
        if(!empty($restaurants)) {
            $restaurant_ids_array = array();
            foreach ($restaurants as $key => $restaurant) {
                $restaurant_ids_array[] = $restaurant['id'];
                $this->_pdata['restaurants'][$restaurant['id']] = $restaurant;
                //$this->_pdata['restaurants'][$key]['bulk_images'] = $images;
            }
            
            $images = $this->Restaurant_mdl->get_restaurant_images_by_restaurant_ids($restaurant_ids_array);
            
            foreach ($images as $image) {
                if(!isset($this->_pdata['restaurants'][$image['item_id']]['image'])) {
                    $this->_pdata['restaurants'][$image['item_id']]['image'] = $image['image'];
                }
            }
            
            $this->_pdata['total_restaurants'] = $this->Restaurant_mdl->get_total_restaurants($search_conditions);
            $this->load->helper('paginator');
            $this->_pdata['pagination'] = generate_pagination_for_front($this, 'restaurants', $this->_pdata['total_restaurants'][0], $limit);
            
        } 
		else {
            $this->_pdata['no_records'] = 'No records found';
        }
        
        $this->_pdata['optimized'] = $this->optimized;
		
		$this->_pdata['target_url'] = base_url('restaurants'. '/' . $this->_pdata['country_slug'] . '/' . $this->_pdata['city_slug']);
		$this->_pdata['total_category_name'] = $this->Restaurant_mdl->get_category_name($search_conditions['language_code']);
		
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
		
		if(!$this->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $this->session->userdata('site_lang');
        }
		
		$configurations = $this->Utility_mdl->get_settings('restaurant');
		
		foreach ($configurations as $configuration) {
		    if($configuration['key'] == 'details_' . $language_code) {
		        $config = json_decode($configuration['value'], TRUE);
		        $this->_pdata['restaurant_configuration']['main_title'] = isset($config['main_title']) ? $config['main_title'] : '';
		        $this->_pdata['restaurant_configuration']['sub_title'] = isset($config['sub_title']) ? $config['sub_title'] : '';
		        $this->_pdata['restaurant_configuration']['boxed_title'] = isset($config['boxed_title']) ? $config['boxed_title'] : '';
		        $this->_pdata['restaurant_configuration']['dsc'] = isset($config['dsc']) ? $config['dsc'] : '';
		        $this->_pdata['restaurant_configuration']['banner_dsc'] = isset($config['banner_dsc']) ? $config['banner_dsc'] : '';
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
		
		$restaurant_banners = $this->Restaurant_mdl->get_restaurant_banners();
	
		foreach ($restaurant_banners as $restaurant_banner) {
		    $this->_pdata['restaurant_banners'][$restaurant_banner['section']][] = array(
		        'image' => $restaurant_banner['image'],
		        'title' => $restaurant_banner['title']
		    );
		}
        
        $this->template_lib->load_view($this,'__catalog/Restaurant_list_view', $this->_pdata);
    }
    
    
    
    public function get($country_slug = null, $city_slug = null, $restaurant_slug = null) {
        
        if($this->input->post()) {
            $this->form_validation->set_rules('booking_adults', 'lang:text_booking_adults', 'trim|required|numeric', array(
                'required'=>$this->lang->line('required'),
	            'numeric'=>'Only digits allowed (1-9)',
            ));
            
            
            $this->form_validation->set_rules('start_date', 'lang:text_restaurant_start_date', 'trim|required', array(
                'required'=>$this->lang->line('required'),
            ));
            
            $this->form_validation->set_rules('pickup_time', 'lang:text_pickup_time', 'trim|required', array(
                'required'=>$this->lang->line('required'),
            ));
            
            if ($this->form_validation->run() == FALSE) {
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
                        'tour_start_date' => $this->input->post('start_date'),
                        'tour_end_date' => $this->input->post('tour_end_date'),
                        'pickup_time' => $this->input->post('pickup_time'),
                        'no_of_adults' => $this->input->post('booking_adults'),
                        'no_of_childs' => $this->input->post('no_of_childs')
                    );
                    $pid = $this->input->post('_pid');
                    $_cart_data_array['trip_type']['restaurant']['_pid'][$pid] = $_cart_data_new_array;
                    
                    $date_modified = lu_to_d(date('Y-m-d H:i:s'));
                    $date_added = $_cart_data_mdl['date_added'];
                } else {
                    $date_added = lu_to_d(date('Y-m-d H:i:s'));
                    $date_modified = lu_to_d(date('Y-m-d H:i:s'));
                    
                    $this->_cartToken = time().uniqid();
                    $this->_cartToken = $this->security_lib->encrypt($this->_cartToken);
                    
                    set_cookie('_cart_token', $this->_cartToken, time() + (10 * 365 * 24 * 60 * 60));
                    
                    $_cart_data_new_array = array(
                        'tour_start_date' => $this->input->post('start_date'),
                        'tour_end_date' => $this->input->post('tour_end_date'),
                        'pickup_time' => $this->input->post('pickup_time'),
                        'no_of_adults' => $this->input->post('booking_adults'),
                        'no_of_childs' => $this->input->post('no_of_childs')
                    );
                    
                    $pid = $this->input->post('_pid');
                    $_cart_data_array['trip_type']['restaurant']['_pid'][$pid] = $_cart_data_new_array;
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
        
        if(isset($restaurant_slug)) {
            $search_conditions['restaurant_slug'] = $restaurant_slug;
            $this->_pdata['restaurant_slug'] = $restaurant_slug;
        } else {
            $search_conditions['restaurant_slug'] = null;
            $this->_pdata['restaurant_slug'] = null;
        }
        
        $this->load->model('__catalog/Restaurant_mdl');
        $this->_pdata['restaurant'] = $this->Restaurant_mdl->get_restaurant_detail($search_conditions);
        $this->_pdata['images'] = $this->Restaurant_mdl->get_restaurant_images_by_restaurant_ids($this->_pdata['restaurant']['restaurant_id']);
        
        $blockdates = $this->Restaurant_mdl->get_block_dates($this->_pdata['restaurant']['restaurant_id']);
        $this->_pdata['blocked_dates'] = '';
        foreach ($blockdates as $blockdate) {
            $this->_pdata['blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
        }
        
        $this->_pdata['blocked_dates'] = chop($this->_pdata['blocked_dates'], ",");
        $this->session->set_userdata('country_id', $this->_pdata['restaurant']['country_id']);
        
		$this->_pdata['text_next']               		= $this->lang->line('text_next');
		$this->_pdata['text_previous']               	= $this->lang->line('text_previous');
        $this->_pdata['text_booking_adults'] = $this->lang->line('text_booking_adults');
        $this->_pdata['text_price'] = $this->lang->line('text_price');
        $this->_pdata['text_restaurant_start_date'] = $this->lang->line('text_restaurant_start_date');
        $this->_pdata['text_pickup_time'] = $this->lang->line('text_pickup_time');
        $this->_pdata['text_description'] = $this->lang->line('text_description');
        $this->_pdata['text_submit'] = $this->lang->line('text_submit');
		$this->_pdata['text_price_range_1']             = $this->lang->line('text_price_range_1');
        $this->_pdata['text_price_range_2']             = $this->lang->line('text_price_range_2');
        $this->_pdata['text_price_range_3']             = $this->lang->line('text_price_range_3');
        $this->_pdata['text_price_range_4']             = $this->lang->line('text_price_range_4');
        $this->_pdata['text_price_range_5']             = $this->lang->line('text_price_range_5');
		$this->_pdata['text_prefered_location']             = $this->lang->line('text_prefered_location');
		
		//get class
		$class_name = $this->router->class;
    	$class_title = ucwords(str_replace('_', ' ', str_replace('_ctrl', '', $class_name)));
    	$class_link = strtolower(str_replace(' ', '-', $class_title));
		// add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push($class_title, $class_link.'/'.$this->_pdata['country_slug'].'/'.$this->_pdata['city_slug']);
		$this->breadcrumbs->push($this->_pdata['restaurant']['title'], $class_link.'/'.$this->_pdata['country_slug'].'/'.$this->_pdata['city_slug'].'/'.$this->_pdata['restaurant_slug']);
		// output
		$this->_pdata['output_breadcrumb'] = $this->breadcrumbs->show();
        
        $this->template_lib->load_view($this,'__catalog/Single_restaurant_details', $this->_pdata);
    }
}