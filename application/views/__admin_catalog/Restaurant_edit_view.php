<link href="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.css" rel="stylesheet"/>
<link href="https://code.jquery.com/ui/1.12.1/themes/pepper-grinder/jquery-ui.css" rel="stylesheet"/>
<div class="row">
    <div class="col-md-12">
        <?php
            $attributes = array(
                'class' => 'form-horizontal form-groups-bordered validate'
            );

            echo form_open_multipart('admin/catalog/restaurant/edit?secure_token=' . $this->security_lib->encrypt($restaurant['id']), $attributes);
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
            Edit Restaurant Details

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
                <a class="btn btn-red btn-icon icon-left" href="<?php echo base_url('admin/catalog/restaurant'); ?>">
                    <i class="entypo-cancel"></i> Cancel
                </a>
            </span>
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
				<div class="form-group <?php if(form_error('slug')) { echo 'validate-has-error'; } ?>">
                        <?php
                            $attributes = array(
                                'class' => 'col-sm-3 control-label'
                            );
        
                            echo form_label('Slug: ', 'slug', $attributes);
                        ?>
                        <div class="col-sm-8">
                            <?php
                                $attributes = array(
                                    'name' => 'slug',
                                    'data-validate' => "maxlength[255]",
                                    'data-message-required' => 'Slug( SEO URL ) cannot more than 255 characters.',
                                    'placeholder' => 'Please Enter Slug(Seo URL) e.g. restaurant-name',
                                    'class' => 'form-control',
                                    'value' => set_value('slug', $restaurant['slug'])
                                );
        
                                echo form_input($attributes);
                            ?>
                            <?php if(form_error('slug')) { ?>
            					<?php echo form_error('slug', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                            <span class="description">Tip: Use only small alphanumerics letters and underscore(-) to form slug(seo url)</span>
                        </div>
                    </div>
                
                <div class="form-group <?php if(form_error('country_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Country: ', 'country_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'country_id',
                                'class' => 'form-control',
                                'id' => 'country',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select country'
                                
                            );
    
                            echo form_dropdown($attributes, $countries, set_value('country_id', $restaurant['country_id']));
							?>
							 <?php if(form_error('country_id')) { ?>
            					<?php echo form_error('country_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
							
                    </div>
                </div>
               <div class="form-group <?php if(form_error('city_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('City: ', 'city_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'city_id',
                                'class' => 'form-control',
                                'id' => 'city',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select city'
                            );
    
                            echo form_dropdown($attributes, $cities, set_value('city_id', $restaurant['city_id']));
							?>
							
                                <?php if(form_error('city_id')) { ?>
            					<?php echo form_error('city_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                    </div>
                </div>
              
                 <div class="form-group <?php if(form_error('agent_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Agent: ', 'agent_id', $attributes);
                    ?>
                    <div class="col-sm-8">
                        <?php
                            $attributes = array(
                                'name' => 'agent_id',
                                'class' => 'form-control',
                                'data-validate' => 'required',
                                'data-message-required' => 'Please select agent'
                            );
    
                            echo form_dropdown($attributes, $agents, $restaurant['agent_id']);
							 ?>
								 <?php if(form_error('agent_id')) { ?>
            					<?php echo form_error('agent_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                    </div>
                </div>
                 <div class="form-group <?php if(form_error('agent_cost')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Agent Cost: ', 'agent_cost', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'agent_cost',
                                    'type'  => 'number',
                                    'placeholder' => 'Please Enter Agent Cost',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => '  Please Enter Agent Cost',
                                    'value' => set_value('agent_cost', $restaurant['agent_cost'])
                                );
        
                                echo form_input($attributes);
                            ?>
                        	<span class="input-group-addon">USD</span>
    					</div>	
                        <?php if(form_error('agent_cost')) { ?>
                        	<?php echo form_error('agent_cost', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                        <?php } ?>	
                    </div>
                </div>

                <div class="form-group <?php if(form_error('price')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Price:', 'price', $attributes);
                    ?>
                    <div class="col-sm-8">
                    	<div class="input-group">
							<span class="input-group-addon">$</span>
                            <?php
                                $attributes = array(
                                    'name' => 'price',
                                    'type'  => 'number',
                                    'id' => 'adult_price',
                                    'placeholder' => 'Please Enter Price',
                                    'class' => 'form-control',
                                    'data-validate' => 'required',
                                    'data-message-required' => ' Price cannot leave blank',
                                    'value' => set_value('price', $restaurant['price'])
                                );
        
                                echo form_input($attributes);
    						?>
    						<span class="input-group-addon">USD</span>
    					</div>	
						
						<?php if(form_error('price')) { ?>
        					<?php echo form_error('price', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
        				<?php } ?>	
                    </div>
                </div>
     
			  <div class="form-group <?php if(form_error('restaurant_category_id')) { echo 'validate-has-error'; } ?>">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
        
                        echo form_label('Category : ', 'restaurant_category_id', $attributes);
                    ?>
                 <div class="col-sm-8">
                    <?php
                        $attributes = array(
                            'name' => 'restaurant_category_id',
                            'id' => 'restaurant_category_id',
                            'class' => 'form-control ckeditor',
                            'data-validate' => 'required',
                            'data-message-required' => 'Please select category',
                        );
    
                        echo form_dropdown($attributes, $categories, set_value('restaurant_category_id', $restaurant['restaurant_category_id']));
                     ?>
                     <?php if(form_error('restaurant_category_id')) { ?>
                				<?php echo form_error('restaurant_category_id', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
                			<?php } ?>
                 </div>
             </div>
				
                <!-- restaurant BLOCK -->
                
                
                <div class="form-group">
                    <?php
                        $attributes = array(
                            'class' => 'col-sm-3 control-label'
                        );
    
                        echo form_label('Block Dates: ', 'restaurant_avalability', $attributes);
                    ?>
                    
                    <div class="col-sm-8">
						<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
						<script src="https://cdn.rawgit.com/dubrox/Multiple-Dates-Picker-for-jQuery-UI/master/jquery-ui.multidatespicker.js"></script>
						<input class="form-control" name="block_restaurant_dates" id="mdp-demo" value="<?php echo $blocked_dates; ?>" />
                   		
                   		<script type="text/javascript">
                   			$('#mdp-demo').multiDatesPicker({
                   				dateFormat: 'dd-mm-yy'
                   			});
                   		</script>
                    </div>
                </div>
                
                <!-- END restaurant BLOCK -->
                
                
                <div class="form-group <?php if(form_error('postimage[0]')) { echo 'validate-has-error'; } ?>">
                    <?php
                    $attributes = array(
					    'name'	=>'image',
                        'class' => 'col-sm-3 control-label'
                    );

                    echo form_label('Images: ', 'image', $attributes);
                    ?>

                    <div class="col-sm-8">
                        <!-- Check Missing Text File in Root -->

                        <div class="file-box news-feed-upload-image" id="image-section" data-username="<?php echo strtolower(str_replace(' ', '-', $this->session->userdata('username'))); ?>">
                            <ul class="rm list-inline rp">
                                <?php if (!empty($restaurant['images'])) { ?>
                                    <?php foreach ($restaurant['images'] as $row) { ?>
                                        <li class="new-image uploaded">
                                            <img src="<?php echo base_url($row['image']) ?>">
                                            <i class="entypo-trash trash-icn" onclick="delete_edit_image(event)"></i>
                                            <input type="hidden" name="postimage[]" value="<?php echo $row['image']; ?>">
                                        </li>
                                    <?php } ?>
                                <?php } ?>

                                <li id="add-image-box">
                                    <label for="post_edit_images" style="height:100px">
                                        <i class="entypo-plus"></i> Add Image
                                    </label>
                                    <input type="file" multiple class="form-control" id="post_edit_images" name="images[]" accept="image/x-png,image/gif,image/jpeg">
                                </li>
                            </ul>
                        </div>
						<?php if(form_error('postimage[0]')) { ?>
            					<?php echo form_error('postimage[0]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                    </div>
                </div>
               
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
                                        'checked' => $restaurant['status'] == 1 ? TRUE : FALSE
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
						
                             <div class="form-group <?php if(form_error('details[' . $language['code'] . '][title]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Title: ', 'title', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][title]',
                                        'placeholder' => 'Please Enter Title',
                                        'class' => 'form-control',
                                        'data-validate' => 'required',
                                        'data-validate' => "minlength[3],maxlength[255]",
                                        'value' => set_value('details[' . $language['code'] . '][title]', $restaurant_details[$language['code']]['title'])
                                    );

                                    echo form_input($attributes);
									?>
								<?php if($language['code']=='en'){?>
								 <?php if(form_error('details[' . $language['code'] . '][title]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
								<?php } ?>
									
                                </div>
                            </div>

                           <div class="form-group <?php if(form_error('details[' . $language['code'] . '][dsc]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Description: ', 'dsc', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][dsc]',
                                        'placeholder' => 'Please Enter  Description',
                                        'class' => 'form-control',
                                        'data-validate' => 'required',
                                        'data-validate' => "minlength[80]",
                                        'value' => set_value('details[' . $language['code'] . '][dsc]', $restaurant_details[$language['code']]['dsc'])
                                    );

                                    echo form_textarea($attributes);
									?>
							
								<?php if(form_error('details[' . $language['code'] . '][dsc]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>	
                                </div>
                            </div>

                            <div class="form-group <?php if(form_error('details[en][tags]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Tags:', 'tags', $attributes);
                                ?>

                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][tags]',
                                        'placeholder' => 'Please Enter Meta Tags',
                                        'class' => 'form-control',
                                        'data-validate' => "maxlength[255]",
                                        'value' => set_value('details[' . $language['code'] . '][tags]', $restaurant_details[$language['code']]['tags'])
                                    );

                                    echo form_input($attributes);
									?>
								<?php if(form_error('details[' . $language['code'] . '][tags]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][tags]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                                </div>
                            </div>
                             <div class="form-group <?php if(form_error('details[en][meta_title]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Meta Title:', 'meta_title', $attributes);
                                ?>

                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][meta_title]',
                                        'placeholder' => 'Please Enter Meta Title',
                                        'class' => 'form-control',
                                        'data-validate' => "maxlength[255]",
                                        'value' => set_value('details[' . $language['code'] . '][meta_title]', $restaurant_details[$language['code']]['meta_title'])
                                    );

                                    echo form_input($attributes);
									?>
								<?php if(form_error('details[' . $language['code'] . '][meta_title]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][meta_title]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('details[en][meta_dsc]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Meta Description:', 'meta_dsc', $attributes);
                                ?>

                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][meta_dsc]',
                                        'placeholder' => 'Please Enter Meta Description',
                                        'class' => 'form-control',
                                        'data-validate' => "maxlength[255]",
                                        'value' => set_value('details[' . $language['code'] . '][meta_dsc]', $restaurant_details[$language['code']]['meta_dsc'])
                                    );

                                    echo form_textarea($attributes);
									?>
									<?php if(form_error('details[' . $language['code'] . '][meta_dsc]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][meta_dsc]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
            				<?php } ?>
                                </div>
                            </div>
                            <div class="form-group <?php if(form_error('details[en][meta_keywords]')) { echo 'validate-has-error'; } ?>">
                                <?php
                                $attributes = array(
                                    'class' => 'col-sm-3 control-label'
                                );

                                echo form_label('Meta Keywords:', 'meta_keywords', $attributes);
                                ?>
                                <div class="col-sm-8">
                                    <?php
                                    $attributes = array(
                                        'name' => 'details[' . $language['code'] . '][meta_keywords]',
                                        'class' => 'form-control',
                                        'data-validate' => "maxlength[255]",
                                        'placeholder' => 'Please Enter Meta Keywords',
                                        'value' => set_value('details[' . $language['code'] . '][meta_keywords]', $restaurant_details[$language['code']]['meta_keywords'])
                                    );

                                    echo form_input($attributes);
									?>
								<?php if(form_error('details[' . $language['code'] . '][meta_keywords]')) { ?>
            					<?php echo form_error('details[' . $language['code'] . '][meta_keywords]', '<span class="validate-has-error"><i class="entypo-cancel-circled"></i> ', '</span>'); ?>
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

<script>
var base_url = "<?php echo base_url(); ?>";

function changeImage(element) {
    var id = $(element).attr('id');
    $('#' + id + ' input[type="file"]').trigger('click');
}

function clearImage(element) {
    var id = $(element).attr('id');
    $('#' + id + ' label').html('<i class="fa fa-image"></i> Add Image');
    $('#' + id + ' label').css('display', 'table-cell');
    $('#' + id + ' input[type="file"]').val('');
}

</script>

<script>
$('#post_edit_images').change(function (e) {
	e.preventDefault();
	var count = $('input[name="postimage[]"]').length;

    var a = $('#' + $(this).attr('id'));
    var form_data = new FormData();
    var itemId = [];
    var validate = 1;

    $.each($('input[name="images[]"]'), function (i, obj) {
		if(count + (obj.files.length) <= 6) {
			
		if(count + (obj.files.length) == 6) {
			$('#add-image-box').hide();
		}
		
            $.each(obj.files, function (j, file) {
            	if(file.size >= 3000000) {
					imageErrorFunc('Please Upload Image Less Than 3MB.');
					count--;
					validate = 0; 
					return false;
            	}
                
                var ext = file.type;
                switch (ext) {
                    case 'image/jpg':
                    case 'image/jpeg':
                    case 'image/png':
                    case 'image/gif':
                        break;
                    default:
                    	imageErrorFunc('This is not an allowed file type');
                    	count--;
                        validate = 0;
                        return false;
                }

                var newClass = 'image-upload-' + $.now() + '-' + j;

                a.parent().before('<li class="load new-image ' + newClass + '" id="image_upload_' + j + '"></li>');
                itemId[j] = newClass;
            });

            count++;
            
		} else { 
			imageErrorFunc("Maximum 6 Images can be uploaded");
			return false;
		}
    });

    if (validate == 0) {
        return false;
    }

    $.each($('input[name="images[]"]'), function (i, obj) {
        $.each(obj.files, function (j, file) {
            form_data.set('image', file);
            var element = $('.' + itemId[j]);
            element.removeClass('load');

            if ($('body #temprory_CSS_05698').length == 0) {
                $('body').prepend('<div id="temprory_CSS_05698"></div>');
            }

            form_data.set($('#_CTN').val(), $('#_CTH').val());

            $.ajax({
                // New
                xhr: function () {
                    var xhr = new window.XMLHttpRequest();
                    xhr.upload.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                        }
                    }, false);

                    xhr.addEventListener("progress", function (evt) {
                        if (evt.lengthComputable) {
                            var percentComplete = (evt.loaded / evt.total) * 100;
                            $('#temprory_CSS_05698').html('<style>.' + itemId[j] + ':before{width:' + percentComplete + '%}</style>');
                        }
                    }, false);
                    return xhr;
                },

                // END
                url: base_url + 'admin/catalog/restaurant/add_image',
                contentType: false,
                processData: false,
                data: form_data,
                type: 'post',
                success: function (response) {
                    if (response['type'] == 'success') {

                        $('#_CTN').val(response._CTN);
                        $('#_CTH').val(response._CTH);

                        $("#hash_update").attr('name', response._CTN);
                        $("#hash_update").attr('value', response._CTH);

                        element.html('<img src="' + base_url + response.file + '"><i class="entypo-trash trash-icn" onclick="delete_edit_image(event)"></i>');
                        element.addClass('uploaded');
                        element.attr('id', '');
                        element.append('<input type="hidden" name="postimage[]" value="' + response.file + '">');
                        $('#temprory_CSS_05698').html('');
                    } else {

                    	$('#_CTN').val(response._CTN);
                        $('#_CTH').val(response._CTH);

                        $("#hash_update").attr('name', response._CTN);
                        $("#hash_update").attr('value', response._CTH);

                        imageErrorFunc(response['text']);

                        element.remove();
                        count--;
                        console.log(response);
                    }
                }
            })
        });
    });
});

/* =================================================
	IMAGE DELETE AJAX AND THEM CONTENT
==================================================== */

function delete_edit_image(e) {
	$('#add-image-box').show();
	
	var form_data = {file: $(e.target).next().val()};
	form_data[$('#_CTN').val()] = $('#_CTH').val();
	
	$.post(base_url + 'admin/catalog/restaurant/delete_image', form_data, function(response) {

		if (response['type'] == 'success') {
    		$('#_CTN').val(response._CTN);
            $('#_CTH').val(response._CTH);
    
            $("#hash_update").attr('name', response._CTN);
            $("#hash_update").attr('value', response._CTH);
    
            imageSuccessFunc(response['text']);
		} else {
			$('#_CTN').val(response._CTN);
            $('#_CTH').val(response._CTH);
    
            $("#hash_update").attr('name', response._CTN);
            $("#hash_update").attr('value', response._CTH);
    
            //imageErrorFunc(response['text']);
		}
	});
	
    $(e.target).parent().remove();
}
</script>

<script>
    $('#country').on('change', function () {
        $.ajax({
            type: "GET",
            url: "<?php echo base_url('admin/catalog/restaurant/get_cities_by_country_id'); ?>",
            data: {country_id: this.value},
            dataType: "json",
            success: function (res) {
                if (res) {
                    $("#city").empty();
                    $("#city").append('<option>--- Select City ---</option>');

                    for (var i = 0; i < res.length; i++) {
                        $("#city").append('<option value="' + res[i].id + '">' + res[i].name + '</option>');
                    }
                }
            }
        });
    });
</script>