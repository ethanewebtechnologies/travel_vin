<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Audit Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN , BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Audit_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add_customer_details($post_data) {
        $this->db->select('id, customer_type_id, approved, status')
            ->from('tv_customer_tbl')
                ->where('email', $post_data['email']);
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        if(empty($result)) { 
            $this->db->insert('tv_customer_tbl', $post_data);
            
            return array('success' => $this->db->insert_id());
        } else {
            if($result['customer_type_id'] == TV_FRAUD_ID) {
                
                $result['fraud_error'] = TRUE;
            } else if($result['status'] == TV_OFF) {
                
                $result['blocked_error'] = TRUE;
            } else if($result['approved'] == TV_DISAPPROVED) {
                
                $result['onhold_error'] = TRUE;
            } else {
				
                $this->db->where('email', $post_data['email']);
				$this->db->update('tv_customer_tbl', $post_data);
                $result = array('success' => $result['id']);
            }
            
            return $result;
        }
    }
    
    public function add_customer_address($post_data) {
        $this->db->select('*')
            ->from('tv_customer_address_tbl')
                ->where('customer_id', $post_data['customer_id']);
        
        $query = $this->db->get();
        $result = $query->row_array();
        
        if(empty($result)) { 
            $this->db->insert('tv_customer_address_tbl', $post_data);
        } else {
            $this->db->where('customer_id', $post_data['customer_id']);
            $this->db->update('tv_customer_address_tbl', $post_data); 
        }
        
        return true;
    }
	
	public function findCustomerByemail($email) {
        $this->db->select('t1.*, t2.customer_id, t2.address_1, t2.address_2, t2.city, t2.state, t2.country, t2.postcode, t2.type')
            ->from('tv_customer_tbl t1')
                ->join('tv_customer_address_tbl t2', 't1.id = t2.customer_id', 'inner')
                    ->where('t1.email', $email);
        
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function get_customer_details_by_customer_id($customer_id) {
        $this->db->select('t1.*, t2.customer_id, t2.address_1, t2.address_2, t2.city, t2.state, t2.country, t2.postcode, t2.type')
            ->from('tv_customer_tbl t1')
                ->join('tv_customer_address_tbl t2', 't1.id = t2.customer_id', 'inner')
                    ->where('t1.id', $customer_id);
		
		$query = $this->db->get();
		return $query->result_array();
	}
	
	public function add_before_payment_transactionid($post_data) {
        $this->db->insert('tv_transactions_tbl', $post_data);
        return true;
	}
	
	public function update_after_payment_transactionid_status($post_data){
        $this->db->where("transaction_no", $post_data['transaction_no']);
        $this->db->update('tv_transactions_tbl', $post_data);
        return true;
	}
}