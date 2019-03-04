<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * APPLICATION 		: Customer Dashboard Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Dashboard_mdl extends CI_Model {
	private $customer_id;
    public function __construct() {
        parent::__construct();
		$this->load->helper(array('date', 'dt'));
		$this->load->library(array(
            '__commonlib/Security_lib'
        ));
		$this->customer_id = $this->security_lib->decrypt($this->session->userdata('__idCus'));
    }
	
	public function get_customer_profile() {
        $query = $this->db->select("id,customer_type_id,firstname,lastname,gender,date_of_birth,email,telephone,status")->from("tv_customer_tbl")->where(array("id"=>$this->customer_id,'status'=>'1'))->get();
        return $query->row_array();
    }
	
	public function get_customer_orders() {
        $query = $this->db->select("booking_id,booking_no,booking_type,	customer_invoice_no,booking_date,booking_amount_paid,booking_status,agent_id")->from("tv_bookings_tbl")->where(array("booking_customer_id"=>$this->customer_id))->get();
        return $query->result_array();
    }
    
    public function get_customer_addresses() {
        $query = $this->db->select("*")->from("tv_customer_address_tbl")->where("customer_id", $this->customer_id)->get();
        return $query->result_array();
    }
    
    public function get_invoice_details($tour_id) {
        
    }
    
    public function add_customer_address($post_data) {
        $current_utc_date = lu_to_d(date('Y-m-d H:i:s'));
        $data = array(
            'customer_id' => $this->customer_id,
            'address_1' => $post_data['address_1'],
            'address_2' => $post_data['address_2'],
            'city' => ucwords($post_data['city']),
			'country' => $post_data['country'],
            'state' => $post_data['state'],
            'postcode' => $post_data['postcode'],
            'type' => $post_data['type'],
            'date_added' => $current_utc_date,
            'date_modified' => $current_utc_date
        );
        $this->db->insert("tv_customer_address_tbl", $data);
		return true;
    }
    
    public function update_customer_profile($post_data) {
        $current_utc_date = lu_to_d(date('Y-m-d H:i:s'));
        $data = array(
            'firstname' => ucfirst($post_data['firstname']),
            'lastname' => ucfirst($post_data['lastname']),
            'email' => $post_data['email'],
            'telephone' => $post_data['contact'],
            'gender' => $post_data['gender'],
            'date_of_birth' => lu_to_d($post_data['date_of_birth']),
            'date_modified' => $current_utc_date,
        );
        $this->db->where("id", $this->customer_id);
        $this->db->update("tv_customer_tbl", $data);
		return true;
    }
	
	public function update_customer_address($post_data) {
        $current_utc_date = lu_to_d(date('Y-m-d H:i:s'));
        $data = array(
            'address_1' => $post_data['address_1'],
            'address_2' => $post_data['address_2'],
            'city' => ucwords($post_data['city']),
            'country' => $post_data['country'],
            'state' => $post_data['state'],
            'postcode' => $post_data['postcode'],
            'type' => $post_data['type'],
            'date_modified' => $current_utc_date,
        );
        $this->db->where("id", $post_data['update_row']);
        $this->db->where("customer_id", $this->customer_id);
        $this->db->update("tv_customer_address_tbl", $data);
		return true;
    }
	
	public function change_customer_password($password) {
        $current_utc_date = lu_to_d(date('Y-m-d H:i:s'));
		$this->db->select('salt')->from('tv_customer_tbl')->where("id", $this->customer_id);
		$qry = $this->db->get();
		$salt = $qry->row()->salt;
        $secure_password = sha1($salt . sha1($salt . sha1($password)));
        $this->db->where("id", $this->customer_id);
        $this->db->set('password',$secure_password);
        $this->db->set("date_modified", $current_utc_date);
        $this->db->update("tv_customer_tbl");
		return true;
    }
	
	public function address_type_exists($type) {
        $this->db->where('type', $type);
        $this->db->where("customer_id", $this->customer_id);
		$query = $this->db->get('tv_customer_address_tbl');
		return $query->num_rows();
    }
	
	public function email_exists($email) {
        $this->db->where('email', $email);
        $this->db->where("id !=", $this->customer_id);
		$query = $this->db->get('tv_customer_tbl');
		return $query->num_rows();
    }
	
	public function validate_old_password($password) {
        $this->db->where("id", $this->customer_id)
			->where('password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1("' . $password . '")))))');
		$query = $this->db->get('tv_customer_tbl');
		return $query->num_rows();
    }
    
    public function delete_customer_address($customer_address_id) {
        $this->db->where("customer_id", $this->customer_id);
        $this->db->where("id", $customer_address_id);
        $this->db->delete("tv_customer_address_tbl");
    }
}