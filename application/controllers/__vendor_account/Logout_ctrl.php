<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Vendor Logout Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Logout_ctrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $this->session->unset_userdata('vendor');
        redirect('vendor/account/login');
    }	
}