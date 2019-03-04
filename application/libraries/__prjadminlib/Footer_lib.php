<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Footer_lib {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        
        // ANY DEFAULT LOADING HERE
        $this->_pdata['jslist'] = array('custom');
    }
    
    public function get_footer($obj) {
        $obj->load->view('__admin_default/Footer_view', $this->_pdata);
    }
	
    public function get_dashboard_footer($obj) {
        $obj->load->view('__admin_dashboard/Dash_footer_view');
    }
	
}
