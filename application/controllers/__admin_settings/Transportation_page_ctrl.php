<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Transportation Page Controller
 * AUTHOR			: VINAY KUMAR SHARMA
 * CONTRIBUTION     : VINAY KUMAR SHARMA
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

/*
 * GENERAL MODEL WILL BE USE AS A COMMON MODEL HERE
 *  */

class Transportation_page_ctrl extends CI_Controller {
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
        
        $this->load->library(array(
            '__prjadminlib/Template_lib',
            'form_validation',
        ));
        
        $this->load->helper(array(
            'form',
            'dt',
            'name_sanatizer'
        ));
    }
    
    public function index() {
        $this->load->model('__admin_settings/General_mdl');
        
        if($this->input->post()) {
            $this->form_validation->set_rules('config[transportation][details_en][dsc]', 'Main Description', 'trim|required',
                array(
                    'required' => 'Main Description required for English atleast.',
                ));
            
            if ($this->form_validation->run() == FALSE) {
                $this->session->set_flashdata('validation_error', TRUE);
            } else {
                $config = $this->input->post('config');
                $this->General_mdl->update_settings($config);
                
                $this->session->set_flashdata('updated_successfully', TRUE);
                redirect('admin/default/dashboard');
            }
        }
        
        $configurations = $this->General_mdl->get_settings();
        
        foreach ($configurations as $configuration) {
            $this->_pdata['configurations'][$configuration['category']][$configuration['key']] = json_decode($configuration['value'], TRUE);
        }
        
        $this->load->model('__admin_settings/Utility_mdl');
        $this->_pdata['languages'] = $this->Utility_mdl->get_languages();
        
        $this->template_lib->load_view($this, '__admin_settings/Transportation_page_view', $this->_pdata);
    }
}