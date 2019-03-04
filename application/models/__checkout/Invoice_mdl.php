<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Invoice Model
 * AUTHOR			: BIJENDAR
 * CONTRIBUTORS     : BIJENDAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Invoice_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function add_invoice_details($post_data) {
        $this->db->insert('tv_booking_invoice_tbl', $post_data);
		$insert_id = $this->db->insert_id();
		return $insert_id;
    }
}