<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: TOUR MODEL
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Tour_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tours($conditions = array(), $start, $limit) {

        $query = $this->db->select('t1.*, t2.title, t2.dsc, t3.name as country_name,t4.name as city_name')
        ->from('tv_tour_tbl t1')
            ->join('tv_tour_details_tbl t2', 't1.id = t2.tour_id', 'left')
             ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
                ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
                    ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);

        if (isset($conditions['search_adult_price']) && !empty($conditions['search_adult_price'])) {
            $this->db->where('t1.adult_price', $conditions['search_adult_price']);
        }
        if (isset($conditions['search_child_price']) && !empty($conditions['search_child_price'])) {
            $this->db->where('t1.child_price', $conditions['search_child_price']);
        }
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

    public function get_total_tours($conditions = array()) {
        
        $this->db->select('count(t1.id) as total_tours')
             ->from('tv_tour_tbl t1')
                 ->join('tv_tour_details_tbl t2', 't1.id = t2.tour_id', 'left')
                    ->join('tv_main_country_tbl t3', 't3.id = t1.country_id','left')
                         ->join('tv_main_city_tbl t4', 't4.id = t1.city_id','left')
                              ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
        
          if (isset($conditions['search_adult_price']) && !empty($conditions['search_adult_price'])) {
              $this->db->where('t1.adult_price', $conditions['search_adult_price']);
          }
          if (isset($conditions['search_child_price']) && !empty($conditions['search_child_price'])) {
              $this->db->where('t1.child_price', $conditions['search_child_price']);
          }
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->like('t2.title', $conditions['search_title']);
        }

        $query = $this->db->get();
        return $query->row_array()['total_tours'];
    }
    
    public function get_tour_images_by_tour_ids($tour_ids_array) {
        $this->db->select('image, item_id')
            ->from('tv_images_tbl')
                ->where('item_type', 'tour')
                    ->where_in('item_id', $tour_ids_array);
        
        $query = $this->db->get();
        return $query->result_array();
    }

    public function get_tour($tour_id) {
        $this->db->where('id', $tour_id);
        $query1 = $this->db->select('*')->from('tv_tour_tbl')->get();
        $result = $query1->row_array();

        $this->db->where('item_type', 'tour');
        $this->db->where('item_id', $tour_id);
        $query2 = $this->db->select('image')->from('tv_images_tbl')->get();
        $result['images'] = $query2->result_array();

        return $result;
    }

    public function get_tour_details_by_tour_id($tour_id) {
        $this->db->where('tour_id', $tour_id);
        $query = $this->db->select('*')->from('tv_tour_details_tbl')->get();
        $result = $query->result_array();

        return $result;
    }

    public function add_tour($post_data) {

        $user = $this->session->userdata('user');
        $data = [
            'slug' => seo_url($post_data['slug']),
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'agent_cost' => $post_data['agent_cost'],
            'adult_price' => $post_data['adult_price'],
            'adult_deal_price' => $post_data['adult_deal_price'],
            'child_price' => $post_data['child_price'],
            'child_deal_price' => $post_data['child_deal_price'],
			'min_child_age' => $post_data['min_child_age'],
			'max_child_age' => $post_data['max_child_age'],
            'tour_category_id' => $post_data['tour_category_id'],
            'sort_order' => $post_data['sort_order'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
            'is_elite' => isset($post_data['is_elite']) ? $post_data['is_elite'] : 0,
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_modified' => $user['id']
        ];

        $this->db->insert("tv_tour_tbl", $data);

        $tour_id = $this->db->insert_id();

        $data = array();

        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'tour_id' => $tour_id,
                'language_code' => $language_code,
                'title' => $detail['title'],
                'dsc' => $detail['dsc'],
                'tags' => $detail['tags'],
                'meta_title' => $detail['meta_title'],
                'meta_dsc' => $detail['meta_dsc'],
                'meta_keywords' => $detail['meta_keywords']
            ];
        }

        $this->db->insert_batch('tv_tour_details_tbl', $data);
        
        $block_dates_array = explode(',', $post_data['block_tour_dates']);
        
        $data = array();
        
        $this->db->where('item_id', $tour_id);
        $this->db->delete('tv_block_booking_dates_tbl');
        
        foreach ($block_dates_array as $bd) {
            $data[] = [
                'item_id' => $tour_id,
                'block_date' => lu_to_d($bd)
            ];
        }
        
        if(!empty($data)) {
            $this->db->insert_batch('tv_block_booking_dates_tbl', $data);
        }
		
		return $tour_id;
    }

    public function update_tour($post_data, $tour_id) {
        
        

        $user = $this->session->userdata('user');

        $data = array();

        $data = [
            'slug' => seo_url($post_data['slug']),
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'agent_cost' => $post_data['agent_cost'],
            'adult_price' => $post_data['adult_price'],
            'adult_deal_price' => $post_data['adult_deal_price'],
            'child_price' => $post_data['child_price'],
            'child_deal_price' => $post_data['child_deal_price'],
			'min_child_age' => $post_data['min_child_age'],
			'max_child_age' => $post_data['max_child_age'],
            'tour_category_id' => $post_data['tour_category_id'],
            'sort_order' => $post_data['sort_order'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
            'is_elite' => isset($post_data['is_elite']) ? $post_data['is_elite'] : 0,
            'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
            'user_modified' => $user['id']
        ];

        $this->db->where('id', $tour_id);
        $this->db->update("tv_tour_tbl", $data);

        $data = array();

        foreach ($post_data['details'] as $language_code => $detail) {
            $data = [
                'tour_id' => $tour_id,
                'language_code' => $language_code,
                'title' => $detail['title'],
                'dsc' => $detail['dsc'],
                'tags' => $detail['tags'],
                'meta_title' => $detail['meta_title'],
                'meta_dsc' => $detail['meta_dsc'],
                'meta_keywords' => $detail['meta_keywords']
            ];

            $this->db->where('tour_id', $tour_id);
            $this->db->where('language_code', $language_code);
            $this->db->update('tv_tour_details_tbl', $data);
        }
        
        $block_dates_array = explode(',', $post_data['block_tour_dates']);
        
        $data = array();
        
        $this->db->where('item_id', $tour_id);
        $this->db->delete('tv_block_booking_dates_tbl');
        
        foreach ($block_dates_array as $bd) {
            $data[] = [
                'item_id' => $tour_id,
                'block_date' => lu_to_d($bd)
            ];
        }
        
        if(!empty($data)) {
            $this->db->insert_batch('tv_block_booking_dates_tbl', $data);
        }
    }

    public function delete_tour($tour_id) {
        $this->db->where('id', $tour_id);
        $this->db->delete('tv_tour_tbl');

        return true;
    }

    public function add_image($post_data) {
        $this->db->insert("tv_images_tbl", $post_data);
    }

    public function delete_images($tour_id) {
        $this->db->where('item_id', $tour_id);
        $this->db->where('item_type', 'tour');
        $this->db->delete('tv_images_tbl');
    }

    public function get_block_dates($tour_id) {
        $this->db->select("*")->from("tv_block_booking_dates_tbl")->where("item_id", $tour_id);
        $query = $this->db->get();
        return $query->result_array();
    }

}
