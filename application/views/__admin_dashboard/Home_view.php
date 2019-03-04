<div class="row">
	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-chart-bar"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $total_bookings; ?>" data-postfix="" data-duration="1500" data-delay="600"><?php echo $total_bookings; ?></div>

			<h3>Total Bookings</h3>
			<p>Including Tour, Transportation etc...</p>
		</div>

	</div>
	
	<div class="col-sm-3 col-xs-6">
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $total_customers; ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $total_customers; ?></div>

			<h3>Total Customers</h3>
			<p>All General, Premium &amp; Fraud</p>
		</div>
	</div>
			
	<div class="clear visible-xs"></div>
	
	<div class="col-sm-3 col-xs-6">
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-users"></i></div>
			<div class="num" data-start="0" data-end="<?php echo $total_parks; ?>" data-postfix="" data-duration="1500" data-delay="0"><?php echo $total_parks; ?></div>

			<h3>Total Parks</h3>
			<p>All Tour, Transport etc..</p>
		</div>
	</div>

	<div class="clear visible-xs"></div>
		
	<div class="col-sm-3 col-xs-6">

		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-rss"></i></div>
			<div class="num" data-start="0" data-end="52" data-postfix="" data-duration="1500" data-delay="1800">52</div>

			<h3>Subscribers</h3>
			<p>on our site right now.</p>
		</div>

	</div>
</div>
<div class="row">
    <div class="panel panel-primary">
		<div class="panel-heading">
			<div class="panel-title">Last 10 Bookings</div>
		</div>

		<div class="panel-body with-table"><table class="table table-bordered table-responsive">
			<thead>
				<tr>
					<th>#Booking No</th>
					<th>Customer Name</th>
					<th>Park Name</th>
					<th>Status</th>
				</tr>
			</thead>

			<tbody>
				<?php if(isset($bookings) && !empty($bookings)) { ?>
    				<?php foreach ($bookings as $booking) { ?>
        				<tr>
        					<td>
        						<?php echo $booking['booking_no']; ?>
        					</td>
        					<td>
        						<?php echo $booking['firstname'] . ' ' . $booking['lastname']; ?>
        					</td>
        					<td>
        						<?php echo $booking['company_legal_name']; ?>
        					</td>
        					<td>
								<div class="label <?php if($booking_statuses[$booking['booking_status']] == 'Completed') {
							                                 echo 'label-primary';
							                          } else if($booking_statuses[$booking['booking_status']] == 'Canceled') {
    											              echo 'label-danger';
    											      } else if($booking_statuses[$booking['booking_status']] == 'Failed') {
    											          echo 'label-warning';
    											      } else if($booking_statuses[$booking['booking_status']] == 'Confirmed') {
    											           echo 'label-success';
    										          } else {
    											           echo 'label-danger';
    										          }
    											?>">
								<?php echo isset($booking_statuses[$booking['booking_status']]) ? $booking_statuses[$booking['booking_status']] : THREE_DASH; ?>
								</div>
            				</td>
        				</tr>
    				<?php } ?>
    			<?php } else { ?>
    				<tr>
    					<td colspan="4">No Record Found!</td>
        			</tr>
    			<?php } ?>	
			</tbody>
		</table></div>
	</div>
</div>