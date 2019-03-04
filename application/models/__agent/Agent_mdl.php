<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Agent Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Agent_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
   
	public function add_agent($post_data) {

		unset($post_data['submit']);
		
		if(isset($post_data['business_type'])) {
		    $business_type = implode(',', $post_data['business_type']);
		} else {
		    $business_type = '';
		}
		
        $data = array(
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
            'status'                => 1
        );			
        
        $this->db->insert("tv_agent_tbl", $data);	
		return true;
	}
}