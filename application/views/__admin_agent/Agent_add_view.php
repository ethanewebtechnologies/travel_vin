<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open('admin/agent/accounts/add', $attributes); 
		?>
            <h2>
        		Add Park Details
                <span class="pull-right btn-toolbar">
            		<?php
                        $attributes = array(
                            'name'          => 'add',
                            'id'            => 'add',
                            'value'         => 'Add',
                            'type'          => 'submit',
                            'content'       => '<i class="entypo-plus"></i> Add',
                            'class'         => 'btn btn-blue btn-icon icon-left'
                        );
                        
                        echo form_button($attributes);
                	?>
					<?php
                        $attributes = array(
                            'name'          => 'reset',
                            'id'            => 'reset',
                            'value'         => 'Reset',
                            'type'          => 'reset',
                            'content'       => '<i class="entypo-ccw"></i> Reset',
                            'class'         => 'btn btn-orange btn-icon icon-left'
                        );
                        
                        echo form_button($attributes);
                	?>
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/agent/accounts'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
			<div class="panel panel-primary">
    			<div class="panel-body">
    				<div class="form-group <?php if(form_error('company_legal_name')) { echo 'validate-has-error'; } ?>">
    					<?php
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Company Legal Name: ', 'company_legal_name', $attributes);
                        ?>
        				<div class="col-sm-8">
        					<?php 
                                $attributes = array(
                                    'name' => 'company_legal_name',
                                    'placeholder' => 'Please Enter Company Legal Name',
                                    'class' => 'form-control',
                                    'value' => set_value('company_legal_name'),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => 'Company Legal Name is Required.'
                                );
                                
                                echo form_input($attributes);
            				?>
            				
            				<?php if(form_error('company_legal_name')) { ?>
    							<?php echo form_error('company_legal_name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
        				</div>
            		</div>
    				<div class="form-group <?php if(form_error('tax_id')) { echo 'validate-has-error'; } ?>">
    					<?php
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Tax Id: ', 'tax_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'tax_id',
                                    'placeholder' => 'Please Enter Tax Id',
                                    'class' => 'form-control',
                                    'value' => set_value('tax_id'),
                                    'data-validate' => 'minlength[3], maxlength[100]',
                                );
                                
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('tax_id')) { ?>
    							<?php echo form_error('tax_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                    	</div>        
    				</div>
    				<div class="form-group <?php if(form_error('email')) { echo 'validate-has-error'; } ?>">
    					<?php
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Company Email: ', 'email', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php
                                $attributes = array(
                                   'name' => 'email',
                                    'type' => 'email',
                                   'placeholder' => 'Please Enter Email',
                                   'class' => 'form-control',
                                    'value' => set_value('email'),
                                    'data-validate' => 'required, minlength[3], maxlength[150]',
                                    'data-message-required' => 'Company Email is Required.'
                                );
                                
                                echo form_input($attributes);
                            ?>
                            
                            <?php if(form_error('email')) { ?>
    							<?php echo form_error('email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
            			</div>
            		</div>	
                    <div class="form-group <?php if(form_error('address')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
								
                    	    );
                    	    
                        	echo form_label('Address: ', 'address', $attributes);
                        ?>        
                        <div class="col-sm-8">
                        	<?php
                            	$attributes = array(
                            	    'name' => 'address',
                            	    'id' => 'address',
                            	    'placeholder' => 'Please Enter Address',
                            	    'class' => 'form-control',
                            	    'value' => set_value('address'),
                            	    'data-validate' => 'required, minlength[3], maxlength[200]',
                            	    'data-message-required' => 'You must provide a/an Company Address.'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	
                        	<?php if(form_error('address')) { ?>
    							<?php echo form_error('address', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('city')) { echo 'validate-has-error'; } ?>">
                    	<?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('City: ', 'city', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php
                            	$attributes = array(
                            	    'name' => 'city',
                            	    'id' => 'city',
                            	    'placeholder' => 'Please Enter City',
                            	    'class' => 'form-control',
                            	    'value' => set_value('city'),
                            	    'data-validate' => 'required, minlength[3], maxlength[100]',
                            	    'data-message-required' => 'You must provide a/an City.'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	
                        	<?php if(form_error('city')) { ?>
    							<?php echo form_error('city', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                        </div>
                    </div> 
                    <div class="form-group <?php if(form_error('country')) { echo 'validate-has-error'; } ?>">
                    	<?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Country: ', 'country', $attributes);
                        ?>
						<div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'country',
                                    'id' => 'country',
                                    'placeholder' => 'Please Enter Country',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'You must provide a/an Country.'
                                );
                                
                                echo form_dropdown($attributes);
                            ?>
                            
                            <?php if(form_error('country')) { ?>
    							<?php echo form_error('country', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                    	</div>
                    </div>
                    <div class="form-group <?php if(form_error('state')) { echo 'validate-has-error'; } ?>">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('State: ', 'state', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php
                        		$attributes = array(
                        		    'name' => 'state',
                        		    'id' => 'state',
                        		    'class' => 'form-control',
                        		    'data-validate' => 'required',
                        		    'data-message-required' => 'You must provide a/an State.',
                        		);
                        		
                        		echo form_dropdown($attributes);
                    		?>
                    		
                    		<?php if(form_error('state')) { ?>
    							<?php echo form_error('state', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                    	</div>
                    </div>
                    <div class="form-group <?php if(form_error('postal')) { echo 'validate-has-error'; } ?>">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('Pincode: ', 'postal', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php
                        		$attributes = array(
                        		    'name' => 'postal',
                        		    'class' => 'form-control',
                        		    'value' => set_value('postal'),
                        		    'data-validate' => 'required, minlength[3], maxlength[100]',
                        		    'data-message-required' => 'You must provide a/an Post Code.'
                        		);
                        		
                        		echo form_input($attributes);
                    		?>
                    		
                    		<?php if(form_error('postal')) { ?>
    							<?php echo form_error('postal', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                    	</div>
                    </div>     
                    <div class="form-group <?php if(form_error('telephone')) { echo 'validate-has-error'; } ?>">
                    	<?php 
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('Telephone: ', 'telephone', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php
                        		$data = array(
                        		    'name' => 'telephone',
                        		    'value' => set_value('telephone'),
                        		    'type'  => 'number',
                        		    'placeholder' => 'Please Enter Telephone',
                        		    'class' => 'form-control',
                        		    'data-validate' => 'required, minlength[10], maxlength[10]',
                        		    'data-message-required' => 'You must provide a/an Telephone.'
                        		);
                        		
                        		echo form_input($data);
                    		?>
                    		
                    		<?php if(form_error('telephone')) { ?>
    							<?php echo form_error('telephone', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
                    	</div>
                    </div>	
                    <div class="form-group <?php if(form_error('business_type[]')) { echo 'validate-has-error'; } ?>">
                    	<?php 
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('Business Type: ', 'business_type[]', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Tourism" <?php echo set_checkbox('business_type', 'Tourism'); ?> checked />
								</label>
								<label>Tourism</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Transportation" <?php echo set_checkbox('business_type', 'Transportation'); ?> />
								</label>
								<label>Transportation</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Golf Course" <?php echo set_checkbox('business_type', 'Golf Course'); ?> />
								</label>
								<label>Golf Course</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Club and Bar" <?php echo set_checkbox('business_type', 'Club & Bar'); ?> />
								</label>
								<label>Club & Bar</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Restaurant" <?php echo set_checkbox('business_type', 'Restaurant'); ?> />
								</label>
								<label>Restaurant</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Wedding Plan" <?php echo set_checkbox('business_type', 'Wedding Plan'); ?> />
								</label>
								<label>Wedding Plan</label>
							</div>
                    	
                    		<?php if(form_error('business_type[]')) { ?>
                    			<?php echo form_error('business_type[]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?>
                    	</div>
                    </div>
                </div>
            </div> 
            <h2>
        		Add Admin Details
        	</h2>	
            <div class="panel panel-primary">   
                <div class="panel-body">
                    <div class="form-group <?php if(form_error('admin_fullname')) { echo 'validate-has-error'; } ?>">
                    	<?php 
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('Admin Fullname: ', 'admin_fullname', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php  
                                $data = array(
                                   'name' => 'admin_fullname',
                                   'placeholder' => 'Please Enter Admin Fullname',
                                   'class' => 'form-control',
                                    'value' => set_value('admin_fullname'),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => 'Admin Fullname is Required.'
                                );
            		
                                echo form_input($data);
                            ?>
                            
                            <?php if(form_error('admin_fullname')) { ?>
    							<?php echo form_error('admin_fullname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
						</div>
					</div>   
					<div class="form-group <?php if(form_error('admin_contact')) { echo 'validate-has-error'; } ?>">
                    	<?php 
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	echo form_label('Admin Contact: ', 'admin_contact', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php  
                                $data = array(
                                   'name' => 'admin_contact',
                                    'type'  => 'number',
                                    'value' => set_value('admin_contact'),
                                   'placeholder' => 'Please Enter Admin Contact',
                                   'class' => 'form-control',
                                    'data-validate' => 'required, minlength[10], maxlength[10]',
                                    'data-message-required' => 'You must provide a/an Telephone.'
                                );
            		
                                echo form_input($data);
                            ?>
                            
                             <?php if(form_error('admin_contact')) { ?>
    							<?php echo form_error('admin_contact', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						 <?php } ?>
						</div>
					</div> 
					<div class="form-group <?php if(form_error('admin_email')) { echo 'validate-has-error'; } ?>">
                    	<?php 
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                        	
                        	echo form_label('Admin Email: ', 'admin_email', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php  
                                $data = array(
                                   'name' => 'admin_email',
                                   'type' => 'email',
                                   'placeholder' => 'Please Enter Admin Email',
                                   'class' => 'form-control',
                                    'value' => set_value('admin_email'),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => 'Admin Email is Required.'
                                );
            		
                                echo form_input($data);
                            ?>
                            
                            <?php if(form_error('admin_email')) { ?>
    							<?php echo form_error('admin_email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    						<?php } ?>
						</div>
					</div>       
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script src="<?php echo base_url('assets/js/countries.js'); ?>"></script>
<script>
	populateCountries("country", "state");
	/*  
		$(document).ready(function() {
  			$("#country").val("<?php echo $login_user[0]->ai_country; ?>")
 		}); 
	*/
 </script>