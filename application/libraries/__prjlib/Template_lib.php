<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_lib {
    
    public function load_view($obj, $view, $data = array()) {
        $obj->load->library(array(
            '__prjlib/Header_lib',
            '__prjlib/Footer_lib'
        ));
        
        $obj->header_lib->get_header($obj);
        $obj->load->view($view, $data);
        $obj->footer_lib->get_footer($obj);
    }
}
