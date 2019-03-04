<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: User Group Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class User_group_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_user_groups($conditions = array(), $start, $limit) {
        
        $this->db->select('*')->from('tv_user_group_tbl');
        
        if (isset($conditions['search_group_name']) && !empty($conditions['search_group_name'])) {
            $this->db->like('gp_name', $conditions['search_group_name']);
        }
        
        $this->db->order_by('gp_name', 'ASC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_user_groups($conditions = array()) {
        $this->db->select("count(id) as total")->from('tv_user_group_tbl');
        
        if (isset($conditions['search_group_name']) && !empty($conditions['search_group_name'])) {
            $this->db->like('gp_name', $conditions['search_group_name']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
    public function get_user_group($user_group_id) {
        $this->db->where('id', $user_group_id);
        $query = $this->db->select('*')->from('tv_user_group_tbl')->get();
        return $query->row_array();
    }
    
    public function add_user_group($post_data) {
        
        $user = $this->session->userdata['user'];
        
        $data = [
            'gp_name' => $post_data['group_name'],
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0
        ];
        
        $this->db->insert("tv_user_group_tbl", $data) ;
        
        return $this->db->insert_id();
    }
    
    public function update_user_group($post_data, $user_group_id) {
        
        $user = $this->session->userdata['user'];
        
        $data = [
            'gp_name' => $post_data['group_name'],
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0
        ];
        
        $this->db->where('id', $user_group_id);
        $this->db->update('tv_user_group_tbl', $data);
    }
    
    public function delete_user_group($user_group_id) {
        $this->db->where('id', $user_group_id);
        $this->db->delete('tv_user_group_tbl');
    }
    
    public function change_user_group_status($user_group_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $user_group_id);
        $this->db->update('tv_user_group_tbl');
    }
    
    public function get_restricted_zones() {
        $this->db->select("*")->from("tv_restricted_zone_tbl")->where('status', TV_ON);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function add_user_group_permission($restrictions, $user_group_id) {
        
        $this->db->where('permitted_user_id', 0);
        $this->db->where('permitted_user_group_id', $user_group_id);
        $this->db->delete('tv_user_permission_tbl');
        
        if(isset($restrictions) && !empty($restrictions)) {
            foreach ($restrictions as $restriction) {
                $restricted_zone_data[] = array(
                    'restrictied_zone_id' => $restriction,
                    'permitted_user_id' => 0,
                    'permitted_user_group_id' => $user_group_id
                );
            }
            
            $this->db->insert_batch('tv_user_permission_tbl', $restricted_zone_data);
        }
    }
    
    public function get_user_group_permission($user_group_id) {
        $this->db->select("*")
            ->from("tv_user_permission_tbl")
                ->where("permitted_user_id", 0)
                    ->where("permitted_user_group_id", $user_group_id);
        
        $query = $this->db->get();
        return $query->result_array();
    }
}