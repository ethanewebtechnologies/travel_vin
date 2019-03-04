<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agent_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation','__prjlib/Template_lib','__prjlib/Header_lib', '__prjlib/Footer_lib'));
        $this->load->helper('form');
		$siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__admin_user/User', $siteLang);
        $this->lang->load('common', $siteLang);
        
    }

	
	# For Add Agent 
	public function add_agent(){
		
		  $this->template_lib->load_view($this,'__agent/Agent_add'); 
	}
    
    
}