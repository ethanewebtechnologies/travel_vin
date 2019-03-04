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
            )
        );
        
        $this->_pdata['csslist'] = array('custom');
    }
    
    public function get_header($obj) {
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__admin_default/Header', $siteLang);
        $this->_pdata['text_title'] = $obj->lang->line('text_title');
        
        $obj->load->view('__vendor_home/Header_view', $this->_pdata);
    }
    
    public function get_dashboard_head($obj) {
			$obj->load->helper('html');
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__admin_default/Dash_header', $siteLang);
        $this->_pdata['text_title'] = $obj->lang->line('text_title');
        
        $obj->load->view('__vendor_home/Dashboard_head_view', $this->_pdata);
    }
	
    public function get_dashboard_header($obj) {
	
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__admin_default/Dash_header', $siteLang);
        $this->_pdata['text_title'] = $obj->lang->line('text_title');
        
        $this->_pdata['_session_vendor'] = $obj->session->userdata('vendor'); 
        
        $class_name = $obj->router->class;
        $class_name = ucfirst(str_replace('_', ' ', str_replace('_ctrl', '', $class_name)));
        
        $method_name = $obj->router->method;
        $method_name = ucfirst(str_replace('_', '-', $method_name));
        
        $bread = array(
            base_url($obj->uri->segment(1)) => 'Home',
        );
        
        if($method_name != 'Index') {
            $bread[base_url($obj->uri->segment(1) . '/' . $obj->uri->segment(2) . '/' . $obj->uri->segment(3) . '/' . $obj->uri->segment(4))] = $method_name;
        } else {
            $bread[base_url($obj->uri->segment(1) . '/' . $obj->uri->segment(2) . '/' . $obj->uri->segment(3))] = $class_name;
        }
        
        $this->_pdata['breadcrumb'] = breadcrumb($bread);
        
        if($obj->session->flashdata('error_flash_messages') != "") {
            $this->_pdata['error_flash_messages'] = $obj->session->flashdata('error_flash_messages');
        } else {
            $this->_pdata['error_flash_messages'] = array();
        }
        
        if($obj->session->flashdata('success_flash_messages') != "") {
            $this->_pdata['success_flash_messages'] = $obj->session->flashdata('success_flash_messages');
        } else {
            $this->_pdata['success_flash_messages'] = array();
        }
        
        $obj->load->view('__vendor_home/Dashboard_header_view', $this->_pdata);
    }
	
}
