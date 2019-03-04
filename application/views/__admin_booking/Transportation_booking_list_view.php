<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	All Transportation Bookings Here ...
    		</h2>
    		<hr>
    		<?php if($search_costumer_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_transportation_bookings) { ?>
            					<?php if($total_transportation_bookings > 1) { ?>
            						<?php echo $total_transportation_bookings;  ?> results
            					<?php } else if($total_transportation_bookings == 1) { ?>
            						<?php echo $total_transportation_bookings;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_costumer_name; ?>&quot;</strong>
        				</div>
        			</li>
        		</ul>
        	<?php } ?>	
        	<?php
                $attributes = array(
                    'method' => 'get',
                    'class' => 'search-bar',
                    'enctype' => 'application/x-www-form-urlencoded' 
                );
                
                echo form_open('admin/booking/transportation-bookings', $attributes);
    		?>
            <div class="row">
				<div class="col-sm-5">
					<?php
						$attributes = array(
							'name' => 'search_booking_no',
							'placeholder' => 'Search for Booking no ...',
							'class' => 'form-control input-lg',
							'value' => $search_booking_no
						);
						echo form_input($attributes);
					?>
				</div>
				<div class="col-sm-5">
					<?php
						$attributes = array(
							'name' => 'search_costumer_name',
							'placeholder' => 'Search Costumer Name...',
							'class' => 'form-control input-lg',
							'value' => $search_costumer_name
						);
		
						echo form_input($attributes);
					?>
				</div>
            </div>
            <br>
            <div class="row">	
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_agent_name',
                            'placeholder' => 'Search for Agent Name...',
                            'class' => 'form-control input-lg',
                            'value' => $search_agent_name
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
            	
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_arrival_date',
                            'id' => 'search_start_date',
                            'placeholder' => 'Search for date   ...',
                            'class' => 'form-control input-lg datepicker',
                            'value' => $search_arrival_date
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
              
				<?php
					$attributes = array(
						'type' => 'submit',
						'content' => 'Search <i class="entypo-search"></i>',
						'class' => 'btn btn-lg btn-primary btn-icon pull-right'
					);

					echo form_button($attributes);
				?>
            </div>
        	<?php echo form_close(); ?>
    		<div class="row">
        		<div class="col-sm-12">
        			<p>Please Select Booking(s) to change there status</p>
            		<a href="javascript:void(0);" onclick="confirmClick();" class="btn btn-green  btn-icon icon-left">
                        <i class="entypo-check"></i> Marked as Complete
                    </a>
            		<a href="javascript:void(0);" onclick="cancelClick();" class="btn btn-gold btn-icon icon-left">
        				<i class="entypo-cancel"></i> Marked as Cancel
        			</a>
        		</div>
    	   </div>
    	   <br/>
    		<div class="search-results-pane">
        		<table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                			<th class ="col-sm-1">
                	   			<div class="checkbox checkbox-replace">
                            		<input type="checkbox" id="chk-all">
                            	</div>
                            </th>	
                			<th class ="col-sm-2">
                			Booking No<span class="pull-right"><i class="<?php if(isset($sort_booking_no)){echo $sort_booking_no;}else{echo 'entypo-up-open';}?>" id="sort-by-booking-no"></i></span>
                			</th>
                			<th class="col-sm-2">
                          	 	
								Customer <span class="pull-right"><i class="<?php if(isset($sort_customer_name)){echo $sort_customer_name;}else{echo 'entypo-up-open';}?>" id="sort-by-customer-name"></i></span>
                          		
                			</th>
                			<th class="col-sm-2">
                				Agent Name <span class="pull-right"><i class="<?php if(isset($sort_agent_name)){echo $sort_agent_name;}else{echo 'entypo-up-open';}?>" id="sort-by-agent-name"></i></span>
                			</th>
                			<th class="col-sm-2">
                			Arrival Date <span class="pull-right"><i class="<?php if(isset($sort_arrival_date)){echo $sort_arrival_date;}else{echo 'entypo-up-open';}?>" id="sort-by-arrival-date"></i></span>
                			</th>
                			<th class="col-sm-1">
                				Arrival Time
                			</th>
							<th class="col-sm-2">
                			Departure Date <span class="pull-right"><i class="<?php if(isset($sort_dept_date)){echo $sort_dept_date;}else{echo 'entypo-up-open';}?>" id="sort-by-dept-date"></i></span>
                			</th>
                			<th class="col-sm-1">
                				Departure Time
                			</th>
                			<th class="col-sm-1">
                				<?php echo $text_booking_status; ?>
                			</th>
							<th class="col-sm-1">
								<?php echo $text_payment_status; ?>
							</th>
                			<th class="col-sm-1">
                				<?php echo $text_action; ?>
                			</th>
                		</tr>
                	</thead>
					<tbody>
						<?php if($transportation_bookings) { ?>
    						<?php $sr = 1; ?>
    							<?php foreach($transportation_bookings as $transportation_booking) { ?>
    								<tr>
                        				<td>
                        					<div class="checkbox checkbox-replace">
                                				<input type="checkbox" name="checked_ids[]" value="<?php echo $transportation_booking['booking_id']; ?>">
                                			</div>
                        				</td>
										<td>
    										<small>
                            					<?php echo $transportation_booking['booking_no']; ?>
                            				</small>	
                                		</td>
                        				<td>
                        					<?php echo isset($customers[$transportation_booking['booking_customer_id']]) ? $customers[$transportation_booking['booking_customer_id']] : THREE_DASH; ?>
                        				</td>
										<td>
											<?php echo $transportation_booking['company_legal_name']; ?>
                        				</td>
                        				<td>
                        					<?php if($transportation_booking['flight_arrival_date'] != '0000-00-00 00:00:00') { ?>
												<?php echo d_to_lu($transportation_booking['flight_arrival_date']); ?>
											<?php } else { ?>
												<?php echo THREE_DASH; ?>
											<?php } ?>
                        				</td> 
                    					<td>
											<?php if(isset($transportation_booking['flight_arrival_time'])){echo $transportation_booking['flight_arrival_time'];}else{echo THREE_DASH;} ?>
                        				</td>
										<td>
                        					<?php if($transportation_booking['flight_departure_date'] !='0000-00-00 00:00:00') { ?>
												<?php echo d_to_lu($transportation_booking['flight_departure_date']); ?>
											<?php } else { ?>
												<?php echo THREE_DASH; ?>
											<?php } ?>
                        				</td> 
                    					<td>
                        					<?php if(isset($transportation_booking['flight_departure_time'])){echo $transportation_booking['flight_departure_time'];}else{echo THREE_DASH;} ?>
                        				</td>
										<td>
										  <div class="label <?php if($booking_statuses[$transportation_booking['booking_status']]=='Completed'){
        											    echo 'label-primary';
										        }elseif($booking_statuses[$transportation_booking['booking_status']]=='Canceled'){
                            							echo 'label-danger';
        										}elseif($booking_statuses[$transportation_booking['booking_status']]=='Failed'){
                            							 echo 'label-warning';
        										}elseif($booking_statuses[$transportation_booking['booking_status']]=='Confirmed') {
                            							 echo 'label-success';
                            					 }
                            					 else {
                            						 echo 'label-danger';
                            						 }
                            						?>">
        											<?php echo isset($booking_statuses[$transportation_booking['booking_status']]) ? $booking_statuses[$transportation_booking['booking_status']] : THREE_DASH; ?>
											</div>
	                        			</td>
                        				<td>
                        				<div class="label <?php if($payment_statuses[$transportation_booking['payment_status']]=='Completed'){
											                             echo 'label-success';
                                                    				}elseif($payment_statuses[$transportation_booking['payment_status']]=='Pending'){
                                                						  echo 'label-warning ';
                                                    				}elseif($payment_statuses[$transportation_booking['payment_status']]=='Failed'){
                                                						  echo 'label-warning ';
                                                    				}elseif($payment_statuses[$transportation_booking['payment_status']]=='Initialize') {
                                                						   echo 'label-info'; 
                                                					 }
                                                					 else {
                                                					        echo 'label-info';
                                                						  }
                    											?>">
                    											<?php echo isset($payment_statuses[$transportation_booking['payment_status']]) ? $payment_statuses[$transportation_booking['payment_status']] : THREE_DASH; ?>
											 </div>
                        					
                        				</td>
                    					<td>
                    						<a href="<?php echo base_url('admin/booking/transportation-bookings/get?secure_token=' . $this->security_lib->encrypt($transportation_booking['booking_id'])); ?>" class="btn btn-blue btn-sm btn-icon icon-left">
                        						<i class="entypo-eye" ></i> <?php echo $text_view; ?>
                        				 	</a>
                        					<!--<a href="<?php echo base_url('admin/booking/transportation-bookings/edit?secure_token=' . $this->security_lib->encrypt($transportation_booking['booking_id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                        						<i class="entypo-pencil"></i> <?php echo $text_edit; ?>
                        					</a>-->
                        				</td>					
    								</tr>
    								<?php $sr++; ?>
    							<?php } ?>
                        	<?php } else { ?>
                        		<tr>
                        			<td colspan="11" class="text-center">
                        				No Record Found!
                        			</td>
                        		</tr>
                        	<?php } ?>	
						</tbody>
					</table>
					<div class="col-sm-12 text-right">
                   		<?php echo $pagination; ?> 
                 </div> 
			</div>
		</div>
	</div>
