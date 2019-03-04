<main>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<div class="loader" id="cart_loader" style="display:none;"><img src="<?php echo base_url('assets/img/loader.gif'); ?>" alt=""/></div>
		<section class="container">
			<section class="row">
				<div class="col-sm-12">
					<div class="tour_steps_blk">
						<ul>
							<li>
								<div class="step1_blk active">
									<i class="fa fa-shopping-cart"></i> 1. <?php echo $text_shopping_cart; ?>
								</div>
							</li>
							<li>
								<div class="step1_blk">
									<i class="fa fa-list"></i> 2. <?php echo $text_your_information; ?>
								</div>
							</li>
							<li>
								<div class="step1_blk">
									<i class="fa fa-file"></i> 3. <?php echo $text_confirmation; ?>
								</div>
							</li>
						</ul>
					</div>
					<div class="tour_desc_wrap select_tour_wrap">
						<div class="tour_desc_content noshadow">
							<div id="_cart_body"></div>
							<div class="paymethod_blk">
								<div class="paybtn_grp">
									<p><?php echo $text_payment_method;?></p>
									<img src="<?php echo base_url('assets/img/payopt.jpg'); ?>" alt=""/>
									<a href="<?php echo base_url('checkout/audit'); ?>"><?php echo $text_continue;?></a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</section>
		</section>
	</section>
</main>

<style>
.col-qty > * {
  vertical-align: middle; 
}

.col-qty > input {
  max-width: 2.6em;
}
</style>
<script type="text/javascript">

function get_cart() {
	$.ajax({
      url: '<?php echo base_url('cart/get_ajax_cart_data');?>',
	  method: 'get',
      dataType: "html",
	  beforeSend: function() {$('#cart_loader').css("display", "block");},
	  complete: function() {$('#cart_loader').css("display", "none");},
      success: function(html) {
        $('#_cart_body').empty();
        $('#_cart_body').html(html);
      }
    });
}

$(function() {
$(window).on('load',function(){
	get_cart();
} );
});

// SHOPPING CART PLUS OR MINUS
$('#_cart_body').delegate('a.qty-minus','click', function(e) {
	e.preventDefault();
	var $this = $(this);
	var $input = $this.closest('div').find('input');
	var key = $this.data('key');
	var type = $this.data('customer_type');
	var trip_type = $this.data('trip_type');
	var value = parseInt($input.val());
	if (value > 1) {
		value = value - 1;
	} else {
		value = 0;
	}
	$input.val(value);
	update_cart_data(key,type,trip_type,value);
});

$('#_cart_body').delegate('a.qty-plus','click', function(e) {
	e.preventDefault();
	var $this = $(this);
	var $input = $this.closest('div').find('input');
	var key = $this.data('key');
	var type = $this.data('customer_type');
	var trip_type = $this.data('trip_type');
	var value = parseInt($input.val());
	if (value > 0) {
	value = value + 1;
	} else {
		value =1;
	}
	$input.val(value);
	update_cart_data(key,type,trip_type,value);
});

function update_cart_data(key,type,trip_type,value) {
	var _hash_name = $("#hash_update").attr('name');
	var _hash_value = $("#hash_update").val();
	var data = {key:key,type:type,trip_type:trip_type,value:value};
	data[_hash_name] = _hash_value;
	$.ajax({
      url: '<?php echo base_url('cart/update_cart_data');?>',
	  method: 'post',
	  data:data,
      dataType: "json",
	  beforeSend: function() {$('#cart_loader').css("display", "block");},
	  complete: function() {$('#cart_loader').css("display", "none");},
      success: function(html) {
		if(html.type=='error'){
			toastr.error(html._Qty, html._oops, opts);
		}
		$('#hash_update').val(html._CTH);
        get_cart();
      }
    });
};

$('#_cart_body').delegate('a.item-delete','click', function(e) {
	e.preventDefault();
	var $this = $(this);
	var key = $this.data('key');
	var trip_type = $this.data('trip_type');
	$("#confirmedDelete").attr('data-key',key);
	$("#confirmedDelete").attr('data-trip_type',trip_type);
	$('#confirmation_modal').modal('show');
	//delete_cart_data(key,trip_type);
});

//function delete_cart_data(key,trip_type) {
$('#_cart_body').delegate('#confirmedDelete','click',function(){
	var _hash_name = $("#hash_update").attr('name');
	var _hash_value = $("#hash_update").val();
	var $this = $(this);
	var key = $this.data('key');
	var trip_type = $this.data('trip_type');
	var data = {key:key,trip_type:trip_type};
	data[_hash_name] = _hash_value;
	$.ajax({
      url: '<?php echo base_url('cart/delete_cart_data');?>',
	  method: 'post',
	  data:data,
      dataType: "html",
	  beforeSend: function() {$('#confirmation_modal').modal('hide');$('#cart_loader').css("display", "block");},
	  complete: function() {$('#cart_loader').css("display", "none");},
      success: function(html) {
		$('#hash_update').val(html._CTH);
		get_cart_total();
        get_cart();
      }
    });
});

$('#_cart_body').delegate('a.apply-coupon','click', function(e) {
	e.preventDefault();
	var $this = $(this);
	var value = $("input[name=apply_coupon]").val();
	apply_coupon(value);
});

function apply_coupon(coupon) {
	var _hash_name = $("#hash_update").attr('name');
	var _hash_value = $("#hash_update").val();
	var data = {coupon:coupon};
	data[_hash_name] = _hash_value;
	$.ajax({
		url: '<?php echo base_url('cart/apply_coupon_in_cart');?>', 
		method: 'post',
		data:data,
		dataType: "html",
		beforeSend: function() {$('#cart_loader').css("display", "block");},
		complete: function() {$('#cart_loader').css("display", "none");},
		success: function(resp) {
			$('#hash_update').val(resp._CTH);
			get_cart();
		}
    });
};

$('#_cart_body').delegate('a.remove-coupon','click', function(e){
	e.preventDefault();
	remove_coupon();
});

function remove_coupon() {
	var _hash_name = $("#hash_update").attr('name');
	var _hash_value = $("#hash_update").val();
	var data = {action:'ajax'};
	data[_hash_name] = _hash_value;
	$.ajax({
		url: '<?php echo base_url('cart/remove_coupon_from_cart');?>', 
		method: 'post',
		data:data,
		dataType: "html",
		beforeSend: function() {$('#cart_loader').css("display", "block");},
		complete: function() {$('#cart_loader').css("display", "none");},
		success: function(resp) {
			$('#hash_update').val(resp._CTH);
			get_cart();
		}
    });
};
</script>