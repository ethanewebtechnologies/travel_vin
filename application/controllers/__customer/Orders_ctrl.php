<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Order Controller
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTORS     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Orders_ctrl extends CI_Controller {
    /* private instance an array */

    private $_pdata = array();

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->has_userdata('customer')) {
            redirect(base_url(), 'referesh');
        }

        // ANY DEFAULT LOADING HERE
        $this->load->library(array('form_validation','__prjlib/Header_lib', '__prjlib/Footer_lib', '__prjlib/Template_lib'));
        $this->load->helper(array('form', 'dt',
            'Encryption'));
		
		$siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__customer/Orders', $siteLang);
		$this->lang->load('form_validation', $siteLang);
    }

    public function index() {
		$this->load->model('__customer/Orders_mdl');		
		//INVOICE
		$this->_pdata['text_order_history'] = $this->lang->line('text_order_history');
		$this->_pdata['text_invoice_date'] = $this->lang->line('text_invoice_date');
		$this->_pdata['text_invoice_number'] = $this->lang->line('text_invoice_number');
		$this->_pdata['text_download_invoice'] = $this->lang->line('text_download_invoice');
		$this->_pdata['text_download'] = $this->lang->line('text_download');
		$this->_pdata['text_no_bookings'] = $this->lang->line('text_no_bookings');
		 
		 $start = $this->input->get('per_page');
        
        if(!isset($start)) {
            $start = 0;
        }
		 $limit = 10;
		$this->_pdata['customer_invoices'] = $this->Orders_mdl->get_customer_invoices($start, $limit);
		
		$this->_pdata['total_orders'] = count($this->Orders_mdl->get_customer_invoices());
		
			$this->load->helper('paginator');
			
			
	$this->_pdata['pagination'] = generate_pagination_for_front($this, 'customer/orders', $this->_pdata['total_orders'], $limit);
	
        $this->template_lib->load_view($this, '__customer/Orders_view', $this->_pdata);
    }

   
}
