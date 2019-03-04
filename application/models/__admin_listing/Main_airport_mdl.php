<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

/*
 * APPLICATION 		: Main airport Model
 * AUTHOR			: Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_airport_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_airports($conditions = array(), $start, $limit) {
        $this->db->select('t1.id,t1.name,t1.type,t1.latitude,t1.longitude,t1.country_id,t1.city_id,t1.status,t1.date_added,t1.date_updated,t1.user_added,t1.user_updated')->from('tv_location_tbl as t1')
             ->join('tv_main_city_tbl as t2','t2.id = t1.city_id', 'left')
                ->join('tv_main_country_tbl as t3','t3.id=t1.country_id', 'left');
        
        $this->db->where('type', 1);
        
        if (isset($conditions['search_airport_name']) && !empty($conditions['search_airport_name'])) {
            $this->db->like('t1.name', $conditions['search_airport_name']);
        }
        if (isset($conditions['search_city_name']) && !empty($conditions['search_city_name'])) {
            $this->db->like('t2.name', $conditions['search_city_name']);
        }
        if (isset($conditions['search_country_name']) && !empty($conditions['search_country_name'])) {
            $this->db->like('t3.name', $conditions['search_country_name']);
        }

        $query = $this->db->get();

        return $query->result_array();
    }

    public function get_total_airports($conditions = array()) {
        $this->db->select("count(t1.id) as total")
        ->from('tv_location_tbl t1')
        ->join('tv_main_city_tbl as t2','t2.id = t1.city_id', 'left')
        ->join('tv_main_country_tbl as t3','t3.id=t1.country_id', 'left');
        
        $this->db->where('type', 2);
        
        if (isset($conditions['search_hotel_name']) && !empty($conditions['search_hotel_name'])) {
            $this->db->like('t1.name', $conditions['search_hotel_name']);
        }
        if (isset($conditions['search_city_name']) && !empty($conditions['search_city_name'])) {
            $this->db->like('t2.name', $conditions['search_city_name']);
        }
        if (isset($conditions['search_country_name']) && !empty($conditions['search_country_name'])) {
            $this->db->like('t3.name', $conditions['search_country_name']);
        }
        $query = $this->db->get();

        return $query->row_array()['total'];
    }

    public function get_airport($airport_id) {
        $this->db->where('id', $airport_id);
        $query = $this->db->select('*')->from('tv_location_tbl')->get();
        return $query->row_array();
    }

    public function myairport($airport_id) {
        $this->db->where('id', $airport_id);
        $query = $this->db->select('*')->from('tv_location_tbl')->get();
        return $query->row_array();
    }

    public function add_airport($data) {
	   $user = $this->session->userdata('user');
        
        $data = [
            'name' => $data['name'],
            'type' => 1,
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'status' => isset($data['status']) ? $data['status'] : 0,
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_added' => $user['id'],
            'user_updated' => $user['id']
        ];

        $this->db->insert("tv_location_tbl", $data);
    }

    public function update_airport($data, $airport_id) {
		$user = $this->session->userdata('user');
        
        $data = [
            'name' => $data['name'],
            'country_id' => $data['country_id'],
            'city_id' => $data['city_id'],
            'status' => isset($data['status']) ? $data['status'] : 0,
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_updated' => $user['id']
        ];

        $this->db->where('id', $airport_id);
        $this->db->update("tv_location_tbl", $data);
    }

    public function delete_airport($airport_id) {
        $this->db->where('id', $airport_id);
        $this->db->delete('tv_location_tbl');

        return true;
    }
    
    public function change_user_status($user_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $user_id);
        $this->db->update('tv_location_tbl');
    }
}
