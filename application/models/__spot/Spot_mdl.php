<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Spot Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Spot_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getSpots($conditions = array(), $start, $limit) {
        $query = $this->db->select('*')->from('tv_spot_tbl')->limit($limit, $start)->get();
        return $query->result_array();
    }
    
    public function getSpotCategories() {
        $query = $this->db->select('*')->from('tv_spotcategory_tbl')->get();
        return $query->result_array();
    }
}