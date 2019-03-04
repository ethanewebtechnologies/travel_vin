<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Restricted Zone Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restricted_zone_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_restricted_zones($search_conditions = array(), $start, $limit) {
        $this->db->select("*")->from("tv_restricted_zone_tbl");
        
        if(isset($search_conditions['search_controller_name']) && !empty($search_conditions['search_controller_name'])) {
            $this->db->like('controller_name', $search_conditions['search_controller_name']);
        }
        
        if(isset($search_conditions['search_method_name']) && !empty($search_conditions['search_method_name'])) {
            $this->db->like('method_name', $search_conditions['search_method_name']);
        }
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_restricted_zones($search_conditions = array()) {
        $this->db->select("count(id) as total")->from("tv_restricted_zone_tbl");
        
        if(isset($search_conditions['controller_name']) && !empty($search_conditions['controller_name'])) {
            $this->db->like('controller_name', $search_conditions['controller_name']);
        }
        
        if(isset($search_conditions['search_method_name']) && !empty($search_conditions['search_method_name'])) {
            $this->db->like('method_name', $search_conditions['search_method_name']);
        }
        
        $query = $this->db->get();
        
        return $query->row_array()['total'];
    }
    
    public function change_restricted_zone_status($restricted_zone_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $restricted_zone_id);
        $this->db->update('tv_restricted_zone_tbl');
    }
}