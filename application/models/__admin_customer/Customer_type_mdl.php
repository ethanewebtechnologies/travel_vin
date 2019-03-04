<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');
    
/*
 * APPLICATION 		: CUSTOMER TYPE MODEL
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */
    
class Customer_type_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_customer_types($conditions = array(), $start, $limit) {
        
        $this->db->select('t1.*')
        ->from('tv_customer_type_tbl t1');
        
        if (isset($conditions['search_type_name']) && !empty($conditions['search_type_name'])) {
            $this->db->like('t1.type_name', $conditions['search_type_name']);
        }
        
        $this->db->order_by('t1.type_name', 'ASC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_customer_types($conditions = array()) {
        
        $this->db->select('count(t1.id) as total')
        ->from('tv_customer_type_tbl t1');
        
        if (isset($conditions['search_type_name']) && !empty($conditions['search_type_name'])) {
            $this->db->like('t1.type_name', $conditions['search_type_name']);
        }
        
        $query = $this->db->get();
        
        return $query->row_array()['total'];
    }
    
    public function get_customer_type($customer_type_id) {
        $this->db->where('id', $customer_type_id);
        $query1 = $this->db->select('*')->from('tv_customer_type_tbl')->get();
        $result = $query1->row_array();
        $this->db->where('customer_type_id', $customer_type_id);
        
        return $result;
    }
    
    public function add_customer_type($post_data) {
        $user = $this->session->userdata('user');
        
        $data = [
            'type_name' => $post_data['type_name'],
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];
        
        $this->db->insert("tv_customer_type_tbl", $data);
    }
    
    public function update_customer_type($post_data, $customer_type_id) {
        $data = array();
        
        $data = [
            'type_name' => $post_data['type_name'],
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];
        
        $this->db->where('id', $customer_type_id);
        $this->db->update("tv_customer_type_tbl", $data);
    }
    
    public function delete_customer_type($customer_type_id) {
        $this->db->where('id', $customer_type_id);
        $this->db->delete('tv_customer_type_tbl');
        
        return true;
    }
    
    public function change_customer_type_status($customer_type_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $customer_type_id);
        $this->db->update('tv_customer_type_tbl');
    }
}
