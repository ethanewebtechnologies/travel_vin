<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );
    
            echo form_open_multipart('admin/catalog/transportation/add', $attributes);
        ?>
        <h2>
            Add Transportation Details
            <span class="pull-right btn-toolbar">
                <?php
                    $attributes = array(
                        'name' => 'add_one_side',
                        'id' => 'add',
                        'value' => 'add_one_side',
                        'type' => 'submit',
                        'content' => '<i class="entypo-plus"></i> Add One Side',
                        'class' => 'btn btn-blue btn-icon icon-left'
                    );
    
                    echo form_button($attributes);
                ?>
                <?php
                    $attributes = array(
                        'name' => 'add_both_side',
                        'id' => 'add',
                        'value' => 'add_both_side',
                        'type' => 'submit',
                        'content' => '<i class="entypo-plus"></i> Add Both Side',
                        'class' => 'btn btn-blue btn-icon icon-left'
                    );
    
                    echo form_button($attributes);
                ?>
                <?php
                    $attributes = array(
                        'name' => 'reset',
                        'id' => 'reset',
                        'value' => 'Reset',
                        'type' => 'reset',
                        'content' => '<i class="entypo-ccw"></i> Reset',
                        'class' => 'btn btn-orange btn-icon icon-left'
                    );
    
                    echo form_button($attributes);
                ?>
                <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/catalog/transportation'); ?>">
                    <i class="entypo-cancel"></i> Cancel
                </a>
            </span>
        </h2>
        
        <div class="panel panel-primary">
            <div class="panel-body">
            	<div class="form-group <?php if(form_error('from_location_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('From: ', 'from_location_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'from_location_id',
                                'id' => 'from_location_id',
                                'class' => 'form-control',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select Location'
                            );
    
                            echo form_dropdown($attributes, $locations, set_value('from_location_id'));
                        ?>
                        
                        <?php if(form_error('from_location_id')) { ?>
							<?php echo form_error('from_location_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                
                <div class="form-group <?php if(form_error('to_location_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('To: ', 'to_location_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'to_location_id',
                                'id' => 'to_location_id',
                                'class' => 'form-control',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select location'
                            );
    
                            echo form_dropdown($attributes, $locations, set_value('to_location_id'));
                        ?>
                   		<?php if(form_error('to_location_id')) { ?>
							<?php echo form_error('to_location_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                
                <div class="form-group <?php if(form_error('agent_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Park: ', 'agent_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'agent_id',
                                'class' => 'form-control',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select park'
                            );
    
                            echo form_dropdown($attributes, $agents, set_value('agent_id'));
                        ?>
                		<?php if(form_error('agent_id')) { ?>
							<?php echo form_error('agent_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                
               	<div class="form-group <?php if(form_error('country_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Country: ', 'country_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                             $attributes = array(
                                'name' => 'country_id',
                                'id' => 'country_id',
                                'class' => 'form-control',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select country'
                            );
    
                            echo form_dropdown($attributes, $countries, set_value('country_id'));
                        ?>
                    	<?php if(form_error('country_id')) { ?>
							<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                
                <div id="fg_city_id" class="form-group <?php if(form_error('city_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('City: ', 'city_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'city_id',
                                'id' => 'city_id',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select city',
                                'class' => 'form-control'
                            );
    
                            echo form_dropdown($attributes, $cities, set_value('city_id'));
                        ?>
                    	
                    	<?php if(form_error('city_id')) { ?>
							<?php echo form_error('city_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                
				<div class="form-group <?php if(form_error('private_cost_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Private Cost Per Passenger: ', 'private_cost_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'private_cost_per_passenger',
                                    'type' => 'number',
                                    'id' => 'private_cost_per_passenger',
                                    'placeholder' => 'Please Enter Private Cost Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('private_cost_per_passenger'),
                                    'data-validate' => 'required',
                                    'data-message-required' => ' Private Cost Per Passenger required '
                                );
        
                                echo form_input($attributes);
                            ?>
                             <span class="input-group-addon">USD / Passenger</span>
    					</div>
                    	<?php if(form_error('private_cost_per_passenger')) { ?>
							<?php echo form_error('private_cost_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>

                  <div class="form-group <?php if(form_error('shared_cost_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Shared Cost Per Passenger: ', 'shared_cost_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'shared_cost_per_passenger',
                                    'id' => 'shared_cost_per_passenger',
                                    'placeholder' => 'Please Enter Shared Cost Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('private_cost_per_passenger'),
                                    'type' => 'number',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Shared Cost Per Passenger is required'
                                );
        
                                echo form_input($attributes);
                            ?>
                        	<span class="input-group-addon">USD / Passenger</span>
    					</div>
                    	<?php if(form_error('shared_cost_per_passenger')) { ?>
							<?php echo form_error('shared_cost_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                 <div class="form-group <?php if(form_error('private_price_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Priavte Price Per Passenger: ', 'private_price_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'private_price_per_passenger',
                                    'id' => 'private_price_per_passenger',
                                    'placeholder' => 'Please Enter Priavte Price Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('private_price_per_passenger'),
                                    'type' => 'number',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Shared Cost Per Passenger required'
                                );
        
                                echo form_input($attributes);
                            ?>
                        	<span class="input-group-addon">USD / Passenger</span>
    					</div>
                    	<?php if(form_error('private_price_per_passenger')) { ?>
							<?php echo form_error('private_price_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                <div class="form-group <?php if(form_error('shared_price_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Shared Price Per Passenger: ', 'shared_price_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'shared_price_per_passenger',
                                    'id' => 'shared_price_per_passenger',
                                    'placeholder' => 'Please Enter Shared Price Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('shared_price_per_passenger'),
                                    'type' => 'number',
                                    'data-validate' => 'required',
                                    'data-message-required' => ' Shared Cost Per Passenger required'
                                );
        
                                echo form_input($attributes);
                            ?>
                        	<span class="input-group-addon">USD / Passenger</span>
    					</div>
                    	<?php if(form_error('shared_price_per_passenger')) { ?>
							<?php echo form_error('shared_price_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                <div class="form-group <?php if(form_error('private_price_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Priavte Deal Price Per Passenger: ', 'private_price_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'private_deal_price_per_passenger',
                                    'id' => 'private_deal_price_per_passenger',
                                    'type' => 'number',
                                    'placeholder' => 'Please Enter Priavte Deal Price Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('private_deal_price_per_passenger')
                                );
        
                                echo form_input($attributes);
                            ?>
                            <span class="input-group-addon">USD / Passenger</span>
    					</div>
                        <?php if(form_error('private_deal_price_per_passenger')) { ?>
							<?php echo form_error('private_deal_price_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                <div class="form-group <?php if(form_error('shared_deal_price_per_passenger')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Shared Deal Price Per Passenger: ', 'shared_deal_price_per_passenger', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'shared_deal_price_per_passenger',
                                    'id' => 'shared_deal_price_per_passenger',
                                    'type' => 'number',
                                    'placeholder' => 'Please Enter Shared Deal Price Per Passenger',
                                    'class' => 'form-control',
                                    'value' => set_value('shared_deal_price_per_passenger')
                                );
        
                                echo form_input($attributes);
                            ?>
                             <span class="input-group-addon">USD / Passenger</span>
    					</div>
                        <?php if(form_error('shared_deal_price_per_passenger')) { ?>
							<?php echo form_error('shared_deal_price_per_passenger', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
						<?php } ?>
                    </div>
                </div>
                 <!-- golf BLOCK -->
                <div class="form-group">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Block Dates: ', 'transport_avalability', $attributes);
                    ?>
                    
                    <div class="col-sm-8">
						<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
						<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
						<input class="form-control" name="block_transport_dates" id="mdp-demo" />
                   		
                   		<script type="text/javascript">
                   			$('#mdp-demo').multiDatesPicker({
                   				dateFormat: 'dd-mm-yy'
                   			});
                   		</script>
                    </div>
                </div>
                
                <!-- END golf BLOCK -->
				<div class="form-group <?php if(form_error('private_vehical_image')) { echo 'validate-has-error'; } ?>">
					<?php
						$attributes = array(
							'class' => 'col-sm-3 control-label'
						);
			
						echo form_label('Private Vehical Image:', 'private_vehical_image', $attributes);
					?>
					<div class="col-sm-8">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<input type="hidden" value="<?php echo set_value('private_vehical_image_check'); ?>" name="private_vehical_image_check">
							<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
								<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); ?>
							</div>
							
							<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 100px; line-height: 10px;"></div>
							
							<div>
								<span class="btn btn-white btn-file">
									<span class="fileinput-new">Select image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="private_vehical_image" accept="image/*">
								</span>
								<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
						<br>
						<?php if(form_error('private_vehical_image')) { ?>
            				<?php echo form_error('private_vehical_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            			<?php } ?>
					</div>
				</div>	 
				<div class="form-group <?php if(form_error('shared_vehical_image')) { echo 'validate-has-error'; } ?>">
					<?php
						$attributes = array(
							'class' => 'col-sm-3 control-label'
						);
			
						echo form_label('Shared Vehical Image:', 'image', $attributes);
					?>
					<div class="col-sm-8">
						<div class="fileinput fileinput-new" data-provides="fileinput">
							<input type="hidden" value="<?php echo set_value('shared_vehical_image_check'); ?>" name="shared_vehical_image_check">
							<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
								<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); ?>
							</div>
							
							<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 100px; line-height: 10px;"></div>
							
							<div>
								<span class="btn btn-white btn-file">
									<span class="fileinput-new">Select image</span>
									<span class="fileinput-exists">Change</span>
									<input type="file" name="shared_vehical_image" accept="image/*">
								</span>
								<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
							</div>
						</div>
						<br>
						<?php if(form_error('shared_vehical_image')) { ?>
            				<?php echo form_error('shared_vehical_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            			<?php } ?>
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
            </div>
            <ul class="nav nav-tabs right-aligned">
                <?php $flag = true; ?>
                <?php foreach ($languages as $language) { ?>
                    <li class="<?php echo $flag ? 'active' : ''; ?>">
                        <a data-toggle="tab" href="#<?php echo $language['code']; ?>">
                            <?php echo $language['name']; ?>
                        </a>
                    </li>
                    <?php $flag = false; ?>
                <?php } ?>
            </ul>
            <div class="tab-content">
                <?php $flag = true; ?>
                
                <?php foreach ($languages as $language) { ?>
					<div id="<?php echo $language['code']; ?>" class="tab-pane fade <?php echo $flag ? 'in active' : ''; ?>">
                       <div class="form-group <?php if(form_error('details[' . $language['code'] . '][shared_title]')) { echo 'validate-has-error'; } ?>">
                            <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );
    
                                echo form_label('Shared Vehical Title: ', 'details[' . $language['code'] . '][shared_title]', $attributes);
                            ?>
                            <div class="col-sm-8">
                                <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][shared_title]',
                                        'placeholder' => 'Please Enter Shared Vehical Title',
                                        'class' => 'form-control',
                                        'value' => set_value('details[' . $language['code'] . '][shared_title]'),
                                        'data-validate' => 'required, minlength[3], maxlength[255]',
                                        'data-message-required' => 'Shared Title required for English atleast'
                                    );
    
                                    echo form_input($attributes);
                                ?>
                                <?php if($language['code'] == 'en') { ?>
                               		<?php if(form_error('details[' . $language['code'] . '][shared_title]')) { ?>
    										<?php echo form_error('details[' . $language['code'] . '][shared_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
    								<?php }?>
                            </div>
                        </div>

                         <div class="form-group <?php if(form_error('details[' . $language['code'] . '][shared_dsc]')) { echo 'validate-has-error'; } ?>">
                            <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );
    
                                echo form_label('Shared Vehical Description: ', 'details[' . $language['code'] . '][shared_dsc]', $attributes);
                            ?>
                            
                            <div class="col-sm-8">
                                <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][shared_dsc]',
                                        'placeholder' => 'Please Enter Shared Vehical Description',
                                        'class' => 'form-control',
                                        'value' => set_value('details[' . $language['code'] . '][shared_dsc]')
                                    );
    
                                    echo form_input($attributes);
    								
                                ?>
								
								<?php if($language['code'] == 'en') { ?>
									<?php if(form_error('details[' . $language['code'] . '][shared_dsc]')) { ?>
										<?php echo form_error('details[' . $language['code'] . '][shared_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        							<?php } ?>
								<?php } ?>
                            </div>
                        </div>
                        
                        <div class="form-group <?php if(form_error('details[' . $language['code'] . '][private_title]')) { echo 'validate-has-error'; } ?>">
                            <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );
    
                                echo form_label('Private Vehical Title: ', 'details[' . $language['code'] . '][private_title]', $attributes);
                            ?>
                            <div class="col-sm-8">
                                <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][private_title]',
                                        'placeholder' => 'Please Enter Private Vehical Title',
                                        'class' => 'form-control',
                                        'value' => set_value('details[' . $language['code'] . '][private_title]')
                                    );
    
                                    echo form_input($attributes);
    								?>
                                <?php if($language['code'] == 'en') { ?>
									<?php if(form_error('details[' . $language['code'] . '][private_title]')) { ?>
										<?php echo form_error('details[' . $language['code'] . '][private_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        							<?php } ?>
								<?php } ?>
                            </div>
                        </div>

                        <div class="form-group <?php if(form_error('details[' . $language['code'] . '][private_dsc]')) { echo 'validate-has-error'; } ?>">
                            <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );
    
                                echo form_label('Private Vehical Description: ', 'details[' . $language['code'] . '][private_dsc]', $attributes);
                            ?>
                            <div class="col-sm-8">
                                <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][private_dsc]',
                                        'placeholder' => 'Please Enter Private Vehical Description',
                                        'class' => 'form-control',
                                        'value' => set_value('details[' . $language['code'] . '][private_dsc]')
                                    );
    
                                    echo form_input($attributes);
                                ?>
                                <?php if($language['code'] == 'en') { ?>
									<?php if(form_error('details[' . $language['code'] . '][private_dsc]')) { ?>
										<?php echo form_error('details[' . $language['code'] . '][private_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        							<?php } ?>
								<?php } ?>
                            </div>
                        </div>
					</div>	
                 	<?php $flag = false; ?>
                <?php } ?>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
    var base_url = "<?php echo base_url(); ?>";

    /* =================================================
     IMAGES UPLOAD AJAX AND APPEND THEM NAME IN FORM
     ==================================================== */

    $('#post_images').change(function (e) {
        e.preventDefault();

        var a = $('#' + $(this).attr('id'));
        var form_data = new FormData();
        var itemId = [];
        var validate;

        $.each($('input[name="images[]"]'), function (i, obj) {
            $.each(obj.files, function (j, file) {
                var ext = file.type;

                switch (ext) {
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'image/png':
                    case 'image/gif':

                        break;
                    default:
                        validate = 0;
                        return false;
                }

                var newClass = 'image-upload-' + j + '-' + $.now();
                a.parent().before('<li class="load new-image ' + newClass + '" id="image_upload_' + j + '"></li>');
                itemId[j] = newClass;
            });
        });

        $.each($('input[name="images[]"]'), function (i, obj) {
            $.each(obj.files, function (j, file) {
                var image_name = 'sportemis-' + $.now();
                var ext = file.name.match(/\.(.+)$/)[1];
                form_data.set('image', file);
                form_data.set('image_name', image_name);
                var element = $('.' + itemId[j]);
                element.removeClass('load');

                if ($('body #temprory_CSS_05698').length == 0) {
                    $('body').prepend('<div id="temprory_CSS_05698"></div>');
                }

                form_data.set($('#_CTN').val(), $('#_CTH').val());
                $.ajax({
                    // New
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                            }
                        }, false);

                        xhr.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                            }
                        }, false);
                        return xhr;
                    },

                    //END
                    url: base_url + 'admin/catalog/transportation/add_image',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response['type'] == 'success') {
                            $('#_CTN').val(response._CTN);
                            $('#_CTH').val(response._CTH);
                            element.prepend('<img src="' + base_url + response.file + '"><i class="entypo-trash trash-icn" onclick="delete_image()"></i>');
                            element.addClass('uploading');
                            element.attr('id', '');
                            element.append('<input type="hidden" name="postimage[]" value="' + response.file + '">');
                            $('.checkbox-row').css('display', 'block');
                        } else {
                            $('#largeimagesmodel').modal('show');
                            element.remove();
                        }
                    }
                })
            });
        });
    });



    /* =================================================
     IMAGE DELETE AJAX AND THEM CONTENT
     ==================================================== */

    function delete_image() {

        $(event.target).parent().addClass('load');
        $.post(base_url + 'admin/catalog/transportation/delete_image', {file: $(event.target).next().val()});
        $(event.target).parent().remove();
        setAsFeature();
    }
