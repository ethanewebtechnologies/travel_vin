<div class="row">
	<div class="col-md-12">
	
	<?php 
		  $attributes = array(
		      'class' => 'form-horizontal form-groups-bordered'
		  );
		  
		  echo form_open('admin/settings/language/edit?secure_token=' . $this->security_lib->encrypt($language['id']), $attributes); 
		?>
			<h2>
        		Edit Language Details
				
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
                            	    'class' => 'form-control',
									'value' => $language['name']
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
                            	    'class' => 'form-control',
									'value' => $language['code']
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