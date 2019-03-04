<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Error 404 Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Error404_ctrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->lang->load('__default/Home', 'en');
    }
    
    public function index() {
        
        if($this->uri->segment(1) == 'admin') {
            $this->load->library(array(
                'form_validation',
                '__prjadminlib/Template_lib',
                '__commonlib/Security_lib'
            ));
            
            $this->template_lib->load_view($this, 'admin_error404_view', array());
        } else {
            $this->load->library(array(
                '__prjlib/Header_lib',
                '__prjlib/Footer_lib'
            ));
            
            // LOAD VIEW
            $this->header_lib->get_header($this);
            $this->load->view('error404_view');
            $this->footer_lib->get_footer($this);
        }
    }
}
