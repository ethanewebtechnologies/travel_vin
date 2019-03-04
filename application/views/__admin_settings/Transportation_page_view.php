<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
             
            echo form_open('admin/settings/transportation-page', $attributes); 
        ?>
        	<h2>
        		Edit Transportation Page Settings 
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
            	
            					<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Description: ', 'config[transportation][details_' . $language['code'] . '][dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[transportation][details_' . $language['code'] . '][dsc]',
                							    'id' => 'config-transportation-details_' . $language['code'] . '-dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['transportation']['details'.'_'.$language['code']]['dsc']) ? set_value('dsc', $configurations['transportation']['details'.'_'.$language['code']]['dsc']) : set_value('dsc', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							<span class="description">It will be show as a Main Description</span>
            							<?php if(form_error('config[transportation][details_' . $language['code'] . '][dsc]')) { ?>
            								<?php echo form_error('config[transportation][details_' . $language['code'] . '][dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
								
								
								<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Shared Transportation Description: ', 'config[transportation][details_' . $language['code'] . '][shared_dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[transportation][details_' . $language['code'] . '][shared_dsc]',
                							    'id' => 'config-transportation-details_' . $language['code'] . '-shared_dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['transportation']['details'.'_'.$language['code']]['shared_dsc']) ? set_value('shared_dsc', $configurations['transportation']['details'.'_'.$language['code']]['shared_dsc']) : set_value('shared_dsc', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							<span class="description">It will be show as a Shared Transportation Description</span>
            							<?php if(form_error('config[transportation][details_' . $language['code'] . '][shared_dsc]')) { ?>
            								<?php echo form_error('config[transportation][details_' . $language['code'] . '][shared_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            						</div>
            					</div>
								
								<div class="form-group">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Private Transportation Description: ', 'config[transportation][details_' . $language['code'] . '][private_dsc]', $attributes);
                                    ?>
            						
            						<div class="col-sm-8">
            							<?php
                							$attributes = array(
                							    'name' => 'config[transportation][details_' . $language['code'] . '][private_dsc]',
                							    'id' => 'config-transportation-details_' . $language['code'] . '-private_dsc',
                							    'placeholder' => 'Please Enter Description',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['transportation']['details'.'_'.$language['code']]['private_dsc']) ? set_value('private_dsc', $configurations['transportation']['details'.'_'.$language['code']]['private_dsc']) : set_value('private_dsc', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							<span class="description">It will be show as a Private Transportation Description</span>
            							<?php if(form_error('config[transportation][details_' . $language['code'] . '][private_dsc]')) { ?>
            								<?php echo form_error('config[transportation][details_' . $language['code'] . '][private_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
