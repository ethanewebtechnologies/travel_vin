<?php $i = 0; ?>
<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );

            echo form_open('admin/customer/customer/edit?secure_token=' . $this->security_lib->encrypt($customer['id']), $attributes);
        ?>
        	<h2>
            	<?php echo "Edit Customer Details"; ?>

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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/customer/customer'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </span>
        	</h2>
            <div class="panel panel-primary">
                <div class="panel-body">
                	<div class="lang-tabs">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a data-toggle="tab" href="#general-details-tab">
                                	General Details
                                </a>
                            </li>
                            <li>
                            	<a data-toggle="tab" href="#address-details-tab">
                                	Address Details
                                </a>
                            </li>
                        </ul>
                    </div>
                	<div class="tab-content">
                    	<div id="general-details-tab" class="tab-pane fade in active">
                    		<div class="form-group">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Customer Type: ', 'customer_type_id', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'id' => 'customer_type_id',
                                            'name' => 'customer_type_id',
                                            'placeholder' => 'Please Enter Customer Type',
                                            'class' => 'form-control',
                                        );
                
                                        echo form_dropdown($attributes, $customer_types, set_value('customer_type_id', $customer['customer_type_id']));
                                    ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('firstname')) { echo 'validate-has-error'; } ?>">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Firstname: ', 'firstname', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'id' => 'firstname',
                                            'name' => 'firstname',
                                            'placeholder' => 'Please Enter First Name',
                                            'class' => 'form-control',
                                            'value' => set_value('firstname', $customer['firstname']),
                                            'data-validate' => 'required, minlength[3], maxlength[32]',
                                            'data-message-required' => 'First name is Required'
                                        );
                
                                        echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('firstname')) { ?>
                    					<?php echo form_error('firstname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('lastname')) { echo 'validate-has-error'; } ?>">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Lastname: ', 'lastname', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'id' => 'lastname',
                                            'name' => 'lastname',
                                            'placeholder' => 'Please Enter Last Name',
                                            'class' => 'form-control',
                                            'value' => set_value('lastname', $customer['lastname'])
                                        );
                
                                        echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('lastname')) { ?>
                    					<?php echo form_error('lastname', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('email')) { echo 'validate-has-error'; } ?>">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Email: ', 'email', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'id' => 'email',
                                            'name' => 'email',
                                            'placeholder' => 'Please Enter Email',
                                            'class' => 'form-control',
                                            'value' => set_value('email', $customer['email']),
                                            'data-validate' => 'required, minlength[3], maxlength[96]',
                                            'data-message-required' => 'Email  is Required'
                                        );
                
                                        echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('email')) { ?>
                    					<?php echo form_error('email', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
                                    <?php echo form_hidden('current_email', $customer['email']); ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('telephone')) { echo 'validate-has-error'; } ?>">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Telephone: ', 'telephone', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'id' => 'telephone',
                                            'name' => 'telephone',
                                            'placeholder' => 'Please Enter Telephone',
                                            'class' => 'form-control',
                                            'value' => set_value('telephone', $customer['telephone'])
                                        );
                
                                        echo form_input($attributes);
                                    ?>
                                    <?php if(form_error('telephone')) { ?>
                    					<?php echo form_error('telephone', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    				<?php } ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('gender')) { echo 'validate-has-error'; } ?>">
                            	<?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Gender: ', 'gender', $attributes);
                                ?>
                            	<div class="col-sm-8">
                            		<div class="radio">
                            			<label>
                            				<input type="radio" name="gender" id="gender-1" value="1" <?php echo $customer['gender'] == 1 ? 'Checked':''?>>
                            					Male
                            			</label>
                            			<label>
                            				<input type="radio" name="gender" id="gender-2" value="1" <?php echo $customer['gender'] == 2 ? 'Checked':''?>>
                            					Female
                            			</label>
                            			<?php if(form_error('gender')) { ?>
                    						<?php echo form_error('gender', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                    					<?php } ?>
                            		</div>
                            	</div>
                            </div>
                            <div class="form-group <?php if(form_error('date_of_birth')) { echo 'validate-has-error'; } ?>">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
            
                                    echo form_label('Date of Birth: ', 'date_of_birth', $attributes);
                                ?>
                                <div class="col-sm-8">
                                	<div class="input-group">
                                        <?php
                                            $attributes = array(
                                                'id' => 'date_of_birth',
                                                'name' => 'date_of_birth',
                                                'placeholder' => 'Please Enter Date of Birth',
                                                'class' => 'form-control datepicker',
                                                'data-format' => 'dd-mm-yyyy',
                                                'value' => set_value('date_of_birth', d_to_lu($customer['date_of_birth']))
                                            );
                    
                                            echo form_input($attributes);
                                        ?>
                                        
                                        <div class="input-group-addon">
        									<a href="#"><i class="entypo-calendar"></i></a>
        								</div>
                                    </div> 
                                    <?php if(form_error('date_of_birth')) { ?>
                						<?php echo form_error('date_of_birth', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                					<?php } ?>   
                                </div>
                            </div>
                             <div class="form-group">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
                                    
                                    echo form_label('Newsletter Status: ', 'newsletter_status', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <div class="bs-example">
                                        <div class="make-switch switch-small has-switch" data-on="primary" data-off="info" data-on-label="&nbsp;&nbsp;Subscribed&nbsp;&nbsp;" data-off-label="&nbsp;&nbsp;Unsubscribed&nbsp;&nbsp;">
                                            <?php
                                                $data = array(
                                                    'name' => 'newsletter_status',
                                                    'id' => 'newsletter_status',
                                                    'value' => '1',
                                                    'checked' => $customer['newsletter_status'] == '1' ? TRUE : FALSE
                                                );
                                                
                                                echo form_checkbox($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
                                    
                                    echo form_label('Approval: ', 'approved', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <div class="bs-example">
                                        <div class="make-switch switch-small has-switch" data-on="primary" data-off="info" data-on-label="<i class='entypo-check'></i>" data-off-label="<i class='entypo-cancel'></i>">
                                            <?php
                                                $data = array(
                                                    'name' => 'approved',
                                                    'id' => 'approved',
                                                    'value' => '1',
                                                    'checked' => $customer['approved'] == '1' ? TRUE : FALSE
                                                );
                                                
                                                echo form_checkbox($data);
                                            ?>
                                        </div>
                                    </div>
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
                                        <div class="make-switch switch-small has-switch" data-on="primary" data-off="info" data-on-label="&nbsp;&nbsp;Enable&nbsp;&nbsp;" data-off-label="&nbsp;&nbsp;Disable&nbsp;&nbsp;">
                                            <?php
                                                $data = array(
                                                    'name' => 'status',
                                                    'id' => 'status',
                                                    'value' => '1',
                                                    'checked' => $customer['status'] == '1' ? TRUE : FALSE
                                                );
                                                
                                                echo form_checkbox($data);
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    	</div>
                    	<div id="address-details-tab" class="tab-pane fade">
                    		<?php if($customer_addresses) { ?>
                        		<?php foreach ($customer_addresses as $customer_address) { ?>
                    				<div id="address_blk-<?php echo $i; ?>" class="add_blk">
                        				<div class="form-group">
                                            <?php
                                                $attributes = array(
                                                    'class' => 'col-sm-3 control-label'
                                                );
                        
                                                echo form_label('Address Line 1: ', 'address_details[' . $i . '][address_1]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'name' => 'address_details[' . $i . '][address_1]',
                                                        'placeholder' => 'Building Name, Locality, Society',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][address_1]', $customer_address['address_1'])
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
                        
                                                echo form_label('Address Line 2: ', 'address_details[' . $i . '][address_2]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'name' => 'address_details[' . $i . '][address_2]',
                                                        'placeholder' => 'Street Name, Landmark',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][address_2]', $customer_address['address_2'])
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
                        
                                                echo form_label('City: ', 'address_details[' . $i . '][city]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'name' => 'address_details[' . $i . '][city]',
                                                        'placeholder' => 'Please Enter City',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][city]', $customer_address['city'])
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
                        
                                                echo form_label('Postcode: ', 'address_details[' . $i . '][postcode]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'name' => 'address_details[' . $i . '][postcode]',
                                                        'placeholder' => 'Please Enter Postcode',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][postcode]', $customer_address['postcode'])
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
                        
                                                echo form_label('Country: ', 'address_details[' . $i . '][country]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'id' => 'country',
                                                        'name' => 'address_details[' . $i . '][country]',
                                                        'placeholder' => 'Please Enter Country',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][country]', $customer_address['country'])
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
                        
                                                echo form_label('State: ', 'address_details[' . $i . '][state]', $attributes);
                                            ?>
                                            <div class="col-sm-8">
                                                <?php
                                                    $attributes = array(
                                                        'id' => 'state',
                                                        'name' => 'address_details[' . $i . '][state]',
                                                        'placeholder' => 'Please Enter State',
                                                        'class' => 'form-control',
                                                        'value' => set_value('address_details[' . $i . '][state]', $customer_address['state'])
                                                    );
                            
                                                    echo form_input($attributes);
                                                ?>
                                            </div>
                                        </div>
                    				</div>
                    				<?php $i++; ?>
                    			<?php } ?>
                    		<?php } ?>	
                    		<div class="col-sm-offset-3 col-sm-9">
                        		<button onclick="addAddressFields();" type="button" class="btn btn-blue add_address">
                        			Add More Address
                        		</button>                            	
                        	</div>
                    	</div>
                    </div>
                </div>
            </div>
		<?php echo form_close(); ?>
    </div>
</div>
<script>
    var no = Number(<?php echo $i; ?>);
    
    var addAddressFields = function() {
    	var html = '';
    
    	html += '<div id="address_blk-' + no + '" class="add_blk">';
    	html += 	'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][address_1]" class="col-sm-3 control-label">Address Line 1: </label>';
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][address_1]" value="" placeholder="Building Name, Locality, Society" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=		'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][address_2]" class="col-sm-3 control-label">Address Line 2: </label>';    
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][address_2]" value="" placeholder="Street Name, Landmark" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=		'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][city]" class="col-sm-3 control-label">City: </label>';    
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][city]" value="" placeholder="Please Enter City" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=		'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][postcode]" class="col-sm-3 control-label">Postcode: </label>';    
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][postcode]" value="" placeholder="Please Enter Postcode" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=		'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][country]" class="col-sm-3 control-label">Country: </label>';    
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][country]" value="" placeholder="Please Enter Country" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=		'<div class="form-group">';
    	html +=			'<label for="address_details[' + no + '][state]" class="col-sm-3 control-label">State: </label>';    
    	html +=    		'<div class="col-sm-8">';
    	html +=				'<input type="text" name="address_details[' + no + '][state]" value="" placeholder="Please Enter State" class="form-control">';
    	html +=			'</div>';
    	html +=		'</div>';
    	html +=	'</div>';
    
    	no++;

        if(no == 1) {

        	html += '<div class="col-sm-offset-3 col-sm-9">';
        	html += 	'<button onclick="addAddressFields();" type="button" class="btn btn-blue add_address">';
        	html += 		'Add More Address';
        	html += 	'</button>';                            	
        	html += '</div>';
            
            $('#address-details-tab').html(html);
        } else {
    		$('#address_blk-' + (no-2)).after(html);
        }
    }



    $('#country').on('change', function () {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('admin/customer/customer/get-cities-by-country-id'); ?>",
            data: {country_id: this.value},
            dataType: "json",
            success: function (res) {
                if (res) {
                    $("#city").empty();
                    $("#city").append('<option value="">--- Select City ---</option>');
                    for (var i = 0; i < res.length; i++) {
                        $("#city").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                    }
                }
            }
        });
    });
</script>
<style>
div#address-details-tab .add_blk{margin-top:20px; padding-top:20px;border-top:2px solid #eee;}
div#address-details-tab .add_blk:first-child{margin-top:0px; padding-top:0px;border-top:0px solid #eee;}
</style>

<script>
$(function() {
    $('#date_of_birth').datepicker({
        startDate: '-0m',
		format: 'dd-mm-yyyy',     
    });
});
</script>
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>