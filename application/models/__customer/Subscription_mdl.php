<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: Subscription Model
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTION		: BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Subscription_mdl extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
	
	public function subscribe_email($post_data){
		$qry = $this->db->select('*')->from('tv_subscriber_tbl')->where('subscriber_email',$post_data['subscriber_email'])->get();
		if($qry->num_rows()>0){
			$this->db->set('status','Subscribed');
			$this->db->set('subscription_type',$post_data['subscription_type']);
			$this->db->where('subscriber_email',$post_data['subscriber_email']);
			if($this->db->update('tv_subscriber_tbl')){
				return true;
			}
			else{
				return false;
			}
		}
		else{
			$this->db->set('status','Subscribed');
			$this->db->set('subscription_type',$post_data['subscription_type']);
			$this->db->set('subscriber_email',$post_data['subscriber_email']);
			if($this->db->insert('tv_subscriber_tbl')){
				return true;
			}
			else{
				return false;
			}
		}
	}
    
	public function verify_subscriber($post_data){
		$qry = $this->db->select('*')->from('tv_subscriber_tbl')->where('subscriber_email',$post_data['subscriber_email'])->where('subscription_type',$post_data['subscription_type'])->where('status','Subscribed')->get();
		return $qry->num_rows();
	}
}