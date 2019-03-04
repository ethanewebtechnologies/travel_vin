<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * APPLICATION 		: Account Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Account_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->library(array(
            '__commonlib/Security_lib'
        ));
    }
    
    public function verify_customer($post_data) {
        $this->db->select('*')
            ->from('tv_customer_tbl')
                ->where('email', $post_data['user_email'])
                    ->where('password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1(' . $this->db->escape($post_data['user_password']) . ')))))');
        
        $customer = $this->db->get()->row_array();
        
        if($customer && !empty($customer)) {
            $this->session->set_userdata('customer', $customer);
			$customer_id = $this->security_lib->encrypt($customer['id']);
            $this->session->set_userdata('__idCus', $customer_id);
            return true;
        } 
        
        return false;
    }
    
	public function add_customer($post_data) {
        $this->db->insert('tv_customer_tbl', $post_data);
		$insert_id = $this->db->insert_id();
		
		$this->db->select('*')
            ->from('tv_customer_tbl')
                ->where('id', $insert_id);
        
        $customer = $this->db->get()->row_array();
        
        if($customer && !empty($customer)) {
            $this->session->set_userdata('customer', $customer);
			$customer_id = $this->security_lib->encrypt($customer['id']);
            $this->session->set_userdata('__idCus', $customer_id);
            return true;
        } 
        
        return false;
    }
    
    public function audit_token($token, $dec_token) {
		//pr($token);
        $this->db->select('id')->from('tv_customer_tbl')->where('password_token', $token);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            $now = date('Y-m-d H:i:s');
            $token_data = explode('/', $dec_token);
            
            $date1 = date_create($token_data[1]);
            $date2 = date_create($now);
            
            $interval = date_diff($date1, $date2);
            $day_passed = (int)$interval->format('%a');
            
            if($day_passed <= 15) {
                // Return 1 means users access_token is not expired yet.
                return 1;
            } else {
                // Return 2 means users access_token is expired.
                return 2;
            }
        } else {
            // Return 0 means users access_token is not valid.
            return 0;
        }
    }
    
    public function get_user_details_by_email($email) {
        $this->db->select("*")->from("tv_customer_tbl")->where("email", $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function validate_customer_email($email) {
        $this->db->select('*')->from('tv_customer_tbl')->where('email', $email);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            $customer = $query->row_array();
            $access_token = $this->security_lib->encrypt($customer['id'] . '/' . date('Y-m-d H:i:s') . '/' . $customer['email']);
            
            $data = array(
                'password_token' => $access_token    
            );
            
            $this->db->where('email', $email);
            $this->db->update('tv_customer_tbl', $data);
            
            return $access_token;
        } else {
            return false;
        }
    }
    
    public function change_password($post_data, $customer_id) {
		
		$salt = token(9);
        
        $data = array( 
            'password' => sha1($salt . sha1($salt . sha1($post_data['password']))), 
            'password_token' => null, 
            'status' => 1,
            'salt' => $salt
        );

        $this->db->where('id', $customer_id);
        $this->db->update('tv_customer_tbl', $data);	
        
        return true;        
    }
}