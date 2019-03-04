<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Home Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION		: VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Home_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_home_banners() {
        $this->db->select('*')->from('tv_banner_tbl')->where('category', 'home');
        
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_country_and_availabilities() {
        $this->db->select('id, name, date_of_arrival')
            ->from('tv_main_country_tbl')
                ->where('date_of_arrival IS NOT NULL')
                    ->where('status', 1)
						->where('date_of_arrival >=', lu_to_d(date('Y-m-d H:i:s')));
        $query = $this->db->get();
        return $query->result_array();
    }
    
     public function popular_tours($language_code) {
		$popular_ids = $this->popular_tours_id();
		$count_pop = count($popular_ids);
		if($count_pop < 6){
			$rem_pop = 6 - $count_pop;			
			$rem_pop_tour = $this->db->select('id')->from('tv_tour_tbl')->where_not_in('id',$popular_ids)->limit($rem_pop)->get()->result_array();
		foreach($rem_pop_tour as $idx){
			$id[] = (string)$idx['id'];
		}
		$popular_ids = array_merge($popular_ids,$id);
		}
		//pr($popular_ids);
        $this->db->select("t1.id,t1.country_id,t1.city_id,t1.slug, t2.title, t2.dsc, t3.image, t4.seo_url as country_slug, t5.seo_url as city_slug")
            ->from("tv_tour_tbl t1")
                ->join("tv_tour_details_tbl t2", "t1.id = t2.tour_id", "left")
					->join("tv_images_tbl t3", "t1.id = t3.item_id", "left")
					->join("tv_main_country_tbl t4", "t1.country_id = t4.id")
					->join("tv_main_city_tbl t5", "t1.city_id = t5.id");
						$this->db->where("t2.language_code", $language_code);
						$this->db->where_in("t1.id", $popular_ids);
						$this->db->group_by('t3.item_id');
        $query = $this->db->get();
		//echo $this->db->last_query();exit;
		//pr($query->result_array());
        return $query->result_array();
    } 

    public function popular_tours_id() {
        $this->db->select("t1.tour_id,COUNT(t1.tour_id) as total")
                ->from("tv_tour_bookings_tbl t1")
					->group_by('t1.tour_id');
					$this->db->order_by('total', 'desc');
					$this->db->limit(6);
        $query = $this->db->get();
		//pr($query->result_array());
		foreach($query->result_array() as $idx){
			$id[] = (string)$idx['tour_id'];
		}
        return $id;
    }
    
    public function special_tours($language_code) {
        $this->db->select("t1.adult_price, t2.title, t3.image")
            ->from("tv_tour_tbl t1")
                ->join("tv_tour_details_tbl t2", "t1.id = t2.tour_id", "left")
					->join("tv_images_tbl t3", "t1.id = t3.item_id", "left")
						->where("t2.language_code", $language_code);
						$this->db->where("t1.is_elite",1);
							$this->db->order_by('t1.id','dsc')
								->group_by('t3.item_id')
									->limit(3);
        $query = $this->db->get();
		//echo $this->db->last_query();exit;
        return $query->result_array();
    }
}