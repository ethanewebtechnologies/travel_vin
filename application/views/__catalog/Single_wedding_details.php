<main>
	<section class="breadcrumbs">
		<div class="container">
			<div class="breadcrumbs-list">
				<?php if(isset($output_breadcrumb)) {echo $output_breadcrumb;}?>
			</div>
		</div>
	</section>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<section class="container-fluid">
			<section class="row">
				<div class="col-sm-7">
					<div class="tour_desc_wrap">
						<div class="tourdesc_bnr">
							<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php if(!empty($images)) { ?>
										<?php foreach($images as $i => $img) { ?>
											<div class="item <?php echo($i == 0) ? "active": ""; ?>">
												<?php if(isset($img) && file_exists($img['image'])) { ?>
                                            		<?php 
                                            		   $optimized = new Optimized();
                                            		   echo $optimized->resize($img['image'], 720, 367, array(), 'resize_crop');
                                            	   ?>
												<?php } else { ?>
													<?php
													   $optimized = new Optimized();
													   echo $optimized->resize('assets/img/empty.jpg', 720, 367, array(), 'resize_crop');
													?>
												<?php } ?>
											</div>
										<?php } ?>
									<?php } else { ?>	
										<?php
											$optimized = new Optimized();
											echo $optimized->resize('assets/img/empty.jpg', 720, 367, array(), 'resize_crop');
										?>
									<?php } ?>
								</div>
                                <a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
                                	<span class="fa fa-angle-left" aria-hidden="true"></span>
                                	<span class="sr-only"><?php echo $text_previous;?></span>
                                </a>
                                <a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
                                	<span class="fa fa-angle-right" aria-hidden="true"></span>
                                	<span class="sr-only"><?php echo $text_next;?></span>
                                </a>
							</div>
						</div>
						<div class="tour_name">
							<h3>
								<?php echo $wedding['title']; ?>
							</h3>
											
						</div>
                        <div class="tour_desc_content">
                       		<h3>
                       			<?php echo $text_description; ?>
                       		</h3>
                        	<?php echo $wedding['dsc']; ?>
                        </div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="tour_form_wrap">
						<div class="tourform_blk wedding_provider_dtl">					
							<div class="form-group provdr_title">
								
								<?php $text_name = $agent['company_legal_name'] ; ?> 
								<?php echo $text_name;?>

							</div>
							<div class="form-group provdr_mail">
								<?php $text_email = $agent['email'] ; ?> 
								<?php echo $text_email; ?>
							 </div>
							
							<div class="form-group provdr_loc">
								<?php $text_address =  $agent['address'] ; ?> 
								<?php echo $text_address; ?>
							</div>
							 <div class="form-group provdr_phone">
							   <?php $text_teliphpone = $agent['telephone'] ; ?> 
							   <?php echo $text_teliphpone; ?>
							</div>
						</div>
						<div class="pay_info_blk">
                        	<p>Your information is 100% safe with us, as we use a 128-bits encrypted transaction.</p>
                            <div>
                                <ul>
                                    <li class="sec_pay"><span></span></li>
                                    <li class="amipci"><span></span></li>
                                    <li class="paypal"><span></span></li>
                                </ul>
                            </div>
                            <div>
                                <ul>
                                	<li class="visa"><span></span></li>
                                	<li class="master"><span></span></li>
                                	<li class="visa"><span></span></li>
                                	<li class="paypl"><span></span></li>
                                </ul>
                            </div>
                            <div>
                                <ul>
                                	<li class="iosico"><a href=""><span></span></a></li>
                                	<li class="androidico"><a href=""><span></span></a></li>
                                </ul>
                            </div>
                        	<div>
                        		<ul>
                        			<li class="fblike"><span></span></li>
                        			<li class="fbshare"><span></span></li>
                        		</ul>
                        	</div>
                        	<div>
                        		<ul>
                        			<li class="tweet"><span></span></li>
                        		</ul>
                        	</div>
                            <div>
                            	<ul>
                            		<li class="gplus"><span></span></li>
                            	</ul>
                            </div>
                        </div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
</main>
<script src="<?php echo base_url('assets/js/jquery.form-validator.min.js'); ?>" ></script>	
<script>
	var forbidden = [<?php echo $blocked_dates; ?>];
	var _booking_min_adults = parseInt("<?php echo TV_MIN_ADULT_ALLOWED ?>");
	var _booking_max_adults = parseInt("<?php echo TV_MAX_ADULT_ALLOWED ?>");
</script>
<script src="<?php echo base_url('assets/js/bookings_date_time.js'); ?>" ></script>