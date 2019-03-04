<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: PAGE MODEL
 * AUTHOR			: Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Page_mdl extends CI_Model {
		 
	public function __construct() {
        parent::__construct();
	}
	   
	public function get_pages($conditions = array(), $start, $limit) {
	   	$this->db->select('t1.*, t2.page_name')->from('tv_pages_tbl t1');
        $this->db->join('tv_pages_details_tbl t2', 't1.id = t2.page_id', 'left');
        $this->db->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
		
		if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('t2.page_name', $conditions['search_name']);
        }		
        
		$this->db->limit($limit, $start);
        $query = $this->db->get();
        return $query->result_array();	
	}
	
	public function get_total_pages($conditions = array()) {
                 
		$this->db->select('count(t1.id) as total_pages')
            ->from('tv_pages_tbl t1')
                ->join('tv_pages_details_tbl t2', 't1.id = t2.page_id', 'left')
                    ->where('t2.language_code', DEFAULT_ADMIN_PANEL_LANGUAGE);
		
		if (isset($conditions['search_name']) && !empty($conditions['search_name'])) {
            $this->db->like('t2.page_name', $conditions['search_name']);
        }

        $query = $this->db->get();
        return $query->row_array()['total_pages'];
    }
	
	public function get_page($page_id) {
		$query = $this->db->select('*')->from('tv_pages_tbl')->where('id', $page_id)->get();
        return $query->row_array();
    }
	
	public function get_page_details($page_id) { 
		$query = $this->db->select('*')->from('tv_pages_details_tbl')->where('page_id', $page_id)->get();
	    return	$query->result_array();
	}

    public function add_page($post_data) {
		
		$user = $this->session->userdata('user');
		
		$data = [
			'user_id' => $user['id'],
            'status' => $post_data['status'],            
            'page_slug' => $post_data['slug']          
        ];
		   
	    $this->db->insert("tv_pages_tbl", $data);
        $page_id = $this->db->insert_id();
        
        $data = array();
        
        foreach ($post_data['details'] as $language_code => $detail) {
            $data[] = [
                'page_id' => $page_id,
                'language_code' => $language_code,
                'page_name' => $detail['page_name'],
                'meta_title' => $detail['title'],
                'meta_description' => $detail['description'],
                'meta_keyword' => $detail['keyword'],
                'page_content' => $detail['page_content']
            ];
        }
        
        $this->db->insert_batch('tv_pages_details_tbl', $data); 
	}
	
	public function update_page($post_data, $page_id) {
		$user = $this->session->userdata('user');
		$data = [
			'user_id' => $user['id'],
            'status' => $post_data['status'],    
		    'page_slug' => $post_data['slug']
        ];
		  
       	$this->db->where('id',$page_id);	  
	    $this->db->update("tv_pages_tbl", $data);
		
	    foreach ($post_data['details'] as $language_code => $detail) {
	        $data = [
				'page_name' => $detail['page_name'],
				'meta_title' => $detail['title'],
				'meta_description' => $detail['description'],
				'meta_keyword' => $detail['meta_keyword'],
				'page_content' => $detail['page_content']
	        ];
	        
	        $this->db->where('page_id', $page_id);
	        $this->db->where('language_code', $language_code);
	        $this->db->update("tv_pages_details_tbl", $data);
	    }
	}
    
	public function delete_page($id) {	  
		$this->db->where('id', $id);
        $this->db->delete('tv_pages_tbl');

		return true;
	}
	
	public function get_all_languages() {
        $query = $this->db->select('*')->from('tv_language_tbl')->get();
        return $query->result_array();
    }
    
    public function change_page_status($page_id, $status) {
        $this->db->set('status', $status);
        $this->db->where('id', $page_id);
        $this->db->update('tv_pages_tbl');
    }
}
