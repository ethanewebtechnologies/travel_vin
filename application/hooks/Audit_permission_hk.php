<?php

class Audit_permission_hk {
    
    public function register() {
        $this->CI =& get_instance();
        
        if($this->CI->uri->segment(1) == 'admin' && $this->CI->uri->segment(2) == 'account') { 
            
        } else {
            if($this->CI->uri->segment(1) == 'admin') { 
                
                $router =& load_class('Router', 'core');
                
                $controller = $router->fetch_class();
                $method = $router->fetch_method();
                
                $results = $this->CI->db->select("*")->from('tv_restricted_zone_tbl')->get()->result_array();
                
                $keys = array();
                
                foreach ($results as $result) {
                    $keys[$result['controller_name'] . '|||' . $result['method_name']] = $result['id'];
                }
                
                if(array_key_exists($controller . '|||' . $method, $keys)) {
                    $restrictied_zone_id = $keys[$controller . '|||' . $method];
                } else {
                    $data = array(
                        'type' => 'admin',
                        'controller_name' => $controller,
                        'method_name' =>  $method
                    );
                    
                    $this->CI->db->insert('tv_restricted_zone_tbl', $data);
                    
                    $restrictied_zone_id = $this->CI->db->insert_id();
                    
                    $permission_data = array(
                        'restrictied_zone_id' => $restrictied_zone_id,
                        'permitted_user_id' => 1,
                        'permitted_user_group_id' => 1
                    );
                    
                    $this->CI->db->insert('tv_user_permission_tbl', $permission_data);
                    
                    
                    $permission_data2 = array(
                        'restrictied_zone_id' => $restrictied_zone_id,
                        'permitted_user_id' => 0,
                        'permitted_user_group_id' => 1
                    );
                    
                    $this->CI->db->insert('tv_user_permission_tbl', $permission_data2);
                }
                
                $admin = $this->CI->session->userdata('user');
                
                $query = $this->CI->db->select('1')
                    ->from('tv_user_permission_tbl')
                        ->where('permitted_user_id', $admin['id'])
                            ->where('restrictied_zone_id', $restrictied_zone_id)->get();
                
                if($query->num_rows() > 0) {
                    
                } else {
                    redirect('admin/default/access-denied');
                }
            }
        }
    }
}
