<?php if(isset($customer_addresses) && !empty($customer_addresses)){?>
<table>
	<thead>
		<tr>
			<th>#</th>
			<th>Address</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
		<?php $i=0; foreach($customer_addresses as $addresses){?>
		<tr>
			<td><?php echo ++$i;?></td>
			<td><?php echo $addresses['address_1'];?>, <?php echo $addresses['address_2'];?>, <?php echo $addresses['city'];?>, <?php echo $addresses['state'];?> <?php echo $addresses['postcode'];?></td>
			<td><a href="#edit_address" class="fancybox"><i class="fa fa-edit"></i></a></td>
		</tr>
		<?php }?>
	</tbody>
</table>
<?php }else{?>
<h5>No address saved</h5>
<?php }?>