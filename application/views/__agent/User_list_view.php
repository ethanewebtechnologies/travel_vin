 <h3><?php echo $text_h3_heading; ?></h3>
<h3 style="">
	<a href="<?php echo base_url('admin/users/users/add'); ?>"><?php echo $text_add; ?></a>
</h3>
<table class="table table-bordered table-striped datatable" id="table-2">
	<thead>
		<tr>
			<th>
	   			<div class="checkbox checkbox-replace"></div>
			</th>
			<th><?php echo $text_sn; ?></th>
			<th><?php echo $text_uname; ?></th>
			<th><?php echo $text_email; ?></th>
			<th><?php echo $text_type; ?></th>
			<th><?php echo $text_status; ?></th>
			<th><?php echo $text_action; ?></th>
		</tr>
	</thead>
	
	<tbody>
		<?php if($users) { ?>
    		<?php $sr = 1; ?>
    		<?php foreach($users as $user) { ?>
    			<tr>
        			<td>
        				<div class="checkbox checkbox-replace">
        					<input type="checkbox" id="chk-1">
        				</div>
        			</td>
    				<td>
    					<?php echo $sr; ?>
    				</td>
    				<td>
    					<?php echo (!empty($user['lastname'])) ? ($user['firstname'].' '.$user['lastname']) : $user['firstname']; ?>
    				</td>
    				<td>
    					<?php echo $user['email']; ?>
    				</td> 
					<td>
    					<?php echo $user['user_group_id']; ?>
    				</td>
					<td>
    					<?php if($user['status']==0){ ?>
						<button type="button" class="btn btn-danger">
							<i class="entypo-cancel"></i>
						</button>
						<?php }else{ ?>
						<button type="button" class="btn btn-success">
							<i class="entypo-check"></i>
						</button>
						<?php } ?>
    				</td>
    				<td>
    					<a href="<?php echo base_url('admin_users/users/edit/' . $user['id']); ?>" class="btn btn-default btn-sm btn-icon icon-left">
    						<i class="entypo-pencil"></i> <?php echo $text_edit; ?>
    					</a>
    					<a href="<?php echo base_url('admin_users/users/delete/' . $user['id']); ?>" class="btn btn-danger btn-sm btn-icon icon-left">
    						<i class="entypo-cancel" onclick="myFunction()"></i> <?php echo $text_delete; ?>
    				 	</a>
    				</td>
    			</tr>
    			<?php $sr++; ?>
    		<?php } ?>
    	<?php } else { ?>
    		<tr>
    			<td colspan="4" class="text-center"><?php echo $text_no_result; ?></td>
    		</tr>
    	<?php } ?>	
	</tbody>
</table>


<script type="text/javascript">
		jQuery( window ).load( function() {
			var $table2 = jQuery( "#table-2" );
			
			// Initialize DataTable
			$table2.DataTable( {
				"sDom": "tip",
				"bStateSave": false,
				"iDisplayLength": 8,
				"aoColumns": [
					{ 
						"bSortable": false 
					},
					null,
					null,
					null,
					null
				],
				"bStateSave": true
			});
			
			// Highlighted rows
			$table2.find( "tbody input[type=checkbox]" ).each(function(i, el) {
				var $this = $(el), $p = $this.closest('tr');
				
				$( el ).on( 'change', function() {
					var is_checked = $this.is(':checked');
					
					$p[is_checked ? 'addClass' : 'removeClass']( 'highlight' );
				});
			});
			
			// Replace Checboxes
			$table2.find( ".pagination a" ).click( function( ev ) {
				replaceCheckboxes();
			});
		});
			
		// Sample Function to add new row
		var giCount = 1;
		
		function fnClickAddRow() {
			jQuery('#table-2').dataTable().fnAddData( [ '<div class="checkbox checkbox-replace"><input type="checkbox" /></div>', giCount + ".1", giCount + ".2", giCount + ".3", giCount + ".4" ] );
			replaceCheckboxes(); // because there is checkbox, replace it
			giCount++;
		}
</script>