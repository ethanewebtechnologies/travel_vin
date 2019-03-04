<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Information_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib'
        ));
        
		$this->load->helper('form');
        $this->lang->load('common', 'en');
    }
  
    public function add() {
        $this->load->model('__admin_catalog/Information_mdl');
        
        if($this->input->post()) {
            $this->Information_mdl->add_information($this->input->post());
            redirect('admin/catalog/information');
		}
		
		$this->_pdata['languages'] = $this->Information_mdl->get_all_languages();
        $this->template_lib->load_view($this, '__admin_catalog/Information_add_view', $this->_pdata);
  	}
}
