<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct()
    {
        parent::__construct();
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
			'__commonlib/Security_lib',
        ));
        
        $this->load->helper(array('form'));
        $this->load->model('__admin_default/Accounts_mdl');
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__admin_default/Login', $siteLang);
    }
    
    public function index()
    {
        if($this->session->has_userdata('user')) {
			redirect('admin/default/dashboard');
		}
		
		$this->login();
    }

	
    // First Time Registration
    public function first_reg() {
		
        $this->form_validation->set_rules('firstname', 'Firstname', 'trim|required|max_length[32]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'required');
		$this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|matches[password]');
		
		if ($this->form_validation->run() == FALSE) {
			$this->template_lib->load_view_before_login($this, '__admin_default/first_reg_view');
			
		} else {
			$userid = $this->Accounts_mdl->reg_admin($this->input->post());
			redirect('admin/default/login/login');
		}
    }
		
	public function login() { 
		if($this->session->has_userdata('user')) {
			redirect('admin/default/dashboard');
		}
		
		// SET LANGUAGE PARAMETERS
		$this->_pdata['text_email'] = $this->lang->line('text_email');
		$this->_pdata['text_email_label'] = $this->lang->line('text_email_label');
		$this->_pdata['text_password'] = $this->lang->line('text_password');
		$this->_pdata['text_password_label'] = $this->lang->line('text_password_label');
		$this->_pdata['text_submit'] = $this->lang->line('text_submit');
		
	    $query = $this->db->select('1')->from('tv_user_tbl')->get();
	    
        if($query->num_rows() > 0) {
            if ($this->input->post()) {
                $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
                $this->form_validation->set_rules('password', 'Password', 'required');
	            
                if ($this->form_validation->run() == FALSE) {
                    $this->session->set_flashdata('error_msg', validation_errors());
                    
                    $this->template_lib->load_view_before_login($this, '__admin_default/Login_view');
                    
                } else {
                    $login = $this->Accounts_mdl->login_admin($this->input->post('email'), $this->input->post('password'));
	               
	               if ($login) {
	                   $prevurl = $this->session->userdata('prev_url');
	                   
	                   if(isset($prevurl) && strlen($prevurl) > 0) {
	                       $url = $prevurl;
	                   } else {
	                       $url = 'admin/default/dashboard';
	                   }
	                   
	                   redirect($url, 'refresh');
	                } else {
	                    $this->session->set_flashdata('error_msg', 'Invalid Login Credentials');
	                    $this->template_lib->load_view_before_login($this, '__admin_default/Login_view');
	                }
                }
            } else {
                $this->template_lib->load_view_before_login($this, '__admin_default/Login_view');
            }
		} else {
		    $this->template_lib->load_view_before_login($this, '__admin_default/First_reg_view');
		}
    }

	public function setpass() { 

	$userstatus = $this->Accounts_mdl->reg_validate($this->input->get('token'));
	$decacc= $this->security_lib->decrypt($this->input->get('token'));
	$deacc_data=explode('/',$decacc);
	$this->_pdata['user_mail'] = $deacc_data[2];
	$this->_pdata['uid'] = $deacc_data[0];
	$this->_pdata['token'] = $this->input->get('token');	
	if ($this->input->post()) {
		
		$this->form_validation->set_rules('password', 'Password', 'trim|required|min_length[5]',array('required'=>'Error: Password is Required.','min_length'=>'Error: Password must contain minimum 5 characters.'));
		$this->form_validation->set_rules('cpassword', 'Password Confirmation','required|matches[password]',array('required'=>'Password Confirmation is Required.','matches' => 'Error: Password Not Confirm'));
		
		if ($this->form_validation->run() == FALSE) {
			$this->session->set_flashdata('error_msg', validation_errors());
	
		} else {
			
			$setupd=$this->Accounts_mdl->set_useraccess($this->input->post());
			$this->session->set_flashdata('msg-success', 'Your Password is set Successfully Now You Eligible to Login');
			redirect('admin/default/login');	

		}
	}
	if($userstatus==1){
	$this->template_lib->load_view_before_login($this, '__admin_default/Setpassword_view',$this->_pdata);	
	}else if($userstatus==2){
		exit('Access Token Expired.');
	}else{
		exit('Access Token Not Valid.');
	}
	//$this->template_lib->load_view_before_login($this, '__admin_default/Setpassword_view',$this->_pdata);
    }
	
	public function setpassword() { 
	
	$userstatus = $this->Accounts_mdl->reg_validate($this->input->get('token'));
	$decacc= $this->security_lib->decrypt($this->input->get('token'));
	$deacc_data=explode('/',$decacc);
	$this->_pdata['user_mail'] = $deacc_data[2];
	$this->_pdata['uid'] = $deacc_data[0];
	$this->_pdata['token'] = $this->input->get('token');
	if($userstatus==1){
	$this->template_lib->load_view_before_login($this, '__admin_default/Setpassword_view',$this->_pdata);	
	}else if($userstatus==2){
		exit('Access Token Expired.');
	}else{
		exit('Access Token Not Valid.');
	}
	//echo "<pre>";print_r($login);exit;
    }	
	
	public function logout() {	
		$this->session->unset_userdata('user');
		redirect('admin/default/login');
    }	
}
