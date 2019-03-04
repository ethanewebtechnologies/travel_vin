<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: INFORMATION CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS	    : VINAY KUMAR SHARMA, NEERAJ, BIJENDRA SINGH,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Information_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            '__prjlib/Template_lib',
            '__commonlib/Optimized',
            '__commonlib/Breadcrumbs',
        ));
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
		
        $this->load->helper(array('form'));
        $this->lang->load('__default/Home', $siteLang);
        $this->lang->load('__catalog/Information', $siteLang);
    }
    
    public function index($country_slug, $city_slug) {
		
		/* LANGUAGE CODE  */
		$this->_pdata['text_overview']         = $this->lang->line('text_overview');
		$this->_pdata['text_information']         = $this->lang->line('text_information');
        $this->_pdata['text_things_to_do']      = $this->lang->line('text_things_to_do');
		$this->_pdata['text_prefered_location']             = $this->lang->line('text_prefered_location');
        
        if(!$this->session->has_userdata('site_lang')) {
            $siteLang = 'en';
        } else {
            $siteLang = $this->session->userdata('site_lang');
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
        } 
		else {
            $search_conditions['city_slug'] = null;
            $this->_pdata['city_slug'] = null;
        }
        
        $this->load->model('__catalog/Information_mdl');
        $this->_pdata['information'] = $this->Information_mdl->get_information($this->_pdata['country_slug'], $this->_pdata['city_slug'], $siteLang);
		
		$this->load->model('__settings/Utility_mdl');
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
		
		//get class
		$class_name = $this->router->class;
    	$class_title = ucwords(str_replace('_', ' ', str_replace('_ctrl', '', $class_name)));
    	$class_link = strtolower(str_replace(' ', '-', $class_title));
		// add breadcrumbs
		$this->breadcrumbs->push('Home', '/');
		$this->breadcrumbs->push($class_title, $class_link.'/'.$this->_pdata['country_slug'].'/'.$this->_pdata['city_slug']);
		// output
		$this->_pdata['output_breadcrumb'] = $this->breadcrumbs->show();
        
        $this->template_lib->load_view($this,'__catalog/Information_list_view', $this->_pdata); 
    }
}