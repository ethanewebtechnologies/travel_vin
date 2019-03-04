<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
    		<h2>
        		All Coupon Here ...
				<span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/marketing/coupon/add'); ?>">
                    	<i class="entypo-plus"></i> Add New
                    </a>
    			</span>
			</h2>
			<hr>
			<?php if((isset($search_coupon_name) && strlen($search_coupon_name) > 0) || (isset($search_coupon_code) && strlen($search_coupon_code) > 0) || (isset($search_start_date) && strlen($search_start_date) > 0) || (isset($search_end_date) && strlen($search_end_date) > 0)) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_coupons) { ?>
            					<?php if($total_coupons > 1) { ?>
            						<?php echo $total_coupons;  ?> results
            					<?php } else if($total_coupons == 1) { ?>
            						<?php echo $total_coupons;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_coupon_name; ?>&quot;</strong>
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
                
                echo form_open('admin/marketing/coupon', $attributes);
    		?>
    		
    			<div class="row">
    				<div class="col-sm-5">
    					<?php 
                            $attributes = array(
                                'name' => 'search_coupon_name',
                                'placeholder' => 'Search for Coupon Name...',
                                'class' => 'form-control input-lg',
                                'value' => $search_coupon_name
                            );
                            
                            echo form_input($attributes);
    				    ?>
    				</div>
    				<div class="col-sm-5">
    					<?php 
                            $attributes = array(
                                'name' => 'search_coupon_code',
                                'placeholder' => 'Search for Coupon Code...',
                                'class' => 'form-control input-lg',
                                'value' => $search_coupon_code
                            );
                            
                            echo form_input($attributes);
    				    ?>
    				</div>
    				<div class="col-sm-2"></div>
    			</div>
    			<br>
    			<div class="row">
    				<div class="col-sm-5">
    					<?php 
                            $attributes = array(
                                'name' => 'search_start_date',
                                'placeholder' => 'Search for Start Date...',
                                'id'    =>  'search_start_date',
                                 'autocomplete' =>  'off',
                                'class' => 'form-control input-lg',
                                'value' => $search_start_date
                            );
                            
                            echo form_input($attributes);
    				    ?>
    				</div>
    				<div class="col-sm-5">
    					<?php 
                            $attributes = array(
                                'name' => 'search_end_date',
                                'autocomplete' =>  'off',
                                'id' => 'search_end_date',
                                'placeholder' => 'Search for End Date...',
                                'class' => 'form-control input-lg',
                                'value' => $search_end_date
                            );
                            
                            echo form_input($attributes);
    				    ?>
    				</div>
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
    		<?php echo form_close(); ?>
    		<div class="search-results-pane">
            	<table class="table table-bordered table-striped datatable" id="table-2">
            		<thead>
            			<tr>
            				<!-- <th class="col-sm-1">
            	   				<div class="checkbox checkbox-replace"></div>
            				</th> -->
            				<th class="col-sm-1">SN.</th>
            				<th class="col-sm-2">Coupon Name</th>
            				<th class="col-sm-2">Coupon Code</th>
            				<th class="col-sm-2">Coupon Start Date</th>
							<th class="col-sm-2">Coupon End Date</th>
							<th class="col-sm-1">Status</th>
            				<th class="col-sm-2">Action</th>
            			</tr>
            		</thead>
            		
            		<tbody>
            			<?php if($coupons) { ?>
            				<?php $sr = 1; ?>
            				<?php foreach($coupons as $coupon) { ?>
            					<tr>
            						<!-- <td>
            							<div class="checkbox checkbox-replace">
            								<input type="checkbox" id="chk-1">
            							</div>
            						</td> -->
            						
            						<td>
            							<?php echo $sr; ?>
            						</td>
            						<td>
            							<?php echo $coupon['coupon_name']; ?>
            						</td>
            						<td>
            							<?php echo $coupon['coupon_code']; ?>
            						</td>
									<td>
										<?php echo d_to_lu($coupon['coupon_start_date']); ?>
									</td>
									<td>
										<?php echo d_to_lu($coupon['coupon_end_date']); ?>
									</td> 
								  	<td>
                    					<?php if($coupon['status'] == 0 && $coupon['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/marketing/coupon/change_status?secure_token=' . $this->security_lib->encrypt($coupon['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($coupon['status'] == 1 && $coupon['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/marketing/coupon/change_status?secure_token=' . $this->security_lib->encrypt($coupon['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
            						</td>     						
            						<td>
            							<a href="<?php echo base_url('admin/marketing/coupon/edit?secure_token=' . $this->security_lib->encrypt($coupon['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
            								<i class="entypo-pencil"></i> Edit
            							</a>
            							 <a onclick="confirmDelete('<?php echo base_url('admin/marketing/coupon/delete?secure_token=' . $this->security_lib->encrypt($coupon['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                				 		</a>
            						</td>
            					</tr>
            					<?php $sr++; ?>
            				<?php } ?>
            			<?php } else { ?>
                    		<tr>
                    			<td colspan="7" class="text-center"><?php echo 'No result found!'; ?></td>
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
<script src="<?php echo base_url('assets/admin/js/bootstrap-datepicker.js'); ?>"></script>
<script>
$(function() {
    $('#search_start_date').datepicker({
		format: 'dd-mm-yyyy',     
    });
});
</script>
<script>
$(function() {
    $('#search_end_date').datepicker({
		format: 'dd-mm-yyyy',     
    });
});
</script>