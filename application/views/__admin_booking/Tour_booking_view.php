<div class="row">
    <div class="col-md-12">
        <h2>
            Tour Booking Details

            <span class="pull-right btn-toolbar">
				<?php if($this->input->get('back_url') && $this->input->get('back_url')!=''){
					$back_url = $this->input->get('back_url');
				?>
					<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/'.$back_url); ?>">
						<i class="entypo-back"></i> Back
					</a>

				<?php }else{?>
					<a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/booking/tour-bookings'); ?>">
						<i class="entypo-back"></i> Back
					</a>
				<?php }?>
            </span>
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
                 <table class="table table-striped table-view">
                    <tbody>
                    	 <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Customer Name</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['firstname'] . ' ' . $tour_booking['lastname']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking No</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_no']; ?>
                            </td>
                        </tr>
                         <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>No. of Adults</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_adults']; ?>
                            </td>
                        </tr>
                        <?php if(!empty($tour_booking['booking_child'])) { ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>No. of Childs</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_child']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Tour Start Date</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($tour_booking['tour_start_date']); ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Pickup Time</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['pickup_time']; ?>
                            </td>
                        </tr>
                        <?php if(!empty($tour_nooking['tour_end_date'])){?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Pickup Time</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($tour_booking['tour_end_date']); ?>
                            </td>
                        </tr>
                        <?php } ?>
                         <?php if(!empty($tour_nooking['booking_additional_notes'])){?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Additional Notes</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_additional_notes']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Amount Paid</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_amount_paid']; ?>
                            </td>
                        </tr>
                        <?php if(!empty($tour_booking['booking_payment_type'])){?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Payment Type</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_payment_type']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php  if(!empty($tour_booking['booking_checkout'])){ ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Checkout</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_checkout']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                          <?php  if(!empty($tour_booking['booking_tax'])){ ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Tax</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_tax']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Currency Code</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_curr_code']; ?>
                            </td>
                        </tr>
                          <?php  if(!empty($tour_booking['booking_curr_symbol'])){ ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Currency Symbol</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_curr_symbol']; ?>
                            </td>
                        </tr>
                        <?php } ?>
                        <?php  if(!empty($tour_booking['booking_cancellation_request'])){ ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Cancellation Request</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_cancellation_request']; ?>
                            </td>
                        </tr>
                        <?php }  ?>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Transaction Id</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $tour_booking['booking_txn_id']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Payment Date</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($tour_booking['booking_payment_date']); ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Payment Status</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo isset($payment_statuses[$tour_booking['payment_status']]) ? $payment_statuses[$tour_booking['payment_status']] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Status</b>
                            </td>
                           		 <td class="col-sm-9">
                                    <?php
                                        echo isset($booking_statuses[$tour_booking['booking_status']]) ?
                                        $booking_statuses[$tour_booking['booking_status']] : THREE_DASH;
                                    ?>
                           		 </td>
                           </tr>
                            <tr class="row">
                                <td class="col-sm-3 control-label">
                                    <b>Date OF Booking</b>
                                </td>
                                <td class="col-sm-9">
                                    <?php echo d_to_lu($tour_booking['booking_date']); ?>
                                </td>
                      	  </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>