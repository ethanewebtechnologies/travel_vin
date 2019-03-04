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
						<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #fff;">
						<?php if(isset($country_display_name) && isset($city_display_name)){?>
						<i class="fa fa-map-marker"></i> <?php echo isset($country_display_name) ? $country_display_name : THREE_DASH; ?> &gt; <?php echo isset($city_display_name) ? $city_display_name : THREE_DASH; ?>
						<?php }else{echo $text_prefered_location;}?>
						</button>
						<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
							<div class="row">
								<?php foreach ($country_name as $key => $value){?>
								<div class="col-sm-3">
									<strong style="color:#FF7101;    font-size: 13px;font-weight: 500;"><?php echo strtoupper($value['name']);?></strong>
									<div class="countries">
										<?php foreach ($city_name as $data){?>
										<?php if($data['country_id']==$value['id']){?>
										<a class="dropdown-item" href="<?php echo base_url('transportation/' . $value['seo_url'] . '/' . $data['seo_url']); ?>" style="color:#337ab7;font-size: 12px;font-weight: 500;"><?php echo $data['name'];?></a>
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
<section class="tourdescription_blk transportinfo_blk wow zoomIn" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: zoomIn;">
<section class="container-fluid">
<section class="row">
<div class="col-sm-5">
<div class="tour_form_wrap">
<div class="tourform_blk">
	<h3><?php echo $text_trip_information;?></h3>
	<?php 
	$ci= & get_instance();
	echo $ci->session->userdata('msg-error');
		$attributes = array(
		'class' => 'form-horizontal form-groups-bordered',
		'method'=>'get'
		);
		echo form_open('',$attributes); 
	?>
	<div class="form-group">
		<label><?php echo $label_transportation_type;?></label>
		<select id="addtrip" name="transport_type" data-validation="required" data-validation-error-msg="<?php echo $dv_transportation_type;?>">
			<option value="">--<?php echo $select_transportation_type;?>--</option>
			<option value="round_trip" <?php if(isset($p_transport_type) && $p_transport_type=='round_trip'){echo 'selected';}?>><?php echo $option_round_trip;?></option>
			<option value="air_to_htl_trip" <?php if(isset($p_transport_type) && $p_transport_type=='air_to_htl_trip'){echo 'selected';}?>><?php echo $option_air_to_htl;?></option>
			<option value="htl_to_air_trip" <?php if(isset($p_transport_type) && $p_transport_type=='htl_to_air_trip'){echo 'selected';}?>><?php echo $option_htl_to_air;?></option>
		</select>
	</div>
	<div class="form-group">
		<label><?php echo $label_airport;?></label>
		<select name="airport_id" name="airport_id" data-validation="required" data-validation-error-msg="<?php echo $dv_airport;?>">
		<option value="">--- <?php echo $select_airport;?> ---</option>
		<?php if(isset($airports) && !empty($airports)){
			foreach ($airports as $airport_id => $airport_name) { ?>
			<option value="<?php echo $airport_id; ?>" <?php if(isset($p_airport_id) && $p_airport_id==$airport_id){echo 'selected';}?>>
			<?php echo $airport_name; ?>
			</option>
		<?php }} ?>
		</select>
	</div>
	<div class="form-group">
		<label><?php echo $label_hotel;?></label>
		<select name="hotel_id" data-validation="required" data-validation-error-msg="<?php echo $dv_hotel;?>">
		<option value="">--- <?php echo $select_hotel;?> ---</option>
			<?php if(isset($airports) && !empty($airports)){
				foreach ($hotels as $airport_id => $airport_name) { ?>
				<option value="<?php echo $airport_id; ?>" <?php if(isset($p_hotel_id) && $p_hotel_id==$airport_id){echo 'selected';}?>>
					<?php echo $airport_name; ?>
				</option>
			<?php }} ?>
		</select>
	</div>
	<div class="btn_blk">
		<input type="hidden" name="form_search_btn" value="search form"> 
		<button type="submit" class=""><?php echo $search;?></button>
	</div>
	<?php echo form_close(); ?>
</div>
<div class="pay_info_blk">
	<p><?php echo $text_payment_message;?></p>
	<div>
		<ul>
			<li class="sec_pay"><span></span></li>
			<li class="amipci"><span></span></li>
			<li class="paypal"><span></span></li>
		</ul>
	</div>
	<div>
		<ul>
			<li class="visa"><span></span></li>
			<li class="master"><span></span></li>
			<li class="visa"><span></span></li>
			<li class="paypl"><span></span></li>
		</ul>
	</div>
	<div>
		<ul>
			<li class="iosico"><a href=""><span></span></a></li>
			<li class="androidico"><a href=""><span></span></a></li>
		</ul>
	</div>
	<div>
		<ul>
			<li class="fblike"><span></span></li>
			<li class="fbshare"><span></span></li>
		</ul>
	</div>
	<div>
		<ul>
			<li class="tweet"><span></span></li>
		</ul>
	</div>
	<div>
		<ul>
			<li class="gplus"><span></span></li>
		</ul>
	</div>
</div>
</div>
</div>
<div class="col-sm-7">
<?php if(isset($transportations)){
	if(!empty($transportations)){?>
	<div class="tour_desc_wrap">
	<div class="transportation_list_wrap">
		<!--<h3><?php echo $text_choose_transportation_type;?></h3>
		<p>These are the best rates available for 1 passenger(s) on Roundtrip Transportation between 'Curacao International Airport' and 'Blue Bay Curacao' on selected dates.</p>-->
		<div class="tours_list_wrap">
		<?php 
		$attributes = array(
			'class' => 'form-horizontal form-groups-bordered'
		);
		echo form_open(); ?>
			<div class="single_list_blk">
				<div class="tourimg">
				<img src="<?php echo ($transportations['shared_image']=="")?base_url('assets/img/list-img.png'):base_url().$transportations['shared_image']; ?>" alt="">
				</div>
				<div class="tour_short_detail">
					<h3><?php echo $text_sharing;?></h3>
					<p><?php echo $transportations['shared_dsc'];?></p>
				</div>
				<div class="digonal_img">
					<img src="<?php echo base_url('assets/img/diagonalimg.png'); ?>" alt="">
				</div>
				<div class="price_detail">
					<h4><?php echo $text_from_usd;?></h4>
					<h2><?php echo "$". number_format((float)$transportations['shared_cost_per_passenger'],2,'.',''); ?>
					</h2>
					<p><?php echo $text_include_passenger;?></p>
				</div>
				<p class="radio_wrap">
			<input type="hidden" name="_pid" value="<?php echo $transportations['id'];?>">
			<input type="radio" id="test1" name="trans_type" value="Sharing"  onclick="show1();" checked="">
					<label for="test1"></label>
				</p>
			</div>
			<div class="single_list_blk">
				<div class="tourimg">
					<img src="<?php echo ($transportations['private_image']=="")?base_url('assets/img/list-img.png'):base_url().$transportations['private_image']; ?>" alt="">
				</div>
				<div class="tour_short_detail">
					<h3><?php echo $text_private;?></h3>
					<p><?php echo $transportations['private_dsc'];?></p>
				</div>
				<div class="digonal_img">
					<img src="<?php echo base_url('assets/img/diagonalimg.png'); ?>" alt="">
				</div>
				<div class="price_detail">
					<h4><?php echo $text_from_usd;?></h4>
					<h2><?php echo "$".number_format((float)$transportations['private_cost_per_passenger'],2,'.','');?></h2>
					<p><?php echo $text_include_passenger;?></p>
					<input type="hidden" name="privateprice" value="<?php echo "$".number_format((float)$transportations['private_cost_per_passenger'],2,'.','');?>">	
				</div>
				<p class="radio_wrap">
					<input type="radio" id="test2" value="private" name="trans_type" onclick="show2();">
					<label for="test2"></label>
				</p>
			</div>
			<div class="extra_info_blk">
				<h4><?php echo $fillinformation;?></h4>
				<div class="form-group">
					<label><?php echo $text_passenger;?></label>
					<input type="number" id="input_adult"  name="passenger_number" data-validation="required" data-validation-error-msg="<?php echo $dv_passenger;?>" autocomplete="off" >
					<?php echo form_error('passenger_number');?>
				</div>
				<?php if($p_transport_type=='round_trip' || $p_transport_type=='air_to_htl_trip'){?>
				<div class="form-group">
					<label><?php echo $text_arrival_date;?></label>
					<input type="text" id="datepicker1" class="datepicker" data-validation="required" data-validation-error-msg="<?php echo $dv_arrival_date;?>" name="arrival_date" autocomplete="off">
					<?php echo form_error('arrival_date');?>
				</div>
				<div class="form-group">
					<label><?php echo $arrivaltime;?></label>
					<input id="timepicker2" type="text" name="arrival_time" class="input-small" data-validation="required" data-validation-error-msg="<?php echo $dv_arrival_time;?>" autocomplete="off">
					<?php echo form_error('arrival_time');?>
				</div>
				<div class="form-group">
					<label><?php echo $airline;?></label>
					<input type="text" name="air_line_name" data-validation="required length" data-validation-length = "<?php echo $dv_length;?>" autocomplete="off">
					<?php echo form_error('air_line_name');?>
				</div>
				<div class="form-group">
					<label><?php echo $flightnumber;?></label>
					<input type="text" name="flight_number" data-validation="required length" data-validation-length = "<?php echo $dv_length;?>" autocomplete="off">
					<?php echo form_error('flight_number');?>
				</div>
				<?php }?>
				<?php if($p_transport_type=='round_trip' || $p_transport_type=='htl_to_air_trip'){?>
				<div class="form-group">
					<label><?php echo $text_dept_date;?></label>
					<input type="text" id="datepicker2" class="datepicker" name="departure_date" data-validation="required" data-validation-error-msg="<?php echo $dv_departure_date;?>" autocomplete="off">
					<?php echo form_error('departure_date');?>
				</div>
				<div class="form-group">
					<label><?php echo $departuretime;?></label>
					<input id="timepicker3" type="text" name="departure_time" class="input-small" data-validation="required" data-validation-error-msg="<?php echo $dv_departure_time;?>" autocomplete="off">
					<?php echo form_error('departure_time');?>
				</div>
				<div class="form-group">
					<label><?php echo $airline;?></label>
					<input type="text" name="dept_air_line_name" data-validation="required length" data-validation-length = "<?php echo $dv_length;?>" autocomplete="off">
					<?php echo form_error('dept_air_line_name');?>
				</div>
				<div class="form-group">
					<label><?php echo $flightnumber;?></label>
					<input type="text" name="dept_flight_number" data-validation="required length" data-validation-length = "<?php echo $dv_length;?>" autocomplete="off">
					<?php echo form_error('dept_flight_number');?>
				</div>
				<?php }?>
				<input type="hidden" name="triptype" id="triptype" value="<?php echo $p_transport_type;?>">
				<input type="hidden" name="airportid" id="airportid" value="<?php echo $p_airport_id;?>">
				<input type="hidden" name="hotelid" id="hotelid" value="<?php echo $p_hotel_id;?>">
			</div>
			<div class="btn_blk">
				<input type="hidden" name="travel_form_btn" value="travel form"> 
				<button type="submit" class=""><?php echo $text_cart_button;?></button>
			</div>
			<?php echo form_close();?>
		</div>
	</div>
	</div>	
	<?php }else{?>
	<h3 class="no_records">
	<img src="<?php echo base_url('assets/img/NoRecordFound.png'); ?>" alt="">
	</h3>
	<?php }?>
	
<?php } else{ ?>
	<div class="tour_desc_wrap">
	<div class="tourdesc_bnr">
		<?php if(isset($transportation_banners['main']) && !empty($transportation_banners['main'])){?>
		<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<?php 
					foreach ($transportation_banners['main'] as $key => $transportation_banner) { ?>
					<?php if(isset($transportation_banner['image']) && file_exists($transportation_banner['image'])) { ?>
					<div class="item <?php echo $key == 0 ? 'active' : ''; ?>">
							<?php echo $optimized->resize($transportation_banner['image'], 1349, 521, array('class' => 'd-block w-100 img-fluid', 'alt' => $transportation_banner['title']), 'resize_crop'); ?>
					</div>
					<?php } ?>
					<?php } ?>
			 </div>
			<a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
				<span class="fa fa-angle-left" aria-hidden="true"></span>
				<span class="sr-only"><?php echo $text_previous;?></span>
			</a>
			<a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
				<span class="fa fa-angle-right" aria-hidden="true"></span>
				<span class="sr-only"><?php echo $text_next;?></span>
			</a>
		</div>
		<?php } ?>
	</div>
	<div class="tour_desc_content noshadow">
		<h3><?php echo $text_description;?></h3>
		<p><?php echo $transportation_configuration['dsc']; ?></p>
		<div class="row">
			<div class="col-sm-6">
				<?php echo $optimized->resize('assets/img/desc_img.png', 300, 200, array('class' => 'image-responsive', 'alt' => 'desc image'), 'resize_crop'); ?>
				
				<br>
				<h3 class="mt20"><?php echo $text_shared_transportation;?></h3>
				<p><?php echo $transportation_configuration['shared_dsc']; ?></p>										
			</div>
			<div class="col-sm-6">
				<?php echo $optimized->resize('assets/img/desc_img.png', 300, 200, array('class' => 'image-responsive', 'alt' => 'desc image'), 'resize_crop'); ?>
				<br>
				<h3 class="mt20"><?php echo $text_private_transportation;?></h3>
				<p><?php echo $transportation_configuration['private_dsc']; ?></p>
			</div>
		</div>
	</div>
	</div>
<?php }?>
</div>
</section>
</section>
</section>
</main>
<script>
var _booking_min_adults = parseInt("<?php echo TV_MIN_ADULT_ALLOWED ?>");
var _booking_max_adults = parseInt("<?php echo TV_MAX_ADULT_ALLOWED ?>");
$(function() {
	var arr_forbidden = [<?php echo $arr_blocked_dates; ?>];
	var dep_forbidden = [<?php echo $dep_blocked_dates; ?>];
	
	
	$("#datepicker1").datepicker({
		dateFormat:'dd-mm-yy',
		minDate: 0,
		maxDate: '+1Y+6M',
		onSelect: function (dateStr) {
			var pick_time = $("#timepicker2").val();
			validate_pickup_time(dateStr,pick_time);
			var min = $("#datepicker1").datepicker('getDate'); // Get selected date
			$("#datepicker2").datepicker('option', 'minDate', min || '0'); // Set other min, default to today
		},
		beforeShowDay: function(date) {
			var string = $.datepicker.formatDate('dd-mm-yy', date);
		    return [arr_forbidden.indexOf(string) == -1];
		}
	});

	$("#datepicker2").datepicker({ 
		dateFormat:'dd-mm-yy',
		minDate: '0',
		maxDate: '+1Y+6M',
		onSelect: function (dateStr) {
			var pick_time = $("#timepicker3").val();
			validate_pickup_time_2(dateStr,pick_time);
			var max = $("#datepicker2").datepicker('getDate'); // Get selected date
			$('#datepicker').datepicker('option', 'maxDate', max || '+1Y+6M'); // Set other min, default to today
		},
		beforeShowDay: function(date) {
			var string = $.datepicker.formatDate('dd-mm-yy', date);
		    return [dep_forbidden.indexOf(string) == -1];
		}
	});
	
	$("#timepicker2").on('change',function(){
		var pick_date = $("#datepicker1").val();
		var pick_time = $("#timepicker2").val();
		validate_pickup_time(pick_date,pick_time);
	});
	
	$("#timepicker2").timepicker({
		minuteStep: 5,
		showMeridian:false
	});
	
	
	$("#timepicker3").on('change',function(){
		var pick_date = $("#datepicker2").val();
		var pick_time = $("#timepicker3").val();
		validate_pickup_time_2(pick_date,pick_time);
	});
	
	$("#timepicker3").timepicker({
		minuteStep: 5,
		showMeridian:false
	});
});
$("#addtrip").change(function(){
	$("#triptype").val($(this).val());
});

function validate_pickup_time(pick_date,pick_time){
	//var pick_date = $("#datepicker1").val();
		
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var current_date =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	var output1 =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	if(pick_date==current_date){
		//convert both time into timestamp
		var monthNames = ["January", "February", "March", "April", "May", "June",
		  "July", "August", "September", "October", "November", "December"
		];
		
		//var pick_time = $("#timepicker2").val();
		var curr_time = d.getHours() + ":" + d.getMinutes();
		
		var pick_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ pick_time;
		var stt = new Date(pick_formated_date);
		stt = stt.getTime();
		
		var current_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ curr_time;
		var endt = new Date(current_formated_date);
		endt = endt.getTime();
		
		if(stt < endt) {
			$("#timepicker2").val(curr_time);
		}
	}
}

function validate_pickup_time_2(pick_date,pick_time){
	//var pick_date = $("#datepicker1").val();
		
	var d = new Date();

	var month = d.getMonth()+1;
	var day = d.getDate();

	var current_date =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	var output1 =  (day<10 ? '0' : '') + day + '-' +
	(month<10 ? '0' : '') + month + '-' +d.getFullYear();
	
	if(pick_date==current_date){
		//convert both time into timestamp
		var monthNames = ["January", "February", "March", "April", "May", "June",
		  "July", "August", "September", "October", "November", "December"
		];
		
		//var pick_time = $("#timepicker2").val();
		var curr_time = d.getHours() + ":" + d.getMinutes();
		
		var pick_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ pick_time;
		var stt = new Date(pick_formated_date);
		stt = stt.getTime();
		
		var current_formated_date = monthNames[d.getMonth()] +' '+ d.getDate() +' , '+d.getFullYear()+' '+ curr_time;
		var endt = new Date(current_formated_date);
		endt = endt.getTime();
		
		if(stt < endt) {
			$("#timepicker3").val(curr_time);
		}
	}
}

var num_input_total = 0; // 23
var num_input_adult = 1; // 23
var num_input_child = 0; // 0
var exceso = 0;
$('#input_adult').on('keyup change', function(){ 
  var adult_count = parseInt($(this).val());
  num_input_adult = isNaN(adult_count) ? 0 : adult_count;
  num_input_total = num_input_adult + num_input_child;
  number_type_input();
});
$('#input_child').on('keyup change', function(){
  var child_count = parseInt($(this).val());
  num_input_child = isNaN(child_count) ? 0 : child_count;
  num_input_total = num_input_adult + num_input_child;
  number_type_input();
});
function number_type_input() {
  if(num_input_total >= _booking_max_adults){
    $('#input_adult').attr('max', num_input_adult);
    $('#input_child').attr('max', num_input_child);
    if(num_input_total > _booking_max_adults){
      if (num_input_adult >= 1){
        if(num_input_adult > _booking_max_adults){
          exceso = num_input_total - _booking_max_adults; // 7
          num_input_total = num_input_total - exceso; // 16 = 23 - 7
          num_input_adult = num_input_adult - exceso; // 16 = 23 - 7
        } else {
          exceso = num_input_total - _booking_max_adults; // 3
          num_input_total = num_input_total - exceso; // 16
          num_input_child = num_input_child - exceso; // 6
        }
        $('#input_adult').attr('max', num_input_adult);
        $('#input_child').attr('max', num_input_child);
      }
      if(num_input_adult < 1){
        exceso = num_input_total - _booking_max_adults; // 3
        num_input_total = num_input_total - exceso; // 16
        exceso = exceso + 1; // 4
        num_input_child = num_input_child - exceso; // 15
        num_input_adult = num_input_adult + 1; // 1
        $('#input_adult').attr('max', num_input_adult);
        $('#input_child').attr('max', num_input_child);
      }
    }
  }
  if(num_input_total <= _booking_max_adults){
    if(num_input_adult < 1){
      if(num_input_child == _booking_max_adults){
        num_input_child = num_input_child - 1;
      }
      num_input_adult = num_input_adult + 1; // 1
    }
    $('#input_adult').attr('max', _booking_max_adults);
    $('#input_child').attr('max', _booking_max_adults);
  }
   var add_num_input_adult = isNaN(num_input_adult) ? 0 : num_input_adult;
  var add_num_input_child = isNaN(num_input_child) ? 0 : num_input_child;
  $('#input_adult').val(add_num_input_adult);
  $('#input_child').val(add_num_input_child);
}

</script>
