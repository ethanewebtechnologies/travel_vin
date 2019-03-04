<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	Club And Bar Booking Invoice Request Here ...
    		</h2>
    		<hr>
    	      <?php if ($search_agent_name) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_club_and_bar_bookings) { ?>
                                <?php if ($total_club_and_bar_bookings > 1) { ?>
                                    <?php echo $total_club_and_bar_bookings; ?> results
                                <?php } else if ($total_club_and_bar_bookings == 1) { ?>
                                    <?php echo $total_club_and_bar_bookings; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_agent_name; ?>&quot;</strong>
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
                echo form_open('admin/agent/invoice-request', $attributes);
    		?>
			<!-- CSRF NAME -->
			<?php
				$attributes = array(
					'type' => 'hidden',
					'id' => '_CTN',
					'name' => '_CTN',
					'value' => $this->security->get_csrf_token_name()
				);
		
				echo form_input($attributes);
			?>
		
			<?php
				$attributes = array(
					'type' => 'hidden',
					'id' => '_CTH',
					'name' => '_CTH',
					'value' => $this->security->get_csrf_hash()
				);
		
				echo form_input($attributes);
			?>

			<input type="hidden" id="hash_update" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
			<!-- END OF CSRF  -->
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
				<!--<div class="col-sm-5">
					<?php
						$attributes = array(
							'name' => 'search_costumer_name',
							'placeholder' => 'Search Costumer Name...',
							'class' => 'form-control input-lg',
							'value' => $search_costumer_name
						);

						echo form_input($attributes);
					?>
				</div>-->
				<div class="col-sm-7"></div>
            </div>
			<br>
            <div class="row">	
            	<div class="col-sm-5">
				<?php
					$attributes = array(
						'name' => 'search_agent_name',
						'placeholder' => 'Search for Park Name...',
						'class' => 'form-control input-lg',
						'value' => $search_agent_name
					);
					echo form_input($attributes);
				?>
            	</div>
            	<div class="col-sm-5">
				<?php
					$attributes = array(
						'name' => 'search_club_and_bar_invoice_date',
						'id' => 'search_club_and_bar_invoice_date',
						'placeholder' => 'Search for date   ...',
						'class' => 'form-control input-lg datepicker',
						'value' => $search_club_and_bar_invoice_date
					);
					echo form_input($attributes);
				?>
            	</div>
				<div class="col-sm-2">
				<?php
					$attributes = array(
						'type' => 'submit',
						'content' => 'Search <i class="entypo-search"></i>',
						'class' => 'btn btn-lg btn-primary btn-icon pull-right'
					);
					echo form_button($attributes);
				?>
                </div>
            </div>
        	<?php echo form_close(); ?>
    		<span class="pull-left btn-toolbar">
                    <a onclick="generateInvoiceInBulk();" class="btn btn-blue  btn-icon icon-left" href="javascript:void(0);">
                        <i class="entypo-paper-plane"></i> Generate Invoice in Bulk
                    </a>
                </span>
                <br><br>
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
                			<th>
                				Vendor Invoice No
                			</th>
                			<th class="col-sm-2">
                			Invoice Date <span class="pull-right"><i class="<?php if(isset($sort_club_and_bar_invoice_date)){echo $sort_club_and_bar_invoice_date;}else{echo 'entypo-up-open';}?>" id="sort-by-club_and_bar-invoice-date"></i></span>
                			</th>
                			<th class="col-sm-2">
                				Park Name <span class="pull-right"><i class="<?php if(isset($sort_agent_name)){echo $sort_agent_name;}else{echo 'entypo-up-open';}?>" id="sort-by-agent-name"></i></span>
                			</th>
                			<th>
                				<?php echo $text_booking_status; ?>
                			</th>
							<th>
								<?php echo $text_payment_status; ?>
							</th>
                			<th>
                				<?php echo $text_action; ?>
                			</th>
                		</tr>
                	</thead>
					<tbody>
						<?php if($club_and_bar_bookings) { ?>
    						<?php $sr = 1; ?>
    							<?php foreach($club_and_bar_bookings as $club_and_bar_booking) { ?>
    								<tr>
    									<td>
                            				<?php if(isset($club_and_bar_booking['invoice_path']) && !empty($club_and_bar_booking['invoice_path'])) { ?>
                            				<?php } else { ?>
                                				<div class="checkbox checkbox-replace">
                                					<input type="checkbox" id="checked-ids-<?php echo $club_and_bar_booking['booking_id']; ?>" name="checked_ids[]" value="<?php echo $club_and_bar_booking['booking_id']; ?>">
                                				</div>
                            				<?php } ?>
                            			</td>
                        				<td>
                        					<?php echo $club_and_bar_booking['booking_no']; ?>
                        				</td>
                        				<td>
                        					<?php echo isset($club_and_bar_booking['vendor_invoice_no']) ? $club_and_bar_booking['vendor_invoice_no'] : THREE_DASH; ?>
                        				</td>
                        				
                        				<td>
                        					<?php echo d_to_lu($club_and_bar_booking['date_generated']); ?>
                        				</td>
                        				<td>
                        					<?php echo isset($club_and_bar_booking['company_legal_name']) ? $club_and_bar_booking['company_legal_name'] : THREE_DASH; ?>
                        				</td>
										<td>
											<div class="label <?php if(isset($booking_statuses[$club_and_bar_booking['booking_status']]) && $booking_statuses[$club_and_bar_booking['booking_status']]=='Completed'){echo 'label-success';}else{echo 'label-danger';}?>">
												<?php echo isset($booking_statuses[$club_and_bar_booking['booking_status']]) ? $booking_statuses[$club_and_bar_booking['booking_status']] : THREE_DASH; ?>
											</div>
                        				</td>
                        				<td>
                        					<?php echo isset($payment_statuses[$club_and_bar_booking['payment_status']]) ? $payment_statuses[$club_and_bar_booking['payment_status']] : THREE_DASH; ?>
                        				</td>
                    					<td>
                    						<a href="<?php echo base_url('admin/booking/club_and_bar-bookings/get?secure_token=' . $this->security_lib->encrypt($club_and_bar_booking['booking_id']).'&back_url=agent/invoice-request'); ?>" class="btn btn-blue btn-sm btn-icon icon-left">
                        						<i class="entypo-eye" ></i> <?php echo $text_view; ?>
                        				 	</a>
                        					<!--<a href="<?php echo base_url('admin/booking/club_and_bar-bookings/edit?secure_token=' . $this->security_lib->encrypt($club_and_bar_booking['booking_id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                        						<i class="entypo-pencil"></i> <?php echo $text_edit; ?>
                        					</a>-->
                        				</td>					
    								</tr>
    								<?php $sr++; ?>
    							<?php } ?>
                        	<?php } else { ?>
                        		<tr>
                        			<td colspan="9" class="text-center">
                        				<?php echo $text_no_result; ?>
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
    $('#search_club_and_bar_invoice_date').datepicker({
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
	url = url+'?sort_booking_no='+sort_key;
	window.location.href = url;
});
/* $("#sort-by-customer-name").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_customer_name='+sort_key;
	window.location.href = url;
}); */
$("#sort-by-agent-name").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_agent_name='+sort_key;
	window.location.href = url;
});

$("#sort-by-club_and_bar-invoice-date").click(function(){
	var attr_class = $(this).attr('class');
	var sort_key;
	if(attr_class=='entypo-up-open'){$(this).attr('class','entypo-down-open');sort_key = 'DESC';}
	else if(attr_class=='entypo-down-open'){$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	else{$(this).attr('class','entypo-up-open');sort_key = 'ASC';}
	url = url+'?sort_club_and_bar_invoice_date='+sort_key;
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

function generateInvoiceInBulk() {
    var requestedBookingIds = Array();
    $(':checkbox:checked').each(function(i) {
       var id = $.trim($(this).val());

        if(id.length > 0 && id != '' && id != 'on') {
    		requestedBookingIds.push(id);
        }
    });

    if(requestedBookingIds.length > 0) {
        secure_token = $('#hash_update').attr('name');
        secure_hash = $('#hash_update').attr('value');
        var post_url = "<?php echo base_url('admin/agent/club_and_bar-invoice-request/generate_invoice_in_bulk'); ?>";
    	var post_method = 'POST';
    	var post_data = {
    			requested_booking_ids: requestedBookingIds
    	};
    
    	post_data[secure_token] = secure_hash;
    
    	$.ajax({
    		url: post_url,
    		method: post_method,
    		data: post_data,
    		success: function (response) {
    			//location.reload();
    			$('#hash_update').attr('name', response.secure_token);
    			$('#hash_update').attr('value', response.secure_hash);
    			var opts = {
    					"closeButton": true,
    	    	};

    	    	toastr.success(response.success, "Success", opts);
    		}
    	});
    } else {
    	var opts = {
				"closeButton": true,
    	};

    	toastr.error("You have not selected any bookings!", "Error", opts);
        return false;
    }
}
</script>
