<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
             
            echo form_open('admin/settings/header-page', $attributes); 
        ?>
        	<h2>
        		Edit Header Settings 
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
					<div class="form-group <?php if(form_error('config[header][details_en][social_fb]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Facebook URL: ', 'config-header-details_en-social_fb', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[header][details_en][social_fb]',
            						'id' => 'config-header-details_en-social_fb',
            						'placeholder' => 'Please Enter Facebook Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['header']['details_en']['social_fb']) ? set_value('social_fb', $configurations['header']['details_en']['social_fb']) : set_value('social_fb', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Facebook page link in header</span>
            				
            				<?php if(form_error('config[header][details_en][social_fb]')) { ?>
            					<?php echo form_error('config[header][details_en][social_fb]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            			</div>	
        			</div>
        			<div class="form-group <?php if(form_error('config[header][details_en][social_insta]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Instagram URL: ', 'config-header-details_en-social_insta', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[header][details_en][social_insta]',
            						'id' => 'config-header-details_en-social_insta',
            						'placeholder' => 'Please Enter Instagram Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['header']['details_en']['social_insta']) ? set_value('social_insta', $configurations['header']['details_en']['social_insta']) : set_value('social_insta', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Instagram page link in header</span>
            				<?php if(form_error('config[header][details_en][social_insta]')) { ?>
            					<?php echo form_error('config[header][details_en][social_insta]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            			</div>	
        			</div>
        			<div class="form-group <?php if(form_error('config[header][details_en][social_twitter]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Twitter URL: ', 'config-header-details_en-social_twitter', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[header][details_en][social_twitter]',
            						'id' => 'config-header-details_en-social_twitter',
            						'placeholder' => 'Please Enter Twitter Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['header']['details_en']['social_twitter']) ? set_value('social_twitter', $configurations['header']['details_en']['social_twitter']) : set_value('social_twitter', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Twitter page link in header</span>
            				<?php if(form_error('config[header][details_en][social_twitter]')) { ?>
            					<?php echo form_error('config[header][details_en][social_twitter]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            			</div>	
        			</div>
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
        						<div class="form-group <?php if(form_error('config[header][details_' . $language['code'] . '][contact_us]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Contact US: ', 'config[header][details_' . $language['code'] . '][contact_us]', $attributes);
                                    ?>
            						<div class="col-sm-9">
            							<?php
                							$attributes = array(
                							    'name' => 'config[header][details_' . $language['code'] . '][contact_us]',
                							    'id' => 'config[header][details_' . $language['code'] . '][contact_us]',
                							    'placeholder' => 'Please Enter Contact Us Details',
                							    'class' => 'form-control ckeditor',
                							    'value' => isset($configurations['header']['details_' . $language['code']]['contact_us']) ? html_entity_decode(set_value('config[header][details_' . $language['code'] . '][contact_us]', $configurations['header']['details_' . $language['code']]['contact_us'])) : set_value('config[header][details_' . $language['code'] . '][contact_us]', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							
            							<?php if(form_error('config[header][details_' . $language['code'] . '][contact_us]')) { ?>
            								<?php echo form_error('config[header][details_' . $language['code'] . '][contact_us]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<span class="description">It will be show as a Header Contact Us Section</span>
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

<script src="<?php echo base_url('assets/admin/js/ckeditor/ckeditor.js'); ?>"></script>
