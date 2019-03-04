<style>
    .d2o {
        width: 100%;
        height: 100px;
        overflow-y: scroll;
        border-left: 2px;
        border-top: 2px;
        border-bottom: 2px;
        border-color: #F1F1F1;
        border-style: solid;
        padding: 0px;
    }
    
    .d2o .c2o {
        margin-left: 5px;
        padding: 0px;
        display: block;
        padding-top: 5px;
        border-bottom: 1px dashed #ccc;
    }
</style>

<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
            
            echo form_open('admin/users/users/edit?secure_token=' . $this->security_lib->encrypt($userdata['id']), $attributes); 
		?>
            <h2>
        		<?php echo $text_h3_edit_heading; ?>
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
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/users/users'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>			

			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="form-group <?php if(form_error('user_group_id')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('User Group: ', 'user_group_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php 
                            	$attributes = array(
                            	    'name' => 'user_group_id',
                            	    'class' => 'form-control'
                            	);
                            	
                            	echo form_dropdown($attributes, $user_groups, set_value('user_group_id', $userdata['user_group_id']));
                        	?>
                        	<?php if(form_error('user_group_id')) { ?>
            					<?php echo form_error('user_group_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
					</div>
        			<div class="form-group <?php if(form_error('fname')) { echo 'validate-has-error'; } ?>">
        				<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
							
							echo form_label($text_add_ufname, 'fname', $attributes);
						?>
        			
        				<div class="col-sm-8">
        					<?php 
            					$attributes = array(
            					    'name' => 'fname',
            					    'placeholder' => $text_add_puname,
            					    'class' => 'form-control',
            					    'value'=> set_value('fname', $userdata['firstname'])
            					);
            					
            					echo form_input($attributes);
							?>
							
							<?php if(form_error('fname')) { ?>
								<?php echo form_error('fname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?>
        				</div>
        			</div>
            		<div class="form-group <?php if(form_error('lname')) { echo 'validate-has-error'; } ?>">  
            			<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
							
							echo form_label($text_add_ulname, 'lname', $attributes);
						?>
						<div class="col-sm-8">
                    		<?php 
                                $attributes = array(
                                    'name' => 'lname',
                                    'placeholder' => $text_add_plname,
                                    'class' => 'form-control',
                					'value'=> set_value('lname', $userdata['lastname'])
                                ); 
                                
                				echo form_input($attributes);	
        				    ?>
        				    <?php if(form_error('lname')) { ?>
								<?php echo form_error('lname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?>
        				</div> 
 					</div>
        			<div class="form-group <?php if(form_error('email')) { echo 'validate-has-error'; } ?>">   
        				<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
							
							echo form_label($text_add_uemail, 'email', $attributes);
						?>
						<div class="col-sm-8">
							<?php 			
                                $attributes = array(
                                    'name' => 'email',
                                    'type' => 'email',
                                    'placeholder' => $text_add_pemail,
                                    'class' => 'form-control',
                					'value'=> set_value('email', $userdata['email'])
                                ); 
                				
                                echo form_input($attributes);
                			?>
                			<?php if(form_error('email')) { ?>
								<?php echo form_error('email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?>
							
							<?php echo form_hidden('current_user_email', $userdata['email']); ?>
						</div>
         			</div>
         			<div class="form-group">
         				<?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Permission', '', $attributes);
         				?>
         				<div class="col-sm-8">
							<div class="d2o">
								<?php foreach ($restricted_zones as $restricted_zone) { ?>
    								<div class="checkbox checkbox-replace c2o">
										<label class="cb-wrapper">
											<?php if(in_array($restricted_zone['id'], $user_permissions)) { ?>
												<input type="checkbox" name="restrictions[]" value="<?php echo $restricted_zone['id']; ?>" checked>
											<?php } else { ?>
												<input type="checkbox" name="restrictions[]" value="<?php echo $restricted_zone['id']; ?>">
											<?php } ?>
    									</label>
										<label><?php echo sanatize_controller_name($restricted_zone['controller_name']) . ' <i class="entypo-right-open"></i> ' . sanatize_method_name($restricted_zone['method_name']); ?></label>
									</div>
								<?php } ?>
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
                                <div class="make-switch switch-small has-switch" data-on="primary" data-off="info" data-on-label="&nbsp;&nbsp;Enable&nbsp;&nbsp;" data-off-label="&nbsp;&nbsp;Disable&nbsp;&nbsp;">
                                    <?php
                                        $data = array(
                                            'name' => 'status',
                                            'id' => 'status',
                                            'value' => '1',
                                            'checked' => $userdata['status'] == '1' ? TRUE : FALSE
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
