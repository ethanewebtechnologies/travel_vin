<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered'
            );

            echo form_open_multipart('vendor/account/manage/edit?secure_token=' . $this->security_lib->encrypt($vendor['id']), $attributes);
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
            	Edit Account Details

                <span class="pull-right btn-toolbar">
                    <?php
                        $attributes = array(
                            'name' => 'save',
                            'id' => 'save',
                            'value' => 'Save',
                            'type' => 'submit',
                            'content' => '<i class="entypo-check"></i> Save',
                            'class' => 'btn btn-green btn-icon icon-left'
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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('vendor/account/manage'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </span>
        	</h2>
            <div class="panel panel-primary">
                <div class="panel-body">
                	<div class="form-group <?php if(form_error('company_legal_name')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Company Legal Name: ', 'company_legal_name', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'company_legal_name',
                                    'id' => 'company_legal_name',
                                    'class' => 'form-control',
                                    'value' => set_value('company_legal_name', $vendor['company_legal_name']),
                                    'disabled' => 'disabled'
                                );
                                
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('company_legal_name')) { ?>
								<?php echo form_error('company_legal_name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('company_logo_image')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Company Logo: ', 'company_logo_image', $attributes);
                        ?>
                        <div class="col-sm-8">
    						<div class="fileinput fileinput-new" data-provides="fileinput">
    							<input type="hidden" value="<?php echo set_value('company_logo_image_check', $vendor['company_logo']); ?>" name="company_logo_image_check">
    							<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
    								<?php if(isset($vendor['company_logo'])) { ?>
    									<?php echo $optimized->resize($vendor['company_logo'], 200, 100, array(), 'resize_crop'); ?>
    								<?php } else { ?>
    									<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); ?>
    								<?php } ?>
    							</div>
    							
    							<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 100px; line-height: 10px;"></div>
    							
    							<div>
    								<span class="btn btn-white btn-file">
    									<span class="fileinput-new">Select image</span>
    									<span class="fileinput-exists">Change</span>
    									<input type="file" name="company_logo_image" accept="image/*">
    								</span>
    								<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
    							</div>
    						</div>
    						
    						<br>
        						
    						<?php if(form_error('company_logo_image')) { ?>
                				<?php echo form_error('company_logo_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
    					</div>
                    </div>
                    <?php echo form_hidden('email', $vendor['email']); ?>
                    
                    <!-- VINAY CODE -->
                    <div class="form-group <?php if(form_error('email')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Email: ', 'email', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'email',
                                    'class' => 'form-control',
                                    'value' => set_value('email', $vendor['email']),
                                    'disabled' => 'disabled'
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('email')) { ?>
                				<?php echo form_error('email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('telephone')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Telephone: ', 'telephone', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'telephone',
                                    'class' => 'form-control',
                                    'value' => set_value('telephone', $vendor['telephone']),
                                    'disabled' => 'disabled'
                                );
        
                                echo form_input($attributes);
                            ?>
                            
                            <?php if(form_error('telephone')) { ?>
                				<?php echo form_error('telephone', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
					<div class="form-group <?php if(form_error('address')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Address: ', 'address', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'address',
                                    'class' => 'form-control',
                                    'rows'  => 4,
                                    'cols'  =>  20,
                                    'value' => set_value('address', $vendor['address'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_textarea($attributes);
                            ?>
                            
                            <?php if(form_error('address')) { ?>
                				<?php echo form_error('address', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('country')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Country: ', 'country', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'country',
                                    'class' => 'form-control',
                                    'rows'  => 4,
                                    'cols'  =>  20,
                                    'value' => set_value('country', $vendor['country'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('country')) { ?>
                				<?php echo form_error('country', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('state')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('State: ', 'state', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'state',
                                    'class' => 'form-control',
                                    'rows'  => 4,
                                    'cols'  =>  20,
                                    'value' => set_value('state', $vendor['state'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('state')) { ?>
                				<?php echo form_error('state', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    <div class="form-group <?php if(form_error('city')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('City: ', 'city', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'city',
                                    'class' => 'form-control',
                                    'rows'  => 4,
                                    'cols'  =>  20,
                                    'value' => set_value('address', $vendor['city'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('city')) { ?>
                				<?php echo form_error('city', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('postal')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Postal: ', 'postal', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'postal',
                                    'class' => 'form-control',
                                    'value' => set_value('postal', $vendor['postal'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                             <?php if(form_error('postal')) { ?>
                				<?php echo form_error('postal', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    <!-- END OF VINAY CODE -->
                    
                    <div class="form-group <?php if(form_error('business_type')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Business Type: ', 'business_type', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'business_type',
                                    'class' => 'form-control',
                                    'value' => set_value('business_type', $vendor['business_type'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('business_type')) { ?>
                				<?php echo form_error('business_type', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
    
                    <div class="form-group <?php if(form_error('admin_email')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Admin Email: ', 'admin_email', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'type'  =>  'email',
                                    'name' => 'admin_email',
                                    'class' => 'form-control',
                                    'value' => set_value('admin_email', $vendor['admin_email']),
                                    'disabled' => 'disabled'
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_input($attributes);
                            ?>
                            
                            <?php if(form_error('admin_email')) { ?>
                				<?php echo form_error('admin_email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
                    <div class="form-group <?php if(form_error('admin_contact')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Admin contact: ', 'admin_contact', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'admin_contact',
                                    'id' => 'admin_contact',
                                    'class' => 'form-control',
                                    'value' => set_value('Admin Contact', $vendor['admin_contact'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('admin_contact')) { ?>
                				<?php echo form_error('admin_contact', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
                    <div class="form-group <?php if(form_error('admin_fullname')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Admin Name: ', 'admin_fullname', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'admin_fullname',
                                    'class' => 'form-control',
                                    'value' => set_value('admin_fullname', $vendor['admin_fullname'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('admin_fullname')) { ?>
                				<?php echo form_error('admin_fullname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
    
                    <div class="form-group <?php if(form_error('admin_image_image')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Admin Profile Image: ', 'admin_image', $attributes);
                        ?>
                        <div class="col-sm-8">
    						<div class="fileinput fileinput-new" data-provides="fileinput">
    							<input type="hidden" value="<?php echo set_value('admin_image_image_check', $vendor['admin_image']); ?>" name="admin_image_image_check">
    							<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
    								<?php if(isset($vendor['admin_image'])) { ?>
    									<?php echo $optimized->resize($vendor['admin_image'], 200, 100, array(), 'resize_crop'); ?>
    								<?php } else { ?>
    									<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); ?>
    								<?php } ?>
    							</div>
    							
    							<div class="fileinput-preview fileinput-exists thumbnail" style="width: 200px; height: 100px; line-height: 10px;"></div>
    							
    							<div>
    								<span class="btn btn-white btn-file">
    									<span class="fileinput-new">Select image</span>
    									<span class="fileinput-exists">Change</span>
    									<input type="file" name="admin_image_image" accept="image/*">
    								</span>
    								<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
    							</div>
    						</div>
    						
    						<br>
        						
    						<?php if(form_error('admin_image_image')) { ?>
                				<?php echo form_error('admin_image_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
    					</div>
                    </div>
                    <div class="form-group <?php if(form_error('tax_id')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Tax Id: ', 'tax_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'tax_id',
                                    'class' => 'form-control',
                                    'value' => set_value('tax_id', $vendor['tax_id'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('tax_id')) { ?>
                				<?php echo form_error('tax_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
                    <div class="form-group <?php if(form_error('payment_details')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Payment Details: ', 'payment_details', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'payment_details',
                                    'class' => 'form-control',
                                    'value' => set_value('payment_details', $vendor['payment_details'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('payment_details')) { ?>
                				<?php echo form_error('payment_details', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
    
                    <div class="form-group <?php if(form_error('credit_debit_payal')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Credit Debit Payal: ', 'credit_debit_payal', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'credit_debit_payal',
                                    'class' => 'form-control',
                                    'value' => set_value('credit_debit_payal', $vendor['credit_debit_payal'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                            
                             <?php if(form_error('credit_debit_payal')) { ?>
                				<?php echo form_error('credit_debit_payal', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('card_number')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Card Number: ', 'card_number', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'card_number',
                                    'class' => 'form-control',
                                    'value' =>  set_value('card_number', $vendor['card_number'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('card_number')) { ?>
                				<?php echo form_error('card_number', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
                    
                    <div class="form-group <?php if(form_error('expiry_cvv')) { echo 'validate-has-error'; } ?>" >
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Expiry Cvv: ', 'expiry_cvv', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'expiry_cvv',
                                    'class' => 'form-control ckeditor',
                                    'value' =>  set_value( $vendor['expiry_cvv'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('expiry_cvv')) { ?>
                				<?php echo form_error('expiry_cvv', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                        </div>
                    </div>
            	</div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>


