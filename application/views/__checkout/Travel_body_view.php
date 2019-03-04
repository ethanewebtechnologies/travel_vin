<div class="tourform_blk checkout_statement">
	<h3><?php echo $text_statement;?></h3>
	<div class="tour_statmnt_div">
		<?php if(isset($only_cart_data) && $only_cart_data != '') { ?>
		<?php foreach($only_cart_data['trip_type'] as $key_2 => $ocd1) { ?>
		<?php foreach($ocd1['_pid'] as $key => $ocd) { ?>
			<ul>
				<li>
				<?php if (isset($ocd['image']) && file_exists($ocd['image'])) { echo $optimized->resize($ocd['image'], 100, 50, array(), 'resize_crop');}?>
				</li>
				<li><h4><?php echo $ocd['title']; ?></h4>
				<li>$<?php echo number_format($ocd['subtotal_price'], PRICE_DELIMITER); ?> USD</li>
			</ul>
		<?php }}}?>
	</div>
	<?php if(isset($coupon_name)){?>
		<div class="statmnt_total_div">
			<h4><strong><?php echo $text_sub_total;?></strong> <span>$<?php echo number_format($sub_total, PRICE_DELIMITER);?> USD</span></h4>
		</div>
		<div class="statmnt_total_div">
			<h4><strong><?php echo $text_coupon;?>-<?php echo $coupon_name;?></strong> <span>- $<?php echo number_format($coupon_discount_amount, PRICE_DELIMITER);?> USD
			<?php if($coupon_value!=null){?>
				(<?php echo $coupon_value;?>%)
			<?php }?></span></h4>
		</div>
	<?php }?>
	<div class="statmnt_total_div">
		<h4><strong><?php echo $text_your_payment; ?></strong> <span>$<?php echo number_format($grand_total, PRICE_DELIMITER);?> USD</span></h4>
	</div>
	<div class="btn_grp" id="continue_btn">
		<button type="submit" name="submit"><?php echo $text_continue;?></button>
	</div>
</div>