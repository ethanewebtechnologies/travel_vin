<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: GOLF CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Golf_ctrl extends CI_Controller {
    
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
        $this->lang->load(array('__admin_catalog/Golf', 'common','form_validation'), DEFAULT_ADMIN_PANEL_LANGUAGE);
        $this->lang->load('common', 'en');
     }
    
     public function index() {
         $search_conditions = array();
         
         $search_title = $this->input->get('search_title');
         
         if (isset($search_title)) {
             $search_conditions['search_title'] = trim($search_title);
             $this->_pdata['search_title'] = trim($search_title);
         } else {
             $search_conditions['search_title'] = null;
             $this->_pdata['search_title'] = null;
         }
         
         $search_price = $this->input->get('search_price');
         
         if (isset($search_price)) {
             $search_conditions['search_price'] = trim($search_price);
             $this->_pdata['search_price'] = trim($search_price);
         } else {
             $search_conditions['search_price'] = null;
             $this->_pdata['search_price'] = null;
         }
         
         $start = $this->input->get('per_page');
         
         if (!isset($start)) {
             $start = 0;
         }
         
         $limit = PAGINATION_LIMIT;
         
         $this->_pdata['golfs'] = array();
         
         $this->load->model('__admin_catalog/Golf_mdl');
         $golfs = $this->Golf_mdl->get_golfs($search_conditions, $start, $limit);
         
         $golf_ids_array = array();
         
         foreach ($golfs as $key => $golf) {
             $golf_ids_array[] = $golf['id'];
             $this->_pdata['golfs'][$golf['id']] = $golf;
         }
         if(!empty($golf_ids_array)){
             $images = $this->Golf_mdl->get_golf_images_by_golf_ids($golf_ids_array);
             foreach ($images as $image) {
                 if(!isset($this->_pdata['golfs'][$image['item_id']]['image']) && file_exists($image['image'])) {
                     $this->_pdata['golfs'][$image['item_id']]['image'] = $image['image'];
                 }
             }
         }
         
         $this->_pdata['total_golfs'] = $this->Golf_mdl->get_total_golfs($search_conditions);
         
         $this->load->helper('paginator');
         $this->_pdata['pagination'] = generate_pagination($this, 'admin/catalog/golf', $this->_pdata['total_golfs'], $limit);
         
         $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
         $this->_pdata['text_sn'] = $this->lang->line('text_sn');
         $this->_pdata['text_pages'] = $this->lang->line('text_pages');
         $this->_pdata['text_action'] = $this->lang->line('text_action');
         $this->_pdata['text_add_page'] = $this->lang->line('text_add_page');
         $this->_pdata['text_edit'] = $this->lang->line('text_edit');
         $this->_pdata['text_delete'] = $this->lang->line('text_delete');
         $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
         
         $this->_pdata['optimized'] = new Optimized();
         $this->template_lib->load_view($this, '__admin_catalog/Golf_list_view', $this->_pdata);
     }
     
     public function add() {
         $this->load->model('__admin_catalog/Golf_mdl');
         $this->load->model('__admin_settings/Utility_mdl');
             if ($this->input->post()) {
                 
                 $this->form_validation->set_rules('slug', 'Slug', 'trim|required|max_length[255]|is_unique[tv_golf_tbl.slug]',
                     array(
                         'required' => 'Slug( SEO URL ) is Required.',
                         'max_length' => 'Slug( SEO URL ) cannot more than 255 characters.',
                         'is_unique'=> 'Slug( SEO URL ) already used. Please try different one'
                     ));
                 $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                     'required' => 'Please Select Country'
                 ));
                 $this->form_validation->set_rules('city_id', 'city', 'required',array(
                     'required' => 'Please Select City'
                 ));
                 $this->form_validation->set_rules('agent_id', 'Agent Id', 'required', array(
                     'required' => 'Please Select Agent'
                 ));
                 $this->form_validation->set_rules('golf_category_id', 'Category', 'required|max_length[19]', array(
                     'required' => 'Please Select Category'
                 ));
                 $this->form_validation->set_rules('price', 'Price', 'required',array(
                     'required' => 'Price cannot leave blank',
                     'max_length' => 'Adult Price cannot more than 19 characters.'
                 ));
    			  $this->form_validation->set_rules('agent_cost', 'AgentCost', 'required|max_length[19]',array(
    			      'required' => 'Please Enter Agent Cost ',
                       'max_length' => 'Adult Price cannot more than 19 characters.'
    			  ));
    			 $this->form_validation->set_rules('price', 'Price', 'max_length[19]',
    			      array(
    			          'max_length' => 'Price cannot more than 19 characters.'
    			      ));
                 $this->form_validation->set_rules('price', 'Price', 'required',array(
                     'required' => 'Price cannot leave blank'
                 ));
                 $this->form_validation->set_rules('details[en][title]', 'Title', 'trim|required|min_length[3]|max_length[255]',
                     array(
                         'required' => 'Title Name required.',
                         'min_length' => 'Title should have minimum 3 characters.',
                         'max_length' => 'Title Name cannot more than 255 characters.'
                     ));
                 $this->form_validation->set_rules('details[en][dsc]', 'Description', 'trim|required|min_length[80]',
                     array(
                         'required' => 'Description is Required.',
                         'min_length' => 'Description should be more than 80 characters.
                    '));
                     $this->form_validation->set_rules('details[en][tags]', 'Tags', 'trim|max_length[255]',
                         array(
                             'max_length' => 'Tags cannot more than 255 characters.'
                         ));
                     $this->form_validation->set_rules('details[en][meta_title]', 'Meta Title', 'trim|max_length[255]',
                         array(
                             'max_length'=>'Meta Title cannot more than 255 characters.'
                         ));
                     $this->form_validation->set_rules('details[en][meta_dsc]', 'Meta Description', 'trim|max_length[255]',
                         array(
                             'max_length'=>'Meta Description cannot more than 255 characters.'
                         ));
                     $this->form_validation->set_rules('details[en][meta_keywords]', 'Meta Keyword', 'trim|max_length[255]',
                         array(
                             'max_length'=>'Meta Keyword  not more than 255 characters.'
                         ));
                     $this->form_validation->set_rules('postimage[0]', 'Image', 'required',array(
                         'required'=>'Please upload atleast one image.'
                     ));
                     if ($this->form_validation->run() == FALSE) {
                         $this->session->set_flashdata('validation_error', TRUE);
                     } else {
                             $golf_id = $this->Golf_mdl->add_golf($this->input->post());
                             $images = $this->input->post('postimage');
                             
                             if ($images != NULL) {
                                 for ($i = 0; $i < count($images); $i++) {
                                     $data = array(
                                         //'image' => str_replace(base_url(),"",$images[$i]),
                                         'image' => $images[$i],
                                         'item_id' => $golf_id,
                                         'item_type' => 'golf'
                                     );
                                     $this->Golf_mdl->add_image($data);
                                 }
                             }
                             $this->session->set_flashdata('added_successfully', TRUE);
                             redirect('admin/catalog/golf');
                      }
             }
         
         $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
         
         $countries = $this->Golf_mdl->get_countries();
         $this->_pdata['countries'][''] = '--- Please Select Country ---';
         foreach ($countries as $country) {
             $this->_pdata['countries'][$country['id']] = $country['name'];
         }
         
         $cities = $this->Golf_mdl->get_cities();
         $this->_pdata['cities'][''] = '--- Please Select City ---';
         foreach ($cities as $city) {
             $this->_pdata['cities'][$city['id']] = $city['name'];
         }
         
         $categories = $this->Utility_mdl->get_categories();
         $this->_pdata['categories'][''] = '--- Please Select Category ---';
         foreach ($categories as $categeory) {
             $this->_pdata['categories'][$categeory['id']] = $categeory['category_name'];
         }
         
         $agents = $this->Golf_mdl->get_agents();
         $this->_pdata['agents'][''] = '--- Please Select Agent ---';
         foreach ($agents as $agent) {
             $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
         }
         
         $posted_images = $this->input->post('postimage') != '' ? $this->input->post('postimage') : array();
         $this->_pdata['postimage'] = $posted_images != '' ? $posted_images : array();
         
         $this->_pdata['languages'] = $this->Golf_mdl->get_all_languages();
         $this->template_lib->load_view($this, '__admin_catalog/Golf_add_view', $this->_pdata);
     }
     
     public function edit() {
         
         $secure_token = $this->input->get('secure_token');
         $golf_id = $this->security_lib->decrypt($secure_token);
         
         $this->load->model('__admin_settings/Utility_mdl');
         $this->load->model('__admin_catalog/Golf_mdl');
         $this->_pdata['text_h3_heading_edit'] = $this->lang->line('text_h3_heading_edit');
         
         if ($this->input->post()) {
             $this->form_validation->set_rules('slug', 'Slug', 'trim|required|max_length[255]',
                 array(
                     'required' => 'Slug( SEO URL ) is Required.',
                     'max_length' => 'Slug( SEO URL ) cannot more than 255 characters.'
                 ));
             $this->form_validation->set_rules('country_id', 'Country', 'required', array(
                 'required' => 'Please Select Country'
             ));
             $this->form_validation->set_rules('city_id', 'city', 'required',array(
                 'required' => 'Please Select City'
             ));
             $this->form_validation->set_rules('agent_id', 'Agent Id', 'required', array(
                 'required' => 'Please Select Agent'
             ));
			 $this->form_validation->set_rules('agent_cost', 'AgentCost', 'required',array(
                 'required' => 'Please Enter Agent Cost '
             ));
             $this->form_validation->set_rules('price', 'Price', 'required',array(
                 'required' => 'Price cannot leave blank'
             ));
             $this->form_validation->set_rules('details[en][title]', 'Title', 'trim|required|min_length[3]|max_length[255]',
                 array(
                     'required' => 'Title Name.',
                     'min_length' => 'Title should have minimum 3 characters.',
                     'max_length' => 'Title Name cannot more than 255 characters.'
                 ));
             $this->form_validation->set_rules('details[en][dsc]', 'Description', 'trim|required|min_length[80]',
                 array(
                     'required' => 'Description is Required.',
                     'min_length' => 'Description should be more than 80 characters.
                '));
                 $this->form_validation->set_rules('details[en][tags]', 'Tags', 'trim|max_length[255]',
                     array(
                         'max_length' => 'Tags cannot more than 255 characters.'
                     ));
                 $this->form_validation->set_rules('details[en][meta_title]', 'Meta Title', 'trim|max_length[255]',
                     array(
                         'max_length'=>'Meta Title cannot more than 255 characters.'
                     ));
                 $this->form_validation->set_rules('details[en][meta_dsc]', 'Meta Description', 'trim|max_length[255]',
                     array(
                         'max_length'=>'Meta Description cannot more than 255 characters.'
                     ));
                 $this->form_validation->set_rules('details[en][meta_keywords]', 'Meta Keyword', 'trim|max_length[255]',
                     array(
                         'max_length'=>'Meta Keyword  not more than 255 characters.'
                     ));
                 $this->form_validation->set_rules('postimage[0]', 'Image', 'required',array(
                     'required'=>'Please upload atleast one image.'
                 ));
                 if ($this->form_validation->run() == FALSE) {
                     $this->session->set_flashdata('validation_error', TRUE);
                 } else {
                         $data = [
                             'slug' => $this->input->post('slug'),
                             'country_id' => $this->input->post('country_id'),
                             'city_id' => $this->input->post('city_id'),
                             'agent_id' => $this->input->post('agent_id'),                       
                             'agent_cost' => $this->input->post('agent_cost'),
                             'price' => $this->input->post('price'),
                             'golf_category_id' => $this->input->post('golf_category_id'),
                             'adult_price' => $this->input->post('adult_price'),
                             'details' => $this->input->post('details'),
                             'block_golf_dates' => $this->input->post('block_golf_dates')
                         ];
                         if($this->input->post('status')) {
                             $data['status'] = $this->input->post('status');
                         }
                         $this->Golf_mdl->update_golf($data, $golf_id);
                         $this->Golf_mdl->delete_images($golf_id);
                         
                         $images = $this->input->post('postimage');
                             if ($images != NULL) {
                                 for ($i = 0; $i < count($images); $i++) {
                                     $data = array(
                                         'image' => $images[$i],
                                         'item_id' => $golf_id,
                                         'item_type' => 'golf'
                                     );
                                     $this->Golf_mdl->add_image($data);
                                 }
                             }
                         $this->session->set_flashdata('updated_successfully', TRUE);
                         redirect('admin/catalog/golf');
                   }
         }
         $this->_pdata['golf'] = $this->Golf_mdl->get_golf($golf_id);
         $golf_details = $this->Golf_mdl->get_golf_details_by_golf_id($golf_id);
         
         foreach ($golf_details as $golf_detail) {
             $this->_pdata['golf_details'][$golf_detail['language_code']] = $golf_detail;
         }
         $this->_pdata['languages'] = $this->Golf_mdl->get_all_languages();
         
         $countries = $this->Golf_mdl->get_countries();
         $this->_pdata['countries'][''] = '--- Please Select Country ---';
         foreach ($countries as $country) {
             $this->_pdata['countries'][$country['id']] = $country['name'];
         }
         
         $cities = $this->Golf_mdl->get_cities();
         $this->_pdata['cities'][''] = '--- Please Select City ---';
         foreach ($cities as $city) {
             $this->_pdata['cities'][$city['id']] = $city['name'];
         }
         
         $categories = $this->Utility_mdl->get_categories();
         $this->_pdata['categories'][''] = '--- Please Select Category ---';
         foreach ($categories as $categeory) {
             $this->_pdata['categories'][$categeory['id']] = $categeory['category_name'];
         }
         
         $agents = $this->Golf_mdl->get_agents();
         $this->_pdata['agents'][''] = '--- Please Select Agent ---';
         foreach ($agents as $agent) {
             $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
         }
         
         $blockdates = $this->Golf_mdl->get_block_dates($golf_id);
         $this->_pdata['blocked_dates'] = '';
         foreach ($blockdates as $blockdate) {
             $this->_pdata['blocked_dates'] .=  d_to_lu($blockdate['block_date']) . ",";
         }
         $this->_pdata['blocked_dates'] = chop($this->_pdata['blocked_dates'], ",");
         $this->template_lib->load_view($this, '__admin_catalog/Golf_edit_view', $this->_pdata);
     }
     
     public function delete() {
         $secure_token = $this->input->get('secure_token');
         $golf_id = $this->security_lib->decrypt($secure_token);
         $this->load->model('__admin_catalog/Golf_mdl');
         $this->Golf_mdl->delete_golf($golf_id);
         
         redirect('admin/catalog/golf/index');
     }
     
     public function add_image() {
         if ($this->input->is_ajax_request()) {
             if ($_FILES['image']['size'] >= TV_MAX_IMG_UPLOAD_SIZE) {
                 
                 $result = array(
                     'type' => 'Error',
                     '_CTN' => $this->security->get_csrf_token_name(),
                     '_CTH' => $this->security->get_csrf_hash(),
                     'text' => 'Please Upload Image Less Than'.TV_MAX_IMG_UPLOAD_SIZE_TEXT
                 );
                 
                 $this->output->set_content_type('application/json')->set_output(json_encode($result));
             } else {
                     $image_path = 'content/image/main/golf/';
                     
                     $config['upload_path'] = './' . $image_path;
                     $config['allowed_types'] = 'gif|jpg|png|jpeg';
                     $config['file_name'] = 'golf_img_' . time();
                     
                     $this->load->library('upload', $config);
                     
                     if (!$this->upload->do_upload('image')) {
                         $result = array(
                             'type' => 'Error',
                             '_CTN' => $this->security->get_csrf_token_name(),
                             '_CTH' => $this->security->get_csrf_hash(),
                             'text' => $this->upload->display_errors('', '')
                         );
                         $this->output->set_content_type('application/json')->set_output(json_encode($result));
                     } else {
                             $data = $this->upload->data();
                             $filename = $data['file_name'];
                             
                             $result = array(
                                 'type' => 'success',
                                 '_CTN' => $this->security->get_csrf_token_name(),
                                 '_CTH' => $this->security->get_csrf_hash(),
                                 'file' => $image_path . $filename
                             );
                     }
                 $this->output->set_content_type('application/json')->set_output(json_encode($result));
             }
         }
     }
     
     public function delete_image() {
         if ($this->input->is_ajax_request()) {
             $file = $this->input->post('file');
             
             if (file_exists('./' . $file)) {
                 unlink('./' . $file);
                 
                 $result = array(
                     'type' => 'success',
                     '_CTN' => $this->security->get_csrf_token_name(),
                     '_CTH' => $this->security->get_csrf_hash(),
                     'text' => 'Image has been deleted Successfully'
                 );
                 
                 $this->output->set_content_type('application/json')->set_output(json_encode($result));
             } else {
                     $result = array(
                         'type' => 'Error',
                         '_CTN' => $this->security->get_csrf_token_name(),
                         '_CTH' => $this->security->get_csrf_hash(),
                         'text' => ''
                     );
                 $this->output->set_content_type('application/json')->set_output(json_encode($result));
             }
         }
     }
     
     public function get_cities_by_country_id() {
         $country_id = $this->input->get('country_id');
         
         $this->load->model('__admin_catalog/Golf_mdl');
         $data['cities'] = $this->Golf_mdl->get_cities_by_country_id($country_id);
         
         $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
     }
     
     
}