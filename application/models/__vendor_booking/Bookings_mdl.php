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

	public function get_agent($agent_id) {
        $query = $this->db->select("*")->from("tv_agent_tbl")->where('id', $agent_id)->get();
        return $query->row_array();
    } 
}