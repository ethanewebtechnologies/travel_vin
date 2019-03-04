<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sidebar_lib {

    private $_pdata = array();
    
    public function get_sidebar($obj, $data = array()) {
        $siteLang = $obj->session->userdata('site_lang');
        $obj->lang->load('__vendor_home/Sidebar', $siteLang);
        $this->_pdata = $data;
        if($obj->session->has_userdata('vendor')) {
            $vendor = $obj->session->userdata('vendor');
            $vendor_id = $vendor['id'];
        } else {
            $vendor = false;
            $vendor_id = false;
            
            redirect('vendor/account/login');
        }
        
        $obj->load->model('__vendor_dashboard/Dashboard_mdl');
        $this->_pdata['business_type'] = $obj->Dashboard_mdl->get_vendor_business_type($vendor_id);
        
        $obj->load->helper('breadcrumb');
        
        $this->_pdata['default_language'] = array(
            'code' => $siteLang,
            'name' => 'English',
            'image' => base_url('assets/admin/images/flags/flag-en.png')
        );
        
        $this->_pdata['languages'] = array(
            array(
                'code' => 'ch',
                'name' => $obj->lang->line('text_chinese'),
                'image' => base_url('assets/admin/images/flags/flag-ch.png')
            ),
            array(
                'code' => 'en',
                'name' => $obj->lang->line('text_english'),
                'image' => base_url('assets/admin/images/flags/flag-en.png')
            ),
            array(
                'code' => 'fr',
                'name' => $obj->lang->line('text_french'),
                'image' => base_url('assets/admin/images/flags/flag-fr.png')
            ),
            array(
                'code' => 'gr',
                'name' => $obj->lang->line('text_german'),
                'image' => base_url('assets/admin/images/flags/flag-gr.png')
            ),
            array(
                'code' => 'it',
                'name' => $obj->lang->line('text_italian'),
                'image' => base_url('assets/admin/images/flags/flag-it.png')
            ),
            array(
                'code' => 'jp',
                'name' => $obj->lang->line('text_japnese'),
                'image' => base_url('assets/admin/images/flags/flag-jp.png')
            ),
            array(
                'code' => 'pr',
                'name' => $obj->lang->line('text_portuguese'),
                'image' => base_url('assets/admin/images/flags/flag-pr.png')
            ),
            array(
                'code' => 'ru',
                'name' => $obj->lang->line('text_russian'),
                'image' => base_url('assets/admin/images/flags/flag-ru.png')
            ),
            array(
                'code' => 'sp',
                'name' => $obj->lang->line('text_spanish'),
                'image' => base_url('assets/admin/images/flags/flag-sp.png')
            )
        );
        
        $obj->load->view('__vendor_home/Dashboard_sidebar_view', $this->_pdata);
    }
}
