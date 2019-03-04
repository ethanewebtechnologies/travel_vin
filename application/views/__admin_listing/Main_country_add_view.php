<style>
    .d2o {
        width: 100%;
        height: 100px;
        overflow-y: scroll;
        border-left: 2px;
        border-top: 2px;
        border-bottom: 2px;
        border-color: #F1F1F1;
        border-style: solid;
        padding: 0px;
    }
    
    .d2o .c2o {
        margin: 0px;
        padding: 0px;
        display: block;
    }
</style>	
	
<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered validate'
            );
            echo form_open('admin/listing/main-country/add', $attributes); 
		?>
			<h2>
        		Add Country Details
                <span class="pull-right btn-toolbar">
					<?php
                        $attributes = array(
                            'name'          => 'add',
                            'id'            => 'add',
                            'value'         => 'Add',
                            'type'          => 'submit',
                            'content'       => '<i class="entypo-plus"></i> Add',
                            'class'         => 'btn btn-blue btn-icon icon-left'
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
                	<div class="form-group <?php if(form_error('continent')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	        $attributes = array(
                    	            'class' => 'col-sm-3 control-label'
                    	        );
                            	echo form_label('Continent Name: ', 'name', $attributes);
                            	?>
                        <div class="col-sm-8">
            				<select name="continent" class="form-control" id="continent" data-validate= "required" data-message-required = "Please select continent">
                				<option value="">
                					<?php echo "Please Select Continent"; ?>
                				</option>
                				<?php foreach($static_continents as $continent) { ?>
                					<option value="<?php echo $continent['code']; ?>">
                						<?php echo $continent['name']; ?>
                					</option>
                				<?php } ?>
            				</select>
            				<?php if(form_error('continent')) { ?>
            					<?php echo form_error('continent', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
				 		</div>    	
                    </div>
					
					<div class="form-group <?php if(form_error('countries[]')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label',
                    	       
                    	    );
                    	    
                        	echo form_label('Country Name: ', 'countries[]', $attributes);
                        ?>
                        
						<div class="col-sm-8">
							<div class="d2o" id="multi-countries" data-validate="required" data-message-required ="please select country" ></div>
							<?php if(form_error('countries[]')) { ?>
								<?php echo form_error('countries[]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
							<?php } ?> 
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
									   'value' => set_value('date_of_arrival'),
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
                                            'checked' => TRUE
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
$('#continent').on('change', function() {
    $.ajax({
    	url: "<?php echo base_url('admin/listing/main-country/get_country'); ?>",
    	type: "get",
    	dataType: "json",
    	data: {continent_code: this.value},
    	success: function(result) {
			var html = '';
        	
			for(var i = 0; i < result.length; i++) {
				html += '<label class="c2o"><input type="checkbox" name="countries[]" value="' + result[i]['name'] + '"> ' + result[i]['name'] + '</label>';
			} 
        	
    		$('#multi-countries').html(html);
    	}
    });
});
</script>
	
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>