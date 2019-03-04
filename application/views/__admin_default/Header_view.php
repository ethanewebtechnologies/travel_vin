<html lang="en">
	<head>
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    	<link rel="shortcut icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    	
    	<title><?php echo $text_title; ?></title>
    	<link href="<?php echo base_url('assets/admin/css/style.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/css/login.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/css/admin.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/css/fa.min.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/css/animate.min.css'); ?>" rel="stylesheet">
        <link href="<?php echo base_url('assets/admin/css/neon-forms.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/include/login/ladda-themeless.min.css'); ?>" rel="stylesheet">
    	<link href="<?php echo base_url('assets/admin/css/font-icons/entypo/css/entypo.css'); ?>" rel="stylesheet">
    	<script src="<?php echo base_url('assets/admin/js/jquery-1.11.2.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/admin/include/login/spin.min.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/admin/include/login/ladda.min.js'); ?>"></script>
    	<script src="<?php echo base_url('assets/admin/js/wow.min.js'); ?>"></script> 
  	</head>
  	<style>
        body {
            width: 100%;
            height: 100%;
            background: #087830;
        }
        
        #rotatingDiv {
            display: block;
            margin: 32px auto;
            height: 100px;
            width: 100px;
            -webkit-animation: rotation .9s infinite linear;
            -moz-animation: rotation .9s infinite linear;
            -o-animation: rotation .9s infinite linear;
            animation: rotation .9s infinite linear;
            border-left: 8px solid rgba(0,0,0,.20);
            border-right: 8px solid rgba(0,0,0,.20);
            border-bottom: 8px solid rgba(0,0,0,.20);
            border-top: 8px solid rgba(33,128,192,1);
            border-radius: 100%;
        }
        
        @keyframes rotation {
            from {
                transform: rotate(0deg);
            }
            to {
                transform: rotate(359deg);
            }
        }
        
        @-webkit-keyframes rotation {
            from {
                -webkit-transform: rotate(0deg);
            }
            to {
                -webkit-transform: rotate(359deg);
            }
        }
        
        @-moz-keyframes rotation {
            from {
                -moz-transform: rotate(0deg);
            }
            
            to {
                -moz-transform: rotate(359deg);
            }
        }
        
        @-o-keyframes rotation {
            from {
                -o-transform: rotate(0deg);
            }
            to {
                -o-transform: rotate(359deg);
            }
        }
        
        input:-webkit-autofill,
        input:-webkit-autofill:hover,
        input:-webkit-autofill:focus,
        input:-webkit-autofill:active {
            transition: background-color 5000s ease-in-out 5s;
        }
    </style>


