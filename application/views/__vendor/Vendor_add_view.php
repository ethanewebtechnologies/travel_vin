			
<h2><?php echo $text_h3_add_heading; ?></h2>
<br />


<div class="row">
	<div class="col-md-12">
		
		<div class="panel panel-primary" data-collapsed="0">
		
			<div class="panel-heading">
				<div class="panel-title">
					Default Form Inputs
				</div>
				
				<div class="panel-options">
					<a href="#sample-modal" data-toggle="modal" data-target="#sample-modal-dialog-1" class="bg"><i class="entypo-cog"></i></a>
					<a href="#" data-rel="collapse"><i class="entypo-down-open"></i></a>
					<a href="#" data-rel="reload"><i class="entypo-arrows-ccw"></i></a>
					<a href="#" data-rel="close"><i class="entypo-cancel"></i></a>
				</div>
			</div>
			
			<div class="panel-body">
	<?php echo form_open(); ?>

			<div class="col-md-12">
                <?php echo form_label($text_add_ufname , 'fname');
                
                $attributes = array(
                    'name' => 'fname',
                    'placeholder' => $text_add_puname,
                    'class' => 'form-control'
					
                ); 
				echo form_input($attributes);
				?>
				
			</div>
			<div class="clear"></div>
			
			<br />	
            <div class="col-md-12">    
            <?php 
                echo form_label($text_add_ulname , 'lname');
                
                $attributes = array(
                    'name' => 'lname',
                    'placeholder' => $text_add_plname,
                    'class' => 'form-control'
                ); 
				echo form_input($attributes);	
				?>
 			</div>
			<div class="clear"></div>
			
			<br />  
			<div class="col-md-12">  			
                <?php 			
				 echo form_label($text_add_uemail, 'email');
                
                $attributes = array(
                    'name' => 'email',
                    'type' => 'email',
                    'placeholder' => $text_add_pemail,
                    'class' => 'form-control'
                ); 
				echo form_input($attributes);
				?>
 			</div>
			<div class="clear"></div>
			
			<br /> 
			<!--<div class="col-md-12"> 			
                <?php
                echo form_label($text_add_upwd, 'pwd');
                
                $attributes = array(
                   'name' => 'pwd',
                   'type' => 'password',
                   'placeholder' => $text_add_ppwd,
                   'class' => 'form-control'
                );
				echo form_input($attributes);
			?>
  			</div>
			<div class="clear"></div>
			
			<br /> 
			<div class="col-md-12"> 			
            <?php 
			echo form_label($text_add_ucpwd, 'cpwd');
                
                $attributes = array(
                   'name' => 'cpwd',
                   'type' => 'password',
                   'placeholder' => $text_add_pcpwd,
                   'class' => 'form-control'
                );
				echo form_input($attributes);
            ?>
  			</div>
			<div class="clear"></div>
			
			<br /> -->
			<div class="col-md-6"> 
            <?php 
				echo form_label($text_status, 'status');
				$options = array(
					'1'         => 'Enable',
					'0'         => 'Disabled'
				);
				$data = array(
				   'name' => 'status',
				   'id'   => 'status',
				   'class' => 'form-control'
				);
		
				echo form_dropdown('status',$options,'0',$data); 
			?>
  			</div>
			<div class="clear"></div>
			
			<br /> 			
	   
	   <div class="col-md-6"> 
	    <?php
		   $data = array(
			'name'          => 'submit',
			'id'            => 'submit',
			'value'         => $text_submit,
			'type'          => 'submit',
			'content'       => $text_submit ,
			'class'         => 'btn btn-success'
			);

		  echo form_button($data);
		?>
		</div>
		<div class="clear"></div>   
		<?php echo form_close(); ?>
   
   </div>
 </div>
 
 </div>
 </div>
