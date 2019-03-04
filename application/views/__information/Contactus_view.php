
   <!doctype html>
   <html>

             <h1><center>Contact Us Page</center></h1>
			 
			 
          <div class="container">
              <?php echo form_open(); ?>
			
		 <div class="form-group">
			  <label>Name</label>
			  <input type="text" name="name" id="name" placeholder="Name" class="form-control" />
	    </div>
	   <div class="form-group">
		    <label>Email</label>
		    <input type="email" name="email" id="email" placeholder="Email" class="form-control" />
	  </div>
	   <div class="form-group">
		    <label>Phone No.</label>
		     <input type="text" name="Phone" id="phone" placeholder="Phone Number" class="form-control"  />
     </div>
	
	
	  
	 <div class="form-group">
				<label>Address</label>
				<input type="text" name="address" placeholder="Address" class="form-control" />
	</div>
	
	<div class="form-group">
				<label>Comment</label>
				<textarea placeholder="Comment" name="comment" class="form-control" ></textarea>
	</div>

	<div class="btn-group">
			  <input type="submit" name="sub" value="Submit" class="btn btn-primary">
	</div>
					<?php echo form_close()?>

   </div>
   </html>
	

