<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
    		<h2>
        		<?php echo "All Customer Here ..."; ?> 
        		  <span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/customer/customer/add'); ?>">
                		<i class="entypo-plus"></i> Add New
                	</a>
    		</span>
			</h2>
			<hr>
			<?php if($search_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_customers) { ?>
            					<?php if($total_customers > 1) { ?>
            						<?php echo $total_customers;  ?> results
            					<?php } else if($total_customers == 1) { ?>
            						<?php echo $total_customers;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_name; ?>&quot;</strong>
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
                
                echo form_open('admin/customer/customer', $attributes);
    		?>
    			<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_name',
                            'placeholder' => 'Search for Customer...',
                            'class' => 'form-control input-lg',
                            'value' => $search_name
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
            				<!--<th class="col-sm-1">
            	   				<div class="checkbox checkbox-replace"></div>
            				</th>-->
            				<th class="col-sm-1">SN.</th>
            				<th class="col-sm-6">Customer</th>
            			     <th class="col-sm-2">Approval</th>
							<th class="col-sm-1">Status</th>
            				<th class="col-sm-2">Action</th>
            			</tr>
            		</thead>
            		
            		<tbody>
            			<?php if($customers) { ?>
            				<?php $sr = 1; ?>
            				<?php foreach($customers as $customer) { ?>
            					<tr>
            						<!--<td>
            							<div class="checkbox checkbox-replace">
            								<input type="checkbox" id="chk-1">
            							</div>
            						</td>-->
            						
            						<td><?php echo $sr; ?></td>
            						<td><?php echo $customer['firstname'] . ' ' . $customer['lastname']; ?></td>
            						<td>
						            	<?php echo $customer['approved'] == 1 ? 'Approved' : 'Pending'; ?>
					               	</td>
					               	<td>
                    					<?php if($customer['status'] == 0 && $customer['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/customer/customer/change_status?secure_token=' . $this->security_lib->encrypt($customer['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($customer['status'] == 1 && $customer['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/customer/customer/change_status?secure_token=' . $this->security_lib->encrypt($customer['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
            						<td>
            							<a href="<?php echo base_url('admin/customer/customer/edit?secure_token=' . $this->security_lib->encrypt($customer['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
            								<i class="entypo-pencil"></i> Edit
            							</a>
            							 <a onclick="confirmDelete('<?php echo base_url('admin/customer/customer/delete?secure_token='
            							     . $this->security_lib->encrypt($customer['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                    				 		</a>
            						</td>
            					</tr>
            					<?php $sr++; ?>
            				<?php } ?>
            			<?php } else { ?>
                    		<tr>
                    			<td colspan="5" class="text-center"><?php echo 'No result found!'; ?></td>
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

<!-- Modal (Confirm)-->
<div class="modal fade" id="confirmation_modal" data-backdrop="static">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Confirm Modal</h4>
			</div>
			
			<div class="modal-body">
				Are you sure want to delete this?
			</div>
			
			<div class="modal-footer">
				<a id="confirmedDelete" class="btn btn-info">Yes</a>
				<button type="button" class="btn btn-default" data-dismiss="modal">No</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
function confirmDelete(link) {
	$('#confirmedDelete').attr('href', link);
	$('#confirmation_modal').modal('show', {backdrop: 'static'});
}

</script>
