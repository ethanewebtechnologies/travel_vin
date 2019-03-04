<?php
  
function token($length = 32) {
    // Create random token
    $string = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
    
    $max = strlen($string) - 1;
    
    $token = '';
    
    for ($i = 0; $i < $length; $i++) {
        $token .= $string[mt_rand(0, $max)];
    } 
    
    return $token;
}

function generate_random_code() {
    $chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ023456789";
    srand((double)microtime()*1000000);
    $i = 0;
    $pass = '' ;
    
    while ($i <= 6) {
        $num = rand() % 33;
        $tmp = substr($chars, $num, 1);
        $pass = $pass . $tmp;
        $i++;
    }
    
    return $pass;
}

