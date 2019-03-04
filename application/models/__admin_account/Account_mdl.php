<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/*
 * APPLICATION 		: Account Model
 * AUTHOR			: DHIRENDRA KUMAR
 * CONTRIBUTORS     : DHIRENDRA KUMAR, VINAY KUMAR SHARMA 
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Account_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    // Admin login
    public function login_admin($username, $password) {
        
        $remember = $this->input->post('remember');
		$this->db->select('email, id, firstname, lastname')
		  ->from('tv_user_tbl')
		      ->where('email', $username)
		          ->where('password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, SHA1(' . $this->db->escape($password) . ')))))')
		              ->where('status', '1')
		                  ->where('approved', '1')
		                      ->where('user_group_id', '1');
		
		$query = $this->db->get();

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

    public function reg_validate($token) {
        
		$now = date('Y-m-d H:i:s');
		$token_data = explode('/',  $this->security_lib->decrypt($token));		
		
		$query = $this->db->select('id')->from('tv_user_tbl')->where('access_token', $token)->get();
		
		if($query->num_rows() > 0) {
		    $datetime1 = date_create($token_data[1]);
			$datetime2 = date_create($now);
			$interval = date_diff($datetime1, $datetime2);
			$cdays = (int)$interval->format('%a');
			
			//if($cdays <= 15) {
				// Return 1 means users access_token is not expired yet.
				return 1; // AS THIS IS A USER REQUEST LINK TO REGISTER .. SO WE WILL NOT EXPIRE THIS LINK
			//} else {
				// Return 2 means users access_token is expired.
				//return 2;
			//}
		} else {
			// Return 0 means users access_token is not valid.
			return 0;
		}
	}
	
	public function reg_validate2($token) {
	    
	    $now = date('Y-m-d H:i:s');
	    
	    $token_dcy = $this->security_lib->decrypt($token);
	    $token_data = explode('/', $token_dcy);
	    
	    $query = $this->db->select('id')->from('tv_user_tbl')->where('access_token', $token)->get();
	    
	    if($query->num_rows() > 0) {
	        $datetime1 = date_create($token_data[1]);
	        $datetime2 = date_create($now);
	        $interval = date_diff($datetime1, $datetime2);
	        $cdays = (int)$interval->format('%a');
	        
	        if($cdays <= 15) {
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
	
    public function set_useraccess($post_data) {
		$salt = token(9);
        
        $data = array( 
            'password' => sha1($salt . sha1($salt . sha1($post_data['password']))), 
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')), 
            'access_token' => null, 
            'status' => 1, 
            'user_group_id' => 1,
            'salt' => $salt
        );

        $this->db->where('id', $post_data['userid']);
        $this->db->where('email', $post_data['usermail']);
        $this->db->update('tv_user_tbl', $data);	
        
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
    
    //CHECK E-MAIL FORGET PASSWORD
    public function check_email_forget_password($email) {
        $this->db->select("*")
            ->from('tv_user_tbl')
                ->where('email', $email);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    // ADD ACCESS TOKEN FOR FORGET PASSWORD
    public function add_accesstoken($accesstoken, $data) {
        $postdata =  $this->db->select("*")->from('tv_user_tbl')->where('id', $data['id'])->get()->row_array();
        $postdata['access_token'] = $accesstoken;
        $this->db->where("id", $data['id']);
        $result = $this->db->update('tv_user_tbl', $postdata);
        return $result;
    }
    
    // get user according to entity id
    // get user according to entity id
    public function get_user($user_id) {
        $data = $this->db->select('*')->from('tv_user_tbl')->where('id', $user_id)->get()->row_array();
        return $data;
    }
}