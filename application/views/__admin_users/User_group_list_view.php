<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	All User Groups here ...
                <span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/users/user-group/add'); ?>">
                		<i class="entypo-plus"></i> Add
                	</a>
                </span>
            </h2>
            <hr>
			<?php if($search_group_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_user_groups) { ?>
            					<?php if($total_user_groups > 1) { ?>
            						<?php echo $total_user_groups;  ?> results
            					<?php } else if($total_user_groups == 1) { ?>
            						<?php echo $total_user_groups;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_group_name; ?>&quot;</strong>
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
                
                echo form_open('admin/users/user-group', $attributes);
    		?>
    			<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_group_name',
                            'placeholder' => 'Search for User Group ...',
                            'class' => 'form-control input-lg',
                            'value' => $search_group_name
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
    		<div class="search-results-pane">
                <table class="table table-bordered table-striped datatable" id="table-2">
                	<thead>
                		<tr>
                			<th class="col-sm-1">SN.</th>
                			<th class="col-sm-8">Group Name</th>
                			<th class="col-sm-1">Status</th>
                			<th class="col-sm-2">Action</th>
                		</tr>
                	</thead>
                	
                	<tbody>
                		<?php if($user_groups) { ?>
                    		<?php $sr = 1; ?>
                    		<?php foreach($user_groups as $user_group) { ?>
                    			<tr>
                    				<td>
                    					<?php echo $sr; ?>
                    				</td>
                    				<td>
                    					<?php echo $user_group['gp_name']; ?>
                    				</td> 
                					<td>
                    					<?php if($user_group['status'] == 0) { ?>
                    						<a href="<?php echo base_url('admin/users/user-group/change_status?secure_token=' . $this->security_lib->encrypt($user_group['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($user_group['status'] == 1) { ?>
                    						<a href="<?php echo base_url('admin/users/user-group/change_status?secure_token=' . $this->security_lib->encrypt($user_group['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
                    				<td>
                    					<a href="<?php echo base_url('admin/users/user-group/edit?secure_token=' . $this->security_lib->encrypt($user_group['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                    						<i class="entypo-pencil"></i> Edit
                    					</a>
                    					<a href="<?php echo base_url('admin/users/user-group/delete_user?secure_token=' . $this->security_lib->encrypt($user_group['id'])); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                    				 	</a>
                    				</td>
                    			</tr>
                    			<?php $sr++; ?>
                    		<?php } ?>
                    	<?php } else { ?>
                    		<tr>
                    			<td colspan="4" class="text-center">
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