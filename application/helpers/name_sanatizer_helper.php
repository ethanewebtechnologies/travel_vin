<?php


function sanatize_controller_name($controller_name) {
    return ucfirst(trim(str_replace('_', ' ', str_replace('_ctrl', '', $controller_name))));
}

function sanatize_method_name($method_name) {
    
    $method_name = ucfirst(trim(str_replace('_', ' ', $method_name)));
    
    if($method_name == 'Index') {
        $method_name = 'List';
    }
    
    return $method_name;
}