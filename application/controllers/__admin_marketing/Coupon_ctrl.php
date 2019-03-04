<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: COUPON CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : KUNDAN KUMAR, VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Coupon_ctrl extends CI_Controller {

    private $_pdata = array();

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized'
        ));

        $this->load->helper(array('form', 
            'date', 
            'dt',
            'encryption'
        ));

        $this->lang->load('__admin_marketing/Coupon', 'en');
        $this->lang->load('common', 'en');
    }

    public function index() {

        $search_conditions = array();

        $search_coupon_name = $this->input->get('search_coupon_name');
        
        if (isset($search_coupon_name)) {
            $search_conditions['search_coupon_name'] = trim($search_coupon_name);
            $this->_pdata['search_coupon_name'] = trim($search_coupon_name);
        } else {
            $search_conditions['search_coupon_name'] = null;
            $this->_pdata['search_coupon_name'] = null;
        }
        
        $search_coupon_code = $this->input->get('search_coupon_code');
        
        if (isset($search_coupon_code)) {
            $search_conditions['search_coupon_code'] = trim($search_coupon_code);
            $this->_pdata['search_coupon_code'] = trim($search_coupon_code);
        } else {
            $search_conditions['search_coupon_code'] = null;
            $this->_pdata['search_coupon_code'] = null;
        }
        
        $search_start_date = $this->input->get('search_start_date');
        
        if (isset($search_start_date)) {
            $search_conditions['search_start_date'] = trim($search_start_date);
            $this->_pdata['search_start_date'] = trim($search_start_date);
        } else {
            $search_conditions['search_start_date'] = null;
            $this->_pdata['search_start_date'] = null;
        }
        
        $search_end_date = $this->input->get('search_end_date');
        
        if (isset($search_end_date)) {
            $search_conditions['search_end_date'] = trim($search_end_date);
            $this->_pdata['search_end_date'] = trim($search_end_date);
        } else {
            $search_conditions['search_end_date'] = null;
            $this->_pdata['search_end_date'] = null;
        }

        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['coupons'] = array();

        $this->load->model('__admin_marketing/Coupon_mdl');

        $this->_pdata['coupons'] = $this->Coupon_mdl->get_coupons($search_conditions, $start, $limit);
        $this->_pdata['total_coupons'] = $this->Coupon_mdl->get_total_coupons($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/marketing/coupon', $this->_pdata['total_coupons'], $limit);
       
        $this->template_lib->load_view($this, '__admin_marketing/Coupon_list_view', $this->_pdata);
    }
    
    function check_unique_coupon() {
		$this->db->select('*')->from('tv_coupon_tbl')->where('coupon_code', $this->input->post('coupon_code'));
				
		$query = $this->db->get();
				
		if($query->num_rows() > 0) {
			return false;
		} else {
			return true;
		}
	}
	
	function check_unique_coupon_leave_current() {
		
		if($this->input->post('current_coupon_code') == $this->input->post('coupon_code')) {
			return true;
		} else {
			$this->db->select('*')->from('tv_coupon_tbl')->where('coupon_code', $this->input->post('coupon_code'));
			
			$query = $this->db->get();
				
			if($query->num_rows() > 0) {
				return false;
			} else {
				return true;
			}
		}
	}
	
    public function add() {
        $this->load->model('__admin_marketing/Coupon_mdl');
        
        if ($this->input->post()) {
            
            $this->form_validation->set_rules('coupon_name', 'Coupon Name', 'trim|required|min_length[3]|max_length[255]', array(
                'required' => 'Coupon Name required .',
                'min_length' => 'Coupon Name should have minimum 3 characters.',
                'max_length' => 'Coupon Name cannot more than 255 characters.',					 
            ));
			
			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required|min_length[3]|max_length[40]|callback_check_unique_coupon', array(
                'required' => 'Coupon Code is Required.',
                'min_length' => 'Coupon Code should be more than 3 characters.',
                'max_length' => 'Coupon Code not more than 40 characters.',
			    'check_unique_coupon' => 'Coupon Code already exist.'
            ));
			
            $this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required', array(
                'required' => 'Coupon Type must be selected'
            ));
			
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required', array(
                'required' => 'Coupon Type must be selected'
			));
			
			$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'trim|required|numeric', array(
				'required'=>'Please enter coupon value',
				'numeric'=>'coupon value only numbers',
			));
				
			$this->form_validation->set_rules('no_of_coupon', 'No Of Coupon', 'trim|required|numeric',array(
				'required' => 'Please enter No Of Coupon',
				'numeric' => 'No Of Coupon only numbers',
			));
			
			if ($this->form_validation->run() == FALSE) {
			    $this->session->set_flashdata('validation_error', TRUE);
			} else {
                $this->Coupon_mdl->add_coupon($this->input->post()); 
			    redirect('admin/marketing/coupon');  
			}
        }

        if($this->input->post('coupon_code')) {
            $this->_pdata['coupon_code'] = $this->input->post('coupon_code');
        } else {
            $this->_pdata['coupon_code'] = generate_random_code();
        }
            
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
        $this->template_lib->load_view($this, '__admin_marketing/Coupon_add_view', $this->_pdata);
    }

    public function edit() {

        $secure_token = $this->input->get('secure_token');
        $coupon_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_marketing/Coupon_mdl');
        
        if ($this->input->post()) {	
		
			$this->form_validation->set_rules('coupon_name', 'Coupon Name', 'trim|required|min_length[3]|max_length[255]', array(
			    'required' => 'Coupon Name required .',
			    'min_length' => 'Coupon Name should have minimum 3 characters.',
			    'max_length' => 'Coupon Name cannot more than 255 characters.',					 
			));
			
			$this->form_validation->set_rules('coupon_code', 'Coupon Code', 'trim|required|min_length[3]|max_length[40]|callback_check_unique_coupon_leave_current', array(
                'required' => 'Coupon Code is Required.',
                'min_length' => 'Coupon Code should be more than 3 characters.',
                'max_length' => 'Coupon Code not more than 40 characters.',
				'check_unique_coupon_leave_current' => 'Coupon Code already exist.'
            ));
			
			$this->form_validation->set_rules('coupon_type', 'Coupon Type', 'required', array(
                'required' => 'Coupon Type must be selected'
			));
			
			$this->form_validation->set_rules('coupon_value', 'Coupon Value', 'trim|required|numeric',array(
				'required' => 'Please enter coupon value',
				'numeric' => 'coupon value only numbers',
			));
				
			$this->form_validation->set_rules('no_of_coupon', 'No Of Coupon', 'trim|required|numeric',array(
				'required' => 'No Of Coupon',
				'numeric' => 'No Of Coupon only numbers',
			));
				
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
			} else {
                 $this->Coupon_mdl->update_coupon($this->input->post(), $coupon_id);
				 redirect('admin/marketing/coupon');
			}
        }

        $this->_pdata['coupon'] = $this->Coupon_mdl->get_coupon($coupon_id);
        $this->template_lib->load_view($this, '__admin_marketing/Coupon_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $coupon_id = $this->security_lib->decrypt($secure_token);
        $this->load->model('__admin_marketing/Coupon_mdl');
        $this->Coupon_mdl->delete_coupon($coupon_id);

        redirect('admin/marketing/coupon');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $coupon_id = $this->security_lib->decrypt($secure_token);
        
        if($coupon_id) {
            $this->load->model('__admin_marketing/Coupon_mdl');
            $this->Coupon_mdl->change_coupon_status($coupon_id, $this->input->get('change_status'));
            
            redirect('admin/marketing/coupon');
        }
    }
}	
