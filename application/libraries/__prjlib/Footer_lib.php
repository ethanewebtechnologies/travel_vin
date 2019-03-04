<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Footer library
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Footer_lib {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        // ANY DEFAULT LOADING HERE
        $this->_pdata['jslist'] = array('custom');
    }
    
    public function get_footer($obj) {
        
        if(!$obj->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $obj->session->userdata('site_lang');
        }
        
        $obj->lang->load('__default/Footer', $language_code);
        $this->_pdata['text_placeholder_provide_email'] = $obj->lang->line('text_placeholder_provide_email');
        $this->_pdata['text_button_subscribe'] = $obj->lang->line('text_button_subscribe');
        $this->_pdata['text_title_newsletter'] = $obj->lang->line('text_title_newsletter');
        $this->_pdata['text_business_talk'] = $obj->lang->line('text_business_talk');
        $this->_pdata['text_button_click_here'] = $obj->lang->line('text_button_click_here');
        $this->_pdata['text_live_chat'] = $obj->lang->line('text_live_chat');
        $this->_pdata['text_select_location'] = $obj->lang->line('text_select_location');
        $this->_pdata['text_select_country'] = $obj->lang->line('text_select_country');
        $this->_pdata['text_select_city'] = $obj->lang->line('text_select_city');
        $this->_pdata['text_button_search'] = $obj->lang->line('text_button_search');
        $this->_pdata['text_button_footer_register_now'] = $obj->lang->line('text_button_footer_register_now');
        $this->_pdata['text_sitemap'] = $obj->lang->line('text_sitemap');
        $this->_pdata['text_home'] = $obj->lang->line('text_home');
        $this->_pdata['text_top_destination'] = $obj->lang->line('text_top_destination');
        $this->_pdata['text_travel_blog'] = $obj->lang->line('text_travel_blog');
        $this->_pdata['text_contact_us'] = $obj->lang->line('text_contact_us');
        $this->_pdata['text_agent_portal'] = $obj->lang->line('text_agent_portal');
		
		$this->_pdata['items_container'] = array(
			'' => $obj->lang->line('text_item_none'),
			'information' => $obj->lang->line('text_item_information'),
			'tours' => $obj->lang->line('text_item_tours'),
			'deals' => $obj->lang->line('text_item_deals'),
			'transportation' => $obj->lang->line('text_item_transportation'),
			'elite-tours' => $obj->lang->line('text_item_elite_tours'),
			'golfs' => $obj->lang->line('text_item_golfs'),
			'restaurants' => $obj->lang->line('text_item_restaurants'),
			'clubs-and-bars' => $obj->lang->line('text_item_club_bars'),
			'weddings' => $obj->lang->line('text_item_weddings'),
		);
        
        
        $obj->load->model('__default/Footer_mdl');
        $obj->load->helper('form');
        
        $this->_pdata['countries'] = $obj->Footer_mdl->get_countries();
        $this->_pdata['cities'] = $obj->Footer_mdl->get_cities();
        $this->_pdata['pages'] = $obj->Footer_mdl->getStaticPages();
        
        $obj->load->model('__settings/Utility_mdl');
        $configurations = $obj->Utility_mdl->get_settings('footer');
        
        $this->_pdata['footer_configuration']['contact_us'] = '';
        
        if(isset($configurations) && !empty($configurations)) { 
            foreach ($configurations as $configuration) {
                
                if($configuration['key'] == 'details_' . $language_code) {
                    $config = json_decode($configuration['value'], TRUE);
                    
                    $this->_pdata['footer_configuration']['contact_us'] = isset($config['contact_us']) ? $config['contact_us'] : '';
                    $this->_pdata['footer_configuration']['copyright'] = isset($config['copyright']) ? $config['copyright'] : '';
                    $this->_pdata['footer_configuration']['blog_1_title'] = isset($config['blog_1_title']) ? $config['blog_1_title'] : '';
                    $this->_pdata['footer_configuration']['blog_1_link'] = isset($config['blog_1_link']) ? $config['blog_1_link'] : '';
					$this->_pdata['footer_configuration']['blog_2_title'] = isset($config['blog_2_title']) ? $config['blog_2_title'] : '';
                    $this->_pdata['footer_configuration']['blog_2_link'] = isset($config['blog_2_link']) ? $config['blog_2_link'] : '';
					$this->_pdata['footer_configuration']['blog_3_title'] = isset($config['blog_3_title']) ? $config['blog_3_title'] : '';
                    $this->_pdata['footer_configuration']['blog_3_link'] = isset($config['blog_3_link']) ? $config['blog_3_link'] : '';
					$this->_pdata['footer_configuration']['blog_4_title'] = isset($config['blog_4_title']) ? $config['blog_4_title'] : '';
                    $this->_pdata['footer_configuration']['blog_4_link'] = isset($config['blog_4_link']) ? $config['blog_4_link'] : '';
					$this->_pdata['footer_configuration']['blog_5_title'] = isset($config['blog_5_title']) ? $config['blog_5_title'] : '';
                    $this->_pdata['footer_configuration']['blog_5_link'] = isset($config['blog_5_link']) ? $config['blog_5_link'] : '';
                }
                
				if($configuration['key'] == 'details_en') {
					$config = json_decode($configuration['value'], TRUE);
					
					$this->_pdata['footer_configuration']['social_fb'] = isset($config['social_fb']) ? $config['social_fb'] : '';
					$this->_pdata['footer_configuration']['social_insta'] = isset($config['social_insta']) ? $config['social_insta'] : '';
					$this->_pdata['footer_configuration']['social_twitter'] = isset($config['social_twitter']) ? $config['social_twitter'] : '';
				}
            }
        }
        
        $obj->load->view('__default/Footer_view', $this->_pdata);
    }
}
