<?php

function breadcrumb($breads = array()) {
    
    $breadcrumb_str = '<ol class="breadcrumb bc-3">';
    
    foreach ($breads as $link => $bread) {
        $breadcrumb_str .= '<li>';
        $breadcrumb_str .= '<a href="' . $link . '"><i class="fa-home"></i>' . $bread . '</a>';
        $breadcrumb_str .= '</li>';
    }
    
    $breadcrumb_str .= '</ol>';
    
//     <li class="active">
//     <strong>Basic Elements</strong>
//     </li>
    return $breadcrumb_str;
}