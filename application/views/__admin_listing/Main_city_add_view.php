<script src="https://maps.googleapis.com/maps/api/js?sensor=false&libraries=places&language=en&key=<?php echo GOOGLE_API_KEY; ?>"></script>

<div class="row">
	<div class="col-md-12">
		<?php 
            $attributes = array(
              'class' => 'form-horizontal form-groups-bordered validate'
            );
            
            echo form_open('admin/listing/main-city/add', $attributes); 
		?>
            <h2>
        		<?php echo "Add City Details"; ?> 
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
                	<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/listing/main_city'); ?>">
            			<i class="entypo-cancel"></i> Cancel
            		</a>
				</span>
			</h2>
			<div class="panel panel-primary">
    			<div class="panel-body">
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
                                    'id' => 'country_id',
                                    'onchange' => 'setCountry(this)',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => 'Please select Country'
                                );                               
                                
                                echo form_dropdown($attributes, $countries, set_value('country_id'));
                            ?>
                            <?php if(form_error('country_id')) { ?>
            					<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>  
                    	</div>  
    				</div>
    				<div class="form-group <?php if(form_error('name')) { echo 'validate-has-error'; } ?>">
                    	<?php
                    	
                    	    $attributes = array(
                    	        'class' => 'col-sm-3 control-label'
                    	    );
                    	    
                        	echo form_label('City Name: ', 'name', $attributes);
                        ?>
                        
                        <div class="col-sm-8">
                            <?php 	
                            	$attributes = array(
                            	    'name' => 'name',
                            	    'onkeyup' => 'lettersOnly(this);',
                            	    ' autocomplete' => 'off',
                            	    'placeholder' => 'Please Enter City Name',
                            	    'id' => 'tv_city_name',
                            	    'onblur' => 'setCity(this),showMap(this.value);',
                            	    'class' => 'form-control',
									'value' => set_value('name'),
                            	    'data-validate' => 'required, minlength[3], maxlength[255]',
                            	    'data-message-required' => 'City Name is Required'
                            	);
                            	
                            	echo form_input($attributes);
                        	?>
                        	<?php if(form_error('name')) { ?>
            					<?php echo form_error('name', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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
                    	    
                        	echo form_label('', 'longitude', $attributes);
                    	?>
                    	<div class="col-sm-8">
                    		<?php
                            	$attributes = array(
                            	    'type' => 'hidden',
                            	    'name' => 'longitude',
                            	    'placeholder' => 'Please Enter Longitude',
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
                    	    
                        	echo form_label(' ', 'lattitude', $attributes);
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
	/* var input = document.getElementById('autocomplete');
	var autocomplete = new google.maps.places.Autocomplete(input, {
		types: ['(cities)']
	});

	google.maps.event.addListener(autocomplete, 'place_changed', function() {
		var place = autocomplete.getPlace(); 

		document.getElementById('autocomplete').value = place.name;
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
	setCountry = function (obj) {
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

		       	$('#lon').val(longitude);
				$('#lat').val(latitude);

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
		  	}
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
<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>
