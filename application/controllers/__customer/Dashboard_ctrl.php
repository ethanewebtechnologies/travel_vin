<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Customer Dashboard Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR, BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Dashboard_ctrl extends CI_Controller {
    /* private instance an array */

    private $_pdata = array();

    public function __construct() {
        parent::__construct();
		
		if(!$this->session->has_userdata('customer')) {
            redirect(base_url(), 'referesh');
        }

        // ANY DEFAULT LOADING HERE
        $this->load->library(array('form_validation','__prjlib/Header_lib', '__prjlib/Footer_lib', '__prjlib/Template_lib'));
        $this->load->helper(array('form', 'dt',
            'Encryption'));
		
		$siteLang = $this->session->userdata('site_lang');
        $this->lang->load('__customer/Customer', $siteLang);
		$this->lang->load('form_validation', $siteLang);
    }

    public function index() {
		$this->load->model('__customer/Dashboard_mdl');
		$this->_pdata['text_profile'] = $this->lang->line('text_profile');
		$this->_pdata['text_order_history'] = $this->lang->line('text_order_history');
		$this->_pdata['text_invoice'] = $this->lang->line('text_invoice');
		$this->_pdata['text_address'] = $this->lang->line('text_address');
		$this->_pdata['text_change_password'] = $this->lang->line('text_change_password');
		$this->_pdata['text_name'] = $this->lang->line('text_name');
		$this->_pdata['text_age'] = $this->lang->line('text_age');
		$this->_pdata['text_gender'] = $this->lang->line('text_gender');
		$this->_pdata['text_contact'] = $this->lang->line('text_contact');
		$this->_pdata['text_edit'] = $this->lang->line('text_edit');
		
		//INVOICE
		$this->_pdata['text_Invoice'] = $this->lang->line('text_Invoice');
		$this->_pdata['text_Invoice_name'] = $this->lang->line('text_Invoice_name');
		$this->_pdata['text_Invoice_date'] = $this->lang->line('text_Invoice_date');
		$this->_pdata['text_Action'] = $this->lang->line('text_Action');
		
		//Address
		$this->_pdata['text_address_hash'] = $this->lang->line('text_address_hash');
		$this->_pdata['text_address_type'] = $this->lang->line('text_address_type');
		$this->_pdata['text_address'] = $this->lang->line('text_address');
		$this->_pdata['text_Action'] = $this->lang->line('text_Action');
		$this->_pdata['text_Action'] = $this->lang->line('text_Action');
		$this->_pdata['text_no_address'] = $this->lang->line('text_no_address');
		
		$this->_pdata['text_label_my_dashboard'] = $this->lang->line('text_label_my_dashboard');
		$this->_pdata['text_label_add_address'] = $this->lang->line('text_label_add_address');
		$this->_pdata['text_label_edit_address'] = $this->lang->line('text_label_edit_address');
		$this->_pdata['text_label_edit_profile'] = $this->lang->line('text_label_edit_profile');
		
		$this->_pdata['text_placeholder_current_password'] = $this->lang->line('text_placeholder_current_password');
		$this->_pdata['text_placeholder_new_password_confirmation'] = $this->lang->line('text_placeholder_new_password_confirmation');
		$this->_pdata['text_placeholder_new_password'] = $this->lang->line('text_placeholder_new_password');
		
		$this->_pdata['text_placeholder_address1'] = $this->lang->line('text_placeholder_address1');
		$this->_pdata['text_placeholder_address2'] = $this->lang->line('text_placeholder_address2');
		$this->_pdata['text_placeholder_city'] = $this->lang->line('text_placeholder_city');
		$this->_pdata['text_placeholder_postcode'] = $this->lang->line('text_placeholder_postcode');
		$this->_pdata['text_placeholder_firstname'] = $this->lang->line('text_placeholder_firstname');
		$this->_pdata['text_placeholder_lastname'] = $this->lang->line('text_placeholder_lastname');
		$this->_pdata['text_placeholder_email'] = $this->lang->line('text_placeholder_email');
		$this->_pdata['text_placeholder_dob'] = $this->lang->line('text_placeholder_dob');
		$this->_pdata['text_placeholder_telephone'] = $this->lang->line('text_placeholder_telephone');
		
		$this->_pdata['text_content_submit'] = $this->lang->line('text_content_submit');
		$this->_pdata['text_content_cancel'] = $this->lang->line('text_content_cancel');
		
		$this->_pdata['address_type'] = array(
			'' => $this->lang->line('text_address_none'),
			'Home' => $this->lang->line('text_address_home'),
			'Work' => $this->lang->line('text_address_work'),
			'Other' => $this->lang->line('text_address_other'),
		);
		
		$this->_pdata['gender_array'] = array(
			'' => $this->lang->line('text_no_gender'),
			'0' => $this->lang->line('text_male'),
			'1' => $this->lang->line('text_female'),
		);
		
		if($this->input->post('update')){
			$this->form_validation->set_rules('firstname', 'lang:text_firstname', 'trim|required|min_length[3]|max_length[32]', array(
				'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			
			$this->form_validation->set_rules('lastname', 'lang:text_lastname', 'trim|min_length[3]|max_length[32]', array(
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			$this->form_validation->set_rules('email', 'lang:text_email', 'trim|required|callback_email_exists', array(
                'required' => $this->lang->line('required'),
                'email_exists' => $this->lang->line('email_exist'),
            ));
			$this->form_validation->set_rules('date_of_birth', 'lang:text_dob', 'trim|required|callback_age_limit_validation', array(
                'required' => $this->lang->line('required'),
                'age_limit_validation' => $this->lang->line('age_limit'),
            ));
			$this->form_validation->set_rules('gender', 'lang:text_gender', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('contact', 'lang:text_contact', 'trim|required|min_length[10]|max_length[10]', array(
                'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('phone_min_length'),
				'max_length' => $this->lang->line('phone_max_length'),
            ));
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
				$this->session->set_flashdata('addr-error', $this->lang->line('form_data_error'));
            } 
			else {
				$return = $this->Dashboard_mdl->update_customer_profile($this->input->post());
				if($return){
					$this->session->set_flashdata('addr-success', $this->lang->line('form_data_success'));
				}
				else{
					$this->session->set_flashdata('addr-error', $this->lang->line('form_post_erroe'));
				}
				redirect('customer/dashboard');
			}
		}
		
		if($this->input->post('add_address') && $this->input->post('add_address') == 'add_address'){
			$this->form_validation->set_rules('type', 'lang:text_address_type', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('address_1', 'lang:text_address1', 'required|min_length[3]|max_length[255]', array(
				'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			$this->form_validation->set_rules('address_2', 'lang:text_address2', 'min_length[3]|max_length[255]', array(
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			$this->form_validation->set_rules('country', 'lang:text_country', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('state', 'lang:text_state', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('city', 'lang:text_city', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('postcode', 'lang:text_postcode', 'trim|required|min_length[6]|max_length[6]', array(
                'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('postcode_min_length'),
				'max_length' => $this->lang->line('postcode_max_length'),
            ));
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
				$this->session->set_flashdata('addr-error', $this->lang->line('form_data_error'));
            } 
			else {
				$return = $this->Dashboard_mdl->add_customer_address($this->input->post());
				if($return){
					$this->session->set_flashdata('addr-success', $this->lang->line('form_data_success'));
				}
				else{
					$this->session->set_flashdata('addr-error', $this->lang->line('form_post_erroe'));
				}
				redirect('customer/dashboard');
			}
		}
		
		if($this->input->post('update_address')){
			$this->form_validation->set_rules('type', 'lang:text_address_type', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('address_1', 'lang:text_address1', 'required|min_length[3]|max_length[255]', array(
				'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			$this->form_validation->set_rules('address_2', 'lang:text_address2', 'min_length[3]|max_length[32]', array(
				'min_length' => $this->lang->line('min_length'),
				'max_length' => $this->lang->line('max_length')
			));
			$this->form_validation->set_rules('country', 'lang:text_country', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('state', 'lang:text_state', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('city', 'lang:text_city', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('postcode', 'lang:text_postcode', 'trim|required|min_length[6]|max_length[6]', array(
                'required' => $this->lang->line('required'),
				'min_length' => $this->lang->line('postcode_min_length'),
				'max_length' => $this->lang->line('postcode_max_length'),
            ));
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
				$this->session->set_flashdata('addr-error', $this->lang->line('form_data_error'));
            }
			else {
				$return = $this->Dashboard_mdl->update_customer_address($this->input->post());
				if($return){
					$this->session->set_flashdata('addr-success', $this->lang->line('form_data_success'));
				}
				else{
					$this->session->set_flashdata('addr-error', $this->lang->line('form_post_erroe'));
				}
				redirect('customer/dashboard');
			}
		}
		
		if($this->input->post('change_password') && $this->input->post('change_password')=='change_password'){
			$this->form_validation->set_rules('password', 'lang:text_current_password', 'trim|required|callback_validate_old_password', array(
                'required' => $this->lang->line('required'),
                'validate_old_password' => $this->lang->line('invalid_password')
            ));
			$this->form_validation->set_rules('new_password_confirmation', 'lang:text_new_password_confirmation', 'trim|required', array(
                'required' => $this->lang->line('required'),
            ));
			$this->form_validation->set_rules('new_password', 'lang:text_new_password', 'trim|required|matches[new_password]', array(
                'required' => $this->lang->line('required'),
                'matches' => $this->lang->line('matches')
            ));
			if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('msg-error', validation_errors());
				$this->session->set_flashdata('addr-error', $this->lang->line('form_password_error'));
            } 
			else {
				$return = $this->Dashboard_mdl->change_customer_password($this->input->post('new_password'));
				if($return){
					$this->session->set_flashdata('addr-success', $this->lang->line('form_password_success'));
				}
				else{
					$this->session->set_flashdata('addr-error', $this->lang->line('form_password_post_erroe'));
				}
				redirect('customer/dashboard');
			}
		}
		
		$this->_pdata['customer_addresses'] = $this->Dashboard_mdl->get_customer_addresses();
		$this->_pdata['customer_profile'] = $this->Dashboard_mdl->get_customer_profile();
		$this->_pdata['gender'] = $this->_pdata['customer_profile']['gender']=='0'?$this->lang->line('text_male'):$this->lang->line('text_female');
		$this->_pdata['age'] = $this->GetAge($this->_pdata['customer_profile']['date_of_birth']);
		
        $this->template_lib->load_view($this, '__customer/Dashboard_view', $this->_pdata);
    }
	
	public function get_customer_orders_histry_ajax(){
		if($this->input->is_ajax_request()) {
			$this->load->model('__customer/Dashboard_mdl');
			$this->_pdata['customer_orders'] = $this->Dashboard_mdl->get_customer_orders();
			//pr($this->_pdata['customer_orders']);
			echo $this->load->view('__customer/Order_history_list_view', $this->_pdata, TRUE);
		}
		else {
		    exit('No direct script access allowed');
		}
	}
	
	public function get_customer_addresses_histry_ajax(){
		if($this->input->is_ajax_request()) {
			$this->load->model('__customer/Dashboard_mdl');
			$this->_pdata['customer_addresses'] = $this->Dashboard_mdl->get_customer_addresses();
			echo $this->load->view('__customer/Address_list_view', $this->_pdata, TRUE);
		}
		else {
		    exit('No direct script access allowed');
		}
	}

    public function delete_address() {
        // THIS FUNCTION WILL DELTE CUSTOMER ADDRESS
        $this->load->model('__customer/Dashboard_mdl');
        $this->Dashboard_mdl->delete_customer_address();
    }

    public function get_invoice() {
        $__seoUrtcuRe = $this->input->post('__seoUrtcuRe');
        $tour_id = $this->security_lib->decrypt($__seoUrtcuRe);

        // THIS FUNCTION WILL FETCH INVOICE DETAILS
        $this->load->model('__customer/Dashboard_mdl');
        $this->Dashboard_mdl->get_invoice_details($tour_id);
    }
	
	private	function GetAge($dob) {
		if(!empty($dob)){
			$initial_dob = $dob;
			$dob=explode("-",$dob);	
			$curMonth = date("m");
			$curDay = date("j");
			$curYear = date("Y");
			$age = $curYear - $dob[0]; 
			if($curMonth<$dob[1] || ($curMonth==$dob[1] && $curDay<$dob[2])) {
				$age--;
			}
			if($initial_dob=='0000-00-00 00:00:00'){
				return THREE_DASH;
			}
			elseif(strtotime($curYear)>0){
				return $age;
			}
			else{
				return THREE_DASH;
			}
		}
		else{
			return THREE_DASH;
		}
	}
	
	//Validate for users over 12 only
	function age_limit_validation($dob){
		// $dob will first be a string-date
		$dob = strtotime($dob);
		//The age to be over, over +12
		$min = strtotime("+". TV_MIN_AGE ."years", $dob);
		if(time() < $min)  {
			return false;
		}
		else{
			return true;
		}
	}
	
	function address_type_exists($type) {
		$this->load->model('__customer/Dashboard_mdl');
		$address_type_check = $this->Dashboard_mdl->address_type_exists($type);
		if($address_type_check > 0) {
			$this->form_validation->set_message('address_type_exists', $this->lang->line('text_address_type_exist'));
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	function email_exists($email) {
		$this->load->model('__customer/Dashboard_mdl');
		$email_check = $this->Dashboard_mdl->email_exists($email);
		if($email_check > 0) {
			$this->form_validation->set_message('email_exists', $this->lang->line('text_email_added'));
			return FALSE;
		}
		else {
			return TRUE;
		}
	}
	
	function validate_old_password($password) {
		$this->load->model('__customer/Dashboard_mdl');
		$old_password_check = $this->Dashboard_mdl->validate_old_password($password);
		if($old_password_check > 0) {
			return TRUE;
		}
		else {
			$this->form_validation->set_message('validate_old_password', $this->lang->line('text_invalid_old_password'));
			return FALSE;
		}
	}
}
