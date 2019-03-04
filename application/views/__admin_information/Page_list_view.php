<section class="search-results-env">
    <div class="row">
    	<div class="col-md-12">
            <h2>
            	<?php echo "All Pages  Here ..."; ?> 
        	 	<span class="pull-right btn-toolbar">
                	<a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/information/page/add'); ?>">
                		<i class="entypo-plus"></i> Add New
                	</a>
    			</span>
    		</h2>
    		<hr>
    		<?php if($search_name) { ?>
        		<ul class="nav nav-tabs right-aligned">
        			<li class="tab-title pull-left">
        				<div class="search-string">
        					<?php if($total_pages) { ?>
            					<?php if($total_pages > 1) { ?>
            						<?php echo $total_pages;  ?> results
            					<?php } else if($total_pages == 1) { ?>
            						<?php echo $total_pages;  ?> result
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
                
                echo form_open('admin/information/page', $attributes);
    		?>
    			<div class="input-group">
    				<?php 
                        $attributes = array(
                            'name' => 'search_name',
                            'placeholder' => 'Search for pages...',
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
                			<th class="col-sm-1">
                				SN.
                			</th> 
                			<th class="col-sm-8">
								Page Name
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
            			<?php if($pages) { ?>
                			<?php 
                		        $sr = 1;
                                foreach($pages as $page) {
                	         ?>
                				<tr>
                					<td>
                						<?php echo $sr; ?>
                					</td>
                					<td>
                						<?php echo $page['page_name']; ?>
                					</td>
            						<td>
                    					<?php if($page['status'] == 0 && $page['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/information/page/change_status?secure_token=' . $this->security_lib->encrypt($page['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($page['status'] == 1 && $page['id'] != 1) { ?>
                    						<a href="<?php echo base_url('admin/information/page/change_status?secure_token=' . $this->security_lib->encrypt($page['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
            						</td>
                					<td>
                						<a href="<?php echo base_url('admin/information/page/edit?secure_token=' . $this->security_lib->encrypt($page['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                							<i class="entypo-pencil"></i> Edit
                						</a>
                						<a href="<?php echo base_url('admin/information/page/delete?secure_token=' . $this->security_lib->encrypt($page['id']));?>" class="btn btn-danger btn-sm btn-icon icon-left">
                							<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                					 	</a>
                					</td>
                				</tr>
                				<?php $sr++; ?>
                			<?php } ?>
                		<?php } else { ?>	
                			<tr>
    							<td colspan="4" class="text-center">
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
