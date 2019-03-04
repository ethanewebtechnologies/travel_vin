<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Dashboard Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Dashboard_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_total_customers() {
        $this->db->select("count(id) as total")->from('tv_customer_tbl');
        $query = $this->db->get();
        $result =  $query->row_array();
        
        if(isset($result['total']) && $result['total'] > 0) {
            return $result['total'];
        } else {
            return 0;
        }
    }
    
    public function get_total_parks() {
        $this->db->select("count(id) as total")->from('tv_agent_tbl');
        $query = $this->db->get();
        $result =  $query->row_array();
        
        if(isset($result['total']) && $result['total'] > 0) {
            return $result['total'];
        } else {
            return 0;
        }
    }
    
    public function get_total_bookings() {
        $this->db->select("count(booking_id) as total")->from('tv_bookings_tbl');
        $query = $this->db->get();
        $result =  $query->row_array();
        
        if(isset($result['total']) && $result['total'] > 0) {
            return $result['total'];
        } else {
            return 0;
        }
    }
    
    public function get_bookings() {
        
        $this->db->select("t1.*, t3.company_legal_name, t4.firstname, t4.lastname")
            ->from('tv_bookings_tbl as t1')
                ->join("tv_agent_tbl as t3", "t1.agent_id = t3.id", 'left')
                    ->join("tv_customer_tbl as t4", "t1.booking_customer_id = t4.id", 'left');
        $this->db->order_by('t1.booking_id', 'DESC');
        $this->db->limit(10, 0);
        $query = $this->db->get();
        return $query->result_array();
    }
}