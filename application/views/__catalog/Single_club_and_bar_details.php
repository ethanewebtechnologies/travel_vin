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
								<?php echo $club_and_bar['title']; ?>
							</h3>	
							<div>
							<?php if($club_and_bar['price'] != 0 ){ ?>
								$<?php echo number_format($club_and_bar['price']); ?> USD
							<?php } ?>	
							</div>
						</div>
                        <div class="tour_desc_content">
                       		<h3>
                       			<?php echo $text_description; ?>
                       		</h3>
                        	<?php echo $club_and_bar['dsc']; ?>
                        </div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="tour_form_wrap">
						<div class="tourform_blk">
							<?php echo form_open(); ?>
								<input type="hidden" name="_pid" value="<?php echo $club_and_bar['club_and_bar_id']; ?>" />
								<input type="hidden" name="backurl" value="<?php echo current_url(); ?>" />
                               
								<div class="form-group">
									<label>
										<?php echo $text_price; ?>
										
									</label>
									$<?php echo number_format($club_and_bar['price'],PRICE_DELIMITER) ; ?> USD

								</div>
								<div class="form-group">
									<?php 
									echo form_label($text_booking_adults, 'booking_adults');
                                        
                                        $attributes = array(
											'type' => 'number',
                                            'name' => 'booking_adults',
                                            'id'    => 'input_adult',
                                            'value' => set_value('booking_adults'),
											'autocomplete'=>'off',
											'data-validation'=>'required number' ,
											'data-validation-allowing' => '[1-9]+'
                                        ); 
                                        
                                        echo form_input($attributes);
                                        echo form_error('booking_adults');
                                    ?>	
                                 </div>
								
                                <div class="form-group">
                                    <?php 
                                        echo form_label($text_club_and_bar_start_date,'start_date');
                                        
                                        $attributes = array(
                                            'name' => 'start_date',
                                            'id'=>'datepicker1',
                                            'value' => set_value('start_date'),
											'autocomplete'=>'off',
											'data-validation'=>'required' ,
                                        ); 
                                        
                                        echo form_input($attributes);	
                                        echo form_error('start_date');
                                    ?>
                                </div>
								
                                <div class="form-group">
                                    <?php 
                                        echo form_label($text_pickup_time,'pickup_time');
                                        
                                        $attributes = array(
                                            'name' => 'pickup_time',
                                            'id'=>'timepicker2',
                                            'class'=>'input-small',
                                            'value' => set_value('start_time'),
											'autocomplete'=>'off',
											'data-validation'=>'required' ,
                                        ); 
                                        
                                        echo form_input($attributes);	
                                        echo form_error('pickup_time');
                                    ?>
                                </div>
                                <div class="btn_blk">
                                    <?php
                                        $data = array(
                                            'name'          => 'submit',
                                            'id'            => 'submit',
                                            'value'         => @$text_submit,
                                            'type'          => 'submit',
                                            'content'       => $text_submit
                                        );
                                        
                                        echo form_button($data);
                                    ?>
                                </div>
							<?php echo form_close(); ?>
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