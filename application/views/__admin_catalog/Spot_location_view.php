<h3>All Spots Here ...</h3>
<h3 style="">
		<a href="<?php echo base_url('admin_spot/spot/add'); ?>">Add</a>
	</h3>
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
		
	<table class="table table-bordered table-striped datatable" id="table-2">
		<thead>
			<tr>
				<th>
	   				<div class="checkbox checkbox-replace"></div>
				</th>
				<th>Sr.No.</th>
				<th>Spot Title</th>
				<th>Action</th>
			</tr>
		</thead>
		
		<tbody>
			<?php 
		        $sr = 1;
                foreach($spots as $pag) {
	         ?>
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
						<?php echo $pag['title']; ?>
					</td>
					<td>
						<a href="<?php echo base_url('admin_spot/spot/edit/'.$pag['id']);?>" class="btn btn-default btn-sm btn-icon icon-left">
							<i class="entypo-pencil"></i> Edit
						</a>
						<a href="<?php echo base_url('admin_information/Page/delete_page/'.$pag['id']);?>" class="btn btn-danger btn-sm btn-icon icon-left">
							<i class="entypo-cancel" onclick="myFunction()"></i> Delete
					 	</a>
					</td>
				</tr>
				<?php $sr++; ?>
			<?php } ?>
		</tbody>
	</table>
	<script>
    	function myFunction() {}
    </script>

     
