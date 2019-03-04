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
                'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open('admin/users/user-group/edit?secure_token=' . $this->security_lib->encrypt($user_group['id']), $attributes);
        ?>
            <h2>
                Edit User Group Details
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
                            'name' => 'reset',
                            'id' => 'reset',
                            'value' => 'Reset',
                            'type' => 'reset',
                            'content' => '<i class="entypo-ccw"></i> Reset',
                            'class' => 'btn btn-orange btn-icon icon-left'
                        );
        
                        echo form_button($attributes);
                    ?>
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/users/user-group'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </span>
            </h2>
        	<div class="panel panel-primary">
            	<div class="panel-body">
                    <div class="form-group <?php if(form_error('group_name')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Group name: ', 'group_name', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'group_name',
                                    'placeholder' => 'Please Enter Group name',
                                    'class' => 'form-control',
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'value' => set_value('group_name', $user_group['gp_name'])
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('group_name')) { ?>
            					<?php echo form_error('group_name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                                            'checked' => $user_group['status'] == '1' ? TRUE : FALSE
                                        );
        
                                        echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
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
            	</div>
        	</div>
        <?php echo form_close(); ?>
    </div>
</div>
