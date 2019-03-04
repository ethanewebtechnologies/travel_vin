<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Location_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct()
    {
        parent::__construct();
        // ANY DEFAULT LOADING HERE
        
        $this->load->library(array('__prjadminlib/Header_lib','__prjadminlib/Footer_lib','form_validation','__prjadminlib/Sidebar_lib','__prjadminlib/Template_lib'));
        $this->load->helper(array('form'));
        $this->load->model(array('__admin_default/Accounts_mdl','__admin_default/Location_mdl'));
        $this->lang->load('__admin_default/Login', 'en');
/* 		if(!isset($_SESSION['user'])){
			redirect('admin_default/login');
		} */

    }
    
    public function index()
    {
		$_pdata['countries'] = $this->Location_mdl->get_all_countries();
		echo "<pre>";print_r($_pdata);exit;
		$this->template_lib->load_view($this,'__admin_dashboard/location_view') ; 
		
    }
	
    public function add()
    {
		//$_pdata['countries'] = $this->Location_mdl->get_all_countries();
		//echo "<pre>";print_r($_pdata);exit;
		$this->template_lib->load_view($this,'__admin_dashboard/add_location_view') ; 
		
    }	
		
}
