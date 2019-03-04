<div class="container">
	<?php if($this->session->flashdata('msg-success') != "") { ?>
		<div class="col-md-12">
			<div class="alert alert-success">
				<?php echo $this->session->flashdata('msg-success'); ?>
			</div>
		</div>
 	<?php } ?> 
 
    <!-- BEGIN SIGNIN SECTION-->
    <img data-wow-duration="0.5s" data-wow-delay="0.5s" src="<?php echo base_url('assets/admin/logo/sunshine_great_logo.png'); ?>" class="wow fadeIn center-block" style=" height:60px; margin-top:100px; margin-bottom:20px" alt="" />
    
    <?php 
        $attributes = array(
            'class' => 'logpanel form-signin form-horizontal wow fadeIn animated', 
            'role'=> 'form',
            'data-wow-duration' => '1s', 
            'data-wow-delay' => '1s'
        );
        
        echo form_open('admin/default/login/login', $attributes); 
    ?>
		<div>
        	<h2 class="form-heading text-center">Login Panel</h2>
			<?php 
                $attributes = array(
                    'name'=> 'email',
                    'placeholder' => 'Email',
                    'required' => '',
                    'autofocus' => '',
                    'class' => 'form-control',
                    'type' => 'text'
                );
        	   
        	   echo form_input($attributes); 
        	?>
			<?php 
                $attributes = array(
                    'name'=> 'password',
                    'placeholder' => 'Password',
                    'required' => '',
                    'class' => 'form-control', 
                    'type' => 'password'
                );
                
                echo form_input($attributes); 
            ?>
        	<div class="row form-group">
          		<div class="col-xs-6">
            		<label class="checkbox">
            			<input type="checkbox" name="remember" value="remember-me"> Remember me
            		</label>
          		</div>
          		<div class="col-xs-6">
            		<div class="forget-password">
              			Forgot password?
              			<div class="clearfix"></div>
              			<a id="link-forgot" href="#"> <strong>Click Here</strong></a>
            		</div>
          		</div>
        	</div>
      	</div>
      	<div class="resultlogin">
      		<?php echo $this->session->flashdata('error_msg'); ?>
      	</div>
      	<button data-wow-duration="2s" data-wow-delay="s" type="submit" class="btn-lg btn btn-primary btn-block ladda-button fadeIn animated" data-style="zoom-in">Login</button>
    <?php echo form_close(); ?>
    <!-- END SIGNIN SECTION-->
    
    <!-- BEGIN SIGNUP SECTION-->
    
    <!-- BEGIN FORGOT PASSWORD SECTION-->
	<form role="form" class="logpanel form-forgot form-horizontal wow flipInY animated" style="display: none"  id="passresetfrm" onsubmit="return false;">
		<h2 class="form-heading text-center"> Forgot Password</h2>
      	<div class="resultreset"></div>
      	<div style="font-size: 12px;" class="text-center">Enter your email address to reset your password</div>
      	<br>
      	<div class="input-group">
        	<span class="input-group-addon"><i class="fa fa-envelope"></i>
        	</span>
        	<input type="email" id="resetemail" name="email" placeholder="Email" class="form-control">
      	</div>
      	<br>
      	<div class="form-actions">
        	<button type="button" class="btn btn-primary btn-back"><i class="fa fa-angle-left"></i>&nbsp;Back</button>
        	<button id="btn-forgot" type="button" class="btn btn-success pull-right resetbtn ladda-button">Reset My Password</button>
      	</div>
	</form>
    
    <!-- END FORGOT PASSWORD SECTION-->
    
    <p data-wow-duration="2s" data-wow-delay="2s" class="text-center wow fadeInDown" style="color:#f4f4f4"> Powered by  <a target="_blank" style="color: #FCFCFC" href=" <?php echo prep_url('www.ethanetechnologies.com'); ?>"><b>Ethane Web Technologies</b></a></p>
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