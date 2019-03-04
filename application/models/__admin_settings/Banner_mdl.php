<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Banner Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Banner_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_banners($conditions = array(), $start, $limit) {
        
        $this->db->select('*')->from('tv_banner_tbl');
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->like('title', $conditions['search_title']);
        }
        
        $this->db->order_by('title', 'ASC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_banners($conditions = array()) {
        $this->db->select("count(id) as total")->from('tv_banner_tbl');
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->like('title', $conditions['search_title']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
    public function get_banner($banner_id) {
        $this->db->where('id', $banner_id);
        $query = $this->db->select('*')->from('tv_banner_tbl')->get();
        return $query->row_array();
    }
    
    public function add_banner($post_data) {
        
        $user = $this->session->userdata['user'];
        
        $data = [
            'category' => $post_data['category'],
            'section' => $post_data['section'],
            'image' => $post_data['image'], 
            'title' => $post_data['title'], 
            'alt' => $post_data['alt'], 
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_added' => $user['id'],
            'user_updated' => $user['id'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0
        ];
        
        $this->db->insert("tv_banner_tbl", $data) ;
    }
    
    public function update_banner($post_data, $banner_id) {
        
        $user = $this->session->userdata['user'];
        
        $data = [
            'category' => $post_data['category'],
            'section' => $post_data['section'],
            'image' => $post_data['image'],
            'title' => $post_data['title'],
            'alt' => $post_data['alt'], 
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_updated' => $user['id'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0
        ];
        
        $this->db->where('id', $banner_id);
        $this->db->update('tv_banner_tbl', $data);
    }
    
    public function delete_banner($bannerid) {
        $this->db->where('id', $bannerid);
        $this->db->delete('tv_banner_tbl');
    }
    
    public function change_banner_status($banner_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $banner_id);
        $this->db->update('tv_banner_tbl');
    }
}