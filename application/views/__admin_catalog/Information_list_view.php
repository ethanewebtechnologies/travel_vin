<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	<?php echo "All Information Here ..."; ?> 
        		<span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/catalog/information/add'); ?>">
                		<i class="entypo-plus"></i> Add New
                	</a>
    			</span>
    		</h2>
    		<hr>
    		<?php if($search_title_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_informations) { ?>
            					<?php if($total_informations > 1) { ?>
            						<?php echo $total_informations;  ?> results
            					<?php } else if($total_informations == 1) { ?>
            						<?php echo $total_informations;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_title_name; ?>&quot;</strong>
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
                
                echo form_open('admin/catalog/information', $attributes);
    		?>
    			<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_title_name',
                            'placeholder' => 'Search  Informations...',
                            'class' => 'form-control input-lg',
                            'value' => $search_title_name
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
                		<th class="col-sm-1">
                				SN.
                			</th>
                			<th class="col-sm-1">
                				Image
                			</th>
							<th class="col-sm-5">
                				Title
                			</th>
                			<th class="col-sm-2">
                				Location
                			</th>
                			<th class="col-sm-3">
                				Action
                			</th>
                		</tr>
                	</thead>
        		
            		<tbody>
            			<?php if($informations) { ?>
            			<?php $sr = 1; ?>
                	         <?php foreach($informations as $information) { ?>
                				<tr>
                				 <td>
                                      <?php echo $sr; ?>
                                    </td>
                					<td>
                						<?php if(isset($information['image'])) { ?>
    										<?php 
    									       $optimized = new Optimized();
    									       echo $optimized->resize($information['image'], 100, 50, array(), 'resize_crop');
    									   ?>
    									<?php } else { ?>
    										<?php
                                                $optimized = new Optimized();
                                                echo $optimized->resize('content/image/main/empty/empty.jpg', 100, 50, array(), 'resize_crop');
    										?>
    									<?php } ?>
                					</td>
                					<td>
                						<?php echo $information['title']; ?>
                					</td>
									<td>
									<?php echo isset($information['city_id']) ? $information['city_name'] : THREE_DASH; ?>,
									<?php echo isset($information['country_id']) ? $information['country_name'] : THREE_DASH; ?>
                					</td>
                					<td>
                						<a href="<?php echo base_url('admin/catalog/information/edit?secure_token=' . $this->security_lib->encrypt($information['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                							<i class="entypo-pencil"></i> Edit
                						</a>
                						
                							<a onclick="confirmDelete('<?php echo base_url('admin/catalog/information/delete?secure_token='
                							    . $this->security_lib->encrypt($information['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                    				 		</a>
                					</td>
                				</tr>
                				<?php $sr++; ?>
                			<?php } ?>
                		<?php } else { ?>	
                			<tr>
    							<td colspan="5" class="text-center">
    								<?php echo 'No result found!'; ?>
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
