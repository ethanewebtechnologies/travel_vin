<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: INFORMATION MODEL
 * AUTHOR			: KUNADAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Information_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_informations($conditions = array(), $start, $limit) {
		
        $query = $this->db->select('t1.*, t2.title, t2.overview, t3.name as country_name,t4.name as city_name')
           ->from('tv_information_tbl t1')
              ->join('tv_information_details_tbl t2', 't1.id = t2.information_id', 'left')
                ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
                    ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
                        ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
		if (isset($conditions['search_title_name']) && !empty($conditions['search_title_name'])) {
            $this->db->like('t2.title', $conditions['search_title_name']);
        }
        $this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();
     }
    public function get_total_informations($conditions = array()) {
		$query = $this->db->select('count(t1.id) as total_informations')
		  ->from('tv_information_tbl t1')
		      ->join('tv_information_details_tbl t2', 't1.id = t2.information_id', 'left')
		          ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
		              ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
		                  ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
		
		if (isset($conditions['search_title_name']) && !empty($conditions['search_title_name'])) {
            $this->db->like('t2.title', $conditions['search_title_name']);
        }
        $query = $this->db->get();
        return $query->row_array()['total_informations'];
    }
    
	public function get_information($information_id) {
		$query = $this->db->select('*')->from('tv_information_tbl')->where('id', $information_id)->get();
        return $query->row_array();
    }
    
	public function get_information_details($information_id) {
		$query = $this->db->select('*')->from('tv_information_details_tbl')->where('information_id', $information_id)->get();
        return $query->result_array();
    }
    
    public function add_information($post_data) {
        $user = $this->session->userdata('user');
        
        $data = [
            'image' => $post_data['image'],
            'lattitude' => $post_data['lattitude'],
            'longitude' => $post_data['longitude'],
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
			'status' => isset($post_data['status']) ? $post_data['status'] : 0,
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_added' => $user['id'],
            'user_modified' => $user['id']
        ];
        $query = $this->db->select('city_id')->from('tv_information_tbl')->where('city_id', $post_data['city_id'])->get();
        
        $this->db->insert("tv_information_tbl", $data);
        $information_id = $this->db->insert_id();
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'information_id' => $information_id,
                'language_code' => $language_code,
                'title' => $detail['title'],
                'meta_title' => $detail['meta_title'],
                'meta_dsc' => $detail['meta_dsc'],
                'meta_keywords' => $detail['meta_keywords'],
                'overview' => $detail['overview'],
                'information' => $detail['information'],
                'things_to_do' => $detail['things_to_do']
            ];
        }
        
        $this->db->insert_batch('tv_information_details_tbl', $data); 
    }
	
	   
    public function get_all_languages() {
        $query = $this->db->select('*')->from('tv_language_tbl')->get();
        return $query->result_array();
    }

    public function update_information($post_data, $information_id) {
	    $user = $this->session->userdata('user');
	    
	    $data = [
	        'status' => isset($post_data['status']) ? $post_data['status'] : 0,
	        'country_id' => $post_data['country_id'],
	        'city_id' => $post_data['city_id'],
	        'lattitude' => $post_data['lattitude'],
	        'longitude' => $post_data['longitude'],
	        'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
	        'user_modified' => $user['id']
	    ];
	    
	    if(isset($post_data['image'])) {
	        $data['image'] = $post_data['image'];
	    }
	    
	    $this->db->where('id', $information_id);
	    $this->db->update("tv_information_tbl", $data);
	    
	    $data = array();
	    
	    foreach ($post_data['details'] as $language_code => $detail) {
	        $data = [
	            'title' => $detail['title'],
	            'meta_title' => $detail['meta_title'],
	            'meta_dsc' => $detail['meta_dsc'],
	            'meta_keywords' => $detail['meta_keywords'],
	            'overview' => $detail['overview'],
	            'information' => $detail['information'],
	            'things_to_do' => $detail['things_to_do']
	        ];
	        
	        $this->db->where('information_id', $information_id);
	        $this->db->where('language_code', $language_code);
	        $this->db->update("tv_information_details_tbl", $data);
	    }
    }

    public function delete_information($information_id) {
	    $this->db->where('id', $information_id);
        $this->db->delete('tv_information_tbl');

        return true;
	}	
	
	public function get_cities_id_from_information_tbl_by_country_id($country_id) {
	    $this->db->select('city_id')->from('tv_information_tbl')->where('country_id', $country_id);
	    $query = $this->db->get();
	    return $query->result_array();
	}
	
	public function get_row_information_tbl_by_city_id_db($city_id) {
	    $this->db->select('city_id')->from('tv_information_tbl')->where('city_id', $city_id);
	    $query = $this->db->get();
	    if($query->num_rows()>0){
			return true;
		}
		else{
			return false;
		}
	}
	

	
	public function get_long_latt_by_city_id($city_id) {
	    $this->db->select('*')->from('tv_main_city_tbl')->where('id', $city_id);
	    $query = $this->db->get();
	    return $query->row_array();
	}
}