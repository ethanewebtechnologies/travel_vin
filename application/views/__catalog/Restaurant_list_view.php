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
							<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width:800px !important;">
								<div class="row">
									<?php foreach ($country_name as $key => $value){?>
									<div class="col-sm-3">
										<strong class="countries-title"><?php echo strtoupper($value['name']);?></strong>
										<div class="countries">
											<?php foreach ($city_name as $data){?>
											<?php if($data['country_id']==$value['id']){?>
											<a class="dropdown-item" href="<?php echo base_url('restaurants/' . $value['seo_url'] . '/' . $data['seo_url']); ?>"><?php echo $data['name'];?></a>
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
	<?php if(isset($restaurant_banners['main']) && !empty($restaurant_banners['main'])){?>
	<section class="main_content wow zoomIn" data-wow-duration="1s" style="visibility: visible; animation-duration: 1s; animation-name: zoomIn;">
		<section class="container-fluid">
			<section class="row">
				<div class="banner">
					<div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
						<div class="carousel-inner">
							<?php 
							foreach ($restaurant_banners['main'] as $key => $restaurant_banner) { ?>
							<?php if(isset($restaurant_banner['image']) && file_exists($restaurant_banner['image'])) { ?>
								<div class="item <?php echo $key == 0 ? 'active' : ''; ?>">
        								<?php echo $optimized->resize($restaurant_banner['image'], 1349, 521, array('class' => 'd-block w-100 img-fluid', 'alt' => $restaurant_banner['title']), 'resize_crop'); ?>
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
					<div class="bnr_text">
						<div class="bnr_wrap_text">
							<h1 class="wow zoomIn" data-wow-delay="1s"><?php echo $restaurant_configuration['main_title']; ?></h1>
							<h5><?php echo $restaurant_configuration['sub_title']; ?></h5>
							<div>
								<p class="spcl_txt"><?php echo $restaurant_configuration['boxed_title']; ?></p>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
	<?php } ?>
	<?php if(isset($restaurant_configuration['banner_dsc']) && !empty($restaurant_configuration['banner_dsc'])){?>
	<section class="transport_blk">
		<section class="container">
			<section class="row">
				<div class="col-sm-12">						
					<div class="form_text_blk no-shadow">
						<h3><?php echo $restaurant_configuration['banner_dsc']; ?></h3>
					</div>
				</div>
			</section>
		</section>
	</section>
	<?php }?>
	<section class="tour_list_blk">
		<section class="container-fluid">
			<section class="row">
				<div class="col-sm-3">
					<div class="filter_blk wow pulse" data-wow-delay="0.7s" style="visibility: visible; animation-delay: 0.7s; animation-name: pulse;">
						<div class="tour_dest_blk">
							<h2><?php echo $text_Destination?></h2>
							<div class="tour_dest">
								<div class="dropdown">
									<button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: #fff;width: 100%;">
									<?php if(isset($country_display_name) && isset($city_display_name)){?>
									<i class="fa fa-map-marker"></i> <?php echo isset($country_display_name) ? $country_display_name : THREE_DASH; ?> &gt; <?php echo isset($city_display_name) ? $city_display_name : THREE_DASH; ?>
									<?php }else{echo $text_prefered_location;}?>
									</button>
									<div class="dropdown-menu" aria-labelledby="dropdownMenuButton" style="min-width:800px !important;">
										<div class="row">
											<?php foreach ($country_name as $key => $value){?>
											<div class="col-sm-3">
												<strong class="countries-title"><?php echo strtoupper($value['name']);?></strong>
												<div class="countries">
													<?php foreach ($city_name as $data){?>
													<?php if($data['country_id']==$value['id']){?>
													<a class="dropdown-item" href="<?php echo base_url('restaurants/' . $value['seo_url'] . '/' . $data['seo_url']); ?>"><?php echo $data['name'];?></a>
													<?php }}?>
												</div>
											</div>
											<?php }?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="filter_form_blk">
							<div class="filter_search_blk">
							
									<?php if ($search_title) { ?>
										<h2><?php echo $text_Search;?></h2>
								   				<?php if (isset($total_restaurants)) { ?>
                                					<?php if ($total_restaurants > 1) { ?>
                                   	 				<?php echo $total_restaurants; ?> <?php echo $text_results;?>
                               						<?php } else if ($total_restaurants == 1) { ?>
                                  							  <?php echo $total_restaurants; ?> <?php echo $text_result;?>
                                							<?php } ?>
                            					<?php } else { ?>
                            		  <?php echo $text_no_result;?>
                          		  <?php } ?>
                          		   <?php echo $text_found_for;?> <strong>	&quot;<?php echo $search_title; ?>&quot;</strong>
                          		  <?php } ?>
								<form>
									<input type="text" name="search_title" value="<?php echo $search_title; ?>" id="search_title" placeholder="SearchTitle">
									<button type="button" id="search_title_button">
										<img src="<?php echo base_url('assets/img/search_ico.png'); ?>" alt="">
									</button>
									
								</form>
							</div>
							<div class="filter_cat_price_blk">
								<div class="filter_by_cat">
									<h3><?php  echo $text_by_category;?></h3>
										<?php if(is_null($search_category_id)) { ?>
											<p>
												<input type="radio" id="category-id-0" name="category_id" value="*" checked>
												<label for="category-id-0"><?php  echo $text_All;?></label>
											</p>
									<?php } else { ?>
										<p>
											<input type="radio" id="category-id-0" name="category_id" value="*">
											<label for="category-id-0"><?php  echo $text_All;?></label>
										</p>
									<?php } ?>
									<?php $i = 1; ?>
									<?php foreach($total_category_name as $category) { ?>
										<p>
    										<?php if($category['id'] == $search_category_id) { ?>
    											<input type="radio" id="category-id-<?php echo $i; ?>" name="category_id" value="<?php echo $category['id']; ?>" checked>
    											<label for="category-id-<?php echo $i; ?>">
    												<?php echo $category['category_name']; ?>
    											</label>
    										<?php } else { ?>
    											<input type="radio" id="category-id-<?php echo $i; ?>" name="category_id" value="<?php echo $category['id']; ?>">
    											<label for="category-id-<?php echo $i; ?>">
    												<?php echo $category['category_name']; ?>
    											</label>
    										<?php } ?>
										</p>
										<?php  $i++; ?>
									<?php } ?>
								</div>
								<div class="filter_by_price">
									<h3><?php echo $text_Price_Range;?></h3>
									<p>
										<input type="radio" id="price_range-0" name="price_range" value="*" checked>
										<label for="price_range-0"><?php  echo $text_All;?></label>
									</p>
									<p>
										<input type="radio" id="price_range-1" name="price_range" value="0-100">
										<label for="price_range-1"><?php echo $text_price_range_1;?></label>
									</p>
									<p>
										<input type="radio" id="price_range-2" name="price_range" value="100-200">
										<label for="price_range-2"><?php echo $text_price_range_2;?></label>
									</p>
									<p>
										<input type="radio" id="price_range-3" name="price_range" value="200-300">
										<label for="price_range-3"><?php echo $text_price_range_3;?></label>
									</p>
									<p>
										<input type="radio" id="price_range-4" name="price_range" value="300-400">
										<label for="price_range-4"><?php echo $text_price_range_4;?></label>
									</p>
									<p>
										<input type="radio" id="price_range-5" name="price_range" value="400-infinity">
										<label for="price_range-5"><?php echo $text_price_range_5;?></label>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-9">
					<div class="listing_blk wow pulse" data-wow-delay="0.8s" style="visibility: visible; animation-delay: 0.8s; animation-name: pulse;">
						<?php if(!empty($restaurants)) { ?>
						<div class="sort-by">
							<div class="pull-right">
								<div class="form-group input-group input-group-sm">
									<label for="input-sort" class="input-group-addon"><?php echo $text_SortBy;?></label>
									<select class="form-control" id="input-sort">
										 <option selected="selected" value=""><?php echo $option_default;?></option>
										 <option value="ASC" <?php if(isset($sort_title) && $sort_title=='ASC'){echo 'selected';}?>><?php echo $text_assending_name;?></option>
										 <option value="DESC" <?php if(isset($sort_title) && $sort_title=='DESC'){echo 'selected';}?>><?php echo $text_descending_name;?></option>
										 <option value="HIGH" <?php if(isset($sort_title) && $sort_title=='HIGH'){echo 'selected';}?>><?php echo $text_assending_price;?></option>
										 <option value="LOW" <?php if(isset($sort_title) && $sort_title=='LOW'){echo 'selected';}?>><?php echo $text_descending_price;?></option>
									</select>
								</div>
							</div>
						</div>
						<div class="tours_list_wrap">
							<?php foreach ($restaurants as $restaurant) { ?>
								<div class="single_list_blk">
									<div class="tourimg">
										<?php if(isset($restaurant['image']) && file_exists($restaurant['image'])) { ?>
											<?php 
												  echo $optimized->resize($restaurant['image'], 230, 153, array(), 'resize_crop');
											?>
										<?php } else { ?>
											<?php echo $optimized->resize('assets/img/empty.jpg', 230, 153, array(), 'resize_crop'); ?>
										<?php } ?>
									</div>
									<div class="tour_short_detail">
										<h3>
											<?php echo $restaurant['title']; ?>
										</h3>
										<p>
											<!-- overview -->
											<?php 
												if(!empty($restaurant['dsc'])) { 
													// Strip tags to avoid breaking any html
													$restaurant_dsc = strip_tags($restaurant['dsc']);
													
													// truncate string
													$short_restaurant_dsc = substr($restaurant_dsc, 0, 120);
													echo $short_restaurant_dsc . THREE_DOTS;
												} else {
													echo THREE_DASH;
												}
											?>
										</p>
									</div>
									<div class="digonal_img">
										<img src="<?php echo base_url('assets/img/diagonalimg.png'); ?>" alt="">
									</div>
									<div class="price_detail">
										<h4><?php echo $text_from_usd;?></h4>
											<h2> $<?php echo number_format($restaurant['price'], PRICE_DELIMITER); ?></h2>           							
										<a href="<?php echo base_url('restaurants/' . $restaurant['country_seo_url'] . '/' . $restaurant['city_seo_url'] . '/' . $restaurant['slug']); ?>"><?php echo $text_Book_Now;?></a>
									</div>
								</div>
							<?php } ?>
							<div class="download_links">
								<div class="row">
									<!-- <div class="col">
										<div class="app_link_blk">
											<a href=""><img src="img/android.png" alt=""></a>
											<a href=""><img src="img/ios.png" alt=""></a>
										</div>
									</div> -->
									<div class="col-sm-12">
										<div class="pagination_blk">
											<?php echo $pagination; ?>
										</div>
									</div>
								</div>
							</div>
						</div>
						<div class="tours_list_wrap">
						<?php } else { ?>
							<h3 class="no_records">
								<img src="<?php echo base_url('assets/img/NoRecordFound.png'); ?>" alt="">
							</h3>
						<?php } ?>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
</main>

<script>
$(document).ready(function () {
	function filter() {
		var url = "<?php echo $target_url ?>";

		url += '?menu=restaurant';
		
		var search_category_id = $("input[name^='category_id']:checked").val();
		
		if(search_category_id != "*") {
			url += '&search_category_id=' + encodeURIComponent(search_category_id);
		}
		var search_title = $("#search_title").val();
		if(search_title != "") {
			url += '&search_title=' + encodeURIComponent(search_title);
		}
		
		var search_price_range = $("input[name^='price_range']:checked").val();
		
		if(search_price_range != "*") {
			price_range = search_price_range.split('-');

			search_min_price = price_range[0];
			search_max_price = price_range[1];

			url += '&search_min_price=' + encodeURIComponent(search_min_price);

			if(search_max_price != 'infinity') {
				url += '&search_max_price=' + encodeURIComponent(search_max_price);
			}
		}

		window.location.href = url;
	}
	
	$("input[name^='category_id']").on('click', function() {
		filter();
	});
	 $("#search_title_button").on('click', function(){
		 filter();
     });
	
	$("input[name^='price_range']").on('click', function() {
		filter();
	});
});

</script>
<script type="text/javascript">
$(document).ready(function(){
	$('#input-sort').change(function(){
		 var sort_title=$(this).val();
		 var url = "<?php echo $target_url ?>";
		url += '?menu=restaurant';
		if(search_title != " ") {
			url += '&sort_title=' + encodeURIComponent(sort_title);
		}
		window.location.href = url;
	});
});
</script>