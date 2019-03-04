<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * Code Igniter
 *
 * An private source application development framework for PHP 4.3.2 or newer
 *
 * @package		CodeIgniter
 * @application Email library
 * @author		Vinay Kumar Sharma
 * @copyright	Copyright (c) 2017, Ethane Web Technologies, Inc.
 * @license		http://www.codeignitor.com/user_guide/license.html
 * @link		http://www.codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

// ------------------------------------------------------------------------


class Email_lib {
    public function send($from, $to, $subject, $msg, $fromtitle = '', $attachments = null) {
        $data = array();
        $ci = & get_instance();
        
        $config = array(
            'protocol' 	=> 'sendmail',
            'smtp_host' => 'mail.ethanetechnologies.org',
            'smtp_port' => 25,
            'smtp_user' => 'neeraj@ethanetechnologies.org',
            'smtp_pass' => 'LG.9*SX{=so2',
            'smtp_timeout' => '4',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'wordwrap' 	=> TRUE
        );
        
        $message = $msg;
        
        $ci->load->library('email', $config);
        $ci->email->set_newline("\r\n");
        $ci->email->set_mailtype("html");
        // Change it to yours
        $ci->email->from($from, $fromtitle); 	
        
        // Change it to yours
        $ci->email->to($to);	
        
        $ci->email->reply_to('no-reply@ethanetechnologies.org', 'Sunshine');
        $ci->email->subject($subject);
        $ci->email->message($message);
        
        if($attachments) {
            if(is_array($attachments)) { 
                foreach ($attachments as $attachment) {
                    $ci->email->attach($attachment);
                }
            } else {
                $ci->email->attach($attachments);
            }
        } 
        
        if($ci->email->send()) {
            return true;
        } else {
            return false;
        }
    }
}