</section>
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>
<script>
$(function() {
    $('#search_start_date').datepicker({
		format: 'dd-mm-yyyy',     
    });
});
</script>
<script>
var url = "<?php echo current_url();?>";
var query_string = "<?php echo $_SERVER['QUERY_STRING'];?>";

$("#sort-by-booking-no").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	
	/* if(query_string!=''){
		url = url+'?'+query_string +'&sort_booking_no='+sort_key;
	}
	else{
		url = url+'?sort_booking_no='+sort_key;
	} */
	
	url = url+'?sort_booking_no='+sort_key;
	window.location.href = url;
});
$("#sort-by-customer-name").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_customer_name='+sort_key;
	window.location.href = url;
	
});
$("#sort-by-agent-name").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_agent_name='+sort_key;
	window.location.href = url;
});

$("#sort-by-arrival-date").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_arrival_date='+sort_key;
	window.location.href = url;
});
$("#sort-by-dept-date").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_dept_date='+sort_key;
	window.location.href = url;
});
</script>
<script type="text/javascript">
$('#chk-all').on('click', function () {
	if ($(this).is(':checked')) {
		$('input:checkbox').each(function () {
			$(this).attr('checked', true);
			$(this).parent().parent().addClass('checked');
		});
	} else {
		$('input:checkbox').each(function () {
			$(this).attr('checked', false);
			$(this).parent().parent().removeClass('checked');
		});
	}
});
function confirmClick() {
	var requestedBookingIds = Array();
    $(':checkbox:checked').each(function(i) {
        var id = $.trim($(this).val());
        if(id.length > 0 && id != '' && id != 'on') {
    		requestedBookingIds.push(id);
        }
    });
    if(requestedBookingIds.length > 0) {
    	 $.ajax({
    		 	url: '<?php echo base_url()?>admin/booking/transportation-bookings/confirm_bookings',
   			method: 'get',
     		data: {data:requestedBookingIds}, 
     		dataType: 'html',
     		success: function (response) {
     			window.location.href="<?php echo base_url()?>admin/booking/transportation-bookings";
     		}
     	});
    }
}
function cancelClick() {
	var requestedBookingIds = Array();
    $(':checkbox:checked').each(function(i) {
        var id = $.trim($(this).val());
        if(id.length > 0 && id != '' && id != 'on') {
    		requestedBookingIds.push(id);
        }
    });
    if(requestedBookingIds.length > 0) {
    	 $.ajax({
    		 	url: '<?php echo base_url()?>admin/booking/transportation-bookings/cancel_bookings',
   			method: 'get',
     		data: {data:requestedBookingIds}, 
     		dataType: 'html',
     		success: function (response) {
     			window.location.href="<?php echo base_url()?>admin/booking/transportation-bookings";
     		}
     	});
    }
}
</script>