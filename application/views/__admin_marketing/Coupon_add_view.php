<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open('admin/marketing/coupon/add', $attributes); 
		?>
			<h2>
        		Add Coupon Details 
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
                	
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/marketing/coupon'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
			<div class="panel panel-primary">
    			<div class="panel-body">
                	
					 <div class="form-group <?php if(form_error('coupon_name')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
							
							echo form_label('Coupon Name: ', 'coupon_name', $attributes);
						?>
						<div class="col-sm-8">
							<?php 
								$attributes = array(									
									'name' => 'coupon_name',
									'class' => 'form-control',
									'placeholder' => 'Please enter Coupon Name',
									'value' => set_value('coupon_name'),
								    'data-validate' => 'required, minlength[3], maxlength[40]',
								    'data-message-required' => 'Coupon name is Required'
								);
									
								echo form_input($attributes);
							?>
                            <?php if(form_error('coupon_name')) { ?>
            					<?php echo form_error('coupon_name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
						</div>
					</div>		
					
					<div class="form-group <?php if(form_error('coupon_code')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
							
							echo form_label('Coupon Code: ', 'coupon_code', $attributes);
						?>
						<div class="col-sm-8">
							<?php 
								$attributes = array(									
									'name' => 'coupon_code',
									'class' => 'form-control',
								    'placeholder' => 'Coupon code eg- FALL25',
								    'value' => set_value('coupon_code', $coupon_code),
								    'data-validate' => 'required',
								    'data-message-required' => 'Coupon Code is Required'
								);
									
								echo form_input($attributes);
							?>
							<span class="description">Use a random code or specify your own like FALL25. Letters and numbers only, no spaces or symbols. We've defined a random code. Feel free to specify your own e.g. DISC50. Spaces, special characters or symbols not allowed.</span>
							<?php if(form_error('coupon_code')) { ?>
            					<?php echo form_error('coupon_code', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
						</div>
					</div>					
					<div class="form-group <?php if(form_error('coupon_type')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);

							echo form_label('Coupon Type: ', 'coupon_type', $attributes);
						?>
                       
						<div class="col-sm-8">
							<?php
								$attributes = array(
									'name' => 'coupon_type',
									'class' => 'form-control',
								    'data-validate' => 'required',
								    'data-message-required' => 'Coupon Type must be selected'
								    
								);
								
								$options = array(
									'PERCENT' => 'Percentage',
									'VALUE' => 'Amount',									
								);
								
                                echo form_dropdown($attributes, $options, set_value('coupon_type'));
							?>
                            <?php if(form_error('coupon_type')) { ?>
            					<?php echo form_error('coupon_type', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if(form_error('coupon_value')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);

							echo form_label('Coupon Value: ', 'coupon_value', $attributes);
						?>
                        <div class="col-sm-8">
							<div class="input-group">
    							<?php
    								$attributes = array(
    								    'type' => 'number',
    								    'placeholder' => 'Please enter coupon value',
    									'name' => 'coupon_value',								
    									'class' => 'form-control',									
    									'value' => set_value('coupon_value'),
    								    'data-validate' => 'required min[1]',
    								    'data-message-required' => 'Coupon value is Required'
    								);
    								
    								echo form_input($attributes);
    							?>
    							<span class="input-group-addon">PERCENTAGE / VALUE</span>
    						</div>
                            <?php if(form_error('coupon_value')) { ?>
            					<?php echo form_error('coupon_value', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>

					<div class="form-group <?php if(form_error('no_of_coupon')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);

							echo form_label('No of Coupon: ', 'no_of_coupon', $attributes);
						?>
                        <div class="col-sm-8">
							<?php
								$attributes = array(
								    'type' => 'number',
								    'placeholder' => 'Please enter number of coupon',
									'name' => 'no_of_coupon',								
									'class' => 'form-control',									
									'value' => set_value('no_of_coupon'),
								    'data-validate' => 'required min[1]',
								    'data-message-required' => 'Please enter no of coupon'
								);
								
								echo form_input($attributes);
							?>
                            <?php if(form_error('coupon_value')) { ?>
            					<?php echo form_error('coupon_value', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>
					
					<div class="form-group <?php if(form_error('coupon_start_date')) { echo 'validate-has-error'; } ?>">
                        <?php 
                            $attributes = array(
                              'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Coupon Start Date: ', 'coupon_start_date', $attributes); 
                        ?>
						<div class="col-sm-8">
							<div class="input-group">
								<?php 
                                    $attributes = array(
                                       'name' => 'coupon_start_date',
                                       'placeholder' => 'Please enter coupon start date',
                                       'id' => 'coupon_start_date',
                                       'class' => 'form-control datepicker',									  
                                       'data-format' => 'dd-mm-yyyy',
                                       'value' => set_value('coupon_start_date')
                                    );

                                    echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('coupon_start_date')) { ?>
                    					<?php echo form_error('coupon_start_date', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
					</div>
						<div class="form-group <?php if(form_error('coupon_end_date')) { echo 'validate-has-error'; } ?>">
                        <?php 
                            $attributes = array(
                              'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Coupon End Date: ', 'coupon_end_date', $attributes); 
                        ?>
						<div class="col-sm-8">
							<div class="input-group">
								<?php 
                                    $attributes = array(
                                       'name' => 'coupon_end_date',
                                        'placeholder' => 'Please enter coupon end date',
                                       'id' => 'coupon_end_date',
                                       'class' => 'form-control datepicker',
                                       'data-format' => 'dd-mm-yyyy',
                                       'value' => set_value('coupon_end_date')
                                    );

                                    echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('coupon_start_date')) { ?>
                    					<?php echo form_error('coupon_start_date', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
								</div>
							</div>
						</div>
					</div>
					
					<div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Status: ', 'status', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <div class="bs-example">
                                <div class="make-switch" data-on="primary" data-off="info">
                                    <?php
                                        $data = array(
                                            'name' => 'status',
                                            'id' => 'status',
                                            'value' => '1',
                                            'checked' => TRUE
                                        );
        
                                        echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>


	<script>
$(function(){
    $('#coupon_start_date').datepicker({
        startDate: '-0m',
		format: 'dd-mm-yyyy',     
    }).on('changeDate', function(e) {
		var newdate = $(this).val();
		newdate = newdate.split("-").reverse().join("-");
		var selectedDate = new Date(newdate);
        var msecsInADay = 86400000;
        var endDate = new Date(selectedDate.getTime() + msecsInADay);

		$('#coupon_end_date').datepicker('setStartDate', endDate);
	});
	$('#coupon_end_date').datepicker({
		format: 'dd-mm-yyyy',     
	});

});
</script>


<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>