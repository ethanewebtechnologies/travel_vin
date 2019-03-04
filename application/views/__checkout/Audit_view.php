<main>
	<div class="loader" id="cart_loader" style="display:none;"><img src="<?php echo base_url('assets/img/loader.gif'); ?>" alt=""/></div>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<?php if($this->session->flashdata('addr-success') && $this->session->flashdata('addr-success') != '') { ?>
			<script type="text/javascript">
				toastr.success("<?php echo $this->session->flashdata('addr-success');?>", "<?php echo $text_success;?>", opts);
			</script>
		<?php } ?>
		<?php if($this->session->flashdata('addr-error') && $this->session->flashdata('addr-error')!=''){?>
			<script type="text/javascript">
				toastr.error("<?php echo $this->session->flashdata('addr-error');?>", "<?php echo $text_error;?>", opts);
			</script>
		<?php } ?>
		
		<?php echo form_open('checkout/audit'); ?>
			<section class="container">
				<section class="row">
					<div class="col-sm-12">
						<?php echo $this->session->flashdata('success'); ?>
						<?php echo $this->session->flashdata('error'); ?>
						
						<div class="tour_steps_blk">
							<ul>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-shopping-cart"></i> 1. <?php echo $text_shopping_cart; ?>
									</div>
								</li>
								<li>
									<div class="step1_blk active">
										<i class="fa fa-list"></i> 2. <?php echo $text_your_information; ?>
									</div>
								</li>
								<li>
									<div class="step1_blk">
										<i class="fa fa-file"></i> 3. <?php echo $text_confirmation; ?>
									</div>
								</li>
							</ul>
						</div>
						
					</div>
					
					<?php if($this->session->has_userdata('customer')) {?>
						<div class="col-sm-7">
							<div class="tour_desc_wrap select_tour_wrap">
								<div class="tour_desc_content travelerinfo_blk noshadow">
									<h3><?php echo $text_label_select_address;?></h3>
									<div class="addnewaddress text-right">
										<a href="#addnew_adrs_blk" class="fancybox"><i class="fa fa-plus"></i> <?php echo $text_label_add_address;?></a>
									</div>
									<div class="address_lists">
										<div class="row">
											<?php if(isset($customer_addresses) && !empty($customer_addresses)) { ?>
												<?php $i = 0; ?>
												<?php foreach($customer_addresses as $addresses) { ?>
        											<div class="col-sm-6">
        												<div class="single_address">
        													<h3>
        														<?php echo $addresses['type']; ?> <?php echo $text_address;?>
        													</h3>
        													<p>
        														<?php echo $addresses['address_1']; ?>, <?php if(!empty($addresses['address_2'])) echo $addresses['address_2'] . ', '; ?> 
        														<?php echo $addresses['city']; ?> 
        														<?php echo $addresses['state']; ?> 
        														<?php if(!empty($addresses['postcode'])) echo ', '. $addresses['postcode']; ?>
        													</p>
        													<div>
        														<span>
        															<p>
        																<input type="radio" id="address_<?php echo $addresses['id']; ?>" name="customer_address" value="<?php echo $addresses['id']; ?>">
        																<label for="address_<?php echo $addresses['id'];?>"><!--Select This--></label>
        															</p>
        														</span>
        														<span>
        															<a href="#editadres_blk_<?php echo $addresses['id'];?>" class="fancybox"><i class="fa fa-pencil" aria-hidden="true"></i><!--Edit This--></a>
        														</span>
        													</div>
        												</div>
        											</div>
												<?php } ?>
											<?php } ?>	
										</div>
									</div>
								</div>
							</div>
						</div>
					<?php } else { ?>
						<div class="col-sm-7">
							<div class="tour_desc_wrap select_tour_wrap">
    							<!--<div class="tourdesc_bnr">
    								<div class="seclect_tour_img"><img class="d-block w-100 img-fluid" src="<?php echo base_url().'assets/img/desc_img.png';?>" alt="img"></div>
    							</div>-->
    							<!--<div class="tour_name">
    								<h3><span>Tour:</span> Metropolitan Natural Park</h3>
    							</div>-->
								<div class="tour_desc_content travelerinfo_blk noshadow pt10">
									<h3 class="bold_font"><?php echo $text_form_title;?></h3>
									<div class="row">
										<div class="col-sm-6">
    										<div class="form-group <?php echo form_error('firstname') ? 'error' : ''; ?>">			
    											<?php 
    												echo form_label($text_label_firstname , 'firstname');
    									
    												$attributes = array(
    													'name' => 'firstname',
    													'placeholder' => $text_placeholder_firstname,
    													'class' => 'form-control',
    													'value' => set_value('firstname'),
    												    'data-validation'=> 'required length custom',
    												    'data-validation-length' => "3-32",
    												    'data-validation-regexp' => "^(?!\s*$|\s).([A-Za-z ]+)$"
    												); 
    												
    												echo form_input($attributes);
    												
    												if(form_error('firstname')) {
    													echo form_error('firstname', '<span class="help-block form-error">','</span>');
    												}
    											?>									
    										</div>
										</div>
    									<div class="col-sm-6">
    									   <!--<div class="form-group">
    										<label>Last Name </label>
    										<input type="text" name="lastname" value="" class="form-control"/>-->
    										
    										<div class="form-group <?php echo form_error('lastname') ? 'error' : ''; ?>">
    											<?php 
    											  echo form_label($text_label_lastname, 'lastname');
    									
    												$attributes = array(
    													'name' => 'lastname',
    													'placeholder' => $text_placeholder_lastname,
    													'class' => 'form-control',
    													'value' => set_value('lastname'),
    												    'data-validation'=> 'length',
    												    'data-validation-length'=> "max32",
    												); 
    												
    												echo form_input($attributes);	
    												
    												if(form_error('lastname')) {
    													echo form_error('lastname', '<span class="help-block form-error">','</span>');
    												}
    											?>
    										</div>
    									</div>			
										<div class="col-sm-6">
											<div class="form-group <?php echo form_error('email') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($text_label_email, 'email');
                                        
                                        			$attributes = array(
                                        				'name' => 'email',
                                        			    'placeholder' => $text_placeholder_email,
                                        				'class' => 'form-control',
														'id'=>'checkout_email',
                                        			    'value' => set_value('email'),
                                        			    'data-validation'=> 'required length email',
                                        			    'data-validation-length' => "3-96",
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('email')) {
                                        			    echo form_error('email', '<span class="help-block form-error">','</span>');
                                        			}
                                        		?>													
                                        	</div>
										</div>
    									<div class="col-sm-6">
    										<div class="form-group <?php echo form_error('telephone') ? 'error' : ''; ?>">
    											<?php 
                                                    echo form_label($text_label_telephone , 'telephone');
                                            
                                                    $attributes = array(
            											'name' => 'telephone',
            											'placeholder' => $text_placeholder_telephone,
            											'class' => 'form-control',
            											'id' =>'checkout_phone',
            											'value' => set_value('telephone'),
                                                        'data-validation'=> "required,number,length",
                                                        'data-validation-allowing' => "[0-9]+",
                                                        'data-validation-length' => '10'
                                                    ); 
                                            			
                                                    echo form_input($attributes);	
    											
                                                    if(form_error('telephone')) {
    												    echo form_error('telephone', '<span class="help-block form-error">','</span>');
                                                    }
                                                ?>
                                        	</div>
										</div>
    									<div class="col-sm-12">
    										<div class="form-group <?php echo form_error('address_1') ? 'error' : ''; ?>">
    										 <?php 
    											echo form_label($text_label_address_1 , 'address_1');
                                            
    											$attributes = array(
    											'name' => 'address_1',
    											'placeholder' => $text_placeholder_address_1,
    											'class' => 'form-control',
    											'id'=>'checkout_address1',
    											'value' => set_value('address_1'),
    											 'data-validation'=> 'required length',
    											 'data-validation-length' => "3-255",
    											    
    											); 
                                            			
    											echo form_input($attributes);	
    												
    											if(form_error('address_1')) {
    											echo form_error('address_1', '<span class="help-block form-error">','</span>');
    												}
                                             ?>
                                        	</div>
    									</div>
    									<div class="col-sm-12">
    										<div class="form-group <?php echo form_error('address_2') ? 'error' : ''; ?>">
                                            	<?php 
    											 echo form_label($text_label_address_2 , 'Address2');
                                            
    											    $attributes = array(
    												'name' => 'address_2',
    												'placeholder' => $text_placeholder_address_2,
    												'id'=>'checkout_address2',
    												'class' => 'form-control',
    												'value' => set_value('address_2'),
    											     'data-validation-length'=> "max255",
                                            		); 
                                            			
                                            		echo form_input($attributes);	
                                            			
                                            		if(form_error('address_2')) {
                                            		 echo form_error('address_2', '<span class="help-block form-error">','</span>');
                                            		}
                                            		?>
                                        	</div>
    									</div>
										<div class="col-sm-6">
								    		<div class="form-group <?php echo form_error('city') ? 'error' : '';; ?>">
                                        		<?php 
                                        		    echo form_label($text_label_city , 'city');
                                        
                                        			$attributes = array(
													  
                                        				'name' => 'city',
                                        			    'placeholder' => $text_placeholder_city_1,
                                        				'class' => 'form-control',
														'id'=>'checkout_city',
                                        			    'onkeyup' => 'lettersOnly(this);',
                                        			    ' autocomplete' => 'off',
                                        				'value' => set_value('city'),
                                        			    'data-validation'=> 'required length',
                                        			    'data-validation-length' => "3-32",
                                        			    'data-validation-error-msg'=> $text_placeholder_city_1
                                        			); 
                                        			echo form_input($attributes);	
                                        	
                                        			if(form_error('city')) {
                                        			    echo form_error('city', '<span class="help-block form-error">','</span>');
                                        			}
                                        		?>
                                			</div>
										</div>
    									<div class="col-sm-6">
    										<div class="form-group">
    											<label><?php echo $text_label_country;?></label>
    											<select class="form-control" id="country_1" name="country" data-validation="required"/></select>
    										</div>
    										<span><?php echo form_error('country'); ?></span>
    									</div>
										<div class="col-sm-6">
											<div class="form-group">
												<label><?php echo $text_label_state;?></label>
												<select class="form-control" id="state_1"  name="state" data-validation="required"/></select>
												<span><?php echo form_error('state'); ?></span>
											</div>
										</div>
										<div class="col-sm-12">
											<div class="form-group <?php echo form_error('booking_additional_notes') ? 'error' : '';; ?>">
												<?php 
                                                    echo form_label($text_label_additional_notes , 'booking_additional_notes');
						
                                                    $attributes = array(
            											'name' => 'booking_additional_notes',
            											'placeholder' => $text_placeholder_additional_notes,
            											'class' => 'form-control',
            											'value' => set_value('booking_additional_notes'),
            											'cols'	=>	40,
            											'rows'	=>	2,
                                                        'data-validation'=> 'length',
                                                        'data-validation-length'=> "max255",
                                                        
											         ); 
                                    			
											         echo form_textarea($attributes);	
                                        			
											         if(form_error('booking_additional_notes')) {
											             echo form_error('booking_additional_notes', '<span class="help-block form-error">','</span>');
											         }
                                        		  ?>
											</div>
    										<!--<div class="form-group">
    											<label>Additional comments</label>
    											<textarea class="form-control" name="booking_additional_notes"></textarea>
    										-->
										</div>
    									<div class="col-sm-12">
    										<label><input type="checkbox" name="terms" value="1" data-validation = "required" id="terms_conditions"/>  <?php echo $text_terms_conditions;?> </label>
    										<p class="checkbox_error" style="color:red;font-size:16px;"></p>
    										<?php 
    										if(form_error('terms')) {
    										    echo form_error('terms', '<span class="help-block form-error">','</span>');
    										}
    										?>
    									</div>
									</div>
								</div>
							</div>
						</div>
					<?php } ?>
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
		<?php echo form_close(); ?>
	</section>		
