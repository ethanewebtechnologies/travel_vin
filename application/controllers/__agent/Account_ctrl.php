<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            'form_validation',
            '__prjlib/Template_lib'
        ));
        
        $this->load->helper(array('form'));
		
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load('__agent/Agent_lang', $siteLang);
        $this->lang->load('common', $siteLang);
		
		$this->lang->load('__customer/Registration', $siteLang);
		$this->lang->load('__default/Home', $siteLang);
		$this->lang->load('form_validation', $siteLang);
		$this->lang->load('common', $siteLang);
		
		$this->load->model('__agent/Agent_mdl');
    }
	
	public function add_agent() {
	    
	    if($this->input->post('submit')) {
			$this->session->set_flashdata('country_flash_session',$this->input->post('country'));
			$this->session->set_flashdata('state_flash_session',$this->input->post('state'));
	        $this->form_validation->set_rules('company_legal_name', 'lang:label_company_name', 'trim|required|min_length[3]|max_length[255]', array(
	            'required' => $this->lang->line('required'),
	            'min_length' => $this->lang->line('min_length'),
	            'max_length' => $this->lang->line('max_length')
	        ));
	        
	        $this->form_validation->set_rules('tax_id', 'lang:label_tax_id', 'trim|min_length[3]|max_length[255]', array(
	            'min_length' => $this->lang->line('min_length'),
	            'max_length' => $this->lang->line('max_length')
	        ));
	        
	        $this->form_validation->set_rules('email', 'lang:label_company_email', 'trim|required|is_unique[tv_agent_tbl.email]', array(
	            'required' => $this->lang->line('required'),
	            'is_unique' => $this->lang->line('already_registered')
	        ));
	        
	        $this->form_validation->set_rules('address', 'lang:label_company_address', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('city', 'lang:city', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        
	        $this->form_validation->set_rules('country', 'lang:country', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('state', 'lang:state', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('postal', 'lang:label_postal_code', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('telephone', 'lang:label_telephone', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('admin_fullname', 'lang:label_admin_name', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('admin_contact', 'lang:label_admin_contact', 'trim|required', array(
	            'required' => $this->lang->line('required')
	        ));
	        
	        $this->form_validation->set_rules('admin_email', 'lang:label_admin_email', 'trim|required|is_unique[tv_agent_tbl.admin_email]', array(
	            'required' => $this->lang->line('required'),
	            'is_unique' => $this->lang->line('already_registered')
	        ));
	        
	        $this->form_validation->set_rules('repeat', 'lang:label_admin_confirm_email', 'trim|required|matches[admin_email]', array(
	            'required' => $this->lang->line('required'),
	            'matches' => $this->lang->line('matches')
	        ));

			$this->form_validation->set_rules('business_type[]','lang:label_business_type', 'required', array(
	            'required' => $this->lang->line('required'),
	        ));
	        
	        if($this->form_validation->run()) {
	            $this->load->model('__agent/Agent_mdl');
	            
	            /* $salt = token(9);
	            $secure_password = sha1($salt . sha1($salt . sha1($this->input->post('password'))));
	            
	            $post_data = array(
	                'firstname' => $this->input->post('firstname'),
	                'lastname' => $this->input->post('lastname'),
	                'email' => $this->input->post('email'),
	                'password' => $secure_password,
	                'salt' => $salt,
	                'newsletter_status' => $this->input->post('newsletter_status') ? $this->input->post('newsletter_status') : '0',
	                'is_guest' => TV_GUEST_FALSE,
	                'status' => TV_ON,
	                'approved' => TV_APPROVED,
	                'date_added' => lu_to_d(date('Y-m-d H:i:s')),
	                'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
	                'user_added' => TV_SYSTEM_ID,
	                'user_modified' => TV_SYSTEM_ID
	            );
	            
	            
	            $this->Account_mdl->add_customer($post_data); */
	            $response = $this->Agent_mdl->add_agent($this->input->post());
				$this->load->library('__commonlib/Email_lib');
				//admin mail
				$admin_email_data = array();
				
				$admin_email_data['text_page_tittle'] = $this->lang->line('text_page_tittle');
				$admin_email_data['text_admin_greeting'] = $this->lang->line('text_admin_greeting');
				$admin_email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
				$admin_email_data['text_email_admin'] = $this->lang->line('text_email_admin');
				$admin_email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
				
				$admin_email_data['message'] = $this->lang->line('admin_approve_message');
				$admin_email_data['agent_name'] = $this->lang->line('vendor_name');
				$admin_email_data['agent_email'] = $this->lang->line('vendor_email');
				$admin_email_data['agent_phone'] = $this->lang->line('placeholder_telephone');
				$admin_email_data['postdata'] = $this->input->post();
				$admin_from = ADMIN_EMAIL;
				$admin_from_title = $this->lang->line('text_email_title');
				$admin_to = ADMIN_EMAIL;
				$admin_subject = $this->lang->line('text_email_subject');
				$admin_body = $this->load->view('__email_template/Admin_agent_registeration_email', $admin_email_data, TRUE);
				 if($admin_to != "") {
                    
                    $this->email_lib->send($admin_from, $admin_to, $admin_subject, $admin_body, $admin_from_title, NULL);
                }	            
				
				//vendor mail
				$email_data = array();
				$email_data['customer_name'] = $this->input->post('company_legal_name');				
				
				$email_data['text_page_tittle'] = $this->lang->line('text_page_tittle');
				$email_data['text_customer_greeting'] = $this->lang->line('text_customer_greeting');
				$email_data['text_email_thanks'] = $this->lang->line('text_email_thanks');
				$email_data['text_email_admin'] = $this->lang->line('text_email_admin');
				$email_data['text_email_poweredby'] = $this->lang->line('text_email_poweredby');
				$email_data['text_msg_confirm'] = $this->lang->line('text_msg_confirm');
				$email_data['text_msg_click_here'] = $this->lang->line('text_msg_click_here');
				$email_data['message'] = $this->lang->line('text_email_msg');
                $from = ADMIN_EMAIL;
                $from_title = $this->lang->line('text_email_title');
                $to = $this->input->post('email');
                $subject = $this->lang->line('text_email_subject');
				
                $body = $this->load->view('__email_template/Customer_user_confirmation_email', $email_data, TRUE);
                
                if($to != "") {
                    
                    $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
                }	            
	            redirect('agent/account/success', 'refresh');
	        } else {
	            $this->session->set_flashdata('validation_failed', TRUE);
	        }
	    }
	    
	    $this->_pdata['text_validation_errors'] = $this->lang->line('text_validation_errors');
		
		$this->_pdata['text_h3_add_heading'] = $this->lang->line('text_h3_add_heading');
		
        $this->_pdata['label_company_name'] = $this->lang->line('label_company_name'); 
        $this->_pdata['placeholder_company_name'] = $this->lang->line('placeholder_company_name'); 
		$this->_pdata['label_company_email'] = $this->lang->line('label_company_email'); 
        $this->_pdata['placeholder_company_email'] = $this->lang->line('placeholder_company_email'); 
        $this->_pdata['label_tax_id'] = $this->lang->line('label_tax_id');
        $this->_pdata['placeholder_tax_id'] = $this->lang->line('placeholder_tax_id');
		$this->_pdata['text_user'] = $this->lang->line('text_user');
        $this->_pdata['label_address'] = $this->lang->line('label_address');
        $this->_pdata['placeholder_address'] = $this->lang->line('placeholder_address');
        $this->_pdata['label_City'] = $this->lang->line('label_City');
        $this->_pdata['placeholder_City'] = $this->lang->line('placeholder_City');
		$this->_pdata['label_state'] = $this->lang->line('label_state');
		$this->_pdata['placeholder_state'] = $this->lang->line('label_state');
		$this->_pdata['label_country'] = $this->lang->line('label_country');
		$this->_pdata['placeholder_country'] = $this->lang->line('label_country');
        $this->_pdata['label_postal_code'] = $this->lang->line('label_postal_code');
        $this->_pdata['placeholder_postal_code'] = $this->lang->line('placeholder_postal_code');
        $this->_pdata['label_telephone'] = $this->lang->line('label_telephone');
        $this->_pdata['placeholder_telephone'] = $this->lang->line('placeholder_telephone');
		
        $this->_pdata['label_admin_name'] = $this->lang->line('label_admin_name');
        $this->_pdata['placeholder_admin_name'] = $this->lang->line('placeholder_admin_name');
		$this->_pdata['label_admin_contact'] = $this->lang->line('label_admin_contact');
        $this->_pdata['placeholder_admin_contact'] = $this->lang->line('placeholder_admin_contact');
		$this->_pdata['label_admin_email'] = $this->lang->line('label_admin_email');
        $this->_pdata['placeholder_admin_email'] = $this->lang->line('placeholder_admin_email');
		$this->_pdata['label_admin_confirm_email'] = $this->lang->line('label_admin_confirm_email');
        $this->_pdata['placeholder_admin_confirm_email'] = $this->lang->line('placeholder_admin_confirm_email');
		
        $this->_pdata['label_business_type'] = $this->lang->line('label_business_type');
		
        $this->_pdata['text_status'] = $this->lang->line('text_status');
        $this->_pdata['payment_details'] = $this->lang->line('payment_details');
        $this->_pdata['credit_debit_paypal'] = $this->lang->line('credit_debit_paypal');
        $this->_pdata['expiry_cvv'] = $this->lang->line('expiry_cvv');
        $this->_pdata['card_number'] = $this->lang->line('card_number');
        $this->_pdata['email'] = $this->lang->line('email'); 
		$this->_pdata['text_submit'] = $this->lang->line('text_submit');
		$this->_pdata['text_become_agent'] = $this->lang->line('text_become_agent');
		$this->_pdata['text_agent_profile'] = $this->lang->line('text_agent_profile');
		$this->_pdata['text_agent_contact'] = $this->lang->line('text_agent_contact');
		$this->_pdata['text_agent_general_info'] = $this->lang->line('text_agent_general_info');
		
		$this->_pdata['add_welcome_agent'] = $this->lang->line('add_welcome_agent');
		$this->_pdata['add_register_message'] = $this->lang->line('add_register_message');
		$this->_pdata['add_list_1'] = $this->lang->line('add_list_1');
		$this->_pdata['add_list_2'] = $this->lang->line('add_list_2');
		$this->_pdata['add_list_3'] = $this->lang->line('add_list_3');
		
		$this->_pdata['text_tours'] = $this->lang->line('text_tours');
		$this->_pdata['text_travels'] = $this->lang->line('text_travels');
		$this->_pdata['text_golfs'] = $this->lang->line('text_golfs');
		$this->_pdata['text_clubs_bars'] = $this->lang->line('text_clubs_bars');
		$this->_pdata['text_restaurants'] = $this->lang->line('text_restaurants');
		$this->_pdata['text_weddings'] = $this->lang->line('text_weddings');
		
		$this->template_lib->load_view($this, '__agent/Agent_add', $this->_pdata); 
	}
    
    public function success() {
		$this->_pdata['text_form_success_msg'] = $this->lang->line('text_form_success_msg');
        $this->template_lib->load_view($this,'__agent/Agent_success_view', $this->_pdata); 
    }
}