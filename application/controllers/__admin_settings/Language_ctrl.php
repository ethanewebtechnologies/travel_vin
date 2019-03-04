<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Langauge Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Language_ctrl extends CI_Controller {
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
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_type_name = $this->input->get('search_type_name');
        
        if (isset($search_type_name)) {
            $search_conditions['search_type_name'] = trim($search_type_name);
            $this->_pdata['search_type_name'] = trim($search_type_name);
        } else {
            $search_conditions['search_type_name'] = null;
            $this->_pdata['search_type_name'] = null;
        }
        
        $search_lang_code = $this->input->get('search_lang_code');
        
        if (isset($search_lang_code)) {
            $search_conditions['search_lang_code'] = trim($search_lang_code);
            $this->_pdata['search_lang_code'] = trim($search_lang_code);
        } else {
            $search_conditions['search_lang_code'] = null;
            $this->_pdata['search_lang_code'] = null;
        }
        
        $start = $this->input->get('per_page');
        
        if (!isset($start)) {
            $start = 0;
        }
        
        $limit = PAGINATION_LIMIT;
    
        $this->load->model('__admin_settings/Language_mdl');
        $this->_pdata['languages'] = $this->Language_mdl->get_languages($search_conditions, $start, $limit);
        $this->_pdata['total_languages'] = $this->Language_mdl->get_total_languages($search_conditions);
	    
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/settings/language', $this->_pdata['total_languages'], $limit);
       		
		$this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_pages'] = $this->lang->line('text_pages');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add_page'] = $this->lang->line('text_add_page');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
		
		
        $this->template_lib->load_view($this, '__admin_settings/Language_list_view', $this->_pdata);
    }
    
    public function add() {
        $this->load->model('__admin_settings/Language_mdl');
        
        if($this->input->post()) {
            $this->Language_mdl->add_language($this->input->post());
            redirect('admin/settings/language');
        }
        
        $this->template_lib->load_view($this, '__admin_settings/Language_add_view', $this->_pdata);
    }
    
    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $language_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_settings/Language_mdl');
       
        if($this->input->post()) {
            $this->Language_mdl->update_language($this->input->post(), $language_id);
            redirect('admin/settings/language');
        }
        
        $this->_pdata['language'] = $this->Language_mdl->get_language($language_id);
        $this->template_lib->load_view($this, '__admin_settings/Language_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $language_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_settings/Language_mdl');
        $this->Language_mdl->delete_language($language_id);
        
        redirect('admin/settings/language');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $language_id = $this->security_lib->decrypt($secure_token);
        
        if($language_id) {
            $this->load->model('__admin_settings/Language_mdl');
            $this->Language_mdl->change_language_status($language_id, $this->input->get('change_status'));
            
            redirect('admin/settings/language');
        }
    }
}
