<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
			<?php if((isset($search_subscriber_email) && strlen($search_subscriber_email) > 0) || (isset($search_subscriber_code) && strlen($search_subscriber_code) > 0) || (isset($search_start_date) && strlen($search_start_date) > 0) || (isset($search_end_date) && strlen($search_end_date) > 0)) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_subscribers) { ?>
            					<?php if($total_subscribers > 1) { ?>
            						<?php echo $total_subscribers;  ?> results
            					<?php } else if($total_subscribers == 1) { ?>
            						<?php echo $total_subscribers;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_subscriber_email; ?>&quot;</strong>
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
                
                echo form_open('admin/marketing/subscriber', $attributes);
    		?>
    		
    			<div class="row">
    				<div class="col-sm-10">
    					<?php 
                            $attributes = array(
                                'name' => 'search_subscriber_email',
                                'placeholder' => 'Search for Subscriber Name...',
                                'class' => 'form-control input-lg',
                                'value' => $search_subscriber_email
                            );
                            
                            echo form_input($attributes);
    				    ?>
    				</div>
    				<!-- <div class="col-sm-5"></div> -->
    				<div class="col-sm-2">
    					<div class="col-sm-2">
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
    				</div>
    			</div>
    		<?php echo form_close(); ?>
    		<div class="search-results-pane">
            	<table class="table table-bordered table-striped datatable" id="table-2">
            		<thead>
            			<tr>
            				<th class="col-sm-1">SN.</th>
            				<th class="col-sm-7">Subscriber Email</th>
            				<th class="col-sm-2">Subscription Type</th>
							<th class="col-sm-1">Status</th>
            				<th class="col-sm-1">Action</th>
            			</tr>
            		</thead>
            		
            		<tbody>
            			<?php if($subscribers) { ?>
            				<?php $sr = 1; ?>
            				<?php foreach($subscribers as $subscriber) { ?>
            					<tr>
            						<td>
            							<?php echo $sr; ?>
            						</td>
            						<td>
            							<?php echo $subscriber['subscriber_email']; ?>
            						</td>
								  	<td>
                    					<?php if($subscriber['status'] == 'Unsubscribed' && $subscriber['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/marketing/subscriber/change_status?secure_token=' . $this->security_lib->encrypt($subscriber['id']) . '&change_status=Subscribed'); ?>" class="btn btn-danger">
                    							<?php echo $subscriber['status']; ?>
                    						</a>
                						<?php } ?>
                						
                						<?php if($subscriber['status'] == 'Subscribed' && $subscriber['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/marketing/subscriber/change_status?secure_token=' . $this->security_lib->encrypt($subscriber['id']) . '&change_status=Unsubscribed'); ?>" class="btn btn-success">
                    							<?php echo $subscriber['status']; ?>
                    						</a>
                						<?php } ?>
            						</td>     						
            						<td>
            							 <a onclick="confirmDelete('<?php echo base_url('admin/marketing/subscriber/delete?secure_token=' . $this->security_lib->encrypt($subscriber['id'])); ?>')" 
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