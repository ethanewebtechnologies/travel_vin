<div class="container">
    <!-- BEGIN SIGNIN SECTION-->
    <img data-wow-duration="0.5s" data-wow-delay="0.5s" src="<?php echo base_url('assets/admin/img/admin.png'); ?>" class="wow fadeIn center-block" style="width:78px; height:60px; margin-top:100px; margin-bottom:20px" alt="" />
    
    <?php 
        $attributes = array(
            'class' => 'logpanel form-signin form-horizontal wow fadeIn animated', 
            'role'=> 'form',
            'data-wow-duration' => '1s', 
            'data-wow-delay' => '1s'
        );
        
        echo form_open('admin/default/login/setpass?token='.$token, $attributes); 
    ?>
		<div>
        	<h2 class="form-heading text-center"><?php echo $user_mail; ?></h2>
			<?php 
                $attributes = array(
                    'name'=> 'password',
                    'placeholder' => 'Password',
                    'required' => '',
                    'autofocus' => '',
                    'class' => 'form-control',
                    'type' => 'password'
                );
        	   
        	   echo form_input($attributes); 
        	?>
			<?php 
                $attributes = array(
                    'name'=> 'userid',
                    'type' => 'hidden',
					'value' => $uid
                );
                
                echo form_input($attributes); 
            ?>
			<?php 
                $attributes = array(
                    'name'=> 'usermail',
                    'type' => 'hidden',
					'value' => $user_mail
                );
                
                echo form_input($attributes); 
            ?>				
			<?php 
                $attributes = array(
                    'name'=> 'cpassword',
                    'placeholder' => 'Confirm Password',
                    'required' => '',
                    'class' => 'form-control', 
                    'type' => 'password'
                );
                
                echo form_input($attributes); 
            ?>

      	</div>
      	<div class="resultlogin">
      		<?php echo $this->session->flashdata('error_msg'); ?>
      	</div>
      	<button data-wow-duration="2s" data-wow-delay="s" type="submit" class="btn-lg btn btn-primary btn-block ladda-button fadeIn animated" data-style="zoom-in">Set Now</button>
    <?php echo form_close(); ?>
    <!-- END SIGNIN SECTION-->

    
    <p data-wow-duration="2s" data-wow-delay="2s" class="text-center wow fadeInDown" style="color:#f4f4f4"> Powered by  <a target="_blank" style="color: #FCFCFC" href=" <?php echo prep_url('www.ethanetechnologies.com'); ?>"><b>Ethane Web Technologies</b></a></p>
</div>


<!-- WOWJs -->