<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <?php echo "All Transportations Here ..."; ?>
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/catalog/transportation/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            <?php if ($search_title) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_transportations) { ?>
                                <?php if ($total_transportations > 1) { ?>
                                    <?php echo $total_transportations; ?> results
                                <?php } else if ($total_transportations == 1) { ?>
                                    <?php echo $total_transportations; ?> result
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

                echo form_open('admin/catalog/transportation', $attributes);
            ?>
            <div class="row">
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_title',
                            'placeholder' => 'Search for Transportation...',
                            'class' => 'form-control input-lg',
                            'value' => $search_title
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_park',
                            'placeholder' => 'Search for Park ...',
                            'class' => 'form-control input-lg',
                            'value' => $search_park
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
            	<div class="col-sm-2">
            	</div>
            </div>
            <br>
            <div class="row">	
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_private_price_per_passenger',
                            'placeholder' => 'Search for Private Price...',
                            'class' => 'form-control input-lg',
                            'value' => $search_private_price_per_passenger
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
            	<div class="col-sm-5">
            		<?php
                        $attributes = array(
                            'name' => 'search_shared_price_per_passenger',
                            'placeholder' => 'Search for Shared Price...',
                            'class' => 'form-control input-lg',
                            'value' => $search_shared_price_per_passenger
                        );
        
                        echo form_input($attributes);
                    ?>
            	</div>
                
                <div class="col-sm-2">
                    <?php
                        $attributes = array(
                            'type' => 'submit',
                            'content' => 'Search <i class="entypo-search"></i>',
                            'class' => 'btn btn-lg btn-primary btn-icon pull-right'
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
                            <th class="col-sm-3">
                               Trip (From &rarr; To)
                            </th>
                            <th class="col-sm-2">
                                Park
                            </th>
                            <th class="col-sm-2">
                                Private Price
                            </th>
                            <th class="col-sm-2">
                                Shared Price
                            </th>
                            <th class="col-sm-2">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($transportations) { ?>
                        	<?php $sr = 1; ?>
                        	<?php foreach ($transportations as $transportation) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>	
                                    	<small><?php echo $transportation['from']; ?></small>
                                    	&rarr;
                                        <small><?php echo $transportation['to']; ?></small>
                                    </td>
                                    <td>
                                        <?php echo $transportation['park_name']; ?>
                                    </td>
                                    <td>
                                    	$<?php echo number_format($transportation['private_price_per_passenger'], PRICE_DELIMITER); ?> USD
                                    </td>
                                    <td>
                                    	 $<?php echo number_format($transportation['shared_price_per_passenger'], PRICE_DELIMITER); ?> USD
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/catalog/transportation/edit?secure_token=' . $this->security_lib->encrypt($transportation['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a onclick="confirmDelete('<?php echo base_url('admin/catalog/transportation/delete?secure_token='
                                            . $this->security_lib->encrypt($transportation['id'])); ?>')" 
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
                                    No Record Found!
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
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
