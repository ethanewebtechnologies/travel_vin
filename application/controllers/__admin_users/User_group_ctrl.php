<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: User Group Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class User_group_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if(!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__commonlib/Security_lib',
            '__prjadminlib/Template_lib'
        ));
        
        $this->load->helper(array('form', 'name_sanatizer', 'dt'));
        $this->lang->load('common', DEFAULT_ADMIN_PANEL_LANGUAGE);
    }
    
    public function index() {
        
        $search_conditions = array();
        
        $search_group_name = $this->input->get('search_group_name');
        
        if (isset($search_group_name)) {
            $search_conditions['search_group_name'] = $search_group_name;
            $this->_pdata['search_group_name'] = $search_group_name;
        } else {
            $search_conditions['search_group_name'] = null;
            $this->_pdata['search_group_name'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->load->model('__admin_users/User_group_mdl');
        
        $this->_pdata['user_groups'] = array();
        $this->_pdata['user_groups'] = $this->User_group_mdl->get_user_groups($search_conditions, $start, $limit);
        
        $this->_pdata['total_user_groups'] = $this->User_group_mdl->get_total_user_groups($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/users/user-group', $this->_pdata['total_user_groups'], $limit);
        
        $this->template_lib->load_view($this, '__admin_users/User_group_list_view', $this->_pdata);
    }
    
    public function add() {
        $this->load->model('__admin_users/User_group_mdl');
        
        if($this->input->post()) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|max_length[20]', array(
                'required' => 'Group Name is Required.',
                'max_length' => 'Group Name should not contain more than 20 character'
            ));
            
            if($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $user_group_id = $this->User_group_mdl->add_user_group($this->input->post());
                $this->User_group_mdl->add_user_group_permission($this->input->post('restrictions'), $user_group_id);
                
                $this->session->set_flashdata('added_successfully', TRUE);
                redirect('admin/users/user_group');
            }
        }
        
        $this->_pdata['restricted_zones'] = $this->User_group_mdl->get_restricted_zones();
        
        $this->template_lib->load_view($this, '__admin_users/User_group_add_view', $this->_pdata);
    }
    
    public function edit() {
        
        $secure_token = $this->input->get('secure_token');
        $user_group_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_users/User_group_mdl');
        
        if($this->input->post()) {
            $this->form_validation->set_rules('group_name', 'Group Name', 'trim|required|max_length[20]', array(
                'required' => 'Group Name is Required.',
                'max_length' => 'Group Name should not contain more than 20 character'
            ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $this->User_group_mdl->update_user_group($this->input->post(), $user_group_id);
                $this->User_group_mdl->add_user_group_permission($this->input->post('restrictions'), $user_group_id);
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/users/user_group');
            }
        }
        
        $user_permissions = $this->User_group_mdl->get_user_group_permission($user_group_id);
        
        $this->_pdata['user_permissions'] = array();
        
        if(!empty($user_permissions)) {
            foreach ($user_permissions as $user_permission) {
                $this->_pdata['user_permissions'][] = $user_permission['restrictied_zone_id'];
            }
        }
        
        $this->_pdata['restricted_zones'] = $this->User_group_mdl->get_restricted_zones();
        
        $this->_pdata['user_group'] = $this->User_group_mdl->get_user_group($user_group_id);
        
        $this->template_lib->load_view($this, '__admin_users/User_group_edit_view', $this->_pdata);
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $user_group_id = $this->security_lib->decrypt($secure_token);
        
        if($user_group_id) {
            $this->load->model('__admin_users/User_group_mdl');
            
            $this->User_group_mdl->change_user_group_status($user_group_id, $this->input->get('change_status'));
            redirect('admin/users/user_group');
        }
    }
    
    public function delete_user_group() {
        $secure_token = $this->input->get('secure_token');
        $user_group_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_users/User_group_mdl');
        
        if($user_group_id) {
            $this->User_group_mdl->delete_user_group($user_group_id);
            redirect('admin/users/user_group');
        }
    }
}