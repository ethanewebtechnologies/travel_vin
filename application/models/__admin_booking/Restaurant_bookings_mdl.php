<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Restaurant Bookings Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restaurant_bookings_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_restaurant_bookings($conditions = array(), $start, $limit) {
		$this->db->select("t1.*,t2.start_date,t2.pickup_time, t3.company_legal_name,t4.firstname,t4.lastname")
                ->from('tv_bookings_tbl as t1')
                   ->join("tv_restaurant_booking_tbl as t2", 't2.booking_id=t1.booking_id')
                       ->join("tv_agent_tbl as t3", "t1.agent_id = t3.id",'left')
                           ->join("tv_customer_tbl as t4", "t1.booking_customer_id = t4.id",'left');
        
        
		if (isset($conditions['search_costumer_name']) && !empty($conditions['search_costumer_name'])) {
			$this->db->like("concat(t4.firstname,' ', t4.lastname)", $conditions['search_costumer_name']);
		}

		if (isset($conditions['search_booking_no']) && !empty($conditions['search_booking_no'])) {
			$this->db->like('t1.booking_no', $conditions['search_booking_no']);
		}

		if (isset($conditions['search_agent_name']) && !empty($conditions['search_agent_name'])) {
			$this->db->like('t3.company_legal_name', $conditions['search_agent_name']);
		}

		if (isset($conditions['search_start_date']) && !empty($conditions['search_start_date'])) {
		    $this->db->where('date(t2.start_date)', lu_to_d_for_date($conditions['search_start_date']));
		}

		if (isset($conditions['sort_customer_name']) && !empty($conditions['sort_customer_name'])) {
			$this->db->order_by("t4.firstname", $conditions['sort_customer_name']);
		}
		if (isset($conditions['sort_agent_name']) && !empty($conditions['sort_agent_name'])) {
			$this->db->order_by('t3.company_legal_name', $conditions['sort_agent_name']);
		}
		if (isset($conditions['sort_start_date']) && !empty($conditions['sort_start_date'])) {
			$this->db->order_by('t2.start_date', $conditions['sort_start_date']);
		}
		if (isset($conditions['sort_booking_no']) && !empty($conditions['sort_booking_no'])) {
			$this->db->order_by('t1.booking_no', $conditions['sort_booking_no']);
		}
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_total_restaurant_bookings($conditions = array()) {
        $this->db->select('count(t1.booking_id) as total')
                ->from('tv_bookings_tbl as t1')
                   ->join("tv_restaurant_booking_tbl as t2", 't2.booking_id=t1.booking_id')
                       ->join("tv_agent_tbl as t3", "t1.agent_id = t3.id",'left')
                           ->join("tv_customer_tbl as t4", "t1.booking_customer_id = t4.id",'left');
        
        if (isset($conditions['search_costumer_name']) && !empty($conditions['search_costumer_name'])) {
			$this->db->like("concat(t4.firstname,' ', t4.lastname)", $conditions['search_costumer_name']);
		}

		if (isset($conditions['search_booking_no']) && !empty($conditions['search_booking_no'])) {
			$this->db->like('t1.booking_no', $conditions['search_booking_no']);
		}

		if (isset($conditions['search_agent_name']) && !empty($conditions['search_agent_name'])) {
			$this->db->like('t3.company_legal_name', $conditions['search_agent_name']);
		}

		if (isset($conditions['search_start_date']) && !empty($conditions['search_start_date'])) {
		    $this->db->where('date(t2.start_date)', lu_to_d_for_date($conditions['search_start_date']));
		}
		

		if (isset($conditions['sort_customer_name']) && !empty($conditions['sort_customer_name'])) {
			$this->db->order_by("t4.firstname", $conditions['sort_customer_name']);
		}
		if (isset($conditions['sort_agent_name']) && !empty($conditions['sort_agent_name'])) {
			$this->db->order_by('t3.company_legal_name', $conditions['sort_agent_name']);
		}
		if (isset($conditions['sort_start_date']) && !empty($conditions['sort_start_date'])) {
			$this->db->order_by('t2.start_date', $conditions['sort_start_date']);
		}
		if (isset($conditions['sort_booking_no']) && !empty($conditions['sort_booking_no'])) {
			$this->db->order_by('t1.booking_no', $conditions['sort_booking_no']);
		}
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
    public function get_restaurant_booking($booking_id) {
		$this->db->select("t1.*,t2.*, t3.firstname, t3.lastname")
            ->from('tv_bookings_tbl as t1')
            ->join("tv_restaurant_booking_tbl as t2", 't2.booking_id=t1.booking_id')
                ->join("tv_customer_tbl t3", "t1.booking_customer_id = t3.id")
                    ->where("t1.booking_id", $booking_id);
        
        $query = $this->db->get();
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
        if(!empty($customer_ids_array)) {
            $query = $this->db->select('id, concat(firstname," ",lastname) as name')->from('tv_customer_tbl')->where_in('id', $customer_ids_array)->get();
            return $query->result_array();
        } else {
            return array();
        }
    }
    
    public function disable_restaurant_booking($restaurant_booking_id) {
        $data = array(
            'status' => 0
        );
        
        $this->db->where('booking_id', $restaurant_booking_id);
        $this->db->update("tv_restaurant_bookings_tbl", $data);
        
        return true;
    }
    
    public function update_restaurant_booking_customer_details($data, $customer_id) {
        $this->db->where('id', $customer_id);
        $this->db->update('tv_customer_tbl', $data);
    }
	
	public function confirm_bookings($booking_id) {
        $this->db->where_in('booking_id', $booking_id);
        $this->db->update('tv_bookings_tbl', array('booking_status' => 2));
    }
    
    public function cancel_bookings($booking_id) {
        $this->db->where_in('booking_id', $booking_id);
        $this->db->update('tv_bookings_tbl', array('booking_status' => 4));
    }
}