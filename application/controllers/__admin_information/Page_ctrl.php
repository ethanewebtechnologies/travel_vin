<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: PAGE CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Page_ctrl extends CI_Controller {

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

        $this->load->helper('form');

        $this->lang->load(array(
                '__admin_information/Page', 
                'common'
            ), DEFAULT_ADMIN_PANEL_LANGUAGE
        );
    }

    public function index() {

        $search_conditions = array();

        $search_name = $this->input->get('search_name');

        if (isset($search_name)) {
            $search_conditions['search_name'] = $search_name;
            $this->_pdata['search_name'] = $search_name;
        } else {
            $search_conditions['search_name'] = null;
            $this->_pdata['search_name'] = null;
        }

        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['pages'] = array();

        $this->load->model('__admin_information/Page_mdl');

        /* FETCHING DATA */
        $this->_pdata['pages'] = $this->Page_mdl->get_pages($search_conditions, $start, $limit);
        $this->_pdata['total_pages'] = $this->Page_mdl->get_total_pages($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/information/page', $this->_pdata['total_pages'], $limit);

        $this->template_lib->load_view($this, '__admin_information/Page_list_view', $this->_pdata);
    }

    public function add() {
        $this->load->model('__admin_information/Page_mdl');
        $user = $this->session->userdata('user');

        if ($this->input->post()) {
            
            $this->form_validation->set_rules('slug', 'Page Slug', 'trim|required|max_length[200]',
                array(
                    'required' => 'Page Slug is Required.',
                    'max_length' => 'Page Slug not more than 200 characters.'
                ));
            
            $this->form_validation->set_rules('details[en][page_name]', 'Page Name', 'trim|required|max_length[200]',
                array(
                    'required' => 'Page Name is Required.',
                    'max_length' => 'Page Name not more than 200 characters.'
                ));
            
            $this->form_validation->set_rules('details[en][page_content]', 'Page Content', 'trim|required|max_length[255]',
                array(
                    'required' => 'Page Content is Required.'
                ));
            
            $data = [
                'status' => $this->input->post('status'),
                'slug' => $this->input->post('slug'),
                'user_id' => $this->input->post('user_id'),
                'details' => $this->input->post('details')
            ];
        }
		
		if ($this->form_validation->run() == FALSE) {
		  $this->session->set_flashdata('msg-error', validation_errors());	
		} else {
			$this->Page_mdl->add_page($data);
            redirect('admin/information/Page');
		}
        
        $this->_pdata['languages'] = $this->Page_mdl->get_all_languages();
        $this->template_lib->load_view($this, '__admin_information/Page_add_view', $this->_pdata);
    }

    public function edit() {
        $secure_token = $this->input->get('secure_token');
        $page_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_information/Page_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');

        if ($this->input->post()) {
            $this->form_validation->set_rules('slug', 'Page Slug', 'trim|required|max_length[200]',
                array(
                    'required' => 'Page Slug is Required.',
                    'max_length' => 'Page Slug not more than 200 characters.'
                ));
            
            $this->form_validation->set_rules('details[en][page_name]', 'Page Name', 'trim|required|max_length[200]',
                array(
                    'required' => 'Page Name is Required.',
                    'max_length' => 'Page Name should not more than 200 characters.'
                ));
            
            $this->form_validation->set_rules('details[en][page_content]', 'Page Content', 'trim|required',
                array(
                    'required' => 'Page Content is Required.'
                ));
            
            $data = [
                'status' => $this->input->post('status'),
                'slug' => $this->input->post('slug'),
                'user_id' => $this->input->post('user_id'),
                'details' => $this->input->post('details')
            ];
        }
        
		if ($this->form_validation->run() == FALSE) {
		  $this->session->set_flashdata('msg-error', validation_errors());	
		} else {
			$this->Page_mdl->update_page($data, $page_id);
            redirect('admin/information/Page');
		}
        
        $this->_pdata['page'] = $this->Page_mdl->get_page($page_id);

        $page_details = $this->Page_mdl->get_page_details($page_id);

        foreach ($page_details as $page_detail) {
            $this->_pdata['page_details'][$page_detail['language_code']] = $page_detail;
        }

        $this->_pdata['languages'] = $this->Page_mdl->get_all_languages();

        $this->template_lib->load_view($this, '__admin_information/Page_edit_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $page_id = $this->security_lib->decrypt($secure_token);

        $this->load->model('__admin_information/Page_mdl');
        $this->Page_mdl->delete_page($page_id);

        redirect('admin/information/Page');
    }

    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $page_id = $this->security_lib->decrypt($secure_token);
        
        if($page_id) {
            $this->load->model('__admin_information/Page_mdl');
            $this->Page_mdl->change_page_status($page_id, $this->input->get('change_status'));
            
            redirect('admin/information/Page');
        }
    }
}
