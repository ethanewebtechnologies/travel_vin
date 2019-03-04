<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * APPLICATION 		: Wedding Page Controller
 * AUTHOR			: BIJENDRA SINGH
 * CONTRIBUTION     : BIJENDRA SINGH
 * VERSION			: 1.0
 * COPYRIGHT		: Ethane Webtechnologies Pvt. Ltd.
 */

/*
 * GENERAL MODEL WILL BE USE AS A COMMON MODEL HERE
 *  */

class Wedding_page_ctrl extends CI_Controller {
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
            $this->form_validation->set_rules('config[wedding][details_en][main_title]', 'Main Title', 'trim|required|min_length[3]|max_length[255]',
                array(
                    'required' => 'Title Name required for English atleast.',
                    'min_length' => 'Title should have minimum 3 characters.',
                    'max_length' => 'Title Name cannot more than 255 characters.'
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
        
        $this->template_lib->load_view($this, '__admin_settings/Wedding_page_view', $this->_pdata);
    }
}