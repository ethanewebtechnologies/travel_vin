<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
 * APPLICATION 		: TOUR LOCATION CONTROLLER
 * AUTHOR			: KUNDAN KUMAR
 * CONTRIBUTORS     : VINAY KUMAR SHARMA, KUNDAN KUMAR
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */
class Tour_location_ctrl extends CI_Controller {
    private $_data = array();
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        $conditions = array();
        
        $start = 0;
        $limit = 100;
        
        $this->load->model('__admin_spot/Spot_location_mdl');
        $this->_pdata['spots'] = $this->Spot_location_mdl->getSpots($conditions, $start, $limit);
        
        $this->template_lib->load_view($this, '__admin_spot/Spot_view', $this->_pdata) ;
    }
    
    public function add() {
        if($this->input->post()) {
            $this->Spot_location_mdl->add($this->input->post());
            redirect('admin_spot/Spot/index');
        }
        
        $this->template_lib->load_view($this, '__admin_spot/add_spot_view');
    }
    
    public function edit($pageid) {
        if($this->input->post()) {
            $this->Spot_location_mdl->updatepage($this->input->post(), $pageid);
            redirect('admin_spot/Spot/index');
        }
        
        $this->load->model('__admin_spot/Spot_location_mdl');
        $this->_pdata['page'] = $this->Spot_location_mdl->getpagedetails($pageid);
        $this->template_lib->load_view($this, '__admin_spot/edit_spot_view', $this->_pdata);
    }
}