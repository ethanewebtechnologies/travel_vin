<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: DASHBOARD MODEL
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Dashboard_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_vendor_business_type($vendor_id) {
        $this->db->select('business_type')
            ->from('tv_agent_tbl')
                ->where('id', $vendor_id);
        
        $query = $this->db->get();  
        return $query->row_array()['business_type'];
    }
}