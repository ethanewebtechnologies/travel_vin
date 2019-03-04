		<div id="explore_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
                <!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title" id="exampleModalLabel">
							<?php echo $text_select_location; ?>
						</h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php 
							$attributes = array(
								'id' => 'mainSearchForm',
								'class' => 'form-horizontal form-groups-bordered',
							    'onsubmit' => '__searchONSubmit(); return false;'
							);
							
							echo form_open('', $attributes);
						?>
							<p>	
								<select class="" name="__vUsrSlcCtry" id="__vUsrSlcCtry" onchange="enable_disable_btn(this.value),get_cities(this.value)">
									<option value="">---<?php echo $text_select_country; ?>---</option>
									<?php foreach ($countries as $country) { ?>
										<option value="<?php echo $country['seo_url']; ?>">
											<?php echo $country['name']; ?>
										</option>
									<?php } ?>
								</select>
								<select class="" name="__vUsrSlcCity" id="__vUsrSlcCity" onchange="enable_disable_btn(this.value)" disabled>
									<option value="">---<?php echo $text_select_city; ?>---</option>
								</select>
								+ <span id="searchTitle"></span>
							</p>
							<p class="text-center">
								<button class="hvr-bounce-to-bottom" id="city-country-search-btn"><?php echo $text_button_search; ?></button>
							</p>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		
		
		<div id="item_search_modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
			<div class="modal-dialog" role="document">
                <!-- Modal content-->
				<div class="modal-content">
					<div class="modal-header">
						<h2 class="modal-title" id="exampleModalLabel1">
							<?php echo $text_select_location; ?>
						</h2>
						<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<?php 
							$attributes = array(
								'id' => 'itemSearchForm',
								'class' => 'form-horizontal form-groups-bordered',
							    'onsubmit' => '__searchItemONSubmit(); return false;'
							);
							
							echo form_open('', $attributes);
						?>
							<p>	
								<select class="" name="__iUsrSlcItem" id="__iUsrSlcItem" onchange="item_enable_disable_btn(this.value)">
									<?php foreach ($items_container as $key => $value) { ?>
										<option value="<?php echo $key; ?>">
											<?php if($key == ""){?>
											---<?php echo $value; ?>---
											<?php }else{?>
											<?php echo $value; ?>
											<?php }?>
										</option>
									<?php } ?>
								</select>
								<select class="" name="__iUsrSlcCtry" id="__iUsrSlcCtry" onchange="item_enable_disable_btn(this.value),get_cities_item(this.value)">
									<option value="">---<?php echo $text_select_country; ?>---</option>
									<?php foreach ($countries as $country) { ?>
										<option value="<?php echo $country['seo_url']; ?>">
											<?php echo $country['name']; ?>
										</option>
									<?php } ?>
								</select>
								<select class="" name="__iUsrSlcCity" id="__iUsrSlcCity" onchange="item_enable_disable_btn(this.value)" disabled>
									<option value="">---<?php echo $text_select_city; ?>---</option>
								</select>
							</p>
							<p class="text-center">
								<button class="hvr-bounce-to-bottom" id="city-country-item-search-btn"><?php echo $text_button_search; ?></button>
							</p>
						<?php echo form_close(); ?>
					</div>
				</div>
			</div>
		</div>
		
		<section class="cta_blk">
			<section class="container">
				<section class="row">
					<div class="col-sm-12">
						<div class="head_blk wow flipInX" data-wow-delay="0.5s">
							<h3><?php echo $title; ?> <?php echo $text_agent_portal;?></h3>
			  				<a href="<?php echo base_url('become-an-agent'); ?>" class="hvr-wobble-bottom"><?php echo $text_button_footer_register_now; ?></a>
			 			</div>
					</div>
        			<div class="col-sm-4 no-padding">
        			 	<div class="talk_blk wow zoomIn" data-wow-duration="1s" data-wow-delay="0s">   
        			 		<h2><?php echo $text_business_talk; ?></h2>
        			  		<a href="<?php echo base_url('talk-about-business'); ?>" class="hvr-shutter-out-horizontal"><?php echo $text_button_click_here; ?></a>
        			 	</div>
        			</div>
        			<div class="col-sm-4 no-padding">
        			 	<div class="chat_blk wow zoomIn" data-wow-duration="1s" data-wow-delay="0.3s">
        			  		<img src="<?php echo base_url('assets/img/chat_ico.png'); ?>" alt=""/>
        			  		<h2><?php echo $text_live_chat; ?></h2>
        			 	</div>
        			</div>
					<div class="col-sm-4 no-padding">
			 			<div class="login_blk wow zoomIn" data-wow-duration="1s" data-wow-delay="0.6s">
			  				<h2><?php echo $text_title_newsletter; ?></h2>
							<p id="subscribe_email_error" style="color:red;"></p>
			  				<form onsubmit="return __subscribeEmail();" method="post" id="email-subscription-51" data-T51="<?php echo $this->security->get_csrf_token_name(); ?>" data-H51="<?php echo $this->security->get_csrf_hash(); ?>">
			   					<input type="email" name="subscriber_email" id="subscriber_email" placeholder="<?php echo $text_placeholder_provide_email; ?>" />
			   					<button class="hvr-shutter-out-horizontal"><?php echo $text_button_subscribe; ?></button>
			  				</form>
			 			</div>
					</div>
		   		</section>
		  	</section>
		</section>
		<footer class="wow flipInX" data-wow-duration="1s">
    		<section class="container-fluid">
    			<section class="row">
    				<div class="col-sm-4">
    					<div class="ftr_blk">
    						<div class="ftr_links">
    							<?php if($pages) { ?>
        							<h3><?php echo $text_sitemap;?></h3>
        							<ul>
        								<li><a href="<?php echo base_url(); ?>"><?php echo $text_home;?></a></li>
            							<?php foreach (@$pages as $page) { ?>
            								<li>
            									<a href="<?php echo base_url(@$page['page_slug']); ?>">
            										<?php echo @$page['page_name']; ?>
            									</a>
            								</li>
            							<?php } ?>
        							</ul>
    							<?php } ?>	
    							<div class="ftr_scl_link">
    								<ul>
    									<li><a href="<?php echo $footer_configuration['social_fb']; ?>" class="hvr-hang"><i class="fa fa-facebook-official"></i></a></li>
    									<li><a href="<?php echo $footer_configuration['social_insta']; ?>" class="hvr-hang"><i class="fa fa-instagram"></i></a></li>
    									<li><a href="<?php echo $footer_configuration['social_twitter']; ?>" class="hvr-hang"><i class="fa fa-twitter"></i></a></li>
    								</ul>
    							</div>
    						</div>
    					</div>
    				</div>
    				<!--<div class="col-sm-3">
    					<div class="ftr_blk">
    						<div class="ftr_links">
    							<h3><?php echo $text_top_destination;?></h3>
    							<div class="row">
    								<div class="col-sm-6">
    									<div class="dashed_list">
    										<h4>MEXICO</h4>
    										<ul>
    											<li><a href="">Cancun</a></li>
    											<li><a href="">Acapulco</a></li>
    											<li><a href="">Riviera Maya</a></li>
    											<li><a href="">Mazatlan</a></li>
    											<li><a href="">Puerto Vallarta</a></li>
    											<li><a href="">Los Cabos</a></li>
    										</ul>
    									</div>
    								</div>
    								<div class="col-sm-6">
    									<div class="dashed_list">
    										<h4>DOMINICAN</h4>
    										<ul>
    											<li><a href="">Boca Chica</a></li>
    											<li><a href="">Bayahibe</a></li>
    											<li><a href="">La Romana</a></li>
    											<li><a href="">Samana</a></li>
    											<li><a href="">Punta Cana</a></li>
    											<li><a href="">Puerto Plata</a></li>
    										</ul>
    									</div>
    								</div>
    							</div>
    						</div>
    					</div>
    				</div>-->
    				<div class="col-sm-4">
    					<div class="ftr_blk">
    						<h3><?php echo $text_travel_blog;?></h3>
    						<div class="ftr_blog_list">
    							<ul>
									<?php if(!empty($footer_configuration['blog_1_title']) && !empty($footer_configuration['blog_1_link'])){?>
    								<li><a href="<?php echo $footer_configuration['blog_1_link'];?>"><?php echo $footer_configuration['blog_1_title'];?></a></li>
									<?php }?>
									<?php if(!empty($footer_configuration['blog_2_title']) && !empty($footer_configuration['blog_2_link'])){?>
    								<li><a href="<?php echo $footer_configuration['blog_2_link'];?>"><?php echo $footer_configuration['blog_2_title'];?></a></li>
									<?php }?>
									<?php if(!empty($footer_configuration['blog_3_title']) && !empty($footer_configuration['blog_3_link'])){?>
    								<li><a href="<?php echo $footer_configuration['blog_3_link'];?>"><?php echo $footer_configuration['blog_3_title'];?></a></li>
									<?php }?>
									<?php if(!empty($footer_configuration['blog_4_title']) && !empty($footer_configuration['blog_4_link'])){?>
    								<li><a href="<?php echo $footer_configuration['blog_4_link'];?>"><?php echo $footer_configuration['blog_4_title'];?></a></li>
									<?php }?>
									<?php if(!empty($footer_configuration['blog_5_title']) && !empty($footer_configuration['blog_5_link'])){?>
    								<li><a href="<?php echo $footer_configuration['blog_5_link'];?>"><?php echo $footer_configuration['blog_5_title'];?></a></li>
									<?php }?>
    							</ul>
    						</div>
    					</div>
    				</div>
    				<div class="col-sm-4">
    					<div class="ftr_blk">
    						<h3><?php echo $text_contact_us;?></h3>
    						<div class="contact_wrap">
    							<?php echo html_entity_decode($footer_configuration['contact_us']); ?>
    						</div>
    					</div>
    				</div>
    			</section>
    		</section>
    		<p class="copyright">&copy; <?php echo $footer_configuration['copyright']; ?>, Designed & Developed By : <a href="http://www.ethanetechnologies.com/" target="_blank">Ethane Technologies Pvt. Ltd.</a></p>
    	</footer>

		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
    	<script>
			$.validate({
				lang: 'en',
				modules : 'file, html5, security'
				
			});
    	</script>
    	
		<script src="<?php echo base_url('assets/js/jquery.mCustomScrollbar.concat.min.js'); ?>"></script>
		<script src="<?php echo base_url('assets/js/jquery.fancybox.js'); ?>" type="text/javascript"></script>
		<script src="<?php echo base_url('assets/js/jquery.fancybox-buttons.js'); ?>" type="text/javascript"></script>
    	<script src="<?php echo base_url('assets/js/wow.js'); ?>"></script>
		<!--<script src="http://davidstutz.github.io/bootstrap-multiselect/dist/js/bootstrap-multiselect.js"></script>-->
        	
    	<script>
    		new WOW().init();		

			(function($) {
				$(window).on("load",function() {
					$("#content-1").mCustomScrollbar({
						axis: "x",
						theme: "dark-3",
						advanced: {
							autoExpandHorizontalScroll: true 
							// optional (remove or set to false for non-dynamic/static elements)
						}
					});
				});
			}) (jQuery);
    	</script>
        	
    	<script type="text/javascript">	
    		$(document).ready(function() {
    			$('.fancybox-buttons').fancybox({
    				openEffect  : 'none',
    				closeEffect : 'none',
    
    				prevEffect : 'none',
    				nextEffect : 'none',
    
    				closeBtn  : false,
    
    				helpers : {
    					title : {
    						type : 'inside'
    					},
    					
    					buttons	: {}
    				},
    
    				// afterLoad : function() {
    					// this.title = 'Image ' + (this.index + 1) + ' of ' + this.group.length + (this.title ? ' - ' + this.title : '');
    				// }
    			});
    		});
    		
    		$(document).ready(function($) {
    			$(".fancybox1").on("click", function() {
    				$.fancybox({
    				  href: this.href,
    				  type: $(this).data("type")
    				}); // fancybox

    				return false   
    			}); // on
    		}); // ready

    		$(document).ready(function() {
    			$('.fancybox').fancybox();
    		});		
    	</script>
    	
    	<script src="<?php echo base_url('assets/js/jquery.bxslider.min.js'); ?>"></script>
    	
    	<script type="text/javascript">
    		$('.bxslider').bxSlider({
    			maxSlides: 3,
    			slideWidth: 380,
    			slideMargin: 10,
    			responsive: true,
    			controls: true,
    			moveSlides: 1,
    			adaptiveHeight: true,
    			pager: false
    		});
    	</script>
    	
    	<script>
    		$(window).scroll(function() {
    			if ($(this).scrollTop() > 150) {
    			   $('header').addClass('newClass');
    			} else {
    			   $('header').removeClass('newClass');
    			}
    		});
    	</script>
    	
    	<script src="<?php echo base_url('assets/js/remodal.js'); ?>"></script>
        
    	<!-- Events -->
    	<script>
            $(document).on('opening', '.remodal', function () {
            	console.log('opening');
            });
            
            $(document).on('opened', '.remodal', function () {
            	console.log('opened');
            });
            
            $(document).on('closing', '.remodal', function (e) {
            	console.log('closing' + (e.reason ? ', reason: ' + e.reason : ''));
            });
            
            $(document).on('closed', '.remodal', function (e) {
            	console.log('closed' + (e.reason ? ', reason: ' + e.reason : ''));
            });
            
            $(document).on('confirmation', '.remodal', function () {
            	console.log('confirmation');
            });
            
            $(document).on('cancellation', '.remodal', function () {
            	console.log('cancellation');
            });
        
            //  Usage:
            //  	$(function() {
            //    		// In this case the initialization function returns the already created instance
            //    		var inst = $('[data-remodal-id=modal]').remodal();
            //    		inst.open();
            //    		inst.close();
            //    		inst.getState();
            //    		inst.destroy();
            //  	});
        
        	//  The second way to initialize:
            $('[data-remodal-id=modal2]').remodal({
            	modifier: 'with-red-theme'
            });
		</script>
              
        <script src="<?php echo base_url('assets/js/index.js'); ?>"></script>
    	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="<?php echo base_url('assets/js/bootstrap-timepicker.js'); ?>"></script>
        
        <!-- INCLUDES JS -->
    	<?php foreach ($jslist as $js) { ?>
    		<script type="text/javascript" src="<?php echo base_url('assets/js/' . $js . '.js'); ?>"></script>
    	<?php } ?>
    	
		<script type="text/javascript">
			function __subscribeEmail() {
            	var userEmail = $('#subscriber_email').val();
            	var subscriptionType = 'Newsletter';
            	var secureToken = $('form#email-subscription-51').attr('data-T51');
            	var secureHash = $('form#email-subscription-51').attr('data-H51');
            	var currentPath = "<?php echo current_url(); ?>";
            	var postUrl = "<?php echo base_url('customer/subscription'); ?>";
            	var postMethod = "POST";
            	var postData = {
            			subscriber_email: userEmail,
            			current_path: currentPath,
						subscription_type: subscriptionType
            	};
            	postData[secureToken] = secureHash;
            	$.ajax({
            		url: postUrl,
            		method: postMethod,
            		data: postData,
            		success: function(response) {
            			$('form#email-subscription-51').attr('data-T51', response.secure_token);
            			$('form#email-subscription-51').attr('data-H51', response.secure_hash);
						if(response.verification_error) {
            				$('#subscribe_email_error').html(response.verification_error);
            			} else if(response.validation_error) {
            				$('#subscribe_email_error').html(response.email_error);
            			} else if(response.url) {
                			window.location.href = response.url;
            			}
            			return false;
            		}
            	});
            	return false;
            }
			
			
        	mainSearch = function(currentObj) {
    			var searchTitle = $(currentObj).attr('data-title');
    			var searchLink = $(currentObj).attr('data-link');
    
    			$("#searchTitle").html(searchTitle);
    			$("#mainSearchForm").attr('action', searchLink);
    
    			$('#explore_modal').modal('show');
    		};
			
			itemSearch = function(currentObj) {
    			var searchTitle = $(currentObj).attr('data-title');
    			var searchLink = $(currentObj).attr('data-link');
    			$("#itemSearchForm").attr('action', searchLink);
    
    			$('#item_search_modal').modal('show');
    		};

    		var __searchONSubmit = function() {
            	var get_country = $('#__vUsrSlcCtry').val();
            	var get_city = $('#__vUsrSlcCity').val();
				if(get_country==''){
					$("#__vUsrSlcCtry").addClass('err-border');
					$("#city-country-search-btn").prop('disabled', true);
				}
				else if(get_city==''){
					$("#__vUsrSlcCity").addClass('err-border');
					$("#city-country-search-btn").prop('disabled', true);
				}
				else{
					$("#city-country-search-btn").prop('disabled', false);
					var searchAction = $("#mainSearchForm").attr('action');
					searchAction = searchAction + '/' + get_country + '/' + get_city;
					window.location.href = searchAction;
					
				}
        	};
			
			var __searchItemONSubmit = function() {
            	var get_item = $('#__iUsrSlcItem').val();
            	var get_country = $('#__iUsrSlcCtry').val();
            	var get_city = $('#__iUsrSlcCity').val();
				if(get_item==''){
					$("#__iUsrSlcItem").addClass('err-border');
					$("#city-country_item-search-btn").prop('disabled', true);
				}
				else if(get_country==''){
					$("#__iUsrSlcCtry").addClass('err-border');
					$("#city-country_item-search-btn").prop('disabled', true);
				}
				else if(get_city==''){
					$("#__iUsrSlcCity").addClass('err-border');
					$("#city-country_item-search-btn").prop('disabled', true);
				}
				else{
					$("#city-country_item-search-btn").prop('disabled', false);
					var searchAction = $("#itemSearchForm").attr('action');
					searchAction = searchAction + get_item + '/' + get_country + '/' + get_city;
					window.location.href = searchAction;
					
				}
        	};
			
			var enable_disable_btn = function(value){
				var get_country = $('#__vUsrSlcCtry').val();
            	var get_city = $('#__vUsrSlcCity').val();
				if(get_country!=''){
					$("#__vUsrSlcCtry").removeClass('err-border');
				}
				else{
					$("#__vUsrSlcCtry").addClass('err-border');
				}
				if(get_city!=''){
					$("#__vUsrSlcCity").removeClass('err-border');
				}
				else{
					$("#__vUsrSlcCity").addClass('err-border');
				}
				if(get_country!='' && get_city!=''){
					$("#__vUsrSlcCtry").removeClass('err-border');
					$("#__vUsrSlcCity").removeClass('err-border');
					$("#city-country-search-btn").prop('disabled', false);
				}
			};
			
			var item_enable_disable_btn = function(value){
				var get_item = $('#__iUsrSlcItem').val();
				var get_country = $('#__iUsrSlcCtry').val();
            	var get_city = $('#__iUsrSlcCity').val();
				if(get_item!=''){
					$("#__iUsrSlcItem").removeClass('err-border');
				}
				else{
					$("#__iUsrSlcItem").addClass('err-border');
				}
				if(get_country!=''){
					$("#__iUsrSlcCtry").removeClass('err-border');
				}
				else{
					$("#__iUsrSlcCtry").addClass('err-border');
				}
				if(get_city!=''){
					$("#__iUsrSlcCity").removeClass('err-border');
				}
				else{
					$("#__iUsrSlcCity").addClass('err-border');
				}
				if(get_country!='' && get_city!=''){
					$("#__iUsrSlcCtry").removeClass('err-border');
					$("#__iUsrSlcCity").removeClass('err-border');
					$("#city-country-item-search-btn").prop('disabled', false);
				}
			};
			
			var get_cities = function(coountry_seo_url){
				if(coountry_seo_url!='' || coountry_seo_url!='undefined'){
					var getUrl = "<?php echo base_url('home/get_cities_by_country_seo_url'); ?>";
					$.ajax({
						url: getUrl,
						method: "GET",
						data: {seo_url:coountry_seo_url},
						dataType:'json',
						success: function(res) {
							if (res) {
								$("#__vUsrSlcCity").prop('disabled', false);
								$("#__vUsrSlcCity").empty();
								$("#__vUsrSlcCity").append('<option value="">Select a City</option>');

								for (var i = 0; i < res.length; i++) {
									$("#__vUsrSlcCity").append('<option value="' + res[i].seo_url +'">' + res[i].name + '</option>');
								}
							}
						}
					});
				}
				else{
					return false;
				}
			};
			
			var get_cities_item = function(coountry_seo_url){
				if(coountry_seo_url!='' || coountry_seo_url!='undefined'){
					var getUrl = "<?php echo base_url('home/get_cities_by_country_seo_url'); ?>";
					$.ajax({
						url: getUrl,
						method: "GET",
						data: {seo_url:coountry_seo_url},
						dataType:'json',
						success: function(res) {
							if (res) {
								$("#__iUsrSlcCity").prop('disabled', false);
								$("#__iUsrSlcCity").empty();
								$("#__iUsrSlcCity").append('<option value="">Select a City</option>');

								for (var i = 0; i < res.length; i++) {
									$("#__iUsrSlcCity").append('<option value="' + res[i].seo_url +'">' + res[i].name + '</option>');
								}
							}
						}
					});
				}
				else{
					return false;
				}
			};

        	$('.countries').mCustomScrollbar({ 
                theme: "dark-3"        
        	});
        	
		</script>
		
		<?php if($this->session->flashdata('__es_success') && $this->session->flashdata('__es_success')!=''){?>
		<script type="text/javascript">
			toastr.success("<?php echo $this->session->flashdata('__es_success');?>", "Success!", opts);
		</script>
		<?php }?>
		<?php if($this->session->flashdata('__es_error') && $this->session->flashdata('__es_error')!=''){?>
		<script type="text/javascript">
			toastr.error("<?php echo $this->session->flashdata('__es_error');?>", "Oops!", opts);
		</script>	
		<?php }?>
		
		<!--Start of Zendesk Chat Script-->
		<script type="text/javascript">
		window.$zopim||(function(d,s){var z=$zopim=function(c){z._.push(c)},$=z.s=
		d.createElement(s),e=d.getElementsByTagName(s)[0];z.set=function(o){z.set.
		_.push(o)};z._=[];z.set._=[];$.async=!0;$.setAttribute("charset","utf-8");
		$.src="https://v2.zopim.com/?5OWx6KdUSxULb0TdwekaeUvmTQzBKfui";z.t=+new Date;$.
		type="text/javascript";e.parentNode.insertBefore($,e)})(document,"script");
		</script>
		<!--End of Zendesk Chat Script-->
		
	</body>
</html>