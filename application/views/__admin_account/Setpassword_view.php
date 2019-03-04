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
        				<?php echo $user_mail; ?>
        			</h3>
        			<p>Create your password.</p>
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
                    
                    echo form_open('admin/account/confirmation/set_password?token=' . $token, $attributes); 
                ?>
					<div class="form-group">
                		<div class="input-group">
                			<div class="input-group-addon">
                                <i class="entypo-lock"></i>
                            </div>
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
                       	</div>	
          			</div>
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
          				
          			<div class="form-group">
                		<div class="input-group">
                			<div class="input-group-addon">
                                <i class="entypo-lock"></i>
                            </div>
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
          			</div>	 
      				<div class="form-group">
                    	<button type="submit" class="btn btn-primary btn-block btn-login">
                        	<i class="entypo-login"></i> Save
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