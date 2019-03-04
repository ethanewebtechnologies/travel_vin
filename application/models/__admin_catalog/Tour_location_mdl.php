<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Spot Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Spot_location_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getSpots() {
        $query = $this->db->select('*')->from('tv_spot_location_tbl')->get();
        return	$query->result_array();
    }
    
    public function add($data) {
        
        $data = [
            'spotcode' => $data['spotcode'],
            'title' => $data['title'],
            'dsc' => $data['description'],
            'spot_category_id' => $data['cat_id'],
            'tags' =>$data['tage'],
            'sort_order' =>$data['sort_order'],
            'date_added' => date('Y-m-d H:i:s'),
            'date_modified' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert("tv_spot_location_tbl", $data) ;
    }
    
    public function updatepage($data, $pageid) {
        
        $data = [
            'spotcode' => $data['spotcode'],
            'title' => $data['title'],
            'dsc' => $data['description'],
            'spot_category_id' => $data['cat_id'],
            'tags' =>$data['tage'],
            'sort_order' =>$data['sort_order'],
            'date_modified' => date('Y-m-d H:i:s')
        ];
        
        $this->db->where('id',$pageid);
        $this->db->update("tv_spot_location_tbl", $data);
    }
}
