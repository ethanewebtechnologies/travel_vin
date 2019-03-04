<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Registration Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Registration_ctrl extends CI_Controller {
    
    /* private instance an array */
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        if($this->session->has_userdata('customer')) {
            redirect(base_url(), 'referesh');
        }
        
        // ANY DEFAULT LOADING HERE
        $this->load->library(array(
            '__prjlib/Template_lib',
            'form_validation',
        ));
        
        $this->load->helper(array(
            'form', 
            'dt',
            'encryption'
        ));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load('__customer/Registration', $siteLang);
        $this->lang->load('common', $siteLang);
        $this->lang->load('__default/Home', $siteLang);
        $this->lang->load('form_validation', $siteLang);
    }
    
    public function index() {
        
        if($this->input->post('submit')) {
            $this->form_validation->set_rules('firstname', 'lang:text_firstname', 'trim|required|min_length[3]|max_length[255]', array(
                'required' => $this->lang->line('required'),
                'min_length' => $this->lang->line('min_length'),
                'max_length' => $this->lang->line('max_length')
            ));
            
            $this->form_validation->set_rules('lastname', 'lang:text_lastname', 'trim|min_length[3]|max_length[255]', array(
                'min_length' => $this->lang->line('min_length'),
                'max_length' => $this->lang->line('max_length')
            ));
            
            $this->form_validation->set_rules('email', 'lang:text_email', 'trim|required|is_unique[tv_customer_tbl.email]', array(
                'required' => $this->lang->line('required'),
                'is_unique' => $this->lang->line('already_registered')
            ));
            
            $this->form_validation->set_rules('repeat', 'lang:text_repeat_email', 'trim|required|matches[email]', array(
                'required' => $this->lang->line('required'),
                'matches' => $this->lang->line('matches')
            ));
            
            $this->form_validation->set_rules('password_confirmation', 'lang:text_password', 'trim|required', array(
                'required' => $this->lang->line('required')
            ));
            
            $this->form_validation->set_rules('password', 'lang:text_repeat_password', 'trim|required|matches[password_confirmation]', array(
                'required' => $this->lang->line('required'),
                'matches' => $this->lang->line('matches')
            ));
            
            $this->form_validation->set_rules('telephone', 'lang:text_telephone', 'trim|required', array(
                'required' => $this->lang->line('required')
            ));
            
            if($this->form_validation->run()) {
                $this->load->model('__customer/Account_mdl');
                
                $salt = token(9);
                $secure_password = sha1($salt . sha1($salt . sha1($this->input->post('password_confirmation'))));
                
                $post_data = array(
                    'firstname' => ucfirst($this->input->post('firstname')),
                    'lastname' => ucfirst($this->input->post('lastname')),
                    'email' => $this->input->post('email'),
                    'telephone' => $this->input->post('telephone'),
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
                
                $this->Account_mdl->add_customer($post_data);
				
				/* if($this->input->post('newsletter_status') == 1){
					$this->load->model('__customer/Subscription_mdl');
					$data = array(
						'subscriber_email'=>$this->input->post('email'),
						'subscription_type'=>'Newsletter',
					)
					$this->Subscription_mdl->subscribe_email($data);
				} */
				
				$email_data = array();
				$email_data['customer_name'] = ucfirst($this->input->post('firstname')).' '.ucfirst($this->input->post('lastname'));
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
                    $this->load->library('__commonlib/Email_lib');
                    $this->email_lib->send($from, $to, $subject, $body, $from_title, NULL);
                }
				
                redirect('customer/dashboard', 'referesh');
            } else {
                $this->session->set_flashdata('validation_failed', TRUE);
            }
        }
        
        $this->_pdata['text_validation_errors']             = $this->lang->line('text_validation_errors');
        
        $this->_pdata['text_label_firstname']               = $this->lang->line('text_label_firstname');
        $this->_pdata['text_label_lastname']                = $this->lang->line('text_label_lastname');
        $this->_pdata['text_label_email']                   = $this->lang->line('text_label_email');
        $this->_pdata['text_label_repeat_email']            = $this->lang->line('text_label_repeat_email');
        $this->_pdata['text_label_password']                = $this->lang->line('text_label_password');
        $this->_pdata['text_label_repeat_password']         = $this->lang->line('text_label_repeat_password');
        $this->_pdata['text_label_telephone']               = $this->lang->line('text_label_telephone');
        $this->_pdata['text_label_gender']                  =     $this->lang->line('text_label_gender');
        
        $this->_pdata['text_placeholder_firstname']         = $this->lang->line('text_placeholder_firstname');
        $this->_pdata['text_placeholder_lastname']          = $this->lang->line('text_placeholder_lastname');
        $this->_pdata['text_placeholder_email']             = $this->lang->line('text_placeholder_email');
        $this->_pdata['text_placeholder_repeat_email']      = $this->lang->line('text_placeholder_repeat_email');
        $this->_pdata['text_placeholder_password']          = $this->lang->line('text_placeholder_password');
        $this->_pdata['text_placeholder_repeat_password']   = $this->lang->line('text_placeholder_repeat_password');
        $this->_pdata['text_placeholder_telephone']         = $this->lang->line('text_placeholder_telephone');
        
        $this->_pdata['text_your_profile_details']          = $this->lang->line('text_your_profile_details');
        $this->_pdata['text_join_journey_with_us']          = $this->lang->line('text_join_journey_with_us');
        $this->_pdata['text_t_n_c']                         = $this->lang->line('text_t_n_c');
        $this->_pdata['text_newsletter']                    = $this->lang->line('text_newsletter');
        $this->_pdata['text_newsletter_subscription']       = $this->lang->line('text_newsletter_subscription');
        
        $this->_pdata['text_t_n_c_details1']                = $this->lang->line('text_t_n_c_details1');
        $this->_pdata['text_t_n_c_details2']                = $this->lang->line('text_t_n_c_details2');
        
        $this->_pdata['text_content_submit']                = $this->lang->line('text_content_submit');
		
		$this->_pdata['gender_array'] = array(
			'' => $this->lang->line('text_no_gender'),
			'0' => $this->lang->line('text_male'),
			'1' => $this->lang->line('text_female'),
		);
        
        $this->template_lib->load_view($this, '__customer/Registration_view', $this->_pdata);
    }
}