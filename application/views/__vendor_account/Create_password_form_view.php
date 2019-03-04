<main>
	<section class="content_area wow slideIn" data-wow-duration="1s">
		<section class="container">
			<section class="row">
				<div class="agent_blk">
					<?php if($this->session->flashdata('validation_failed')) { ?>
    					<div class="error_box">
    						<p>
    							<strong>
    								<i class="fa fa-info-circle"></i> <?php echo $text_validation_errors; ?>
    							</strong>
    						</p>
    					</div>
					<?php } ?>
					<div class="agent_portal_field forgot_pwd_form">
						<?php echo form_open('vendor/account/create-password?access_token=' . $_GET["access_token"]); ?>
							<div class="form_field_blk">
								<h3>
									<?php echo $text_update_password; ?>
								</h3>
								<div class="field_wrap">
									<div class="row">
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('password') ? 'error' : ''; ?>">
                                        		<?php 
                                        		    echo form_label($text_placeholder_password , 'password');
                                        
                                        			$attributes = array(
                                        			    'type' => 'password',
                                        				'name' => 'password',
                                        			    'placeholder' => $text_placeholder_password,
                                        			    'data-validation'=> 'required,length',
                                        			    'data-validation-length' => "6-12",
                                        				'class' => 'form-control'
                                        			); 
                                        			
                                        			echo form_input($attributes);
													
													echo form_hidden('vendor_id',$vendor_id);	
                                        			
                                        			if(form_error('password')) {
                                        			    echo form_error('password', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        		?>
                                        	</div>
                                        </div>
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo form_error('repeat_password') ? 'error' : ''; ?>">
                                        		<?php 
                                        		  echo form_label($text_placeholder_repeat_password , 'repeat_password');
                                        
                                        			$attributes = array(
                                        			    'type' => 'password',
                                        				'name' => 'repeat_password',
                                        			    'placeholder' => $text_placeholder_repeat_password,
                                        				'class' => 'form-control',
                                        			    'data-validation-confirm' => 'password',
														 'data-validation'=> 'required,length',
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
                                </div>
                            </div>
							<div class="btn_blk">
                                <?php
                                    $attributes = array(
                                        'type'          => 'submit',
                                        'name'          => 'submit',
                                        'id'            => 'submit',
                                        'value'         => true,
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

<script>
$.validate({
	modules : 'location, date, security, file',
    onModulesLoaded : function() {
		$('#country').suggestCountry();
    }
});

// Restrict presentation length
$('#presentation').restrictLength( $('#pres-max-length') );
</script>