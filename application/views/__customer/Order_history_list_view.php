<?php if(isset($customer_orders) && !empty($customer_orders)){?>
<table>
	<thead>
		<tr>
			<th>Booking Item</th>
			<th>Booking Number</th>
			<th>Amount</th>
		</tr>
	</thead>
	<tbody>
		<?php foreach($customer_orders as $orders){?>
			<tr>
				<!--<td><img class="d-block w-100 img-fluid" src="img/desc_img.png" alt="Third slide"></td>-->
				<td><?php echo ucwords(str_replace('_',' ',$orders['booking_type']));?></td>
				<td><?php echo $orders['booking_no'];?></td>
				<td>$<?php echo $orders['booking_amount_paid'];?> USD</td>
			</tr>
		<?php }?>
	</tbody>
</table>
<?php }else{?>
<h5>You have no bookings right now</h5>
<?php }?>