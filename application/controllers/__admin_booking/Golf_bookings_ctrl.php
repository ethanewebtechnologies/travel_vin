<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Golf Bookings Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Golf_bookings_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Optimized',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array(
            'form', 
            'date', 
            'dt'
        ));
        
        $this->lang->load('__admin_booking/Booking', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        
        $search_conditions = array();
        
        $search_costumer_name = $this->input->get('search_costumer_name');
        
        if (isset($search_costumer_name)) {
            $search_conditions['search_costumer_name'] = trim($search_costumer_name);
            $this->_pdata['search_costumer_name'] = trim($search_costumer_name);
        } else {
            $search_conditions['search_costumer_name'] = null;
            $this->_pdata['search_costumer_name'] = null;
        }
        
        $search_booking_no = $this->input->get('search_booking_no');
        
        if (isset($search_booking_no)) {
            $search_conditions['search_booking_no'] = trim($search_booking_no);
            $this->_pdata['search_booking_no'] =  trim($search_booking_no);
        } else {
            $search_conditions['search_booking_no'] = null;
            $this->_pdata['search_booking_no'] = null;
        }
        
        $search_agent_name = $this->input->get('search_agent_name');
        
        if (isset($search_agent_name)) {
            $search_conditions['search_agent_name'] = trim($search_agent_name);
            $this->_pdata['search_agent_name'] = trim($search_agent_name);
        } else {
            $search_conditions['search_agent_name'] = null;
            $this->_pdata['search_agent_name'] = null;
        }
        
        $search_golf_start_date = $this->input->get('search_golf_start_date');
       
        if (isset($search_golf_start_date)) {
            $search_conditions['search_golf_start_date'] = trim($search_golf_start_date);
            $this->_pdata['search_golf_start_date'] = trim($search_golf_start_date);
        } else {
            $search_conditions['search_golf_start_date'] = null;
            $this->_pdata['search_golf_start_date'] = null;
        }
        $sort_booking_no = $this->input->get('sort_booking_no');
        
        if (isset($sort_booking_no)) {
            $search_conditions['sort_booking_no'] = trim($sort_booking_no);
            if($sort_booking_no=='ASC'){
                $this->_pdata['sort_booking_no'] = 'entypo-up-open';
            }
            else{
                $this->_pdata['sort_booking_no'] = 'entypo-down-open';
            }
            
        } else {
            $search_conditions['sort_booking_no'] = null;
            $this->_pdata['sort_booking_no'] = null;
        }
        
        $sort_customer_name = $this->input->get('sort_customer_name');
        
        if (isset($sort_customer_name)) {
            $search_conditions['sort_customer_name'] = trim($sort_customer_name);
            if($sort_customer_name=='ASC'){
                $this->_pdata['sort_customer_name'] = 'entypo-up-open';
            }
            else{
                $this->_pdata['sort_customer_name'] = 'entypo-down-open';
            }
            
        } else {
            $search_conditions['sort_customer_name'] = null;
            $this->_pdata['sort_customer_name'] = null;
        }
        
        $sort_agent_name = $this->input->get('sort_agent_name');
        
        if (isset($sort_agent_name)) {
            $search_conditions['sort_agent_name'] = trim($sort_agent_name);
            if($sort_agent_name=='ASC'){
                $this->_pdata['sort_agent_name'] = 'entypo-up-open';
            }
            else{
                $this->_pdata['sort_agent_name'] = 'entypo-down-open';
            }
            
        } else {
            $search_conditions['sort_agent_name'] = null;
            $this->_pdata['sort_agent_name'] = null;
        }
        
        $sort_golf_start_date = $this->input->get('sort_golf_start_date');
        
        if (isset($sort_golf_start_date)) {
            $search_conditions['sort_golf_start_date'] = trim($sort_golf_start_date);
            if($sort_golf_start_date=='ASC'){
                $this->_pdata['sort_golf_start_date'] = 'entypo-up-open';
            }
            else{
                $this->_pdata['sort_golf_start_date'] = 'entypo-down-open';
            }
            
        } else {
            $search_conditions['sort_golf_start_date'] = null;
            $this->_pdata['sort_golf_start_date'] = null;
        }
        
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->load->model('__admin_booking/Golf_bookings_mdl');
        $golf_bookings = $this->Golf_bookings_mdl->get_golf_bookings($search_conditions, $start, $limit);
        
        $customer_ids_array = array();
        $this->_pdata['golf_bookings'] = array();
        
        foreach ($golf_bookings as $golf_booking) {
            $customer_ids_array[] = $golf_booking['booking_customer_id'];
            $this->_pdata['golf_bookings'][] = $golf_booking;
        }
        
        $customers = $this->Golf_bookings_mdl->get_customers_name_by_ids($customer_ids_array);
        
        $this->_pdata['customers'] = array();
        
        foreach ($customers as $customer) {
            $this->_pdata['customers'][$customer['id']] = $customer['name'];
        }
        
        $this->_pdata['total_golf_bookings'] = $this->Golf_bookings_mdl->get_total_golf_bookings($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/booking/golf-bookings', $this->_pdata['total_golf_bookings'], $limit);
        
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_booking_name'] = $this->lang->line('text_booking_name');
        $this->_pdata['text_booking_type'] = $this->lang->line('text_booking_type');
        $this->_pdata['text_booking_date'] = $this->lang->line('text_booking_date');
        $this->_pdata['text_booking_expiry_date'] = $this->lang->line('text_booking_expiry_date');
        $this->_pdata['text_booking_status'] = $this->lang->line('text_booking_status');
        $this->_pdata['text_payment_status'] = $this->lang->line('text_payment_status');
        $this->_pdata['text_serial_num'] = $this->lang->line('text_serial_num');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_status'] = $this->lang->line('text_status');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        $this->_pdata['text_view'] = $this->lang->line('text_view');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        
        
        $this->load->model('__admin_settings/Utility_mdl');
        $payment_statuses = $this->Utility_mdl->get_payment_statuses();
        
        foreach ($payment_statuses as $payment_status) {
            $this->_pdata['payment_statuses'][$payment_status['id']] = $payment_status['name'];
        }
        
        $booking_statuses = $this->Utility_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__admin_booking/Golf_booking_list_view', $this->_pdata);
    }
    
    public function get() {
        $secure_token = $this->input->get('secure_token');
        $golf_booking_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_booking/Golf_bookings_mdl');
        $this->_pdata['golf_booking'] = $this->Golf_bookings_mdl->get_golf_booking($golf_booking_id);
       
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        
        $payment_statuses = $this->Golf_bookings_mdl->get_payment_statuses();
        
        foreach ($payment_statuses as $payment_status) {
            $this->_pdata['payment_statuses'][$payment_status['id']] = $payment_status['name'];
        }
        
        $booking_statuses = $this->Golf_bookings_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__admin_booking/Golf_booking_view', $this->_pdata);
    }
    
    public function confirm_bookings(){
        $this->load->model('__admin_booking/Golf_bookings_mdl');
        $this->Golf_bookings_mdl->confirm_bookings($this->input->get('data'));
        
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->load->model('__admin_booking/Bookings_mdl');
        $this->load->model('__admin_customer/Customer_mdl');
        $booking_ids = $this->input->get('data');
        $this->load->library('__commonlib/Email_lib');
        foreach($booking_ids as $bookingid){
            $email_data = array();
            $row_bookings = $this->Bookings_mdl->get_booking($bookingid);
            $customer_detail = $this->Customer_mdl->get_customer($row_bookings['booking_customer_id']);
            // customer mail for confirm booking
            $email_data['booking_number'] = $row_bookings['booking_no'];
            $email_data['booking_type'] = $row_bookings['booking_type'];
            $email_data['customer_name'] = $customer_detail['firstname'];
            $email_data['message'] = $this->lang->line('text_email_message_confirm');
            $email_data['title'] = $this->lang->line('text_page_title_confirm');
            $email_data['greeting'] = $this->lang->line('text_customer_greeting');
            $email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
            $email_data['text_email_admin'] = $this->lang->line('text_email_admin');
            $email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
            $to = $customer_detail['email'];
            $from = ADMIN_EMAIL;
            $from_title = $this->lang->line('text_email_title_confirm');
            $subject = $this->lang->line('text_email_subject_confirm');
            $body = $this->load->view('__email_template/Customer_booking_confirm_email', $email_data, TRUE);
            if($to != "") {
                $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
            }
        }
    }
    
    public function cancel_bookings(){
        $this->load->model('__admin_booking/Golf_bookings_mdl');
        $this->Golf_bookings_mdl->cancel_bookings($this->input->get('data'));
        
        $booking_ids = $this->input->get('data');
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->load->model('__admin_booking/Bookings_mdl');
        $this->load->model('__admin_customer/Customer_mdl');
        $this->load->library('__commonlib/Email_lib');
        foreach($booking_ids as $bookingid){
            $email_data = array();
            $row_bookings = $this->Bookings_mdl->get_booking($bookingid);
            $customer_detail = $this->Customer_mdl->get_customer($row_bookings['booking_customer_id']);
            // customer mail for cancel booking
            $email_data['booking_number'] = $row_bookings['booking_no'];
            $email_data['booking_type'] = $row_bookings['booking_type'];
            $email_data['customer_name'] = $customer_detail['firstname'];
            $email_data['message'] = $this->lang->line('text_email_message_cancel');
            $email_data['title'] = $this->lang->line('text_page_title_cancel');
            $email_data['greeting'] = $this->lang->line('text_customer_greeting');
            $email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
            $email_data['text_email_admin'] = $this->lang->line('text_email_admin');
            $email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
            $to = $customer_detail['email'];
            $from = ADMIN_EMAIL;
            $from_title = $this->lang->line('text_email_title_cancel');
            $subject = $this->lang->line('text_email_subject_cancel');
            $body = $this->load->view('__email_template/Customer_booking_cancel_email', $email_data, TRUE);
            if($to != "") {
                $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
            }
        }
    }
    
}