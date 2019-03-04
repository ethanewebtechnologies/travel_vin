<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Main Country Model
 * AUTHOR			: Kundan Kumar, Mohit, Vinay Sharma
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_country_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
        $this->load->library('session');
    }
    
    public function get_countries($conditions = array(), $start, $limit) {
				
        $this->db->select('*')->from(DB_PREFIX . 'main_country' . DB_SUFFIX);
		
		if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('name', $conditions['search_name']);
        }
        
        if (isset($start) && isset($limit)) { 
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
		
        return $query->result_array();
    }

	 public function get_total_countries($conditions = array()) {
	    $this->db->select("count(id) as total")->from('tv_main_country_tbl');
		
		if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('name', $conditions['search_name']);
        }
		
		$query = $this->db->get();
	    
		return $query->row_array()['total'];
	}
    
    public function get_country($country_id) {
        $this->db->where('id', $country_id);
        $query = $this->db->select('*')->from('tv_main_country_tbl')->where('id',$country_id)->get();
        return $query->row_array();
    }
	    
	public function get_static_countries() {
        $countriesData = json_decode(file_get_contents("application/json/countries.json"));
        usort($countriesData, array($this, "sortByName"));
        return $countriesData;
    }
	
    public function sortByName($a, $b) {
        return strcmp($a->short_name, $b->short_name);
    }
	
    public function add_country($input_data) {
        $user = $this->session->userdata('user');
        
        $data = array();
        
        $date_added = date('Y-m-d H:i:s');
        $date_updated = date('Y-m-d H:i:s');
        
         if(strlen($input_data['date_of_arrival']) > 0) { 
            $date_of_arrival = lu_to_d($input_data['date_of_arrival']);
        } else {
            $date_of_arrival = null;
        } 
        
        foreach ($input_data['countries'] as $country) {
            $data[] = [
                'name' => $country,
                'seo_url' => seo_url($country),
                'date_of_arrival' => $date_of_arrival,
                'date_added' => $date_added,
                'date_updated' => $date_updated,
                'status' => isset($input_data['status']) ? $input_data['status'] : 0,
                'user_added' => $user['id'],
                'user_updated' => $user['id']
            ];
        }
        
        $this->db->insert_batch('tv_main_country_tbl', $data); 
    }
    
    public function update_country($input_data, $country_id) {
        $user = $this->session->userdata('user');
        
        $data = [
            'name' => $input_data['name'],
            'seo_url' => seo_url($input_data['name']),
            'date_of_arrival' => $input_data['date_of_arrival'] != '' ? lu_to_d($input_data['date_of_arrival']) : null,
            'date_updated' => date('Y-m-d H:i:s'),
            'status' => isset($input_data['status']) ? $input_data['status'] : 0,
            'user_updated' => $user['id']
        ];
        
        $this->db->where('id', $country_id);
        $this->db->update('tv_main_country_tbl', $data);
    }
    
    public function delete_country($country_id) {
        $this->db->where('id', $country_id);
        $this->db->delete('tv_main_country_tbl');
    }
	  
	/* For get Continent  */
    public function get_static_continents() {
        $result = $this->db->select("*")->from("tv_static_continents_tbl")->get()->result_array();
        return $result;
    }
	
    /* For get Country  */
    public function get_countries_by_continent_code($continent_code) {
        $query = $this->db->select('*')->from('tv_static_country_tbl')->where("continent_code", $continent_code)->get();
		return $query->result_array();
    }
    
    public function change_user_status($user_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $user_id);
        $this->db->update('tv_main_country_tbl');
    }
}