<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Invoice Request Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Invoice_request_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_tour_bookings($conditions = array(), $start, $limit) {
        
        $this->db->select("t1.*,t2.date_generated, t3.company_legal_name,t3.email")
			->from('tv_bookings_tbl as t1')
				->join("tv_booking_invoice_tbl as t2", 't2.booking_id=t1.booking_id','left')
					->join("tv_agent_tbl t3", "t1.agent_id = t3.id",'left');
        
        $this->db->where('t1.vendor_request_status', TV_VENDOR_REQUEST_ON);
        $this->db->where('t1.booking_type', 'tour');
        $this->db->where('t2.invoice_type', 'vendor');
        //$this->db->group_by('t1.booking_id');
        
		/* if (isset($conditions['search_costumer_name']) && !empty($conditions['search_costumer_name'])){
			$this->db->like("concat(t4.firstname,' ', t4.lastname)", $conditions['search_costumer_name']);
		} */
		if (isset($conditions['search_booking_no']) && !empty($conditions['search_booking_no'])) {
			$this->db->like('t1.booking_no', $conditions['search_booking_no']);
		}
		if (isset($conditions['search_agent_name']) && !empty($conditions['search_agent_name'])) {
			$this->db->like('t3.company_legal_name', $conditions['search_agent_name']);
		}
		if (isset($conditions['search_tour_invoice_date']) && !empty($conditions['search_tour_invoice_date'])) {
			$this->db->where('t2.date_generated', lu_to_d($conditions['search_tour_invoice_date']));
		}
		/* if (isset($conditions['sort_customer_name']) && !empty($conditions['sort_customer_name'])) {
			$this->db->order_by("t4.firstname", $conditions['sort_customer_name']);
		} */
		if (isset($conditions['sort_agent_name']) && !empty($conditions['sort_agent_name'])) {
			$this->db->order_by('t3.company_legal_name', $conditions['sort_agent_name']);
		}
		if (isset($conditions['sort_tour_invoice_date']) && !empty($conditions['sort_tour_invoice_date'])){
			$this->db->order_by('t2.date_generated', $conditions['sort_tour_invoice_date']);
		}
		if (isset($conditions['sort_booking_no']) && !empty($conditions['sort_booking_no'])) {
			$this->db->order_by('t1.booking_no', $conditions['sort_booking_no']);
		}
		  
        $query = $this->db->get();
        return $query->result_array();
        
    }
    public function get_total_tour_bookings($conditions = array()) {
        $this->db->select('count(t1.booking_id) as total, t2.invoice_path, t3.company_legal_name')
			->from('tv_bookings_tbl t1')
				->join('tv_booking_invoice_tbl t2', 't2.booking_id=t1.booking_id' , 'left')
					->join('tv_agent_tbl t3', 't3.id=t1.agent_id', 'left');
        
        $this->db->where('t1.vendor_request_status', TV_VENDOR_REQUEST_ON);
		$this->db->where('t1.booking_type', 'tour');
        $this->db->where('t2.invoice_type', 'vendor');
		//$this->db->group_by('t1.booking_id');
        
		/* if (isset($conditions['search_costumer_name']) && !empty($conditions['search_costumer_name'])){
			$this->db->like("concat(t4.firstname,' ', t4.lastname)", $conditions['search_costumer_name']);
		} */
		if (isset($conditions['search_booking_no']) && !empty($conditions['search_booking_no'])) {
			$this->db->like('t1.booking_no', $conditions['search_booking_no']);
		}
		if (isset($conditions['search_agent_name']) && !empty($conditions['search_agent_name'])) {
			$this->db->like('t3.company_legal_name', $conditions['search_agent_name']);
		}
		if (isset($conditions['search_tour_invoice_date']) && !empty($conditions['search_tour_invoice_date'])) {
			$this->db->where('t2.date_generated', lu_to_d($conditions['search_tour_invoice_date']));
		}
		/* if (isset($conditions['sort_customer_name']) && !empty($conditions['sort_customer_name'])) {
			$this->db->order_by("t4.firstname", $conditions['sort_customer_name']);
		} */
		if (isset($conditions['sort_agent_name']) && !empty($conditions['sort_agent_name'])) {
			$this->db->order_by('t3.company_legal_name', $conditions['sort_agent_name']);
		}
		if (isset($conditions['sort_tour_invoice_date']) && !empty($conditions['sort_tour_invoice_date'])){
			$this->db->order_by('t2.date_generated', $conditions['sort_tour_invoice_date']);
		}
		if (isset($conditions['sort_booking_no']) && !empty($conditions['sort_booking_no'])) {
			$this->db->order_by('t1.booking_no', $conditions['sort_booking_no']);
		}
		
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
    public function get_tour_booking($booking_id) {
        $this->db->select("t1.*, t2.firstname, t2.lastname")
        ->from("tv_tour_bookings_tbl as t1")
        ->join("tv_customer_tbl t2", "t1.booking_customer_id = t2.id")
        ->where("booking_id", $booking_id);
        
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update_tour_booking($post_data, $tour_booking_id) {
        $user = $this->session->userdata('user');
        
        $data = array();
        
        $data = [
            'booking_date' => $post_data['booking_date'],
            'pickup_time' => $post_data['pickup_time'],
            'booking_payment_type' => $post_data['booking_payment_type'],
            'payment_status' => $post_data['payment_status'],
            'booking_additional_notes' => $post_data['booking_additional_notes'],
            'booking_amount_paid' => $post_data['booking_amount_paid'],
            'booking_checkout' => $post_data['booking_checkout'],
            'booking_adults' => $post_data['booking_adults'],
            'booking_child' => $post_data['booking_child'],
            'booking_tax' => $post_data['booking_tax'],
            'booking_curr_code' => $post_data['booking_curr_code'],
            'booking_curr_symbol' => $post_data['booking_curr_symbol'],
            'booking_payment_date' => lu_to_d(date('Y-m-d H:i:s')),
            'booking_cancellation_request' => $post_data['booking_cancellation_request'],
            'booking_status' => $post_data['booking_status'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];
        
        $this->db->where('booking_id', $tour_booking_id);
        $this->db->update("tv_bookings_tbl", $data);
    }
    
    public function get_payment_statuses() {
        $this->db->select('*')->from('tv_payment_status_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_booking_statuses() {
        $this->db->select('*')->from('tv_booking_status_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_customers_name_by_ids($customer_ids_array) {
        $query = $this->db->select('id, concat(firstname," ",lastname) as name')->from('tv_customer_tbl')->where_in('id', $customer_ids_array)->get();
        return $query->result_array();
    }
    
    public function disable_tour_booking($tour_booking_id) {
        $data = array(
            'status' => 0
        );
        
        $this->db->where('booking_id', $tour_booking_id);
        $this->db->update("tv_tour_bookings_tbl", $data);
        
        return true;
    }
    
    public function update_tour_booking_customer_details($data, $customer_id) {
        $this->db->where('id', $customer_id);
        $this->db->update('tv_customer_tbl', $data);
    }
    
    public function get_invoice_data_by_booking_ids($booking_ids) {
        $this->db->select("t2.*, t1.agent_id, t1.agent_cost, t1.country_id, t1.city_id, t3.invoice_no, t3.date_generated, t4.booking_date, t4.booking_no")
            ->from("tv_tour_tbl as t1")
                ->join("tv_tour_bookings_tbl as t2", "t1.id = t2.tour_id" ,"left")
                    ->join("tv_booking_invoice_tbl t3", "t3.booking_id=t2.booking_id", "left")
                        ->join("tv_bookings_tbl as t4", "t2.booking_id = t4.booking_id" ,"left")
								->where_in("t2.booking_id",  $booking_ids);
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_vendor_details($vendor_id) {
        $this->db->select('*')->from('tv_agent_tbl')->where('id', $vendor_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function add_invoice_path_data($invoice_data) {
        $this->db->update_batch('tv_booking_invoice_tbl', $invoice_data,'booking_id');
    }
    
    public function get_countries() {
        $query = $this->db->select('*')->from('tv_main_country_tbl')->get();
        return $query->result_array();
    }
    
    public function get_cities() {
        $query = $this->db->select('*')->from('tv_main_city_tbl')->get();
        return $query->result_array();
    }
    
    public function get_cities_by_country_id($country_id) {
        $this->db->select('name, id')->from('tv_main_city_tbl')->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
   
}