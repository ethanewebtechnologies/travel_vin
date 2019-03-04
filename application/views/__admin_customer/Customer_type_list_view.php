<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                All Customer Type Here ...
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/customer/customer-type/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            
            <?php if ($search_type_name) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_customer_types) { ?>
                                <?php if ($total_customer_types > 1) { ?>
                                    <?php echo $total_customer_types; ?> results
                                <?php } else if ($total_customer_types == 1) { ?>
                                    <?php echo $total_customer_types; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_type_name; ?>&quot;</strong>
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
    
                echo form_open('admin/customer/customer-type', $attributes);
            ?>
            
            <div class="input-group">
                <?php
                    $attributes = array(
                        'name' => 'search_type_name',
                        'placeholder' => 'Search for types...',
                        'class' => 'form-control input-lg',
                        'value' => $search_type_name
                    );
    
                    echo form_input($attributes);
                ?>
                <div class="input-group-btn">
                    <?php
                        $attributes = array(
                            'type' => 'submit',
                            'content' => 'Search <i class="entypo-search"></i>',
                            'class' => 'btn btn-lg btn-primary btn-icon'
                        );
    
                        echo form_button($attributes);
                    ?>
                </div>
            </div>
            <?php echo form_close(); ?>
            
            <div class="search-results-pane">
                <table class="table table-bordered table-striped datatable" id="table-2">
                    <thead>
                        <tr>
                            <th class="col-sm-1">
                                SN.
                            </th>                           
                            <th class="col-sm-7">
								Type Name
                            </th>
                            <th class="col-sm-1">
								Status
                            </th>
                            <th class="col-sm-2">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($customer_types) { ?>
                        	<?php $sr = 1; ?>
                            
                            <?php foreach ($customer_types as $customer_type) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>
                                        <?php echo $customer_type['type_name']; ?>
                                    </td>
                                    <td>
                    					<?php if($customer_type['status'] == 0) { ?>
                    						<a href="<?php echo base_url('admin/customer/customer-type/change_status?secure_token=' . $this->security_lib->encrypt($customer_type['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($customer_type['status'] == 1) { ?>
                    						<a href="<?php echo base_url('admin/customer/customer-type/change_status?secure_token=' . $this->security_lib->encrypt($customer_type['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
                                   <td>
                                        <a href="<?php echo base_url('admin/customer/customer-type/edit?secure_token=' . $this->security_lib->encrypt($customer_type['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a href="<?php echo base_url('admin/customer/customer-type/delete?secure_token=' . $this->security_lib->encrypt($customer_type['id'])); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel" onclick="myFunction()"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="4" class="text-center">
                                    No record found!
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
