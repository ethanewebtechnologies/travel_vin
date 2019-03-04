<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Vendor Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Vendor_ctrl extends CI_Controller {
    
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        $this->session->set_userdata('site_lang', 'en');
    }
    
    public function index() {
		redirect('vendor/home/dashboard');
    }
}