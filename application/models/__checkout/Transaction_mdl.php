<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * APPLICATION 		: TRANSACTION MODEL
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Transaction_mdl extends CI_Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function init() {
        $data = array(
            'date_of_transaction' => lu_to_d(date('Y-m-d H:i:s')),
            'status' => 'init'
        );
        
        $this->db->insert("tv_transactions_tbl", $data);
        $transaction_id = $this->db->insert_id();
        
        /* CREATE TRANSACTION NO. HERE  */
        $transaction_no = 'TXN-' . date('Y') . '-' . str_pad($transaction_id, 20, "0", STR_PAD_LEFT);
        
        $this->db->where("id", $transaction_id);
        $this->db->update("tv_transactions_tbl", array("transaction_no" => $transaction_no));
        
        return $transaction_no;
    }
    
    public function pending($transaction_no) {
        $data = array(
            'status' => 'pending'
        );
        
        $this->db->where("transaction_no", $transaction_no);
        $this->db->update("tv_transactions_tbl", $data);
    }
    
    public function failed() {
        $data = array(
            'status' => 'failed'
        );
        
        $this->db->where("transaction_no", $transaction_no);
        $this->db->update("tv_transactions_tbl", $data);
    }
    
    public function complete() {
        $data = array(
            'status' => 'complete'
        );
        
        $this->db->where("transaction_no", $transaction_no);
        $this->db->update("tv_transactions_tbl", $data);
    }
    
    
}