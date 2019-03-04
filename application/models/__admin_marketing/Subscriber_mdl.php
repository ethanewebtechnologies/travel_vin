<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * APPLICATION 		: Subscriber Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Subscriber_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }
	
	public function get_subscribers($conditions = array(), $start, $limit) {
      	$this->db->select('*')->from('tv_subscriber_tbl');
      	
      	if (isset($conditions['search_subscriber_email']) && !empty($conditions['search_subscriber_email'])) {
      	    $this->db->like('subscriber_email', $conditions['search_subscriber_email']);
      	}
		
        if (isset($conditions['search_subscription_type']) && !empty($conditions['search_subscription_type'])) {
            $this->db->where('subscription_type', $conditions['search_subscription_type']);
        }
        
        $this->db->order_by('id', 'DESC');
        
        if (isset($start) && isset($limit)) { 
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
		
        return $query->result_array();
    }
    
    
    public function get_total_subscribers($conditions = array()) {
	    $this->db->select("count(id) as total")->from('tv_subscriber_tbl');
		
	    if (isset($conditions['search_subscriber_email']) && !empty($conditions['search_subscriber_email'])) {
	        $this->db->like('subscriber_email', $conditions['search_subscriber_email']);
	    }
	    
	    if (isset($conditions['search_subscription_type']) && !empty($conditions['search_subscription_type'])) {
	        $this->db->where('subscription_type', $conditions['search_subscription_type']);
	    }
		
		$query = $this->db->get();
	    
		return $query->row_array()['total'];
	}   
	
    public function get_subscriber($subscriber_id) {
        $this->db->where('id', $subscriber_id);
        $query = $this->db->select('*')->from('tv_subscriber_tbl')->get();
        return $query->row_array();
    }

    public function delete_subscriber($subscriber_id) {
        $this->db->where('id', $subscriber_id);
        $this->db->delete('tv_subscriber_tbl');

        return true;
    }   

    public function change_subscriber_status($subscriber_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $subscriber_id);
        $this->db->update('tv_subscriber_tbl');
    }
}
