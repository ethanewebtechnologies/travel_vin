<section class="search-results-env">
    <div class="row">
        <div class="col-md-12">
            <h2>
                All Language Here ...
                <span class="pull-right btn-toolbar">
                    <a class="btn btn-blue  btn-icon icon-left" href="<?php echo base_url('admin/settings/language/add'); ?>">
                        <i class="entypo-plus"></i> Add New
                    </a>
                </span>
            </h2>
            <hr>
            
            <?php if ($search_type_name) { ?>
                <ul class="nav nav-tabs right-aligned">
                    <li class="tab-title pull-left">
                        <div class="search-string">
                            <?php if ($total_languages) { ?>
                                <?php if ($total_languages > 1) { ?>
                                    <?php echo $total_languages; ?> results
                                <?php } else if ($total_languages == 1) { ?>
                                    <?php echo $total_languages; ?> result
                                <?php } ?>
                            <?php } else { ?>
                                No Result
                            <?php } ?>
                            found for <strong>	&quot;<?php echo $search_type_name; ?>&quot;</strong>
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
    
                echo form_open('admin/settings/language', $attributes);
            ?>
            
            <div class="row">
            	<div class="col-sm-5">
                    <?php
                        $attributes = array(
                            'name' => 'search_type_name',
                            'placeholder' => 'Search for Language...',
                            'class' => 'form-control input-lg',
                            'value' => $search_type_name
                        );
        
                        echo form_input($attributes);
                    ?>
                </div>
                <div class="col-sm-5">
                	<?php
                        $attributes = array(
                            'name' => 'search_lang_code',
                            'placeholder' => 'Search for Language Code...',
                            'class' => 'form-control input-lg',
                            'value' => $search_lang_code
                        );
        
                        echo form_input($attributes);
                    ?>
                </div>
                <div class="col-sm-2">
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
                            <th class="col-sm-6">
								Language
                            </th>
                            <th class="col-sm-1">
								Code
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
                        <?php if ($languages) { ?>
                        	<?php $sr = 1; ?>
                            
                            <?php foreach ($languages as $language) { ?>
                                <tr>
                                    <td>
                                        <?php echo $sr; ?>
                                    </td>
                                    <td>
                                        <?php echo $language['name']; ?>
                                    </td>
                                    <td>
                                        <?php echo $language['code']; ?>
                                    </td>
                                    <td>
                    					<?php if($language['status'] == 0) { ?>
                    						<a href="<?php echo base_url('admin/settings/language/change_status?secure_token=' . $this->security_lib->encrypt($language['id']) . '&change_status=1'); ?>" class="btn btn-danger">
                    							<i class="entypo-cancel"></i>
                    						</a>
                						<?php } ?>
                						
                						<?php if($language['status'] == 1) { ?>
                    						<a href="<?php echo base_url('admin/settings/language/change_status?secure_token=' . $this->security_lib->encrypt($language['id']) . '&change_status=0'); ?>" class="btn btn-success">
                    							<i class="entypo-check"></i>
                    						</a>
                						<?php } ?>
                    				</td>
                                   <td>
                                        <a href="<?php echo base_url('admin/settings/language/edit?secure_token=' . $this->security_lib->encrypt($language['id'])); ?>" class="btn btn-default btn-sm btn-icon icon-left">
                                            <i class="entypo-pencil"></i> Edit
                                        </a>
                                        <a href="<?php echo base_url('admin/settings/language/delete?secure_token=' . $this->security_lib->encrypt($language['id'])); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
                                            <i class="entypo-cancel" onclick="myFunction()"></i> Delete
                                        </a>
                                    </td>
                                </tr>
                                <?php $sr++; ?>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="5" class="text-center">
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
