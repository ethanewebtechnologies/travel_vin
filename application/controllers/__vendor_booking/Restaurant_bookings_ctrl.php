<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: restaurant Bookings Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restaurant_bookings_ctrl extends CI_Controller {
    
    // private instance an array
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjvendorlib/Template_lib',
            '__commonlib/Optimized',
            '__commonlib/Security_lib'
        ));
        $this->load->helper(array('form', 'date', 'dt'));
        
        $this->lang->load('__vendor_booking/Booking', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
        $siteLang = $this->session->userdata('site_lang');
        
        
        if(!$this->session->has_userdata('vendor')) {
            redirect('vendor/account/login');
        }
    }
    
    public function index() {
        
        $search_conditions = array();
        
        if($this->session->has_userdata('vendor')) {
            $vendor = $this->session->userdata('vendor');
        }
        
        if (isset($vendor['id'])) {
            $search_conditions['vendor_id'] = $vendor['id'];
            $this->_pdata['vendor_id'] = $vendor['id'];
        } else {
            redirect('vendor/account/login');
        }
        
        $search_booking_no = $this->input->get('search_booking_no');
        
        if (isset($search_booking_no)) {
            $search_conditions['search_booking_no'] = trim($search_booking_no);
            $this->_pdata['search_booking_no'] = trim($search_booking_no);
        } else {
            $search_conditions['search_booking_no'] = null;
            $this->_pdata['search_booking_no'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->load->model('__vendor_booking/Restaurant_bookings_mdl');
        $restaurant_bookings	= $this->Restaurant_bookings_mdl->get_restaurant_bookings($search_conditions, $start, $limit);
        
        $customer_ids_array = array();
        $this->_pdata['restaurant_bookings'] = array();
        
        foreach ($restaurant_bookings as $restaurant_booking) {
            $customer_ids_array[] = $restaurant_booking['booking_customer_id'];
			$booking_ids_array[] = $restaurant_booking['booking_id']; 
            $this->_pdata['restaurant_bookings'][] = $restaurant_booking;
        }
		
		
		if(isset($booking_ids_array) && !empty($booking_ids_array)) {
            $invoice_paths = $this->Restaurant_bookings_mdl->get_invoice_paths($booking_ids_array);
        } else {
            $invoice_paths = array();
        }
		
		foreach ($invoice_paths as $invoice_path) {
            $this->_pdata['invoice_paths'][$invoice_path['booking_id']] = $invoice_path['invoice_path'];
        }
        
        if(isset($customer_ids_array) && !empty($customer_ids_array)) {
            $customers = $this->Restaurant_bookings_mdl->get_customers_name_by_ids($customer_ids_array);
        } else {
            $customers = array();
        }
        
        foreach ($customers as $customer) {
            $this->_pdata['customers'][$customer['id']] = $customer['name'];
        }
        
        $this->_pdata['total_restaurant_bookings'] = $this->Restaurant_bookings_mdl->get_total_restaurant_bookings($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'vendor/booking/restaurant-bookings', $this->_pdata['total_restaurant_bookings'], $limit);
        
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_booking_name'] = $this->lang->line('text_booking_name');
        
        $this->_pdata['text_booking_expiry_date'] = $this->lang->line('text_booking_expiry_date');
        $this->_pdata['text_customer_name'] = $this->lang->line('text_customer_name');
        $this->_pdata['text_booking_status'] = $this->lang->line('text_booking_status');
        $this->_pdata['text_payment_status'] = $this->lang->line('text_payment_status');
        
        $this->_pdata['text_booking_date'] = $this->lang->line('text_booking_date');
        $this->_pdata['text_restaurant_start_date'] = $this->lang->line('text_restaurant_start_date');
        $this->_pdata['text_booking_status'] = $this->lang->line('text_booking_status');
        $this->_pdata['text_payment_status'] = $this->lang->line('text_payment_status');
        $this->_pdata['text_serial_num'] = $this->lang->line('text_serial_num');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_status'] = $this->lang->line('text_status');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        $this->_pdata['text_view'] = $this->lang->line('text_view');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_invoice'] = $this->lang->line('text_invoice');
        
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        
        
        $payment_statuses = $this->Restaurant_bookings_mdl->get_payment_statuses();
        
        foreach ($payment_statuses as $payment_status) {
            $this->_pdata['payment_statuses'][$payment_status['id']] = $payment_status['name'];
        }
        
        $booking_statuses = $this->Restaurant_bookings_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__vendor_booking/Restaurant_bookings_list_view', $this->_pdata);
    }
    
    public function get() {
        $secure_token = $this->input->get('secure_token');
        $restaurant_booking_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__vendor_booking/Restaurant_bookings_mdl');
        $this->_pdata['restaurant_booking'] = $this->Restaurant_bookings_mdl->get_restaurant_booking($restaurant_booking_id);
        
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        
        $payment_statuses = $this->Restaurant_bookings_mdl->get_payment_statuses();
        
        foreach ($payment_statuses as $payment_status) {
            $this->_pdata['payment_statuses'][$payment_status['id']] = $payment_status['name'];
        }
        
        $booking_statuses = $this->Restaurant_bookings_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__vendor_booking/Restaurant_bookings_view', $this->_pdata);
    }
    
    public function invoice() {
        
        $secure_token = $this->input->get('secure_token');
        $restaurant_booking_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__vendor_booking/Restaurant_bookings_mdl');
        $invoice = $this->Restaurant_bookings_mdl->get_invoice_path($restaurant_booking_id);
        
        $this->output->set_content_type('pdf')->set_output(file_get_contents($invoice['invoice_path']));
    }
    
    public function download() {
        $secure_token = $this->input->get('secure_token');
        $restaurant_booking_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__vendor_booking/Restaurant_bookings_mdl');
        $invoice = $this->Restaurant_bookings_mdl->get_invoice_path($restaurant_booking_id);
        
        $this->load->helper('download');
        force_download($invoice['invoice_path'], NULL);
    }
    
    public function raise_invoice() {
        if ($this->input->is_ajax_request()) {
            $this->load->model('__vendor_booking/Restaurant_bookings_mdl');
            $this->form_validation->set_rules('invoice_no', 'Invoice Number', 'required', array(
                'required' => 'Invoice No. Required'
            ));
            $this->form_validation->set_rules('date_generated', 'Invoice Date', 'required', array(
                'required' => 'Invoice Date Required'
            ));
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                /*
                 * FIXED BY VINAY KUMAR SHARMA
                 *
                 * START
                 *
                 *  */
                $checked_ids = $this->input->post('checked_ids');
                foreach ($checked_ids as $checked_id) {
                    $data[] = [
                        'invoice_no' => $this->input->post('invoice_no'),
                        'date_generated' => lu_to_d($this->input->post('date_generated')),
                        'invoice_type' => 'vendor',
                        'booking_id' => $checked_id
                    ];
                }
                $this->Restaurant_bookings_mdl->add_invoice_no_with_date($data);
                /*
                 * END OF FIXED
                 *
                 *  */
				$this->load->model('__vendor_booking/Bookings_mdl');
				$this->load->library('__commonlib/Email_lib');
				foreach($checked_ids as $bookingid){
					$email_data = array();
					$row_bookings = $this->Bookings_mdl->get_booking($bookingid);
					$agent_detail = $this->Bookings_mdl->get_agent($row_bookings['agent_id']); 
					// admin mail for invoice request
					$email_data['booking_number'] = $row_bookings['booking_no'];
					$email_data['booking_type'] = $row_bookings['booking_type'];
					$email_data['message'] = $this->lang->line('text_email_message_vendor_invoice');
					$email_data['text_page_title'] = $this->lang->line('text_page_title_raise_invoice');
					$email_data['greeting'] = $this->lang->line('text_admin_greeting');
					$email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
					$email_data['text_email_admin'] = $this->lang->line('text_email_admin');
					$email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
					$to = ADMIN_EMAIL;
					$from = $agent_detail['admin_email'];
					$from_title = $this->lang->line('text_email_title_invoice_raise');
					$subject = $this->lang->line('text_email_subject_invoice_raise');
					$body = $this->load->view('__email_template/Vendor_raise_invoice_email', $email_data, TRUE);
					if($to != "") {
						$this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
					}
				}
            }
        }
        $php_data = array(
            'success' => 'Request has been raised Successfully!'
        );
        $php_data['secure_token'] = $this->security->get_csrf_token_name();
        $php_data['secure_hash'] = $this->security->get_csrf_hash();
        
        $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
    }
}
