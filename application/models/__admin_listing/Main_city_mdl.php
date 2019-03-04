<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Main city Model
 * AUTHOR			: Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Main_city_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_cities($conditions = array(), $start, $limit) {
      	$this->db->select('t1.*')->from('tv_main_city_tbl as t1')
            ->join('tv_main_country_tbl as t2','t2.id=t1.country_id', 'left');
		
		if (isset($conditions['search_city_name']) && !empty($conditions['search_city_name'])) {
            $this->db->like('t1.name', $conditions['search_city_name']);
        }
        
		if (isset($conditions['search_country_name']) && !empty($conditions['search_country_name'])) {
            $this->db->like('t2.name', $conditions['search_country_name']);
        }
        
        if (isset($start) && isset($limit)) { 
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
		
        return $query->result_array();
    }
	
	public function get_total_cities($conditions = array()) {
	    $this->db->select("count(t1.id) as total")->from('tv_main_city_tbl as t1')
	       ->join('tv_main_country_tbl as t2','t2.id=t1.country_id','left');
	    
	       if (isset($conditions['search_city_name']) && !empty($conditions['search_city_name'])) {
	           $this->db->like('t1.name', $conditions['search_city_name']);
	       }
	    
	    if (isset($conditions['search_country_name']) && !empty($conditions['search_country_name'])) {
	        $this->db->like('t2.name', $conditions['search_country_name']);
	    }
		
		$query = $this->db->get();
	    
		return $query->row_array()['total'];
	}
	
	public function get_city($city_id) {
	    $query = $this->db->select('*')->from('tv_main_city_tbl')->where('id', $city_id)->get();
        return $query->row_array();
    }
    
    public function add_city($data) {
		
    	$user = $this->session->userdata('user');
    	$city_slug = seo_url($data['name']);
    	
    	$data = [
    		'name' => $data['name'],
    		'country_id'=>$data['country_id'],
    	    'seo_url' => $city_slug,
    		'longitude' => $data['longitude'],
    		'lattitude' => $data['lattitude'],
    	    'status' => isset($data['status']) ? $data['status'] : 0,
    	    'date_added' => lu_to_d(date('Y-m-d H:i:s')),
    	    'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
    		'user_added' => $user['id'], 
    		'user_updated' => $user['id']
    	];
		
		$this->db->insert("tv_main_city_tbl", $data) ;
    }
    
    public function update_city($data, $city_id) {
        $user = $this->session->userdata('user');
        $city_slug = seo_url($data['name']);
	   
        $datas = array(
            'name' => $data['name'],
			'country_id' => $data['country_id'],
            'seo_url' => $city_slug,
            'status' => isset($data['status']) ? $data['status'] : 0,
            'longitude' => $data['longitude'],
            'lattitude' => $data['lattitude'],          
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_updated' => $user['id']
	    );
   
        $this->db->where('id', $city_id);
        $this->db->update('tv_main_city_tbl', $datas);
    }
       
    public function delete_city($city_id) {
        $this->db->where('id', $city_id);
        $this->db->delete('tv_main_city_tbl');
    } 
	
    public function get_countries() {
	    $this->db->select('*')->from('tv_main_country_tbl');
	    $query = $this->db->get();
	    return $query->result_array();
	}
	public function change_user_status($user_id, $status) {
	    $this->db->set('status', $status);
	    $this->db->where('id', $user_id);
	    $this->db->update('tv_main_city_tbl');
	}
}