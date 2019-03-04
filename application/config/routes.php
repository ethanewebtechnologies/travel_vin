<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['admin/refresh_rss'] = "rss/index";

/* $route['(:any)'] = function ($su) {
    
    if($su == 'admin') {
        return 'admin_ctrl';
    }
    
    return '__information/Page_ctrl/get_page/'.$su;
};

$route['(:any)/(:any)/(:any)/(:any)'] = function ($d, $f, $a, $p) {
    return '__'.$d.'/'.$f.'_ctrl/'.$a.'/'.$p;
};

$route['(:any)/(:any)/(:any)'] = function ($d, $f, $a) {
    return '__'.$d.'/'.$f.'_ctrl/'.$a;
};

// FOR BASIC INDEX FUNCTION TO WORK
$route['(:any)/(:any)'] = function ($d, $f) {
    return '__'.$d.'/'.$f.'_ctrl';
}; */

$route['translate/change_language'] = 'translate_ctrl/change_language';

$route['gateway/payment/(:any)/(:any)'] = '__gateway_payment/$1/$2';
$route['gateway/payment/(:any)'] = '__gateway_payment/$1/index';

$route['cart'] = '__checkout/Cart_ctrl';
$route['cart/(:any)'] = '__checkout/Cart_ctrl/$1';

$route['checkout'] = '__checkout/Checkout_ctrl';
$route['checkout/(:any)'] = '__checkout/Checkout_ctrl/$1';

$route['customer/(:any)'] = function($a) {
    return '__customer/' . str_replace('-', '_', $a) . '_ctrl';
};

$route['customer/(:any)/(:any)'] = function($a, $b) {
    return '__customer/' . str_replace('-', '_', $a) . '_ctrl/' . str_replace('-', '_', $b);
};

$route['admin/(:any)/(:any)/(:any)'] = function($d, $f, $a) {
    return '__admin_' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl/' . str_replace('-', '_', $a);
};

$route['admin/(:any)/(:any)'] = function($d, $f) {
    return '__admin_' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl';
};

$route['admin'] = 'admin_ctrl';

$route['vendor/(:any)/(:any)/(:any)'] = function($d, $f, $a) {
    return '__vendor_' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl/' . str_replace('-', '_', $a);
};

$route['vendor/(:any)/(:any)'] = function($d, $f) {
    return '__vendor_' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl';
};

$route['vendor'] = 'vendor_ctrl';


$route['become-an-agent'] = '__agent/account_ctrl/add_agent';
$route['agent/account/(:any)'] = function($action) {
    
    return '__agent/account_ctrl/'.str_replace('-', '_', $action);
    
    //return '__' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl/' . str_replace('-', '_', $a);
};
$route['booking/booking/(:any)'] = function($action) {
    
    return '__agent/account_ctrl/'.str_replace('-', '_', $action);
    
    //return '__' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl/' . str_replace('-', '_', $a);
};


$route['(:any)/(:any)/(:any)'] = function($controller, $country, $city) {
    return '__catalog/' . str_replace('-', '_', $controller) . '_ctrl/index/' . $country . '/' . $city;
    
    //return '__' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl/' . str_replace('-', '_', $a);
};

$route['(:any)/(:any)/(:any)/(:any)'] = function($controller, $country, $city, $any_slug) {
    return '__catalog/' . str_replace('-', '_', $controller) . '_ctrl/get/' . $country . '/' . $city . '/'. $any_slug;
};

$route['home/get_cities_by_country_seo_url'] = 'Home_ctrl/get_cities_by_country_seo_url';

$route['(:any)/(:any)'] = function($d, $f) {
    return '__' . str_replace('-', '_', $d) . '/' . str_replace('-', '_', $f) . '_ctrl';
};

$route['tours'] = '__catalog/Tours_ctrl';
$route['deals'] = '__catalog/Deals_ctrl';
$route['elite-tours'] = '__catalog/Elite_tours_ctrl';
$route['golfs'] = '__catalog/Golfs_ctrl';
$route['clubs-and-bars'] = '__catalog/Clubs_and_bars_ctrl';
$route['restaurants'] = '__catalog/Restaurants_ctrl';
$route['transportation'] = '__catalog/Transportation_ctrl';
$route['weddings'] = '__catalog/Weddings_ctrl';
//$route['information'] = '__catalog/Information_ctrl';
$route['not-found'] = 'Error404_ctrl';

$route['(:any)'] = function($slug) {
    return '__information/Page_ctrl/get_page/' . $slug;
};

$route['default_controller'] = 'Home_ctrl';
$route['404_override'] = 'Error404_ctrl';
$route['translate_uri_dashes'] = FALSE;
