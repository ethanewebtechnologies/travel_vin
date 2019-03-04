<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$config = array(
     '__agent/account_ctrl/add_agent' => array(
        array(
            'field' => 'company_legal_name',
            'label' => 'Company Legal Name',
			'errors' => array(
            'required' => 'Company Legal Name is required',
        ),
        'rules' => 'required'
		),
        array(
            'field' => 'tax_id',
            'label' => 'Tax ID',
			'errors' => array(
            'required' => 'Tax ID is required',
			),
			'rules' => 'required'
        ),
		
        array(
            'field' => 'email',
            'label' => 'email',
			'errors' => array(
            'required' => 'Email is required',
			'valid_email' => 'email is not valid',
			'is_unique_email' => 'Email exist'
			),
			'rules' => 'required|valid_email|is_unique_email'
        ),
        array(
            'field' => 'address',
            'label' => 'address',
			'errors' => array(
            'required' => 'Address is required',
			),
            'rules' => 'required'
        ),
        array(
            'field' => 'city',
            'label' => 'City',
			'errors' => array(
            'required' => 'City is required feild',
			),
            'rules' => 'required'
        ),
        array(
            'field' => 'country',
            'label' => 'Country',
			'errors' => array(
            'required' => 'Country is required feild',
			),
            'rules' => 'required'
        ),
        array(
            'field' => 'state',
            'label' => 'state',
           'errors' => array(
            'required' => 'State is required feild',
			),
			'rules' => 'required'
        ),
        array(
            'field' => 'postal',
            'label' => 'postal',
			'errors' => array(
            'required' => 'Postal code is required feild',
			),
           'rules' => 'required'
        ),
        array(
            'field' => 'telephone',
            'label' => 'telephone',
            'rules' => array('required'=>'Telephone is required feild')
        ),
        array(
            'field' => 'admin_fullname',
            'label' => 'admin fullname',
            'errors' => array(
            'required' => 'Admin fullname is required feild',
			),
			'rules' => 'required'
        ),
        array(
            'field' => 'admin_contact',
            'label' => 'Admin Contact',
            'rules' => array('required'=>'Admin Contact is required feild')
        ),
        array(
            'field' => 'admin_email',
            'label' => 'Email',
			'errors' => array(
            'required' => 'Admin Email is required feild',
			),
			'rules' => 'required'
        ),
		array(
            'field' => 'admin_confirm_email',
            'label' => 'Confirm Email',
			'errors'=>array('required' => 'Email is required',
			'valid_email' => 'email is not valid',
			'is_unique_email' => 'Email exist'
			),
			'rules' => 'required|valid_email|is_unique_email'
        ),
        array(
            'field' => 'agree',
            'label' => 'Term And Conditions',
            'errors' => array(
            'required' => 'Term And Conditions is required feild',
			),
			'rules' => 'required'
        ),
        array(
            'field' => 'business_type',
            'label' => 'business_type',
			'errors' => array(
            'required' => 'Business Type is required feild',
			),
			'rules' => 'required'
        )
    ),
	
	
);
