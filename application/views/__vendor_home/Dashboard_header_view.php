<div class="main-content">
	<div class="row">
        <!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<ul class="user-info pull-left pull-none-xsm">
				<!-- Profile Info -->
				<li class="profile-info dropdown">
				    <!-- add class "pull-right" if you want to place this from right -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<td>
    						<?php if(!empty($_session_vendor['admin_image']) && is_file($_session_vendor['admin_image'])) { ?>
								<?php 
							       $optimized = new Optimized();
							       echo $optimized->resize($_session_vendor['admin_image'], 44, 44, array('class'=>'img-circle'), 'resize_crop');
							   ?>
							<?php } else { ?>
    							<?php 
                                    $optimized = new Optimized();
                                    echo $optimized->resize('content/image/main/empty/empty.jpg', 44, 44, array('class'=>'img-circle'), 'resize_crop'); 
    							 ?>
							<?php } ?>
						</td>
						
						<?php echo $_session_vendor['admin_fullname']; ?>
						
						<span class="caret"></span>
					</a>
		
					<ul class="dropdown-menu">
						<!-- Reverse Caret -->
						<li class="caret"></li>
						<!-- Profile sub-links -->
						<li>
							<a href="<?php echo base_url('vendor/account/manage/edit?secure_token=' . $this->security_lib->encrypt($_session_vendor['id'])); ?>">
								<i class="entypo-user"></i>
								Edit Profile
							</a>
						</li>
					</ul>
				</li>
			</ul>
			<!-- missing code is save in missing file -->
		</div>
		
		<!-- Raw Links -->
		<div class="col-md-6 col-sm-4 clearfix hidden-xs">
			<ul class="list-inline pull-right">
				<!-- Language Selector -->
				<!-- <li class="dropdown language-selector">
					Language: &nbsp;
					<a href="#" class="dropdown-toggle" data-toggle="dropdown" data-close-others="true">
						<img src="<?php echo $default_language['image']; ?>" alt="<?php echo ucfirst($default_language['code']); ?>" width="16" height="16" />
						<span><?php echo $default_language['name']; ?></span>
					</a>
		
					<ul class="dropdown-menu pull-right">
						<?php foreach ($languages as $language) { ?>
							<li>
    							<a class="<?php echo $default_language['code'] == $language['code'] ? 'active' : ''; ?>" href="<?php echo base_url('translate/change_language?lang_code=' . $language['code'] . '&redirect_url=' . current_url()); ?>">
    								<span><?php echo $language['name']; ?></span>
    								<img src="<?php echo $language['image']; ?>" alt="<?php echo ucfirst($language['code']); ?>" width="16" height="16" />
    							</a>
							</li>
						<?php } ?>
					</ul>
				</li> -->
				
				<!-- <li class="sep"></li> -->
				<!-- <li>
					<a href="#" data-toggle="chat" data-collapse-sidebar="1">
						<i class="entypo-chat"></i>
						Chat
						<span class="badge badge-success chat-notifications-badge is-hidden">0</span>
					</a>
				</li> -->
				<li class="sep"></li>
				<li>
					<a href="<?php echo base_url('vendor/account/logout'); ?>">
						Log Out <i class="entypo-logout right"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
	
	<hr>
	
	<!-- End of Row -->
	<?php echo $breadcrumb; ?>
	
	<hr>

    <?php if($error_flash_messages) { ?>
    	<?php foreach ($error_flash_messages as $error_flash_message) { ?>
            <div class="col-md-12">
            	<div class="alert alert-danger alert-dismissable">
            		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            		<?php echo $error_flash_message['message']; ?>
            	</div>
            </div>
    	<?php } ?>
	<?php } ?>
    <?php if($success_flash_messages) { ?>
    	<?php foreach ($success_flash_messages as $success_flash_message) { ?>
            <div class="col-md-12">
            	<div class="alert alert-success alert-dismissable">
            		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            		<?php echo $success_flash_message['message']; ?>
            	</div>
            </div>
    	<?php } ?>
	<?php } ?>