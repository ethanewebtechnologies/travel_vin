<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                <?php echo "All Tour Category Here ..."; ?>
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/catalog/tour-category/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            <?php if ($search_category_name) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_tour_categories) { ?>
                                <?php if ($total_tour_categories > 1) { ?>
                                    <?php echo $total_tour_categories; ?> results
                                <?php } else if ($total_tour_categories == 1) { ?>
                                    <?php echo $total_tour_categories; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_category_name; ?>&quot;</strong>
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

            echo form_open('admin/catalog/tour-category', $attributes);
            ?>
            <div class="input-group">
                <?php
                $attributes = array(
                    'name' => 'search_category_name',
                    'placeholder' => 'Search for categories...',
                    'class' => 'form-control input-lg',
                    'value' => $search_category_name
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
                            <!--<th class="col-sm-1">
                                <div class="checkbox checkbox-replace"></div>
                            </th>-->
                            <th class="col-sm-1">
                                SN.
                            </th>                           
                            <th class="col-sm-8">
                              Categeory Name
                            </th>
                            <th class="col-sm-2">
                                Action
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php if ($tour_categories) { ?>
                            <?php
                            $sr = 1;
                            foreach ($tour_categories as $tour_category) {
                                ?>
                                <tr>
                                    <!--<td>
                                        <div class="checkbox checkbox-replace">
                                            <input type="checkbox" id="chk-1">
                                        </div>
                                    </td>-->
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                  
                                    <td>
                                        <?php 	echo $tour_category['category_name']; ?>
                                    </td>
                                   <td>
                                        <a href="<?php echo base_url('admin/catalog/tour-category/edit?secure_token=' . $this->security_lib->encrypt($tour_category['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a onclick="confirmDelete('<?php echo base_url('admin/catalog/tour-category/delete?secure_token='
                                            . $this->security_lib->encrypt($tour_category['id'])); ?>')" 
            							    class="btn btn-danger btn-sm btn-icon icon-left">
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