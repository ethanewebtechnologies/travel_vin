<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Restricted Zone Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restricted_zone_ctrl extends CI_Controller {
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
            'dt',
            'name_sanatizer'
        ));
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_controller_name = $this->input->get('search_controller_name');
       
        if (isset($search_controller_name)) {
            $search_conditions['search_controller_name'] = trim($search_controller_name);
            $this->_pdata['search_controller_name'] = trim($search_controller_name);
        } else {
            $search_conditions['search_controller_name'] = null;
            $this->_pdata['search_controller_name'] = null;
        }
        
        $search_method_name = $this->input->get('search_method_name');
        
        if (isset($search_method_name)) {
            $search_conditions['search_method_name'] = trim($search_method_name);
            $this->_pdata['search_method_name'] = trim($search_method_name);
        } else {
            $search_conditions['search_method_name'] = null;
            $this->_pdata['search_method_name'] = null;
        }
        
        $search_para = array(
            'search_controller_name' => $this->_pdata['search_controller_name'],
            'search_method_name' => $this->_pdata['search_method_name']
        );
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
        
        $this->_pdata['restricted_zones'] = array();
        
        $this->load->model('__admin_settings/Restricted_zone_mdl');
        $this->_pdata['restricted_zones'] = $this->Restricted_zone_mdl->get_restricted_zones($search_conditions, $start, $limit);
     
        $this->_pdata['total_restricted_zones'] = $this->Restricted_zone_mdl->get_total_restricted_zones($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/settings/restricted-zone', $this->_pdata['total_restricted_zones'], $limit, $search_para);
        
        $this->template_lib->load_view($this, '__admin_settings/Restricted_zone_list_view', $this->_pdata);
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $restricted_zone_id = $this->security_lib->decrypt($secure_token);
        
        if($restricted_zone_id) {
            $this->load->model('__admin_settings/Restricted_zone_mdl');
            $this->Restricted_zone_mdl->change_restricted_zone_status($restricted_zone_id, $this->input->get('change_status'));
            
            redirect('admin/settings/restricted-zone');
        }
    }
}