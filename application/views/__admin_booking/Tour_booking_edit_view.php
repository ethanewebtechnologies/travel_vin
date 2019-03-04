<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered'
            );

            echo form_open_multipart('admin/booking/tour-bookings/edit?secure_token=' . $this->security_lib->encrypt($tour_booking['booking_id']), $attributes);
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

        	<h2>
            	<?php echo "Tour Booking  Details"; ?>
                <div class="pull-right btn-toolbar">
                    <?php
                            $attributes = array(
                                'name' => 'save',
                                'id' => 'save',
                                'value' => 'Save',
                                'type' => 'submit',
                                'content' => '<i class="entypo-check"></i> Save',
                                'class' => 'btn btn-green btn-icon icon-left'
                            );
            
                            echo form_button($attributes);
                        ?>
                    <?php
                        $attributes = array(
                            'name' => 'reset',
                            'id' => 'reset',
                            'value' => 'Reset',
                            'type' => 'reset',
                            'content' => '<i class="entypo-ccw"></i> Reset',
                            'class' => 'btn btn-orange btn-icon icon-left'
                        );
        
                        echo form_button($attributes);
                    ?>
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/booking/tour-bookings'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </div>
        	</h2>
            <div class="panel panel-primary">
                <div class="panel-body">
    			 	<div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Customer Firstname: ', 'booking_customer_firstname', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_customer_firstname',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_customer_firstname', $tour_booking['firstname']),
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Customer Lastname: ', 'booking_customer_lastname', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_customer_lastname',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_customer_lastname', $tour_booking['lastname'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <?php echo form_hidden('booking_customer_id', $tour_booking['booking_customer_id']); ?>
                    
                    
                    <!-- VINAY CODE -->
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Booking Date: ', 'booking_date', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_date',
                                    'class' => 'form-control',
                                    'placeholder' => 'DD-MM-YYYY',
                                    'value' => set_value('booking_date', d_to_lu($tour_booking['booking_date']))
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Pickup Time: ', 'pickup_time', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'pickup_time',
                                    'class' => 'form-control',
                                    'placeholder' => 'HH:MM',
                                    'value' => set_value('pickup_time', $tour_booking['pickup_time'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <!-- END OF VINAY CODE -->
                    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Payment Type: ', 'booking_payment_type', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_payment_type',
                                    'class' => 'form-control ckeditor',
                                    'value' => set_value('booking_payment_type', $tour_booking['booking_payment_type'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Payment Status: ', 'payment_status', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'payment_status',
                                    'class' => 'form-control ckeditor',
                                    'value' => set_value('payment_status', $tour_booking['payment_status'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_dropdown($attributes, $payment_statuses, $tour_booking['payment_status']);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Additional Notes:', 'booking_additional_notes', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_additional_notes',
                                    'id' => 'booking_additional_notes',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_additional_notes', $tour_booking['booking_additional_notes'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_textarea($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Amount Paid:', 'booking_amount_paid', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_amount_paid',
                                    'id' => 'booking_amount_paid',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_amount_paid', $tour_booking['booking_amount_paid'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('No of Adults: ', 'booking_adults', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_adults',
                                    'id' => 'booking_adults',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_adults', $tour_booking['booking_adults'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('No of Child / Children: ', 'booking_child', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_child',
                                    'id' => 'booking_child',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_child', $tour_booking['booking_child'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Tax: ', 'booking_tax', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_tax',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_tax', $tour_booking['booking_tax'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Currency Code: ', 'booking_curr_code', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_curr_code',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_curr_code', $tour_booking['booking_curr_code'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
                            
                            echo form_label('Currency Symbol: ', 'booking_curr_symbol', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_curr_symbol',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_curr_symbol', $tour_booking['booking_curr_symbol'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Transaction ID: ', 'booking_txn_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_txn_id',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_txn_id', $tour_booking['booking_txn_id'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Cancellation Request: ', 'booking_cancellation_request', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_cancellation_request',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_cancellation_request', $tour_booking['booking_cancellation_request'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Transaction Id: ', 'booking_txn_id', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_txn_id',
                                    'class' => 'form-control',
                                    'value' => set_value('booking_txn_id', $tour_booking['booking_txn_id'])
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
        
                                echo form_input($attributes);
                            ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
    
                            echo form_label('Booking Status: ', 'booking_status', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'booking_status',
                                    'class' => 'form-control ckeditor',
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_dropdown($attributes, $booking_statuses, $tour_booking['booking_status']);
                            ?>
                        </div>
                    </div>
    
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Status: ', 'status', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'status',
                                    'class' => 'form-control'
                                );
        
                                $options = array(
                                    '1' => 'Enable',
                                    '0' => 'Disable'
                                );
                                
                                if(!$edit_permission) {
                                    $attributes['disabled'] = 'disabled';
                                }
    
                                echo form_dropdown($attributes, $options, $tour_booking['status']);
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>


