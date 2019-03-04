<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: WEEDING CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS	    : VINAY KUMAR SHARMA, NEERAJ, BIJENDRA SINGH,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Weddings_ctrl extends CI_Controller {
    
    public function __construct() {
        parent::__construct();
        
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
        $this->lang->load('__catalog/Wedding', $siteLang);
    }
    public function index($country_slug = null, $city_slug = null) {
		$this->load->model('__settings/Utility_mdl');
        
        $search_conditions = array();
        
        if(!$this->session->has_userdata('site_lang')) {
            $search_conditions['language_code'] = 'en';
        }
        else {
            $search_conditions['language_code'] = $this->session->userdata('site_lang');
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
        
        /* if($this->input->get('search_min_price')) {
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
        } */
        
        $start = $this->input->get('per_page');
        
        if(!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        $this->load->model('__catalog/Wedding_mdl');
        $weddings = $this->Wedding_mdl->get_weddings($search_conditions, $start, $limit);
        
        if(!empty($weddings)) {
            
            $wedding_ids_array = array();
            
            foreach ($weddings as $key => $wedding) {
                $wedding_ids_array[] = $wedding['id'];
                $this->_pdata['weddings'][$wedding['id']] = $wedding;
            }
            
            $images = $this->Wedding_mdl->get_wedding_images_by_wedding_ids($wedding_ids_array);
            
            foreach ($images as $image) {
                
                if(!isset($this->_pdata['weddings'][$image['item_id']]['image'])) {
                    $this->_pdata['weddings'][$image['item_id']]['image'] = $image['image'];
                }
            }
            $this->_pdata['total_weddings'] = $this->Wedding_mdl->get_total_weddings($search_conditions);
            $this->load->helper('paginator');
            $this->_pdata['pagination'] = generate_pagination_for_front($this, 'weddings', $this->_pdata['total_weddings'][0], $limit);
        }
        else {
            $this->_pdata['no_records'] = 'No records found';
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
        
        $this->_pdata['optimized'] = $this->optimized;
		
		$this->_pdata['target_url'] = base_url('weddings'. '/' . $this->_pdata['country_slug'] . '/' . $this->_pdata['city_slug']);
        
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
        $this->_pdata['text_visit']             = $this->lang->line('text_visit');
		$this->_pdata['option_default']                  = $this->lang->line('option_default');
		$this->_pdata['text_prefered_location']             = $this->lang->line('text_prefered_location');
		
		$this->_pdata['total_category_name'] = $this->Wedding_mdl->get_category_name($search_conditions['language_code']);
		
		if(!$this->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $this->session->userdata('site_lang');
        }
		
		$configurations = $this->Utility_mdl->get_settings('wedding');
		
		foreach ($configurations as $configuration) {
		    if($configuration['key'] == 'details_' . $language_code) {
		        $config = json_decode($configuration['value'], TRUE);
		        $this->_pdata['wedding_configuration']['main_title'] = isset($config['main_title']) ? $config['main_title'] : '';
		        $this->_pdata['wedding_configuration']['sub_title'] = isset($config['sub_title']) ? $config['sub_title'] : '';
		        $this->_pdata['wedding_configuration']['boxed_title'] = isset($config['boxed_title']) ? $config['boxed_title'] : '';
		        $this->_pdata['wedding_configuration']['dsc'] = isset($config['dsc']) ? $config['dsc'] : '';
		        $this->_pdata['wedding_configuration']['banner_dsc'] = isset($config['banner_dsc']) ? $config['banner_dsc'] : '';
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
		
		$wedding_banners = $this->Wedding_mdl->get_wedding_banners();
		
		if(!empty($wedding_banners)){
		    foreach ($wedding_banners as $wedding_banner) {
		        $this->_pdata['wedding_banners'][$wedding_banner['section']][] = array(
		            'image' => $wedding_banner['image'],
		            'title' => $wedding_banner['title']
				);
			}			
		}
		//pr($this->_pdata);
        $this->template_lib->load_view($this,'__catalog/Wedding_list_view', $this->_pdata);
        
    }
    
    public function get($country_slug = null, $city_slug = null, $wedding_slug = null) {
        
        
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
        
        if(isset($wedding_slug)) {
            $search_conditions['wedding_slug'] = $wedding_slug;
            $this->_pdata['wedding_slug'] = $wedding_slug;
        } else {
            $search_conditions['wedding_slug'] = null;
            $this->_pdata['wedding_slug'] = null;
        }
        
        $this->load->model('__catalog/Wedding_mdl');
        $this->_pdata['wedding'] = $this->Wedding_mdl->get_wedding_detail($search_conditions);
        $this->_pdata['images'] = $this->Wedding_mdl->get_wedding_images_by_wedding_ids($this->_pdata['wedding']['wedding_id']);
        
        $this->_pdata['agent'] = $this->Wedding_mdl->get_agent_data_by_id($this->_pdata['wedding']['agent_id']);
        $blockdates = $this->Wedding_mdl->get_block_dates($this->_pdata['wedding']['wedding_id']);
        $this->_pdata['blocked_dates'] = '';
        foreach ($blockdates as $blockdate) {
            $this->_pdata['blocked_dates'] .= "'". d_to_lu($blockdate['block_date']) . "',";
        }
        $this->_pdata['blocked_dates'] = chop($this->_pdata['blocked_dates'], ",");
        $this->session->set_userdata('country_id', $this->_pdata['wedding']['country_id']);
        
		$this->_pdata['text_next']               		= $this->lang->line('text_next');
		$this->_pdata['text_previous']               	= $this->lang->line('text_previous');
        $this->_pdata['text_name'] = $this->lang->line('text_name');
        $this->_pdata['text_email'] = $this->lang->line('text_email');
        $this->_pdata['text_address'] = $this->lang->line('text_address');
        $this->_pdata['text_teliphpone'] = $this->lang->line('text_teliphpone');
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
		$this->breadcrumbs->push($this->_pdata['wedding']['title'], $class_link.'/'.$this->_pdata['country_slug'].'/'.$this->_pdata['city_slug'].'/'.$this->_pdata['wedding_slug']);
		// output
		$this->_pdata['output_breadcrumb'] = $this->breadcrumbs->show();
        
        $this->template_lib->load_view($this,'__catalog/Single_wedding_details', $this->_pdata);
    }
}