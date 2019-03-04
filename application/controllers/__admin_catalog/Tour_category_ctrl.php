<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: TOUR CATEGORY CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Tour_category_ctrl extends CI_Controller {

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

        $this->load->helper(array('form', 'date', 'dt'));

        $this->lang->load('__admin_catalog/Tour', 'en');
        $this->lang->load('common', 'en');
    }

    public function index() {
        $search_conditions = array();

        $search_category_name = $this->input->get('search_category_name');

        if (isset($search_category_name)) {
            $search_conditions['search_category_name'] = trim($search_category_name);
            $this->_pdata['search_category_name'] =  trim($search_category_name);
        } else {
            $search_conditions['search_category_name'] = null;
            $this->_pdata['search_category_name'] = null;
        }

        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['tour_categories'] = array();

        $this->load->model('__admin_catalog/Tour_category_mdl');
        $this->_pdata['tour_categories'] = $this->Tour_category_mdl->get_tour_categories($search_conditions, $start, $limit);
		
        $this->_pdata['total_tour_categories'] = $this->Tour_category_mdl->get_total_tour_categories($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/catalog/tour-category', $this->_pdata['total_tour_categories'], $limit);

        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_pages'] = $this->lang->line('text_pages');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add_page'] = $this->lang->line('text_add_page');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        
        $this->_pdata['optimized'] = new Optimized();
        $this->template_lib->load_view($this, '__admin_catalog/Tour_category_list_view', $this->_pdata);
    }

    public function add() {
        $this->load->model('__admin_catalog/Tour_category_mdl');
        if ($this->input->post()) {

		$this->form_validation->set_rules('details[en][category_name]', 'Category Name', 'trim|required|min_length[3]|max_length[80]',
                array(
                    'required' => 'Category Name required for English atleast.',
                    'min_length' => 'Category Name should have minimum 3 characters.',
                    'max_length' => 'Category Name cannot more than 255 characters.'
                ));
				  
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
            } else {
				 $this->Tour_category_mdl->add_tour_category($this->input->post());
                redirect('admin/catalog/Tour-category');
            }
        }

        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
	
        $this->load->model('__admin_settings/Utility_mdl');
        $this->_pdata['languages'] = $this->Utility_mdl->get_languages();

        $this->template_lib->load_view($this, '__admin_catalog/Tour_category_add_view', $this->_pdata);
    }

   public function edit() {

        $secure_token = $this->input->get('secure_token');
        $tour_cat_id = $this->security_lib->decrypt($secure_token);
          
        $this->load->model('__admin_catalog/Tour_category_mdl');
        $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');

        if ($this->input->post()) {                  
            $data = [
                'category_name' => $this->input->post('category_name'),                              
                'details' => $this->input->post('details'),
            ];
                
            if($this->input->post('status')) {
                $data['status'] = $this->input->post('status');
            }
				
			$this->form_validation->set_rules('details[en][category_name]', 'Category Name', 'trim|required|min_length[3]|max_length[80]', array(
				'required' => 'Category Name required for English atleast.',
				'min_length' => 'Category Name should have minimum 3 characters.',
				'max_length' => 'Category Name cannot more than 255 characters.'
			));
			  
			if ($this->form_validation->run() == FALSE) {
				$this->session->set_flashdata('msg-error', validation_errors());
			} else {
				$this->Tour_category_mdl->update_tour_category($data, $tour_cat_id); 
				redirect('admin/catalog/tour-category');
			}
        } 
			
	   $this->_pdata['tour_category'] = $this->Tour_category_mdl->get_tour_category($tour_cat_id);
	   $tour_category_details = $this->Tour_category_mdl->get_tour_category_details_by_tour_cat_id($tour_cat_id);
        
	   foreach ($tour_category_details as $tour_category_detail) {
          $this->_pdata['tour_category_details'][$tour_category_detail['language_code']] = $tour_category_detail;
	   } 
	   
	   $this->load->model('__admin_settings/Utility_mdl');
	   $this->_pdata['languages'] = $this->Utility_mdl->get_languages();
	   
	   $this->template_lib->load_view($this, '__admin_catalog/Tour_category_edit_view', $this->_pdata);
    }


    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $tour_cat_id = $this->security_lib->decrypt($secure_token);
        $this->load->model('__admin_catalog/Tour_category_mdl');
        $this->Tour_category_mdl->delete_tour_category($tour_cat_id);
    
        redirect('admin/catalog/Tour-category');
    }

}
