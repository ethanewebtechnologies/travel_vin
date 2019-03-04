<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: User Model
 * AUTHOR			: DHIRENDRA KUMAR
 * CONTRIBUTORS		: DHIRENDRA KUMAR, VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class User_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_users($conditions = array(), $start, $limit) {
        $this->db->select('t1.*, t2.gp_name')
            ->from('tv_user_tbl as t1')
                ->join('tv_user_group_tbl t2', 't1.user_group_id = t2.id');
        
        if (isset($conditions['search_user']) && !empty($conditions['search_user'])) {
            $this->db->like('concat(t1.firstname," ",t1.lastname)', $conditions['search_user']);
            $this->db->or_like('t1.firstname', $conditions['search_user']);
            $this->db->or_like('t1.lastname', $conditions['search_user']);
        }
        
        if (isset($conditions['search_user_email']) && !empty($conditions['search_user_email'])) {
            $this->db->like('t1.email', $conditions['search_user_email']);
        }
        
        if (isset($conditions['search_user_group']) && !empty($conditions['search_user_group'])) {
            $this->db->where('t1.user_group_id', $conditions['search_user_group']);
        }
        
        $this->db->limit($limit, $start);
        
        $query = $this->db->get();
        
        return $query->result_array();
    }  
    
    public function get_total_users($conditions = array()) {
        $this->db->select('count(t1.id) as total')
            ->from('tv_user_tbl as t1')
                ->join('tv_user_group_tbl t2', 't1.user_group_id = t2.id');
        
        if (isset($conditions['search_user']) && !empty($conditions['search_user'])) {
            $this->db->like('concat(t1.firstname," ",t1.lastname)', $conditions['search_user']);
            $this->db->or_like('t1.firstname', $conditions['search_user']);
            $this->db->or_like('t1.lastname', $conditions['search_user']);
        }
        
        if (isset($conditions['search_user_email']) && !empty($conditions['search_user_email'])) {
            $this->db->like('t1.email', $conditions['search_user_email']);
        }
        
        if (isset($conditions['search_user_group']) && !empty($conditions['search_user_group'])) {
            $this->db->where('t1.user_group_id', $conditions['search_user_group']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    } 

	public function get_user_by_user_id($user_id) {
	    $this->db->select("*")->from("tv_user_tbl")->where('id', $user_id);
        $query = $this->db->get();
        return $query->row_array();
    }
    
    public function get_user_group_by_user_id($user_id) {
	    $this->db->select("user_group_id")->from("tv_user_tbl")->where('id', $user_id);
        $query = $this->db->get();
        return $query->row_array()['user_group_id'];
    }

    public function update_user($post_data, $user_id) {
		$date_modified = lu_to_d(date('Y-m-d H:i:s'));
		
		$data = array( 
		    'user_group_id' => $post_data['user_group_id'],
		    'email' => $post_data['email'], 
		    'firstname' => $post_data['fname'], 
		    'lastname' => $post_data['lname'],
		    'date_modified' => $date_modified,
		    'status' => isset($post_data['status']) ? $post_data['status'] : 0
        );   
		
		$this->db->where('id', $user_id); // which row want to upgrade  
		$this->db->update('tv_user_tbl',$data); 
		
		return true;
    }	
	
    public function change_user_status($user_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $user_id);
        $this->db->update('tv_user_tbl');
    }
	
    public function adduser($post_data) {
		//$salt = token(9);
    
        $data = array(
            'user_group_id' => $post_data['user_group_id'],
            'email' => $post_data['email'], 
            'firstname' => $post_data['fname'], 
            'lastname' => $post_data['lname'], 
            'date_added' => lu_to_d(date('Y-m-d H:i:s')), 
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'approved' => 1, 
            'status' => isset($post_data['status']) ? $post_data['status'] : 0
        );
        
        $this->db->insert('tv_user_tbl', $data);
        $id = $this->db->insert_id();
		
		$access_token = $this->security_lib->encrypt($id . '/' . date('Y-m-d H:i:s') . '/' . $this->input->post('email'));
		
		$this->db->set('access_token', $access_token); // value that used to update column  
		$this->db->where('id', $id); // which row want to upgrade  
		$this->db->update('tv_user_tbl'); 
		
		return array(
		    'access_token' => $access_token,
		    'user_id' => $id,
		    'name' => $post_data['fname'].' '.$post_data['lname']
		);		
	}	
	
	public function get_restricted_zones() {
	    $this->db->select("*")->from("tv_restricted_zone_tbl")->where('status', TV_ON);
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	public function add_user_permission($restrictions, $user_id, $user_group_id) {
	    
	    $this->db->where('permitted_user_id', $user_id);
	    $this->db->where('permitted_user_group_id', $user_group_id);
	    $this->db->delete('tv_user_permission_tbl');
	    
	    if(isset($restrictions) && !empty($restrictions)) { 
    	    foreach ($restrictions as $restriction) {
    	        $restricted_zone_data[] = array(
    	            'restrictied_zone_id' => $restriction,
    	            'permitted_user_id' => $user_id,
    	            'permitted_user_group_id' => $user_group_id
    	        );
    	    }
    	    
    	    $this->db->insert_batch('tv_user_permission_tbl', $restricted_zone_data);
	    }
	}
	
	public function get_user_permission($user_id, $user_group_id) {
	    $this->db->select("*")
	       ->from("tv_user_permission_tbl")
	           ->where("permitted_user_id", $user_id)
	               ->where("permitted_user_group_id", $user_group_id);
	    
	    $query = $this->db->get();
	    return $query->result_array();
	}
	    
	public function delete_user($user_id) {
	    $this->db->where('id', $user_id);
	    $this->db->delete('tv_user_tbl');
	}
}