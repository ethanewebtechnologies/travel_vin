<?php
class Accounts_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->helper('Encryption_helper');
		$this->load->library(array('session','__commonlib/Security_lib'));
    }

    // Admin login
    public function login_admin($username,$password) {
        $remember = $this->input->post('remember');
		$query = $this->db->query("SELECT `email`, `id`, `firstname`, `lastname` FROM `tv_user_tbl` WHERE `email` = '".$username."' AND `password` = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1('".$password."'))))) AND `status` = '1' AND `approved` = '1' AND `user_group_id` = '1' ");

        $num = $query->num_rows();
        $user = $query->row_array();
		
        if ($num > 0) {
            if (empty ($remember)) {
                $this->session->sess_expire_on_close = TRUE;
            } 
            
            $this->session->set_userdata('user', $user);

            return true;
        } else {
            return false;
        }
    }
	
    public function reg_admin() {
		$salt = token(9);
		$now = date('Y-m-d H:i:s');
    
        $data = array(
            'email' => $this->input->post('email'), 
            'password' => sha1($salt . sha1($salt . sha1($this->input->post('password')))), 
            'firstname' => $this->input->post('firstname'), 
            'lastname' => $this->input->post('lastname'), 
            'date_added' => $now, 
            'date_modified' => $now,
            'approved' => 1, 
            'status' => 1, 
            'user_group_id' => 1,
            'salt' => $salt
        );
        
        $this->db->insert('tv_user_tbl', $data);
        $id = $this->db->insert_id();
		return $id;
	}

    public function reg_validate($data) {

		$now = date('Y-m-d H:i:s');
		$decacess= $this->security_lib->decrypt($data);
		$deaccess_data=explode('/',$decacess);		
		$query=$this->db->select('id')->from('tv_user_tbl')->where('access_token',$data)->get();
		if($query->num_rows() > 0){
			
			$datetime1 = date_create($deaccess_data[1]);
			$datetime2 = date_create($now);
			$interval = date_diff($datetime1, $datetime2);
			$cdays=(int)$interval->format('%a');
			if($cdays <= 15){
				// Return 1 means users access_token is not expired yet.
				return 1;
			}else{
				// Return 2 means users access_token is expired.
				return 2;
			}
		}else{
			// Return 0 means users access_token is not valid.
			return 0;
		}
	}
	
    public function set_useraccess($data) {
	//echo "<pre>";print_r($data);exit;
		$salt = token(9);
		$now = date('Y-m-d H:i:s');
    
        $dataarr = array( 
            'password' => sha1($salt . sha1($salt . sha1($data['password']))), 
            'date_modified' => $now, 
            'access_token' => null, 
            'status' => 1, 
            'user_group_id' => 1,
            'salt' => $salt
        );

		$this->db->where('id',$data['userid']);
		$this->db->where('email',$data['usermail']);
		$this->db->update('tv_user_tbl',$dataarr);	
        //echo $this->db->last_query();exit;		
        return true;
	}	

    // Signup account
    function signup_account($type, $status) {
        $address = $this->input->post('address');
        
        if(empty($address)) {
            $address = "";
        }
        
        $now = date('Y-m-d H:i:s');
        $verified = '1';
        $password = $this->input->post('password');

        if (empty ($password)) {
            $password = rand(5, 15);
        }
        
        if ($type == "customers") {
            $city = "";
            if($status == "no"){
              $verified = '0';  
            }
        } else {
            $city = $this->input->post('city');
        }
        
        $data = array('accounts_email' => $this->input->post('email'), 'accounts_password' => sha1($password), 'accounts_type' => $type, 'ai_title' => "", 'ai_first_name' => $this->input->post('firstname'), 'ai_last_name' => $this->input->post('lastname'),'ai_address_1' => $address, 'ai_city' => $city, 'ai_country' => $this->input->post('country'), 'ai_mobile' => $this->input->post('phone'), 'accounts_created_at' => $now, 'accounts_updated_at' => $now,'accounts_verified' => $verified, 'accounts_status' => $status);
        $this->db->insert('pt_accounts', $data);
        $id = $this->db->insert_id();
        
        if ($type == "customers") {
            if($status == "yes") {
                $this->session->set_userdata('pt_logged_customer', $id);
                $this->session->set_userdata('fname', $this->input->post('firstname'));
                $this->session->set_userdata('pt_role', $type);  
            }
        }
        
        return $id;
    }
}