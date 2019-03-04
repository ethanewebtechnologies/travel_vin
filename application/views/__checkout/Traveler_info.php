<main>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<?php echo form_open('cart/traveler_info'); ?>
			<section class="container">
				<section class="row">
					<div class="col-sm-12">
					<?php echo $this->session->flashdata('success');?>
					<?php echo $this->session->flashdata('error');?>
						<div class="tour_steps_blk">
							<ul>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-shopping-cart"></i> 1. Shopping Cart
									</div>
								</li>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-list"></i> 2. Your Information
									</div>
								</li>
								<li>
									<div class="step1_blk">
										<i class="fa fa-file"></i> 3. Confirmation
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-7">
						<div class="tour_desc_wrap select_tour_wrap">
							<!--<div class="tourdesc_bnr">
								<div class="seclect_tour_img"><img class="d-block w-100 img-fluid" src="<?php echo base_url().'assets/img/desc_img.png';?>" alt="img"></div>
							</div>-->
							<div class="tour_name">
								<h3><span>Tour:</span> Metropolitan Natural Park</h3>
							</div>
							<div class="tour_desc_content travelerinfo_blk">
								<h3>Lead Traveler Information</h3>
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<label>First Name <span class="rqrd">*</span></label>
											<input type="text" name="firstname" value="" class="form-control"/>
											<span><?php echo form_error('firstname'); ?></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Last Name <span class="rqrd"></span></label>
											<input type="text" name="lastname" value="" class="form-control"/>
											<span><?php echo form_error('lastname'); ?></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Email <span class="rqrd">*</span></label>
											<input type="email" name="email" value="" class="form-control"/>
											<span><?php echo form_error('email'); ?></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Phone Number</label>
											<input type="text" name="telephone" value="" class="form-control"/>
											<span><?php echo form_error('telephone'); ?></span>
										</div>
									</div>
									<!--<div class="col-sm-6">
										<div class="form-group">
											<label>Please re-type your email <span class="rqrd">*</span></label>
											<input type="email" name="re_email" value="" class="form-control"/>
											<span><?php echo form_error('re_email'); ?></span>
											<span><?php echo form_error('email_check'); ?></span>
										</div>
									</div>-->
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address Line 1</label>
											<input type="text" name="address_1" value="" class="form-control"/>
											<span><?php echo form_error('address_1'); ?></span>
										</div>
									</div>
									<div class="col-sm-12">
										<div class="form-group">
											<label>Address Line 2</label>
											<input type="text" name="address_2" value="" class="form-control"/>
											<span><?php echo form_error('address_2'); ?></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>City</label>
											<input type="text" name="city" value="" class="form-control"/>
											<span><?php echo form_error('city'); ?></span>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Country</label>
											<select class="form-control" id="country1" name="country" data-validation="required"/></select>
											<!--<select class="form-control" name="country">
												<option>--Country--</option>
												<option>Mexico</option>
												<option>Panama</option>
												<option>Bahamas</option>
											</select>-->
										</div>
										<span><?php echo form_error('country'); ?></span>
									</div>
										<div class="col-sm-6">
										<div class="form-group">
											<label>State or Region</label>
											
											<select class="form-control" id="state1" name="state" data-validation="required"/></select>
											<span><?php echo form_error('state'); ?></span>
										</div>
									</div>
									
									
									
									<div class="col-sm-12">
										<div class="form-group">
											<label>Additional comments</label>
											<textarea class="form-control" name="booking_additional_notes"></textarea>
										</div>
									</div>
									<div class="col-sm-12">
										<label><input type="checkbox" name="terms" value="1"/>  I have read all and agreed <a href="">Terms and Conditions</a> of this reservation request. I understand and agree a photo id or credit card will be require to verify identity and billing information at the time of local registration of this tour. </label>
										<span><?php echo form_error('terms'); ?></span>
									</div>
								</div>
								<div class="row">
									<h3 class="ccinfo">Credit Card Information</h3>
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
						<div class="col-sm-5">						
							<div class="tour_form_wrap">
								<div id="_cart_body"><div>
								
								<div class="secure_blk">
									<p>Your information is 100% safe with us, as we use a 128-bits encrypted transaction.</p>
									<img src="img/secures.jpg" alt=""/>
								</div>
							</div>
						</div>
					</section>
				</section>
			<?php echo form_close(); ?>
		</section>
		
	</main>
	<script src="<?php echo base_url(); ?>assets/js/countries.js"></script>
 <script type="text/javascript">
populateCountries("country1", "state1");
function windowload() {
	//Some functions works only after window load
	$.ajax({
      url: '<?php echo base_url('cart/get_ajax_cart_data');?>', // Removed the empty quotes which are useless here
	  method: 'get',
	  data: {view:'traveller_info'},
      dataType: "html",
	  beforeSend: function() {$('#_cart_body').html('Loading...')},
      success: function(html) {
        $('#_cart_body').empty();
        $('#_cart_body').html(html);
      }
    });
}

$(function() {
  $(window).on('load', windowload);
});
</script>