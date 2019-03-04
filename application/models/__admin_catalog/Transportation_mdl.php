<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Transportation_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function get_transportations($conditions = array(), $start, $limit) {
        
        $this->db->select('t1.id, 
            t1.private_price_per_passenger, 
            t1.shared_price_per_passenger, 
            t2.company_legal_name as park_name,
            t3.name as from,
            t4.name as to')
            ->from('tv_transportation_tbl t1')
                ->join('tv_agent_tbl t2', 't2.id = t1.agent_id', 'left')
                    ->join('tv_location_tbl t3', 't1.from_location_id=t3.id','left')
                        ->join('tv_location_tbl t4', 't1.to_location_id=t4.id','left');
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->group_start();
            $this->db->like('t3.name', $conditions['search_title']);
            $this->db->or_like('t4.name', $conditions['search_title']);
            $this->db->group_end();
        }
        
        if (isset($conditions['search_park']) && !empty($conditions['search_park'])) {
            $this->db->like('t2.company_legal_name', $conditions['search_park']);
        }
        
        if (isset($conditions['search_private_price_per_passenger']) && !empty($conditions['search_private_price_per_passenger'])) {
            $this->db->where('t1.private_price_per_passenger', $conditions['search_private_price_per_passenger']);
        }
        
        if (isset($conditions['search_shared_price_per_passenger']) && !empty($conditions['search_shared_price_per_passenger'])) {
            $this->db->where('t1.shared_price_per_passenger', $conditions['search_shared_price_per_passenger']);
        }
        
        $this->db->order_by('t1.date_added', 'DESC');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        
        return $query->result_array();
    }
	
    public function get_total_transportations($conditions = array()) {
        
        $this->db->select('count(t1.id) as total_transportations')
            ->from('tv_transportation_tbl t1')
                ->join('tv_agent_tbl t2', 't2.id = t1.agent_id', 'left')
                    ->join('tv_location_tbl t3', 't1.from_location_id=t3.id','left')
                        ->join('tv_location_tbl t4', 't1.to_location_id=t4.id','left');
        
        if (isset($conditions['search_title']) && !empty($conditions['search_title'])) {
            $this->db->group_start();
            $this->db->like('t3.name', $conditions['search_title']);
            $this->db->or_like('t4.name', $conditions['search_title']);
            $this->db->group_end();
        }
        
        if (isset($conditions['search_park']) && !empty($conditions['search_park'])) {
            $this->db->like('t2.company_legal_name', $conditions['search_park']);
        }
        
        if (isset($conditions['search_private_price_per_passenger']) && !empty($conditions['search_private_price_per_passenger'])) {
            $this->db->where('t1.private_price_per_passenger', $conditions['search_private_price_per_passenger']);
        }
        
        if (isset($conditions['search_shared_price_per_passenger']) && !empty($conditions['search_shared_price_per_passenger'])) {
            $this->db->where('t1.shared_price_per_passenger', $conditions['search_shared_price_per_passenger']);
        }
        
        $query = $this->db->get();
        return $query->row_array()['total_transportations'];
    }
    
    public function add_transportation($post_data) {
        $user = $this->session->userdata('user');
        $date_added = c_for_d();
        $date_updated = c_for_d();
        
        $data = [
            'from_location_id' => $post_data['from_location_id'],
            'to_location_id' => $post_data['to_location_id'],
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'private_image' => $post_data['private_image'],
            'shared_image' => $post_data['shared_image'],
            'private_cost_per_passenger' => $post_data['private_cost_per_passenger'],
            'shared_cost_per_passenger' => $post_data['shared_cost_per_passenger'],
            'private_price_per_passenger' => $post_data['private_price_per_passenger'],
            'shared_price_per_passenger' => $post_data['shared_price_per_passenger'],
            'private_deal_price_per_passenger' => $post_data['private_deal_price_per_passenger'],
            'shared_deal_price_per_passenger' => $post_data['shared_deal_price_per_passenger'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
            'date_added' => $date_added,
            'date_updated' => $date_updated,
            'user_added' => $user['id'],
            'user_updated' => $user['id']
        ];
        $this->db->insert('tv_transportation_tbl', $data);
       
        $transportation_id = $this->db->insert_id();
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'transportation_id' => $transportation_id,
                'language_code' => $language_code,
                'shared_title' => $detail['shared_title'],
                'shared_dsc' => $detail['shared_dsc'],
                'private_title' => $detail['private_title'],
                'private_dsc' => $detail['private_dsc']
            ];
        }
        
        $this->db->insert_batch('tv_transportation_details_tbl', $data);
        
        if(isset($post_data['add_both_side']) && $post_data['add_both_side'] = 'add_both_side') {
            $data = [
                'from_location_id' => $post_data['to_location_id'],
                'to_location_id' => $post_data['from_location_id'],
                'country_id' => $post_data['country_id'],
                'city_id' => $post_data['city_id'],
                'agent_id' => $post_data['agent_id'],
                'private_image' => $post_data['private_image'],
                'shared_image' => $post_data['shared_image'],
                'private_cost_per_passenger' => $post_data['private_cost_per_passenger'],
                'shared_cost_per_passenger' => $post_data['shared_cost_per_passenger'],
                'private_price_per_passenger' => $post_data['private_price_per_passenger'],
                'shared_price_per_passenger' => $post_data['shared_price_per_passenger'],
                'private_deal_price_per_passenger' => $post_data['private_deal_price_per_passenger'],
                'shared_deal_price_per_passenger' => $post_data['shared_deal_price_per_passenger'],
                'status' => isset($post_data['status']) ? $post_data['status'] : 0,
                'date_added' => $date_added,
                'date_updated' => $date_updated,
                'user_added' => $user['id'],
                'user_updated' => $user['id']
            ];
            
            $this->db->insert('tv_transportation_tbl', $data);
            
            $transportation_id = $this->db->insert_id();
            
            $data = array();
            
            foreach ($post_data['details'] as $language_code => $detail) {
                $data[] = [
                    'transportation_id' => $transportation_id,
                    'language_code' => $language_code,
                    'shared_title' => $detail['shared_title'],
                    'shared_dsc' => $detail['shared_dsc'],
                    'private_title' => $detail['private_title'],
                    'private_dsc' => $detail['private_dsc']
                ];
            }
            
            $this->db->insert_batch('tv_transportation_details_tbl', $data);
        }
    }
    
    public function get_transportation($transportation_id) {
        $this->db->select('*')->from('tv_transportation_tbl')->where('id', $transportation_id);
        $query = $this->db->get();
        $result = $query->row_array();
        
        return $result;
    }
    
    public function get_transportation_details_by_transportation_id($transportation_id) {
        $this->db->where('transportation_id', $transportation_id);
        $query = $this->db->select('*')->from('tv_transportation_details_tbl')->get();
        $result = $query->result_array();
        
        return $result;
    }
    
    public function update_transportation($post_data, $transportation_id) {
        
        $user = $this->session->userdata('user');
        $date_updated = c_for_d();
        
        $data = [
            'from_location_id' => $post_data['from_location_id'],
            'to_location_id' => $post_data['to_location_id'],
            'country_id' => $post_data['country_id'],
            'city_id' => $post_data['city_id'],
            'agent_id' => $post_data['agent_id'],
            'private_cost_per_passenger' => $post_data['private_cost_per_passenger'],
            'shared_cost_per_passenger' => $post_data['shared_cost_per_passenger'],
            'private_price_per_passenger' => $post_data['private_price_per_passenger'],
            'shared_price_per_passenger' => $post_data['shared_price_per_passenger'],
            'private_deal_price_per_passenger' => $post_data['private_deal_price_per_passenger'],
            'shared_deal_price_per_passenger' => $post_data['shared_deal_price_per_passenger'],
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
            'date_updated' => $date_updated,
            'user_updated' => $user['id']
        ];
        
        if(isset($post_data['private_image'])) {
            $data['private_image'] = $post_data['private_image'];
            
        }
        
        if(isset($post_data['shared_image'])) {
            $data['shared_image'] = $post_data['shared_image'];
        }
        
        $this->db->where('id', $transportation_id);
        $this->db->update("tv_transportation_tbl", $data);
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data = [
                'shared_title' => $detail['shared_title'],
                'shared_dsc' => $detail['shared_dsc'],
                'private_title' => $detail['private_title'],
                'private_dsc' => $detail['private_dsc']
            ];
            
            $this->db->where('transportation_id', $transportation_id);
            $this->db->where('language_code', $language_code);
            $this->db->update('tv_transportation_details_tbl', $data);
        }
    }
    
    public function delete_transportation($transportation_id) {
        $this->db->where('id', $transportation_id);
        $this->db->delete('tv_transportation_tbl');
        
        return true;
    }
    
    public function get_block_dates($transportation_id) {
        $this->db->select("*")->from("tv_block_booking_dates_tbl")->where("item_id", $transportation_id);
        $query = $this->db->get();
        return $query->result_array();
    }
}
