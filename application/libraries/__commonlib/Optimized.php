<?php

/* Ethane API Development Team
 © 2017 Ethane, Inc. */

class Optimized {
	public function resize($filename, $width, $height, $class = '', $cropType = '') {
		
	    if (!is_file( $filename) || substr(str_replace('\\', '/', realpath( $filename)), 0, strlen('')) != str_replace('\\', '/', '')) {
			return;
		}
		
		$extension = pathinfo($filename, PATHINFO_EXTENSION);
		
		$image_old = $filename;
		
		$strip_filename = str_replace('content/image/main/','', $filename);
		
		$image_new = 'content/image/cache/' . substr($strip_filename, 0, strrpos($strip_filename, '.')) . '-' . (int)$width . 'x' . (int)$height . '.' . $extension;
		
		if (!is_file( $image_new) || (filemtime( $image_old) > filemtime( $image_new))) {
			list($width_orig, $height_orig, $image_type) = getimagesize( $image_old);
			
			if (!in_array($image_type, array(IMAGETYPE_PNG, IMAGETYPE_JPEG, IMAGETYPE_GIF))) { 
				return  $image_old;
			}
			
			$path = '';
			$directories = explode('/', dirname($image_new));
			
			foreach ($directories as $directory) {
				$path = $path . '/' . $directory;
				if (!is_dir(str_replace('\\','/',getcwd()).'/'. $path)) {
					@mkdir(str_replace('\\','/',getcwd()).'/'. $path, 0777);
				}
			}
			
			if ($width_orig != $width || $height_orig != $height) {
				
				$oldimage = getcwd().'/'. $image_old;
				$CI =& get_instance();
				$CI->load->library('__commonlib/Imagemoo_lib');
				
				if($cropType == 'resize_crop') {
					$CI->imagemoo_lib->load($oldimage)->resize_crop($width, $height)->save($image_new, $overwrite = FALSE);
				} else {
					$CI->imagemoo_lib->load($oldimage)->set_background_colour("#FFF")->resize($width, $height, TRUE)->save($image_new, $overwrite = FALSE);
				}	
				
			} else {
				copy( $image_old,  $image_new);
			}
		}
		
		$image_new = base_url(str_replace(' ', '%20', $image_new));  // fix bug when attach image on email (gmail.com). it is automatic changing space " " to +
		
		if(is_array($class)) {
			$result = '<img '.join(' ', array_map(function($key) use ($class) {
				if(is_bool($class[$key])) {
					return $class[$key] ? $key : '';
				}
				
				return $key.'="' . $class[$key] . '"';
			}, array_keys($class))).' src='.$image_new.' width='.$width.' height='.$height.' />';
			
			return $result;	
		} else {
			return "<img  class=\"{$class}\" src=\"{$image_new}\" width=\"{$width}\" height=\"{$height}\" />";
		}
	}
}
