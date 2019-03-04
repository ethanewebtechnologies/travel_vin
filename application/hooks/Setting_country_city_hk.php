<?php

class Setting_country_city_hk {
    
    public function set() {
        $this->CI =& get_instance();
        
        $router =& load_class('Router', 'core');
        $directory = $router->directory;
        $method = $router->method;
        
        
        if($directory == '__catalog/' && $method == 'index') {
            $country = $this->CI->uri->segment(2);
            $city = $this->CI->uri->segment(3);
            
            $this->CI->session->set_userdata('sess_country', $country);
            $this->CI->session->set_userdata('sess_city', $city);
        }
    }
}

