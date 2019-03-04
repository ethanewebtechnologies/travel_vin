<div class="page-body login-page">
	<div class="login-container">
    	<div class="login-form">
        	<div class="login-header login-caret">
            	<div class="login-content">
                	<a href="<?php echo current_url(); ?>" class="logo">
                    	<img src="<?php echo base_url('assets/admin/logo/sunshine_great_logo.png'); ?>" height="60" alt="" />
                	</a>
                    
                    <!-- progress bar indicator -->
                	<div class="login-progressbar-indicator">
                    	<h3>43%</h3>
                    	<span>logging in...</span>
                	</div>
            	</div>
        	</div>
        	
        	<div class="login-progressbar">
            	<div></div>
        	</div>
        	
        	<div class="login-content">
        		<div class="form-login-info" style="display: block;">
            		<h3 class="form-heading text-center">
            			Your Account Email
            		</h3>
        			<p>Provide your email address and we'll send you a link to reset your password.</p>
 				</div>
        	
            	<?php if($this->session->flashdata('msg-success') != "") { ?>
            		<div class="form-login-info" style="display: block;">
                		<h3>Success</h3>
                		<p>
                			<?php echo $this->session->flashdata('msg-success'); ?>
                		</p>
            		</div>
    			<?php } ?> 

				<?php if($this->session->flashdata('error_msg')) { ?>
					<div class="form-login-error" style="display: block;">
                		<h3>Invalid login</h3>
                		<p>
                			<?php echo $this->session->flashdata('error_msg');  ?>
                		</p>
            		</div>
        		<?php } ?> 
        		
                <!-- BEGIN SIGNIN SECTION-->
                <?php 
                    $attributes = array(
                        'method'=> "post",
                        'role'=> "form",
                        'id'=> "form_login"
                    );
                    
                    echo form_open('admin/account/recovery', $attributes); 
                ?>
                	<div class="form-group">
                		<div class="input-group">
                			<div class="input-group-addon">
                                <i class="entypo-mail"></i>
                            </div>
                			<?php 
                                $attributes = array(
                                    'name' => 'email',
                                    'placeholder' => 'Email',
                                    'class' => 'form-control',
                                    'type' => 'email',
                                    'data-validation' => 'required email'
                                );
                        	   
                        	   echo form_input($attributes); 
                        	?>
                        </div>	
              		</div>
              		<div class="form-group">
                    	<button type="submit" class="btn btn-primary btn-block btn-login">
                        	<i class="entypo-login"></i> Recover Password
                    	</button>
                	</div>
    			<?php echo form_close(); ?>
                <!-- END SIGNIN SECTION-->
    
    			<div class="login-bottom-links">
                	<p data-wow-duration="2s" data-wow-delay="2s" class="text-center wow fadeInDown" style="color:#f4f4f4"> 
                		Powered by  <a target="_blank" style="color: #FCFCFC" href=" <?php echo prep_url('www.ethanetechnologies.com'); ?>"><b>Ethane Web Technologies</b></a>
                	</p>
            	</div>
        	</div>
    	</div>
	</div>
</div>

<script>
// Bind normal buttons
Ladda.bind( 'div:not(.progress-demo) button', { timeout: 2000 } );

// Bind progress buttons and simulate loading progress
Ladda.bind( '.progress-demo button', {
	callback: function( instance ) {
		var progress = 0;
		var interval = setInterval( function() {
			progress = Math.min( progress + Math.random() * 0.1, 1 );
			instance.setProgress( progress );
			if( progress === 1 ) {
				instance.stop();
				clearInterval( interval );
			}
		}, 200);
	}
});
</script>

<script src="<?php echo base_url('assets/admin/js/login.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/jquery.validate.min.js'); ?>"></script>
<script src="<?php echo base_url('assets/admin/neon-login.js'); ?>"></script>
<!-- icheck -->
<script src="<?php echo base_url('assets/admin/include/icheck/icheck.min.js'); ?>"></script>
<link href="<?php echo base_url('assets/admin/include/icheck/square/grey.css'); ?>" rel="stylesheet">

<script>
	var cb, optionSet1;

    $(".checkbox").iCheck({
    	checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
    });

    $(".radio").iCheck({
    	checkboxClass: "icheckbox_square-grey",
        radioClass: "iradio_square-grey"
    });
</script>


<!-- WOWJs -->
<script>
	new WOW().init();
</script>
<!-- WOWJs -->

<script type="text/javascript">
  // $('body').addClass('page-body login-page');
</script>