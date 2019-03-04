<div class="row">
	<div class="col-md-12">
    	<?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered'
            );
            
            echo form_open('admin/settings/restricted-zone/add', $attributes); 
        ?>
	  		<h2>
        		Add Restricted Zone Details ...
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
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/settings/language'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
	
    		<div class="panel panel-primary">
    			<div class="panel-body">
				
                	<div class="form-group">
                    	<?php
                    	
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Name: ', 'name', $attributes);
                        ?>
                        
                        <div class="col-sm-5">
                            <?php 	
                            	
                            	$attributes = array(
                            	    'name' => 'name',
                            	    'placeholder' => 'Please Enter Language Name',
                            	    'class' => 'form-control'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        </div>    	
                    </div>
                    <div class="form-group">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                    	    
                        	echo form_label('Language Code: ', 'code', $attributes);
                    	?>
                    	<div class="col-sm-5">
                    		<?php
                            	$attributes = array(
                            	    'name' => 'code',
                            	    'placeholder' => 'Please Enter Language Code',
                            	    'class' => 'form-control'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                    	</div>
                    </div>
					
				<?php echo form_close(); ?>
			</div>
		</div>
	</div>
</div>