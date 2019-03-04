<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Wedding Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Wedding_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_weddings($conditions = array(), $start, $limit) {
        
        $query = $this->db->select('t1.*, t2.title, t2.dsc, t3.name as country_name,t4.name as city_name')
            ->from('tv_wedding_tbl t1')
                ->join('tv_wedding_details_tbl t2', 't1.id = t2.wedding_id', 'left')
                    ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
                        ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
                             ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->like('t2.title', $conditions['search_title']);
        }
        
        $this->db->order_by('t1.id', 'DESC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
    
    public function get_total_weddings($conditions = array()) {
        
        $this->db->select('count(t1.id) as total_weddings')
            ->from('tv_wedding_tbl t1')
                    ->join('tv_wedding_details_tbl t2', 't1.id = t2.wedding_id', 'left')
                         ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
                              ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
                                 ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->like('t2.title', $conditions['search_title']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total_weddings'];
    }
    
    public function get_wedding_images_by_wedding_ids($wedding_ids_array) {
        $this->db->select('image, item_id')
        ->from('tv_images_tbl')
             ->where('item_type', 'wedding')
                  ->where_in('item_id', $wedding_ids_array);
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_wedding($wedding_id) {
        $this->db->where('id', $wedding_id);
        $query1 = $this->db->select('*')->from('tv_wedding_tbl')->get();
        $result = $query1->row_array();
        
        $this->db->where('item_type', 'wedding');
        $this->db->where('item_id', $wedding_id);
        $query2 = $this->db->select('image')->from('tv_images_tbl')->get();
        $result['images'] = $query2->result_array();
        
        return $result;
    }
    
    public function get_wedding_details_by_wedding_id($wedding_id) {
        $this->db->where('wedding_id', $wedding_id);
        $query = $this->db->select('*')->from('tv_wedding_details_tbl')->get();
        $result = $query->result_array();
        
        return $result;
    }
    
    public function add_wedding($post_data) {
        
        
        $user = $this->session->userdata('user');
        $data = [
            'slug' => seo_url($post_data['slug']),
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'wedding_category_id' => $post_data['wedding_category_id'],
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_added' => $user['id'],
            'user_updated' => $user['id'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];
        $this->db->insert("tv_wedding_tbl", $data);
        
        $wedding_id = $this->db->insert_id();
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'wedding_id' => $wedding_id,
                'language_code' => $language_code,
                'title' => $detail['title'],
                'dsc' => $detail['dsc'],
                'tags' => $detail['tags'],
                'meta_title' => $detail['meta_title'],
                'meta_dsc' => $detail['meta_dsc'],
                'meta_keywords' => $detail['meta_keywords']
            ];
        }
        
        $this->db->insert_batch('tv_wedding_details_tbl', $data);
        
        $block_dates_array = explode(',', $post_data['block_wedding_dates']);
        
        $data = array();
        
        $this->db->where('item_id', $wedding_id);
        $this->db->delete('tv_block_booking_dates_tbl');
        
        foreach ($block_dates_array as $bd) {
            $data[] = [
                'item_id' => $wedding_id,
                'block_date' => lu_to_d($bd)
            ];
        }
        
        if(!empty($data)) {
            $this->db->insert_batch('tv_block_booking_dates_tbl', $data);
        }
        
        return $wedding_id;
    }
    
    public function update_wedding($post_data, $wedding_id) {
        
        
        
        $user = $this->session->userdata('user');
        
        $data = array();
        
        $data = [
            'slug' => seo_url($post_data['slug']),
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'wedding_category_id' => $post_data['wedding_category_id'],
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'user_updated' => $user['id'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];
        
        $this->db->where('id', $wedding_id);
        $this->db->update("tv_wedding_tbl", $data);
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data = [
                'wedding_id' => $wedding_id,
                'language_code' => $language_code,
                'title' => $detail['title'],
                'dsc' => $detail['dsc'],
                'tags' => $detail['tags'],
                'meta_title' => $detail['meta_title'],
                'meta_dsc' => $detail['meta_dsc'],
                'meta_keywords' => $detail['meta_keywords']
            ];
            
            $this->db->where('wedding_id', $wedding_id);
            $this->db->where('language_code', $language_code);
            $this->db->update('tv_wedding_details_tbl', $data);
        }
        
        $block_dates_array = explode(',', $post_data['block_wedding_dates']);
        
        $data = array();
        
        $this->db->where('item_id', $wedding_id);
        $this->db->delete('tv_block_booking_dates_tbl');
        
        foreach ($block_dates_array as $bd) {
            $data[] = [
                'item_id' => $wedding_id,
                'block_date' => lu_to_d($bd)
            ];
        }
        
        if(!empty($data)) {
            $this->db->insert_batch('tv_block_booking_dates_tbl', $data);
        }
    }
    
    public function delete_wedding($wedding_id) {
        $this->db->where('id', $wedding_id);
        $this->db->delete('tv_wedding_tbl');
        
        return true;
    }
    
    public function add_image($post_data) {
        $this->db->insert("tv_images_tbl", $post_data);
    }
    
    public function delete_images($wedding_id) {
        $this->db->where('item_type','wedding');
        $this->db->where('item_id', $wedding_id);
        $this->db->delete('tv_images_tbl');
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
    
    public function get_all_languages() {
        $query = $this->db->select('*')->from('tv_language_tbl')->get();
        return $query->result_array();
    }
    
    public function get_block_dates($wedding_id) {
        $this->db->select("*")->from("tv_block_booking_dates_tbl")->where("item_id", $wedding_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
}
