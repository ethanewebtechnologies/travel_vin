<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: FOOTER MODEL
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTOR		: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Footer_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function getStaticPages() {
        $this->db->select('t1.page_slug, t2.*')
            ->from('tv_pages_tbl t1')
                ->join('tv_pages_details_tbl t2', 't1.id = t2.page_id')
                    ->where('t1.status', 1);
        
        $query = $this->db->get();
        return	$query->result_array();
    }
    
    public function get_countries() {
        $this->db->select('*')->from('tv_main_country_tbl')->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities() {
        $this->db->select('*')->from('tv_main_city_tbl')->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities_by_country_seo_url($seo_url) {
        $this->db->select('*')->from('tv_main_city_tbl t1');
        $this->db->join("tv_main_country_tbl t2", "t1.country_id = t2.id");
        $this->db->where("t2.seo_url", $seo_url)->where('t1.status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
}