<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open('admin/agent/accounts/edit?secure_token=' . $this->security_lib->encrypt($agent['id']), $attributes); 
		?>
            <h2>
        		Edit Park Details
                   <span class="pull-right btn-toolbar">
            		<?php
                        $attributes = array(
                            'name'          => 'save',
                            'id'            => 'save',
                            'value'         => 'Save',
                            'type'          => 'submit',
                            'content'       => '<i class="entypo-check"></i> Save',
                            'class'         => 'btn btn-green btn-icon icon-left'
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
                                    'value' => set_value('company_legal_name', $agent['company_legal_name']),
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
                                    'value' => set_value('tax_id', $agent['tax_id']),
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
                                   'placeholder' => 'Please Enter Email',
                                   'class' => 'form-control',
                                   'value' => set_value('email', $agent['email']),
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
            		<?php echo form_hidden('current_agent_email', $agent['email']); ?>
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
                            	    'value' => set_value('address', $agent['address']),
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
                            	    'value' => set_value('city', $agent['city']),
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
                                    'value' => set_value('country', $agent['country']),
                                    'data-validate' => 'required',
                                    'data-message-required' => 'You must provide a/an Country.'
                                );
                                
                                echo form_dropdown($attributes);
                            ?>
                    	</div>
                    	<?php if(form_error('country')) { ?>
							<?php echo form_error('country', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
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
                        		    'placeholder' => 'Please Enter State',
                        		    'class' => 'form-control',
                        		    'value' => set_value('state', $agent['state']),
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
                        		    'type'  => 'number',
                        		    'class' => 'form-control',
                        		    'value' => set_value('postal', $agent['postal']),
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
                        		    'placeholder' => 'Please Enter Telephone',
                        		    'class' => 'form-control',
                        		    'type'  => 'number',
                        		    'value' => set_value('telephone', $agent['telephone']),
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
                    <!-- VERY IMPORTANT .. DO NOT BREAK -->
                    <?php 
                        $business_types = explode(',', $agent['business_type']);
                    ?>
                    
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
									<input type="checkbox" name="business_type[]" value="Tourism" <?php echo set_checkbox('business_type', 'Tourism'); ?> <?php if(in_array('Tourism', $business_types)) { echo 'checked'; } ?> />
								</label>
								<label>Tourism</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Transportation" <?php echo set_checkbox('business_type', 'Transportation'); ?> <?php if(in_array('Transportation', $business_types)) { echo 'checked'; } ?> />
								</label>
								<label>Transportation</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Golf Course" <?php echo set_checkbox('business_type', 'Golf Course'); ?> <?php if(in_array('Golf Course', $business_types)) { echo 'checked'; } ?> />
								</label>
								<label>Golf Course</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Club and Bar" <?php echo set_checkbox('business_type', 'Club & Bar'); ?> <?php if(in_array('Club & Bar', $business_types)) { echo 'checked'; } ?> />
								</label>
								<label>Club & Bar</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Restaurant" <?php echo set_checkbox('business_type', 'Restaurant'); ?> <?php if(in_array('Restaurant', $business_types)) { echo 'checked'; } ?> />
								</label>
								<label>Restaurant</label>
							</div>
							<div class="checkbox checkbox-replace">
								<label class="cb-wrapper">
									<input type="checkbox" name="business_type[]" value="Wedding Plan" <?php echo set_checkbox('business_type', 'Wedding Plan'); ?> <?php if(in_array('Wedding Plan', $business_types)) { echo 'checked'; } ?> />
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
        		Edit Admin Details
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
                                   'value' => set_value('admin_fullname', $agent['admin_fullname']),
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
                                   'placeholder' => 'Please Enter Admin Contact',
                                   'class' => 'form-control',
                                   'value' => set_value('admin_contact', $agent['admin_contact']),
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
                                   'placeholder' => 'Please Enter Admin Email',
                                   'class' => 'form-control',
                                   'value' => set_value('admin_email', $agent['admin_email']),
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
					<?php echo form_hidden('current_admin_email', $agent['admin_email']); ?>      
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>

<script src="<?php echo base_url('assets/js/countries.js'); ?>"></script>
 <script>
 
 populateCountries("country", "state");
  $(document).ready(function(){
  $("#country").val("<?php echo $agent['country']; ?>"); 
  $("#state").append("<option value='<?php echo $agent['state']; ?>'><?php echo $agent['state']; ?></option>");
 }); 
 </script>