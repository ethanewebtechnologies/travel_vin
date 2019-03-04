<?php
class Header_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
	public function get_settings() {
        $this->db->select("*")->from('tv_settings_tbl');
		$this->db->where('category','header');
        $query = $this->db->get();
        return $query->result_array();
    }
}