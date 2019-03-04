<!DOCTYPE HTML>
<html lang="en">
    <head>
        <!-- Includes Core Meta Tag -->
    	<meta charset="utf-8">
    	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no, maximum-scale=1.0, user-scalable=no">
    	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    	
    	<!-- Includes Dynamic Meta Tag -->
    	<?php foreach ($meta_list as $meta) { ?>
    		<meta name="<?php echo $meta['property']; ?>" content="<?php echo $meta['content']; ?>" />
    	<?php } ?>
    	
    	<!-- Favicon -->
    	<link rel="icon" href="<?php echo base_url('assets/img/favicon.png'); ?>">
    	
    	<!--  Main Title of the website -->
    	<title><?php echo $title; ?></title>
    	
    	<!-- Bootstrap core CSS -->
    	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css'); ?>">
    	<link href="<?php echo base_url('assets/css/font-awesome.min.css'); ?>" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.fancybox.css'); ?>" media="screen" />
		
		<!-- Add Button helper (this is optional) -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/jquery.fancybox-buttons.css'); ?>" />
    	<link rel="stylesheet" href="<?php echo base_url('assets/css/animate.css'); ?>" >
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.bxslider.css'); ?>" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.mCustomScrollbar.css'); ?>">
		<link rel="stylesheet" href="<?php echo base_url('assets/css/timepicker.css'); ?>">
		<!--<link rel="stylesheet" href="http://davidstutz.github.io/bootstrap-multiselect/dist/css/bootstrap-multiselect.css">-->
    	
    	<!-- Includes dynamic Css -->
    	<?php foreach ($css_list as $css) { ?>
    		<link href="<?php echo $css; ?>" rel="stylesheet">
    	<?php } ?>
    	
    	<!-- Custom styles for this template -->
    	<link href="<?php echo base_url('assets/css/style.css'); ?>" rel="stylesheet">
		<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    	
    	<!-- Includes Bootstrap core js -->
        <!-- Placed at the end of the document so the pages load faster -->
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>		
    	<!-- removed s1 -->
    	<!-- removed s2 -->
		
		<!-- replace s1 remove s3 -->
		<script src="<?php echo base_url('assets/js/bootstrap.js'); ?>"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" />
		<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

		<script type="text/javascript">
    		var opts = {
        		"closeButton": true,
        		"debug": false,
        		"positionClass": "toast-top-center",
        		"onclick": null,
        		"showDuration": "300",
        		"hideDuration": "1000",
        		"timeOut": "5000",
        		"extendedTimeOut": "1000",
        		"showEasing": "swing",
        		"hideEasing": "linear",
        		"showMethod": "fadeIn",
        		"hideMethod": "fadeOut"
        	};
		</script>
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
		<style> 
            .toast {
                top:120px !important; 
                min-width: 400px;
            } 
		</style>
		<style>
		.loader1 {
		  height: 4px;
		  width: 100%;
		  position: relative;
		  overflow: hidden;
		  background-color: #ddd;
		}
		.loader1:before{
		  display: block;
		  position: absolute;
		  content: "";
		  left: -200px;
		  width: 200px;
		  height: 4px;
		  background-color: #fdb813;
		  animation: loading 2s linear infinite;
		}

		@keyframes loading {
			from {left: -200px; width: 30%;}
			50% {width: 30%;}
			70% {width: 70%;}
			80% { left: 50%;}
			95% {left: 120%;}
			to {left: 100%;}
		}
		</style>
    </head>
    <body>
    	
    	<!-- START HEADER SECTION -->
    	<header>
			<div class="loader1" style="display:block;"></div>
    		<section class="top_head wow flipInX">
    			<section class="container-fluid">
    				<section class="row">
    					<section class="col-md-3">
    					</section>
    					<section class="col-md-3 text-center">
    						<div class="sunshine_btn">
    							<a href="<?php echo base_url(); ?>" class="hvr-wobble-bottom">
    								<?php echo $text_subtitle; ?>
    							</a>
    						</div>
    					</section>
    					
    					<section class="col-md-6 text-right">
							<div class="dropdown ddbtn ddlang_btn">
								<button class="btn btn-secondary dropdown-toggle hvr-ripple-out" type="button" id="dropdownMenuButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									
    									
    										<?php echo $this->session->userdata('site_lang') ; ?>
    									
    								<i class="fa fa-caret-down" aria-hidden="true"></i>
								</button>
								
								<!-- <div class="dropdown-menu ddlang_menu" aria-labelledby="dropdownMenuButton1">
									<ul onchange="javascript:window.location.href='<?php echo base_url("translate/change_language"); ?>?lang_code=' + this.value + '&redirect_url=<?php echo current_url(); ?>'">
										<?php foreach ($languages as $lkey => $lvalue) { ?>
											
												<li value="<?php echo $lkey; ?>">
													<a href="<?php echo base_url('translate/change_language'); ?>?lang_code=<?php echo $lkey; ?>&redirect_url=<?php echo current_url(); ?>"><?php echo $lkey; ?></a>
												</li>
										
											<?php } ?>
									</ul>
								</div> -->
    						</div>
    						<a href="#contact-center" class="fancybox btn_style hvr-ripple-out"><?php echo $text_contact_center;?> </a>
                            <div id="contact-center" style="width: 400px; display: none;">
                                <div class="contact-address">
                                    <div class="ftr_blk">
                                        <h3><?php echo $text_contact_us;?></h3>
										<div class="contact_wrap">
											<?php echo html_entity_decode($header_configuration['contact_us']); ?>
										</div>
									</div>
                                </div>
                            </div>
							
    						<div id="loginpopup" style="width: 600px; display: none;">	
    							<div class="row">
    								<div class="col-sm-6">
    									<div class="travelimg">
    										<img src="<?php echo base_url('assets/img/travelimg.jpg'); ?>" alt="">
    									</div>
    								</div>
    								<div class="col-sm-6">
    									<!-- Nav tabs -->
    									<ul class="nav nav-tabs" role="tablist">
    										<li class="nav-item active">
    											<a class="nav-link" data-toggle="tab" href="#userlogin" role="tab" aria-expanded="true"><?php echo $text_user_login;?></a>
    										</li>
    										<li class="nav-item">
    											<a class="nav-link" data-toggle="tab" href="#agentlogin" role="tab" aria-expanded="false"><?php echo $text_agent_login;?></a>
    										</li>
    									</ul>
    									
    									<!-- Tab panes -->
    									<div class="tab-content">
    										<div class="tab-pane fade in active" id="userlogin" role="tabpanel" aria-expanded="true">
    											<div class="dropdown_form">
													<div id="user_error" class="form-group error" style="color:#ff0000;"></div>
    												<form onsubmit="return __verifyUser();" method="post" id="log-area-51" data-T51="<?php echo $this->security->get_csrf_token_name(); ?>" data-H51="<?php echo $this->security->get_csrf_hash(); ?>">
    													<div class="form-group">
    														<input type="text" name="__pop_user_email" id="__pop_user_email" placeholder="Email" class="form-control" data-validation="required">
    														<p id="user_email_error"></p>
														</div>
														<div class="form-group">
    														<input type="password" name="__pop_user_password" id="__pop_user_password" placeholder="Password" class="form-control"    data-validation="required">
    														<p id="user_password_error"></p>
														</div>
														<div class="form-group">
    														<input type="submit" id="__pop_user_submit" name="__pop_user_submit" value="Login">
    													</div>
    													<p><a href="<?php echo base_url('customer/forget-password'); ?>" class="fancybox"><?php echo $text_forgot_password;?></a></p>
    												</form>
    											</div>
    										</div>
    										<div class="tab-pane fade" id="agentlogin" role="tabpanel" aria-expanded="false">
    											<div class="dropdown_form">
													<div id="vendor_error" class="form-group error" style="color:#ff0000;"></div>
    												<form onsubmit="return __verifyVendor();" method="post">
    													<div class="form-group">
    														<input type="text" name="__pop_vendor_email" id="__pop_vendor_email" placeholder="Email" class="form-control" data-validation="required">
    														<p id="vendor_email_error"></p>
    														
														</div>
														<div class="form-group">
    														<input type="password" name="__pop_vendor_password" id="__pop_vendor_password"  placeholder="Password" class="form-control" data-validation="required">
															<p id="vendor_password_error"></p>
														</div>
														<div class="form-group">
    														<input type="submit" id="__pop_vendor_submit" name="__pop_vendor_submit" value="Login">
    													</div>
    													<p><a href="<?php echo base_url('vendor/account/forget-password'); ?>" class="fancybox"><?php echo $text_forgot_password;?></a></p>
    												</form>
    											</div>
    										</div>
    									</div>
    								</div>
    							</div>
    							<div class="reason_for_joining">
    								<h3><?php echo $text_register;?></h3>
    								<a href="<?php echo base_url('customer/registration'); ?>"><?php echo $text_register_as_user;?></a>
    								<a href="<?php echo base_url('become-an-agent'); ?>"><?php echo $text_register_as_agent;?></a>
    							</div>
    							
    						</div>
    						<div class="social_blk">
    							<ul>
    								<li><a href="<?php echo $header_configuration['social_fb']; ?>" class="hvr-hang"><i class="fa fa-facebook-official"></i></a></li>
    								<li><a href="<?php echo $header_configuration['social_insta']; ?>" class="hvr-hang"><i class="fa fa-instagram"></i></a></li>
    								<li><a href="<?php echo $header_configuration['social_twitter']; ?>" class="hvr-hang"><i class="fa fa-twitter"></i></a></li>
    								<li><a href="<?php echo base_url('cart');?>" class="hvr-hang"><img src="<?php echo base_url('assets/img/cart.png'); ?>" alt=""/><span id="cart-total"></span></a></li>
    							</ul>
    						</div>
    						
							<?php if($this->session->has_userdata('customer')) {?>
								<div class="dropdown ddbtn">
									<button class="btn btn-secondary dropdown-toggle hvr-ripple-out" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php 
                                            $customer_details = $this->session->userdata('customer');
                                            echo $text_greetings . ', ' . $customer_details['firstname'];
                                        ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
									</button>
									
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<ul class="db_lg_btn">
											<li><a href="<?php echo base_url('customer/dashboard'); ?>" class=""><?php echo $text_dashboard;?></a></li>
											<li><a href="<?php echo base_url('customer/orders'); ?>" class=""><?php echo $text_orders;?></a></li>
											<li><a href="#" class="" id="_logoutUser"><?php echo $text_logout;?></a></li>
										</ul>
									</div>
								</div>
							<?php } else { ?>
								<div class="dropdown ddbtn login-btns">
									<button class="btn btn-secondary dropdown-toggle hvr-ripple-out" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
										<?php 
                                            echo $text_greetings . ', ' . $text_guest;
                                        ?> <i class="fa fa-caret-down" aria-hidden="true"></i>
									</button>
									
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
										<a href="#loginpopup" class="fancybox btn_style">
											<?php echo $text_login;?>
										</a>
									</div>
								</div>
							<?php } ?>
    						
    					</section>
    				</section>
    			</section>
    		</section>
    		<section class="btm_head wow slideInDown" data-wow-duration="2s">
    			<section class="container-fluid">
    				<section class="row">
    					<section class="col-md-3">
    						<div class="logo">
    							<a href="<?php echo base_url(); ?>">
    								<img src="<?php echo base_url('assets/img/logo.png'); ?>" alt=""/>
    							</a>
    						</div>
    					</section>
    					<section class="col-md-9">
    						<nav class="navbar navbar-light navbar-default">
								<div class="container-fluid">
								<!-- Brand and toggle get grouped for better mobile display -->
									<div class="navbar-header">
										<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbarSupportedContent" aria-expanded="false">
											<span class="sr-only">Toggle navigation</span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
											<span class="icon-bar"></span>
										</button>
									</div>
		
									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="nav navbar-nav">
											<?php foreach ($menues as $menu) { ?>
												<li class="<?php echo $menu['is_active'] ? 'active' : ''; ?>">
													<?php if($menu['has_loc']) { ?>
														<a class="" href="<?php echo $menu['link']; ?>" data-link="<?php echo $menu['link']; ?>" data-title="<?php echo $menu['name']; ?>"><?php echo $menu['name']; ?></a>
													<?php } else { ?>
														<a onclick="mainSearch(this);" class="" href="javascript:void(0);" data-link="<?php echo $menu['link']; ?>" data-title="<?php echo $menu['name']; ?>"><?php echo $menu['name']; ?></a>
													<?php } ?>
												</li>
											<?php } ?>
											<!-- <li class="nav-item white_menu">
												<a class="nav-link" href="#">Blog</a>
											</li> -->
											<!-- <li class="nav-item white_menu">
												<a class="nav-link" href="#"><img src="assets/img/cart.png" alt=""/></a>
											</li> -->
										</ul>							
									</div>
								</div>
    						</nav>
    					</section>
    				</section>
    			</section>
    		</section>
    	</header>
    	<!-- END HEADER SECTION -->
    	
        <script type="text/javascript">
			$('#_logoutUser').on('click',function(e){
				e.preventDefault();
            	var currentPath = "<?php echo current_url(); ?>";
            	var postUrl = "<?php echo base_url('customer/login/logout'); ?>";
				var secureToken = $('form#log-area-51').attr('data-T51');
            	var secureHash = $('form#log-area-51').attr('data-H51');
            	var postMethod = "POST";
				var postData = {
					current_path: currentPath
            	};
            	postData[secureToken] = secureHash;
            	$.ajax({
            		url: postUrl,
            		method: postMethod,
					data: postData,
					
            		success: function(response) {
						$('form#log-area-51').attr('data-T51', response.secure_token);
            			$('form#log-area-51').attr('data-H51', response.secure_hash);
						window.location.href = response.url;
            			return false;
            		}
            	});
            	return false;
            });

            
            function __verifyUser() {
            	var userEmail = $('#__pop_user_email').val();
            	var userPassword = $('#__pop_user_password').val();
            	var userSubmit = $('#__pop_user_submit').val();
            	var secureToken = $('form#log-area-51').attr('data-T51');
            	var secureHash = $('form#log-area-51').attr('data-H51');
            	var currentPath = "<?php echo current_url(); ?>";
            	
            	var postUrl = "<?php echo base_url('customer/login'); ?>";
            	
            	var postMethod = "POST";
            	var postData = {
            			user_email: userEmail, 
            			user_password: userPassword,
            			user_submit: userSubmit,
            			current_path: currentPath
            	};
            
            	postData[secureToken] = secureHash;
            	
            	$.ajax({
            		url: postUrl,
            		method: postMethod,
            		data: postData,
					beforeSend: function() {
						$("#__pop_user_submit").val('Wait...');
						$("#__pop_user_submit").prop('disabled', true);
					},
					complete: function() {
						$("#__pop_user_submit").val('Login');
						$("#__pop_user_submit").prop('disabled', false);
					},
            		success: function(response) {
						$("#__pop_vendor_submit").val('Login');
						$("#__pop_vendor_submit").prop('disabled', false);

            			$('form#log-area-51').attr('data-T51', response.secure_token);
            			$('form#log-area-51').attr('data-H51', response.secure_hash);

						if(response.verification_error) {
            				$('#user_error').html(response.verification_error);
							$('#user_password_error').html('');
            				$('#user_email_error').html('');
            			} else if(response.validation_error) {
							$('#user_error').html('');
            				$('#user_password_error').html(response.password_error);
            				$('#user_email_error').html(response.email_error);
							$('.form-group').attr('class','form-group error');
            			} else if(response.url) {
                			window.location.href = response.url;
            			}
            			
            			return false;
            		}
            	});
            	
            	return false;
            }

            function __verifyVendor() {
            	var vendorEmail = $('#__pop_vendor_email').val();
            	var vendorPassword = $('#__pop_vendor_password').val();
            	var vendorSubmit = $('#__pop_vendor_submit').val();
            	var secureToken = $('form#log-area-51').attr('data-T51');
            	var secureHash = $('form#log-area-51').attr('data-H51');
            	var currentPath = "<?php echo current_url(); ?>";
            	
            	var postUrl = "<?php echo base_url('vendor/account/login/ajax_login'); ?>";
            	
            	var postMethod = "POST";
            	var postData = {
        			vendor_email: vendorEmail, 
        			vendor_password: vendorPassword,
        			vendor_submit: vendorSubmit,
        			current_path: currentPath
            	};
            
            	postData[secureToken] = secureHash;
            	
            	$.ajax({
            		url: postUrl,
            		method: postMethod,
            		data: postData,
					beforeSend: function() {
						$("#__pop_vendor_submit").val('Wait...');
						$("#__pop_vendor_submit").prop('disabled', true);
					},
					complete: function() {
						$("#__pop_vendor_submit").val('Login');
						$("#__pop_vendor_submit").prop('disabled', false);
					},
            		success: function(response) {
						$("#__pop_vendor_submit").val('Login');
						$("#__pop_vendor_submit").prop('disabled', false);
						
            			$('form#log-area-51').attr('data-T51', response.secure_token);
            			$('form#log-area-51').attr('data-H51', response.secure_hash);
						
						if(response.validation_error) {
            				$('#vendor_error').html('');
							$('#vendor_email_error').html(response.email_error);
            				$('#vendor_password_error').html(response.password_error);
							$('.form-group').attr('class','form-group error');
            			} else if(response.verification_error) {
            				$('#vendor_error').html(response.verification_error);
							$('#vendor_email_error').html('');
            				$('#vendor_password_error').html('');
							$('.form-group').attr('class','form-group error');
            				
            			} else if(response.url) {
                			window.location.href = response.url;
            			}

            			return false;
            		}
            	});
            	
            	return false;
            }


            /*
                 Possible bug?  If you have a selector that matches zero elements and call destroy, all mcustomscrollbars
                 are destroyed.
                 
                 Uncomment the last line and run this fiddle and notice that all scrollbars are destroyed.  I would expected
                 no effect.

            */
				
			function get_cart_total() {
				$.ajax({
					url: '<?php echo base_url('cart/get_cart_item_count');?>', 
					method: 'get',
					dataType: "json",
					success: function(resp) {
						if(resp._CART_TOTAL != null) {
							$('#cart-total').html('');
							$('#cart-total').html('<span class="badge-cart" >'+resp._CART_TOTAL+'</span>');
						}
						else{
							$('#cart-total').html('');
						}
					}
				});
			};
			
			$(function() {
				$(window).on('load',function(){
					get_cart_total();
					$(".loader1").css('display','none');
				} );
			});

        </script>  
		