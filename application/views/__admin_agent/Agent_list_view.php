<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12"> 
     		<h2>
     			<?php echo 'All Parks Here ...'; ?>
     		  <span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/agent/accounts/add'); ?>">
                		<i class="entypo-plus"></i> Add New
                	</a>
    			 </span>
     		</h2>
     		<hr>
			<?php if($search_company_legal_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_agents) { ?>
            					<?php if($total_agents > 1) { ?>
            						<?php echo $total_agents;  ?> results
            					<?php } else if($total_agents == 1) { ?>
            						<?php echo $total_agents;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_company_legal_name; ?>&quot;</strong>
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
                
                echo form_open('admin/agent/accounts', $attributes);
    		?>
    			<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_company_legal_name',
                            'placeholder' => 'Search for Agency ...',
                            'class' => 'form-control input-lg',
                            'value' => $search_company_legal_name
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
     		
    		<!-- company_legal_name -->
            <table class="table table-bordered table-striped datatable" id="table-2">
            	<thead>
            		<tr>
            			<!-- <th>
            	   			<div class="checkbox checkbox-replace"></div>
            			</th> -->
            			<th class="col-sm-1">
            				<?php echo $text_sn; ?>
            			</th>
            			<th class="col-sm-4">
            				Company Legal name
            			</th>
            			<th class="col-sm-3">
            				Admin Name
            			</th>
            			<th class="col-sm-1">
            			 Approved
            			</th>
            			<th class="col-sm-1">
            				<?php echo $text_status; ?>
            			</th>
            			<th class="col-sm-2">
            				<?php echo $text_action; ?>
            			</th>
            		</tr>
            	</thead>
            	
            	<tbody>
            		<?php if($agents) { ?>
                		<?php $sr = 1; ?>
                		<?php foreach($agents as $agent) { ?>
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
                					<p><?php echo isset($agent['company_legal_name']) && !empty($agent['company_legal_name']) ? $agent['company_legal_name'] : THREE_DASH; ?></p>
                					<p>
                						<small class="blue">
                							<b>Email:</b> <?php echo isset($agent['email']) && !empty($agent['email']) ? $agent['email'] : THREE_DASH; ?>
                						</small>	
                					</p>
                				</td>
                				<td>
                					<p><?php echo $agent['admin_fullname']; ?></p>
                					<p>
                						<small>
                							<b>Email:</b> <?php echo $agent['admin_email']; ?>
                						</small>
                					</p>
                				</td>
    							<td>
                            		<?php if($agent['approved'] == 0 && $agent['id'] != 1) { ?>
                            			<a href="<?php echo base_url('admin/agent/accounts/approve_agent?secure_token=' . $this->security_lib->encrypt($agent['id']) . '&approved=1'); ?>" class="btn btn-danger">
                            				<i class="entypo-cancel"></i>
                            			</a>
                            		<?php } if($agent['approved'] == 1 && $agent['id'] != 1) { ?>
                            			<a href="<?php echo base_url('admin/agent/accounts/approve_agent?secure_token=' . $this->security_lib->encrypt($agent['id']) . '&approved=0'); ?>" class="btn btn-success">
                            				<i class="entypo-check"></i>
                            			</a>
                            		<?php } ?>
                            	</td>
    							 <td>
                					<?php if($agent['status'] == 0 && $agent['id'] != 1) { ?>
                						<a href="<?php echo base_url('admin/agent/accounts/change_status?secure_token=' . $this->security_lib->encrypt($agent['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                							<i class="entypo-cancel"></i>
                						</a>
            						<?php } ?>
            						<?php if($agent['status'] == 1 && $agent['id'] != 1) { ?>
                						<a href="<?php echo base_url('admin/agent/accounts/change_status?secure_token=' . $this->security_lib->encrypt($agent['id']) . '&change_status=0'); ?>" class="btn btn-success">
                							<i class="entypo-check"></i>
                						</a>
            						<?php } ?>
            					</td>
            					<td>
                					<a href="<?php echo base_url('admin/agent/accounts/edit?secure_token=' . $this->security_lib->encrypt($agent['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                						<i class="entypo-pencil"></i> <?php echo $text_edit; ?>
                					</a>
                					
                					 <a onclick="confirmDelete('<?php echo base_url('admin/agent/accounts/delete?secure_token='
                					     . $this->security_lib->encrypt($agent['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> <?php echo $text_delete; ?>
                    				 		</a>
                				</td>					
                			</tr>
                			<?php $sr++; ?>
                		<?php } ?>
                	<?php } else { ?>
                		<tr>
                			<td colspan="6" class="text-center"><?php echo $text_no_result; ?></td>
                		</tr>
                	<?php } ?>	
            	</tbody>
            </table>
            <div class="col-sm-12 text-right">
               <?php echo $pagination; ?> 
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
