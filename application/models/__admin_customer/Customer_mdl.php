<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * COUNTRIBUTION    : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Customer_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_customers($conditions = array(), $start, $limit) {
        $this->db->select('*')->from('tv_customer_tbl');
        
        if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('firstname', $conditions['search_name']);
        }
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_customers($conditions = array()) {
        $this->db->select("count(id) as total")->from('tv_customer_tbl');
        
        if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('name', $conditions['search_name']);
        }
        
        $query = $this->db->get();
        
        return $query->row_array()['total'];
    }
    
    public function get_customer($customer_id) {
        $this->db->where('id', $customer_id);
        $query = $this->db->select('*')->from('tv_customer_tbl')->get();
        return $query->row_array();
    }
    
    public function add_customer($post_data) {
        
        // GET SESSION USER DETAILS
        $user = $this->session->userdata('user');
        
        $data = [
            'firstname' => $post_data['firstname'],
            'lastname' => $post_data['lastname'],
            'email' => $post_data['email'],
            'telephone' => $post_data['telephone'],
            'gender' => $post_data['gender'],
            'date_of_birth' => lu_to_d($post_data['date_of_birth']),
            'newsletter_status' => $post_data['newsletter_status'],
            'status' => $post_data['status'],
            'approved' => $post_data['approved'],
            'customer_type_id' => $post_data['customer_type_id'],
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_added' => $user['id'],
            'user_modified' => $user['id']
        ];
        
        $this->db->insert("tv_customer_tbl", $data);
        
        $lastid = $this->db->insert_id();
        
        foreach($post_data['address_details'] as $address_detail) {
            $batch_data[] = [
                'customer_id' => $lastid,
                'address_1' => $address_detail['address_1'],
                'address_2' => $address_detail['address_2'],
                'city' => $address_detail['city'],
                'state' => $address_detail['state'],
                'country' => $address_detail['country'],
                'postcode' => $address_detail['postcode']
            ];
        }
        
        $this->db->insert_batch('tv_customer_address_tbl', $batch_data);
    }
    
    public function update_customer($post_data, $customer_id) {
      
        // GET SESSION USER DETAILS
        $user = $this->session->userdata('user');
        
        $data = [
            'firstname' => $post_data['firstname'],
            'lastname' => $post_data['lastname'],
            'email' => $post_data['email'],
            'telephone' => $post_data['telephone'],
            'gender' => $post_data['gender'],
            'date_of_birth' => lu_to_d($post_data['date_of_birth']),
            'newsletter_status' => $post_data['newsletter_status'],
            'customer_type_id' => $post_data['customer_type_id'],
            'status' => $post_data['status'],
            'approved' => $post_data['approved'],
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_modified' => $user['id']
        ];
        
        $this->db->where('id', $customer_id);
        $this->db->update("tv_customer_tbl", $data);
        
        $this->db->where('customer_id', $customer_id);
        $this->db->delete('tv_customer_address_tbl');
        
        if(isset($post_data['address_details'])) {
            foreach($post_data['address_details'] as $address_detail) {
                $batch_data[] = [
                    'customer_id' => $customer_id,
                    'address_1' => $address_detail['address_1'],
                    'address_2' => $address_detail['address_2'],
                    'city' => $address_detail['city'],
                    'state' => $address_detail['state'],
                    'country' => $address_detail['country'],
                    'postcode' => $address_detail['postcode']
                ];
                
            }
            
            $this->db->insert_batch('tv_customer_address_tbl', $batch_data);
        }
    }
    
    public function delete_customer($customer_id) {
        $this->db->where('id', $customer_id);
        $this->db->delete('tv_customer_tbl');
        
        return true;
    }
    
    public function get_customer_addresses($customer_id) {
        $this->db->select("*")->from("tv_customer_address_tbl")->where('customer_id', $customer_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function change_customer_status($user_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $user_id);
        $this->db->update('tv_customer_tbl');
    }
}
