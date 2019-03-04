<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() 
    {
        parent::__construct();
        // ANY DEFAULT LOADING HERE 
        
        $this->load->library(array('__prjadminlib/Header_lib','__prjadminlib/Footer_lib'));
        $this->load->helper(array('form'));
        $this->lang->load('__default/Home', 'en');
    }
    
    public function index()
    {
        
        // LOAD MODEL DATA HERE
        
        // SET LANGUAGE PARAMETERS
        $this->_pdata['submit'] = $this->lang->line('submit');
        
        
        // LOAD VIEW
        $this->header_lib->get_header($this);
        $this->load->view('__default/Home_view', $this->_pdata);
        $this->footer_lib->get_footer($this);
    }
}
