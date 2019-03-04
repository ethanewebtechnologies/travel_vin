<div class="row">
	<div class="col-md-12">
		<?php		
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered  validate'
            );
            echo form_open('admin/listing/main-country/edit?secure_token=' . $this->security_lib->encrypt($country['id']), $attributes); 
        ?>
			<h2>
        		<?php echo "Edit Country  Details"; ?> 
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
					<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/listing/main-country'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
			<div class="panel panel-primary">
				<div class="panel-body">
                	<div class="form-group <?php if(form_error('name')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('Country Name: ', 'name', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php 	
                            	$attributes = array(
                            	    'name' => 'name',
                            	    'onkeyup' => 'lettersOnly(this)',
									'id' => 'country',
                            	    'autocomplete' => 'off',
                            	    'placeholder' => 'Please Enter Country Name',
                            	    'class' => 'form-control',
									'value' => set_value('name', $country['name']),
                            	    'data-validate' => 'required,  minlength[3], maxlength[255]',
                            	    'data-message-required' => 'Country Name is Required'
                            	);  
                            	echo form_input($attributes); 
                            ?>
                            <?php if(form_error('name')) { ?>
            					<?php echo form_error('name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                            <?php echo form_hidden('current_country_name', $country['name']); ?>
                        </div>    	
                    </div>
					<div class="form-group <?php if(form_error('date_of_arrival')) { echo 'validate-has-error'; } ?>">
                        <?php 
                            $attributes = array(
                              'class' => 'col-sm-3 control-label'
                            );
                            echo form_label('Starting Date: ', 'date_of_arrival', $attributes); 
                        ?>
						<div class="col-sm-8">
							<div class="input-group">
								<?php 
                                    $attributes = array(
                                       'name' => 'date_of_arrival',
									   'id'	=>	'date_of_arrival',
                                       'class' => 'form-control datepicker',
                                       'data-format' => 'dd-mm-yyyy',
                                       'value' => $country['date_of_arrival'] != '' ? d_to_lu($country['date_of_arrival']) : ''
                                    );
                                    echo form_input($attributes);
                                ?> 
                                <?php if(form_error('date_of_arrival')) { ?>
            						<?php echo form_error('date_of_arrival', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            					<?php } ?>
								
								<div class="input-group-addon">
									<a href="#"><i class="entypo-calendar"></i></a>
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
                                <div class="make-switch" data-on="primary" data-off="info">
                                    <?php
                                        $data = array(
                                            'name' => 'status',
                                            'id' => 'status',
                                            'value' => '1',
                                            'checked' => $country['status'] == '1' ? TRUE : FALSE
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
<script>
$(function() {
    $('#date_of_arrival').datepicker({
        startDate: '-0m',
		format: 'dd-mm-yyyy',     
    });
});
</script>
<script type="text/javascript">
$.get("https://code.jquery.com/ui/1.12.1/jquery-ui.js", function() {
	var availableTags = Array();
    <?php foreach($kcountries as $countries) { ?>
    	availableTags.push("<?php echo $countries->short_name; ?>");
    <?php } ?>
	$( "#country" ).autocomplete({
  		source: availableTags
	});
});
</script>
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>
<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>
