<?php 

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Utility_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_countries() {
        $this->db->select('*')->from('tv_main_country_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities() {
        $this->db->select('*')->from('tv_main_city_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_agents() {
        $this->db->select('*')->from('tv_agent_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities_by_country_id($country_id) {
        $this->db->select('*')->from('tv_main_city_tbl')->where('country_id', $country_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_languages() {
        $query = $this->db->select('*')->from('tv_language_tbl')->get();
        return $query->result_array();
    }
    
    public function get_locations() {
        $query = $this->db->select('*')->from('tv_location_tbl')->get();
        return $query->result_array();
    }
    public function get_locations_by_type($type) {
        $query = $this->db->select('*')->from('tv_location_tbl')->where('type', $type)->get();
        return $query->result_array();
    }
    
    public function get_customer_types() {
        $query = $this->db->select('*')->from('tv_customer_type_tbl')->get();
        return $query->result_array();
    }
    
    public function get_payment_statuses() {
        $this->db->select('*')->from('tv_payment_status_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_booking_statuses() {
        $this->db->select('*')->from('tv_booking_status_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_user_groups() {
        $this->db->select('*')->from('tv_user_group_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_categories() {
        $this->db->select('t1.id, t2.category_name')->from('tv_categories_tbl t1')
            ->join('tv_categories_details_tbl t2', 't1.id = t2.tour_cat_id')
                ->where('language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
        $query = $this->db->get();
        return $query->result_array();
    }

}