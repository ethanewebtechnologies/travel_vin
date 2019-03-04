<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_lib {

    public function load_view($obj, $view, $data = array()) {
		$obj->load->library(array(
		    '__prjvendorlib/Header_lib',
		    '__prjvendorlib/Footer_lib',
		    '__prjvendorlib/Sidebar_lib',
		    '__commonlib/Optimized'
		));
		
        $obj->header_lib->get_dashboard_head($obj, $data);
		$obj->sidebar_lib->get_sidebar($obj, $data);
		$obj->header_lib->get_dashboard_header($obj, $data);
		$obj->load->view($view, $data);
        $obj->footer_lib->get_dashboard_footer($obj, $data);	
    }
    
    public function load_view_before_login($obj, $view, $data = array()) {
        $obj->load->library(array(
            '__prjvendorlib/Header_lib',
            '__prjvendorlib/Footer_lib',
        ));
        
        $obj->header_lib->get_header($obj);
        $obj->load->view($view, $data);
        $obj->footer_lib->get_footer($obj);
    }
}
