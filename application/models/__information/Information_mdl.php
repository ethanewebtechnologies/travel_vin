<?php
defined('BASEPATH') OR exit('No direct script access allowed');
 
class Information_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getpage($page_url) {
        $query = $this->db->select('t1.id, t1.page_slug, t2.*')
            ->from('tv_pages_tbl t1')
                ->join('tv_pages_details_tbl t2', 't1.id = t2.page_id')
                    ->where('t1.page_slug', $page_url)->get();
        return	$query->row_array();
	}
}
 
