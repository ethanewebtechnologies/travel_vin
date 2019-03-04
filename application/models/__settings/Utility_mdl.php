<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Utility Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */


class Utility_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_countries() {
        $this->db->select('*')
            ->from('tv_main_country_tbl')
                ->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities() {
        $this->db->select('*')
            ->from('tv_main_city_tbl')
                ->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_agents() {
        $this->db->select('*')
            ->from('tv_agent_tbl')
                ->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_cities_by_country_id($country_id) {
        $this->db->select('*')
            ->from('tv_main_city_tbl')
                ->where('country_id', $country_id)
                    ->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
	
	public function get_cities_by_country_ids($country_ids) {
        $this->db->select('*')
            ->from('tv_main_city_tbl')
                ->where_in('country_id', $country_ids)
                    ->where('status', 1);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_languages() {
        $this->db->select('*')
            ->from('tv_language_tbl')
                ->where('status', 1);
                 
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_locations() {
        $this->db->select('*')
            ->from('tv_location_tbl')
                ->where('status', 1);
            
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_static_countries() {
        $query = $this->db->select('*')->from('tv_static_country_tbl')->get();
        return $query->result_array();
    }
    
    public function get_static_states() {
        $query = $this->db->select('*')->from('tv_static_state_tbl')->get();
        return $query->result_array();
    }
    
    public function get_static_states_by_country_id($country_id) {
        $query = $this->db->select('*')->from('tv_static_state_tbl')->where('country_id', $country_id)->get();
        return $query->result_array();
    }
    
    public function get_settings($category) {
        $query = $this->db->select('*')->from('tv_settings_tbl')->where('category', $category)->get();
        return $query->result_array();
    }
	
	public function get_tbl_country_by_seo_url($seo_url){
		$query = $this->db->select('*')->from('tv_main_country_tbl')->where('seo_url',$seo_url)->get();
        return $query->row_array();
	}
}