<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
    		<h2>
        		<?php echo "All Hotel Here ..."; ?> 
        		<span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/listing/main-hotel/add'); ?>">
                		<i class="entypo-plus"></i> Add New
                	</a>
    			</span>
			</h2>
			<hr>
			<?php if((isset($search_hotel_name) && strlen($search_hotel_name) > 0) || (isset($search_city_name) && strlen($search_city_name) > 0) || (isset($search_country_name) && strlen($search_country_name) > 0)) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
							<?php if($total_hotels) { ?>
								<?php if($total_hotels > 1) { ?>
									<?php echo $total_hotels;  ?> results
								<?php } else if($total_hotels == 1) { ?>
									<?php echo $total_hotels;  ?> result
								<?php } ?>
							<?php } else { ?>	
								No Result
							<?php } ?>
							found for <strong>	&quot;
							<?php if(strlen($search_hotel_name) > 0) { ?>
								<?php if(strlen($search_city_name) > 0) { ?>
									<?php if(strlen($search_country_name) > 0) { ?>
										<?php echo $search_hotel_name . ', ' .$search_city_name . ', ' . $search_country_name; ?>
									<?php  } else { ?>
										<?php echo $search_hotel_name . ', ' .$search_city_name; ?>
									<?php } ?>
								<?php  } else { ?>
									<?php if(strlen($search_country_name) > 0) { ?>
										<?php echo $search_hotel_name . ', ' . $search_country_name; ?>
									<?php  } else { ?>
										<?php echo $search_hotel_name; ?>
									<?php } ?>
								<?php } ?>
							<?php } else { ?>
								<?php if(strlen($search_city_name) > 0) { ?>
									<?php if(strlen($search_country_name) > 0) { ?>
										<?php echo $search_city_name . ', ' . $search_country_name; ?>
									<?php  } else { ?>
										<?php echo $search_city_name; ?>
									<?php } ?>
								<?php  } else { ?>
									<?php if(strlen($search_country_name) > 0) { ?>
										<?php echo $search_country_name; ?>
									<?php } ?>
								<?php } ?>
							<?php } ?>
							&quot;</strong>
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
                
                echo form_open('admin/listing/main-hotel', $attributes);
    		?>
    		
    		<div class="row">
						<div class="col-sm-4">
							<?php 
    							$attributes = array(
    								'name' => 'search_hotel_name',
    								'placeholder' => 'Search For Hotel...',
    								'class' => 'form-control input-lg',
    							    'value' => $search_hotel_name,
    							);
    							
    							echo form_input($attributes);
    						?>
						</div>
						<div class="col-sm-3">
							<?php 
    							$attributes = array(
    								'name' => 'search_country_name',
    								'placeholder' => 'Search For Country...',
    								'class' => 'form-control input-lg',
    							    'value' => $search_country_name,
    							);
    							
    							echo form_input($attributes);
    						?>
						</div>
						
						<div class="col-sm-3">
							<?php 
    							$attributes = array(
    								'name' => 'search_city_name',
    								'placeholder' => 'Search For city...',
    								'class' => 'form-control input-lg',
    							    'value' => $search_city_name,
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
    									'class'         => 'btn btn-lg btn-primary btn-icon pull-right'
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
            				<!--<th class="col-sm-1">
            	   				<div class="checkbox checkbox-replace"></div>
            				</th>-->
            				<th class="col-sm-1">SN.</th>
            				<th class="col-sm-2">Hotel</th>
            			     <th class="col-sm-2">Country</th>
							<th class="col-sm-2">City</th>
							 <th class="col-sm-1">Status</th>
            				<th class="col-sm-2">Action</th>
            			</tr>
            		</thead>
            		
            		<tbody>
            			<?php if($hotels) { ?>
            				<?php $sr = 1; ?>
            				<?php foreach($hotels as $hotel) { ?>
            					<tr>
            						<!--<td>
            							<div class="checkbox checkbox-replace">
            								<input type="checkbox" id="chk-1">
            							</div>
            						</td>-->
            						
            						<td><?php echo $sr; ?></td>
            						<td><?php echo $hotel['name']; ?></td>
            						<td>
						            <?php echo isset($countries[$hotel['country_id']]) ? $countries[$hotel['country_id']] : THREE_DASH; ?>
					               </td>
								   <td>
						            <?php echo isset($cities[$hotel['city_id']]) ? $cities[$hotel['city_id']] : THREE_DASH; ?>
					               </td>
            						<td>
                    					<?php if($hotel['status'] == 0 && $hotel['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/listing/main-hotel/change_status?secure_token=' . $this->security_lib->encrypt($hotel['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($hotel['status'] == 1 && $hotel['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/listing/main-hotel/change_status?secure_token=' . $this->security_lib->encrypt($hotel['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
            						</td>
            						<td>
            							<a href="<?php echo base_url('admin/listing/main-hotel/edit?secure_token=' . $this->security_lib->encrypt($hotel['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
            								<i class="entypo-pencil"></i> Edit
            							</a>
            							<a onclick="confirmDelete('<?php echo base_url('admin/listing/main-hotel/delete?secure_token='
            							    . $this->security_lib->encrypt($hotel['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                    				 	</a>
            						</td>
            					</tr>
            					<?php $sr++; ?>
            				<?php } ?>
            			<?php } else { ?>
                    		<tr>
                    			<td colspan="6" class="text-center"><?php echo 'No result found!'; ?></td>
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