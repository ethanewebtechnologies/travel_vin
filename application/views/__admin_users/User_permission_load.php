<script src="<?php echo base_url('assets/admin/js/jquery-1.11.3.min.js'); ?>"></script>


<?php foreach ($restricted_zones as $restricted_zone) { ?>
	<div class="checkbox checkbox-replace c2o">
		<label class="cb-wrapper">
			<?php if(in_array($restricted_zone['id'], $user_group_permissions)) { ?>
				<input type="checkbox" name="restrictions[]" value="<?php echo $restricted_zone['id']; ?>" checked>
			<?php } else { ?>
				<input type="checkbox" name="restrictions[]" value="<?php echo $restricted_zone['id']; ?>">
			<?php } ?>  
		</label>
		<label>
			<?php echo sanatize_controller_name($restricted_zone['controller_name']) . ' <i class="entypo-right-open"></i> ' . sanatize_method_name($restricted_zone['method_name']); ?>
		</label>
	</div>
<?php } ?>

<!-- <script src="<?php echo base_url('assets/admin/js/jquery-ui/js/jquery-ui-1.10.3.minimal.min.js'); ?>"></script> -->

<!-- Imported scripts on this page -->
<!-- <script src="<?php echo base_url('assets/admin/js/bootstrap-switch.min.js'); ?>"></script> -->

<!-- JavaScripts initializations and stuff -->
<script src="<?php echo base_url('assets/admin/js/neon-custom.js'); ?>"></script>

<!-- Demo Settings -->
<!-- <script src="<?php echo base_url('assets/admin/js/neon-demo.js'); ?>"></script> -->