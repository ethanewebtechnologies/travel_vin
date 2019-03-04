<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Vendor Login Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR      : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Login_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->helper('Encryption_helper');
        
        $this->load->library(array(
            'session',
            '__commonlib/Security_lib',
            'email'
        ));
    }
    
    public function has_any_vendor() {
        $query = $this->db->select('1')->from(DB_PREFIX . 'agent' . DB_SUFFIX)->get();
        
        if ($query->num_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    
    public function validate_vendor($post_email, $post_password, $remember = false) {
        $this->db->select("*")
            ->from("tv_agent_tbl")
                ->where("admin_email", $post_email)
                    ->where("admin_password = SHA1(CONCAT(salt, SHA1(CONCAT(salt, '" . SHA1($post_password) . "'))))");
        
        $query = $this->db->get();
        
        $num = $query->num_rows();
        $vendor = $query->row_array();
        
        if ($num > 0) {
            if (empty($remember)) {
                $this->session->sess_expire_on_close = true;
            }
            
            $this->session->set_userdata('vendor', $vendor);
            
            return true;
        }
        
        return false;
    }
}