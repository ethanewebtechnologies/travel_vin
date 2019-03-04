<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Cart Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Cart_mdl extends CI_Model {
	private $_table = DB_PREFIX . 'cart' . DB_SUFFIX;
    
    public function __construct() {
        parent::__construct();
    }
	
	public function get_airport($airport_id){
		$this->db->select('')->from('tv_location_tbl')->where(array('type'=>1,'id'=>$airport_id));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_hotel($hotel_id){
		$this->db->select('')->from('tv_location_tbl')->where(array('type'=>2,'id'=>$hotel_id));
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function add_data_to_cart($cart_data) {
		$if_token = $this->get_cart_data_by_cart_token($cart_data['_cart_token__']);
		
		if(count($if_token) > 0) {
			$this->db->where('_cart_token__', $cart_data['_cart_token__']);
			$this->db->update($this->_table, $cart_data);
		} else {
			$this->db->insert($this->_table, $cart_data);
		}
		
		return true;
	}

	public function get_cart_data_by_cart_token($_cartToken) {
		$this->db->select('id, _cart_token__, _cart_data__, _coupon_code__, date_added, date_modified')->from($this->_table)->where('_cart_token__', $_cartToken);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	//get tour details by tour id
	public function get_tour_details_by_tour_id($tour_id, $language_code) {
        $this->db->select('t1.adult_price,t1.adult_deal_price, t1.child_price, t1.child_deal_price, t1.slug, t1.id, t2.title, t3.image,t4.name as country_name,t5.name as city_name')
            ->from('tv_tour_tbl t1')
                ->join('tv_tour_details_tbl t2', 't2.tour_id = t1.id','left')
                    ->join('tv_images_tbl t3', 't3.item_id = t1.id','left')
						->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
							->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
								->where('t1.id', $tour_id)
									->where('t3.item_type', 'tour')
										->where('t3.item_id', $tour_id)
											->where('t2.language_code', $language_code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	
	//get shared transportation details by trip id
	public function get_shared_transportation_details_by_trip_id($tripid, $language_code){
		 $this->db->select('t1.shared_price_per_passenger,t1.shared_deal_price_per_passenger,t1.shared_image as image,t2.shared_title as title,t4.name as country_name,t5.name as city_name')
            ->from('tv_transportation_tbl t1')
                ->join('tv_transportation_details_tbl t2', 't2.transportation_id = t1.id','left')
					->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
						->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
							->where('t1.id',$tripid)
								->where('t2.language_code', $language_code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	//get private transportation details by trip id
	public function get_private_transportation_details_by_trip_id($tripid, $language_code){
		 $this->db->select('t1.private_price_per_passenger,t1.private_deal_price_per_passenger,t1.private_image as image, t2.private_title as title,t4.name as country_name,t5.name as city_name')
            ->from('tv_transportation_tbl t1')
                ->join('tv_transportation_details_tbl t2', 't2.transportation_id = t1.id','left')
					->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
						->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
							->where('t1.id',$tripid)
								->where('t2.language_code', $language_code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	//get golf details by golf id
	public function get_golf_details_by_golf_id($golf_id, $language_code) {
	    $this->db->select('t1.price as adult_deal_price,t2.title, t3.image,t4.name as country_name,t5.name as city_name')
	       ->from('tv_golf_tbl t1')
	           ->join('tv_golf_details_tbl t2', 't2.golf_id = t1.id','left')
					->join('tv_images_tbl t3', 't3.item_id = t1.id','left')
						->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
							->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
							   ->where('t1.id', $golf_id)
								   ->where('t3.item_type', 'golf')
										->where('t3.item_id', $golf_id)
											->where('t2.language_code', $language_code);
	    $query = $this->db->get();
	    return $query->row_array();
	}
	
	//get restaurant details by restaurant id
	public function get_restaurant_details_by_restaurant_id($restaurant_id, $language_code) {
	    $this->db->select('t1.price as adult_deal_price,t2.title, t3.image,t4.name as country_name,t5.name as city_name')
	       ->from('tv_restaurant_tbl t1')
	           ->join('tv_restaurant_details_tbl t2', 't2.restaurant_id = t1.id','left')
					->join('tv_images_tbl t3', 't3.item_id = t1.id','left')
						->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
							->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
								->where('t1.id', $restaurant_id)
									->where('t3.item_type', 'restaurant')
										->where('t3.item_id', $restaurant_id)
											->where('t2.language_code', $language_code);
	    $query = $this->db->get();
	    return $query->row_array();
	}
	
	//get club & bar details by club_and_bar id
	public function get_club_and_bar_details_by_club_and_bar_id($club_and_bar, $language_code) {
	    $this->db->select('t1.price as adult_deal_price,t2.title, t3.image,t4.name as country_name,t5.name as city_name')
	       ->from('tv_club_and_bar_tbl t1')
	           ->join('tv_club_and_bar_details_tbl t2', 't2.club_and_bar_id = t1.id','left')
					->join('tv_images_tbl t3', 't3.item_id = t1.id','left')
						->join('tv_main_country_tbl t4', 't4.id = t1.country_id','left')
							->join('tv_main_city_tbl t5', 't5.id = t1.city_id','left')
								->where('t1.id', $club_and_bar)
									->where('t3.item_type', 'club_and_bar')
										->where('t3.item_id', $club_and_bar)
											->where('t2.language_code', $language_code);
	    $query = $this->db->get();
	    return $query->row_array();
	}
	
	// transportation round trip price calculation
	public function get_round_trip_transportation_price($tripid, $hotel_id, $airport_id, $language_code){
		$this->db->select('t1.shared_price_per_passenger,t1.shared_deal_price_per_passenger')
			->from('tv_transportation_tbl t1')
				->join('tv_transportation_details_tbl t2', 't2.transportation_id = t1.id','left')
					->where('t1.from_location_id', $airport_id)
						->where('t1.to_location_id', $hotel_id)
							->where('t2.language_code', $language_code);
		$query = $this->db->get();
	    return $query->row_array();
	}
	
	// transportation round trip price calculation
	public function get_one_way_transportation_price($tripid, $hotel_id, $airport_id, $language_code){
		$this->db->select('t1.shared_price_per_passenger,t1.shared_deal_price_per_passenger')
			->from('tv_transportation_tbl t1')
				->join('tv_transportation_details_tbl t2', 't2.transportation_id = t1.id','left')
					->where('t1.from_location_id', $airport_id)
						->where('t1.to_location_id', $hotel_id)
							->where('t2.language_code', $language_code);
		$query = $this->db->get();
	    return $query->row_array();
	}
	
	
	
	public function delete_data_from_cart($_cartToken) {
		$this->db->where('_cart_token__', $_cartToken);
		$this->db->delete($this->_table);
		return true;
	}
	
	/* public function checkout_mail_to_customer($checkout_details){
		pr($this->input->post());
		$this->load->library('email');

		/* $this->email->from('your@example.com', 'Your Name');
		$this->email->to('someone@example.com');
		$this->email->cc('another@another-example.com');
		$this->email->bcc('them@their-example.com');

		$this->email->subject('Email Test');
		$this->email->message('Testing the email class.');

		$this->email->send(); 
		
	} */
	public function get_country_and_city_by_country_id($country_id) {
        $this->db->select('t1.name as country_name, t2.name as city_name')
            ->from('tv_main_country_tbl t1')
                ->join('tv_main_city_tbl t2', 't2.country_id = t1.id')
                    ->where('t1.id',$country_id);       
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function get_coupon_details_by_coupon_code($_coupon_code) {
		$this->db->select('*')->from('tv_coupon_tbl')->where('coupon_code', $_coupon_code);
		$query = $this->db->get();
		return $query->row_array();
	}
	
	public function check_coupon_exists($_coupon_code){
		$_cartToken = get_cookie('_cart_token');
		$this->db->select('*')->from($this->_table)->where('_cart_token__', $_cartToken)->where('_coupon_code__', $_coupon_code);
		$query = $this->db->get();
		return $query->num_rows();
	}
	
	public function add_coupon_to_card( $post_data ){
		$this->db->set('_coupon_code__',$post_data['_coupon_code__']);
		$this->db->set('date_modified',$post_data['date_modified']);
		$this->db->where('_cart_token__',$post_data['_cart_token__']);
		if($this->db->update($this->_table)){
			$this->db->where('coupon_code',$post_data['_coupon_code__']);
			$this->db->set('no_of_coupon', 'no_of_coupon-1', false);
			$this->db->update('tv_coupon_tbl');
			return true;
		}
		return false;
	}
	
	
	
	
}