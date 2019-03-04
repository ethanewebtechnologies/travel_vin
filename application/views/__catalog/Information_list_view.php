<main>
	<section class="breadcrumbs">
		<div class="container">
			<div class="row">
				<div class="col-sm-8">
					<div class="breadcrumbs-list">
						<?php if(isset($output_breadcrumb)) {echo $output_breadcrumb;}?>
					</div>
				</div>
				<div class="col-sm-4">
					<div class="location-dropdown">
						<div class="dropdown">
							<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #fff;width: 100%;">
							<?php if(isset($country_display_name) && isset($city_display_name)){?>
							<i class="fa fa-map-marker"></i> <?php echo isset($country_display_name) ? $country_display_name : THREE_DASH; ?> &gt; <?php echo isset($city_display_name) ? $city_display_name : THREE_DASH; ?>
							<?php }else{echo $text_prefered_location;}?>
							</button>
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
								<div class="row">
									<?php foreach ($country_name as $key => $value){?>
									<div class="col-sm-3">
										<strong class="countries-title"><?php echo strtoupper($value['name']);?></strong>
										<div class="countries">
											<?php foreach ($city_name as $data){?>
											<?php if($data['country_id']==$value['id']){?>
											<a class="dropdown-item" href="<?php echo base_url('information/' . $value['seo_url'] . '/' . $data['seo_url']); ?>"><?php echo $data['name'];?></a>
											<?php }}?>
										</div>
									</div>
									<?php }?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<?php if(!empty($information)) { ?>
		<section class="main_content wow zoomIn" data-wow-duration="1s">
			<section class="container-fluid">
				<section class="row">
					<div class="banner_inr_pg">
						<?php if(isset($information['image']) && file_exists($information['image'])) { ?>
							<?php 
                                $optimized = new Optimized();
                                echo $optimized->resize($information['image'], 1350, 520, array(), 'resize_crop');
                            ?>
					<?php } else { ?>
						<?php 
                            $optimized = new Optimized();
                            echo $optimized->resize('assets/img/empty.jpg', 1350, 520, array(), 'resize_crop'); 
                        ?>
					<?php } ?>
					
					<div class="inrbnr_text">
						<h2><?php echo $information['title']; ?></h2>
					</div>
					<?php echo form_open('information/' . $information['country_name'] . '/' . $information['city_name']); ?>
    					<!--<div class="tour_sel">
    						<div class="country_sel">
    							<div class="select-style">
    								<select>
    									<option><?php echo $information['country_name']; ?></option>
    								</select>
    							</div>
    						</div>
    						<div class="city_sel">
    							<div class="select-style">
    								<select id="mycity" onchange="myFunction()">
    									<option><?php echo $information['city_name']; ?></option>
    								</select>
    							</div>
    						</div>
    					</div>-->
    				<?php echo form_close();  ?>	
				</div>
			</section>
		</section>
	</section>
	<section class="para_content_blk">
		<section class="container">
			<section class="row">
				<div class="col-sm-12">
					<div class="sec_title wow flipInX" data-wow-delay="0.5s">
						<h2 class="udr">
							<?php echo $information['title']; ?>
						</h2>
						<img src="<?php echo base_url('assets/img/aro_down.png'); ?>" alt=""/>
					</div>
				</div>
			</section>
			<section class="row">
				<div class="col-sm-12">
					<div class="single_para_blk wow pulse" data-wow-delay="0.7s">
						<?php if($information['title']) { ?>
    						<div class="para_text">
    							<h3>
    								<span class="udr"><?php echo $information['title']; ?></span> <?php echo $text_overview;?>
    							</h3>
    							<p>
    								<?php echo html_entity_decode($information['overview']); ?>
    							</p>
    						</div>
						<?php } ?>
						<?php if($information['information']) { ?>
    						<div class="para_text">
    							<h3><?php echo $text_information;?></h3>
    							<p>
    								<?php echo html_entity_decode($information['information']); ?>
    							</p>
    						</div>
    					<?php } ?>	
    					<?php if($information['things_to_do']) { ?>
    						<div class="para_text">
    							<h3><?php echo $text_things_to_do;?> <span class="udr"><?php echo $information['title']; ?></span></h3>
    							<p>
    								<?php echo html_entity_decode($information['things_to_do']); ?>
    							</p>
    						</div>
    					<?php } ?>	
					</div>
				</div>
			</section>
		</section>
	</section>
	<section class="map_blk">
		<section class="container-fluid">
			<section class="row">
				<div class="col-sm-12 no-padding">
					<div class="map" onload="initMap();">
						<div id="map" style="width: 100%; height: 300px">
							<div id="map_canvas" style="width:100%; height: 300px"></div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
	<?php } else { ?>
		<h3 class="no_records"><img src="<?php echo base_url('assets/img/NoRecordFound.png'); ?>" alt=""></h3>
	<?php } ?>
</main>
<script>

function myFunction() {
    //var x = document.getElementById("mySelect").value;
	//alert($('#mycity').val());
	$('.inrbnr_text h2').text($('#mycity').val());
	$('.udr').text($('#mycity').val());
    //document.getElementById("demo").innerHTML = "You selected: " + x;
}
</script>
<script type="text/javascript">
	var map;
    var centerChangedLast;
    var reverseGeocodedLast;
    var currentReverseGeocodeResponse;

    var initMap = function() {
		<?php if($information['lattitude'] == '' && $information['longitude'] == '') { ?>
			var latlng = new google.maps.LatLng(28.6618976, 77.2273958);
		<?php }	else { ?>
	 		var latlng = new google.maps.LatLng(<?php echo $information['lattitude']; ?>, <?php echo $information['longitude']; ?>);
		<?php } ?>

        var myOptions = {
        	zoom: 10,
        	center: latlng,
        	mapTypeId: google.maps.MapTypeId.ROADMAP
    	};
    	
    	map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
   	 	geocoder = new google.maps.Geocoder();

        var marker = new google.maps.Marker({
            position: latlng,
            map: map,
            title: "We are here"
        });
	}
</script>
<script>
$(document).ready(function() {
	$.getScript( "https://maps.googleapis.com/maps/api/js?key=<?php echo GOOGLE_API_KEY; ?>&libraries=places&callback=initMap", function( data, textStatus, jqxhr ) {
	  console.log( data ); // Data returned
	  console.log( textStatus ); // Success
	  console.log( jqxhr.status ); // 200
	  console.log( "Load was performed." );
	});
});
</script>