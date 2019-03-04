<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Golf Bookings Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

Class Golf_bookings_mdl extends CI_Model {
	
    public function __construct() {
        parent::__construct();
        $this->load->helper(array('dt'));
    }
	
	public function get_golf($golf_id, $language_code) {
		$this->db->select('t1.*,t2.title, t3.image,t4.name as country_name,t5.name as city_name')
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
        /* $this->db->where('id', $golf_id);
        $query1 = $this->db->select('*')->from('tv_golf_tbl')->get();
        $result = $query1->row_array();

        $this->db->where('item_id', $golf_id);
        $query2 = $this->db->select('image')->from('tv_images_tbl')->get();
        $result['images'] = $query2->result_array();

        return $result; */
    }
	
	public function add_data_into_golf_booking_tbl($postdata){
		$this->db->insert("tv_golf_booking_tbl", $postdata);
		$insert_id = $this->db->insert_id();
		return $insert_id;
	}
}