</main>

<div id="addnew_adrs_blk" style="display: none; max-width: 500px;">
	<div class="address_popup">
		<h3><?php echo $text_label_add_address;?></h3>
		<?php
		$attributes = array('class' => 'form-horizontal');
		echo form_open('checkout/audit', $attributes);
		?>
		<div class="form-group <?php if(form_error('type')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'type',
				'class' => 'form-control',
				'id' => 'type',
				'data-validation' => 'required',
			    'data-validation-error-msg'=> $text_address_none
			); 
			echo form_dropdown($attributes,$address_type);
			if(form_error('type')) {
				echo form_error('type', '<span class="help-block form-error">','</span>');
			}
			?>
		</div>
		<div class="form-group <?php if(form_error('address_1')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'address_1',
				'class' => 'form-control',
				'id'=>'address_1',
				'placeholder'=>$text_placeholder_address1,
			    'data-validation'=> 'required length',
			    'data-validation-length' => "3-255",
			); 
			echo form_input($attributes);
			if(form_error('address_1')) {
				echo form_error('address_1', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group <?php if(form_error('address_2')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'address_2',
				'class' => 'form-control',
				'id'=>'address_2',
				'placeholder'=>$text_placeholder_address2,
			    'data-validation-length'=> "max255",
			); 
			echo form_input($attributes);
			if(form_error('address_2')) {
				echo form_error('address_2', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group <?php if(form_error('country')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'country',
				'class' => 'form-control',
				'id'=>'countrys',
				'data-validation'=> "required",
			    'data-validation-error-msg'=> $text_placeholder_country
			); 
			echo form_dropdown($attributes);
			if(form_error('country')) {
				echo form_error('country', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group <?php if(form_error('state')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
			   'name' => 'state',
			   'class' => 'form-control',
			   'id'=>'states',
			    'data-validation'=> "required",
			    'data-validation-error-msg'=> $text_placeholder_state
			); 
			echo form_dropdown($attributes);
			if(form_error('state')) {
				echo form_error('state', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group <?php if(form_error('city')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'city',
				'class' => 'form-control',
				'id'=>'city',
			    'onkeyup' => 'lettersOnly(this);',
			    ' autocomplete' => 'off',
			    'placeholder'=>$text_placeholder_city_1,
			    'data-validation'=> 'required length',
			    'data-validation-length' => "3-32",
			    'data-validation-error-msg'=> $text_placeholder_city_1
			); 
			echo form_input($attributes);
			if(form_error('city')) {
				echo form_error('city', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group <?php if(form_error('postcode')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'postcode',
				'class' => 'form-control',
				'id'=>'postcode',
				'placeholder'=>$text_placeholder_postcode,
				'data-validation'=> "required number length",
				'data-validation-allowing' => "[0-9]+",
				'data-validation-length' => '6'
			); 
			echo form_input($attributes);
			if(form_error('postcode')) {
				echo form_error('postcode', '<span class="help-block form-error">','</span>');
			}
			?>
			
		</div>
		<div class="form-group">
			<div class="btn_grp">
				<?php
				$attributes = array(
					'name' => 'add_address',
					'id' => 'update_address',
					'type' => 'submit',
					'value' => 'add_address',
					'content' => $text_content_submit
				);
				echo form_button($attributes);
				?>
			</div>
		</div>
		<?php echo form_close();?>
	</div>
</div>

<?php if(isset($customer_addresses) && !empty($customer_addresses)) { ?>
	<?php $i = 1; ?>
	<?php foreach($customer_addresses as $addresses) { ?>
		<div id="editadres_blk_<?php echo $addresses['id'];?>" style="display: none; max-width: 600px;">
			<div class="address_popup">
				<h3><?php echo $text_label_edit_address;?></h3>
    			<?php
    			$attributes = array('class' => 'form-horizontal');
    			echo form_open('checkout/audit',$attributes);
    			?>
    			<?php
				$attributes = array(
					'name' => 'update_row',
					'class' => 'form-control',
					'type'=>'hidden',
					'value' => set_value('update_row',$addresses['id'])
				); 
				echo form_input($attributes);	
				?>
				<div class="form-group <?php if(form_error('type')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
						'name' => 'type',
						'class' => 'form-control',
						'id' => 'type',
					    'data-validation'=> "required",
					    'data-validation-error-msg'=> $text_address_none
					); 
					echo form_dropdown($attributes,$address_type,$addresses['type']);
					if(form_error('type')) {
						echo form_error('type', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group <?php if(form_error('address_1')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
						'name' => 'address_1',
						'class' => 'form-control',
						'id'=>'address_1',
						'placeholder'=>$text_placeholder_address1,
						'value' => set_value('address_1',$addresses['address_1']),
						'data-validation'=> "required length",
						'data-validation-length' => '3-255'
					); 
					echo form_input($attributes);
					if(form_error('address_1')) {
						echo form_error('address_1', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group <?php if(form_error('address_2')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
						'name' => 'address_2',
						'class' => 'form-control',
						'id'=>'address_2',
						'placeholder'=>$text_placeholder_address2,
						'value' => set_value('address_2',$addresses['address_2']),
					    'data-validation-length'=> "max255",
					); 
					echo form_input($attributes);
					if(form_error('address_2')) {
						echo form_error('address_2', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group <?php if(form_error('country')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
					   'name' => 'country',
					   'class' => 'form-control',
					   'id'=>'country'.$i,
					    'data-validation'=> "required",
					    'data-validation-error-msg'=> $text_placeholder_country
					); 
					echo form_dropdown($attributes,array($addresses['country']=>$addresses['country']),$addresses['country']);
					if(form_error('country')) {
						echo form_error('country', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group <?php if(form_error('state')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
					   'name' => 'state',
					   'class' => 'form-control',
					   'id'=>'state'.$i,
					    'data-validation'=> "required",
					    'data-validation-error-msg'=> $text_placeholder_state
					); 
					echo form_dropdown($attributes,array($addresses['state']=>$addresses['state']),$addresses['state']);
					if(form_error('state')) {
						echo form_error('state', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>	
				<div class="form-group <?php if(form_error('city')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
						'name' => 'city',
						'class' => 'form-control',
						'id'=>'city',
					    'onkeyup' => 'lettersOnly(this);',
					    ' autocomplete' => 'off',
					    'placeholder'=>$text_placeholder_city_1,
						'value' => set_value('city',$addresses['city']),
					    'data-validation'=> 'required length',
					    'data-validation-length' => "3-32",
					    'data-validation-error-msg'=> $text_placeholder_city_1
					); 
					echo form_input($attributes);
					if(form_error('city')) {
						echo form_error('city', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group <?php if(form_error('postcode')) { echo 'error'; }else{echo '';} ?>">
					<?php
					$attributes = array(
						'name' => 'postcode',
						'class' => 'form-control',
						'id'=>'postcode',
						'placeholder'=>$text_placeholder_postcode,
						'value' => set_value('postcode',$addresses['postcode']),
						'data-validation'=> "required number length",
						'data-validation-allowing' => "[0-9]+",
						'data-validation-length' => '6'
					); 
					echo form_input($attributes);
					if(form_error('postcode')) {
						echo form_error('postcode', '<span class="help-block form-error">','</span>');
					}
					?>
				</div>
				<div class="form-group">
					<div class="btn_grp">
						<?php
						$attributes = array(
							'name' => 'update_address',
							'id' => 'update_address',
							'type' => 'submit',
							'value' => 'update_address',
							'content' => $text_content_submit
						);
						echo form_button($attributes);
						?>
					</div>
				</div>
				<?php echo form_close();?>
			</div>
		</div>
		<?php $i++; ?>
	<?php } ?>	
<?php } ?>	

<script src="<?php echo base_url('assets/js/countries.js'); ?>"></script>

<script type="text/javascript">

populateCountries("countrys", "states");

<?php if(!$this->session->has_userdata('customer')) { ?>
	populateCountries("country_1", "state_1");
	<?php if($this->session->flashdata('country_flash_session')){?>
		populateCountries("country_1", "state_1");
		$('select[id^="country_1"] option[value="<?php echo $this->session->flashdata('country_flash_session');?>"]').attr("selected","selected");
	<?php }?>
	<?php if($this->session->flashdata('state_flash_session')){?>
		populateStates( "country_1", "state_1" );
		$('select[id^="state_1"] option[value="<?php echo $this->session->flashdata('state_flash_session');?>"]').attr("selected","selected");
	<?php }?>
<?php } ?>

<?php $i =1; ?>

<?php foreach($customer_addresses as $addresses) { ?>
	populateCountries("country<?php echo $i;?>", "state<?php echo $i; ?>");
	$('select[id^="country<?php echo $i; ?>"] option[value="<?php echo $addresses['country']; ?>"]').attr("selected", "selected");
    <?php $i++; ?>
<?php } ?>        

function __addAddress() {
	var type = $('#type').val();
	var address_1 = $('#address_1').val();
	var address_2 = $('#address_2').val();
	var country = $('#countrys').val();
	var state = $('#states').val();
	var city = $('#city').val();
	var postcode = $('#postcode').val();
	var secureToken = $('form#log-area-51').attr('data-T51');
	var secureHash = $('form#log-area-51').attr('data-H51');
	var userSubmit = $('#address_submit').val();
	var currentPath = "<?php echo current_url(); ?>";
	
	var postUrl = "<?php echo base_url('customer/customer_address'); ?>";
	var postMethod = "POST";

	var postData = {
		type: type, 
		address_1: address_1,
		address_2: address_2,
		country: country,
		state: state,
		city: city,
		postcode: postcode,
		address_submit: userSubmit,
		current_path: currentPath
	};
	
	$.ajax({
		url: postUrl,
		method: postMethod,
		data: postData,
		success: function(response) {
			$('form#log-area-51').attr('data-T51', response.secure_token);
			$('form#log-area-51').attr('data-H51', response.secure_hash);

			if(response.verification_error) {
				window.location.href = response.url;
			} else if(response.validation_error) {
				//$('#user_password_error').html(response.password_error);
				//$('#user_email_error').html(response.email_error);
				
				$('.form-group').attr('class','form-group error');
			} else if(response.url) {
				window.location.href = response.url;
			}
			
			return false;
		}
	});
	
	return false;
}

function windowload() {
	// Some functions works only after window load
	$.ajax({
		url: '<?php echo base_url('cart/get_ajax_cart_data'); ?>', // Removed the empty quotes which are useless here
		method: 'get',
		data: {view: 'traveller_info'},
		dataType: "html",
		beforeSend: function() {$('#cart_loader').css("display", "block");},
		complete: function() {$('#cart_loader').css("display", "none");},
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

<script>
$( "#state1" ).select(function() {
	alert( "Handler for .select() called.");
});

$("#checkout_email").blur(function() {
	email = $(this).val();
	$.ajax({
		url: '<?php echo base_url('checkout/get_ajax_customer_data'); ?>',
		data: "email=" + email,
		dataType: "json",
		success: function(userdata) {
			if(userdata) {
				$("#checkout_phone").val(userdata['telephone']);
                $("#checkout_address1").val(userdata['address_1']);
                $("#checkout_address2").val(userdata['address_2']);
                $("#checkout_city").val(userdata['city']);
                $("#country1").val(userdata['country']);
                $("#state1").html("<option value='" + userdata['state'] + "'>" + userdata['state'] + "</option>");
			}
		}
	});
});

</script>

<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>