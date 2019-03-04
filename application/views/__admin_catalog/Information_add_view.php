<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en&key=<?php echo GOOGLE_API_KEY; ?>"></script>

<div class="row">
	<div class="col-md-12">
		<?php 
			$attributes = array(
			  'class' => 'form-horizontal form-groups-bordered validate'
			 
			);
			
			echo form_open_multipart('admin/catalog/information/add', $attributes); 
		?>
			<h2>
				Add Information Details 
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
					<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/catalog/information'); ?>">
						<i class="entypo-cancel"></i> Cancel
					</a>
				</span>
			</h2>
			<div class="panel panel-primary">
				<div class="panel-body">
					<div class="form-group <?php if(form_error('upload_image')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
				
							echo form_label('Image:', 'image', $attributes);
						?>
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<input type="hidden" value="<?php echo set_value('upload_image_check'); ?>" name="upload_image_check">
								<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
									<?php
                                        $optimized = new Optimized();
                                        
                                        if(isset($upload_image_path)) { 
                                            echo $optimized->resize($upload_image_path, 200, 100, array(), 'resize_crop');
                                        } else {
                                            echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop');
                                        }
									?>
								</div>
								
								<div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 100px; line-height: 10px;"></div>
								
								<div>
									<span class="btn btn-white btn-file">
										<span class="fileinput-new">Select image</span>
										<span class="fileinput-exists">Change</span>
										<input type="file" name="upload_image" accept="image/*">
									</span>
									<a href="#" class="btn btn-orange fileinput-exists" data-dismiss="fileinput">Remove</a>
								</div>
							</div>
							<br>
							<?php if(form_error('upload_image')) { ?>
        						<?php echo form_error('upload_image', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        					<?php } ?>
						</div>
					</div>	
					<div class="form-group <?php if(form_error('country_id')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'                    	        
							);
							
							echo form_label('Country: ', 'country_id', $attributes);
						?>
						<div class="col-sm-8">
							<?php 
								$attributes = array(
									'name' => 'country_id',
									'class' => 'form-control',
									'id'	 =>  'country',
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
							
							echo form_label('City: ', 'city_id', $attributes);
						?>
						<div class="col-sm-8">
							<?php 
								$attributes = array(
									'id' => 'city_id',
									'name' => 'city_id',
								    'onchange' => 'setCity(this),showMap(this.value)',
									'class' => 'form-control',
									'id' => 'city',
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
					 <div class="form-group hide" id="map-location">
                    	<?php
                    	   $attributes = array(
                    	       'class' => 'col-sm-3 control-label'
                    	   );
                    	   
                    	   echo form_label('Set Location:', 'location', $attributes);
                    	?>
                    	<div class="col-sm-8">
							<div class="map" onload="();">
								<div id="map" style="width:100%; ">
									<div id="map_canvas" style="width:100%; height:300px"></div>
           	 						<div id="crosshair"></div>
								</div>
							</div>
                    	</div>
                    </div>
					<div class="form-group">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
				
							echo form_label('', 'lattitude', $attributes);
						?>
						<div class="col-sm-8">
							<?php
								$attributes = array(
								    'type' => 'hidden',
									'name' => 'lattitude',
									'class' => 'form-control',
								    'id' => 'lat',
									'value' => set_value('lattitude')
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
				
							echo form_label('', 'longitude', $attributes);
						?>
						<div class="col-sm-8">
							<?php
								$attributes = array(
								    'type' => 'hidden',
									'name' => 'longitude',
									'class' => 'form-control',
									'id' => 'lon',	
									'value' => set_value('longitude')  
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
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][title]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
							
										echo form_label('Title: ', 'title', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][title]',
												'placeholder' => 'Please Enter Title',
												'class' => 'form-control',
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][title]')),
											    'data-validate' => 'required, minlength[3], maxlength[255]',
											    'data-message-required' => 'Title Name required for English atleast'
											);
									
											echo form_input($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][title]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][overview]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
							
										echo form_label('Overview:', 'overview', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][overview]',
												'class' => 'form-control ckeditor',
											    'id' => 'my-textarea',
												'placeholder' => 'Please Enter Overview',
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][overview]')),
											);
    											echo form_textarea($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][overview]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][overview]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][information]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
							
										echo form_label('Information:', 'information', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][information]',
												'class' => 'form-control ckeditor',
												'placeholder' => 'Please Enter Information',
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][information]')),
											);
											
											echo form_textarea($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][information]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][information]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][things_to_do]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
							
										echo form_label('Things to do:', 'things_to_do', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][things_to_do]',
												'class' => 'form-control ckeditor',
												'placeholder' => 'Please Enter Things To Do',
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][things_to_do]'))
											);
									
											echo form_textarea($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][things_to_do]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][things_to_do]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][meta_title]')) { echo 'validate-has-error'; } ?>">	
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
										
										echo form_label('Meta Title: ', 'meta_title', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][meta_title]',
												'placeholder' => 'Please Enter Meta Title',
												'class' => 'form-control',
											    'data-validate' => "maxlength[255]",
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][meta_title]'))
											);
											
											echo form_input($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][meta_title]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][meta_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
									
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][meta_dsc]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
								
										echo form_label('Meta Description:', 'meta_dsc', $attributes);
									?>
									
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][meta_dsc]',
												'placeholder' => 'Please Enter Meta Description',
												'class' => 'form-control',
											    'data-validate' => "maxlength[255]",
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][meta_dsc]'))
											);
									
											echo form_textarea($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][meta_dsc]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][meta_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            							<?php } ?>
									</div>
								</div>
								<div class="form-group <?php if(form_error('details[' . $language['code'] . '][meta_keywords]')) { echo 'validate-has-error'; } ?>">
									<?php
										$attributes = array(
											'class' => 'col-sm-3 control-label'
										);
							
										echo form_label('Meta Keywords:', 'meta_keywords', $attributes);
									?>
									<div class="col-sm-8">
										<?php
											$attributes = array(
												'name' => 'details[' . $language['code'] . '][meta_keywords]',
												'class' => 'form-control',
												'placeholder' => 'Please Enter Meta Keywords',
											    'data-validate' => "maxlength[255]",
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][meta_keywords]'))
											);
											
											echo form_input($attributes);
										?>
										<?php if(form_error('details[' . $language['code'] . '][meta_keywords]')) { ?>
            								<?php echo form_error('details[' . $language['code'] . '][meta_keywords]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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

<script src="<?php echo base_url('assets/admin/js/ckeditor/ckeditor.js'); ?>"></script>

<script>
$('#country').on('change', function() {
	$.ajax({
		type: "GET",
		url: "<?php echo base_url('admin/catalog/information/get_cities_by_country_id'); ?>",
		data: {country_id: this.value},
		dataType: "json",
		success: function(res) {               
			if(res) {
				$("#city").empty();
				$("#city").append('<option value="">--- Select City ---</option>');

				for(var i = 0; i < res.length; i++) {
					$("#city").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
				}
		   }
		}			   
   });
});
</script>

<script>

/* var input = document.getElementById('city_name');
var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});

google.maps.event.addListener(autocomplete, 'place_changed', function() {
	var place = autocomplete.getPlace(); 
    document.getElementById('city_name').value = place.name;
	document.getElementById('lat').value = place.geometry.location.lat();
	document.getElementById('lon').value = place.geometry.location.lng();
}); */
</script>
<script type="text/javascript">
$.getScript( "https://maps.googleapis.com/maps/api/js?key=AIzaSyAwlV_4BSqd2dh--uSwgWVLIdqIQ8mCemQ&libraries=places&callback=initMap", function( data, textStatus, jqxhr ) {
    console.log( data ); // Data returned
    console.log( textStatus ); // Success
    console.log( jqxhr.status ); // 200
    console.log( "Load was performed." );
});

var map;
var centerChangedLast;
var reverseGeocodedLast;
var currentReverseGeocodeResponse;
		
var initMap = function() {
    <?php //if($class['lat'] == '' && $class['lon'] == '') { ?>
		var latlng = new google.maps.LatLng(28.6618976, 77.2273958);
	<?php //} else { ?>
		 // var latlng = new google.maps.LatLng(<?php //echo $class['lat']; ?>,<?php //echo $class['lon']; ?>);
	<?php //} ?>
		
      var myOptions = {
          zoom: 10,
          center: latlng,
          mapTypeId: google.maps.MapTypeId.ROADMAP
      };
      
      map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

      var marker = new google.maps.Marker({
          position: latlng,
          map: map,
          draggable: true,
          title: "We are here"
      });

      google.maps.event.addListener(marker, 'dragend', function (event) {
          var latitude = event.latLng.lat();
          var longitude = event.latLng.lng();
			$('#lon').val(longitude);
			$('#lat').val(latitude);
      });
  }
</script>

 <script type="text/javascript">
	var setCountry = function (obj) {
		var country = obj.options[obj.selectedIndex].innerHTML;
		changeMap(country);
	};

	var setCity = function (obj) {
		$.ajax({
			type: "GET",
			url: "<?php echo base_url('admin/catalog/information/get_long_latt_by_city_id'); ?>",
			data: {city_id: obj.value},
			dataType: "json",
			success: function(res) {               
				$("#lat").val(res.lattitude);
				$("#lon").val(res.longitude);

				changeMap(res.lattitude, res.longitude);   
			}			
	   });
	};

	var changeMap = function(lattitude, longitude) {

       	var latlng = new google.maps.LatLng(lattitude, longitude);

       	$('#lon').val(longitude);
		$('#lat').val(lattitude);

    	var myOptions = {
            zoom: 5,
            center: latlng,
            mapTypeId: google.maps.MapTypeId.ROADMAP
        };
        
     	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	
        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            draggable: true,
            title: "We are here"
        });

        google.maps.event.addListener(marker, 'dragend', function (event) {
            var latitude = event.latLng.lat();
            var longitude = event.latLng.lng();
			$('#lon').val(longitude);
			$('#lat').val(latitude);
        });
	};
</script>
<script type="text/javascript">
function showMap(value){
	if(value!=''|| value!='undefined'){
		$("#map-location").removeClass('hide');
	}
	else{
		$("#map-location").addClass('hide');
	}
}
</script>
   