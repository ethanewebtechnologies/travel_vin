<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: SUBSCRIBER CONTROLLER
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTORS     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

class Subscriber_ctrl extends CI_Controller {

    private $_pdata = array();

    public function __construct() {
        parent::__construct();
        
        if (!$this->session->has_userdata('user')) {
            redirect('admin/account/login');
        }
        
        $this->load->library(array(
            'form_validation',
            '__prjadminlib/Template_lib',
            '__commonlib/Security_lib',
            '__commonlib/Optimized'
        ));

        $this->load->helper(array('form', 
            'date', 
            'dt',
            'encryption'
        ));

        $this->lang->load(array(
            'common'
        ), DEFAULT_ADMIN_PANEL_LANGUAGE);
    }

    public function index() {

        $search_conditions = array();

        $search_subscriber_email = $this->input->get('search_subscriber_email');
        
        if (isset($search_subscriber_email)) {
            $search_conditions['search_subscriber_email'] = $search_subscriber_email;
            $this->_pdata['search_subscriber_email'] = $search_subscriber_email;
        } else {
            $search_conditions['search_subscriber_email'] = null;
            $this->_pdata['search_subscriber_email'] = null;
        }
        
        $search_subscription_type = $this->input->get('search_subscription_type');
        
        if (isset($search_subscription_type)) {
            $search_conditions['search_subscription_type'] = $search_subscription_type;
            $this->_pdata['search_subscription_type'] = $search_subscription_type;
        } else {
            $search_conditions['search_subscription_type'] = null;
            $this->_pdata['search_subscription_type'] = null;
        }
        
        $start = $this->input->get('per_page');

        if (!isset($start)) {
            $start = 0;
        }

        $limit = PAGINATION_LIMIT;

        $this->_pdata['subscribers'] = array();

        $this->load->model('__admin_marketing/Subscriber_mdl');

        /* FETCHING DATA */
        $this->_pdata['subscribers'] = $this->Subscriber_mdl->get_subscribers($search_conditions, $start, $limit);
        $this->_pdata['total_subscribers'] = $this->Subscriber_mdl->get_total_subscribers($search_conditions);

        $this->load->helper('paginator');
        $this->_pdata['pagination'] = generate_pagination($this, 'admin/marketing/subscriber', $this->_pdata['total_subscribers'], $limit);
       
        $this->template_lib->load_view($this, '__admin_marketing/Subscriber_list_view', $this->_pdata);
    }

    public function delete() {
        $secure_token = $this->input->get('secure_token');
        $subscriber_id = $this->security_lib->decrypt($secure_token);
        
        $this->load->model('__admin_marketing/Subscriber_mdl');
        $this->Subscriber_mdl->delete_subscriber($subscriber_id);

        redirect('admin/marketing/subscriber');
    }
    
    public function change_status() {
        $secure_token = $this->input->get('secure_token');
        $subscriber_id = $this->security_lib->decrypt($secure_token);
        
        if($subscriber_id) {
            $this->load->model('__admin_marketing/Subscriber_mdl');
            $this->Subscriber_mdl->change_subscriber_status($subscriber_id, $this->input->get('change_status'));
            
            redirect('admin/marketing/subscriber');
        }
    }
}	
