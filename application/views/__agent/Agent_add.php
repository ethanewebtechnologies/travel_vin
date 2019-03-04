<main>
	<section class="content_area wow slideIn" data-wow-duration="1s">
		<div class="agent_bnr">
			<img src="<?php echo base_url('assets/img/agent_bnr.jpg'); ?>" alt=""/>
			<h2><?php echo $text_become_agent;?></h2>
		</div>
		<section class="container">
			<section class="row">
				<div class="agent_blk">
					<div class="top_text">
						<h3><?php echo $add_welcome_agent;?></h3>
						<p><?php echo $add_register_message;?>: </span>
                        <ul>
                        	<li><?php echo $add_list_1;?></li>
                        	<li><?php echo $add_list_2;?></li>
                        	<li><?php echo $add_list_3;?></li>
                        </ul>
					</div>
					 <?php if($this->session->flashdata('validation_failed')) { ?>
    					<div class="error_box">
    						<p><strong><i class="fa fa-info-circle"></i> <?php echo $text_validation_errors; ?></strong></span>
    					</div>
					<?php } ?>
					<div class="agent_portal_field">
						<?php echo form_open("become-an-agent"); ?>
							<div class="form_field_blk">
								<h3><?php echo $text_agent_profile;?></h3>
								<div class="field_wrap" style="display: block;">
									<div class="row">
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('company_legal_name') ? 'error' : ''; ?>">
                                        		<?php 
                                            			echo form_label($label_company_name , 'company_legal_name');
                                            
                                            			$attributes = array(
                                            				'name' => 'company_legal_name',
                                            				'placeholder' => $placeholder_company_name,
                                            				'class' => 'form-control',
                                            				'value' => set_value('company_legal_name'),
                                            			    'data-validation'=> 'required length custom',
                                            			    'data-validation-length' => "3-100",
                                            			    'data-validation-regexp' => "^(?!\s*$|\s).([A-Za-z ]+)$"
                                            			); 
                                            			
                                            			echo form_input($attributes);
                                            			if(form_error('company_legal_name')) {
                                            			    echo form_error('company_legal_name', '<span class="help-block form-error"> ','</span>');
                                            			}
                                        		?>													
                                        	</div>
                                        </div>
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('tax_id') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_tax_id , 'tax_id');
                                        
                                        			$attributes = array(
                                        				'name' => 'tax_id',
                                        				'placeholder' => $placeholder_tax_id,
                                        				'class' => 'form-control',
                                        				'value' => set_value('tax_id'),
                                        			    'data-validation'=> 'length',
                                        			    'data-validation-length'=> "max50",
                                        			); 
                                        			
                                        			echo form_input($attributes);	
                                        			
                                        			if(form_error('tax_id')) {
                                        			    echo form_error('tax_id', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                    </div>    
                                    <div class="row">    
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('email') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_company_email , 'email');
                                        
                                        			$attributes = array(
                                        				'name' => 'email',
                                        				'placeholder' => $placeholder_company_email,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('email'),
                                        			    'data-validation'=> 'required length email',
                                        			    'data-validation-length' => "3-100",
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('email')) {
                                        			    echo form_error('email', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>													
                                        	</div>
                                        </div>
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('address') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_address , 'address');
                                        
                                        			$attributes = array(
                                        				'name' => 'address',
                                        				'placeholder' => $placeholder_address,
                                        				'class' => 'form-control',
                                        				'value' => set_value('address'),
														'data-validation'=>'required',
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('address')) {
                                        			    echo form_error('address', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                    </div>    
                                    <div class="row">     
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('city') ? 'error' : ''; ?>">
                                    		<?php 
                                    			echo form_label($label_City , 'city');
                                    
                                    			$attributes = array(
                                    				'name' => 'city',
                                    				'placeholder' => $placeholder_City,
                                    				'class' => 'form-control',
                                    			    'onkeyup' => 'lettersOnly(this);',
                                    			    ' autocomplete' => 'off',
                                    				'value' => set_value('city'),
                                    			    'data-validation'=> 'required length',
                                    			    'data-validation-length' => "3-32",
                                    			); 
                                    			
                                    			echo form_input($attributes);
                                    			
                                    			if(form_error('city')) {
                                    			    echo form_error('city', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('country') ? 'error' : ''; ?>">
											<?php 
                                    			echo form_label($label_country , 'country');
                                    
                                    			$attributes = array(
                                    				'name' => 'country',
													'id' => 'country',
                                    				'placeholder' => $placeholder_country,
                                    				'class' => 'form-control',
                                    				'value' => set_value('country'),
													'data-validation'=>'required',
                                    			); 
                                    			
                                    			echo form_dropdown($attributes);
                                    			
                                    			if(form_error('country')) {
                                    			    echo form_error('country', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>
                                    	</div>	
                                    </div>    
                                    <div class="row"> 											
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('state') ? 'error' : ''; ?>">
											<?php 
                                    			echo form_label($label_state , 'state');
                                    
                                    			$attributes = array(
                                    				'name' => 'state',
													'id' => 'state',
                                    				'placeholder' => $placeholder_state,
                                    				'class' => 'form-control',
                                    				'value' => set_value('state'),
													'data-validation'=>'required',
                                    			); 
                                    			
                                    			echo form_dropdown($attributes);
                                    			
                                    			if(form_error('state')) {
                                    			    echo form_error('state', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('postal') ? 'error' : ''; ?>">
                                    		<?php 
                                    			echo form_label($label_postal_code , 'postal');
                                    
                                    			$attributes = array(
                                    				'name' => 'postal',
                                    				'placeholder' => $placeholder_postal_code,
                                    				'class' => 'form-control',
                                    				'value' => set_value('postal'),
													'data-validation'=> 'required number, length',
                                        			'data-validation-allowing' => "[0-9]+",
                                        			'data-validation-length' => '6'
                                    			); 
                                    			
                                    			echo form_input($attributes);
                                    			
                                    			if(form_error('postal')) {
                                    			    echo form_error('postal', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>												
                                    	</div>
                                   </div>    
                                    <div class="row">  	
                                    	<div class="col-md-12">
                                    		<div class="form-group <?php echo form_error('telephone') ? 'error' : ''; ?>">
                                    		<?php 
                                    			echo form_label($label_telephone , 'telephone');
                                    
                                    			$attributes = array(
                                    				'name' => 'telephone',
                                    				'placeholder' => $placeholder_telephone,
                                    				'class' => 'form-control',
                                    				'value' => set_value('telephone'),
													'data-validation'=> 'required number length allowing',
                                        			 'data-validation-allowing' => "[0-9]+",
                                        			'data-validation-length' => '10'
                                    			); 
                                    			
                                    			echo form_input($attributes);	
                                    			
                                    			if(form_error('telephone')) {
                                    			    echo form_error('telephone', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>
                                    	</div>
									</div>
								</div>
							</div>
							<div class="form_field_blk">
								<h3><?php echo $text_agent_contact;?></h3>
								<div class="field_wrap" style="display: block;">
									<div class="row">
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('admin_fullname') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_admin_name, 'admin_fullname');
                                        
                                        			$attributes = array(
                                        				'name' => 'admin_fullname',
                                        				'placeholder' => $placeholder_admin_name,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('admin_fullname'),
														'data-validation'=>'required length custom',
														'data-validation-length' => '3-255',
                                                        'data-validation-regexp' => "^(?!\s*$|\s).([A-Za-z ]+)$"
                                        			); 
                                                    
                                        			echo form_input($attributes);	
                                        			
                                        			if(form_error('admin_fullname')) {
                                        			    echo form_error('admin_fullname', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>	
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('admin_contact') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_admin_contact, 'admin_contact');
                                        
                                        			$attributes = array(
                                        				'name' => 'admin_contact',
                                        				'placeholder' => $placeholder_admin_contact,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('admin_contact'),
														'data-validation'=> 'required number length allowing',
														 'data-validation-allowing' => "[0-9]+",
														'data-validation-length' => '10'
                                        			); 
                                                    
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('admin_contact')) {
                                        			    echo form_error('admin_contact', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>
                                    		</div>
                                    	</div>
                                    </div>
                                    <div class="row">
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('admin_email') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($label_admin_email, 'admin_email');
                                        
                                        			$attributes = array(
                                        				'name' => 'admin_email',
                                        				'placeholder' => $placeholder_admin_email,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('admin_email'),
                                        			    'data-validation'=> 'required length email',
                                        			    'data-validation-length' => "3-100",
                                        			); 
                                                    
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('admin_email')) {
                                        			    echo form_error('admin_email', '<span class="help-block form-error"> ','</span>');
                                        			}
                                        		?>
                                    		</div>
                                    	</div>
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('repeat') ? 'error' : ''; ?>">
                                    		<?php 
                                    			echo form_label($label_admin_confirm_email, 'admin_confirm_email');
                                    
                                    			$attributes = array(
                                    				'name' => 'repeat',
                                    				'placeholder' => $placeholder_admin_confirm_email,
                                    				'class' => 'form-control',
                                    			    'value' => set_value('repeat'),
													'data-validation'=> "required,email,confirmation",
													'data-validation-confirm'=> "admin_email",
                                    			); 
                                    			
                                    			echo form_input($attributes);
                                    			
                                    			if(form_error('repeat')) {
                                    			    echo form_error('repeat', '<span class="help-block form-error"> ','</span>');
                                    			}
                                    		?>
                                    		</div>
                                    	</div>
									</div>
								</div>
							</div>
							<div class="form_field_blk">
								<h3><?php echo $text_agent_general_info;?></h3>
								<div class="field_wrap">
									<h4><?php echo $label_business_type;?>:</h4>
									<div class="col-md-12">
                                    		<div class="form-group <?php echo form_error('business_type[]') ? 'error' : ''; ?>">
                                    <div class="radio_list">
                                    	<ul>
                                    		<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6"  name="business_type[]" value="Tourism" <?php echo set_checkbox('business_type', 'Tourism'); ?>/> <?php echo $text_tours;?></label>
											</li>
                                    		<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6" name="business_type[]" value="Transportation" <?php echo set_checkbox('business_type', 'Transportation'); ?>/> <?php echo $text_travels;?></label>
											</li>
                                    		<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6"  name="business_type[]" value="Golf Course" <?php echo set_checkbox('business_type', 'Golf Course'); ?> / > <?php echo $text_golfs;?></label>
											</li>
                                    		<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6" name="business_type[]" value="Club and Bar" <?php echo set_checkbox('business_type', 'Club & Bar'); ?>/> <?php echo $text_clubs_bars;?></label>
											</li>
                                    		<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6" name="business_type[]" value="Restaurant" <?php echo set_checkbox('business_type', 'Restaurant'); ?>/> <?php echo $text_restaurants;?></label>
											</li>
											<li>
												<label><input type="checkbox" data-validation="checkbox_group" data-validation-qty="1-6" name="business_type[]" value="Wedding Plan" <?php echo set_checkbox('business_type', 'Wedding Plan'); ?>/> <?php echo $text_weddings;?></label>
											</li>
                                    	</ul>
										<?php 
											if(form_error('business_type[]')) {
											echo form_error('business_type[]', '<span class="help-block form-error"> ','</span>');
                                    	}?>
                                    </div>
									</div>
									</div>
								</div>
							</div>
							<div class="btn_blk">
                                <?php
                                    $data = array(
                                        'name'          => 'submit',
                                        'id'            => 'submit',
                                        'value'         => $text_submit,
                                        'type'          => 'submit',
                                        'content'       => $text_submit
                                    );
                                
                                    echo form_button($data);
                                ?>
                            </div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</section>
		</section>
	</section>
</main>

<script src="<?php echo base_url('assets/js/countries.js'); ?>"></script>

<script>
	populateCountries("country", "state");
	<?php if($this->session->flashdata('country_flash_session')){?>
		populateCountries("country", "state");
		$('select[id^="country"] option[value="<?php echo $this->session->flashdata('country_flash_session');?>"]').attr("selected","selected");
	<?php }?>
	<?php if($this->session->flashdata('state_flash_session')){?>
	populateStates( "country", "state" );
	$('select[id^="state"] option[value="<?php echo $this->session->flashdata('state_flash_session');?>"]').attr("selected","selected");
	<?php }?>
</script>	
<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>