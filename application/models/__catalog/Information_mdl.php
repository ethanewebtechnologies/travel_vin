<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Information Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Information_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_information($country_slug, $city_slug, $language_code) {
        $this->db->select("t1.*, t2.*, t3.name as country_name, t4.name as city_name");
        $this->db->from("tv_information_tbl t1");
        $this->db->join("tv_information_details_tbl t2", "t1.id = t2.information_id", "left");
        $this->db->join("tv_main_country_tbl t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl t4", "t4.id = t1.city_id");
        $this->db->where('t2.language_code', $language_code);
        $this->db->where('t3.seo_url', $country_slug);
        $this->db->where('t4.seo_url', $city_slug);
        $query = $this->db->get();
        
        return $query->row_array();
    }
}