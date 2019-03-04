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
            
            echo form_open('admin/users/users/add', $attributes); 
		?>
            <h2>
        		<?php echo $text_h3_add_heading; ?> 
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
                            	    'class' => 'form-control',
                            	    'onchange' => 'changeUserGroup(this.value);'
                            	);
                            	
                            	echo form_dropdown($attributes, $user_groups, set_value('user_group_id'));
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
        
                            echo form_label('First Name: ', 'fname', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php 
                            	$attributes = array(
                            	    'name' => 'fname',
                            	    'placeholder' => $text_add_puname,
                            	    'class' => 'form-control',
                            	    'value' => set_value('fname')
                            	    
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
        
                            echo form_label('Last Name: ', 'lname', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php 
                            	$attributes = array(
                            	    'name' => 'lname',
                            	    'placeholder' => $text_add_puname,
                            	    'class' => 'form-control',
                            	    'value' => set_value('lname')
                            	    
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
                            	    'value' => set_value('email')
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	<?php if(form_error('email')) { ?>
            					<?php echo form_error('email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                                <div class="make-switch switch-small has-switch" data-on="primary" data-off="info" data-on-label="&nbsp;&nbsp;Enable&nbsp;&nbsp;" data-off-label="&nbsp;&nbsp;Disable&nbsp;&nbsp;">
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
					
					<div class="form-group">
         				<?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Permission', '', $attributes);
         				?>
         				<div class="col-sm-8">
							<div class="d2o" id="d2o">
								
							</div>
                        </div>
         			</div>
				</div>
			</div>
		<?php echo form_close(); ?>
	</div>
</div>


<script>
var changeUserGroup = function(user_group_id) {
	$.ajax({
		url: "<?php echo base_url('admin/users/users/user_permission_load'); ?>",
		data: {user_group_id: user_group_id},
		method: 'get',
		success: function(response) {
			$('#d2o').html(response);
		}
	});
}

$(document).ready(function() {
	changeUserGroup(1);
});
</script>

