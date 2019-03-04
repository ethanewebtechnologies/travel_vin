<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Tour Category Model
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Tour_category_mdl extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function get_tour_categories($conditions = array(), $start, $limit) {

        $this->db->select('t1.*, t2.category_name')
            ->from('tv_categories_tbl t1')
                ->join('tv_categories_details_tbl t2', 't2.tour_cat_id = t1.id', 'left')
                    ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE)
                        ->where('t1.type', 'tour');
						

        if (isset($conditions['search_category_name']) && !empty($conditions['search_category_name'])) {
            $this->db->like('t2.category_name', $conditions['search_category_name']);
        }
        
        $this->db->order_by('t2.category_name', 'ASC');

        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }

        $query = $this->db->get();
        
        return $query->result_array();
    }

    public function get_total_tour_categories($conditions = array()) {
	   	
		$this->db->select('count(t1.id) as total')
            ->from('tv_categories_tbl t1')
                ->join('tv_categories_details_tbl t2', 't2.tour_cat_id = t1.id', 'left')
                    ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE)
                        ->where('t1.type', 'tour');
						

        if (isset($conditions['search_category_name']) && !empty($conditions['search_category_name'])) {
            $this->db->like('t2.category_name', $conditions['search_category_name']);
        }	
		
		$query = $this->db->get();
	    
		return $query->row_array()['total'];
	}

    public function get_tour_category($tour_cat_id) {
        $this->db->select('*')
            ->from('tv_categories_tbl')
                ->where('id', $tour_cat_id)
                    ->where('type', 'tour');
        $query = $this->db->get();
        $result = $query->row_array();
        
        return $result;
    }

    public function get_tour_category_details_by_tour_cat_id($tour_category_id) {
        $this->db->select('*')->from('tv_categories_details_tbl')->where('tour_cat_id', $tour_category_id);
        $query = $this->db->get();
        return $query->result_array();
    }

    public function add_tour_category($post_data) {
        $user = $this->session->userdata('user');
        
        $data = [
            'type' => 'tour',
            'date_added' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,
        ];

        $this->db->insert("tv_categories_tbl", $data);

        $tour_cat_id = $this->db->insert_id();

        $data = array();

        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'tour_cat_id' => $tour_cat_id,
                'language_code' => $language_code,
                'category_name' => $detail['category_name'],
            ];
        }

        $this->db->insert_batch('tv_categories_details_tbl', $data);
		return $tour_cat_id;
    }

    public function update_tour_category($post_data, $tour_cat_id) {
        $user = $this->session->userdata('user');

        $data = array();

        $data = [
            'type' => 'tour',
            'date_updated' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => isset($post_data['status']) ? $post_data['status'] : 0,

        ];

        $this->db->where('id', $tour_cat_id);
        $this->db->update("tv_categories_tbl", $data);

        $data = array();

        foreach ($post_data['details'] as $language_code => $detail) {
            $data = [
                'tour_cat_id' => $tour_cat_id,
                'language_code' => $language_code,
                'category_name' => $detail['category_name'],	
            ];

            $this->db->where('tour_cat_id', $tour_cat_id);
            $this->db->where('language_code', $language_code);
            $this->db->update('tv_categories_details_tbl', $data);
        }
    }

    public function delete_tour_category($tour_cat_id) {
        $this->db->where('id', $tour_cat_id);
        $this->db->delete('tv_categories_tbl');

        return true;
    }
}
