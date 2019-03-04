<?php

function generate_pagination($obj, $pagination_url, $total_pages, $limit, $search_parameter = array()) {
    
    if(isset($search_parameter) && !empty($search_parameter)) { 
        $search_para_str = '?res=1';
        
        foreach ($search_parameter as $parameter_key => $parameter_value) {
            $search_para_str .= '&' . $parameter_key . '=' . $parameter_value;
        }
        
        $config['base_url'] = base_url($pagination_url.$search_para_str);
    } else {
        $config['base_url'] = base_url($pagination_url);
    }
   
    $config['suffix'] = '';
    $config['total_rows'] = $total_pages;
    $config['per_page'] = $limit;
    $config['enable_query_strings'] = true;
    $config['page_query_string'] = true;
    
    // config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    
    $obj->load->library('pagination');
    $obj->pagination->initialize($config);
    return $obj->pagination->create_links();
}

function generate_pagination_for_front($obj, $pagination_url, $total_pages, $limit) {
	
    $config['base_url'] = base_url($pagination_url);
	
    $config['suffix'] = '';
    $config['total_rows'] = $total_pages;
    $config['per_page'] = $limit;
    $config['enable_query_strings'] = true;
    $config['page_query_string'] = true;
    
    // config for bootstrap pagination class integration
    $config['full_tag_open'] = '<ul>';
    $config['full_tag_close'] = '</ul>';
    $config['first_link'] = false;
    $config['last_link'] = false;
    $config['first_tag_open'] = '<li>';
    $config['first_tag_close'] = '</li>';
    $config['prev_link'] = '&laquo';
    $config['prev_tag_open'] = '<li class="prev">';
    $config['prev_tag_close'] = '</li>';
    $config['next_link'] = '&raquo';
    $config['next_tag_open'] = '<li>';
    $config['next_tag_close'] = '</li>';
    $config['last_tag_open'] = '<li>';
    $config['last_tag_close'] = '</li>';
    $config['cur_tag_open'] = '<li class="active"><a href="">';
    $config['cur_tag_close'] = '</a></li>';
    $config['num_tag_open'] = '<li>';
    $config['num_tag_close'] = '</li>';
    
    $obj->load->library('pagination');
    $obj->pagination->initialize($config);
	
    return $obj->pagination->create_links();
}