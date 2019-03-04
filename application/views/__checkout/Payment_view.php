<main>
	<div class="loader" id="cart_loader" style="display:none;"><img src="<?php echo base_url('assets/img/loader.gif'); ?>" alt=""/></div>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
			<section class="container">
				<section class="row">
					<div class="col-sm-12">
						<div class="tour_steps_blk">
							<ul>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-shopping-cart"></i> 1. <?php echo $text_shopping_cart;?>
									</div>
								</li>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-list"></i> 2. <?php echo $text_your_information;?>
									</div>
								</li>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-file"></i> 3. <?php echo $text_confirmation;?>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="tour_desc_wrap select_tour_wrap">
							<div class="tour_desc_content travelerinfo_blk noshadow pt10">
								<h2 class="choose_method_hdng"><?php echo $text_choose_payment_method;?></h2>
								<div class="payoption">
									<!-- Nav tabs -->
									<ul class="nav nav-tabs" id="myTab" role="tablist">
										<li class="nav-item">
											<a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"><?php echo $text_paypal;?></a>
										</li>
										<!--<li class="nav-item">
											<a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Credit Card</a>
										</li>-->
									</ul>

									<!-- Tab panes -->
									<div class="tab-content">
										<div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab">
										</div>
										<div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab">
											<div id="cc_link">
												<h3 class="ccinfo">Credit Card Information</h3>
												<div class="row">
													<div class="col-sm-6">
														<div class="form-group">
															<label>Credit Card Holder</label>
															<input type="text" name="" value="" class="form-control"/>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Credit card issuing bank</label>
															<input type="text" name="" value="" class="form-control"/>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Credit Card Number</label>
															<input type="text" name="" value="" class="form-control"/>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Card type</label>
															<select class="form-control">
																<option>--Card Type--</option>
																<option>Visa</option>
																<option>Maestro</option>
																<option>Master Card</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group expdate">
															<label>Expiration Date</label>
															<select class="form-control">
																<option>--Month--</option>
																<option>Jan</option>
																<option>Feb</option>
																<option>Mar</option>
															</select>
															<select class="form-control">
																<option>--Year--</option>
																<option>2017</option>
																<option>2018</option>
																<option>2019</option>
															</select>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group cvv_blk">
															<label>Verification Number</label>
															<input type="text" name="" value="" class="form-control"/><img src="img/creditcvv.png" alt=""/>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Billing Address</label>
															<input type="text" name="" value="" class="form-control"/>
														</div>
													</div>
													<div class="col-sm-6">
														<div class="form-group">
															<label>Zip Code</label>
															<input type="text" name="" value="" class="form-control"/>
														</div>
													</div>
													<div class="col-sm-12">
														<h4>Available credit cards</h4>
														<ul>
															<li><img src="img/americanexpress.png" alt=""/></li>
															<li><img src="img/visa02.png" alt=""/></li>
															<li><img src="img/mastercard.png" alt=""/></li>
														</ul>
													</div>									
												</div>										
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-5">						
						<div class="tour_form_wrap">
							<div id="_cart_body"><div>
									<div class="secure_blk">
										<p><?php echo $text_safe_information;?></p>
										<img src="<?php echo base_url('assets/img/secures.jpg');?>" alt=""/>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>
			</section>
	</section>
</main>
<script type="text/javascript">
function load_paypal_form() {
	
	$.ajax({
		url: "<?php echo base_url('gateway/payment/paypal');?>", 
		method: 'get',
		dataType: "html",
		beforeSend: function() {$('#cart_loader').css("display", "block");},
		complete: function() {$('#cart_loader').css("display", "none");},
		success: function(html) {
			$('#home').empty();
			$('#home').html(html);
		}
	});
	
	$.ajax({
	  url: '<?php echo base_url('cart/get_ajax_cart_data');?>', 
	  method: 'get',
	  data: {view:'traveller_info'},
	  dataType: "html",
	  beforeSend: function() {$('#cart_loader').css("display", "block");},
	  complete: function() {$('#cart_loader').css("display", "none");},
	  success: function(html) {
		$('#_cart_body').empty();
		$('#_cart_body').html(html);
		$("#continue_btn").css("display","none");
	  }
	});
}

$(function() {$(window).on('load', load_paypal_form);});
</script>
