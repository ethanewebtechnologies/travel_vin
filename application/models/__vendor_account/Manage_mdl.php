<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Manage Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * COUNTRIBUTION    : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Manage_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_account_details($vendor_id) {
        $this->db->select("*")->from("tv_agent_tbl")->where("id", $vendor_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function update_account_details($post_data, $vendor_id) {
        /* $data = array();
        $data = [
            'company_legal_name' => $post_data['company_legal_name'],
            'company_logo' => $post_data['company_logo'],
            'email' => $post_data['email'],
            'address' => $post_data['address'],
            'city' => $post_data['city'],
            'country' => $post_data['country'],
            'state' => $post_data['state'],
            'business_type' => $post_data['business_type'],
            'admin_email' => $post_data['admin_email'],
            'admin_password' => $post_data['admin_password '],
            'salt' => $post_data['salt'],
            'access_token' => $post_data['access_token'],
            'admin_contact' => $post_data['admin_contact'],
            'admin_fullname' => $post_data['admin_fullname'],
            'admin_image' => $post_data['admin_image'],
            'postal' => $post_data['postal'],
            'telephone' => $post_data['telephone'],
            'tax_id' => $post_data['tax_id'],
            'payment_details' => $post_data['payment_details'],
            'card_number' => $post_data['card_number'],
            'expiry_cvv' => $post_data['expiry_cvv'],
            'approved' => $post_data['approved'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,          
        ]; */
        
        $this->db->where("id", $vendor_id);
        $this->db->update("tv_agent_tbl", $post_data);
    }
       
    public function get_vendor_details_by_email($admin_email) {
        $this->db->select("*")->from("tv_agent_tbl")->where("admin_email", $admin_email);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function validate_vendor_email($admin_email) {
        $this->db->select('*')->from('tv_agent_tbl')->where('admin_email', $admin_email);
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            $vendor = $query->row_array();
            $access_token = $this->security_lib->encrypt($vendor['id'] . '/' . date('Y-m-d H:i:s') . '/' . $vendor['admin_email']);
            
            $data = array(
                'access_token' => $access_token
            );
            
            $this->db->where('admin_email', $admin_email);
            $this->db->update('tv_agent_tbl', $data);
            
            return $access_token;
        } else {
            return false;
        }
    }
    
    public function change_password($post_data, $vendor_id) {
		
		$salt = token(9);
        
        $data = array( 
            'admin_password' => sha1($salt . sha1($salt . sha1($post_data['password']))), 
            'access_token' => null, 
            'status' => 1,
            'salt' => $salt
        );

        $this->db->where('id', $vendor_id);
        $this->db->update('tv_agent_tbl', $data);	
        
        return true;		
        
    }
	public function create_password($post_data, $vendor_id) {
		
		$salt = token(9);
        
        $data = array( 
            'admin_password' => sha1($salt . sha1($salt . sha1($post_data['password']))), 
            'access_token' => null, 
            'status' => 1,
            'salt' => $salt
        );

        $this->db->where('id', $vendor_id);
        $this->db->update('tv_agent_tbl', $data);	
        
        return true;		
        
    }
}