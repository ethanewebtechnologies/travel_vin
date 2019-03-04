<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );

            echo form_open('admin/listing/main-airport/add', $attributes);
        ?>
            <h2>
                Add airport Details
                <span class="pull-right btn-toolbar">
                    <?php
                        $attributes = array(
                            'name' => 'add',
                            'id' => 'add',
                            'value' => 'Add',
                            'type' => 'submit',
                            'content' => '<i class="entypo-plus"></i> Add',
                            'class' => 'btn btn-blue btn-icon icon-left'
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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/listing/main-airport'); ?>">
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
        
                            echo form_label('Airport Name: ', 'name', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'name',
                                    'onkeyup' => 'lettersOnly(this);',
                                    ' autocomplete' => 'off',
                                    'placeholder' => 'Please Enter Airport Name',
                                    'class' => 'form-control',
                                    'value' => set_value('name'),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => 'Airport Name is Required'
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('name')) { ?>
            					<?php echo form_error('name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                        </div>
                    </div>

                    <div class="form-group <?php if(form_error('country_id')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Country Name: ', 'country_id', $attributes);
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
                                
                                echo form_dropdown($attributes, $countries, set_value('country_id'));
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
        
                            echo form_label('City Name: ', 'city_id', $attributes);
                        ?>
                    	
                    	<div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'city_id',
                                    'id' => 'city',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Please select city'
                                );
                                echo form_dropdown($attributes, $cities, set_value('city_id'));
                            ?>
                            <?php if(form_error('city_id')) { ?>
                            	<?php echo form_error('city_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
            	</div>
        	</div>
        <?php echo form_close(); ?>
    </div>
</div>
<script>
$('#country').on('change', function () {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/listing/main-airport/get-cities-by-country_id'); ?>",
        data: {country_id: this.value},
        dataType: "json",
        success: function (res) {
            if (res) {
                $("#city").empty();
                $("#city").append('<option value="">--- Please Select City ---</option>');

                for (var i = 0; i < res.length; i++) {
                    $("#city").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                }
            }
        }
    });
});
</script>
<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>
