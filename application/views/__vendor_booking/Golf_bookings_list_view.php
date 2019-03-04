<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
    		<h2>
                All Bookings Here
            </h2>
            <hr>
    		<?php if($search_booking_no) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_golf_bookings) { ?>
            					<?php if($total_golf_bookings > 1) { ?>
            						<?php echo $total_golf_bookings;  ?> results
            					<?php } else if($total_golf_bookings == 1) { ?>
            						<?php echo $total_golf_bookings;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_booking_no; ?>&quot;</strong>
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
                
                echo form_open('vendor/booking/golf-bookings', $attributes);
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
        		
        		<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_booking_no',
                            'placeholder' => 'Search golf Bookings...',
                            'class' => 'form-control input-lg',
                            'value' => $search_booking_no
                        );
                        
                        echo form_input($attributes);
    				?>
    				<div class="input-group-btn">
    					<?php
                            $attributes = array(
                                'type'          => 'submit',
                                'content'       => 'Search <i class="entypo-search"></i>',
                                'class'         => 'btn btn-lg btn-primary btn-icon'
                            );
                            
                            echo form_button($attributes);
                    	?>
    				</div>
    			</div>
			<?php echo form_close(); ?>
			<p>
        			<em>
        				<i class="entypo-info-circled"></i> Please Select Booking(s) to raise invoice requests
        			</em>
    			</p>
    		<span class="pull-left btn-toolbar">
                    <a href="javascript:void(0);" onclick="openInvoiceDataForm();" class="btn btn-blue  btn-icon icon-left">
                        <i class="entypo-sound"></i> Raise Invoice Requests
                    </a>
                </span><br><br>
    		<div class="search-results-pane">
        		<table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                			<th class="col-sm-1">
                	   			<div class="checkbox checkbox-replace">
                            		<input type="checkbox" id="chk-all">
                            	</div>
                			</th> 
                			<th class="col-sm-2">
                				Booking No
                			</th>
                			<th class="col-sm-4">
                				Booking Golf
                			</th>
                			<th class="col-sm-1">
								Pickup Time
							</th>
                			<th class="col-sm-1">
                				<?php echo $text_booking_status; ?>
                			</th>
                			<th class="col-sm-2">
                				<?php echo $text_action; ?>
                			</th>
                		</tr>
                	</thead>
					<tbody>
						<?php if($golf_bookings) { ?>
    						<?php foreach($golf_bookings as $golf_booking) { ?>
								<tr>
                        			<td>
                        				<?php if(isset($invoice_paths[$golf_booking['booking_id']]) && !empty($invoice_paths[$golf_booking['booking_id']])) { ?>
                        				<?php } else { ?>
                            				<div class="checkbox checkbox-replace">
                            					<input type="checkbox" id="checked-ids-<?php echo $golf_booking['booking_id']; ?>" name="checked_ids[]" value="<?php echo $golf_booking['booking_id']; ?>">
                            				</div>
                        				<?php } ?>
                        			</td>
                    				<td>
                    					<?php if(isset($invoice_paths[$golf_booking['booking_id']]) && !empty($invoice_paths[$golf_booking['booking_id']])) { ?> 
											<?php $href =  base_url('vendor/booking/golf-bookings/invoice?secure_token=' . $this->security_lib->encrypt($golf_booking['booking_id'])); ?>
										<?php } else { ?>
											<?php $href = "javascript:void(0)"; ?>
										<?php } ?>
										
										<a target="_blank" href="<?php echo $href; ?>">
                    						<?php echo $golf_booking['booking_no']; ?>
                    					</a>	
                    				</td>
									<td>
										<p>
											<small>
												<b>Customer: </b> <?php echo isset($customers[$golf_booking['booking_customer_id']]) ? $customers[$golf_booking['booking_customer_id']] : THREE_DASH; ?>
											</small>
										</p>
										<p>
											<small>
												<b>Start Date: </b> <?php echo d_to_lu($golf_booking['start_date']); ?> 
											</small>
										</p>
										<!--<p>
											<small>
												<b>Duration: </b> <?php echo duration($golf_booking['golf_start_date'], $golf_booking['golf_end_date']); ?>
											</small>
										</p>-->
							        </td>
                    			
                    				<td>
                    					<?php echo $golf_booking['pickup_time'] ;  ?>
                    				</td>
									<td>
									
									 <div class="label <?php if($booking_statuses[$golf_booking['booking_status']]=='Completed'){
                											  echo 'label-primary';
									            }elseif($booking_statuses[$golf_booking['booking_status']]=='Canceled'){
                                                			echo 'label-danger';
									            }elseif($booking_statuses[$golf_booking['booking_status']]=='Failed'){
                                                			 	 echo 'label-warning';
									            }elseif($booking_statuses[$golf_booking['booking_status']]=='Confirmed') {
                                                			 echo 'label-success';
                    							 } else {
                                    			        echo 'label-danger';
                                    						       }
                                                    ?>">
                									<?php echo isset($booking_statuses[$golf_booking['booking_status']]) ? $booking_statuses[$golf_booking['booking_status']] : THREE_DASH; ?>
										</div>
                    				</td>
									
                					<td>
            							<a href="<?php echo base_url('vendor/booking/golf-bookings/get?secure_token=' . $this->security_lib->encrypt($golf_booking['booking_id'])); ?>" class="btn btn-blue btn-sm btn-icon icon-left">
                    						<i class="entypo-eye" ></i> <?php echo $text_view; ?>
                    				 	</a>
                						<?php if(isset($invoice_paths[$golf_booking['booking_id']]) && !empty($invoice_paths[$golf_booking['booking_id']])) { ?>
											<a href="<?php echo base_url('vendor/booking/golf-bookings/download?secure_token=' . $this->security_lib->encrypt($golf_booking['booking_id'])); ?>" class="btn btn-green btn-sm btn-icon icon-left">
                        						<i class="entypo-download"></i> <?php echo $text_invoice; ?>
                        					</a>
										<?php } ?>									
                    				</td>					
								</tr>
								<?php } ?>
                    			<?php } else { ?>
                    		<tr>
                    			<td colspan="7" class="text-center">
                    				<?php echo "No Result Found"; ?>
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


<!-- Raise Invoice Modal (Type: Long Modal) -->
<div class="modal fade" id="raise-invoice-form">
    <?php 
        $attributes = array(
            'class' => 'form-horizontal form-groups-bordered',
            'id' => 'save_change',
            'onsubmit' => ''
        );  
        
        echo form_open('', $attributes); 
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
		
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title">Customize Invoice Details</h4>
				</div>
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                            	<?php
                            	    $attributes = array(
                            	        'class' => 'control-label col-sm-4'
                            	    );
                            	    
                                	echo form_label('Invoice Number: ', 'invoice_no', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php 	
                                    	$attributes = array(
                                    	    'name' => 'invoice_no',
                                    	    'placeholder' => 'Example - INV-2017-0001',
                                    	    'class' => 'form-control',
                                    	    'id'   => 'invoice_no',
                                    	    'data-validation' => 'required',
                                    	    'data-validation-error-msg-required'=> 'Invoice No. Required',
        									'value' => set_value('invoice_number')
                                    	);
                                    	
                                    	echo form_input($attributes);
                                	?>
                                	
                                	<span class="description">Note: Invoice Number once you assigned cannot be change!</span>
                                </div>
                    		</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
                      			<?php 
                                    $attributes = array(
                                        'class' => 'control-label col-sm-4'
                                    );
                             
                                    echo form_label('Invoice Date: ', 'date_generated', $attributes); 
                                ?>
							
								<div class="col-sm-8">
									<?php 
                                        $attributes = array(
                                            'name' => 'date_generated',
                                            'id'	=>	'date_generated',
                                            'class' => 'form-control datepicker',
                                            'data-format' => 'dd-mm-yyyy',
                                            'placeholder' => 'DD-MM-YYYY',
    									    'value' => set_value('date_generated')
                                        );
    
                                        echo form_input($attributes);
                                    ?> 
                                    
                                    <span class="description">Note: Invoice Date once you assigned cannot be change!</span>
								</div>
							</div>
						</div>
					</div>
				</div>
    			<div class="modal-footer">				       	
                    <span class="pull-right btn-toolbar">
                		<?php
                            $attributes = array(
                                'name'          => 'save_changes',
                                'id'            => 'save_changes',
                                'value'         => 'Save changes',
                                'type'          => 'button',
                                'content'       => 'Save changes',
                                'class'         => 'btn btn-info'
                            );
                            
                            echo form_button($attributes);
                    	?>
    					
                    	<a class="btn btn-default" href="<?php echo base_url('vendor/booking/golf-bookings'); ?>">
                			Close
                		</a>
    				</span>
    			</div>
			<?php echo form_close(); ?>
		</div>
	</div>
</div>

<!-- Raise Invoice Modal (Type: Long Modal) -->
<div class="modal fade" id="alert-blank">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Alert!</h4>
			</div>
			<div class="modal-body">
				You have not selected any booking.
			</div>
			<div class="modal-footer">				       	
                <span class="pull-right btn-toolbar">
                	<a class="btn btn-default" href="<?php echo base_url('vendor/booking/golf-bookings'); ?>">
            			Close
            		</a>
				</span>
			</div>
		</div>
	</div>
</div>

<!-- 
/* 
* FIXED BY VINAY KUMAR SHARMA
* 
* START
* 
*  */
 -->

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

function openInvoiceDataForm() {
	var requestedBookingIds = Array();
	 
    $(':checkbox:checked').each(function(i) {
        var id = $.trim($(this).val());
    
        if(id.length > 0 && id != '' && id != 'on') {
    		requestedBookingIds.push(id);
        }
    });
    
    if(requestedBookingIds.length > 0) {
		jQuery('#raise-invoice-form').modal('show', {backdrop: 'static'});
    } else {
    	jQuery('#alert-blank').modal('show', {backdrop: 'static'});
    }
}
</script>

<script>

$(document).ready(function() {
	$('#save_changes').click(function(e) {
		e.preventDefault();

		var invoice_no = $('#invoice_no').val();
		var date_generated = $('#date_generated').val();

		var post_method = 'POST';
		var post_url = "<?php echo base_url('vendor/booking/golf-bookings/raise-invoice'); ?>";

		var pdata = [];

	 	$(':checkbox:checked').each(function(i) {
	        var id = $.trim($(this).val());
	    
	        if(id.length > 0 && id != '' && id != 'on') {
	    		pdata.push(id);
	        }
	    });

	 	if(pdata.length > 0) {

    	 	data = {
    	 		checked_ids: pdata,
    	 		invoice_no: invoice_no,
    	 		date_generated: date_generated,
    	 	};
    
    	 	secure_token = $('#hash_update').attr('name');
            secure_hash = $('#hash_update').attr('value');
    
            data[secure_token] = secure_hash;

    		 $.ajax({
       		 	url: post_url,
      			method: post_method,
        		data: data, 
        		dataType: 'html',
        		success: function (response) {
        			$('#hash_update').attr('name', response.secure_token);
        			$('#hash_update').attr('value', response.secure_hash);

        			var opts = {
    					"closeButton": true,
        	    	};
        	    	toastr.success(response.success, "Success", opts);
        	    	window.location.href="<?php echo base_url('vendor/booking/golf-bookings'); ?>";
        		}
        	});
    	} else {
        	var opts = {
    				"closeButton": true,
        	};
    
        	toastr.error("You have not selected any bookings!", "Error", opts);
            return false;
        }
	});

	$(function() {
	    $('#date_generated').datepicker({
	        startDate: '-0m',
			format: 'dd-mm-yyyy',     
	    });
	});
});
</script>

<!-- 
/* 
* END OF FIXED
* 
*  */
 -->
