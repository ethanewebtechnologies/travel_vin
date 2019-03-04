<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                All Banner Here ...
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/settings/banner/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            
            <?php if ($search_title) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_banners) { ?>
                                <?php if ($total_banners > 1) { ?>
                                    <?php echo $total_banners; ?> results
                                <?php } else if ($total_banners == 1) { ?>
                                    <?php echo $total_banners; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_title; ?>&quot;</strong>
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
    
                echo form_open('admin/settings/banner', $attributes);
            ?>
            
            <div class="input-group">
                <?php
                    $attributes = array(
                        'name' => 'search_title',
                        'placeholder' => 'Search for title...',
                        'class' => 'form-control input-lg',
                        'value' => $search_title
                    );
    
                    echo form_input($attributes);
                ?>
                <div class="input-group-btn">
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
                            <th class="col-sm-2">
								Image
                            </th>
                            <th class="col-sm-2">
								Title
                            </th>
                            <th class="col-sm-2">
								Category
                            </th>
                            <th class="col-sm-2">
								Section
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
                        <?php if ($banners) { ?>
                        	<?php $sr = 1; ?>
                            
                            <?php foreach ($banners as $banner) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>
                                        <?php if(isset($banner['image']) && file_exists($banner['image'])) { ?>
    										<?php echo $optimized->resize($banner['image'], 160, 80, array(), 'resize_crop'); ?>
    									<?php } else { ?>
    										<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 160, 80, array(), 'resize_crop'); ?>
    									<?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $banner['title']; ?>
                                    </td>
                                    <td>
                                        <?php echo $banner['category']; ?>
                                    </td>
                                    <td>
                                        <?php echo $banner['section']; ?>
                                    </td>
                                    <td>
                    					<?php if($banner['status'] == 0) { ?>
                    						<a href="<?php echo base_url('admin/settings/banner/change_status?secure_token=' . $this->security_lib->encrypt($banner['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($banner['status'] == 1) { ?>
                    						<a href="<?php echo base_url('admin/settings/banner/change_status?secure_token=' . $this->security_lib->encrypt($banner['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
                                   <td>
                                        <a href="<?php echo base_url('admin/settings/banner/edit?secure_token=' . $this->security_lib->encrypt($banner['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a onclick="confirmDelete('<?php echo base_url('admin/settings/banner/delete?secure_token=' . $this->security_lib->encrypt($banner['id'])); ?>');" class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction();"></i> Delete
                    				 	</a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="7" class="text-center">
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