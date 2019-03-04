<?php   
class Contact_us_ctrl extends CI_Controller {
    
    private $_pdata = array();
    
    public function __construct() {
        parent::__construct();
	
        $this->load->library(array('__prjlib/Header_lib','__prjlib/Footer_lib'));
    }
    
    public function contact() {
		 
		$this->load->helper('form');
	   $this->load->model('__information/Information_mdl');
	   $this->_pdata['contact_us'] = $this->Information_mdl->contact();
       
	   // Loading View Files Here
	  
	   $this->header_lib->get_header($this);
	   $this->load->view('__information/Contactus_view', $this->_pdata);
       $this->footer_lib->get_footer($this);
	 
	    extract($_POST); 
	    if(isset($sub)) {
		   
         if($this->Information_mdl->contact($name,$email,$Phone,$address,$comment))
		  {
			  
			  $data['msg']="Data Insert";
		  }
		  
		  else {
			  
			  $data['msg']="Data Not Insert"; 
		  }
	   }

    }
}
?>