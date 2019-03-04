<h3><?php echo $text_h3_heading; ?></h3>

<div class="row clear-fix">
    <div class="col-md-12">
		<?php 
            $attributes = array(
                'class' => 'form-inline',
                'role' => 'form',
            );
            
            echo form_open_multipart('admin/settings/file-manager/fm-do-upload', $attributes); 
    	?>
            <div class="form-group" style="background: #f5f5f5">
            	<label for="">Choose image</label>
           	 	<input type="file" name="userfile" id="userfile" multiple>
            </div>
            <div class="form-group">
            	<input type="submit" class="btn btn-info btn-block" style="width: 200px;" value="Add">
            </div>
            <div class="form-group">
            	<img id="loader" src="<?php echo base_url() ?>asset/images/486.GIF" style="height: 30px;">
            </div>
            <div class="form-group">
            	<img id="preview" src="#" style="height: 80px;border: 1px solid #DDC; " />
            </div>
    	<?php echo form_close(); ?>
    </div>
</div>
<div class="row clear-fix">
    <div class="col-md-12">
        <div id="response">
        </div>  
    </div>
</div>
<div class="row clear-fix">
    <div class="col-md-12">
        <div style="margin-top: 1%;">
            <blockquote>
                <ul class="list-inline"  id="gallery">
                </ul>
            </blockquote>
        </div>  
    </div>
</div>
<script>
$(document).ready(function () {
    loadGallery();

    function readURL(input) {
        $("#preview").show();

        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
            	$('#preview').attr('src', e.target.result);
        	};
    
        	reader.readAsDataURL(input.files[0]);
        }
    }
    
    $("#userfile").change(function() {
    	readURL(this);
    });
    
    $('form').ajaxForm({
    	beforeSend: function() {
    		$("#loader").show();
    	},
    	complete: function(xhr) {
    		$("#response").html(xhr.responseText);
    		$("#loader").hide();
    		$('form').resetForm();
    		loadGallery();
    	}
    }); 
    
    function loadGallery() {
    	$.ajax({
    		url: "<?php echo base_url('admin/settings/file-manager/fillGallery'); ?>",
    		type: 'GET'
    	}).done(function (data) {
    		$("#gallery").html(data);

    		var btnDelete  = $("#gallery").find($(".btn-delete"));

    		(btnDelete).on('click', function (e) {
    			e.preventDefault();
    			var id = $(this).attr('id');
    			$("#"+id+"g").hide();

    			$.ajax({
    				url: "<?php echo base_url('admin/settings/file-manager/deleteimg'); ?>",
    				data:'id='+id,
    				type:'GET'
    			}).done(function (data) {
    			});
    		});
    	});
    }
});
</script>	
<!--<script>
    (function() {
        var bar = $('.bar');
        var percent = $('.percent');
        var status = $('#status');
        
        $('form').ajaxForm({
            beforeSend: function() {
                status.empty();
                var percentVal = '0%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            uploadProgress: function(event, position, total, percentComplete) {
                var percentVal = percentComplete + '%';
                bar.width(percentVal)
                percent.html(percentVal);
                //console.log(percentVal, position, total);
            },
            success: function() {
                var percentVal = '100%';
                bar.width(percentVal)
                percent.html(percentVal);
            },
            complete: function(xhr) {
                status.html(xhr.responseText);
            }
        }); 
    })();       
</script>-->