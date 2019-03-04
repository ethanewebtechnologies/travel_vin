<?php echo doctype('html5'); ?>
<html lang="en">
	
	<head>
		<?php 
    		$meta = array(
    		    array(
    		        'name' => 'X-UA-Compatible',
    		        'content' => 'IE=edge;', 'type' => 'equiv'
    		    ),
    		    array(
    		        'name' => 'Content-type',
    		        'content' => 'text/html; charset=utf-8', 'type' => 'equiv'
    		    ),
    		    array(
    		        'name' => 'viewport',
    		        'content' => 'width=device-width, initial-scale=1.0'
    		    ),
    		    array(
    		        'name' => 'description',
    		        'content' => 'Sunshine Vendor Board'
    		    ),
    		    array(
    		        'name' => 'keywords',
    		        'content' => 'sunshine, vendor, agent, travel, wedding'
    		    ),
    		    array(
    		        'name' => 'robots',
    		        'content' => 'no-cache'
    		    ),
    		);
    		
    		echo meta($meta);
		?>

		<?php echo link_tag('assets/admin/images/favicon.ico', 'shortcut icon', 'image/ico'); ?>
		
		<title>
			<?php echo $text_title; ?>
		</title>
		
		<?php echo link_tag('assets/admin/js/jquery-ui/css/no-theme/jquery-ui-1.10.3.custom.min.css'); ?>
    	<?php echo link_tag('assets/admin/css/font-icons/entypo/css/entypo.css'); ?>
    	<link rel="stylesheet" href="//fonts.googleapis.com/css?family=Noto+Sans:400,700,400italic">
    	<?php echo link_tag('assets/admin/css/bootstrap.css'); ?>
    	<?php echo link_tag('assets/admin/css/neon-core.css'); ?>
    	<?php echo link_tag('assets/admin/css/neon-theme.css'); ?>
    	<?php echo link_tag('assets/admin/css/neon-forms.css'); ?>
    	<?php echo link_tag('assets/admin/css/custom.css'); ?>
    	<?php echo link_tag('assets/admin/css/custom_new.css'); ?>

		<script src="<?php echo base_url('assets/admin/js/jquery-1.11.3.min.js'); ?>"></script>

	   <!--[if lt IE 9]>
	       <script src="assets/js/ie8-responsive-file-warning.js"></script>
	   <![endif]-->
	
	   <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	   
	   <!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	   <![endif]-->
	</head>
	<body class="page-body">
		<div class="page-container">
