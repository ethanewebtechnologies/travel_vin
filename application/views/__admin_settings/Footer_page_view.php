<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered'
            );
             
            echo form_open('admin/settings/footer-page', $attributes); 
        ?>
        	<h2>
        		Edit Footer Settings 
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
					<div class="form-group <?php if(form_error('config[footer][details_en][social_fb]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Facebook URL: ', 'config-footer-details_en-social_fb', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[footer][details_en][social_fb]',
            						'id' => 'config-footer-details_en-social_fb',
            						'placeholder' => 'Please Enter Facebook Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['footer']['details_en']['social_fb']) ? set_value('social_fb', $configurations['footer']['details_en']['social_fb']) : set_value('social_fb', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Facebook page link in footer</span>
            				
            				<?php if(form_error('config[footer][details_en][social_fb]')) { ?>
            					<?php echo form_error('config[footer][details_en][social_fb]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            			</div>	
        			</div>
        			<div class="form-group <?php if(form_error('config[footer][details_en][social_insta]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Instagram URL: ', 'config-footer-details_en-social_insta', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[footer][details_en][social_insta]',
            						'id' => 'config-footer-details_en-social_insta',
            						'placeholder' => 'Please Enter Instagram Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['footer']['details_en']['social_insta']) ? set_value('social_insta', $configurations['footer']['details_en']['social_insta']) : set_value('social_insta', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Instagram page link in footer</span>
            				<?php if(form_error('config[footer][details_en][social_insta]')) { ?>
            					<?php echo form_error('config[footer][details_en][social_insta]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            			</div>	
        			</div>
        			<div class="form-group <?php if(form_error('config[footer][details_en][social_twitter]')) { echo 'validate-has-error'; } ?>">
        				 <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                        
                            echo form_label('Twitter URL: ', 'config-footer-details_en-social_twitter', $attributes);
                        ?>
                        <div class="col-sm-8">
            				<?php
            					$attributes = array(
            						'name' => 'config[footer][details_en][social_twitter]',
            						'id' => 'config-footer-details_en-social_twitter',
            						'placeholder' => 'Please Enter Twitter Page Link',
            						'class' => 'form-control',
            						'value' => isset($configurations['footer']['details_en']['social_twitter']) ? set_value('social_twitter', $configurations['footer']['details_en']['social_twitter']) : set_value('social_twitter', '')
            					);
            					
            					echo form_input($attributes);
            				?>
            				<span class="description">Twitter page link in footer</span>
            				<?php if(form_error('config[footer][details_en][social_twitter]')) { ?>
            					<?php echo form_error('config[footer][details_en][social_twitter]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
        						<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][contact_us]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Contact US: ', 'config[footer][details_' . $language['code'] . '][contact_us]', $attributes);
                                    ?>
            						<div class="col-sm-9">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][contact_us]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][contact_us]',
                							    'placeholder' => 'Please Enter Contact Us Details',
                							    'class' => 'form-control ckeditor',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['contact_us']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][contact_us]', $configurations['footer']['details_' . $language['code']]['contact_us'])) : set_value('config[footer][details_' . $language['code'] . '][contact_us]', '')
                							);
                							
                							echo form_textarea($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][contact_us]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][contact_us]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Contact Us Section</div>
            						</div>
            					</div>
            					<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][copyright]')) { echo 'validate-has-error'; } ?>">
            						<?php
                                        $attributes = array(
                                            'class' => 'col-sm-3 control-label'
                                        );
                
                                        echo form_label('Copyright: ', 'config[footer][details_' . $language['code'] . '][copyright]', $attributes);
                                    ?>
            						<div class="col-sm-9">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][copyright]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][copyright]',
                							    'placeholder' => 'Please Enter Copyright Details',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['copyright']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][copyright]', $configurations['footer']['details_' . $language['code']]['copyright'])) : set_value('config[footer][details_' . $language['code'] . '][copyright]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][copyright]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][copyright]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Copyright Section</div>
            						</div>
								</div>
								
								
								<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][blog_1_title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
				
										echo form_label('First Blog: ', 'config[footer][details_' . $language['code'] . '][blog_1_title]', $attributes);
									?>
									<div class="col-sm-5">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_1_title]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_1_title]',
                							    'placeholder' => 'Blog Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_1_title']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_1_title]', $configurations['footer']['details_' . $language['code']]['blog_1_title'])) : set_value('config[footer][details_' . $language['code'] . '][blog_1_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_1_title]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_1_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer First Blog Title</div>
            						</div>
									
									<div class="col-sm-4">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_1_link]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_1_link]',
                							    'placeholder' => 'https://your-link',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_1_link']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_1_link]', $configurations['footer']['details_' . $language['code']]['blog_1_link'])) : set_value('config[footer][details_' . $language['code'] . '][blog_1_link]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_1_link]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_1_link]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer First Blog Link</div>
            						</div>
            					</div>
								
								<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][blog_2_title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
				
										echo form_label('Second Blog: ', 'config[footer][details_' . $language['code'] . '][blog_2_title]', $attributes);
									?>
									<div class="col-sm-5">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_2_title]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_2_title]',
                							    'placeholder' => 'Blog Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_2_title']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_2_title]', $configurations['footer']['details_' . $language['code']]['blog_2_title'])) : set_value('config[footer][details_' . $language['code'] . '][blog_2_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_2_title]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_2_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Second Blog Title</div>
            						</div>
									
									<div class="col-sm-4">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_2_link]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_2_link]',
                							    'placeholder' => 'https://your-link',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_2_link']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_2_link]', $configurations['footer']['details_' . $language['code']]['blog_2_link'])) : set_value('config[footer][details_' . $language['code'] . '][blog_2_link]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_2_link]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_2_link]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Second Blog Link</div>
            						</div>
            					</div>
								
								<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][blog_3_title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
				
										echo form_label('Third Blog: ', 'config[footer][details_' . $language['code'] . '][blog_3_title]', $attributes);
									?>
									<div class="col-sm-5">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_3_title]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_3_title]',
                							    'placeholder' => 'Blog Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_3_title']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_3_title]', $configurations['footer']['details_' . $language['code']]['blog_3_title'])) : set_value('config[footer][details_' . $language['code'] . '][blog_3_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_3_title]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_3_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Third Blog Link</div>
            						</div>
									
									<div class="col-sm-4">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_3_link]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_3_link]',
                							    'placeholder' => 'https://your-link',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_3_link']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_3_link]', $configurations['footer']['details_' . $language['code']]['blog_3_link'])) : set_value('config[footer][details_' . $language['code'] . '][blog_3_link]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_3_link]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_3_link]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Third Blog Section</div>
            						</div>
            					</div>
								
								<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][blog_4_title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
				
										echo form_label('Fourth Blog: ', 'config[footer][details_' . $language['code'] . '][blog_4_title]', $attributes);
									?>
									<div class="col-sm-5">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_4_title]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_4_title]',
                							    'placeholder' => 'Blog Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_4_title']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_4_title]', $configurations['footer']['details_' . $language['code']]['blog_4_title'])) : set_value('config[footer][details_' . $language['code'] . '][blog_4_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_4_title]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_4_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Fourth Blog Title</div>
            						</div>
									
									<div class="col-sm-4">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_4_link]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_4_link]',
                							    'placeholder' => 'https://your-link',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_4_link']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_4_link]', $configurations['footer']['details_' . $language['code']]['blog_4_link'])) : set_value('config[footer][details_' . $language['code'] . '][blog_4_link]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_4_link]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_4_link]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Fourth Blog Link</div>
            						</div>
            					</div>
								
								<div class="form-group <?php if(form_error('config[footer][details_' . $language['code'] . '][blog_5_title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
				
										echo form_label('Fifth Blog: ', 'config[footer][details_' . $language['code'] . '][blog_5_title]', $attributes);
									?>
									<div class="col-sm-5">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_5_title]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_5_title]',
                							    'placeholder' => 'Blog Title',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_5_title']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_5_title]', $configurations['footer']['details_' . $language['code']]['blog_5_title'])) : set_value('config[footer][details_' . $language['code'] . '][blog_5_title]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_5_title]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_5_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Fifth Blog Title</div>
            						</div>
									
									<div class="col-sm-4">
            							<?php
                							$attributes = array(
                							    'name' => 'config[footer][details_' . $language['code'] . '][blog_5_link]',
                							    'id' => 'config[footer][details_' . $language['code'] . '][blog_5_link]',
                							    'placeholder' => 'https://your-link',
                							    'class' => 'form-control',
                							    'value' => isset($configurations['footer']['details_' . $language['code']]['blog_5_link']) ? html_entity_decode(set_value('config[footer][details_' . $language['code'] . '][blog_5_link]', $configurations['footer']['details_' . $language['code']]['blog_5_link'])) : set_value('config[footer][details_' . $language['code'] . '][blog_5_link]', '')
                							);
                							
                							echo form_input($attributes);
            							?>
            							
            							<?php if(form_error('config[footer][details_' . $language['code'] . '][blog_5_link]')) { ?>
            								<?php echo form_error('config[footer][details_' . $language['code'] . '][blog_5_link]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
            							<div class="description">It will be show as a Footer Fifth Blog Link</div>
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
