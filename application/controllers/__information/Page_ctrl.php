<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Page_ctrl extends CI_Controller {
    public function __construct()	{
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE 
        $this->load->library(array('__prjlib/Header_lib', '__prjlib/Footer_lib'));
        $this->load->helper(array('form'));
    }

	public function get_page($page_url) {
        $this->load->model('__information/Information_mdl');
        $this->_pdata['page'] = $this->Information_mdl->getpage($page_url);
        
        if(empty($this->_pdata['page'])) {
           redirect('not-found'); 
        }
        
        $meta_content[] = array(
            'property' => 'og:type',
            'content' => 'Website'
        );
        
        $meta_content[] = array(
            'property' => 'og:title',
            'content' => 'Travel'
        );
        
        $this->header_lib->set_meta_content($meta_content);
        
        $this->header_lib->get_header($this);	
        $this->load->view('__information/Page_view', $this->_pdata);
	    $this->footer_lib->get_footer($this);
    }
}
