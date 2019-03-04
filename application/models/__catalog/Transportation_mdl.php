<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportations Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS	    : VINAY KUMAR SHARMA, NEERAJ, BIJENDAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Transportation_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_transportations($search_conditions = array(), $start, $limit) {
        $this->db->select("t1.id, t1.private_price_per_passenger, t1.private_deal_price_per_passenger, t1.shared_price_per_passenger, t1.shared_deal_price_per_passenger,t2.private_title, t2.shared_title, t2.private_dsc, t2.shared_dsc, t3.name as country_name,t3.seo_url as country_seo_url, t4.name as city_name,t4.seo_url as city_seo_url");
        $this->db->from("tv_transportation_tbl t1");
        $this->db->join("tv_transportation_details_tbl t2", "t1.id = t2.transportation_id", "left");
        $this->db->join("tv_main_country_tbl t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl t4", "t4.id = t1.city_id");
        $this->db->where('t2.language_code', $search_conditions['language_code']);
        
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
    
    public function get_total_transportations($search_conditions = array()) {
        
        $this->db->select("count(t1.id) as total");
        $this->db->from("tv_transportation_tbl as  t1");
        $this->db->join("tv_transportation_details_tbl t2", "t1.id = t2.transportation_id", "left");
        $this->db->join("tv_main_country_tbl as t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl as t4", "t4.id = t1.city_id");
        $this->db->where('t2.language_code', $search_conditions['language_code']);
        
        if(isset($search_conditions['country_slug']) && !empty($search_conditions['country_slug'])) {
            $this->db->where('t3.seo_url', $search_conditions['country_slug']);
        }
        
        if(isset($search_conditions['city_slug']) && !empty($search_conditions['city_slug'])) {
            $this->db->where('t4.seo_url', $search_conditions['city_slug']);
        }
        
        $this->db->where('t1.status', '1');
        
        $query = $this->db->get();
        return $query->row_array()['total'];
    }
    
      
    // For Get transportation details
    public function get_transportation_detail($search_conditions = array()) {
        return $this->db->select("t1.id as transportation_id, t1.*, t2.*")
        ->from("tv_transportation_tbl as t1")
        ->join("tv_transportation_details_tbl as t2", "t2.transportation_id = t1.id", "left")
        ->where("t1.slug", $search_conditions['transportation_slug'])
        ->where("t2.language_code", $search_conditions['language_code'])
        ->get()->row_array();
    }
	
	
	public function get_transportation_by_air_2_htl($airport_id,$hotel_id) {
		$condition= array("from_location_id"=>$airport_id,"to_location_id"=>$hotel_id);
        $this->db->select('*')->from('tv_transportation_tbl')->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
	
	public function get_transportation_by_htl_2_air($airport_id,$hotel_id) {
		$condition=array("to_location_id"=>$airport_id,"from_location_id"=>$hotel_id);
        $this->db->select('*')->from('tv_transportation_tbl')->where($condition);
        $query = $this->db->get();
        $result = $query->row_array();
        return $result;
    }
    
    public function get_block_dates($transportation_id) {
        $this->db->select("*")->from("tv_block_booking_dates_tbl")->where("item_type", 'transport')->where("item_id", $transportation_id);
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function get_hotels($county,$city) {
		$this->db->select("t1.*");
		$this->db->from("tv_location_tbl as t1");
		$this->db->join("tv_main_country_tbl as t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl as t4", "t4.id = t1.city_id");
		if(isset($county) && !empty($county)) {
            $this->db->where('t3.seo_url',$county);
        }
        if(isset($city) && !empty($city)) {
            $this->db->where('t4.seo_url',$city);
        }	
		 $this->db->where('t1.type',"2");
		return  $this->db->get()->result_array();
		
		
        /* $this->db->select("*")->from("tv_location_tbl")->where('type', 2);
        $query = $this->db->get();
        return $query->result_array(); */
    }
    
  
	public function get_airports($county,$city){
        $this->db->select("t1.*");
		$this->db->from("tv_location_tbl as t1");
		$this->db->join("tv_main_country_tbl as t3", "t3.id = t1.country_id");
        $this->db->join("tv_main_city_tbl as t4", "t4.id = t1.city_id");
		if(isset($county) && !empty($county)) {
            $this->db->where('t3.seo_url',$county);
        }
        if(isset($city) && !empty($city)) {
            $this->db->where('t4.seo_url',$city);
        }	
		 $this->db->where('t1.type',"1");
		return  $this->db->get()->result_array();
    }
		
		
       /*  $this->db->select("*")->from("tv_location_tbl")->where('type', 1);
        $query = $this->db->get();
		pr($query->result_array());
        return $query->result_array(); */
    
	
	# For Search 
	public function search_transportations($data,$language_code){
		if($data['transport_type']=="round_trip"){
			$result = array();
			$sum_shared_price = array();
			$sum_private_price = array();
			
			$condition= array("t1.from_location_id"=>$data['airport_id'],"t1.to_location_id"=>$data['hotel_id']);
			$condition2=array("t1.to_location_id"=>$data['airport_id'],"t1.from_location_id"=>$data['hotel_id']);
			
			$this->db->select("t1.*,t2.language_code,t2.shared_title,t2.shared_dsc,t2.private_title,t2.private_dsc")
				->from("tv_transportation_tbl as t1")
					->join("tv_transportation_details_tbl as t2","t1.id=t2.transportation_id")
					->where($condition)
						->where('t2.language_code',$language_code);;
			$query1 = $this->db->get();
			$row1 = $query1->row_array();
			
			$this->db->select("t1.*,t2.language_code,t2.shared_title,t2.shared_dsc,t2.private_title,t2.private_dsc")
				->from("tv_transportation_tbl as t1")
					->join("tv_transportation_details_tbl as t2","t1.id=t2.transportation_id")
					->where($condition2)
						->where('t2.language_code',$language_code);
			$query2 = $this->db->get();
			$row2 = $query2->row_array();
			
			
			if(!empty($row1) && !empty($row2)){
				$sum_shared_price[] = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
				
				$sum_private_price[] = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
				
				$sum_shared_price[] = $row2['shared_deal_price_per_passenger'] > '0' ? $row2['shared_deal_price_per_passenger'] : $row2['shared_price_per_passenger'];
				
				$sum_private_price[] = $adult_price = $row2['private_deal_price_per_passenger'] > '0' ? $row2['private_deal_price_per_passenger'] : $row2['private_price_per_passenger'];
				
				$result['id'] = $row1['id'];
				$result['agent_id'] = $row1['agent_id'];
				$result['country_id'] = $row1['country_id'];
				$result['city_id'] = $row1['city_id'];
				$result['from_location_id'] = $row1['from_location_id'];
				$result['to_location_id'] = $row1['to_location_id'];
				$result['private_image'] = $row1['private_image'];
				$result['shared_image'] = $row1['shared_image'];
				$result['private_cost_per_passenger'] = array_sum($sum_private_price);
				$result['shared_cost_per_passenger'] = array_sum($sum_shared_price);
				$result['shared_title'] = $row1['shared_title'];
				$result['shared_dsc'] = $row1['shared_dsc'];
				$result['private_title'] = $row1['private_title'];
				$result['private_dsc'] = $row1['private_dsc'];
			}
			return $result;
		}
		else if($data['transport_type']=="air_to_htl_trip"){
			$result = array();
			$condition= array("t1.from_location_id"=>$data['airport_id'],"t1.to_location_id"=>$data['hotel_id']);
			$this->db->select("t1.*,t2.language_code,t2.shared_title,t2.shared_dsc,t2.private_title,t2.private_dsc")
				->from("tv_transportation_tbl as t1")
					->join("tv_transportation_details_tbl as t2","t1.id=t2.transportation_id")
					->where($condition)
						->where("t2.language_code",$language_code);
			$query = $this->db->get();
			$row1 = $query->row_array();
			
			if(!empty($row1)){				
				$result['id'] = $row1['id'];
				$result['agent_id'] = $row1['agent_id'];
				$result['country_id'] = $row1['country_id'];
				$result['city_id'] = $row1['city_id'];
				$result['from_location_id'] = $row1['from_location_id'];
				$result['to_location_id'] = $row1['to_location_id'];
				$result['private_image'] = $row1['private_image'];
				$result['shared_image'] = $row1['shared_image'];
				$result['private_cost_per_passenger'] = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
				$result['shared_cost_per_passenger'] = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
				$result['shared_title'] = $row1['shared_title'];
				$result['shared_dsc'] = $row1['shared_dsc'];
				$result['private_title'] = $row1['private_title'];
				$result['private_dsc'] = $row1['private_dsc'];
			}
			
			return $result;	
		}
		else if($data['transport_type']=="htl_to_air_trip"){
			$result = array();
			$condition= array("t1.to_location_id"=>$data['airport_id'],"t1.from_location_id"=>$data['hotel_id']);
			$this->db->select("t1.*,t2.language_code,t2.shared_title,t2.shared_dsc,t2.private_title,t2.private_dsc")
				->from("tv_transportation_tbl as t1")
					->join("tv_transportation_details_tbl as t2","t1.id=t2.transportation_id")
						->where($condition)
							->where('t2.language_code',$language_code);
			$query = $this->db->get();
			$row1 = $query->row_array();
			
			if(!empty($row1)){				
				$result['id'] = $row1['id'];
				$result['agent_id'] = $row1['agent_id'];
				$result['country_id'] = $row1['country_id'];
				$result['city_id'] = $row1['city_id'];
				$result['from_location_id'] = $row1['from_location_id'];
				$result['to_location_id'] = $row1['to_location_id'];
				$result['private_image'] = $row1['private_image'];
				$result['shared_image'] = $row1['shared_image'];
				$result['private_cost_per_passenger'] = $row1['private_deal_price_per_passenger'] > '0' ? $row1['private_deal_price_per_passenger'] : $row1['private_price_per_passenger'];
				$result['shared_cost_per_passenger'] = $row1['shared_deal_price_per_passenger'] > '0' ? $row1['shared_deal_price_per_passenger'] : $row1['shared_price_per_passenger'];
				$result['shared_title'] = $row1['shared_title'];
				$result['shared_dsc'] = $row1['shared_dsc'];
				$result['private_title'] = $row1['private_title'];
				$result['private_dsc'] = $row1['private_dsc'];
			}
			
			return $result;	
		}
		
	}
	
	public function get_transportation_banners(){
	    
	   $this->db->select('*')->from('tv_banner_tbl')->where('category','transportation');
	  $query = $this->db->get();
	  
	  return $query->result_array();
	    
	}
}