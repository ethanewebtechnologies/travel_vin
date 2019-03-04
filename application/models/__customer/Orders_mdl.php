<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * APPLICATION 		: Customer Orders Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Orders_mdl extends CI_Model {
	private $customer_id;
    public function __construct() {
        parent::__construct();
		$this->load->helper(array('date', 'dt'));
		$this->load->library(array(
            '__commonlib/Security_lib'
        ));
		$this->customer_id = $this->security_lib->decrypt($this->session->userdata('__idCus'));
    }
	
	public function get_customer_invoices($start = null, $limit = null) {
		
	   
       $this->db->select("*");
				 $this->db->from("tv_booking_invoice_tbl t1");
				 $this->db->join("tv_bookings_tbl t2", 't1.booking_id = t2.booking_id');
				$this->db->where(array("t2.booking_customer_id"=>$this->customer_id));
				if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
				$query = $this->db->get();
        return $query->result_array();
    }
    
    
}