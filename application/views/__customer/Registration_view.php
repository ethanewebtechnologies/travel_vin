<main>
	<section class="content_area wow slideIn" data-wow-duration="1s">
		<div class="agent_bnr">
			<img src="<?php echo base_url('assets/img/agent_bnr.jpg'); ?>" alt=""/>
			<h2><?php echo $text_join_journey_with_us; ?></h2>
		</div>
		<section class="container">
			<section class="row">
				<div class="agent_blk">
					<?php if($this->session->flashdata('validation_failed')) { ?>
    					<div class="error_box">
    						<p><strong><i class="fa fa-info-circle"></i> <?php echo $text_validation_errors; ?></strong></p>
    					</div>
					<?php } ?>
					<div class="agent_portal_field">
						<?php echo form_open('customer/registration'); ?>
							<div class="form_field_blk">
								<h3><?php echo $text_your_profile_details; ?></h3>
								<div class="field_wrap" style="display: block;">
									<div class="row">
                                        <div class="col-md-6">
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
                                        			    echo form_error('firstname', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>													
                                        	</div>
                                        </div>
										<div class="col-md-6">
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
                                        			    echo form_error('lastname', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('email') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($text_label_email, 'email');
                                        
                                        			$attributes = array(
                                        				'name' => 'email',
                                        			    'placeholder' => $text_placeholder_email,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('email'),
                                        			    'data-validation'=> 'required length email',
                                        			    'data-validation-length' => "3-100",
                                        			    
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('email')) {
                                        			    echo form_error('email', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>													
                                        	</div>
                                        </div>
                                         <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('repeat_email') ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($text_label_repeat_email, 'repeat_email');
                                        
                                        			$attributes = array(
                                        				'name' => 'repeat',
                                        			    'placeholder' => $text_placeholder_repeat_email,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('repeat_email'),
                                        			    'data-validation'=> 'required,confirmation',
                                        			    'data-validation-confirm' => 'email'
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('repeat_email')) {
                                        			    echo form_error('repeat_email', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>													
                                        	</div>
                                        </div>
                                        </div>
                                        <div class="row">
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('password') ? 'error' : ''; ?>">
                                        		<?php 
                                        		    echo form_label($text_label_password , 'password');
                                        
                                        			$attributes = array(
                                        				'name' => 'password_confirmation',
                                        			    'placeholder' => $text_placeholder_password,
                                        				'class' => 'form-control',
                                        			    'type'   => 'password',
                                        			    'data-validation'=> 'required,length',
                                        			    'data-validation-length' => "6-12",
                                        			); 
                                        			
                                        			echo form_input($attributes);	
                                        			
                                        			if(form_error('password')) {
                                        			    echo form_error('password', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('repeat_password') ? 'error' : ''; ?>">
                                        		<?php 
                                        		  echo form_label($text_label_repeat_password , 'repeat_password');
                                        
                                        			$attributes = array(
                                        				'name' => 'password',
                                        			    'type'   => 'password',
                                        			    'placeholder' => $text_placeholder_repeat_password,
                                        				'class' => 'form-control',
                                        			    'data-validation'=> 'required,length,confirmation',
                                        			    'data-validation-length' => "6-12",
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('repeat_password')) {
                                        			    echo form_error('repeat_password', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                        </div>
                                        <div class="row">
                                    	<div class="col-md-6">
                                    		<div class="form-group <?php echo form_error('telephone') ? 'error' : ''; ?>">
                                        		<?php 
                                        		    echo form_label($text_label_telephone , 'telephone');
                                        
                                        			$attributes = array(
                                        				'name' => 'telephone',
                                        			    'placeholder' => $text_placeholder_telephone,
                                        				'class' => 'form-control',
                                        				'value' => set_value('telephone'),
                                        			    'data-validation'=> "required,number,length,",
                                        			    'data-validation-allowing' => "[0-9]+",
                                        			    'data-validation-length' => '10'
                                        			); 
                                        			
                                        			echo form_input($attributes);	
                                        			if(form_error('telephone')) {
                                        			    echo form_error('telephone', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>
                                    		</div>
                                    	</div>
                                                	
                                         <div class="col-md-6">
                                             <div class="form-group <?php if(form_error('gender')) { echo 'error'; }else{echo '';} ?>">
                                				<?php 
                                				echo form_label($text_label_gender , 'gender');
                                			
                                				$attributes = array(
                                				   'name' => 'gender',
                                				   'class' => 'form-control',
                                				   'id'=>'gender',
                                				   'data-validation' => 'required',
                                				); 
                                				echo form_dropdown($attributes,$gender_array);
                                				if(form_error('gender')) {
                                					echo form_error('gender', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                				}
                                				?>
                                			</div>
                                        </div>
									</div>
                                </div>
                            </div>
                            <div class="form_field_blk">
								<h3><?php echo $text_newsletter; ?></h3>
                                <div class="field_wrap">
                                	<div class="row">
                                		<div class="col-md-12">
											<div class="form-group">
												<label>
													<input type="checkbox" name="newsletter_status" value="1" checked="checked"> <?php echo $text_newsletter_subscription; ?>.
												</label>
											</div>
										</div>
                                	</div>
                                </div>
							</div>
							<div class="form_field_blk">
								<h3><?php echo $text_t_n_c; ?></h3>
                                <div class="field_wrap">
                                	<div class="row">
                                		<div class="col-md-12">
											<div class="form-group">	
												<label>
													<input type="checkbox" name="agree_terms_and_conditions" value="1" checked="checked" data-validation="required"><?php echo $text_t_n_c_details1; ?><a href="#"><?php echo $text_t_n_c_details2; ?></a>.
												</label>
											</div>
										</div>
                                	</div>
                                </div>
							</div>
							<div class="btn_blk">
                                <?php
                                    $attributes = array(
                                        'name'          => 'submit',
                                        'id'            => 'submit',
                                        'value'         => true,
                                        'type'          => 'submit',
                                        'content'       => $text_content_submit
                                    );
                                    
                                    echo form_button($attributes);
                                ?>
							</div>
						<?php echo form_close(); ?>
					</div>
				</div>
			</section>
		</section>
	</section>
</main>