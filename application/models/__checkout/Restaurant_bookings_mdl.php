<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Bookings Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

Class Restaurant_bookings_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
    }
	
	public function get_restaurant($restaurant_id, $language_code) {
		$this->db->select('t1.*,t2.title, t3.image,t4.name as country_name,t5.name as city_name')
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
        /* $this->db->select('*')->from('tv_restaurant_tbl')->where('id', $restaurant_id);
        $query = $this->db->get();
        $result = $query->row_array();
        
        return $result; */
    }
	
	public function add_data_into_restaurant_booking_tbl($postdata){
		$this->db->insert("tv_restaurant_booking_tbl", $postdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}