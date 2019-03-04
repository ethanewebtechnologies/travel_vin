<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	<?php echo $text_h3_heading; ?>
                <span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/users/users/add'); ?>">
                		<i class="entypo-plus"></i> <?php echo $text_add; ?>
                	</a>
                </span>
            </h2>
            <hr>
			<?php if($search_user) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_users) { ?>
            					<?php if($total_users > 1) { ?>
            						<?php echo $total_users;  ?> results
            					<?php } else if($total_users == 1) { ?>
            						<?php echo $total_users;  ?> result
            					<?php } ?>
            				<?php } else { ?>	
            					No Result
            				<?php } ?>
        					found for <strong>	&quot;<?php echo $search_user; ?>&quot;</strong>
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
                
                echo form_open('admin/users/users', $attributes);
    		?>
    			<div class="row">
					<div class="col-sm-5">
        				<?php 
                            $attributes = array(
                                'name' => 'search_user',
                                'placeholder' => 'Search for User...',
                                'class' => 'form-control input-lg',
                                'value' => $search_user
                            );
                            
                            echo form_input($attributes);
        				?>
        			</div>	
        			<div class="col-sm-5">
        				<?php 
                            $attributes = array(
                                'name' => 'search_user_email',
                                'placeholder' => 'Search for Email...',
                                'class' => 'form-control input-lg',
                                'value' => $search_user_email
                            );
                            
                            echo form_input($attributes);
        				?>
        			</div>
        			<div class="col-sm-2"></div>
        		</div>
        		<div class="row">
        			<br>
    				<div class="col-sm-5">
    					<?php 
                            $attributes = array(
                                'name' => 'search_user_group',
                                'class' => 'form-control input-lg',
                            );
                            
                            echo form_dropdown($attributes, $user_groups, $search_user_group);
        				?>
    				</div>
    				<div class="col-sm-5">
    				</div>
    				<div class="col-sm-2">
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
                			<th class="col-sm-1"><?php echo $text_sn; ?></th>
                			<th class="col-sm-3"><?php echo $text_uname; ?></th>
                			<th class="col-sm-3"><?php echo $text_email; ?></th>
                			<th class="col-sm-2"><?php echo $text_type; ?></th>
                			<th class="col-sm-1"><?php echo $text_status; ?></th>
                			<th class="col-sm-2"><?php echo $text_action; ?></th>
                		</tr>
                	</thead>
                	
                	<tbody>
                		<?php if($users) { ?>
                    		<?php $sr = 1; ?>
                    		<?php foreach($users as $user) { ?>
                    			<tr>
                    				<td>
                    					<?php echo $sr; ?>
                    				</td>
                    				<td>
                    					<?php echo (!empty($user['lastname'])) ? ($user['firstname'].' '.$user['lastname']) : $user['firstname']; ?>
                    				</td>
                    				<td>
                    					<?php echo $user['email']; ?>
                    				</td> 
                					<td>
                    					<?php echo $user['gp_name']; ?>
                    				</td>
                					<td>
                    					<?php if($user['status'] == 0 && $user['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/users/users/change_status?secure_token=' . $this->security_lib->encrypt($user['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($user['status'] == 1 && $user['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/users/users/change_status?secure_token=' . $this->security_lib->encrypt($user['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
                    				<td>
                					<?php if($user['id'] != 1) { ?>
                    					<a href="<?php echo base_url('admin/users/users/edit?secure_token=' . $this->security_lib->encrypt($user['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                    						<i class="entypo-pencil"></i> <?php echo $text_edit; ?>
                    					</a>
                    					<a onclick="confirmDelete('<?php echo base_url('admin/users/users/delete_user?secure_token=' . $this->security_lib->encrypt($user['id'])); ?>');" class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel"></i> <?php echo $text_delete; ?>
                    				 	</a>
                					<?php } ?>
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