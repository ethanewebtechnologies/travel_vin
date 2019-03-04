<form data-_vTkn="<?php echo $this->security->get_csrf_token_name(); ?>" data-_vHash="<?php echo $this->security->get_csrf_hash(); ?>" name="buynow" action="#" method="post" id="paypalform">
	<input type="hidden" name="cmd" value="_xclick" />
	<input type="hidden" name="bn" value="PP-BuyNowBF" />
	<input type="hidden" name="business" value="<?php echo  $paypal_id;?>">
	<input type="hidden" name="currency_code" value="USD">
	<input type="hidden" name="item_number" value="">
	<input type="hidden" name="item_name" value="<?php echo $item_name; ?>">
	<input type="hidden" name="amount" value="<?php echo $totalprice; ?>">
	<input type="hidden" name="p3" value="1">
	<input type="hidden" name="t3" value="M">
	<input type="hidden" name="a3" value="<?php echo $totalprice; ?>">
	<input type='hidden' name='return' id="return" value="<?php echo $return_url; ?>">
	<button id="paypal-btn-submit" class="site-btn btn btn-default hvr-shutter-out-horizontal">checkout</button>
	<!--<input type="submit" name="submit" value="checkout" alt="PayPal - The safer, easier way to pay online" class="site-btn">-->
	<!--<img alt="PayPal - The safer, easier way to pay online" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >-->
</form>

<script>

$("#home").delegate('#paypal-btn-submit','click',function(e){
	e.preventDefault();
	var _vTkn = $("#paypalform").attr("data-_vTkn");
	var _vHash = $("#paypalform").attr("data-_vHash");
	
	var _action_ = "<?php echo $paypalUrl; ?>";

	var _URL = "<?php echo base_url('gateway/payment/transaction/init'); ?>";
	
	var _METHOD = "POST";
	//var _DATA = {
		//_vTkn: 	_vHash
	//};
	var _DATA = {test:'test'};
	_DATA[_vTkn] = _vHash;
	
	$.ajax({
		url: _URL,
		method: _METHOD,
		data: _DATA,
		success: function(response) {
			$("#paypalform").attr("data-_vTkn", response['security_token']);
			$("#paypalform").attr("data-_vTkn", response['security_hash']);
			
			/* API WORKING TESTING HERE  */
			
			var _return_url = $("#return").val();
			
			//_action_ = _action_ + '?_xtn_cs_init=' + response['xtn_cs_init'];
			
			_return_url = _return_url + '?_xtn_cs_init=' + response['xtn_cs_init'];
			$("#return").val(_return_url);
			
			$("#paypalform").attr("action", _action_);
			
			//$("#paypalform").attr("onclick","");
			$("#paypalform").submit();
		},
		error: function() {
			/* SHOW ERROR MESSAGE IMPLEMENT HERE  */
			return false;
		}
	});

	return false;
});

</script>