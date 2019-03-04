<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: RESTAURANT CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA,KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Restaurant_ctrl extends CI_Controller {
    
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
        $this->lang->load(array('__admin_catalog/Restaurant', 'common'), 'en');
    }
    
    public function index() {
        $search_conditions = array();
        
        $search_title = $this->input->get('search_title');
        
        if (isset($search_title)) {
            $search_conditions['search_title'] = $search_title;
            $this->_pdata['search_title'] = $search_title;
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
        
        $this->_pdata['restaurants'] = array();
        
        $this->load->model('__admin_catalog/Restaurant_mdl');
        $restaurants = $this->Restaurant_mdl->get_restaurants($search_conditions, $start, $limit);
        
        $restaurant_ids_array = array();
        
        foreach ($restaurants as $key => $restaurant) {
            $restaurant_ids_array[] = $restaurant['id'];
            $this->_pdata['restaurants'][$restaurant['id']] = $restaurant;
        }
        if(!empty($restaurant_ids_array)){
            $images = $this->Restaurant_mdl->get_restaurant_images_by_restaurant_ids($restaurant_ids_array);
            foreach ($images as $image) {
                if(!isset($this->_pdata['restaurants'][$image['item_id']]['image']) && file_exists($image['image'])) {
                    $this->_pdata['restaurants'][$image['item_id']]['image'] = $image['image'];
                }
            }
        }
        
        $this->_pdata['total_restaurants'] = $this->Restaurant_mdl->get_total_restaurants($search_conditions);
        
        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/catalog/restaurant', $this->_pdata['total_restaurants'], $limit);
        
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_pages'] = $this->lang->line('text_pages');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add_page'] = $this->lang->line('text_add_page');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        
        $this->_pdata['optimized'] = new Optimized();
        $this->template_lib->load_view($this, '__admin_catalog/Restaurant_list_view', $this->_pdata);
    }
    
    public function add() {
        
        $this->load->model('__admin_settings/Utility_mdl');
        $this->load->model('__admin_catalog/Restaurant_mdl');
        if ($this->input->post()) {
            
            $this->form_validation->set_rules('slug', 'Slug', 'trim|required|max_length[255]|is_unique[tv_restaurant_tbl.slug]',
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
            
            $this->form_validation->set_rules('restaurant_category_id', 'Restaurant Category', 'required', array(
                'required' => 'Please Select category'
            ));
            
            $this->form_validation->set_rules('price', 'Price', 'required',array(
                'required' => 'Price cannot leave blank',
                'max_length' => 'Adult Price cannot more than 19 characters.'
            ));
            
            $this->form_validation->set_rules('agent_cost', 'AgentCost', 'required|max_length[19]',array(
                'required' => 'Please Enter Agent Cost ',
                'max_length' => 'Adult Price cannot more than 19 characters.'
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
                    $restaurant_id = $this->Restaurant_mdl->add_restaurant($this->input->post());
                    $images = $this->input->post('postimage');
                    
                    if ($images != NULL) {
                        for ($i = 0; $i < count($images); $i++) {
                            $data = array(
                                //'image' => str_replace(base_url(),"",$images[$i]),
                                'image' => $images[$i],
                                'item_id' => $restaurant_id,
                                'item_type' => 'restaurant'
                            );
                            
                            $this->Restaurant_mdl->add_image($data);
                        }
                    }
                    
                    $this->session->set_flashdata('added_successfully', TRUE);
                    redirect('admin/catalog/restaurant');
                }
        }
        
        $this->_pdata['text_h3_heading_add'] = $this->lang->line('text_h3_heading_add');
        
        $countries = $this->Restaurant_mdl->get_countries();
        
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $cities = $this->Restaurant_mdl->get_cities();
        $this->_pdata['cities'][''] = '--- Please Select City ---';
        
        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }
        
        $categories = $this->Utility_mdl->get_categories();
        $this->_pdata['categories'][''] = '--- Please Select Category ---';
        foreach ($categories as $categeory) {
            $this->_pdata['categories'][$categeory['id']] = $categeory['category_name'];
        }
        
        $agents = $this->Restaurant_mdl->get_agents();
        $this->_pdata['agents'][''] = '--- Please Select Agent ---';
        
        foreach ($agents as $agent) {
            $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
        }
        
        
        $posted_images = $this->input->post('postimage') != '' ? $this->input->post('postimage') : array();
        
        /* if(isset($posted_images) && $posted_images!=''){
         foreach($posted_images as $key=>$value){
         $posted_images[$key]=str_replace(base_url(),"",$value);
         }
         } */
        
        $this->_pdata['postimage'] = $posted_images != '' ? $posted_images : array();
        
        //pr($this->_pdata['postimage']);
        
        $this->_pdata['languages'] = $this->Restaurant_mdl->get_all_languages();
        
        $this->template_lib->load_view($this, '__admin_catalog/Restaurant_add_view', $this->_pdata);
    }
    
    public function edit() {
        
        $secure_token = $this->input->get('secure_token');
        $restaurant_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_settings/Utility_mdl');
        
        $this->load->model('__admin_catalog/Restaurant_mdl');
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
            $this->form_validation->set_rules('restaurant_category_id', 'Restaurant Category', 'required', array(
                'required' => 'Please Select category'
            ));
            
            $this->form_validation->set_rules('price', 'Price', 'required',array(
                'required' => 'Price cannot leave blank',
                'max_length' => 'Adult Price cannot more than 19 characters.'
            ));
            
            $this->form_validation->set_rules('agent_cost', 'AgentCost', 'required|max_length[19]',array(
                'required' => 'Please Enter Agent Cost ',
                'max_length' => 'Adult Price cannot more than 19 characters.'
            ));
            
            $this->form_validation->set_rules('details[en][title]', 'Title', 'trim|required|min_length[3]|max_length[255]',
                array(
                    'required' => 'Title Name required for .',
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
                        'restaurant_category_id' => $this->input->post('restaurant_category_id'),
                        'adult_price' => $this->input->post('adult_price'),
                        'details' => $this->input->post('details'),
                        
                        'block_restaurant_dates' => $this->input->post('block_restaurant_dates')
                    ];
                    
                    if($this->input->post('status')) {
                        $data['status'] = $this->input->post('status');
                    }
                    
                    $this->Restaurant_mdl->update_restaurant($data, $restaurant_id);
                    $this->Restaurant_mdl->delete_images($restaurant_id);
                    
                    
                    $images = $this->input->post('postimage');
                    
                    if ($images != NULL) {
                        for ($i = 0; $i < count($images); $i++) {
                            $data = array(
                                'image' => $images[$i],
                                'item_id' => $restaurant_id,
                                'item_type' => 'restaurant'
                            );
                            
                            $this->Restaurant_mdl->add_image($data);
                        }
                    }
                    
                    $this->session->set_flashdata('updated_successfully', TRUE);
                    redirect('admin/catalog/restaurant');
                }
        }
        
        $this->_pdata['restaurant'] = $this->Restaurant_mdl->get_restaurant($restaurant_id);
        $restaurant_details = $this->Restaurant_mdl->get_restaurant_details_by_restaurant_id($restaurant_id);
        
        foreach ($restaurant_details as $restaurant_detail) {
            $this->_pdata['restaurant_details'][$restaurant_detail['language_code']] = $restaurant_detail;
        }
        
        // ALL THE CONFIGURATIONS BELOW HERE
        
        $this->_pdata['languages'] = $this->Restaurant_mdl->get_all_languages();
        
        $countries = $this->Restaurant_mdl->get_countries();
        
        $this->_pdata['countries'][''] = '--- Please Select Country ---';
        
        foreach ($countries as $country) {
            $this->_pdata['countries'][$country['id']] = $country['name'];
        }
        
        $cities = $this->Restaurant_mdl->get_cities();
        $this->_pdata['cities'][''] = '--- Please Select City ---';
        
        foreach ($cities as $city) {
            $this->_pdata['cities'][$city['id']] = $city['name'];
        }
        
        $categories = $this->Utility_mdl->get_categories();
        
        $this->_pdata['categories'][''] = '--- Please Select Category ---';
        foreach ($categories as $categeory) {
            $this->_pdata['categories'][$categeory['id']] = $categeory['category_name'];
        }
        
        $agents = $this->Restaurant_mdl->get_agents();
        $this->_pdata['agents'][''] = '--- Please Select Agent ---';
        
        foreach ($agents as $agent) {
            $this->_pdata['agents'][$agent['id']] = $agent['company_legal_name'];
        }
        
        // END OF CONFIGURATIONS
        
        $blockdates = $this->Restaurant_mdl->get_block_dates($restaurant_id);
        $this->_pdata['blocked_dates'] = '';
        foreach ($blockdates as $blockdate) {
            $this->_pdata['blocked_dates'] .=  d_to_lu($blockdate['block_date']) . ",";
        }
        
        $this->_pdata['blocked_dates'] = chop($this->_pdata['blocked_dates'], ",");
        
        // VIEW FILE CALLED BELOW
        $this->template_lib->load_view($this, '__admin_catalog/Restaurant_edit_view', $this->_pdata);
    }
    
    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $restaurant_id = $this->security_lib->decrypt($secure_token);
        $this->load->model('__admin_catalog/Restaurant_mdl');
        $this->Restaurant_mdl->delete_restaurant($restaurant_id);
        
        redirect('admin/catalog/restaurant/index');
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
                $image_path = 'content/image/main/restaurant/';
                
                $config['upload_path'] = './' . $image_path;
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = 'restaurant_img_' . time();
                
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
        
        $this->load->model('__admin_catalog/Restaurant_mdl');
        $data['cities'] = $this->Restaurant_mdl->get_cities_by_country_id($country_id);
        
        $this->output->set_content_type('application/json')->set_output(json_encode($data['cities']));
    }
    
    
}