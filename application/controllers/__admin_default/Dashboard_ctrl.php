<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Dashboard Controller
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Dashboard_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        // ANY DEFAULT LOADING HERE
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib'
        ));
        
        $this->load->helper(array('form'));
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__admin_default/Dashboard', $siteLang);
    }
    
    public function index() {
        
        $this->load->model('__admin_dashboard/Dashboard_mdl');
        $this->_pdata['total_customers'] = $this->Dashboard_mdl->get_total_customers();
        $this->_pdata['total_bookings'] = $this->Dashboard_mdl->get_total_bookings();
        $this->_pdata['total_parks'] = $this->Dashboard_mdl->get_total_parks();
        $this->_pdata['bookings'] = $this->Dashboard_mdl->get_bookings();
        
        $this->load->model('__admin_settings/Utility_mdl');
        $booking_statuses = $this->Utility_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__admin_dashboard/Home_view', $this->_pdata); 
    }
}
