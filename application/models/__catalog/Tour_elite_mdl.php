<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Tour Elite Model
 * AUTHOR			: VINAY KUMAR SHARMA,Kundan Kumar
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Tour_elite_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_tours($search_conditions = array(), $start, $limit) {
        $this->db->select("t1.id, t1.slug, t1.adult_price, t1.adult_deal_price, t1.adult_deal_price,t2.title, t2.dsc, t3.name as country_name,t3.seo_url as country_seo_url, t4.name as city_name,t4.seo_url as city_seo_url");
        $this->db->from("tv_tour_tbl t1");
        $this->db->join("tv_tour_details_tbl t2", "t1.id = t2.tour_id", "left");
        $this->db->join("tv_main_country_tbl t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl t4", "t4.id = t1.city_id");
		$this->db->where('t1.is_elite','1');
        $this->db->where('t2.language_code', $search_conditions['language_code']);
		
		if(isset($search_conditions['search_category_id']) && !empty($search_conditions['search_category_id'])) {
            $this->db->where('t1.tour_category_id', $search_conditions['search_category_id']);
        }
        
        if(isset($search_conditions['search_title']) && !empty($search_conditions['search_title'])) {
            $this->db->like('t2.title', $search_conditions['search_title']);
        }
		
		if(isset($search_conditions['search_title']) && !empty($search_conditions['search_title'])) {
            $this->db->like('t2.title', $search_conditions['search_title']);
        }
        
        if(isset($search_conditions['sort_title']) && !empty($search_conditions['sort_title'])) {
            if($search_conditions['sort_title']=='ASC'){
                $this->db->order_by('t2.title', 'ASC');
            }
            elseif($search_conditions['sort_title']=='DESC'){
                $this->db->order_by('t2.title', 'DESC');
            }
            elseif($search_conditions['sort_title']=='HIGH'){
                $this->db->order_by('t1.adult_deal_price', 'DESC');
            }
            elseif($search_conditions['sort_title']=='LOW'){
                $this->db->order_by('t1.adult_deal_price', 'ASC');
            }
            
        }
        
        if(isset($search_conditions['search_min_price']) && !empty($search_conditions['search_min_price'])) {
            $this->db->where('t1.adult_price >=', $search_conditions['search_min_price']);
        }
        
        if(isset($search_conditions['search_max_price']) && !empty($search_conditions['search_max_price'])) {
            $this->db->where('t1.adult_price <=', $search_conditions['search_max_price']);
        }
        
        if(isset($search_conditions['country_slug']) && !empty($search_conditions['country_slug'])) {
            $this->db->where('t3.seo_url', $search_conditions['country_slug']);
        }
        
        if(isset($search_conditions['city_slug']) && !empty($search_conditions['city_slug'])) {
            $this->db->where('t4.seo_url', $search_conditions['city_slug']);
        }
        
        $this->db->where('t1.status', '1');
        
        if (isset($start) && isset($limit)) {
            $this->db->limit($limit, $start);
        }
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_total_tours($search_conditions = array()) {
        
        $this->db->select("count(t1.id) as total");
        $this->db->from("tv_tour_tbl as  t1");
        $this->db->join("tv_tour_details_tbl t2", "t1.id = t2.tour_id", "left");
        $this->db->join("tv_main_country_tbl as t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl as t4", "t4.id = t1.city_id");
		$this->db->where('t1.is_elite','1');
        $this->db->where('t2.language_code', $search_conditions['language_code']);
		
		if(isset($search_conditions['search_category_id']) && !empty($search_conditions['search_category_id'])) {
            $this->db->where('t1.tour_category_id', $search_conditions['search_category_id']);
        }
        
        if(isset($search_conditions['search_title']) && !empty($search_conditions['search_title'])) {
            $this->db->like('t2.title', $search_conditions['search_title']);
        }
		
		if(isset($search_conditions['search_title']) && !empty($search_conditions['search_title'])) {
            $this->db->like('t2.title', $search_conditions['search_title']);
        }
        
        if(isset($search_conditions['sort_title']) && !empty($search_conditions['sort_title'])) {
            if($search_conditions['sort_title']=='ASC'){
                $this->db->order_by('t2.title', 'ASC');
            }
            elseif($search_conditions['sort_title']=='DESC'){
                $this->db->order_by('t2.title', 'DESC');
            }
            elseif($search_conditions['sort_title']=='HIGH'){
                $this->db->order_by('t1.adult_deal_price', 'DESC');
            }
            elseif($search_conditions['sort_title']=='LOW'){
                $this->db->order_by('t1.adult_deal_price', 'ASC');
            }
            
        }
        
        if(isset($search_conditions['search_min_price']) && !empty($search_conditions['search_min_price'])) {
            $this->db->where('t1.adult_price >=', $search_conditions['search_min_price']);
        }
        
        if(isset($search_conditions['search_max_price']) && !empty($search_conditions['search_max_price'])) {
            $this->db->where('t1.adult_price <=', $search_conditions['search_max_price']);
        }
        
        if(isset($search_conditions['country_slug']) && !empty($search_conditions['country_slug'])) {
            $this->db->where('t3.seo_url', $search_conditions['country_slug']);
        }
        
        if(isset($search_conditions['city_slug']) && !empty($search_conditions['city_slug'])) {
            $this->db->where('t4.seo_url', $search_conditions['city_slug']);
        }
        
        $this->db->where('t1.status', '1');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_tour_images_by_tour_ids($tour_ids_array) {
        $this->db->select("image, item_id");
        $this->db->from("tv_images_tbl");
        $this->db->where_in('item_id', $tour_ids_array);
        $query = $this->db->get();
		return $query->result_array();
    }
	
	# For Get tour details
	public function get_tour_detail($slug){
		$result= $this->db->select("t1.*,t2.*")
					->from("tv_tour_tbl as t1")
						->join("tv_tour_details_tbl as t2","t2.tour_id=t1.id","left")
							->where("t1.slug",$slug)
								->get()->row_array();
								
					
								
		return $result;
	}
	
	public function get_category_name($language_code) {
        $this->db->select("t1.*, t2.category_name")
            ->from("tv_categories_tbl t1")
                ->join("tv_categories_details_tbl t2", "t1.id=t2.tour_cat_id","left")
                    ->where('t2.language_code', $language_code)
                        //->where("type", 'tour')
							->where("t1.status", 1);
        $query = $this->db->get();
        return $query->result_array();
    }
	
    public function get_elite_banners(){
        $this->db->select('*')->from('tv_banner_tbl')->where('category','elite');
        $query = $this->db->get();
        return $query->result_array();
       
    }
}