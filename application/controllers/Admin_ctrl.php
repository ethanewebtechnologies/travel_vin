<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Admin Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Admin_ctrl extends CI_Controller {
    
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->session->set_userdata('site_lang', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load('__default/Home', $siteLang);
    }
    
    public function index() {
        redirect('admin/account/login');
    }
}