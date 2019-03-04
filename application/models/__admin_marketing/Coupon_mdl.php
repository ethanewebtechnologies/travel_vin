<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * APPLICATION 		: Coupon Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Coupon_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function get_coupons($conditions = array(), $start, $limit) {
      	$this->db->select('*')->from('tv_coupon_tbl');
      	
      	if (isset($conditions['search_coupon_name']) && !empty($conditions['search_coupon_name'])) {
      	    $this->db->like('coupon_name', $conditions['search_coupon_name']);
      	}
		
		if (isset($conditions['search_coupon_code']) && !empty($conditions['search_coupon_code'])) {
            $this->db->like('coupon_code', $conditions['search_coupon_code']);
        }
        
        if (isset($conditions['search_start_date']) && !empty($conditions['search_start_date'])) {
            $this->db->where('date(coupon_start_date)', lu_to_d_for_date($conditions['search_start_date']));
        }
        
        if (isset($conditions['search_end_date']) && !empty($conditions['search_end_date'])) {
            $this->db->where('date(coupon_end_date)', lu_to_d_for_date($conditions['search_end_date']));
        }
        
        $this->db->order_by('id', 'DESC');
        
        if (isset($start) && isset($limit)) { 
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
		
        return $query->result_array();
    }
    
    
    public function get_total_coupons($conditions = array()) {
	    $this->db->select("count(id) as total")->from('tv_coupon_tbl');
		
	    if (isset($conditions['search_coupon_name']) && !empty($conditions['search_coupon_name'])) {
	        $this->db->like('coupon_name', $conditions['search_coupon_name']);
	    }
	    
	    if (isset($conditions['search_coupon_code']) && !empty($conditions['search_coupon_code'])) {
	        $this->db->like('coupon_code', $conditions['search_coupon_code']);
	    }
	    
	    if (isset($conditions['search_start_date']) && !empty($conditions['search_start_date'])) {
	        $this->db->where('date(coupon_start_date)', lu_to_d_for_date($conditions['search_start_date']));
	    }
	    
	    if (isset($conditions['search_end_date']) && !empty($conditions['search_end_date'])) {
	        $this->db->where('date(coupon_end_date)', lu_to_d_for_date($conditions['search_end_date']));
	    }
		
		$query = $this->db->get();
	    
		return $query->row_array()['total'];
	}   
     public function get_coupon($coupon_id) {
        $this->db->where('id', $coupon_id);
        $query = $this->db->select('*')->from('tv_coupon_tbl')->get();
        return $query->row_array();
    }

    public function add_coupon($input_data) {
		
        $user = $this->session->userdata('user');
		
        $data = [
           
            'coupon_name' => $input_data['coupon_name'], 
			'coupon_code' => $input_data['coupon_code'],
            'coupon_type' => $input_data['coupon_type'],
            'coupon_value' => $input_data['coupon_value'],          
            'no_of_coupon' => $input_data['no_of_coupon'],
            'coupon_start_date' => lu_to_d($input_data['coupon_start_date']),
            'coupon_end_date' => lu_to_d($input_data['coupon_end_date']),                    
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
			'date_modified' => lu_to_d(date('Y-m-d H:i:s')), 
			'user_added' => $user['id'],
    		'user_modified' => $user['id'],
            'status' => isset($input_data['status']) ? $input_data['status'] : 0			
        ];

        $this->db->insert("tv_coupon_tbl", $data);
    
    }

    public function update_coupon($input_data, $coupon_id) {
	
        $user = $this->session->userdata('user');

        $data = array();
		
        $data = [
		    'coupon_name' => $input_data['coupon_name'], 
            'coupon_code' => $input_data['coupon_code'],
            'coupon_type' => $input_data['coupon_type'],
            'coupon_value' => $input_data['coupon_value'],          
            'no_of_coupon' => $input_data['no_of_coupon'],
            'coupon_start_date' => lu_to_d($input_data['coupon_start_date']),
            'coupon_end_date' => lu_to_d($input_data['coupon_end_date']),			           
            'status' => isset($input_data['status']) ? $input_data['status'] : 0,            
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_modified' => $user['id']
        ];

        $this->db->where('id', $coupon_id);
        $this->db->update("tv_coupon_tbl", $data);  
    }

    public function delete_coupon($coupon_id) {
        $this->db->where('id', $coupon_id);
        $this->db->delete('tv_coupon_tbl');

        return true;
    }   

    public function change_coupon_status ($coupon_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $coupon_id);
        $this->db->update('tv_coupon_tbl');
    }
}
