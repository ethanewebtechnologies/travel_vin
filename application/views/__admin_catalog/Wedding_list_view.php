<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                All Weddings Here ...
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/catalog/wedding/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            <?php if ($search_title) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_weddings) { ?>
                                <?php if ($total_weddings > 1) { ?>
                                    <?php echo $total_weddings; ?> results
                                <?php } else if ($total_weddings == 1) { ?>
                                    <?php echo $total_weddings; ?> result
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
    
                echo form_open('admin/catalog/wedding', $attributes);
            ?>
            <div class="input-group">
                <?php
                    $attributes = array(
                        'name' => 'search_title',
                        'placeholder' => 'Search for Weddings...',
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
                            <th class="col-sm-1">
                               Image
                            </th>
                            <th class="col-sm-5">
                                Title
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
                        <?php if ($weddings) { ?>
                        	<?php $sr = 1; ?>
                        	<?php foreach ($weddings as $wedding) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>	
                                    	<?php if(isset($wedding['image']) && file_exists($wedding['image'])) { ?>
    										<?php 
    									        echo $optimized->resize($wedding['image'], 100, 50, array(), 'resize_crop');
    									    ?>
    									<?php } else { ?>
    										<?php echo $optimized->resize('assets/img/empty.jpg', 100, 50, array(), 'resize_crop'); ?>
    									<?php } ?>
                                    </td>
                                    <td>
                                        <?php echo $wedding['title']; ?>
                                    </td>
                                     <td>
                                    <?php echo isset($wedding['city_id']) ? $wedding['city_name'] : THREE_DASH; ?>,
									<?php echo isset($wedding['country_id']) ? $wedding['country_name'] : THREE_DASH; ?>
                                    </td>
                                    <td>
                                        <a href="<?php echo base_url('admin/catalog/wedding/edit?secure_token=' . $this->security_lib->encrypt($wedding['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a href="<?php echo base_url('admin/catalog/wedding/delete?secure_token=' . $this->security_lib->encrypt($wedding['id'])); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel" onclick="myFunction()"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">
                                    No Record Found!
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
