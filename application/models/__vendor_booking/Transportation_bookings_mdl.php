<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Bookings Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

Class Transportation_bookings_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
	public function get_invoice_paths($booking_ids){
		$this->db->select("t3.invoice_path, t3.booking_id")
			->from("tv_booking_invoice_tbl t3")
					->where_in('t3.booking_id', $booking_ids)
						->where_in('t3.invoice_type', 'vendor');
		$query = $this->db->get();
        return $query->result_array();
	}
    
    public function get_transportation_bookings($conditions = array(), $start, $limit) {
        $this->db->select("t1.*,t2.*")
            ->from('tv_bookings_tbl as t1')
                ->join("tv_transportation_booking_tbl as t2", 't2.booking_id=t1.booking_id');
  
        $this->db->where('t1.agent_id', $conditions['vendor_id']);  
		$this->db->where('t1.booking_type', 'transportation');
        
        if (isset($conditions['search_booking_no']) && !empty($conditions['search_booking_no'])) {
            $this->db->like('t1.booking_no', $conditions['search_booking_no']);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_total_transportation_bookings($conditions = array()) {
        $this->db->select('count(t1.booking_id) as total')
            ->from('tv_bookings_tbl as t1')
                ->join("tv_transportation_booking_tbl as t2", 't2.booking_id=t1.booking_id');
        
        
        $this->db->where('t1.agent_id', $conditions['vendor_id']);
        $this->db->where('t1.booking_type', 'transportation');
        
        if(isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            //$this->db->where('');
        }
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
   
    
    public function get_transportation_booking($booking_id) {
        $this->db->select("t1.*,t2.*, t3.firstname, t3.lastname")
        ->from('tv_bookings_tbl as t1')
            ->join("tv_transportation_booking_tbl as t2", 't2.booking_id=t1.booking_id')
                ->join("tv_customer_tbl t3", "t1.booking_customer_id = t3.id")
                    ->where("t1.booking_id", $booking_id);
        
        $query = $this->db->get();
       // pr($query->row_array());
        return $query->row_array();
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
        $query = $this->db->select('id, concat(firstname ," ", lastname) as name')->from('tv_customer_tbl')->where_in('id', $customer_ids_array)->get();
        return $query->result_array();
    } 
	
    public function disable_transportation_booking($transportation_booking_id) {
        $data = array(
            'status' => 0
        );
        
        $this->db->where('booking_id', $transportation_booking_id);
        $this->db->update("tv_transportation_booking_tbl", $data);

        return true;
    }	
	
	public function get_invoice_path($booking_id) {
		$this->db->select('*')
			->from('tv_booking_invoice_tbl')
				->where('booking_id', $booking_id)
					->where('invoice_type', 'vendor');
		$query = $this->db->get();
		return $query->row_array();
	}
	public function add_invoice_no_with_date($input_data) {
	    
	    foreach ($input_data as $input) {
	        
	        $this->db->select("1")->from("tv_booking_invoice_tbl")->where('invoice_type', 'vendor')->where('booking_id', $input['booking_id']);
	        $query = $this->db->get();
	        
	        if($query->num_rows() > 0) {
	            $this->db->where('booking_id', $input['booking_id']);
	            $this->db->where('invoice_type', 'vendor');
	            $this->db->update('tv_booking_invoice_tbl', $input);
	        } else {
	            $this->db->insert('tv_booking_invoice_tbl', $input);
	        }
	        
	        $this->db->where('booking_id', $input['booking_id']);
	        $this->db->update('tv_bookings_tbl', array('vendor_request_status' => 1,'vendor_invoice_no'=>$input['invoice_no']));
	    }
	}
}