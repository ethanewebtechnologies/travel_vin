<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );

            echo form_open_multipart('admin/catalog/tour-category/edit?secure_token=' . $this->security_lib->encrypt($tour_category['id']), $attributes);
        ?>

        <!-- CSRF NAME -->
        <?php
            $attributes = array(
                'type' => 'hidden',
                'id' => '_CTN',
                'name' => '_CTN',
                'value' => $this->security->get_csrf_token_name()
            );
    
            echo form_input($attributes);
        ?>
    
        <?php
            $attributes = array(
                'type' => 'hidden',
                'id' => '_CTH',
                'name' => '_CTH',
                'value' => $this->security->get_csrf_hash()
            );
    
            echo form_input($attributes);
        ?>

        <input type="hidden" id="hash_update" name="<?php echo $this->security->get_csrf_token_name(); ?>" value="<?php echo $this->security->get_csrf_hash(); ?>">
        <!-- END OF CSRF  -->

        <h2>
            Edit Tour Category Details
            <span class="pull-right btn-toolbar">
                <?php
                    $attributes = array(
                        'name' => 'save',
                        'id' => 'save',
                        'value' => 'Save',
                        'type' => 'submit',
                        'content' => '<i class="entypo-check"></i> Save',
                        'class' => 'btn btn-green btn-icon icon-left'
                    );
    
                    echo form_button($attributes);
                ?>
                <?php
                    $attributes = array(
                        'name' => 'reset',
                        'id' => 'reset',
                        'value' => 'Reset',
                        'type' => 'reset',
                        'content' => '<i class="entypo-ccw"></i> Reset',
                        'class' => 'btn btn-orange btn-icon icon-left'
                    );
    
                    echo form_button($attributes);
                ?>
                <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/catalog/tour-category'); ?>">
                    <i class="entypo-cancel"></i> Cancel
                </a>
            </span>
			
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
				 
                <div class="form-group">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Status: ', 'status', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <div class="bs-example">
                            <div class="make-switch" data-on="primary" data-off="info">
                                <?php
                                    $data = array(
                                        'name' => 'status',
                                        'id' => 'status',
                                        'value' => '1',
                                        'checked' => $tour_category['status'] == 1 ? TRUE : FALSE
                                    );
    
                                    echo form_checkbox($data);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lang-tabs">
                    <ul class="nav nav-tabs">
                        <?php $flag = true; ?>
                        <?php foreach ($languages as $language) { ?>
                            <li class="<?php echo $flag ? 'active' : ''; ?>">
                                <a data-toggle="tab" href="#<?php echo $language['code']; ?>">
                                    <?php echo $language['name']; ?>
                                </a>
                            </li>
                            <?php $flag = false; ?>
                        <?php } ?>
                    </ul>
                </div>
                <div class="tab-content">
                    <?php $flag = true; ?>
                    <?php foreach ($languages as $language) { ?>
                        <div id="<?php echo $language['code']; ?>" class="tab-pane fade <?php echo $flag ? 'in active' : ''; ?>">
                            <div class="form-group">
                                <?php
                                    $attributes = array(
                                        'class' => 'col-sm-3 control-label'
                                    );
    
                                    echo form_label('Category Name: ', 'category_name', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                        $attributes = array(
                                            'name' => 'details[' . $language['code'] . '][category_name]',
                                            'placeholder' => 'Please Enter Category Name',
                                            'class' => 'form-control',
                                            'onkeyup' => 'lettersOnly(this)',
                                            'value' => set_value('details[' . $language['code'] . '][category_name]', $tour_category_details[$language['code']]['category_name']),
                                            'data-validate' => 'required, minlength[3], maxlength[255]',
                                            'data-message-required' => 'Category Name required for English atleast'
                                        );
    
                                        echo form_input($attributes);
    								?>
									<?php if($language['code'] == 'en') { ?>
										<?php if(form_error('details[' . $language['code'] . '][category_name]')) { ?>
        									<?php echo form_error('details[' . $language['code'] . '][category_name]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        								<?php } ?>
        							<?php } ?>
                                </div>
                            </div>

                        </div>
                        <?php $flag = false; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<script type="text/javascript">
	function lettersOnly(input){
		var regex = /[^a-zA-Z  ]/gi;
		input.value = input.value.replace(regex,"");
	}
</script>

