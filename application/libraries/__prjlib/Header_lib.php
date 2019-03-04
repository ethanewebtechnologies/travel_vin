<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Header library
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Header_lib {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        $this->_pdata['title'] = 'Sunshine Great Tours';
        
        $this->_pdata['css_list'] = array(
            
        );
        
        $this->_pdata['meta_list'] = array(
            
        );
		
    }
    
    public function set_css($css_list = array()) {
        array_merge($this->_pdata['css_list'], $css_list);
    }
    
    public function set_meta_content($meta_content = array()) {
        array_merge($this->_pdata['meta_list'], $meta_content);
    }
    
    public function get_header($obj) {
        if(!$obj->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $obj->session->userdata('site_lang');
        }
        
        $obj->lang->load('__default/Header', $language_code);
        
        $this->_pdata['text_subtitle'] = $obj->lang->line('text_subtitle');
        $this->_pdata['text_greetings'] = $obj->lang->line('text_greetings');
        $this->_pdata['text_guest'] = $obj->lang->line('text_guest');
		
        $this->_pdata['text_dashboard'] = $obj->lang->line('text_dashboard');
        $this->_pdata['text_orders'] = $obj->lang->line('text_orders');
        $this->_pdata['text_login'] = $obj->lang->line('text_login');
        $this->_pdata['text_logout'] = $obj->lang->line('text_logout');
        $this->_pdata['text_user_login'] = $obj->lang->line('text_user_login');
        $this->_pdata['text_agent_login'] = $obj->lang->line('text_agent_login');
        $this->_pdata['text_forgot_password'] = $obj->lang->line('text_forgot_password');
        $this->_pdata['text_register'] = $obj->lang->line('text_register');
        $this->_pdata['text_register_as_user'] = $obj->lang->line('text_register_as_user');
        $this->_pdata['text_register_as_agent'] = $obj->lang->line('text_register_as_agent');
        $this->_pdata['text_contact_center'] = $obj->lang->line('text_contact_center');
        $this->_pdata['text_contact_us'] = $obj->lang->line('text_contact_us');
        
        /* UPDATED MENU ITEM */
        $this->_pdata['menues'] = array(
            array(
                'name' => 'Home',
                'link' => base_url(),
                'link_slug' => '',
                'has_loc' => TRUE,
                'is_active' => FALSE
            ),     
            array(
                'name' => 'Information',
                'link' => base_url('information'),
                'link_slug' => 'information',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ),   
            array(
                'name' => 'Tours',
                'link' => base_url('tours'),
                'link_slug' => 'tours',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ),   
            array(
                'name' => 'Deals',
                'link' => base_url('deals'),
                'link_slug' => 'deals',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ),   
            array(
                'name' => 'Transportation',
                'link' => base_url('transportation'),
                'link_slug' => 'transportation',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ),   
            array(
                'name' => 'Elite Tours',
                'link' => base_url('elite-tours'),
                'link_slug' => 'elite-tours',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ),
            array(
                'name' => 'Golf',
                'link' => base_url('golfs'),
                'link_slug' => 'golfs',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ), 
            array(
                'name' => 'RESTAURANTS',
                'link' => base_url('restaurants'),
                'link_slug' => 'restaurants',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ), 
            array(
                'name' => 'CLUBS &amp; BARS',
                'link' => base_url('clubs-and-bars'),
                'link_slug' => 'clubs-and-bars',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ), 
            array(
                'name' => 'WEDDINGS',
                'link' => base_url('weddings'),
                'link_slug' => 'weddings',
                'has_loc' => FALSE,
                'is_active' => FALSE
            ), 
        );
        
        foreach ($this->_pdata['menues'] as $key => $menu) {
            if($obj->uri->segment(1) == $menu['link_slug']) {
                $this->_pdata['menues'][$key]['is_active'] = TRUE;
            }
        }
        
        if($obj->session->has_userdata('sess_country') && $obj->session->has_userdata('sess_city')) {
            foreach ($this->_pdata['menues'] as $key => $menu) {
                if($menu['name'] != 'Home') {
                    $this->_pdata['menues'][$key]['has_loc'] = TRUE;
                    $this->_pdata['menues'][$key]['link'] = $this->_pdata['menues'][$key]['link'] . '/' . $obj->session->userdata('sess_country') . '/' . $obj->session->userdata('sess_city');
                } else {
                    $this->_pdata['menues'][$key]['has_loc'] = TRUE;
                }
            }
        }
        
        $this->_pdata['languages'] = array(
            'ch' => $obj->lang->line('text_chinese'),
            'en' => $obj->lang->line('text_english'),
            'fr' => $obj->lang->line('text_french'),
            'gr' => $obj->lang->line('text_german'),
            'it' => $obj->lang->line('text_italian'),
            'jp' => $obj->lang->line('text_japnese'),
            'pr' => $obj->lang->line('text_portuguese'),
            'ru' => $obj->lang->line('text_russian'),
            'sp' => $obj->lang->line('text_spanish')
        );
		
		
		if(!$obj->session->has_userdata('site_lang')) {
            $language_code = 'en';
        } else {
            $language_code = $obj->session->userdata('site_lang');
        }
		
		$obj->load->model('__settings/Utility_mdl');
        $configurations = $obj->Utility_mdl->get_settings('header');
        
        $this->_pdata['header_configuration']['contact_us'] = '';
        
        if(isset($configurations) && !empty($configurations)) { 
            foreach ($configurations as $configuration) {
                if($configuration['key'] == 'details_' . $language_code) {
                    $config = json_decode($configuration['value'], TRUE);
                    
                    $this->_pdata['header_configuration']['contact_us'] = isset($config['contact_us']) ? $config['contact_us'] : '';
                }
				if($configuration['key'] == 'details_en'){
					$config = json_decode($configuration['value'], TRUE);
					$this->_pdata['header_configuration']['social_fb'] = isset($config['social_fb']) ? $config['social_fb'] : '';
					$this->_pdata['header_configuration']['social_insta'] = isset($config['social_insta']) ? $config['social_insta'] : '';
					$this->_pdata['header_configuration']['social_twitter'] = isset($config['social_twitter']) ? $config['social_twitter'] : '';
				}
            }
        }
			
        $obj->load->view('__default/Header_view', $this->_pdata);
    }
}
