<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Translate_ctrl extends CI_Controller
{
    public function __construct() {
        parent::__construct();
    }
    
    public function change_language() {
        $lang_code = $this->input->get('lang_code');
        
        if(strlen($lang_code) > 0) {
            $this->session->set_userdata('site_lang', $lang_code);
        } else {
            $this->session->set_userdata('site_lang', "en");
        }
        
        if($this->input->get('redirect_url')) {
            redirect($this->input->get('redirect_url'));
        } 
        
        redirect($_SERVER['HTTP_REFERER']);
    }
}