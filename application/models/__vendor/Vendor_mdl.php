<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Country Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Vendor_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->helper('Encryption_helper');
		$this->load->library(array('session','__commonlib/Security_lib','email'));		
    }
    
    public function getVendors($conditions = array()) {
        $this->db->select("*")->from("tv_vendor_tbl");
        
        /* if(isset($conditions[''])) {
         $this->db->where('', $conditions['']);
         } */
        
        
        if(isset($conditions['limit']) && isset($conditions['start'])) {
            $this->db->limit($conditions['limit'], $conditions['start']);
        }
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }  

	public function getuserdetails($id) {
        $this->db->select("*")->from("tv_user_tbl");
        
        /* if(isset($conditions[''])) {
         $this->db->where('', $conditions['']);
         } */
        
        
        if(isset($conditions['limit']) && isset($conditions['start'])) {
            $this->db->limit($conditions['limit'], $conditions['start']);
        }
        
        $query = $this->db->get();
        
        if($query->num_rows() > 0) {
            return $query->result_array();
        } else {
            return false;
        }
    }
	
    public function adduser(){
		//$salt = token(9);
		$now = date('Y-m-d H:i:s');
		$curdate =date('Y-m-d');
    
        $data = array(
            'email' => $this->input->post('email'), 
            'firstname' => $this->input->post('fname'), 
            'lastname' => $this->input->post('lname'), 
            'date_added' => $now, 
            'date_modified' => $now,
            'approved' => 1, 
            'status' => 0, 
            'user_group_id' => 1
        );
        
        $this->db->insert('tv_user_tbl', $data);
        $id = $this->db->insert_id();
		
		//exit($access_token);
		
 		
		$config['charset'] = "utf-8";
		$config['mailtype'] = "html";
		$config['newline'] = "\r\n"; 

		$this->email->initialize($config);	 
		
		$this->email->from('lobodanny0@gmail.com', 'Vinay');
		$this->email->to('dragohelia@gmail.com',$this->input->post('email'));

		$this->email->subject('User Email confirmation');
		$message = '<a href='.base_url('admin/default/login/setpassword?token='.$access_token).' >Click Here</a>';
		$this->email->message($message);

		$this->email->send();		
		
		return $id;		
	}	
	 public function audit_token($token, $dec_token) {
		//pr($token);
        $this->db->select('id')->from('tv_agent_tbl')->where('access_token', $token);
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
	
}