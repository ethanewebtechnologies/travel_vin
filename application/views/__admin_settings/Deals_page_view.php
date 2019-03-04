<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
             
            echo form_open('admin/settings/deals-page', $attributes); 
        ?>
        	<h2>
        		Edit Deals Page Settings 
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
        						<div class="form-group <?php if(form_error('config[deals][details_' . $language['code'] . '][main_title]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Main Title: ', 'config[deals][details_' . $language['code'] . '][main_title]', $attributes);
                                    ?>
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[deals][details_' . $language['code'] . '][main_title]',
                							    'id' => 'config-deals-details_' . $language['code'] . '-main_title',
                							    'placeholder' => 'Please Enter Main Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['deals']['details'.'_'.$language['code']]['main_title']) ? set_value('main_title', $configurations['deals']['details'.'_'.$language['code']]['main_title']) : set_value('main_title', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							<span class="description">It will be show as a Banner Main Title</span>
            							<?php if(form_error('config[deals][details_' . $language['code'] . '][main_title]')) { ?>
            								<?php echo form_error('config[deals][details_' . $language['code'] . '][main_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Sub Title: ', 'config[deals][details_' . $language['code'] . '][sub_title]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[deals][details_' . $language['code'] . '][sub_title]',
                							    'id' => 'config-deals-details_' . $language['code'] . '-sub_title',
                							    'placeholder' => 'Please Enter Sub Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['deals']['details'.'_'.$language['code']]['sub_title']) ? set_value('sub_title', $configurations['deals']['details'.'_'.$language['code']]['sub_title']) : set_value('sub_title', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							<span class="description">It will be show as a Banner Sub Title</span>
            							<?php if(form_error('config[deals][details_' . $language['code'] . '][sub_title]')) { ?>
            								<?php echo form_error('config[deals][details_' . $language['code'] . '][sub_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Boxed Title: ', 'config[deals][details_' . $language['code'] . '][boxed_title]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[deals][details_' . $language['code'] . '][boxed_title]',
                							    'id' => 'config-deals-details_' . $language['code'] . '-boxed_title',
                							    'placeholder' => 'Please Enter Boxed Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['deals']['details'.'_'.$language['code']]['boxed_title']) ? set_value('main_title', $configurations['deals']['details'.'_'.$language['code']]['boxed_title']) : set_value('boxed_title', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							<span class="description">It will be show as a Banner Boxed Title</span>
            							<?php if(form_error('config[deals][details_' . $language['code'] . '][boxed_title]')) { ?>
            								<?php echo form_error('config[deals][details_' . $language['code'] . '][boxed_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
            	
            					<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Description: ', 'config[deals][details_' . $language['code'] . '][dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[deals][details_' . $language['code'] . '][dsc]',
                							    'id' => 'config-deals-details_' . $language['code'] . '-dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['deals']['details'.'_'.$language['code']]['dsc']) ? set_value('dsc', $configurations['deals']['details'.'_'.$language['code']]['dsc']) : set_value('dsc', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							<span class="description">It will be show as a banner Description</span>
            							<?php if(form_error('config[deals][details_' . $language['code'] . '][dsc]')) { ?>
            								<?php echo form_error('config[deals][details_' . $language['code'] . '][dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
								
								<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Banner Description: ', 'config[deals][details_' . $language['code'] . '][banner_dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[deals][details_' . $language['code'] . '][banner_dsc]',
                							    'id' => 'config-deals-details_' . $language['code'] . '-banner_dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['deals']['details'.'_'.$language['code']]['banner_dsc']) ? set_value('banner_dsc', $configurations['deals']['details'.'_'.$language['code']]['banner_dsc']) : set_value('banner_dsc', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							<span class="description">It will be show as a Description</span>
            							<?php if(form_error('config[deals][details_' . $language['code'] . '][banner_dsc]')) { ?>
            								<?php echo form_error('config[deals][details_' . $language['code'] . '][banner_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
