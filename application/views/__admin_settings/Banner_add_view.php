<div class="row">
	<div class="col-md-12">
    	<?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open_multipart('admin/settings/banner/add', $attributes); 
        ?>
	  		<h2>
        		Add Banner Details ...
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
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/settings/banner'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
	
    		<div class="panel panel-primary">
    			<div class="panel-body">
				
                	<div class="form-group <?php if(form_error('category')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Category: ', 'category', $attributes);
                        ?>
                        
                        <div class="col-sm-5">
                            <?php 	
								
                            $categories = array(''=>'Select Category','home'=>'Home','tour'=>'Tour','deals'=>'Deals','elite'=>'Elite','golf'=>'Golf','restaurant'=>'Restaurant','club_and_bar'=>'Club And Bar','wedding'=>'Wedding','transportation'=>'Transportation');
                            	
                            	$attributes = array(
                            	    'name' => 'category',
                            	    'id' => 'category',
                            	    'placeholder' => 'Please Enter Category',
                            	    'class' => 'form-control',
                            	    'value' => set_value('category'),
                            	    'data-validate' => 'required',
                            	    'data-message-required' => 'Please select category'
                            	);
                            	
                            	echo form_dropdown($attributes,$categories);
                        	?>
                        	
                        	<?php if(form_error('category')) { ?>
            					<?php echo form_error('category', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                        </div>    	
                    </div>
                    <div class="form-group <?php if(form_error('section')) { echo 'validate-has-error'; } ?>">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                    	    
                        	echo form_label('Section: ', 'section', $attributes);
                    	?>
                    	<div class="col-sm-5">
                    		<?php
								$sections = array(''=>'Select Section','main'=>'Main');								
                            	$attributes = array(
                            	    'name' => 'section',
                            	    'id' => 'section',
                            	    'placeholder' => 'Please Enter Section',
                            	    'class' => 'form-control',
                            	    'value' => set_value('section'),
                            	    'data-validate' => 'required',
                            	    'data-message-required' => 'Please select section'
                            	);
                            	
                            	echo form_dropdown($attributes,$sections);
                        	?>
                        	 <span class="description"><b>Tip: Please upload image(1349 x 521 px)</b></span>
                        	<?php if(form_error('section')) { ?>
            					<?php echo form_error('section', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                    	</div>
                    </div>
                    <div class="form-group <?php if(form_error('upload_image')) { echo 'validate-has-error'; } ?>">
                    	<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
				
							echo form_label('Image:', 'upload_image', $attributes);
						?>
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<input type="hidden" value="" name="upload_image_check">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
									<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); ?>
								</div>
								
								<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 100px; line-height: 10px;"></div>
    								<div>
    									<span class="btn btn-white btn-file">
    										<span class="fileinput-new">Select image</span>
    										<span class="fileinput-exists">Change</span>
    										<input type="file" name="upload_image" accept="image/*">
    									</span>
    									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
    								</div>
							</div>
							<br>
							<?php if(form_error('upload_image')) { ?>
            					<?php echo form_error('upload_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
						</div>
                    </div>
                    <div class="form-group <?php if(form_error('title')) { echo 'validate-has-error'; } ?>">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                    	    
                        	echo form_label('Title: ', 'title', $attributes);
                    	?>
                    	<div class="col-sm-5">
                    		<?php
                            	$attributes = array(
                            	    'name' => 'title',
                            	    'id' => 'title',
                            	    'autocomplete' => 'off',
                            	    'onkeyup' => 'lettersOnly(this);',
                            	    'placeholder' => 'Please Enter Title',
                            	    'class' => 'form-control',
                            	    'value' => set_value('title'),
                            	    'data-validate' => 'required, minlength[3], maxlength[255]',
                            	    'data-message-required' => 'Title Name is Required'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	
                        	<?php if(form_error('title')) { ?>
            					<?php echo form_error('title', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                    	</div>
                    </div>
                    <div class="form-group <?php if(form_error('alt')) { echo 'validate-has-error'; } ?>">
                    	<?php
                        	$attributes = array(
                        	    'class' => 'col-sm-3 control-label'
                        	);
                    	    
                        	echo form_label('Alternative Title: ', 'alt', $attributes);
                    	?>
                    	<div class="col-sm-5">
                    		<?php
                            	$attributes = array(
                            	    'name' => 'alt',
                            	    'id' => 'alt',
                            	    'autocomplete' => 'off',
                            	    'onkeyup' => 'lettersOnly(this);',
                            	    'placeholder' => 'Please Enter Image Alternative Title',
                            	    'class' => 'form-control',
                            	    'value' => set_value('alt'),
                            	    'data-validate' => 'maxlength[255]',
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	
                        	<?php if(form_error('alt')) { ?>
            					<?php echo form_error('alt', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                                            'checked' => set_value('status') == 1 ? TRUE : FALSE
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

<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>