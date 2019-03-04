<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Customer_type_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib'
        ));
        
        $this->load->helper(array(
            'form',
            'dt'
        ));
        
        $this->lang->load('__admin_user/User', DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_type_name = $this->input->get('search_type_name');
        
        if (isset($search_type_name)) {
            $search_conditions['search_type_name'] = $search_type_name;
            $this->_pdata['search_type_name'] = $search_type_name;
        } else {
            $search_conditions['search_type_name'] = null;
            $this->_pdata['search_type_name'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->_pdata['customer_types'] = array();
        
        $this->load->model('__admin_customer/Customer_type_mdl');
        $this->_pdata['customer_types'] = $this->Customer_type_mdl->get_customer_types($search_conditions, $start, $limit);
        
        $this->_pdata['total_customer_types'] = $this->Customer_type_mdl->get_total_customer_types($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/customer/customer-type', $this->_pdata['total_customer_types'], $limit);
        
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_pages'] = $this->lang->line('text_pages');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add_page'] = $this->lang->line('text_add_page');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_type_list_view', $this->_pdata);
    }
    
    function check_unique_customer_type_leave_current() {
        if($this->input->post('current_type_name') == $this->input->post('type_name')) {
            return true; // WHEN EVER YOU WANT TO ALLOW SUCH CONDITION MARK TRUE
        } else {
            $this->db->select('*')->from('tv_customer_type_tbl')->where('type_name', $this->input->post('type_name'));
            
            $query = $this->db->get();
            
            if($query->num_rows() > 0) {
                return false; // NOT ALLOWED
            } else {
                return true; // ALLOWED
            }
        }
    }
    
    public function add() {
        $this->load->model('__admin_customer/Customer_type_mdl');
        
        if ($this->input->post()) {
            $this->form_validation->set_rules('type_name', 'Type Name', 'trim|required|min_length[3]|max_length[80]',
                array(
                    'required' => 'Type Name required for English atleast.',
                    'min_length' => 'Type Name should have minimum 3 characters.',
                    'max_length' => 'Type Name cannot more than 255 characters.'
                ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Customer_type_mdl->add_customer_type($this->input->post());
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/customer/Customer-type');
            }
        }
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_type_add_view', $this->_pdata);
    }
    
    public function edit() {
        
        $secure_token = $this->input->get('secure_token');
        $customer_type_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_customer/Customer_type_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
        
        if ($this->input->post()) {
            $data = [
                'type_name' => $this->input->post('type_name'),
            ];
            
            if($this->input->post('status')) {
                $data['status'] = $this->input->post('status');
            }
            
            $this->form_validation->set_rules('type_name', 'Type Name', 'trim|required|min_length[3]|max_length[80]|callback_check_unique_customer_type_leave_current',
                array(
                    'required' => 'Type Name required for English atleast.',
                    'min_length' => 'Type Name should have minimum 3 characters.',
                    'max_length' => 'Type Name cannot more than 255 characters.',
                    'check_unique_customer_type_leave_current' => 'Type Already Exist'
                ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->Customer_type_mdl->update_customer_type($data, $customer_type_id);
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/customer/Customer-type');
            }
        }
        
        $this->_pdata['customer_type'] = $this->Customer_type_mdl->get_customer_type($customer_type_id);
        
        $this->template_lib->load_view($this, '__admin_customer/Customer_type_edit_view', $this->_pdata);
    }
    
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $customer_type_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_customer/Customer_type_mdl');
        $this->Customer_type_mdl->delete_customer_type($customer_type_id);
        
        redirect('admin/customer/customer-type');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $customer_type_id = $this->security_lib->decrypt($secure_token);
        
        if($customer_type_id) {
            $this->load->model('__admin_customer/Customer_type_mdl');
            $this->Customer_type_mdl->change_customer_type_status($customer_type_id, $this->input->get('change_status'));
            
            redirect('admin/customer/customer-type');
        }
    }
}
