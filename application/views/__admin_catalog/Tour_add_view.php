<div class="row">
	<div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate',
                'id' => 'myform'
            );
    
            echo form_open('admin/catalog/tour/add', $attributes);
        ?>
            <!-- CSRF NAME -->
        	<?php
                $attributes = array(
                    'type' => 'hidden',
                    'id' => '_CTN',
                    'name' => '_CTN',
                    'value' => $this->security->get_csrf_token_name()
                );
        
                echo form_input($attributes);
            ?>
            <?php
                $attributes = array(
                    'type' => 'hidden',
                    'id' => '_CTH',
                    'name' => '_CTH',
                    'value' => $this->security->get_csrf_hash()
                );
                
                echo form_input($attributes);
            ?>

        	<input type="hidden" id="hash_update" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
            <!-- END OF CSRF  -->
        	
        	<h2>
            	Add Tour Details
            	<span class="pull-right btn-toolbar">
                    <?php
                        $attributes = array(
                            'name' => 'add',
                            'id' => 'add',
                            'value' => 'Add',
                            'type' => 'submit',
                            'content' => '<i class="entypo-plus"></i> Add',
                            'class' => 'btn btn-blue btn-icon icon-left',
							'onClick' => 'return validate();'
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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/catalog/tour'); ?>">
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
        
                            echo form_label('Is Elite Tour: ', 'is_elite', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <div class="bs-example">
                                <div class="make-switch has-switch" data-on-label="Yes" data-off-label="No">
                                    <?php
                                        $data = array(
                                            'name' => 'is_elite',
                                            'id' => 'is_elite',
                                            'value' => '1',
                                            'checked' => FALSE
                                        );
        
                                        echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                	</div>
					<div class="form-group <?php if(form_error('slug')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Slug(Seo URL): ', 'slug', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'slug',
                                    'placeholder' => 'Please Enter Slug(Seo URL) e.g. tour-name',
                                    'class' => 'form-control',
                                    'value' => set_value('slug'),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => ' Slug( SEO URL ) is Required.'
                                );
        
                                echo form_input($attributes);
                            ?>
                            <span class="description">Tip: Use only small alphanumerics letters and underscore(-) to form slug(seo url)</span>
                            
                            <?php if(form_error('slug')) { ?>
    							<?php echo form_error('slug', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                                'class' => 'form-control',
                                'id' => 'country',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select country'
                            );
                    
                            echo form_dropdown($attributes, $countries);
                        ?>
                    	<?php if(form_error('country_id')) { ?>
                    		<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    	<?php } ?>
                    	</div>
                    </div>
                    <div class="form-group <?php if(form_error('city_id')) { echo 'validate-has-error'; } ?>">
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
                                'class' => 'form-control',
                                'id' => 'city',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select city'
                            );
                    
                            echo form_dropdown($attributes, $cities);
                        ?>
                        <?php if(form_error('country_id')) { ?>
                    		<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    	<?php } ?>
                        </div>
                    </div>

                 	<div class="form-group <?php if(form_error('agent_id')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Agent: ', 'agent_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'agent_id',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Please select agent'
                                );
                                echo form_dropdown($attributes, $agents);
                            ?>
                            <?php if(form_error('agent_id')) { ?>
        						<?php echo form_error('agent_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
                        </div>
                	</div>
                   <div class="form-group <?php if(form_error('agent_cost')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Agent Cost: ', 'agent_cost', $attributes);
                        ?>
                       <div class="col-sm-8">
                          <div class="input-group">
    							<span class="input-group-addon">$</span>
                                <?php
                                    $attributes = array(
                                        'name' => 'agent_cost',
                                        'type' => 'number',
                                        'class' => 'form-control',
                                        'placeholder' => 'Please Enter Agent Cost',
                                        'value' => set_value('agent_cost'),
                                        'data-validate' => 'required, maxlength[19]',
                                        'data-message-required' => ' Agent Cost cannot leave blank',
                                       
                                    );
            
                                    echo form_input($attributes);
                                    ?>
    							<span class="input-group-addon">USD</span>
        					</div>
        					    <?php if(form_error('agent_cost')) { ?>
                						<?php echo form_error('agent_cost', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                					<?php } ?>
                    	</div>
    				</div>

                   	<div class="form-group <?php if(form_error('adult_price')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Adult Price: ', 'adult_price', $attributes);
                        ?>
                        <div class="col-sm-8">
                           <div class="input-group">
    							<span class="input-group-addon">$</span>
                                <?php
                                    $attributes = array(
                                        'name' => 'adult_price',
                                        'id' => 'adult_price',
                                        'placeholder' => 'Please Enter Adult Price',
                                        'class' => 'form-control',
                                        'data-validate' => 'required,maxlength[19]',
                                        'data-message-required' => ' Adult Price cannot leave blank',
                                        'value' => set_value('adult_price'),
                                        'type' => 'number'
                                    );
            
                                    echo form_input($attributes);
                                ?>
        						<span class="input-group-addon">USD</span>
    				    	</div>
    						<?php if(form_error('adult_price')) { ?>
        						<?php echo form_error('adult_price', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
						</div>
					</div>
                
                
                	<div class="form-group <?php if(form_error('adult_deal_price')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Adult Deal Price: ', 'adult_deal_price', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<div class="input-group">
    							<span class="input-group-addon">$</span>
                                <?php
                                    $attributes = array(
                                        'name' => 'adult_deal_price',
                                        'id' => 'adult_deal_price',
                                        'placeholder' => 'Please Enter Adult Deal Price',
                                        'class' => 'form-control',
                                        'data-validate' => 'maxlength[19]',
                                        'value' => set_value('adult_deal_price'),
                                        'type' => 'number',
                                    );
            
                                    echo form_input($attributes);
                                    ?>
                           		<span class="input-group-addon">USD</span>
    				    	</div>
    				    	
    				    	 <?php if(form_error('adult_deal_price')) { ?>
        						<?php echo form_error('adult_deal_price', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
        					<span id="adult_price_error" class="validate-has-error"></span>
    					</div>
					</div>
        			<div class="form-group <?php if(form_error('child_price')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Child Price: ', 'child_price', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<div class="input-group">
        						<span class="input-group-addon">$</span>
                                    <?php
                                        $attributes = array(
                                            'name' => 'child_price',
                                            'id' => 'child_price',
                                            'type' => 'number',
                                            'data-validate' => 'maxlength[19]',
                                            'placeholder' => 'Please Enter Child Price',
                                            'class' => 'form-control',
                                            'value' => set_value('child_price'),
                                           
                                        );
                
                                        echo form_input($attributes);
                                    ?>
                            		<span class="input-group-addon">USD</span>
        			     	 </div>
        			    		<?php if(form_error('child_price')) { ?>
            						<?php echo form_error('child_price', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            					<?php } ?>
                        </div>
                    </div>
        			<div class="form-group <?php if(form_error('child_deal_price')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Child Deal Price: ', 'child_deal_price', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<div class="input-group">
        						<span class="input-group-addon">$</span>
                                <?php
                                    $attributes = array(
                                        'name' => 'child_deal_price',
                                        'id' => 'child_deal_price',
                                        'type' => 'number',
                                        'placeholder' => 'Please Enter Child Deal Price',
                                        'class' => 'form-control',
                                        'value' => set_value('child_deal_price'),
                                        'data-validate' => 'maxlength[19]',
                                    );
                                    echo form_input($attributes);
                                ?>
                                <span class="input-group-addon">USD</span>
        				    </div>
        				    <?php if(form_error('child_deal_price')) { ?>
        						<?php echo form_error('child_deal_price', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
            				<span id="child_price_error" class="validate-has-error"></span>
                       </div>
                    </div>
                    
        			<div class="form-group <?php if(form_error('min_child_age')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Minimum Child Age : ', 'min_child_age', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'min_child_age',
                                    'type' => 'number',
                                    'id'    => 'min_child_age',
        							'placeholder' => ' Enter Minimum Child Age',
                                    'class' => 'form-control',
                                    'value' => set_value('min_child_age'),
                                    'data-validate' => 'maxlength[2]',
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('min_child_age')) { ?>
        						<?php echo form_error('min_child_age', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
        					 <span id="min_child_age_error" class="validate-has-error"></span>
                        </div>
                    </div>
        			<div class="form-group <?php if(form_error('max_child_age')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            echo form_label('Maximum Child Age : ', 'max_child_age', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'max_child_age',
                                    'id'    => 'max_child_age',
        							'placeholder' => 'Enter  Maximum Child Age',
                                    'class' => 'form-control',
                                    'value' => set_value('max_child_age'),
                                    'type' => 'number',
                                    'data-validate' => 'maxlength[2]|range: [1, 16]',
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('max_child_age')) { ?>
                            	<?php echo form_error('max_child_age', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                            <?php } ?>
                            <span id="max_child_age_error" class="validate-has-error"></span>
                        </div>
                    </div>
        			<div class="form-group <?php if(form_error('tour_category_id')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Category : ', 'tour_category_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'tour_category_id',
                                    'class' => 'form-control ckeditor',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Please select category'
                                    
                                );
                                echo form_dropdown($attributes, $categories);
                            ?>
                            <?php if(form_error('tour_category_id')) { ?>
                				<?php echo form_error('tour_category_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>
                    
                    <!-- TOUR BLOCK -->
        			<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet" />
        			<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" rel="stylesheet" />
                    
                    <div class="form-group <?php if(form_error('tour_avalability')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
            
                            echo form_label('Block Dates: ', 'tour_avalability', $attributes);
                        ?>
                        <div class="col-sm-8">
        					<input class="form-control" name="block_tour_dates" id="mdp-demo" />
                       		<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
        					<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
                       		
                       		<script type="text/javascript">
                       			$('#mdp-demo').multiDatesPicker({
                       				dateFormat: 'dd-mm-yy'
                       			});
                       		</script>
                       		
                       		<?php if(form_error('tour_avalability')) { ?>
                				<?php echo form_error('tour_avalability', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>
                    <!-- END TOUR BLOCK -->
                        
        			<div class="form-group <?php if(form_error('postimage[0]')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
        				         'name'	=>'image',
                                'class' => 'col-sm-3 control-label'
                               
                            );
        
                            echo form_label('Images: ', 'image', $attributes);
                        ?>
        
                        <div class="col-sm-8">
                            <!-- Check Missing Text File in Root -->
        					<div class="file-box news-feed-upload-image" id="image-section" data-username="<?php echo strtolower(str_replace(' ', '-', $this->session->userdata('username'))); ?>">
        						<ul class="rm list-inline rp">
                                    <?php if (isset($postimage) && !empty($postimage)) { ?>
                                        <?php foreach($postimage as $image) { ?>
                                            <li class="new-image uploaded">
                                                <img src="<?php echo base_url($image); ?>">
                                                <i class="entypo-trash trash-icn" onclick="delete_edit_image(event)"></i>
                                                <input type="hidden" name="postimage[]"  value="<?php echo $image; ?>" data-validate ="required" data-message-required = "Please upload atleast one image">
                                            </li>
                                        <?php } ?>
                                    <?php } ?>
        
                                    <li id="add-image-box">
                                        <label for="post_edit_images" style="height:100px">
                                            <i class="entypo-plus"></i> Add Image
                                        </label>
                                        <input type="file" multiple class="form-control" id="post_edit_images" name="images[]" accept="image/x-png,image/gif,image/jpeg" data-validate ="required" data-message-required = "Please upload atleast one image">
                                    </li>
                                </ul>
                            </div>
        					<?php if(form_error('postimage[0]')) { ?>
            					<?php echo form_error('postimage[0]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>
        			<div class="form-group <?php if(form_error('sort_order')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Sort order: ', 'sort_order', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $data = array(
                                    'name' => 'sort_order',
                                    'placeholder' => 'Please Enter Sort order',
                                    'class' => 'form-control',
                                    'type'  =>  'number',
                                );
        
                                echo form_input($data);
                            ?>
                            <?php if(form_error('sort_order')) { ?>
            					<?php echo form_error('sort_order', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                    
                    
                    <div class="lang-tabs">
                        <ul class="nav nav-tabs">
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
                    </div>
            		<div class="tab-content">
                		<?php $flag = true; ?>
                
                		<?php foreach ($languages as $language) { ?>
							<div id="<?php echo $language['code']; ?>" class="tab-pane fade <?php echo $flag ? 'in active' : ''; ?>">
        						<div class="form-group <?php if(form_error('details[' . $language['code'] . '][title]')) { echo 'validate-has-error'; } ?>">
                                    <?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
        
                                        echo form_label('Title: ', 'title', $attributes);
                                    ?>
                                    <div class="col-sm-8">
                                    	<?php if($language['code'] == 'en') { ?>
                                            <?php
                                                $attributes = array(
                                                    'name' => 'details[' . $language['code'] . '][title]',
                                                    'placeholder' => 'Please Enter Title',
                                                    'class' => 'form-control',
                                                    'value' => set_value('details[' . $language['code'] . '][title]'),
                                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                                    'data-message-required' => 'Title Name required for English atleast.'
                                                );
                                                
                                                echo form_input($attributes);
                                            ?>
        								
        								<?php } else { ?>
        									<?php
                                                $attributes = array(
                                                    'name' => 'details[' . $language['code'] . '][title]',
                                                    'placeholder' => 'Please Enter Title',
                                                    'class' => 'form-control',
                                                    'value' => set_value('details[' . $language['code'] . '][title]')
                                                );
                                                
                                                echo form_input($attributes);
                                            ?>
        								<?php } ?>
        								
        								<?php if(form_error('details[' . $language['code'] . '][title]')) { ?>
    										<?php echo form_error('details[' . $language['code'] . '][title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
    									<?php } ?>
                                    </div>
                                </div>
        
        						<div class="form-group <?php if(form_error('details[' . $language['code'] . '][dsc]')) { echo 'validate-has-error'; } ?>">
        							<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
        
                                        echo form_label('Description: ', 'dsc', $attributes);
                                    ?>
                                    <div class="col-sm-8">
                                        <?php
                                            $attributes = array(
                                                'name' => 'details[' . $language['code'] . '][dsc]',
                                                'placeholder' => 'Please Enter Description',
                                                'class' => 'form-control',
                                                'value' => set_value('details[' . $language['code'] . '][dsc]'),
                                                'data-validate' => 'required,minlength[80]',
                                                'data-message-required' => 'Description is Required.'
                                            );
            
                                            echo form_textarea($attributes);
                                        ?>
        								<?php if(form_error('details[' . $language['code'] . '][dsc]')) { ?>
        									<?php echo form_error('details[' . $language['code'] . '][dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        								<?php } ?>	
        							</div>
        						</div>
        						<div class="form-group <?php if(form_error('details[en][tags]')) { echo 'validate-has-error'; } ?>">
                                    <?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
            
                                        echo form_label('Tags:', 'tags', $attributes);
                                    ?>
        
                                    <div class="col-sm-8">
                                        <?php
                                            $attributes = array(
                                                'name' => 'details[' . $language['code'] . '][tags]',
                                                'placeholder' => 'Please Enter Meta Tags',
                                                'class' => 'form-control',
                                                'value' => set_value('details[' . $language['code'] . '][tags]'),
                                                'data-validate' => "maxlength[255]"
                                            );
            
                                            echo form_input($attributes);
                                        ?>
        								<?php if(form_error('details[' . $language['code'] . '][tags]')) { ?>
                    						<?php echo form_error('details[' . $language['code'] . '][tags]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    					<?php } ?>
                                    </div>
                                </div>
                                <div class="form-group <?php if(form_error('details[en][meta_title]')) { echo 'validate-has-error'; } ?>">
                                    <?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
            
                                        echo form_label('Meta Title:', 'meta_title', $attributes);
                                    ?>
        
                                    <div class="col-sm-8">
                                        <?php
                                            $attributes = array(
                                                'name' => 'details[' . $language['code'] . '][meta_title]',
                                                'placeholder' => 'Please Enter Meta Title',
                                                'class' => 'form-control',
                                                'data-validate' => "maxlength[255]",
                                                'value' => set_value('details[' . $language['code'] . '][meta_title]')
                                            );
            
                                            echo form_input($attributes);
                                        ?>
                                        <?php if(form_error('details[' . $language['code'] . '][meta_title]')) { ?>
                    						<?php echo form_error('details[' . $language['code'] . '][meta_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    					<?php } ?>
                                    </div>
                                </div>
                                <div class="form-group <?php if(form_error('details[en][meta_dsc]')) { echo 'validate-has-error'; } ?>">
                                    <?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
            
                                        echo form_label('Meta Description:', 'meta_dsc', $attributes);
                                    ?>
        
                                    <div class="col-sm-8">
                                        <?php
                                            $attributes = array(
                                                'name' => 'details[' . $language['code'] . '][meta_dsc]',
                                                'placeholder' => 'Please Enter Meta Description',
                                                'class' => 'form-control',
                                                'data-validate' => "maxlength[255]",
                                                'value' => set_value('details[' . $language['code'] . '][meta_dsc]')
                                            );
        
                                            echo form_textarea($attributes);
                                        ?>
                                        <?php if(form_error('details[' . $language['code'] . '][meta_dsc]')) { ?>
                    						<?php echo form_error('details[' . $language['code'] . '][meta_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    					<?php } ?>
                                    </div>
                                </div>
                                <div class="form-group <?php if(form_error('details[en][meta_keywords]')) { echo 'validate-has-error'; } ?>">
                                    <?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
            
                                        echo form_label('Meta Keywords:', 'meta_keywords', $attributes);
                                    ?>
                                    <div class="col-sm-8">
                                        <?php
                                            $attributes = array(
                                                'name' => 'details[' . $language['code'] . '][meta_keywords]',
                                                'class' => 'form-control',
                                                'placeholder' => 'Please Enter Meta Keywords',
                                                'value' => set_value('details[' . $language['code'] . '][meta_keywords]'),
                                                'data-validate' => "maxlength[255]"
                                            );
            
                                            echo form_input($attributes);
                                        ?>
                                        <?php if(form_error('details[' . $language['code'] . '][meta_keywords]')) { ?>
                    						<?php echo form_error('details[' . $language['code'] . '][meta_keywords]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    					<?php } ?>
                                    </div>
								</div>
                    		</div>
                    		<?php $flag = false; ?>
                		<?php } ?>
            		</div>
        		</div>
    		</div>
   		<?php echo form_close(); ?>
	</div>
</div>

<script>

var base_url = "<?php echo base_url(); ?>";

/* =================================================
 		IMAGE DELETE AJAX AND THEM CONTENT
 ==================================================== */

/* function delete_image() {
    $.post(base_url + 'admin/catalog/tour/delete_image', {file: $(event.target).next().val()});
    $(event.target).parent().remove();
} */
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

</script>

<script>
$('#post_edit_images').change(function (e) {
	e.preventDefault();
	var count = $('input[name="postimage[]"]').length;

    var a = $('#' + $(this).attr('id'));
    var form_data = new FormData();
    var itemId = [];
    var validate = 1;

    $.each($('input[name="images[]"]'), function (i, obj) {
		if(count + (obj.files.length) <= 6) {
			
			if(count + (obj.files.length) == 6) {
				$('#add-image-box').hide();
			}
			
            $.each(obj.files, function (j, file) {
            	if(file.size >= 3000000) {
					imageErrorFunc('Please Upload Image Less Than 3MB.');
					count--;
					validate = 0; 
					return false;
            	}
                
                var ext = file.type;
                switch (ext) {
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'image/png':
                    case 'image/gif':
                        break;
                    default:
                    	imageErrorFunc('This is not an allowed file type');
                    	count--;
                        validate = 0;
                        return false;
                }

                var newClass = 'image-upload-' + $.now() + '-' + j;

                a.parent().before('<li class="load new-image ' + newClass + '" id="image_upload_' + j + '"></li>');
                itemId[j] = newClass;
            });

            count++;
            
		} else { 
			imageErrorFunc("Maximum 6 Images can be uploaded");
			return false;
		}
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
                url: base_url + 'admin/catalog/tour/add_image',
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

                        element.html('<img src="' + base_url + response.file + '"><i class="entypo-trash trash-icn" onclick="delete_edit_image(event)"></i>');
                        element.addClass('uploaded');
                        element.attr('id', '');
                        element.append('<input type="hidden" name="postimage[]" value="' + response.file + '">');
                        $('#temprory_CSS_05698').html('');
                    } else {

                    	$('#_CTN').val(response._CTN);
                        $('#_CTH').val(response._CTH);

                        $("#hash_update").attr('name', response._CTN);
                        $("#hash_update").attr('value', response._CTH);

                        imageErrorFunc(response['text']);

                        element.remove();
                        count--;
                        console.log(response);
                    }
                }
            })
        });
    });
});

function delete_edit_image(e) {
	$('#add-image-box').show();
	var form_data = {file: $(e.target).next().val()};
	form_data[$('#_CTN').val()] = $('#_CTH').val();
	
	$.post(base_url + 'admin/catalog/tour/delete_image', form_data, function(response) {

		if (response['type'] == 'success') {
    		$('#_CTN').val(response._CTN);
            $('#_CTH').val(response._CTH);
    
            $("#hash_update").attr('name', response._CTN);
            $("#hash_update").attr('value', response._CTH);
    
            imageSuccessFunc(response['text']);
		} else {
			$('#_CTN').val(response._CTN);
            $('#_CTH').val(response._CTH);
    
            $("#hash_update").attr('name', response._CTN);
            $("#hash_update").attr('value', response._CTH);
    
            //imageErrorFunc(response['text']);
		}
	});
	
    $(e.target).parent().remove();
}

$('#country').on('change', function () {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/catalog/tour/get_cities_by_country_id'); ?>",
        data: {country_id: this.value},
        dataType: "json",
        success: function (res) {
            if (res) {
                $("#city").empty();
                $("#city").append('<option>--- Select City ---</option>');

                for (var i = 0; i < res.length; i++) {
                    $("#city").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                }
            }
        }
    });
});

function validate() {
	var adult_price = parseFloat($("#adult_price").val());
	var adult_deal_price = parseFloat($("#adult_deal_price").val());
	var child_price = parseFloat($("#child_price").val());
	var child_deal_price = parseFloat($("#child_deal_price").val());
	var min_child_age = parseInt($("#min_child_age").val());
	var max_child_age = parseInt($("#max_child_age").val());

	if(adult_deal_price != '' && adult_price <= adult_deal_price) {
		$("#adult_price_error").html('Deal price should be less than Main price');
		return false;
	} else {
		$("#adult_price_error").html('');
	}
	
	if(child_deal_price != '' && child_price <= child_deal_price) {
		$("#child_price_error").html('Deal price should be less than Main price');
		return false;
	} else {
		$("#child_price_error").html('');
	}
	
	if(min_child_age != '' && min_child_age >= max_child_age) {
		$("#max_child_age_error").html('Min Child Age should be less than Max Child Age');
		return false;
	} else {
		$("#max_child_age_error").html('');
	}
	
	if(min_child_age >= 1 && min_child_age <=16) {
		$("#min_child_age_error").html('Min Child Age should be 1-16 Yrs');
		return false;
	} else {
		$("#min_child_age_error").html('');
	}
	
	if(max_child_age <= 16) {
		$("#max_child_age_error").html('Max Child Age should be less than 16 Yrs');
		return false;
		
	} else {
		$("#max_child_age_error").html('');
	}
}
</script>
