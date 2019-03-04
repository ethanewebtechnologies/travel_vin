<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <?php echo "All Golfs Here ..."; ?>
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/catalog/golf/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            <?php if((isset($search_title) && strlen($search_title) > 0) || (isset($search_price) && strlen($search_price) > 0)) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_golfs) { ?>
                                <?php if ($total_golfs > 1) { ?>
                                    <?php echo $total_golfs; ?> results
                                <?php } else if ($total_golfs == 1) { ?>
                                    <?php echo $total_golfs; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;
                            	<?php if(strlen($search_title) > 0) { ?>
									<?php if(strlen($search_price) > 0) { ?>
										<?php echo $search_title . ', ' . $search_price; ?>
									<?php } else { ?>
										<?php echo $search_title; ?>
									<?php } ?>
								<?php } else { ?>
									<?php if(strlen($search_price) > 0) { ?>
										<?php echo $search_price; ?>
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
    
                echo form_open('admin/catalog/golf', $attributes);
            ?>
           		<div class="row">
					<div class="col-sm-5">
						<?php 
							$attributes = array(
							    'name' => 'search_title',
							    'placeholder' => 'Search for Golfs...',
							    'class' => 'form-control input-lg',
							    'value' => $search_title
							);
							
							echo form_input($attributes);
						?>
					</div>
					<div class="col-sm-5">
						<?php 
							$attributes = array(
								'name' => 'search_price',
								'placeholder' => 'Search For Price...',
								'class' => 'form-control input-lg',
							    'value' => $search_price
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
                            <th class="col-sm-1">
                                SN.
                            </th>
                            <th class="col-sm-1">
                               Image
                            </th>
                            <th class="col-sm-4">
                                Title
                            </th>
                             <th class="col-sm-2">
                                Price
                            </th>
                            <th class="col-sm-2">
                                Location
                            </th>
                            <th class="col-sm-2">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($golfs) { ?>
                        	<?php $sr = 1; ?>
                        	<?php foreach ($golfs as $golf) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>	
                                    	<?php if(isset($golf['image']) && file_exists($golf['image'])) { ?>
    										<?php 
    									        echo $optimized->resize($golf['image'], 100, 50, array(), 'resize_crop');
    									    ?>
    									<?php } else { ?>
    										<?php echo $optimized->resize('assets/img/empty.jpg', 100, 50, array(), 'resize_crop'); ?>
    									<?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $golf['title']; ?>
                                    </td>
                                    <td>
                                         $<?php echo number_format($golf['price'], PRICE_DELIMITER); ?> USD
                                    </td>
                                    <td style="word-break: break-all;">
                                    	<?php echo isset($golf['city_id']) ? $golf['city_name'] : THREE_DASH; ?>,
									<?php echo isset($golf['country_id']) ? $golf['country_name'] : THREE_DASH; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/catalog/golf/edit?secure_token=' . $this->security_lib->encrypt($golf['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a onclick="confirmDelete('<?php echo base_url('admin/catalog/golf/delete?secure_token='
                                            . $this->security_lib->encrypt($golf['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
                    						<i class="entypo-cancel" onclick="myFunction()"></i> Delete
                    				 		</a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="6" class="text-center">
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
