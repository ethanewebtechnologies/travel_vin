<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: General Model
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class General_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    
    public function get_settings() {
        $this->db->select("*")->from('tv_settings_tbl');
        $query = $this->db->get();
        return $query->result_array();
    }
    
    public function update_settings($configurations) {
        foreach ($configurations as $category => $category_data) {
            $this->db->where('category', $category);
            $this->db->delete('tv_settings_tbl');
            
            foreach ($category_data as $key => $value) {
                $data = array(
                    'category' => $category,
                    'key' => $key,
                    'value' => json_encode($value)
                );
                
                $this->db->insert('tv_settings_tbl', $data);
            }
        }
    }
}