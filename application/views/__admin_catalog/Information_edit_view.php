<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
			    'class' => 'form-horizontal form-groups-bordered validate'
            );
				
			echo form_open_multipart('admin/catalog/information/edit?secure_token=' . $this->security_lib->encrypt($information['id']), $attributes); 
        ?>
			<h2>
				Edit Information Details
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
							
							echo form_label('Images: ', 'image', $attributes);
						?>
						<div class="col-sm-8">
							<div class="fileinput fileinput-new" data-provides="fileinput">
								<input type="hidden" value="<?php echo set_value('upload_check_image', $information['image']); ?>" name="upload_check_image">
								
								<div class="fileinput-new thumbnail" style="width: 200px; height: 100px;" data-trigger="fileinput">
									<?php if(isset($information['image'])) { ?>
										<?php 
										   $optimized = new Optimized();
										   echo $optimized->resize($information['image'], 200, 100, array(), 'resize_crop');
										?>
									<?php } else { ?>
										<?php
                                            $optimized = new Optimized();
                                            echo $optimized->resize('content/image/main/empty/empty.jpg', 200, 100, array(), 'resize_crop'); 
                                        ?>
									<?php } ?>
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
								    //'onchange' => 'setCountry(this)',
									'id'	=>  'country',
								    'data-validate' => 'required',
								    'data-message-required' => 'Please select country'
								);
																	
								echo form_dropdown($attributes, $countries, set_value('country_id', $information['country_id']));
							?>
							<?php if(form_error('country_id')) { ?>
            					<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
            				
            				<?php echo form_hidden('current_country', $information['country_id']); ?>
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
									'name' => 'city_id',
									'class' => 'form-control',
									'id' => 'city',
								    'onchange' => 'setCity(this);',
								    'data-validate' => 'required',
								    'data-message-required' => 'Please select city'
								);
								
								echo form_dropdown($attributes, $cities, set_value('city_id', $information['city_id']));
							?>
							
							<?php if(form_error('city_id')) { ?>
            					<?php echo form_error('city_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
							
							<?php echo form_hidden('current_city', $information['city_id']); ?>
							<span id="city_error_text" style="color:red;"></span>
						</div>
					</div>
					<div class="form-group">
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
									'id' => 'lattitude',
									'class' => 'form-control',
									'value' => set_value('lattitude', $information['lattitude']) 
								);
						
								echo form_input($attributes, $information['lattitude']);
							?>
						</div>
					</div>
					<div class="form-group <?php if(form_error('longitude')) { echo 'validate-has-error'; } ?>">
						<?php
							$attributes = array(
								'class' => 'col-sm-3 control-label'
							);
				
							echo form_label('', 'longitude', $attributes);
						?>
						<div class="col-sm-8">
							<?php
								$attributes = array(
									'name' => 'longitude',
								    'type' => 'hidden',
									'class' => 'form-control',
									'id' => 'longitude',
									'value' => set_value('longitude', $information['longitude']) 
								);
						
								echo form_input($attributes, $information['longitude']);
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
                                            'checked' => $information['status'] == 1 ? TRUE : FALSE
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
												'class' => 'form-control',
												'value' => set_value('details[' . $language['code'] . '][title]', $information_details[$language['code']]['title']) ,
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
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][overview]', $information_details[$language['code']]['overview']))   
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
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][information]', $information_details[$language['code']]['information']))
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
											    'value' => html_entity_decode(set_value('things_to_do', $information_details[$language['code']]['things_to_do']))  
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
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][meta_title]', $information_details[$language['code']]['meta_title']))  
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
											    'value' => html_entity_decode(set_value('details[' . $language['code'] . '][meta_dsc]', $information_details[$language['code']]['meta_dsc']))  
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
											    'data-validate' => "maxlength[255]",
											    'value' => html_entity_decode(set_value('meta_keywords', $information_details[$language['code']]['meta_keywords']))
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
<script type = "text/javascript">
        /* $('#city').on('change', function() {
        	$.ajax({
        		type: "GET",
        		url: "<?php echo base_url('admin/catalog/information/get_long_latt_by_city_id'); ?>",
        		data: {city_id: this.value},
        		dataType: "json",
        		success: function(res) {               
        			$("#lattitude").val(res.lattitude);
        			$("#longitude").val(res.longitude);
        		}			   
           });
        	 $.ajax({
        		type: "GET",
        		url: "<?php echo base_url('admin/catalog/information/get_row_information_tbl_by_city_id'); ?>",
        		data: {city_id: this.value},
        		dataType: "json",
        		success: function(res) {
        			console.log(res);
        			if(res==TRUE){
        				$("#city_error_text").html('City already added');
        			}
        			else{
        				$.ajax({
        					type: "GET",
        					url: "<?php echo base_url('admin/catalog/information/get_long_latt_by_city_id'); ?>",
        					data: {city_id: this.value},
        					dataType: "json",
        					success: function(res) {               
        						$("#lattitude").val(res.lattitude);
        						$("#longitude").val(res.longitude);
        					}			   
        			   });
        			}
        		}			   
           }); 
        	
        });
        */
</script>
<script>

/* var input = document.getElementById('city_name');
var autocomplete = new google.maps.places.Autocomplete(input,{types: ['(cities)']});

google.maps.event.addListener(autocomplete, 'place_changed', function() {
	var place = autocomplete.getPlace(); 
    document.getElementById('city_name').value = place.name;
	document.getElementById('lattitude').value = place.geometry.location.lat();
	document.getElementById('longitude').value = place.geometry.location.lng();
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
    <?php if($information['lattitude'] == '' && $information['longitude'] == '') { ?>
		var latlng = new google.maps.LatLng(28.6618976, 77.2273958);
	<?php } else { ?>
		var latlng = new google.maps.LatLng(<?php echo $information['lattitude']; ?>,<?php echo $information['longitude']; ?>);
	<?php } ?>
		
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
			$('#longitude').val(longitude);
			$('#lattitude').val(latitude);
      });
  }
</script>

<script type="text/javascript">
/* 	setCountry = function (obj) {
		var country = obj.options[obj.selectedIndex].innerHTML;
		changeMap(country);
	};

	setCity = function (obj) {
		var city = obj.value;
		changeMap(city);
	};

	var changeMap = function(address) {
		var geocoder = new google.maps.Geocoder();
		geocoder.geocode({ 'address': address}, function(results, status) {
		  	if (status == google.maps.GeocoderStatus.OK) {
		  		var latitude = results[0].geometry.location.lat();
                var longitude = results[0].geometry.location.lng();

		       	var latlng = new google.maps.LatLng(latitude, longitude);

		       	$('#longitude').val(longitude);
				$('#lattitude').val(latitude);

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
	                $('#longitude').val(longitude);
	    			$('#lattitude').val(latitude);
	            });
		  	}
		});
	}; */
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

   