</script>


<script>

    function changeImage(element) {
        var id = $(element).attr('id');
        $('#' + id + ' input[type="file"]').trigger('click');
    }


    function clearImage(element) {
        var id = $(element).attr('id');
        $('#' + id + ' label').html('<i class="fa fa-image"></i> Add Image');
        $('#' + id + ' label').css('display', 'table-cell');
        $('#' + id + ' input[type="file"]').val('');
    }

    $(document).ready(function () {

        function imgPreview(inputField) {
            var blockId = $(inputField).parent().attr("id");
            if (inputField.files && inputField.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#' + blockId + ' label').html("<img class='img-responsive' src='#'>");
                    $('#' + blockId + ' label').css('display', 'block');
                    $('#' + blockId + '>div').css('position', 'relative');
                    // $('#'+blockId+'>div').prepend('<span id="removeFile"><i class="fa fa-times"></i></span>');
                    $('#' + blockId + ' label>img').attr('src', e.target.result);
                    var x = $('#' + blockId + ' div.text-center').attr('class');
                    if (x == undefined) {
                        $('#' + blockId).append('<div class="text-center mt-5 mb-10"><a style="margin-right:5px;" onclick="changeImage(' + blockId + ')" class="theme-btn-cancel">Change</a><a onclick="clearImage(' + blockId + ')" class="theme-btn-cancel">Remove</a></div>');
                    }
                }
                reader.readAsDataURL(inputField.files[0]);
            }
        }

        $(document).delegate('.file-preview input[type="file"]', 'change', function () {
            imgPreview(this);
        });

        $('.file-preview label').prepend('<i class="fa fa-image"></i>');
        $(".ggh").prev().prev().remove('i');
    });
