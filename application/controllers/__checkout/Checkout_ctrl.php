<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Checkout Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, MANSI JAIN, BIJENDRA SINGH, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Checkout_ctrl extends CI_Controller {
    private $_pdata = array();
    private $_cartToken;
    private $siteLang;
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            'form_validation',
            '__prjlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized',
			'gateway/Payment'
        ));
        
        $this->load->helper(array(
            'form', 
            'cookie',
            'dt', 
            'cart_price_calculator', 
            'coupon'
        ));
        
        if(!$this->session->has_userdata('site_lang')) {
            $this->session->set_userdata('site_lang', 'en');
        }
        
        $siteLang = $this->session->userdata('site_lang');
        
        $this->lang->load('__checkout/Cart', $siteLang);
        $this->lang->load('__checkout/Checkout', $siteLang);
        $this->lang->load('form_validation', $siteLang);
		
		$this->load->model('__checkout/Cart_mdl');
		$__cartToken = get_cookie('_cart_token');
		$view_cart_data = $this->Cart_mdl->get_cart_data_by_cart_token($__cartToken);
		$_cart_data__ = json_decode($view_cart_data['_cart_data__'], true);
		$cart_total =0;
		if(isset($_cart_data__) && $_cart_data__ != '') {
			$cart_total = count_cart_items($_cart_data__);
		}
		if($cart_total==0){redirect(base_url());}
    }

    public function audit() {
        $this->load->model(array(
            '__checkout/Cart_mdl',
            '__customer/Dashboard_mdl'
        ));
		
		$cartToken = get_cookie('_cart_token');
		
		if($this->input->post('add_address') && $this->input->post('add_address') == 'add_address') {
			
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
				$this->session->set_flashdata('addr-error', "Data not saved, Please check your form");
            } else {
				$return = $this->Dashboard_mdl->add_customer_address($this->input->post());
				
				if($return) {
					$this->session->set_flashdata('addr-success', "Data saved successfully");
				} else {
					$this->session->set_flashdata('addr-error', "Data not saved");
				}
				
				redirect('checkout/audit');
			}
		}
		
		if($this->input->post('update_address') && $this->input->post('update_address')=='update_address'){
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
            } else {
				$return = $this->Dashboard_mdl->update_customer_address($this->input->post());
				
				if($return) {
					$this->session->set_flashdata('addr-success', $this->lang->line('form_data_success'));
				} else {
					$this->session->set_flashdata('addr-error', $this->lang->line('form_post_erroe'));
				}
				
				redirect('checkout/audit');
			}
		}
        
        if ($this->input->post()) {
			
			if($this->session->has_userdata('customer')) {
				$this->form_validation->set_rules('customer_address', 'lang:text_customer_address', 'trim|required', array(
					'required' => $this->lang->line('required')
				));
				
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('msg-error', validation_errors());
					$this->session->set_flashdata('addr-error', $this->lang->line('form_data_address_error'));
				} else {
					$customerid = $this->security_lib->decrypt($this->session->userdata('__idCus'));
					$this->session->set_userdata('__transactionCusId', $customerid);
					
					redirect('checkout/payment?token='.$this->session->userdata('__idCus'));
				}
			} else {
				$this->session->set_flashdata('country_flash_session',$this->input->post('country'));
				$this->session->set_flashdata('state_flash_session',$this->input->post('state'));
				$this->form_validation->set_rules('firstname', 'lang:text_firstname', 'trim|required|min_length[3]|max_length[32]', array(
					'required' => $this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('lastname', 'lang:text_lastname', 'trim|min_length[3]|max_length[32]', array(
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));
				$this->form_validation->set_rules('email', 'lang:text_email', 'trim|required[tv_customer_tbl.email]', array(
					'required' => $this->lang->line('required'),
					
				));
				$this->form_validation->set_rules('city', 'lang:text_city', 'required|min_length[3]|max_length[32]', array(
					'required' => $this->lang->line('required'),
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
				));		
				$this->form_validation->set_rules('country', 'Country', 'required', array(
					'required' => $this->lang->line('required'),
				));
				$this->form_validation->set_rules('state', 'State', 'required', array(
					'required' => $this->lang->line('required'),
				));
				$this->form_validation->set_rules('telephone', 'lang:text_label_telephone', 'trim|required|min_length[10]|max_length[10]', array(
					'required' => $this->lang->line('required'),
					'min_length' => $this->lang->line('phone_min_length'),
					'max_length' => $this->lang->line('phone_max_length')
				)); 
				$this->form_validation->set_rules('booking_additional_notes', 'lang:text_additional_notes', 'min_length[3]|max_length[32]', array(               
					'min_length' => $this->lang->line('min_length'),
					'max_length' => $this->lang->line('max_length')
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
				
				if ($this->form_validation->run() == FALSE) {
					$this->session->set_flashdata('msg-error', validation_errors());
				} else {
					$customer_data = array(
						'firstname' => $this->input->post('firstname'),
						'lastname' => $this->input->post('lastname'),
						'telephone' => $this->input->post('telephone'),
						'email' => $this->input->post('email'),
						'date_added' => lu_to_d(date('Y-m-d H:i:s')),
						'date_modified' => lu_to_d(date('Y-m-d H:i:s')),
						'newsletter_status' => '1',
						'is_guest' => TV_GUEST_TRUE,
						'status' => TV_ON,
						'approved' => TV_APPROVED,
						'user_added' => TV_SYSTEM_ID,
						'user_modified' => TV_SYSTEM_ID
					);
					
					$this->load->model('__checkout/Audit_mdl');
					$audit_report = $this->Audit_mdl->add_customer_details($customer_data);
					$this->session->set_userdata('__transactionCusId', $audit_report['success']);
					
					if(isset($audit_report['success']) && !empty($audit_report['success'])) {
						
						$customer_id = $audit_report['success'];
						
						$customer_address_data = array(
							'customer_id' => $customer_id,
							'type' => 'Home',
							'city' =>  $this->input->post('city'),
							'state' =>  $this->input->post('state'),
							'country' =>  $this->input->post('country'),
							'address_1' =>  $this->input->post('address_1'),
							'address_2' =>  $this->input->post('address_2')
						);
						
						$res = $this->Audit_mdl->add_customer_address($customer_address_data);
					}
					$customerinfo = $this->security_lib->encrypt($customer_id);
					redirect('checkout/payment?token='.$customerinfo);
				}
			}
        }
		
		$this->_pdata['text_label_add_address'] = $this->lang->line('text_label_add_address');
		$this->_pdata['text_label_edit_address'] = $this->lang->line('text_label_edit_address');
		$this->_pdata['text_label_select_address'] = $this->lang->line('text_label_select_address');
		
		$this->_pdata['text_placeholder_address1'] = $this->lang->line('text_placeholder_address1');
		$this->_pdata['text_placeholder_address2'] = $this->lang->line('text_placeholder_address2');
		$this->_pdata['text_placeholder_city'] = $this->lang->line('text_placeholder_city');
		$this->_pdata['text_placeholder_postcode'] = $this->lang->line('text_placeholder_postcode');
		
		$this->_pdata['text_content_submit'] = $this->lang->line('text_content_submit');
		
		$this->_pdata['text_label_firstname']               = $this->lang->line('text_label_firstname');
        $this->_pdata['text_label_lastname']                = $this->lang->line('text_label_lastname');
        $this->_pdata['text_label_email']                   = $this->lang->line('text_label_email');
		
        $this->_pdata['text_telephone']                     = $this->lang->line('text_telephone');
	    $this->_pdata['text_address1']                      = $this->lang->line('text_address1');
        $this->_pdata['text_address2']                      = $this->lang->line('text_address2');
        $this->_pdata['text_city']                          = $this->lang->line('text_city');
        $this->_pdata['text_address']                       = $this->lang->line('text_address');
	   
      
        $this->_pdata['text_label_telephone']               = $this->lang->line('text_label_telephone');
		
		$this->_pdata['text_label_address_1']               = $this->lang->line('text_label_address_1');
		$this->_pdata['text_label_address_2']               = $this->lang->line('text_label_address_2');
		$this->_pdata['text_label_city']                    = $this->lang->line('text_label_city');
		$this->_pdata['text_label_country']                 = $this->lang->line('text_label_country');
		$this->_pdata['text_label_state']                 = $this->lang->line('text_label_state');
		$this->_pdata['text_label_additional_notes']        = $this->lang->line('text_label_additional_notes');
					
	    $this->_pdata['text_placeholder_firstname']         = $this->lang->line('text_placeholder_firstname');
		$this->_pdata['text_placeholder_lastname']          = $this->lang->line('text_placeholder_lastname');
		
		$this->_pdata['text_placeholder_email']             = $this->lang->line('text_placeholder_email');
		
		$this->_pdata['text_placeholder_telephone']         = $this->lang->line('text_placeholder_telephone');
		
		$this->_pdata['text_placeholder_address_1']         = $this->lang->line('text_placeholder_address_1');
		$this->_pdata['text_placeholder_address_2']         = $this->lang->line('text_placeholder_address_2');
		
		$this->_pdata['text_placeholder_city_1']              = $this->lang->line('text_placeholder_city_1');
		$this->_pdata['text_placeholder_country']          = $this->lang->line('text_placeholder_country');
		$this->_pdata['text_placeholder_state']          = $this->lang->line('text_placeholder_state');
		$this->_pdata['text_placeholder_additional_notes']  = $this->lang->line('text_placeholder_additional_notes');
		
		$this->_pdata['text_shopping_cart'] = $this->lang->line('text_shopping_cart');
		$this->_pdata['text_your_information'] = $this->lang->line('text_your_information');
		$this->_pdata['text_confirmation'] = $this->lang->line('text_confirmation');
		$this->_pdata['text_success'] = $this->lang->line('text_success');
		$this->_pdata['text_form_title'] = $this->lang->line('text_form_title');
		$this->_pdata['text_error'] = $this->lang->line('text_error');
		$this->_pdata['text_address_none'] = $this->lang->line('text_address_none');
		$this->_pdata['text_safe_information'] = $this->lang->line('text_safe_information');
		$this->_pdata['text_terms_conditions'] = $this->lang->line('text_terms_conditions');
		
		$this->_pdata['address_type'] = array(
			'' => $this->lang->line('text_address_none'),
			'Home' => $this->lang->line('text_address_home'),
			'Work' => $this->lang->line('text_address_work'),
			'Other' => $this->lang->line('text_address_other'),
		);
		
		$this->load->model('__customer/Dashboard_mdl');
		$this->_pdata['customer_addresses'] = $this->Dashboard_mdl->get_customer_addresses();
		
			   
        $this->template_lib->load_view($this, '__checkout/Audit_view',$this->_pdata);
    }
	
	public function payment() {
		$siteLanguage = $this->session->userdata('site_lang');
		$this->_pdata['text_shopping_cart'] = $this->lang->line('text_shopping_cart');
		$this->_pdata['text_your_information'] = $this->lang->line('text_your_information');
		$this->_pdata['text_confirmation'] = $this->lang->line('text_confirmation');
		$this->_pdata['text_choose_payment_method'] = $this->lang->line('text_choose_payment_method');
		$this->_pdata['text_paypal'] = $this->lang->line('text_paypal');
		$this->_pdata['text_safe_information'] = $this->lang->line('text_safe_information');
		$this->template_lib->load_view($this, '__checkout/Payment_view', $this->_pdata);
	}
	
	public function get_ajax_customer_data() {
        $this->load->model('__checkout/Audit_mdl');
		$userdata = $this->Audit_mdl->findCustomerByemail($_GET['email']);
		exit(json_encode($userdata[0]));
	}
}