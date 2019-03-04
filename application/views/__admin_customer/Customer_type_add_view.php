<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered'
            );
    
            echo form_open('admin/customer/customer-type/add', $attributes);
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
                Add Customer Type Details
                <span class="pull-right btn-toolbar">
                    <?php
                        $attributes = array(
                            'name' => 'add',
                            'id' => 'add',
                            'value' => 'Add',
                            'type' => 'submit',
                            'content' => '<i class="entypo-plus"></i> Add',
                            'class' => 'btn btn-blue btn-icon icon-left'
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
                    <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/customer/customer-type'); ?>">
                        <i class="entypo-cancel"></i> Cancel
                    </a>
                </span>
            </h2>
        	<div class="panel panel-primary">
            	<div class="panel-body">
                    <div class="form-group">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Customer Type Name: ', 'type_name', $attributes);
                        ?>
                        <div class="col-sm-8">
                        	<?php
                                $data = array(
                                    'class' => 'form-control',
                                    'name' => 'type_name',
                                    'id' => 'type_name',
                                    'value' => set_value('type_name')
                                );
    
                                echo form_input($data);
                                echo form_error('type_name');
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
                            <div class="bs-example">
                                <div class="make-switch" data-on="primary" data-off="info">
                                    <?php
                                        $data = array(
                                            'name' => 'status',
                                            'id' => 'status',
                                            'value' => '1',
                                            'checked' => TRUE
                                        );
        
                                        echo form_checkbox($data);
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
            	</div>
        	</div>
    	<?php echo form_close(); ?>
    </div>
</div>

 



