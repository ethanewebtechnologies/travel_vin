  <html><body>
										  
	<table width="100%"; rules="all" style="border:3px solid #101758; background:#f1f1f1;" cellpadding="13">
		<tr>
			<td colspan="2"><img src="<?php echo base_url("assets/img/travelimg-email.jpg") ?>" alt="Travel"/></td>
		</tr>
										 <?php $c=1;for($i=0;$i < count($email_data);$i++) { ?> 
										 <tr><td>Booking detail <?php echo $c;?> </td></tr> 
									   <tr><td>Name </td><td><?php echo $email_data[$i]['firstname']." ".$email_data[$i]['lastname'];?></td></tr> 
									    
										  <tr><td>Booking Number </td><td><?php echo $email_data[$i]['booking_no'];?></td></tr>
										   <tr><td>Booking Date</td><td><?php echo $email_data[$i]['booking_date'];?></td></tr>
										   <tr><td>Tour start date</td><td><?php echo $email_data[$i]['tour_start_date'];?></td></tr>
										   <tr><td>Duration</td><td>
										   
										   <?php $dStart = new DateTime($email_data[$i]['tour_start_date']);
													$dEnd  = new DateTime($email_data[$i]['tour_end_date']);
													$dDiff = $dStart->diff($dEnd);
													$dDiff->format('%R'); // use for point out relation: smaller/greater
													echo $dDiff->days;
													?>
										   
										   </td></tr>
										   <tr><td>Pickup Time</td><td><?php echo $email_data[$i]['pickup_time'];?></td></tr>
										   <tr><td>Subtotal </td><td><?php echo $email_data[$i]['booking_amount_paid'];?></td></tr> 
										   <tr><td>Number of Adults</td><td><?php echo $email_data[$i]['booking_adults'];?></td></tr> 
										 <tr><td>Number of Childs</td><td><?php echo $email_data[$i]['booking_child'];?></td></tr> 
									 
									   
									   <tr><td>Grand Total </td><td><?php echo $email_data[$i]['grand_total'];?></td></tr>
										 <?php $c++;}?>	   
										   
									   </table>
										  
									   </body></html>
									   