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
						<?php echo form_open('vendor/account/forget-password'); ?>
							<div class="form_field_blk">
								<h3>
									<?php echo $text_confirm_email_title; ?>
								</h3>
								<div class="field_wrap">
									<div class="row">
                                        <div class="col-md-6">
                                        	<div class="form-group <?php echo (form_error('email') || (isset($invalid_email) && !empty($invalid_email))) ? 'error' : ''; ?>">
                                        		<?php 
                                        			echo form_label($text_label_email, 'email');
                                        
                                        			$attributes = array(
                                        				'name' => 'email',
                                        			    'placeholder' => $text_placeholder_email,
                                        				'class' => 'form-control',
                                        			    'value' => set_value('email'),
                                        			    'data-validation'=> 'required length email',
                                        			    'data-validation-length' => "3-100",
                                        			    'data-validation-error-msg-required'=> 'Email is required'
                                        			); 
                                        			
                                        			echo form_input($attributes);
                                        			
                                        			if(form_error('email')) {
                                        			    echo form_error('email', '<p><i class="fa fa-times-circle"></i> ','</p>');
                                        			}
                                        			
                                        			if(isset($invalid_email) && !empty($invalid_email)) {
                                        			    echo '<p><i class="fa fa-times-circle"></i> ' . $invalid_email . '</p>';
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

<script>
$.validate({
	lang: 'en',
	modules : 'location, date, security, file',
	onModulesLoaded : function() {
		$('#country').suggestCountry();
    }
});

// Restrict presentation length
$('#presentation').restrictLength( $('#pres-max-length') );
</script>