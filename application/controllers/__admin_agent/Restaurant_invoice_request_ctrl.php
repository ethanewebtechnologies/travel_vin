<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Invoice Request Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restaurant_invoice_request_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib',
        ));
        
        $this->load->helper(array(
            'form',
            'html',
            'date',
            'dt'
        ));
        
        $this->lang->load('__admin_booking/Booking', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        $search_conditions = array();
        
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
        $search_restaurant_invoice_date = $this->input->get('search_restaurant_invoice_date');
        
        if (isset($search_restaurant_invoice_date)) {
            $search_conditions['search_restaurant_invoice_date'] = trim($search_restaurant_invoice_date);
            $this->_pdata['search_restaurant_invoice_date'] = trim($search_restaurant_invoice_date);
        } else {
            $search_conditions['search_restaurant_invoice_date'] = null;
            $this->_pdata['search_restaurant_invoice_date'] = null;
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
        
        $sort_restaurant_invoice_date = $this->input->get('sort_restaurant_invoice_date');
        
        if (isset($sort_restaurant_invoice_date)) {
            $search_conditions['sort_restaurant_invoice_date'] = trim($sort_restaurant_invoice_date);
            if($sort_restaurant_invoice_date=='ASC'){
                $this->_pdata['sort_restaurant_invoice_date'] = 'entypo-up-open';
            }
            else{
                $this->_pdata['sort_restaurant_invoice_date'] = 'entypo-down-open';
            }
          } else {
            $search_conditions['sort_restaurant_invoice_date'] = null;
            $this->_pdata['sort_restaurant_invoice_date'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        $this->_pdata['restaurant_bookings'] = array();
        $this->load->model('__admin_agent/Restaurant_invoice_request_mdl');
        
        $restaurant_bookings	= $this->Restaurant_invoice_request_mdl->get_restaurant_bookings($search_conditions, $start, $limit);
        
        foreach ($restaurant_bookings as $restaurant_booking) {
            
            $this->_pdata['restaurant_bookings'][] = $restaurant_booking;
        }
        
        $this->_pdata['total_restaurant_bookings'] = $this->Restaurant_invoice_request_mdl->get_total_restaurant_bookings($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/booking/restaurant-bookings', $this->_pdata['total_restaurant_bookings'], $limit);
        
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
        
        $payment_statuses = $this->Restaurant_invoice_request_mdl->get_payment_statuses();
        
        foreach ($payment_statuses as $payment_status) {
            $this->_pdata['payment_statuses'][$payment_status['id']] = $payment_status['name'];
        }
        
        $booking_statuses = $this->Restaurant_invoice_request_mdl->get_booking_statuses();
        
        foreach ($booking_statuses as $booking_status) {
            $this->_pdata['booking_statuses'][$booking_status['id']] = $booking_status['name'];
        }
        
        $this->template_lib->load_view($this, '__admin_agent/Restaurant_invoice_request_list_view', $this->_pdata);
    }
    
    public function generate_invoice_in_bulk() {
        
        $this->load->model('__admin_agent/Restaurant_invoice_request_mdl');
        $this->load->library('__commonlib/Security_lib');
        
        $requested_booking_ids = $this->input->post('requested_booking_ids');
        $invoice_data = $this->Restaurant_invoice_request_mdl->get_invoice_data_by_booking_ids($requested_booking_ids);
        if(isset($invoice_data[0]['agent_id'])) {
            
            $vendor_id = $invoice_data[0]['agent_id'];
        }
        $vendor = $this->Restaurant_invoice_request_mdl->get_vendor_details($vendor_id);
        if(!empty($invoice_data)) {
            $vendor_invoice_no = isset($invoice_data[0]['invoice_no']) ? $invoice_data[0]['invoice_no'] : '';
            
            $path = TV_VENDOR_INVOICE_DIR . date('Y');
            
            if (!is_dir(str_replace('\\','/', getcwd()) . '/' . $path)) {
                @mkdir(str_replace('\\', '/', getcwd()) . '/' . $path, 0777);
            }
            
            $invoice_file = $vendor_invoice_no . TV_PDF_EXT;
            $invoice_file_with_path = $path . '/' . $invoice_file;
            
            $grand_total = 0;
            
            foreach($invoice_data as $data) {
                $grand_total += $data['agent_cost'];
            }
            
            $invoice_template_data['invoice_data'] = $invoice_data;
            $invoice_template_data['invoice_no'] = $vendor_invoice_no;
            $invoice_template_data['invoice_date'] = isset($invoice_data[0]['date_generated']) ? $invoice_data[0]['date_generated'] : '';
            $invoice_template_data['grand_total'] = $grand_total;
            $invoice_template_data['vendor'] = $vendor;
            
            $countries = $this->Restaurant_invoice_request_mdl->get_countries();
            
            foreach ($countries as $country) {
                $invoice_template_data['countries'][$country['id']] = $country['name'];
            }
            
            $cities = $this->Restaurant_invoice_request_mdl->get_cities();
            
            foreach ($cities as $city) {
                $invoice_template_data['cities'][$city['id']] = $city['name'];
            }
            
            $invoice_content = $this->load->view('__invoice_template/Vendor_invoice', $invoice_template_data, TRUE);
            
            $this->load->library('m_pdf');
            $this->m_pdf->pdf->WriteHTML($invoice_content);
            $this->m_pdf->pdf->Output($invoice_file_with_path, "F");
            
            foreach($invoice_data as $data) {
                $invoice[] = array(
                    'booking_id' => $data['booking_id'],
                    'invoice_no' => $vendor_invoice_no,
                    'invoice_amount' => $grand_total,
                    'invoice_type' => 'vendor',
                    'invoice_path' => $invoice_file_with_path,
                    'date_generated' => lu_to_d(date('Y-m-d H:i:s'))
                );
            }
            
            $countries = $this->Restaurant_invoice_request_mdl->get_countries();
            
            foreach ($countries as $country) {
                $this->_pdata['countries'][$country['id']] = $country['name'];
            }
            
            $cities = $this->Restaurant_invoice_request_mdl->get_cities();
            
            foreach ($cities as $city) {
                $this->_pdata['cities'][$city['id']] = $city['name'];
            }
            
            $this->Restaurant_invoice_request_mdl->add_invoice_path_data($invoice);
        }
        $php_data['secure_token'] = $this->security->get_csrf_token_name();
        $php_data['secure_hash'] = $this->security->get_csrf_hash();
        $this->output->set_content_type('application/json')->set_output(json_encode($php_data));
    }
    
    public function get_cities_by_country_id() {
        $country_id = $this->input->get('country_id');
        
        $this->load->model('__admin_agent/Restaurant_invoice_request_mdl');
        $data['cities'] = $this->Restaurant_invoice_request_mdl->get_cities_by_country_id($country_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
}