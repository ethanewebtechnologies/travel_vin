<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                All Restricted Zones Here ...
            </h2>
            <hr>
            
            <?php if ($search_method_name) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_restricted_zones) { ?>
                                <?php if ($total_restricted_zones > 1) { ?>
                                    <?php echo $total_restricted_zones; ?> results
                                <?php } else if ($total_restricted_zones == 1) { ?>
                                    <?php echo $total_restricted_zones; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_method_name; ?>&quot;</strong>
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
    
                echo form_open('admin/settings/restricted-zone', $attributes);
            ?>
            
            <div class="row">
            	<div class="col-sm-5">
                    <?php
                        $attributes = array(
                            'name' => 'search_controller_name',
                            'placeholder' => 'Search for Controller...',
                            'class' => 'form-control input-lg',
                            'value' => $search_controller_name
                        );
        
                        echo form_input($attributes);
                    ?>
				</div> 
                <div class="col-sm-5">
                    <?php
                        $attributes = array(
                            'name' => 'search_method_name',
                            'placeholder' => 'Search for Method...',
                            'class' => 'form-control input-lg',
                            'value' => $search_method_name
                        );
        
                        echo form_input($attributes);
                    ?>
                </div>
                <div class="col-sm-2">
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
                            <th class="col-sm-5">
								Controller Name
                            </th>
                            <th class="col-sm-5">
								Method Name
                            </th>
                            <th class="col-sm-1">
								Status
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($restricted_zones) { ?>
                        	<?php $sr = 1; ?>
                            
                            <?php foreach ($restricted_zones as $restricted_zone) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>
                                       <?php echo sanatize_controller_name($restricted_zone['controller_name']);?>
                                    </td>
                                    <td>
                                    	<?php echo sanatize_method_name($restricted_zone['method_name']); ?>
                                    </td>
                                    <td>
                    					<?php if($restricted_zone['status'] == 0) { ?>
                    						<a href="<?php echo base_url('admin/settings/restricted-zone/change_status?secure_token=' . $this->security_lib->encrypt($restricted_zone['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($restricted_zone['status'] == 1) { ?>
                    						<a href="<?php echo base_url('admin/settings/restricted-zone/change_status?secure_token=' . $this->security_lib->encrypt($restricted_zone['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
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
                <div class="col-sm-12 text-right">
					<?php echo $pagination; ?> 
				</div> 
            </div>
        </div>
    </div>
</section>
