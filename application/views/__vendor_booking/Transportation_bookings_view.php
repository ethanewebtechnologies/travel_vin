<div class="row">
    <div class="col-md-12">
        <h2>
            <?php echo "Transportation Booking Details"; ?>

            <span class="pull-right btn-toolbar">
                <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('vendor/booking/transportation-bookings'); ?>">
                    <i class="entypo-back"></i> Back
                </a>
            </span>
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table table-striped table-view">
                    <tbody>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking No.</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['booking_no']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Flight Arrival Date</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($transportation_booking['flight_arrival_date']); ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Flight Departure Date</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($transportation_booking['flight_departure_date']); ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Flight Arrival Time</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['flight_arrival_time']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Flight Departure Time</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['flight_departure_time']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Customer Name</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['firstname'] . ' ' . $transportation_booking['lastname']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Additional Notes</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['booking_additional_notes']; ?>
                            </td>
                        </tr>
                      
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>No. of Passenger</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $transportation_booking['no_of_passenger']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Booking Status</b>
                            </td>
                            <td class="col-sm-9">
                                <?php
                                    echo isset($booking_statuses[$transportation_booking['booking_status']]) ?
                                    $booking_statuses[$transportation_booking['booking_status']] : THREE_DASH;
                                ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Date of Booking</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo d_to_lu($transportation_booking['booking_date']); ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>