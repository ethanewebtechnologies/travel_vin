<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

$hook['post_controller_constructor'] = array(
    array(
        'class' => 'Audit_permission_hk',
        'function' => 'register',
        'filename' => 'Audit_permission_hk.php',
        'filepath' => 'hooks',
        'params' => array()
    ),
    array(
        'class' => 'Setting_country_city_hk',
        'function' => 'set',
        'filename' => 'Setting_country_city_hk.php',
        'filepath' => 'hooks',
        'params' => array()
    )
);
