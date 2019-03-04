<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Home Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Home_ctrl extends CI_Controller {
    
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        // ANY DEFAULT LOADING HERE
        
        $this->load->library(array(
            'session', 
            '__prjlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized'
        ));
        
        $this->load->helper(array('form', 'dt'));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__default/Home', $siteLang);
    }
    
    public function index() {
        // LOAD MODEL DATA HERE
        $this->load->model('__default/Home_mdl');
        $home_banners = $this->Home_mdl->get_home_banners();
        
        foreach ($home_banners as $home_banner) {
            $this->_pdata['home_banners'][$home_banner['section']][] = array(
                'image' => $home_banner['image'],
                'title' => $home_banner['title']
            );
        }
        
        $arriving_countries = $this->Home_mdl->get_country_and_availabilities();
        
        $this->_pdata['arriving_countries'] = array();
         
        foreach ($arriving_countries as $arriving_country) {
            $this->_pdata['arriving_countries'][$arriving_country['id']] = array(
                'name' => $arriving_country['name'],
                'date_of_arrival' => $arriving_country['date_of_arrival']
            );
        }
        
        if(!$this->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $this->session->userdata('site_lang');
        }
        
        $this->_pdata['popular_tours'] = $this->Home_mdl->popular_tours($language_code);
		//pr($this->_pdata['popular_tours']);
        $special_tours = $this->Home_mdl->special_tours($language_code);
        
        $sn = 1;
        foreach ($special_tours as $special_tour) {
            $this->_pdata['special_tour'][$sn] = array(
                'title' => $special_tour['title'],
                'adult_price' => $special_tour['adult_price'],
                'image' => $special_tour['image'],
            );
            
            $sn++;
        }
        
        $this->load->model('__settings/Utility_mdl');
        $configurations = $this->Utility_mdl->get_settings('home');
        
        foreach ($configurations as $configuration) {
            if($configuration['key'] == 'details_' . $language_code) {
                $config = json_decode($configuration['value'], TRUE);
                $this->_pdata['home_configuration']['main_title'] = isset($config['main_title']) ? $config['main_title'] : '';
                $this->_pdata['home_configuration']['sub_title'] = isset($config['sub_title']) ? $config['sub_title'] : '';
                $this->_pdata['home_configuration']['boxed_title'] = isset($config['boxed_title']) ? $config['boxed_title'] : '';
                $this->_pdata['home_configuration']['dsc'] = isset($config['dsc']) ? $config['dsc'] : '';
                $this->_pdata['home_configuration']['banner_dsc'] = isset($config['banner_dsc']) ? $config['banner_dsc'] : '';
                $this->_pdata['home_configuration']['video_url'] = isset($config['video_url']) ? $config['video_url'] : '';
            }
        }
        
        $this->_pdata['countries'] = $this->Utility_mdl->get_countries();
        $this->_pdata['cities'] = $this->Utility_mdl->get_cities();
         
        // SET LANGUAGE PARAMETERS
        $this->_pdata['text_submit'] = $this->lang->line('text_submit');
        $this->_pdata['text_btn_prev'] = $this->lang->line('text_btn_prev');
        $this->_pdata['text_btn_next'] = $this->lang->line('text_btn_next');
        $this->_pdata['text_my_dreams'] = $this->lang->line('text_my_dreams');
        $this->_pdata['text_click_to_play'] = $this->lang->line('text_click_to_play');
        $this->_pdata['text_transportation'] = $this->lang->line('text_transportation');
        $this->_pdata['text_placeholder_country'] = $this->lang->line('text_placeholder_country');
        $this->_pdata['text_placeholder_city'] = $this->lang->line('text_placeholder_city');
        $this->_pdata['text_btn_search'] = $this->lang->line('text_btn_search');
        $this->_pdata['text_upcoming'] = $this->lang->line('text_upcoming');
        $this->_pdata['text_arrivals'] = $this->lang->line('text_arrivals');
        $this->_pdata['text_country'] = $this->lang->line('text_country');
        $this->_pdata['text_availability'] = $this->lang->line('text_availability');
        $this->_pdata['text_heading_popular_tours'] = $this->lang->line('text_heading_popular_tours');
        $this->_pdata['text_heading_special_tours'] = $this->lang->line('text_heading_special_tours');
        $this->_pdata['text_view_all_tours'] = $this->lang->line('text_view_all_tours');
        $this->_pdata['text_from'] = $this->lang->line('text_from');
        
        // LOAD VIEW
        $this->_pdata['optimized'] = $this->optimized; 
        $this->template_lib->load_view($this, '__default/Home_view', $this->_pdata);
    }
    
    public function set_country() {
        $country = $this->input->get('country');
        $this->session->set_userdata('sess_country', $country);
        
        $this->output->set_content_type('application/json')->set_output(true);
    }
    
    public function set_city() {
        $city = $this->input->get('city');
        $this->session->set_userdata('sess_city', $city);
        
        $this->output->set_content_type('application/json')->set_output(true);
    }
    
    public function get_cities_by_country_seo_url() {
        $seo_url = $this->input->get('seo_url');
        $this->load->model('__settings/Utility_mdl');
        $country_data = $this->Utility_mdl->get_tbl_country_by_seo_url($seo_url);
        $data['cities'] = $this->Utility_mdl->get_cities_by_country_id($country_data['id']);
		//pr($data['cities']);
		/* echo "<option value>---Select a city---</option>";
		foreach($cities as $city){
			echo"<option value='".$city['seo_url']."'>".$city['name']."</option>";  
		} */
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
}
