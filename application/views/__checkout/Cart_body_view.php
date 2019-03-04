<?php if($this->session->flashdata('__cp_success') && $this->session->flashdata('__cp_success')!=''){?>
<script type="text/javascript">
	toastr.success("<?php echo $this->session->flashdata('__cp_success');?>", "<?php echo $text_success;?>", opts);
</script>
<?php }?>
<?php if($this->session->flashdata('__cp_error') && $this->session->flashdata('__cp_error')!=''){?>
<script type="text/javascript">
	toastr.error("<?php echo $this->session->flashdata('__cp_error');?>", "<?php echo $text_error;?>", opts);
</script>	
<?php }?>
<!-- CSRF NAME -->
<input type="hidden" id="hash_update" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
<!-- END OF CSRF  -->
<table>
	<thead>
		<tr>
			<th width="30%"><?php echo $text_th_title;?></th>
			<th width="15%"><?php echo $text_th_adults;?></th>
			<th width="15%"><?php echo $text_th_children;?></th>
			<th width="20%"><?php echo $text_th_amount;?></th>
			<th width="20%"><?php echo $text_th_action;?></th>
		</tr>
	</thead>
	<tbody>
		<?php if(isset($only_cart_data) && $only_cart_data != '') { ?>
			<?php foreach($only_cart_data['trip_type'] as $key_2 => $ocd1) { ?>
			<?php foreach($ocd1['_pid'] as $key => $ocd) { ?>
				<tr>
					<td>
						<?php if (isset($ocd['image']) && file_exists($ocd['image'])) { echo $optimized->resize($ocd['image'], 100, 50, array(), 'resize_crop');}?>
						<br>
						<?php echo $ocd['title']; ?>
					</td>
					<td>
						<div class="col col-qty layout-inline">
							<?php if($ocd['no_of_adults']>1){?>
							<a href="#" class="qty qty-minus" data-customer_type="no_of_adults" data-key="<?php echo $key;?>" data-trip_type="<?php echo $key_2;?>">-</a>
							<?php }?>
							<?php 
								$attributes = array(
									'type' => 'number',
									'class' => 'adult_class',
									'readonly'=>'readonly',
									'value' => $ocd['no_of_adults']
								);
								echo form_input($attributes);
							?>
							<a href="#" class="qty qty-plus" data-customer_type="no_of_adults" data-key="<?php echo $key;?>" data-trip_type="<?php echo $key_2;?>">+</a>
						</div>
					</td>
					<td>
						<?php if(strtolower($key_2)=="sharing" || strtolower($key_2)=="private" || strtolower($key_2)=="restaurant" ||strtolower($key_2)=="golf" || strtolower($key_2)=="club_and_bar"){?>
						<?php echo $text_na?>
						<?php }else{?>
						<div class="col col-qty layout-inline">
							<?php if($ocd['no_of_childs']>0){?>
							<a href="#" class="qty qty-minus" data-customer_type="no_of_childs" data-key="<?php echo $key;?>" data-trip_type="<?php echo $key_2;?>">-</a>
							<?php }?>
							<?php 
								$attributes = array(
									'type' => 'number',
									'class' => 'child_class',
									'readonly'=>'readonly',
									'value' => $ocd['no_of_childs']
								);
								echo form_input($attributes);
							?>
							<a href="#" class="qty qty-plus" data-customer_type="no_of_childs" data-key="<?php echo $key;?>" data-trip_type="<?php echo $key_2;?>">+</a>
						</div>
						<?php }?>
					</td>
					<td>$<?php echo number_format($ocd['subtotal_price'], PRICE_DELIMITER); ?> USD</td>
					<td>
						<a href="#" class="item-delete" data-key="<?php echo $key; ?>" data-trip_type="<?php echo $key_2;?>">
							<i class="fa fa-trash"></i>
						</a>
					</td>
				</tr>
			<?php }} ?>
			<tr>
				<td colspan="3" align=""></td>
				<td colspan="" align=""><?php echo $text_promo_code?></td>
				<td colspan="5" align="right">
					<input type="text" name="apply_coupon" placeholder="<?php echo $text_placeholder_promocode;?>" value="" <?php if(isset($coupon_name)){?>readonly<?php }?> />
					<?php if(isset($coupon_name)){?>
					<br>
					<a href="#" class="remove-coupon"><?php echo $text_remove_coupon;?></a>
					<?php }else{?>
					<br>
					<a href="#" class="btn apply-coupon"><?php echo $text_apply_coupon;?></a>
					<?php }?>
				</td>
			</tr>
			<?php if(isset($coupon_name)){?>
			<tr>
				<td colspan="3" align="right"></td>
				<td colspan="" align="right"><?php echo $text_sub_total;?></td>
				<td colspan="5" align="right">$<?php echo number_format($sub_total, PRICE_DELIMITER);?> USD</td>
			</tr>
			<tr>
				<td colspan="3" align="right"></td>
				<td colspan="" align="right"><?php echo $text_coupon;?> - <?php echo $coupon_name;?></td>
				<td colspan="5" align="right">
					- $<?php echo number_format($coupon_discount_amount, PRICE_DELIMITER);?> USD
					<?php if($coupon_value!=null){?>
						(<?php echo $coupon_value;?>%)
					<?php }?>
				</td>
			</tr>
			<?php }?>
			<tr>
				<td colspan="3" align="right"></td>
				<td colspan="" align="right"><?php echo $text_your_payment; ?></td>
				<td colspan="5" align="right">$<?php echo number_format($grand_total, PRICE_DELIMITER);?> USD</td>
			</tr>
			
		<?php }else{?>
			<tr>
				<td class="empty_cart" colspan="8"><h5><?php echo $text_empty_cart;?></h5><img src="<?php echo base_url('assets/img/empty_cart.png') ?>" alt=""/></td>
			</tr>
		<?php } ?>
	</tbody>
</table>
<!-- Modal Confirm -->
<div class="modal fade" id="confirmation_modal" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title"><?php echo $text_confirm_modal;?></h4>
			</div>
			<div class="modal-body">
				<?php echo $text_modal_delete;?>
			</div>
			<div class="modal-footer">
				<a id="confirmedDelete" data-key="" data-trip_type="" class="btn btn-info"><?php echo $text_modal_delete_yes;?></a>
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo $text_modal_delete_no;?></button>
			</div>
		</div>
	</div>
</div>