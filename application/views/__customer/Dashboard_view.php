<main>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<section class="container">
			<?php if($this->session->flashdata('addr-success') && $this->session->flashdata('addr-success')!=''){?>
				<script type="text/javascript">
					toastr.success("<?php echo $this->session->flashdata('addr-success');?>", "success!", opts);
				</script>
			<?php }?>
			<?php if($this->session->flashdata('addr-error') && $this->session->flashdata('addr-error')!=''){?>
				<script type="text/javascript">
					toastr.error("<?php echo $this->session->flashdata('addr-error');?>", "Oops!", opts);
				</script>	
			<?php }?>
		    <div class="title_head"><?php echo $text_label_my_dashboard;?></div>
			<div class="db_wrapper">
				<section class="row">
					<div class="col-sm-3">
						<div class="db_left_nav">
							<ul class="nav nav-tabs" id="myTab" role="tablist">
								<li class="nav-item active"><a class="nav-link" href="#profile"  id="profile-tab" data-toggle="tab" role="tab" aria-controls="profile" aria-selected="true"><i class="fa fa-user"></i> <?php echo $text_profile;?></a></li>
								<!--<li class="nav-item"><a class="nav-link" href="#orderhistory"  id="orderhistory-tab" data-toggle="tab" role="tab" aria-controls="orderhistory" aria-selected="false"><i class="fa fa-table"></i> <?php echo $text_order_history;?></a></li>
								<li class="nav-item"><a class="nav-link" href="#invoice"  id="invoice-tab" data-toggle="tab" role="tab" aria-controls="invoice" aria-selected="false"><i class="fa fa-file-text-o"></i> <?php echo $text_invoice;?></a></li>-->
								<li class="nav-item"><a class="nav-link" href="#address"  id="address-tab" data-toggle="tab" role="tab" aria-controls="address" aria-selected="false"><i class="fa fa-map-marker"></i> <?php echo $text_address;?></a></li>
								<li class="nav-item"><a class="nav-link" href="#password"  id="password-tab" data-toggle="tab" role="tab" aria-controls="password" aria-selected="false"><i class="fa fa-key"></i> <?php echo $text_change_password;?></a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-9">
						<div class="db_right_panel">
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade in active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
									<div class="db_profile">
										<h3><?php echo $text_profile;?> <a href="#edit_profile" class="fancybox"><?php echo $text_edit; ?></a></h3>
										<div class="db_profile_fld">
											<label><?php echo $text_name; ?>:</label><span><?php echo $customer_profile['firstname'];?> <?php echo $customer_profile['lastname'];?></span>
										</div>
										<div class="db_profile_fld">
											<label><?php echo $text_age; ?>:</label><span><?php if(isset($age) && $age!=''){echo $age;}else{echo THREE_DASH;}?></span>
										</div>
										<div class="db_profile_fld">
											<label><?php echo $text_gender; ?>:</label><span><?php if(isset($gender) && $gender!=''){echo $gender;}else{echo THREE_DASH;}?></span>
										</div>
										<div class="db_profile_fld">
											<label><?php echo $text_contact; ?>:</label><span><?php if(isset($customer_profile['telephone']) && $customer_profile['telephone']!=''){echo $customer_profile['telephone'];}else{echo THREE_DASH;}?></span>
										</div>
									</div>										
								</div>
								<div role="tabpanel" class="tab-pane fade" id="orderhistory" aria-labelledby="orderhistory-tab">
									<div class="db_profile">
										<h3><?php echo $text_order_history; ?></h3>
										<div class="tour_desc_wrap select_tour_wrap">
											<div class="tour_desc_content" id="tour_booking_orders">
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="invoice" aria-labelledby="invoice-tab">
									<div class="db_profile">
										<h3><?php echo $text_invoice;?></h3>
										<div class="tour_desc_wrap select_tour_wrap">
											<div class="tour_desc_content">
												<table>
													<thead>
														<tr>
															<th><?php echo $text_Invoice;?></th>
															<th><?php echo $text_Invoice_name;?></th>
															<th><?php echo $text_Invoice_date;?></th>
															<th><?php echo $text_Action; ?></th>
														</tr>
													</thead>
													<tbody>
														<tr>
															<td>1</td>
															<td>Snorkel Adventure</td>
															<td>Mon Oct 30, 2017</td>
															<td><a href=""><i class="fa fa-download"></i></a></td>
														</tr>
														<tr>
															<td>2</td>
															<td>Snorkel Adventure</td>
															<td>Mon Oct 30, 2017</td>
															<td><a href=""><i class="fa fa-download"></i></a></td>
														</tr>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="address" aria-labelledby="address-tab">
									<div class="db_profile">
										<h3><?php echo $text_address;?><?php //if(count($customer_addresses)<3){?><a href="#add_address_popup" class="fancybox" title=""><i class="fa fa-plus"></i></a><?php //}?></h3>
										<div class="tour_desc_wrap select_tour_wrap">
											<div class="tour_desc_content" id="customer_addresses">
												<?php if(isset($customer_addresses) && !empty($customer_addresses)){?>
												<table>
													<thead>
														<tr>
															<th><?php echo $text_address_hash;?></th>
															<th><?php echo $text_address_type; ?></th>
															<th><?php echo $text_address;?></th>
															<th><?php echo $text_Action; ?></th>
														</tr>
													</thead>
													<tbody>
														<?php $i=0; foreach($customer_addresses as $addresses){?>
														<tr>
															<td><?php echo ++$i;?></td>
															<td><?php echo $addresses['type'];?></td>
															<td><?php echo $addresses['address_1'];?>, <?php if(!empty($addresses['address_2'])) echo $addresses['address_2'].', ';?> <?php echo $addresses['city'];?>, <?php echo $addresses['state'];?>, <?php echo $addresses['country'];?>, <?php echo $addresses['postcode'];?></td>
															<td><a href="#address_tab_<?php echo $addresses['id'];?>" class="fancybox"><i class="fa fa-edit"></i></a><!--&nbsp;|&nbsp;<a href="#" class="fancybox"><i class="fa fa-trash"></i></a>--></td>
														</tr>
														<?php }?>
													</tbody>
												</table>
												<?php }else{?>
												<h5><?php echo $text_no_address;?></h5>
												<?php }?>
											</div>
										</div>
									</div>
								</div>
								<div role="tabpanel" class="tab-pane fade" id="password" aria-labelledby="password-tab">
								<div class="db_profile">
										<h3><?php echo $text_change_password;?></h3>
										<div class="db_pwd_chang_blk">
											<?php
												$attributes = array(
													'class' => ''
												);
												echo form_open('customer/dashboard',$attributes);
											?>
											<div class="form-group <?php if(form_error('password')) { echo 'error'; }else{echo '';} ?>">
												<?php
												$attributes = array(
												'name' => 'password',
												'class' => 'form-control',
												'type'=>'password',
												'autocomplete'=>'off',
												'placeholder'=>$text_placeholder_current_password,
												 'data-validation'=> 'required,length',
												 'data-validation-length' => "6-12",
												); 
												echo form_input($attributes);
												if(form_error('password')){
												    echo form_error('password', '<p><i class="fa fa-times-circle"></i> ','</p>');
												}
												?>
											</div>
											<div class="form-group <?php if(form_error('new_password_confirmation')) { echo 'error'; }else{echo '';} ?>">
												<?php
												$attributes = array(
													'name' => 'new_password_confirmation',
													'class' => 'form-control',
													'type'=>'password',
													'placeholder'=>$text_placeholder_new_password_confirmation,
													'autocomplete'=>'off',
													'data-validation'=> 'required,length',
													'data-validation-length' => "6-12",
												); 
												echo form_input($attributes);
												if(form_error('new_password_confirmation')) {
												    echo form_error('new_password_confirmation', '<p><i class="fa fa-times-circle"></i> ','</p>');
												}
												?>
											</div>
											<div class="form-group <?php if(form_error('confirm_new_password')) { echo 'error'; }else{echo '';} ?>">
												<?php
												$attributes = array(
													'name' => 'new_password',
													'class' => 'form-control',
													'autocomplete'=>'off',
													'type'=>'password',
														'placeholder'=>$text_placeholder_new_password,
													'data-validation'=> 'required,length,confirmation',
													'data-validation-length' => "6-12",
												); 
												echo form_input($attributes);
												if(form_error('confirm_new_password')) {
												    echo form_error('confirm_new_password', '<p><i class="fa fa-times-circle"></i> ','</p>');
												}
												?>
											</div>
											<div class="btn_grp">
												<?php
													$attributes = array(
														'class' => 'save_btn',
														'name' => 'change_password',
														'id' => 'submit',
														'type' => 'submit',
														'value' => 'change_password',
														'content' => $text_content_submit
													);
													echo form_button($attributes);
												?>
												<?php
													$attributes = array(
														'class' => 'cancel_btn',
														'name' => '',
														'id' => '',
														'type' => 'reset',
														'value' => 'Cancel',
														'content' => $text_content_cancel
													);
													echo form_button($attributes);
												?>
											</div>
											<?php echo form_close();?>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</section>				
			</div>
		</section>
	</section>
	<div id="edit_profile" style="display: none; max-width: 500px;">
		<div class="edit_profile_popup">
			<h3><?php echo $text_label_edit_profile;?></h3>
			<?php
			$attributes = array('class' => '');
			echo form_open('customer/dashboard',$attributes);
			?>
			<div class="form-group <?php if(form_error('firstname')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'firstname',
					'class' => 'form-control',
					'id'=>'firstname',
					'placeholder'=>$text_placeholder_firstname,
					'value' => set_value('firstname',$customer_profile['firstname']),
				    'data-validation'=> 'required length custom',
				    'data-validation-length' => "3-32",
				    'data-validation-regexp' => "^(?!\s*$|\s).([A-Za-z ]+)$"
				); 
				echo form_input($attributes);
				if(form_error('firstname')) {
					echo form_error('firstname', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('lastname')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'lastname',
					'class' => 'form-control',
					'id'=>'lastname',
					'placeholder'=>$text_placeholder_lastname,
					'value' => set_value('lastname',$customer_profile['lastname']),
				    'data-validation'=> 'length',
				    'data-validation-length'=> "max32",
				); 
				echo form_input($attributes);
				if(form_error('lastname')) {
					echo form_error('lastname', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('email')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'type' => 'email',
					'name' => 'email',
					'class' => 'form-control',
					'id'=>'email',
					'placeholder'=>$text_placeholder_email,
					'value' => set_value('email',$customer_profile['email']),
				    'data-validation'=> 'required length email',
				    'data-validation-length' => "3-100",
				); 
				echo form_input($attributes);
				if(form_error('email')) {
					echo form_error('email', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('date_of_birth')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'date_of_birth',
					'class' => 'form-control',
					'id'=>'datepicker1',
					'placeholder'=>$text_placeholder_dob,
					'readonly'=>'true',
					'value' => set_value('date_of_birth',d_to_lu($customer_profile['date_of_birth'])),
					'data-validation' => 'required',
				); 
				echo form_input($attributes);
				if(form_error('date_of_birth')) {
					echo form_error('date_of_birth', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('gender')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
				   'name' => 'gender',
				   'class' => 'form-control',
				   'id'=>'gender',
				   'data-validation' => 'required',
				); 
				echo form_dropdown($attributes,$gender_array,$customer_profile['gender']);
				if(form_error('gender')) {
					echo form_error('gender', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('contact')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'contact',
					'class' => 'form-control',
					'id'=>'contact',
					'placeholder'=>$text_placeholder_telephone,
					'value' => set_value('contact',$customer_profile['telephone']),
					'data-validation'=> "required number length",
                    'data-validation-allowing' => "[0-9]+",
                    'data-validation-length' => '10'
				); 
				echo form_input($attributes);
				if(form_error('contact')) {
					echo form_error('contact', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<?php
			$attributes = array(
				'name' => 'update',
				'id' => 'update',
				'type' => 'submit',
				'value' => 'update',
				'content' => $text_content_submit
			);
			echo form_button($attributes);
			?>
			<?php echo form_close();?>
		</div>
	</div>
	<div id="add_address_popup" style="display: none; max-width: 500px;">
		<div class="edit_address_popup">
			<h3><?php echo $text_label_add_address;?></h3>
			<?php
				$attributes = array('class' => '');
				echo form_open('customer/dashboard',$attributes);
			?>
			<div class="form-group <?php if(form_error('type')) { echo 'error'; }else{echo '';} ?>">
			<?php
			$attributes = array(
				'name' => 'type',
				'class' => 'form-control',
				'id' => 'type',
				'data-validation' => 'required',
			); 
			echo form_dropdown($attributes,$address_type);
			if(form_error('type')) {
				echo form_error('type', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
					'data-validation'=> "required length",
					'data-validation-length' => '3-255'
				); 
				echo form_input($attributes);
				if(form_error('address_1')) {
					echo form_error('address_1', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
				); 
				echo form_input($attributes);
				if(form_error('address_2')) {
					echo form_error('address_2', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
				); 
				echo form_dropdown($attributes);
				if(form_error('country')) {
					echo form_error('country', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
				); 
				echo form_dropdown($attributes);
				if(form_error('state')) {
					echo form_error('state', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
				
			</div>
			<div class="form-group <?php if(form_error('city')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'city',
					'class' => 'form-control',
					'id'=>'city',
					'placeholder'=>$text_placeholder_city,
					'data-validation'=> "required",
				); 
				echo form_input($attributes);
				if(form_error('city')) {
					echo form_error('city', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
					echo form_error('postcode', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
				
			</div>
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
			<?php echo form_close();?>
		</div>
	</div>
	<?php if(isset($customer_addresses) && !empty($customer_addresses)){?>
	<?php $i=1; foreach($customer_addresses as $addresses){?>
	<div id="address_tab_<?php echo $addresses['id'];?>" style="display: none; max-width: 500px;">
		<div class="edit_address_popup">
			<h3><?php echo $text_label_edit_address;?></h3>
			<?php
				$attributes = array('class' => '');
				echo form_open('customer/dashboard',$attributes);
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
					'data-validation' => 'required',
				); 
				echo form_dropdown($attributes,$address_type,$addresses['type']);
				if(form_error('type')) {
					echo form_error('type', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('address_1')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'address_1',
					'class' => 'form-control',
					'placeholder'=>$text_placeholder_address1,
					'value' => set_value('address_1',$addresses['address_1']),
					'data-validation'=> "required length",
					'data-validation-length' => '3-255'
				); 
				echo form_input($attributes);
				if(form_error('address_1')) {
					echo form_error('address_1', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('address_2')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'address_2',
					'class' => 'form-control',
					'placeholder'=>$text_placeholder_address2,
					'value' => set_value('address_2',$addresses['address_2']),
				); 
				echo form_input($attributes);
				if(form_error('address_2')) {
					echo form_error('address_2', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
				); 
				echo form_dropdown($attributes,array($addresses['country']=>$addresses['country']),$addresses['country']);
				if(form_error('country')) {
					echo form_error('country', '<p><i class="fa fa-times-circle"></i> ','</p>');
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
				); 
				echo form_dropdown($attributes,array($addresses['state']=>$addresses['state']),$addresses['state']);
				if(form_error('state')) {
					echo form_error('state', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>	
			<div class="form-group <?php if(form_error('city')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'city',
					'class' => 'form-control',
					'placeholder'=>$text_placeholder_city,
					'value' => set_value('city',$addresses['city']),
					'data-validation'=> "required",
				); 
				echo form_input($attributes);
				if(form_error('city')) {
					echo form_error('city', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<div class="form-group <?php if(form_error('postcode')) { echo 'error'; }else{echo '';} ?>">
				<?php
				$attributes = array(
					'name' => 'postcode',
					'class' => 'form-control',
					'placeholder'=>$text_placeholder_postcode,
					'value' => set_value('postcode',$addresses['postcode']),
					'data-validation'=> "required number length",
					'data-validation-allowing' => "[0-9]+",
					'data-validation-length' => '6'
				); 
				echo form_input($attributes);
				if(form_error('postcode')) {
					echo form_error('postcode', '<p><i class="fa fa-times-circle"></i> ','</p>');
				}
				?>
			</div>
			<?php
				$attributes = array(
					'name' => 'update_address',
					'type' => 'submit',
					'value' => 'update_address',
					'content' => $text_content_submit
				);
				echo form_button($attributes);
			?>
			<?php echo form_close();?>
		</div>
	</div>
	<?php $i++;}}?>
</main>
<script src="<?php echo base_url(); ?>assets/js/countries.js"></script>
<script>
populateCountries("countrys", "states");
<?php if(isset($customer_addresses) && !empty($customer_addresses)){?>
<?php $i =1; foreach($customer_addresses as $addresses){?>
populateCountries("country<?php echo $i;?>", "state<?php echo $i;?>");
$('select[id^="country<?php echo $i;?>"] option[value="<?php echo $addresses['country'];?>"]').attr("selected","selected");
<?php $i++;}}?>
function customer_orders() {
	$.ajax({
      url: '<?php echo base_url('customer/dashboard/get_customer_orders_histry_ajax');?>',
	  method: 'get',
      dataType: "html",
      success: function(html) {
        $('#tour_booking_orders').empty();
        $('#tour_booking_orders').html(html);
      }
    });
}
$(window).on('load',function(){
	customer_orders();
});
function customer_addresses() {
	$.ajax({
      url: '<?php echo base_url('customer/dashboard/get_customer_addresses_histry_ajax');?>', 
	  method: 'get',
      dataType: "html",
      success: function(html) {
        $('#customer_addresses').empty();
        $('#customer_addresses').html(html);
      }
    });
}
$(function() {
	$("#datepicker1").datepicker({
		minDate: "-100Y",//go back 100 years
		//maxDate: "+1M +10D", 
		//maxDate: 0, 
		changeMonth : true,
        changeYear : true,
		yearRange: '1918:2010', // last hundred years
		dateFormat: 'dd-mm-yy',
		defaultDate: '-100y'
	});
	/* $("#orderhistory-tab").on('click',function(){
		customer_orders();
	}); */
	/* $("#address-tab").on('click',function(){
		customer_addresses();
	}); */
	
	$('a[data-toggle="tab"]').on('show.bs.tab', function(e) {
		localStorage.setItem('activeTab', $(e.target).attr('href'));
	});
	var activeTab = localStorage.getItem('activeTab');
	if(activeTab){
		$('#myTab a[href="' + activeTab + '"]').tab('show');
	}
});
</script>