<?php
class Loc_info_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
    public function get_location_information($id){
		$query = $this->db->select('*')->from('tv_locinfo_tbl')->where('id',$id)->get();
		return $query->row();
	}
	
}