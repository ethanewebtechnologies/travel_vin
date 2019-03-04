<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Vendor_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        $this->load->library(array('form_validation','__prjlib/Template_lib','__prjlib/Header_lib', '__prjlib/Footer_lib'));
        $this->load->helper('form');
        
    }
    
    public function index() {
        
        $this->load->model('__vendor/Vendor_mdl');
        
        $this->_pdata['users'] = array();
        $users = $this->Vendor_mdl->getVendors();
        //echo "<pre>";print_r($users);exit;
        if($users) {
            $this->_pdata['users'] = $users;
        }
        //exit('hello');
        $this->_pdata['text_h3_heading'] = $this->lang->line('text_h3_heading');
        $this->_pdata['text_sn'] = $this->lang->line('text_sn');
        $this->_pdata['text_uname'] = $this->lang->line('text_uname');
        $this->_pdata['text_action'] = $this->lang->line('text_action');
        $this->_pdata['text_add'] = $this->lang->line('text_add');
        $this->_pdata['text_edit'] = $this->lang->line('text_edit');
        $this->_pdata['text_delete'] = $this->lang->line('text_delete');
        $this->_pdata['text_no_result'] = $this->lang->line('text_no_result');
        $this->_pdata['text_email'] = $this->lang->line('text_uemail');
        $this->_pdata['text_type'] = $this->lang->line('text_type');
        $this->_pdata['text_status'] = $this->lang->line('text_status');
        //$this->template_lib->load_view($this, '__vendor/Vendor_add_view', $this->_pdata);
		/* $this->header_lib->get_header($this);	
        $this->load->view('__vendor/Vendor_add_view', $this->_pdata);
	    $this->footer_lib->get_footer($this); */
    }
	
    public function add() {
        
        $this->load->model('__admin_users/User_mdl');
		
        $this->_pdata['text_h3_add_heading'] = $this->lang->line('text_h3_add_heading');
        $this->_pdata['text_add_ufname'] = $this->lang->line('text_add_ufname');
        $this->_pdata['text_add_ulname'] = $this->lang->line('text_add_ulname');
        $this->_pdata['text_add_uemail'] = $this->lang->line('text_add_uemail');
        $this->_pdata['text_add_upwd'] = $this->lang->line('text_add_upwd');
        $this->_pdata['text_add_ucpwd'] = $this->lang->line('text_add_ucpwd');
        $this->_pdata['text_add_utype'] = $this->lang->line('text_add_utype');
        $this->_pdata['text_submit'] = $this->lang->line('text_submit');
        $this->_pdata['text_add_puname'] = $this->lang->line('text_add_puname');
        $this->_pdata['text_add_plname'] = $this->lang->line('text_add_plname');
        $this->_pdata['text_add_pemail'] = $this->lang->line('text_add_pemail');
        $this->_pdata['text_add_ppwd'] = $this->lang->line('text_add_ppwd');
        $this->_pdata['text_add_pcpwd'] = $this->lang->line('text_add_pcpwd');
        $this->_pdata['text_status'] = $this->lang->line('text_status');			
        
        if($this->input->post()) {
			//echo "<pre>";print_r($this->input->post());exit;			
        $this->form_validation->set_rules('fname', 'Firstname', 'trim|required|max_length[32]',
        array('required'=>'Error: Firstname is Required.','max_length'=>'Error: First contail not more than 32 characters.'));
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[ 	tv_user_tbl.email]',array('required'=>'Error: Email is Required.','valid_email'=>'Error: Email Must Be valid Email.','is_unique'=>'Error: User With Same Email is already exist.'));
		//$this->form_validation->set_rules('pwd', 'Password', 'required|min_length[5]',array('required'=>'Error: Password is Required.','min_length'=>'Error: Password must contain minimum 5 characters.'));
		//$this->form_validation->set_rules('cpwd', 'Password Confirmation', 'required|matches[pwd]',array('required'=>'Password Confirmation is Required.','matches' => 'Error: Password Not Confirm'));
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('msg-error', validation_errors());

		} else {
            $this->User_mdl->adduser($this->input->post());
			$this->session->set_flashdata('msg-success',sprintf($this->lang->line('text_add_success'),$this->lang->line('text_user')));
            redirect('admin/users/users');
		}						
        }				       
        $this->template_lib->load_view($this, '__admin_users/User_add_view', $this->_pdata);
	}
	  
	public function edit($userid) {
        
        $this->load->model('__admin_users/User_mdl');
		
        $this->_pdata['text_h3_edit_heading'] = $this->lang->line('text_h3_edit_heading');
        $this->_pdata['text_add_ufname'] = $this->lang->line('text_add_ufname');
        $this->_pdata['text_add_ulname'] = $this->lang->line('text_add_ulname');
        $this->_pdata['text_add_uemail'] = $this->lang->line('text_add_uemail');
        $this->_pdata['text_add_upwd'] = $this->lang->line('text_add_upwd');
        $this->_pdata['text_add_ucpwd'] = $this->lang->line('text_add_ucpwd');
        $this->_pdata['text_add_utype'] = $this->lang->line('text_add_utype');
        $this->_pdata['text_submit'] = $this->lang->line('text_submit');
        $this->_pdata['text_add_puname'] = $this->lang->line('text_add_puname');
        $this->_pdata['text_add_plname'] = $this->lang->line('text_add_plname');
        $this->_pdata['text_add_pemail'] = $this->lang->line('text_add_pemail');
        $this->_pdata['text_add_ppwd'] = $this->lang->line('text_add_ppwd');
        $this->_pdata['text_add_pcpwd'] = $this->lang->line('text_add_pcpwd');
        $this->_pdata['text_status'] = $this->lang->line('text_status');  
		
        if($this->input->post()) {
            $this->Page_mdl->updatepage($this->input->post(), $pageid);
            redirect('admin/information/page/showall');
        }
        
		$this->_pdata['userdata'] = $this->User_mdl->getuserdetails($userid);
        $this->template_lib->load_view($this, '__admin_information/Page_edit_view', $this->_pdata);
    }
	

	
	public function delete($pageid) {
        $this->load->model('__admin_information/Page_mdl');	
        $this->Page_mdl->delete_page($pageid);
        
        redirect('admin/information/page/showall');
    }
	
}