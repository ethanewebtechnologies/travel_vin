<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Bookings Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH,
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

Class Bookings_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
	public function get_booking( $booking_id ){
		$this->db->select('*')
			->from('tv_bookings_tbl')
				->where('booking_id',$booking_id);
		$qry = $this->db->get();
		if($qry->num_rows()>0){
			return $qry->row_array();
		}
	}
	
	public function add_data_into_booking_tbl($postdata) {
		$this->db->insert("tv_bookings_tbl", $postdata);
		$insert_id = $this->db->insert_id();
		
		$booking_no = 'BKN-'. date('Y') . '-' . str_pad($insert_id, 20, "0", STR_PAD_LEFT);
		
		$this->db->where('tv_bookings_tbl.booking_id', $insert_id);
		$this->db->set('tv_bookings_tbl.booking_no', $booking_no);
		$this->db->set('tv_bookings_tbl.payment_status', TV_DEFAULT_PAYMENT_STATUS);
		$this->db->update('tv_bookings_tbl');
		return $insert_id;
	}
	
	public function insert_into_booking_tbl_with_booking_no( $postdata ){
		$this->db->insert("tv_bookings_tbl", $postdata);
		$insert_id = $this->db->insert_id();

		$this->db->where('tv_bookings_tbl.booking_id', $insert_id);
		$this->db->set('tv_bookings_tbl.payment_status', TV_DEFAULT_PAYMENT_STATUS);
		$this->db->update('tv_bookings_tbl');
		return $insert_id;
	}
	
	public function update_into_booking_tbl_after_payment($postdata) {
		$this->db->where("tv_bookings_tbl.booking_id", $postdata['booking_id']);
		$this->db->update("tv_bookings_tbl", $postdata);
		
		return true;
	}
	public function get_agent($agent_id) {
        $query = $this->db->select("*")->from("tv_agent_tbl")->where('id', $agent_id)->get();
        return $query->row_array();
    } 
}