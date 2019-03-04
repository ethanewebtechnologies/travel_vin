<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Bookings Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

Class Transportation_bookings_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }
	
	public function get_transportation($transportation_id) {
        $this->db->select('*')->from('tv_transportation_tbl')->where('id', $transportation_id);
        $query = $this->db->get();
        $result = $query->row_array();
        
        return $result;
    }
	
	public function get_transportation_by_air_2_htl($airport_id,$hotel_id) {
		$condition= array("from_location_id"=>$airport_id,"to_location_id"=>$hotel_id);
        $this->db->select('*')->from('tv_transportation_tbl')->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
	
	public function get_transportation_by_htl_2_air($airport_id,$hotel_id) {
		$condition=array("to_location_id"=>$airport_id,"from_location_id"=>$hotel_id);
        $this->db->select('*')->from('tv_transportation_tbl')->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
	
	public function add_data_into_transportation_booking_tbl($postdata){
		$this->db->insert("tv_transportation_booking_tbl", $postdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}