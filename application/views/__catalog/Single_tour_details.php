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
								<?php echo $tour['title']; ?>
							</h3>
							<div>
								<?php if($tour['adult_price'] != 0 && $tour['adult_deal_price'] != 0) { ?>
									<span>
										<strike>$<?php echo number_format($tour['adult_price'], PRICE_DELIMITER); ?> USD</strike>
									</span> 
									$<?php echo number_format($tour['adult_deal_price']); ?> USD
								<?php } else if($tour['adult_price'] == 0 && $tour['adult_deal_price'] != 0) { ?>
									$<?php echo number_format($tour['adult_deal_price']); ?> USD
								<?php } else if($tour['adult_price'] != 0 && $tour['adult_deal_price'] == 0) { ?>
									<span>$<?php echo number_format($tour['adult_price'],PRICE_DELIMITER); ?> USD</span> 
								<?php } ?>
							</div>
						</div>
                        <div class="tour_desc_content">
                       		<h3>
                       			<?php echo $text_description; ?>
                       		</h3>
                        	<?php echo $tour['dsc']; ?>
                        </div>
					</div>
				</div>
				<div class="col-sm-5">
					<div class="tour_form_wrap">
						<div class="tourform_blk">
							<?php echo form_open(); ?>
								<input type="hidden" name="_pid" value="<?php echo $tour['tour_id']; ?>" />
								<input type="hidden" name="backurl" value="<?php echo current_url(); ?>" />
                                <div class="form-group">
                                	<label>
                                		<?php echo $text_adults; ?>
                                	</label>
                                	<?php if($tour['adult_price'] != 0 && $tour['adult_deal_price'] != 0) { ?>
                                		<span>
                                			<strike>$<?php echo number_format($tour['adult_price'], PRICE_DELIMITER); ?> USD</strike>
                                		</span> 
                                		$<?php echo number_format($tour['adult_deal_price']); ?> USD
                                	<?php } else if($tour['adult_price'] == 0 && $tour['adult_deal_price'] != 0) { ?>
                                		$<?php echo number_format($tour['adult_deal_price']); ?> USD
                                	<?php } else if($tour['adult_price'] != 0 && $tour['adult_deal_price'] == 0) { ?>
                                		<span>$<?php echo number_format($tour['adult_price'], PRICE_DELIMITER); ?> USD</span> 
                                	<?php } ?>
                                </div>
								<div class="form-group">
									<label>
										<?php echo $text_children; ?>
										<?php if(isset($tour['min_child_age']) && isset($tour['max_child_age'])) { ?>
    										<span>
    											<?php echo $tour['min_child_age'] . '-' . $tour['max_child_age'] . ' years'; ?>
    										</span>
    									<?php } ?>	
									</label>
									<?php if($tour['child_price'] != 0 && $tour['child_deal_price'] != 0) { ?>
										<span>
											<strike>$<?php echo number_format($tour['child_price'], PRICE_DELIMITER);?> USD</strike>
										</span> 
										$<?php echo number_format($tour['child_deal_price']); ?> USD
									<?php } else if($tour['child_price'] == 0 && $tour['child_deal_price'] != 0) { ?>
										$<?php echo number_format($tour['child_deal_price']); ?> USD
									<?php } else if($tour['child_price'] != 0 && $tour['child_deal_price'] == 0) { ?>
										<span>$<?php echo number_format($tour['child_price'],PRICE_DELIMITER);?> USD</span> 
									<?php } ?>
								</div>
								<div class="form-group">
									<?php 
                                        echo form_label($text_adults, 'no_of_adults');
                                        
                                        $attributes = array(
											'type' => 'number',
                                            'id'    =>  'input_adult',
                                            'name' => 'no_of_adults',
                                            'value' => set_value('no_of_adults'),
											'autocomplete'=>'off',
											'data-validation'=>'required number' ,
											'data-validation-allowing' => '[1-9]+'											
                                        ); 
                                        
                                        echo form_input($attributes);
                                        echo form_error('no_of_adults');
                                    ?>	
                                 </div>
								<div class="form-group">
									<?php 
                                        echo form_label($text_children,'no_of_childs');
                                        
                                        $attributes = array(
											'type' => 'number',
                                            'name' => 'no_of_childs',
                                            'id'    =>  'input_child',
											'autocomplete'=>'off',
                                            'value' => set_value('no_of_childs'),
                                        ); 
                                        
                                        echo form_input($attributes);	
                                        echo form_error('no_of_childs');
                                    ?>
								</div>
                                <div class="form-group">
                                    <?php 
                                        echo form_label($text_tour_start_date,'tour_start_date');
                                        
                                        $attributes = array(
                                            'name' => 'tour_start_date',
                                            'id'=>'datepicker1',
                                            'data-format' => 'dd-mm-yyyy',
                                            'value' => set_value('tour_start_date'),
											'autocomplete'=>'off',
											'data-validation'=>'required' ,                                          
                                        ); 
                                        
                                        echo form_input($attributes);	
                                        echo form_error('tour_start_date');
                                    ?>
                                </div>
								<div class="form-group">
                                    <?php 
                                        echo form_label($text_tour_end_date,'tour_end_date');
                                        
                                        $attributes = array(
                                            'name' => 'tour_end_date',
                                            'id'=>'datepicker2',
                                            'value' => set_value('tour_end_date'),
											'autocomplete'=>'off',
											'data-validation'=>'required' ,
                                        ); 
                                        
                                        echo form_input($attributes);	
                                        echo form_error('tour_end_date');
                                    ?>
								</div>
                                <div class="form-group">
                                    <?php 
                                        echo form_label($text_pickup_time,'pickup_time');
                                        
                                        $attributes = array(
                                            'name' => 'pickup_time',
                                            'id'=>'timepicker2',
                                            'class'=>'input-small',
                                            'value' => set_value('pickup_time'),
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