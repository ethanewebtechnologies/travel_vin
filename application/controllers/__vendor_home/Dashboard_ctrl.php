<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Dashboard Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Dashboard_ctrl extends CI_Controller {
    
    // private instance an array
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            '__prjvendorlib/Template_lib',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array(
            'form',
          
        ));
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__admin_default/Dashboard', $siteLang);
        
        if(!$this->session->has_userdata('vendor')) {
            redirect('vendor/account/login');
        }
    }
    
    public function index() {
        $this->template_lib->load_view($this, '__vendor_home/Dashboard_view', $this->_pdata) ;
    }
}
