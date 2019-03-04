<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_lib {

    public function load_view($obj, $view, $data = array()) {
		$obj->load->library(array(
		    '__prjadminlib/Header_lib',
		    '__prjadminlib/Footer_lib',
		    '__prjadminlib/Sidebar_lib'
		));
		
		$obj->load->helper('html');
        $obj->header_lib->get_dashboard_header($obj);
		$obj->sidebar_lib->get_sidebar($obj);
		$obj->load->view($view, $data);
        $obj->footer_lib->get_dashboard_footer($obj);	
    }
    
    public function load_view_before_login($obj, $view, $data = array()) {
        $obj->load->library(array(
            '__prjadminlib/Header_lib',
            '__prjadminlib/Footer_lib',
        ));
        
        $obj->header_lib->get_header($obj);
        $obj->load->view($view, $data);
        $obj->footer_lib->get_footer($obj);
    }
}
