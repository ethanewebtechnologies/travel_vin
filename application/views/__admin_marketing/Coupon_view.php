<div class="row">
    <div class="col-md-12">
        <h2>
            <?php echo "Tour Booking Details"; ?>

            <span class="pull-right btn-toolbar">
                <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('vendor/booking/tour-bookings'); ?>">
                    <i class="entypo-back"></i> Back
                </a>
            </span>
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table responsive">
                    <thead>
                        <tr class="row">
                            <th class="col-sm-3 control-label">
                                <b>Fields</b>
                            </th>
                            <th class="col-sm-8">
                                <b>Values</b>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Id</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_id']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Date</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_date']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Expiry</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_expiry']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Customer</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_customer_id']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Payment Type</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_payment_type']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Payment Status</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo isset($payment_statuses[$tour_booking['payment_status']]) ? $payment_statuses[$tour_booking['payment_status']] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Additional Notes</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_additional_notes']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Amount Paid</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_amount_paid']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Checkout</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_checkout']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Adults</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_adults']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Child</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_child']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Tax</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_tax']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Currency Code</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_curr_code']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Currency Symbol</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_curr_symbol']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Payment Date</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_payment_date']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Cancellation Request</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_cancellation_request']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Taxation Id</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['booking_txn_id']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Status</b>
                            </td>
                            <td class="col-sm-8">
                                <?php
                                echo isset($booking_statuses[$tour_booking['booking_status']]) ?
                                    $booking_statuses[$tour_booking['booking_status']] : THREE_DASH;
                                ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Status</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $tour_booking['status']; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>