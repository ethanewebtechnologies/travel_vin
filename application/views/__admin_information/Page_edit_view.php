<div class="row">
	<div class="col-md-12">
		<?php 
			$attributes = array(
			  'class' => 'form-horizontal form-groups-bordered'
			);
			
			echo form_open_multipart('admin/information/page/edit?secure_token=' . $this->security_lib->encrypt($page['id']), $attributes); 
		?>
			<h2>
				Edit Page Details
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
					<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/information/page/'); ?>">
						<i class="entypo-cancel"></i> Cancel
					</a>
    		    </span>
    	 	</h2>
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="form-group <?php if(form_error('slug')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Page Slug(Seo URL): ', 'slug', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'slug',
                                    'placeholder' => 'Please Enter Slug(Seo URL) e.g. page-name',
                                    'class' => 'form-control',
                                    'value' => set_value('slug', $page['page_slug']),
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
                                            'checked' => $page['status'] == 1 ? TRUE : FALSE
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
								<?php foreach($languages as $language) { ?>
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
							
							<?php foreach($languages as $language) { ?>
								<div id="<?php echo $language['code']; ?>" class="tab-pane fade <?php echo $flag ? 'in active' : ''; ?>">	
									<div class="form-group">	
										<?php
											
											$attributes = array(
												'class' => 'col-sm-3 control-label'
											);
								
											echo form_label('Page Name :', 'page_name',$attributes);
										?>
										<div class="col-sm-8">
											<?php
												$attributes = array(
													'name'	=>	'details[' . $language['code'] . '][page_name]',
													'placeholder' => 'Please Enter page Name',
													'class' => 'form-control',
												    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][page_name]', $page_details[$language['code']]['page_name']))   
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
								
											echo form_label('Page Content:', 'page_content', $attributes);
										?>
										
										<div class="col-sm-8">
											<?php
												$attributes = array(
                                                    'name' => 'details[' . $language['code'] . '][page_content]',
                                                    'class' => 'form-control ckeditor',
												    'value' => html_entity_decode(set_value('details['. $language['code'] . '][page_content]', $page_details[$language['code']]['page_content']))    
												);
												
												echo form_textarea($attributes);
											?>
										</div>
									</div>
									<div class="form-group">
										<?php
											
											$attributes = array(
												'class' => 'col-sm-3 control-label'
											);
											
											echo form_label('Meta Title:', 'meta_title',   $attributes );
										?>
										
										<div class="col-sm-8">
											<?php
												$attributes = array(
													'name'	=>	'details[' . $language['code'] . '][title]',
													'placeholder' => 'Please Enter Meta Title',
													'class' => 'form-control',
												    'value' => html_entity_decode(set_value('details['. $language['code'] . '][title]', $page_details[$language['code']]['meta_title']))    
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
									
											echo form_label('Meta Description:', 'meta_description',$attributes);
										?>
										
										<div class="col-sm-8">
										
											<?php
												$attributes = array(
												   'name'	=>	'details[' . $language['code'] . '][description]',
												   'placeholder' => 'Please Enter Meta Description',
												   'class' => 'form-control',
												   'value' => html_entity_decode(set_value('details['. $language['code'] . '][title]', $page_details[$language['code']]['meta_description']))    
												);
												
												echo form_textarea($attributes);
											?>
											
										</div>
									</div>
									
									<div class="form-group">
										<?php
											$attributes = array(
                                                'class' => 'col-sm-3 control-label'
											);
											
											echo form_label('Meta Keyword:', 'keyword',  $attributes);
										?>
										<div class="col-sm-8">
											<?php
												$data = array(
                                                    'name' => 'details[' . $language['code'] . '][meta_keyword]',
                                                    'placeholder' => 'Please Enter Keyword',
                                                    'class' => 'form-control',
												    'value' => html_entity_decode(set_value('details['. $language['code'] . '][meta_keyword]', $page_details[$language['code']]['meta_keyword'])) 
												);
												
												echo form_textarea($data);
											?>
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

	