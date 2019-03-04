<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code



/* /////////////////////////// TRAVEL_VIN PROJECT CONSTANT ////////////////////// */

defined('DB_PREFIX')                        OR define('DB_PREFIX', 'tv_'); // DATABASE TABLE PREFIX
defined('DB_SUFFIX')                        OR define('DB_SUFFIX', '_tbl'); // DATABASE SUFFIX PREFIX

defined('DIR_DOCUMENT')                     OR define('DIR_DOCUMENT', 'content/document'); // CONTENT DOCUMENT DIRECTORY
defined('DIR_IMAGE')                        OR define('DIR_IMAGE', 'content/image'); // CONTENT IMAGE DIRECTORY
defined('DIR_IMAGE_CACHE')                  OR define('DIR_IMAGE_CACHE', 'content/image/cache'); // CONTENT IMAGE CACHE DIRECTORY
defined('DIR_IMAGE_MAIN')                   OR define('DIR_IMAGE_MAIN', 'content/image/main'); // CONTENT IMAGE MAIN DIRECTORY


defined('GOOGLE_API_KEY')                   OR define('GOOGLE_API_KEY', 'AIzaSyCcPDaZlGq3UHhRxiVgR05tytbwnSaAiPw');
defined('THREE_DASH')                       OR define('THREE_DASH', '_ _ _');
defined('THREE_DOTS')                       OR define('THREE_DOTS', '...');
defined('PAGINATION_LIMIT')                 OR define('PAGINATION_LIMIT', '100');
defined('PRICE_DELIMITER')                  OR define('PRICE_DELIMITER', 0);
defined('CUSTOMER_INVOICE_PREFIX')          OR define('CUSTOMER_INVOICE_PREFIX', 'CINV-');
defined('VENDOR_INVOICE_PREFIX')            OR define('VENDOR_INVOICE_PREFIX', 'VINV-');

defined('INVOICE_PAD_LIMIT')                OR define('INVOICE_PAD_LIMIT', 20);
defined('INVOICE_PAD_VALUE')                OR define('INVOICE_PAD_VALUE', '0');

defined('DEFAULT_ADMIN_PANEL_LANGUAGE')     OR define('DEFAULT_ADMIN_PANEL_LANGUAGE', 'en');


defined('TV_SYSTEM_ID')                     OR define('TV_SYSTEM_ID', '0'); 
defined('TV_VENDOR_REQUEST_ON')             OR define('TV_VENDOR_REQUEST_ON', '1');

defined('TV_ON')                            OR define('TV_ON', '1');
defined('TV_OFF')                           OR define('TV_OFF', '0');

defined('TV_DISAPPROVED')                   OR define('TV_DISAPPROVED', '0');
defined('TV_APPROVED')                      OR define('TV_APPROVED', '1');

defined('TV_GUEST_FALSE')                   OR define('TV_GUEST_FALSE', '0');
defined('TV_GUEST_TRUE')                    OR define('TV_GUEST_TRUE', '1');

defined('TV_FRAUD_ID')                      OR define('TV_FRAUD_ID', '3');
defined('TV_PDF_EXT')                       OR define('TV_PDF_EXT', '.pdf');

defined('TV_CUSTOMER_INVOICE_DIR')          OR define('TV_CUSTOMER_INVOICE_DIR', 'content/document/customer_invoice/');
defined('TV_VENDOR_INVOICE_DIR')            OR define('TV_VENDOR_INVOICE_DIR', 'content/document/vendor_invoice/');
defined('TV_ADMIN_INVOICE_DIR')             OR define('TV_ADMIN_INVOICE_DIR', 'content/document/admin_invoice/');

defined('TV_MIN_AGE')                       OR define('TV_MIN_AGE', 12);

/*
|--------------------------------------------------------------------------
| Booking Default Payment Status
|--------------------------------------------------------------------------
|
| Use following modes for different payment status:
| Use value 1 for Initialize payment status
| Use value 2 for Pending payment status
| Use value 3 for Failed payment status
| Use value 4 for Complete payment status
|
*/
defined('TV_DEFAULT_PAYMENT_STATUS')        OR define('TV_DEFAULT_PAYMENT_STATUS', 1);

/*
|--------------------------------------------------------------------------
| Minimum & Maximum Passengers allowed In Single Booking
|--------------------------------------------------------------------------
*/
defined('TV_MIN_ADULT_ALLOWED')        OR define('TV_MIN_ADULT_ALLOWED', 1);
defined('TV_MAX_ADULT_ALLOWED')        OR define('TV_MAX_ADULT_ALLOWED', 16);


/* RAVEL_VIN PROJECT CONSTANT */
defined('TV_MAX_IMG_UPLOAD_SIZE')        OR define('TV_MAX_IMG_UPLOAD_SIZE', '3000000');
defined('TV_MAX_IMG_UPLOAD_SIZE_TEXT')   OR define('TV_MAX_IMG_UPLOAD_SIZE_TEXT', '3MB');

// admin email for sending mail to admin
define('ADMIN_EMAIL', 'bijender@ethanetechnologies.org');