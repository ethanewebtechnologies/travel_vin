<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
             
            echo form_open('admin/settings/home-page', $attributes); 
        ?>
        	<h2>
        		Edit Home Page Settings 
                <span class="pull-right btn-toolbar">
					<?php
                        $attributes = array(
                            'name'          => 'save',
                            'id'            => 'save',
                            'value'         => 'save',
                            'type'          => 'submit',
                            'content'       => '<i class="entypo-check"></i> save',
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
                	
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/default/dashboard'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
			<div class="panel panel-primary" data-collapsed="0">
				<div class="panel-body" style="display: block;">
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
        						<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][main_title]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Main Title: ', 'config[home][details_' . $language['code'] . '][main_title]', $attributes);
                                    ?>
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][main_title]',
                							    'id' => 'config-home-details_' . $language['code'] . '-main_title',
                							    'placeholder' => 'Please Enter Main Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_'.$language['code']]['main_title']) ? set_value('config[home][details_' . $language['code'] . '][main_title]', $configurations['home']['details_' . $language['code']]['main_title']) : set_value('config[home][details_' . $language['code'] . '][main_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							<span class="description">It will be show as a Home Page Banner Main Title</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][main_title]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][main_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][sub_title]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Sub Title: ', 'config[home][details_' . $language['code'] . '][sub_title]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][sub_title]',
                							    'id' => 'config-home-details_' . $language['code'] . '-sub_title',
                							    'placeholder' => 'Please Enter Sub Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_'.$language['code']]['sub_title']) ? set_value('config[home][details_' . $language['code'] . '][sub_title]', $configurations['home']['details_' . $language['code']]['sub_title']) : set_value('config[home][details_' . $language['code'] . '][sub_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<span class="description">It will be show as a Home Page Banner Sub Title</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][sub_title]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][sub_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][boxed_title]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Boxed Title: ', 'config[home][details_' . $language['code'] . '][boxed_title]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][boxed_title]',
                							    'id' => 'config-home-details_' . $language['code'] . '-boxed_title',
                							    'placeholder' => 'Please Enter Boxed Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_'.$language['code']]['boxed_title']) ? set_value('config[home][details_' . $language['code'] . '][boxed_title]', $configurations['home']['details_' . $language['code']]['boxed_title']) : set_value('config[home][details_' . $language['code'] . '][boxed_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<span class="description">It will be show as a Home Page Banner Boxed Title</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][boxed_title]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][boxed_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            					<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][boxed_title]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Video URL: ', 'config[home][details_' . $language['code'] . '][video_url]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][video_url]',
                							    'id' => 'config-home-details_' . $language['code'] . '-video_url',
                							    'placeholder' => 'Please Enter Video Url',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_'.$language['code']]['video_url']) ? set_value('config[home][details_' . $language['code'] . '][video_url]', $configurations['home']['details_' . $language['code']]['video_url']) : set_value('config[home][details_' . $language['code'] . '][video_url]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<span class="description">It will be show on Home Page</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][video_url]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][video_url]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][dsc]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Description: ', 'config[home][details_' . $language['code'] . '][dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][dsc]',
                							    'id' => 'config-home-details_' . $language['code'] . '-dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_' . $language['code']]['dsc']) ? set_value('config[home][details_' . $language['code'] . '][dsc]', $configurations['home']['details_' . $language['code']]['dsc']) : set_value('config[home][details_' . $language['code'] . '][dsc]', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							
            							<span class="description">It will be show as a Home Page Description</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][dsc]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
								
								<div class="form-group <?php if(form_error('config[home][details_' . $language['code'] . '][banner_dsc]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Banner Description: ', 'config[home][details_' . $language['code'] . '][banner_dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[home][details_' . $language['code'] . '][banner_dsc]',
                							    'id' => 'config-home-details_' . $language['code'] . '-banner_dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['home']['details_' . $language['code']]['banner_dsc']) ? set_value('config[home][details_' . $language['code'] . '][banner_dsc]', $configurations['home']['details_' . $language['code']]['banner_dsc']) : set_value('config[home][details_' . $language['code'] . '][banner_dsc]', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							
            							<span class="description">It will be show as a Home Page Banner Description</span>
            							
            							<?php if(form_error('config[home][details_' . $language['code'] . '][banner_dsc]')) { ?>
            								<?php echo form_error('config[home][details_' . $language['code'] . '][banner_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
