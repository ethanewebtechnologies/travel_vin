<?php 

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Account Controller
 * AUTHOR			: MOHIT CHAUHAN
 * CONTRIBUTORS     : MOHIT CHAUHAN, VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Accounts_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
		$this->load->helper('Encryption');
    }
    
    public function get_agents($conditions = array(), $start, $limit) {
        $this->db->select("*")->from("tv_agent_tbl");
        
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->like('company_legal_name', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('email', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('admin_fullname', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('admin_email', $conditions['search_company_legal_name']);
        }
        
        $this->db->order_by('id', 'DESC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }  
    
    public function get_total_agents($conditions = array()) {
        $this->db->select("count(id) as total_agents")->from("tv_agent_tbl");
        
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->like('company_legal_name', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('email', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('admin_fullname', $conditions['search_company_legal_name']);
        }
        if(isset($conditions['search_company_legal_name']) && !empty($conditions['search_company_legal_name'])) {
            $this->db->or_like('admin_email', $conditions['search_company_legal_name']);
        }
        $query = $this->db->get();
        return $query->row_array()['total_agents'];
    }
    
    public function get_agent($agent_id) {
        $query = $this->db->select("*")->from("tv_agent_tbl")->where('id', $agent_id)->get();
        return $query->row_array();
    } 

    public function add_agent($get_data) {
        if(isset($get_data['business_type'])) {
            $business_type = implode(',', $get_data['business_type']);
        } else {
            $business_type = '';
        }
        
        $set_data = array(
            'company_legal_name'    => $get_data['company_legal_name'],
            'email'                 => $get_data['email'],
            'address'               => $get_data['address'],
            'telephone'             => $get_data['telephone'],
            'tax_id'                => $get_data['tax_id'],
            'city'                  => $get_data['city'],
            'country'               => $get_data['country'],
            'state'                 => $get_data['state'],
            'postal'                => $get_data['postal'],
            'admin_fullname'        => $get_data['admin_fullname'],
            'admin_contact'         => $get_data['admin_contact'],
            'admin_email'           => $get_data['admin_email'],
            'business_type'         => $business_type,
            'status'                => 0
        );	
        
        $this->db->insert("tv_agent_tbl", $set_data);
    }
    
    public function update_agent($post_data, $agent_id) {
        
        if(isset($post_data['business_type'])) {
            $business_type = implode(',', $post_data['business_type']);
        } else {
            $business_type = '';
        }
        
        $set_data = array(
            'company_legal_name'    => $post_data['company_legal_name'],
            'email'                 => $post_data['email'],
            'address'               => $post_data['address'],
            'telephone'             => $post_data['telephone'],
            'tax_id'                => $post_data['tax_id'],
            'city'                  => $post_data['city'],
            'country'               => $post_data['country'],
            'state'                 => $post_data['state'],
            'postal'                => $post_data['postal'],
            'admin_fullname'        => $post_data['admin_fullname'],
            'admin_contact'         => $post_data['admin_contact'],
            'admin_email'           => $post_data['admin_email'],
            'business_type'         => $business_type,
            'status'                => 0
        );
        
        $this->db->where('id', $agent_id);
        $this->db->update("tv_agent_tbl", $set_data);
    }
    
    public function delete_agent($agent_id) {
        $this->db->where('id', $agent_id);
        $this->db->delete('tv_agent_tbl');
        
        return true;
    }
	
    public function change_agent_status($agent_id, $status, $agent_detail) {
		 $this->db->set('status', $status);
        $this->db->where('id', $agent_id);
        $this->db->update('tv_agent_tbl'); 
		return true;
    }
     
    public function change_agent_approval($agent_id, $status, $agent_detail) {
        $access_token = $this->security_lib->encrypt($agent_id . '/' . date('Y-m-d H:i:s') . '/' . $agent_detail['admin_email']);
        $this->db->set('approved', $status);
        $this->db->set('access_token', $access_token);
        $this->db->where('id', $agent_id);
        $this->db->update('tv_agent_tbl');
        return $access_token;
    }
	
}