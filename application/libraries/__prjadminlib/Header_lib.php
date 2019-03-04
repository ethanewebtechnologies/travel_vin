<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Header_lib {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        $this->_pdata['metalist'] = array(
            array(
                'property' => 'og:title',
                'content' => 'Travel'
            ),
        );
        
        $this->_pdata['csslist'] = array('custom');
    }
    
    public function get_header($obj) {
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__admin_default/Header', $siteLang);
        $this->_pdata['text_title'] = $obj->lang->line('text_title');
        
        $obj->load->view('__admin_default/Header_view', $this->_pdata);
    }
	
    public function get_dashboard_header($obj) {
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__admin_default/Dash_header', $siteLang);
        $this->_pdata['text_title'] = $obj->lang->line('text_title');
        
        $obj->load->view('__admin_dashboard/Dash_header_view', $this->_pdata);
    }
	
}
