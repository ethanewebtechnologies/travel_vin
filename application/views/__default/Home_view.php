<main>
	<section class="main_content wow zoomIn" data-wow-duration="1s">
		<section class="container-fluid">
			<section class="row">
				<div class="banner">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner" role="listbox">
							<?php foreach ($home_banners['main'] as $key => $home_banner) { ?>
								<div class="item <?php echo $key == 0 ? 'active' : ''; ?>">
									<?php if(isset($home_banner['image']) && file_exists($home_banner['image'])) { ?>
        								<?php echo $optimized->resize($home_banner['image'], 1349, 521, array('class' => 'd-block w-100 img-fluid', 'alt' => $home_banner['title']), 'resize_crop'); ?>
    								<?php } ?>
								</div>
							<?php } ?>
						</div>
						<a class="left carousel-control" href="#carouselExampleControls" role="button" data-slide="prev">
							<span class="fa fa-angle-left" aria-hidden="true"></span>
							<span class="sr-only"><?php echo $text_btn_prev;?></span>
						</a>
						<a class="right carousel-control" href="#carouselExampleControls" role="button" data-slide="next">
							<span class="fa fa-angle-right" aria-hidden="true"></span>
							<span class="sr-only"><?php echo $text_btn_next;?></span>
						</a>
					</div>
					<div class="bnr_text">
						<div class="bnr_wrap_text">
							<h1 class="wow zoomIn" data-wow-delay="1s"><?php echo $home_configuration['main_title']; ?></h1>
							<h5><?php echo $home_configuration['sub_title']; ?></h5>
							<div>
								<p class="spcl_txt"><?php echo $home_configuration['boxed_title']; ?></p>
							</div>
							<div class="booknow_btn wow bounceIn" data-wow-delay="1s">
								<a onclick="itemSearch(this);" class="" href="javascript:void(0);" data-link="<?php echo base_url();?>" data-title=""><img src="<?php echo base_url('assets/img/booknow.png'); ?>" alt=""/></a>
								<!--<a href="<?php echo base_url('tours'); ?>" class="hvr-hang">
									<img src="<?php echo base_url('assets/img/booknow.png'); ?>" alt=""/>
								</a>-->
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
	<section class="transport_blk">
		<section class="container">
			<section class="row">
				<div class="col-sm-12">
					<div class="form_blk">
						<div class="row">
							<div class="col-sm-6">
								<div class="left_dream_blk wow slideInLeft" data-wow-offset="100">
									<img src="<?php echo base_url('assets/img/dream_img.png'); ?>" alt=""/>
									<div class="leftdream_text">
										<div class="dream_text">
											<h3><?php echo $text_my_dreams;?></h3>
											<p><?php echo $text_click_to_play;?></p>
										</div>
										<a href="#modal_vdo4" class="hvr-pulse-shrink">
											<img src="<?php echo base_url('assets/img/vdo_ico.png'); ?>" alt=""/>
										</a>
										<div class="remodal" data-remodal-id="modal_vdo4" role="dialog" aria-labelledby="modal1Title" aria-describedby="modal1Desc">
												<button data-remodal-action="close" class="remodal-close" aria-label="Close"></button>
												<div class="remodal_content">							
													<video width="460" height="300" controls>
														<source src="<?php echo base_url('assets/img/SampleVideo.mp4')?>" type="video/mp4">
													</video> 
												</div>
											</div>
									</div>
								</div>
							</div>
							<div class="col-sm-6">
								<div class="right_dream_blk wow slideInRight" data-wow-offset="100">
									<h2><?php echo $text_transportation;?> <img src="<?php echo base_url('assets/img/transition_ico.png'); ?>" alt=""/></h2>
									<form id="transportSearchForm" method="get" onsubmit='__searchTransportationOnSubmit(); return false;' action="">
										<div class="form-group">
											<select name="country_id" id="country" onchange="enable_disable_transp_search_form(this.value);get_cities_home(this.value)">
												<option value=""><?php echo $text_placeholder_country;?></option>
												<?php foreach ($countries as $country) { ?>
													<option value="<?php echo $country['seo_url'] . '#' . $country['id']; ?>">
														<?php echo $country['name']; ?>
													</option>
												<?php } ?>
											</select>
										</div>
										<div class="form-group">
											<select name="city_id" id="city" onchange="enable_disable_transp_search_form(this.value)" disabled>
												<option value=""><?php echo $text_placeholder_city;?></option>
											</select>
										</div>
										<div class="form_btn">
											<button class="hvr-float-shadow" id="serach-transportation-home"><?php echo $text_btn_search;?></button>
										</div>
										<div class="onchange-loader"></div>
									</form>
									<?php if(isset($arriving_countries) && !empty($arriving_countries)) { ?>
    									<div class="up_arrival_blk">
    										<div class="upcoming_blk">
    											<div class="upcoming_heading">
    												<div class="width_area"><h3><?php echo $text_upcoming;?></h3></div>
    												<div class="width_area"><h3><?php echo $text_arrivals;?></h3></div>
    											</div>
    											<div class="scroll_list">
    												<div class="scroll_list_head">
    													<div class="width_area"><h4><?php echo $text_country;?></h4></div>
    													<div class="width_area"><h4><?php echo $text_availability;?></h4></div>
    												</div>
    												<div class="scrolllist_wrap">
    													<div id="content-1" class="content mCustomScrollbar _mCS_1  mCS-autoHide">
    														<div class="width_area">
    															<ul>
    																<?php foreach ($arriving_countries as $key => $arriving_country) { ?>
    																	<li><?php echo $arriving_countries[$key]['name']; ?></li>
    																<?php } ?>
    															</ul>
    														</div>
    														<div class="width_area">
    															<ul>
    																<?php foreach ($arriving_countries as $key => $arriving_country) { ?>
    																	<li><?php echo d_to_lu($arriving_countries[$key]['date_of_arrival']); ?></li>
    																<?php } ?>
    															</ul>
    														</div>
    													</div>
    												</div>
    											</div>
    										</div>
    									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
					<?php if(isset($home_configuration['banner_dsc']) && !empty($home_configuration['banner_dsc'])){?>
					<div class="form_text_blk">
						<h3><?php echo $home_configuration['banner_dsc']; ?></h3>
					</div>
					<?php }?>
				</div>
			</section>
		</section>
	</section>
	<section class="popular_dest_blk">
		<section class="container">
			<section class="row">
				<div class="col-sm-12">
					<div class="sec_title wow flipInX" data-wow-delay="0.5s">
						<h2><?php echo $text_heading_popular_tours;?></h2>
						<img src="<?php echo base_url('assets/img/aro_down.png'); ?>" alt=""/>
					</div>
				</div>
			</section>
			<?php $sn = 1; ?>
			<?php foreach ($popular_tours as $popular_tour) { ?>
				<?php if($sn == 1 || $sn == 3 || $sn == 5) { ?>
					<section class="row">
				<?php } ?>
					<div class="col-sm-6">
						<div class="single_dest_blk wow pulse" data-wow-delay="0.<?php echo $sn; ?>s">
    						<div class="dest_img">
								<?php echo $optimized->resize($popular_tour['image'], 292, 250, array(), 'resize_crop');?>
    							<!--<img src="<?php echo base_url('assets/img/dest1.jpg'); ?>" alt="" />-->
    						</div>
    						<div class="dest_text">
    							<h3>
    								<?php echo substr($popular_tour['title'], 0, 30) . '...'; ?>
    							</h3>
    							<p><?php echo substr($popular_tour['dsc'], 0, 70) . '...'; ?></p>
    							<a href="<?php echo base_url('tours/'.$popular_tour['country_slug'].'/'.$popular_tour['city_slug'].'/'.$popular_tour['slug']); ?>" class="hvr-radial-out"><?php echo $text_view_all_tours;?></a>
        					</div>
    					</div>
    				</div>
    			<?php if($sn == 2 || $sn == 4 || $sn == 6) { ?>
					</section>
				<?php } ?>	
				<?php $sn++; ?>
			<?php } ?>
		</section>
	</section>
	<section class="spcltour_blk">
		<section class="container-fluid">
			<section class="row">
				<div class="sec_title mt40 wow flipInX" data-wow-delay="0.5s">
					<h2><?php echo $text_heading_special_tours;?></h2>
					<img src="<?php echo base_url('assets/img/aro_down.png'); ?>" alt=""/>
				</div>
				<div class="popular_tour_blk">
					<div class="col-sm-12">
						<div class="row">
							<div class="col-sm-4 wow slideInLeft">
								<div class="single_popular_tour">
									<?php echo $optimized->resize($special_tour[1]['image'], 386, 284, array(), 'resize_crop');?>
									<!--<img src="<?php echo base_url('assets/img/popular_dest1.png'); ?>" alt=""/>-->
									<div class="single_pop_tour_text">
										<p><?php echo $special_tour[1]['title']; ?></p>
										<h4><?php echo $text_from;?> $<?php echo number_format($special_tour[1]['adult_price'], PRICE_DELIMITER); ?> USD</h4>
									</div>
								</div>
							</div>
							<div class="col-sm-4 wow slideInBottom">
								<div class="single_popular_tour">
									<!--<img src="<?php echo base_url('assets/img/popular_dest2.png'); ?>" alt=""/>-->
									<?php echo $optimized->resize($special_tour[2]['image'], 386, 284, array(), 'resize_crop');?>
									<div class="single_pop_tour_text">
										<p><?php echo $special_tour[2]['title']; ?></p>
										<h4><?php echo $text_from;?> $<?php echo number_format($special_tour[2]['adult_price'], PRICE_DELIMITER); ?> USD</h4>
									</div>
								</div>
							</div>
							<div class="col-sm-4 wow slideInRight">
								<div class="single_popular_tour">
									<?php echo $optimized->resize($special_tour[3]['image'], 386, 284, array(), 'resize_crop');?>
									<!--<img src="<?php echo base_url('assets/img/popular_dest3.png'); ?>" alt=""/>-->
									<div class="single_pop_tour_text">
										<p><?php echo $special_tour[3]['title']; ?></p>
										<h4><?php echo $text_from;?> $<?php echo number_format($special_tour[3]['adult_price'], PRICE_DELIMITER); ?> USD</h4>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
	<section class="welcome_blk">
		<section class="container">
			<section class="row">
				<div class="col-sm-12">
					<p class="wow rotateInDownLeft" data-wow-delay="0.2s">
						<?php echo $home_configuration['dsc']; ?>
					</p>
				</div>
			</section>
		</section>
	</section>
</main>

<script>
/* $('#country').on('change', function () {
    $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/listing/main-hotel/get_cities_by_country_id'); ?>",
        data: {country_id: this.value.split('#')[1]},
        dataType: "json",
        success: function (res) {
            if (res) {
				$("#city").prop('disabled', false);
                $("#city").empty();
                $("#city").append('<option value="">Select a City</option>');

                for (var i = 0; i < res.length; i++) {
                    $("#city").append('<option value="' + res[i].seo_url + '#' + res[i].id + '">' + res[i].name + '</option>');
                }
            }
        }
    });
}); */
</script>

<script type="text/javascript">
var __searchTransportationOnSubmit = function() {
	var get_country = $('#country').val().split('#')[0];
	var get_city = $('#city').val().split('#')[0];
	if(get_country==''){
		$("#country").addClass('err-border');
		$("#serach-transportation-home").prop('disabled', true);
	}
	else if(get_city==''){
		$("#city").addClass('err-border');
		$("#serach-transportation-home").prop('disabled', true);
	}
	else{
		$("#serach-transportation-home").prop('disabled', false);
		//var searchAction = $("#transportSearchForm").attr('action');
		var searchAction = "<?php echo base_url('transportation'); ?>";
		searchAction = searchAction + '/' + get_country + '/' + get_city;
		window.location.href = searchAction;
	}
};
var enable_disable_transp_search_form = function(value){
	var get_country = $('#country').val();
	var get_city = $('#city').val();
	if(get_country!=''){
		$("#country").removeClass('err-border');
	}
	else{
		$("#country").addClass('err-border');
	}
	if(get_city!=''){
		$("#city").removeClass('err-border');
	}
	else{
		$("#city").addClass('err-border');
	}
	if(get_country!='' && get_city!=''){
		$("#country").removeClass('err-border');
		$("#city").removeClass('err-border');
		$("#serach-transportation-home").prop('disabled', false);
	}
};
var get_cities_home = function(coountry_seo_url){
	if(coountry_seo_url!='' || coountry_seo_url!='undefined'){
		var getUrl = "<?php echo base_url('home/get_cities_by_country_seo_url'); ?>";
		$.ajax({
			url: getUrl,
			method: "GET",
			data: {seo_url:coountry_seo_url.split('#')[0]},
			dataType:'json',
			beforeSend: function(){$('.onchange-loader').show();},
			success: function(res) {
				$("#city").empty();
                $("#city").append('<option value="">Select a City</option>');

                for (var i = 0; i < res.length; i++) {
                    $("#city").append('<option value="' + res[i].seo_url + '#' + res[i].id + '">' + res[i].name + '</option>');
                }
				$("#city").prop('disabled', false);
				$('.onchange-loader').hide();
			}
		});
	}
	else{
		return false;
	}
};
</script>
	