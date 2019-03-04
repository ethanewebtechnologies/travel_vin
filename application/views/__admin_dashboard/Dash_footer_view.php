    	<!-- Footer -->
    	<footer class="main">
    		&copy; <?php echo date('Y'); ?> <strong>Sunshine</strong> Admin Panel - Powered by <a href="<?php echo prep_url('http://www.ethanetechnologies.com/'); ?>" target="_blank">Ethane Web Technologies</a>
    	</footer>
	</div>
</div>	
	<script src="<?php echo base_url('assets/admin/js/joinable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/resizeable.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/neon-api.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/jvectormap/jquery-jvectormap-1.2.2.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/selectboxit/jquery.selectBoxIt.min.js'); ?>"></script>

	<!-- Imported scripts on this page -->
	<script src="<?php echo base_url('assets/admin/js/jvectormap/jquery-jvectormap-europe-merc-en.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/jquery.sparkline.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/rickshaw/vendor/d3.v3.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/rickshaw/rickshaw.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/raphael-min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/morris.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/toastr.js'); ?>"></script>
	<!-- <script src="<?php echo base_url('assets/admin/js/datatables/datatables.js'); ?>"></script> -->
	<script src="<?php echo base_url('assets/admin/js/select2/select2.min.js'); ?>"></script>
	<script src="<?php echo base_url('assets/admin/js/neon-chat.js'); ?>"></script>	
	<script src="<?php echo base_url('assets/admin/js/fileinput.js'); ?>"></script>
	
	<!-- JavaScripts initializations and stuff -->
	<script src="<?php echo base_url('assets/admin/js/neon-custom.js'); ?>"></script>

	<!-- Demo Settings -->
	<script src="<?php echo base_url('assets/admin/js/neon-demo.js'); ?>"></script>
	
	 <script type="text/javascript">
    	imageErrorFunc = function (message) {
    		var opts = {
    			"closeButton": true,
    			"debug": false,
    			"positionClass": "toast-top-full-width",
    			"onclick": null,
    			"showDuration": "300",
    			"hideDuration": "1000",
    			"timeOut": "5000",
    			"extendedTimeOut": "1000",
    			"showEasing": "swing",
    			"hideEasing": "linear",
    			"showMethod": "fadeIn",
    			"hideMethod": "fadeOut"
    		};
    		
    		toastr.error(message, "Error!", opts);
    	};
    </script>
     <script type="text/javascript">
    	imageSuccessFunc = function (message) {
    		var opts = {
    				"closeButton": true,
        			"debug": false,
        			"positionClass": "toast-top-full-width",
        			"onclick": null,
        			"showDuration": "300",
        			"hideDuration": "1000",
        			"timeOut": "5000",
        			"extendedTimeOut": "1000",
        			"showEasing": "swing",
        			"hideEasing": "linear",
        			"showMethod": "fadeIn",
        			"hideMethod": "fadeOut"
    		};
    		
    		toastr.success(message, "Success!", opts);
    	};
    </script>	
	 
     <?php if($this->session->flashdata('added_successfully')) { ?>
        <script type="text/javascript">
        	var opts = {
    			"closeButton": true,
    			"debug": false,
    			"positionClass": "toast-bottom-left",
    			"onclick": null,
    			"showDuration": "300",
    			"hideDuration": "1000",
    			"timeOut": "5000",
    			"extendedTimeOut": "1000",
    			"showEasing": "swing",
    			"hideEasing": "linear",
    			"showMethod": "fadeIn",
    			"hideMethod": "fadeOut"
    		};
    		
    		toastr.success("Record has added successfully ...", "Success!", opts);
    	</script>
    <?php } ?>
    
    <?php if($this->session->flashdata('updated_successfully')) { ?>
        <script type="text/javascript">
        	var opts = {
    			"closeButton": true,
    			"debug": false,
    			"positionClass": "toast-bottom-left",
    			"onclick": null,
    			"showDuration": "300",
    			"hideDuration": "1000",
    			"timeOut": "5000",
    			"extendedTimeOut": "1000",
    			"showEasing": "swing",
    			"hideEasing": "linear",
    			"showMethod": "fadeIn",
    			"hideMethod": "fadeOut"
    		};
    		
    		toastr.success("Record has updated successfully ...", "Success!", opts);
    	</script>
    <?php } ?>
    
    <?php if($this->session->flashdata('validation_error')) { ?>
        <script type="text/javascript">
        	var opts = {
        		"closeButton": true,
        		"debug": false,
        		"positionClass": "toast-top-full-width",
        		"onclick": null,
        		"showDuration": "300",
        		"hideDuration": "1000",
        		"timeOut": "5000",
        		"extendedTimeOut": "1000",
        		"showEasing": "swing",
        		"hideEasing": "linear",
        		"showMethod": "fadeIn",
        		"hideMethod": "fadeOut"
        	};
        	
        	toastr.error("Validation Failed Please Check the form ...", "Oops!", opts);
    	</script>
    <?php } ?>
</body>
</html>