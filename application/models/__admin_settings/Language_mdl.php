<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Language Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Language_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_languages($conditions = array(), $start, $limit) {
        
        $this->db->select('*')->from('tv_language_tbl');
        
        if (isset($conditions['search_type_name']) && !empty($conditions['search_type_name'])) {
            $this->db->like('name', $conditions['search_type_name']);
        }
        
        if (isset($conditions['search_lang_code']) && !empty($conditions['search_lang_code'])) {
            $this->db->like('code', $conditions['search_lang_code']);
        }
        
        $this->db->order_by('name', 'ASC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_languages($conditions = array()) {
        $this->db->select("count(id) as total")->from('tv_language_tbl');
        
        if (isset($conditions['search_type_name']) && !empty($conditions['search_type_name'])) {
            $this->db->like('name', $conditions['search_type_name']);
        }
        
        if (isset($conditions['search_lang_code']) && !empty($conditions['search_lang_code'])) {
            $this->db->like('code', $conditions['search_lang_code']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
    public function get_language($language_id) {
        $this->db->where('id', $language_id);
        $query = $this->db->select('*')->from('tv_language_tbl')->get();
        return $query->row_array();
    }
    
    public function add_language($data) {
        $data = [
            'code' => $data['code'],
            'name' => $data['name'],
            'date_added' => date('Y-m-d H:i:s'),
            'date_modified' => date('Y-m-d H:i:s'),
            'status' => 1
        ];
        
        $this->db->insert("tv_language_tbl", $data) ;
    }
    
    public function update_language($data, $language_id) {
        
        $data = [
            'code' => $data['code'],
            'name' => $data['name'],
            'date_modified' => date('Y-m-d H:i:s'),
            'status' => $data['status']
        ];
        
        $this->db->where('id', $language_id);
        $this->db->update('tv_language_tbl', $data);
    }
    
    public function delete_language($languageid) {
        $this->db->where('id', $languageid);
        $this->db->delete('tv_language_tbl');
    }
    
    public function change_language_status($language_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $language_id);
        $this->db->update('tv_language_tbl');
    }
}