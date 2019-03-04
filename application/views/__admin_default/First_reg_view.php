  <div class="container">
    <!-- BEGIN SIGNIN SECTION-->
    <img data-wow-duration="0.5s" data-wow-delay="0.5s" src="<?php echo base_url('assets/admin/img/admin.png'); ?>" class="wow fadeIn center-block" style="width:78px;height:60px;margin-top:100px;margin-bottom:20px" alt="" />
    
    <?php 
    $attributes = array('class' => 'logpanel form-horizontal wow fadeIn animated', 'role'=> 'form' ,'data-wow-duration'=>'1s', 'data-wow-delay'=>'1s');
   echo form_open('admin_default/login/first_reg',$attributes); ?>
      <div>
        <h2 class="form-heading text-center">First Registration Panel</h2>
        <?php echo form_input(array('name'=> 'firstname','placeholder'=> 'First Name','required'=>'','autofocus'=>'','class'=>'form-control','type'=> 'text')); ?>	
        <?php echo form_input(array('name'=> 'lastname','placeholder'=> 'Last Name','required'=>'','autofocus'=>'','class'=>'form-control','type'=> 'text')); ?>	
	
        <?php echo form_input(array('name'=> 'email','placeholder'=> 'Email','required'=>'','autofocus'=>'','class'=>'form-control','type'=> 'text')); ?>
		<?php echo form_input(array('name'=> 'password','placeholder'=> 'Password','required'=>'','class'=>'form-control','type'=> 'password')); ?>
		<?php echo form_input(array('name'=> 'passconf','placeholder'=> 'Confirm Password','required'=>'','class'=>'form-control','type'=> 'password')); ?>

      </div>
      <div class="resultlogin"><?php echo validation_errors(); ?></div>
      <button data-wow-duration="2s" data-wow-delay="s" type="submit" class="btn-lg btn btn-primary" data-style="zoom-in">Submit</button>
    <?php echo form_close(); ?>
    <!-- END FORGOT PASSWORD SECTION-->
    <p data-wow-duration="2s" data-wow-delay="2s" class="text-center wow fadeInDown" style="color:#f4f4f4"> Powered by  <a target="_blank" style="color: #FCFCFC" href="http://www.ethanetechnologies.com/"><b>Ethane Web Technologies</b></a></p>
  </div>

  <!-- WOWJs -->