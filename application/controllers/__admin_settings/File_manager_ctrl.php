<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: File Manager Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class File_manager_ctrl extends CI_Controller {
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array('__prjadminlib/Template_lib'));
        $this->load->helper('form');
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__admin_settings/File_manager', $siteLang);
        $this->lang->load('common', $siteLang);
    }
    
    public function index() {
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        
        $this->template_lib->load_view($this, '__admin_settings/File_manager_view', $this->_pdata);
    }
    
    public function fm_do_upload() {
        
        //$this->load->model('Upload_model');
        $config['upload_path'] = DIR_IMAGE_MAIN . '/';
        $config['allowed_types'] = 'jpg|jpeg|png';
        $config['max_size'] = '204800';
        $this->load->library('upload', $config);
        
        if ( ! $this->upload->do_upload()) {
            $error = array('error' => $this->upload->display_errors());
            
            foreach ($error as $item => $value) {
                echo'<ol class="alert alert-danger"><li>'.$value.'</ol></li>';
            }
            
            exit;
        } else {
            $upload_data = array('upload_data' => $this->upload->data());
            
            foreach ($upload_data as $key => $value) {
                $image =  $value['file_name'];
                $name = preg_replace('/\\.[^.\\s]{3,4}$/', '', $value['file_name']);
                
                $data = array(
                    'path' => $image,
                    'name'=> $name
                );
                
                $this->db->insert('tv_file_catalog_tbl', $data);
            }
            
            echo '<h4 style="color:green">Image uploaded Succesfully</h4>';
            exit;
        }
    }
    
    public function fillGallery() {
        $uploadpath = base_url() . DIR_IMAGE_MAIN . '/';
        $rs = $this->db->get('tv_file_catalog_tbl');
        
        foreach ($rs->result() as $row) {
            $src= $uploadpath . $row->path;
            $alt = $row->name;
            $lid = $row->id . 'g';
            echo "<li class='thumbnail' id='$lid'>
                <span id='$row->id' class='btn btn-info btn-block btn-delete'><i class='glyphicon glyphicon-remove'></i>&nbsp;&nbsp;&nbsp;Delete</span>
                <img src='$src' alt='$alt' style='height: 150px; width: 150px'>
                <span class='btn btn-warning btn-block'>$alt</span></li>";
        }
    }
    
    public function deleteimg() {
        $this->db->where('id', $this->input->get('id'));
        $this->db->delete('tv_file_catalog_tbl');
        echo'<h4 style="color:green">This image deleted successfully</h4>';
        exit;
    }
}