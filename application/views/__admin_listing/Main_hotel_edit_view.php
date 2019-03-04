<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );

            echo form_open('admin/listing/main-hotel/edit?secure_token=' . $this->security_lib->encrypt($hotel['id']), $attributes);
        ?>
        	<h2>
        		Edit Hotel Details
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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/listing/main-hotel'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </span>
        	</h2>
            <div class="panel panel-primary">
                <div class="panel-body">
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Hotel Name: ', 'name', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'name',
                                    'onkeyup' => 'lettersOnly(this);',
                                    'autocomplete' => 'off',
                                    'placeholder' => 'Please Enter Hotel',
                                    'class' => 'form-control',
                                    'value' => set_value('name', $hotel['name']),
                                    'data-validate' => 'required, minlength[3], maxlength[255]',
                                    'data-message-required' => 'Hotel Name is Required'
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('name')) { ?>
                				<?php echo form_error('name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                			
                            <?php echo form_hidden('current_hotel_name', $hotel['name']); ?>
                        </div>
                    </div>
                    <div class="form-group">
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
        
                                echo form_dropdown($attributes, $countries, $hotel['country_id']);
                            ?>
                            <?php if(form_error('country_id')) { ?>
                                <?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                            <?php } ?>
                            
                            <?php echo form_hidden('current_country', $hotel['country_id']); ?>
                        </div>
                    </div>
                    <div class="form-group">
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
                                    'class' => 'form-control',
                                    'id' => 'city',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Please select city'
                                );
                                
                                echo form_dropdown($attributes, $cities, $hotel['city_id']);
                            ?>
                            <?php if(form_error('city_id')) { ?>
                            	<?php echo form_error('city_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                            <?php } ?>
                            
                            <?php echo form_hidden('current_city', $hotel['city_id']); ?>
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
                                            'checked' => $hotel['status'] == '1' ? TRUE : FALSE
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
        url: "<?php echo base_url('admin/listing/main-hotel/get-cities-by-country-id'); ?>",
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
<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>