</script>

<script>
    $('#post_edit_images').change(function (e) {
        e.preventDefault();
        var a = $('#' + $(this).attr('id'));
        var form_data = new FormData();
        var itemId = [];
        var validate;

        $.each($('input[name="images[]"]'), function (i, obj) {
            $.each(obj.files, function (j, file) {
                var ext = file.type;
                switch (ext) {
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'image/png':
                    case 'image/gif':
                        break;
                    default:
                        flashMessage('This is not an allowed file type');
                        validate = 0;
                        return false;
                }
                var newClass = 'image-upload-' + j + '-' + $.now();
                a.parent().before('<li class="load new-image ' + newClass + '" id="image_upload_' + j + '"></li>');
                itemId[j] = newClass;
            });
        });

        if (validate == 0) {
            return false;
        }

        $.each($('input[name="images[]"]'), function (i, obj) {
            $.each(obj.files, function (j, file) {
                form_data.set('image', file);
                var element = $('.' + itemId[j]);
                element.removeClass('load');

                if ($('body #temprory_CSS_05698').length == 0) {
                    $('body').prepend('<div id="temprory_CSS_05698"></div>');
                }

                form_data.set($('#_CTN').val(), $('#_CTH').val());

                $.ajax({
                    // New
                    xhr: function () {
                        var xhr = new window.XMLHttpRequest();
                        xhr.upload.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                            }
                        }, false);

                        xhr.addEventListener("progress", function (evt) {
                            if (evt.lengthComputable) {
                                var percentComplete = (evt.loaded / evt.total) * 100;
                                $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                            }
                        }, false);
                        return xhr;
                    },

                    // END
                    url: base_url + 'admin/catalog/transportation/add_image',
                    contentType: false,
                    processData: false,
                    data: form_data,
                    type: 'post',
                    success: function (response) {
                        if (response['type'] == 'success') {

                            $('#_CTN').val(response._CTN);
                            $('#_CTH').val(response._CTH);

                            $("#hash_update").attr('name', response._CTN);
                            $("#hash_update").attr('value', response._CTH);

                            element.html('<img src="' + base_url + response.file + '"><i class="entypo-trash trash-icn" onclick="delete_image(event)"></i>');
                            element.addClass('uploaded');
                            element.attr('id', '');
                            element.append('<input type="hidden" name="postimage[]" value="' + response.file + '">');
                            $('#temprory_CSS_05698').html('');
                        } else {
                            element.remove();
                            console.log(response);
                        }

                    }
                })
            });
        });
    });

    function delete_edit_image(e) {
        $(e.target).parent().remove();
    }
</script>

<script>
$(document).ready(function() {
	//$('#fg_city_id').hide();
});


$('#country_id').on('change', function () {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/catalog/transportation/get_cities_by_country_id'); ?>",
        data: {country_id: this.value},
        dataType: "json",
        success: function (res) {
            if (res) {
                $("#city_id").empty();
                $("#city_id").append('<option>--- Select City ---</option>');

                for (var i = 0; i < res.length; i++) {
                    $("#city_id").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                }
            }

            $('#fg_city_id').show();
        }
    });
});
</script>