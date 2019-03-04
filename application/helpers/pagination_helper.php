<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
## pass total numbet of data in table and show per page ##


# For Pagination
if (!function_exists('pagination'))
{
	function pagination($total, $parpage) {
		$segment = $this->uri->segment_array();
		$config['uri_segment'] = $config['num_links'] = end($segment);
		$config['use_page_numbers'] = true;
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<div class="first paginate_button">';

		$config['first_tag_close'] = '</div>';
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<div class="last paginate_button">';

		$config['last_tag_close'] = '</div>';
		$config['next_link'] = 'Next';

		$config['next_tag_open'] = '<div class="next paginate_button">';

		$config['next_tag_close'] = '</div>';
		$config['prev_link'] = 'Previous';
		$config['prev_tag_open'] = '<div class="previous paginate_button">';
		$config['prev_tag_close'] = '</div>';
		$config['cur_tag_open'] = '<a class="paginate_active">';
		$config['cur_tag_close'] = '</a>';
		$config['num_tag_open'] = '<div class="paginate_button">';
		$config['num_tag_close'] = '</div>';
		$config['base_url'] = base_url() . '/' . $this->router->class . '/' . $this->router->method;
		$config['total_rows'] = $total;
		$config['per_page'] = $parpage;
		$this->pagination->initialize($config);
		return $this->pagination->create_links();
	}
}

# For Upload Images
if (!function_exists('uploadimg'))
{
function uploadimg($imagename,$fieldname){
		$CI = get_instance();
		$CI->load->library('upload');		

		if (!file_exists($url)) {
		mkdir($url, 0777, true);
		}
		$config['upload_path'] = 'uploads/';
		$config['allowed_types'] = 'gif|jpeg|png|jpg';
		// $config['max_size'] = '1000';
		//$config['max_width'] = '1920';
		// $config['max_height'] = '1280';
		$config['encrypt_name'] = TRUE;
		$filename = explode(".", $imagename['name']);
		$exten = explode("/", $imagename["type"]);
		$new_name = base64_encode($filename[0] . date('Y-m-d h-i-s')) . '.' . $filename[1];
		$config['file_name'] = $new_name;
		$CI->upload->initialize($config);

		if (!$CI->upload->do_upload($fieldname)) {
		$error = array('error' => $CI->upload->display_errors());

		return "false";
		} else {
		$imgname = PT_BASE_URL."uploads/".$new_name; 
		$arr_image = array('upload_data' => $CI->upload->data());
		return "uploads/".$arr_image['upload_data']['file_name'];
		}
				
	
	} 
}


# For Print An array
	function pr($data){
		echo "<pre>"; print_r($data); 
		exit;
	}
	
	
# For Send Mail
function send_mail($to,$from,$message,$attch=null) {
		$ci= get_instance();
		$ci->email->set_newline("\r\n");
		$ci->email->from($from);
		$ci->email->to($to);
		$ci->email->subject("Invoice Details");
		$ci->email->attach($attch);
		$ci->email->message($message);
		if (!$ci->email->send()) {
					pr($ci->email->print_debugger());
				}
				else {
					return true;
				}
	}		

# For Seo URL
function seo_url($name) {
		$str = mb_strtolower($name, 'UTF-8');
		$finalseoname = preg_replace('/\s+/', '-',$str);
		return $finalseoname;
	}	

# For Standrad Seo URL
function standrad_seo_url($name) {
	$slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-',$name)));
	return $slug;
	}

function createSlug($str, $delimiter = '-'){

    $slug = strtolower(trim(preg_replace('/[\s-]+/', $delimiter, preg_replace('/[^A-Za-z0-9-]+/', $delimiter, preg_replace('/[&]/', 'and', preg_replace('/[\']/', '', iconv('UTF-8', 'ASCII//TRANSLIT', $str))))), $delimiter));
    return $slug;

} 	
	
	
