<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
            <!-- logo -->
			<div class="logo">
				<a href="<?php echo base_url(); ?>">
					<?php 
                        $image_properties = array(
                            'src' => 'assets/vendor/logo/sunshine_great_logo.png',
                            'width' => '120',
                            'alt' => 'Sunshine'
                        );
                        
                        echo img($image_properties);
                    ?>
				</a>
			</div>
			
			<!-- logo collapse icon -->
			<div class="sidebar-collapse">
				<?php 
				    $attribute = array(
				        'class' => 'sidebar-collapse-icon with-animation',
				        'title' => 'Menu'
				    );
				
				    echo anchor('#', '<i class="entypo-menu"></i>', $attribute);
				?>
			</div>
								
			<!-- open/close menu icon (do not remove if you want to enable menu on mobile devices) -->
			<div class="sidebar-mobile-menu visible-xs">
				<a href="#" class="with-animation"><!-- add class "with-animation" to support animation -->
					<i class="entypo-menu"></i>
				</a>
			</div>
		</header>
									
		<ul id="main-menu" class="main-menu">
		    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
			<!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
			
			<li class="">
				<a href="<?php echo base_url('vendor/home/dashboard'); ?>">
					<i class="entypo-gauge"></i>
					<span class="title">Dashboard</span>
				</a>

			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-book"></i>
					<span class="title">Bookings</span>
				</a>
				<ul>
					<?php 
					   $business_types = explode(',', $business_type);
					?>
					
					<?php if(in_array('Tourism', $business_types)) { ?>
    					<li>
    						<a href="<?php echo base_url('vendor/booking/tour-bookings'); ?>">
    							<span class="title">Tour Bookings</span>
    						</a>
    					</li>
    				<?php } ?>	
    				<?php if(in_array('Transportation', $business_types)) { ?>
    					<li>
    						<a href="<?php echo base_url('vendor/booking/transportation-bookings'); ?>">
    							<span class="title">Transportation Bookings</span>
    						</a>
    					</li>
					<?php } ?>	
    				<?php if(in_array('Golf Course', $business_types)) { ?>
    					<li>
    						<a href="<?php echo base_url('vendor/booking/golf-bookings'); ?>">
    							<span class="title">Golf Bookings</span>
    						</a>
    					</li>
    				<?php } ?>	
    				<?php if(in_array('Restaurant', $business_types)) { ?>	
    					<li>
    						<a href="<?php echo base_url('vendor/booking/restaurant-bookings'); ?>">
    							<span class="title">Restaurants Bookings</span>
    						</a>
    					</li>
    				<?php } ?>	
					<?php if(in_array('Club and Bar', $business_types)) { ?>	
    					<li>
    						<a href="<?php echo base_url('vendor/booking/club-and-bar-bookings'); ?>">
    							<span class="title">Clubs &amp; Bars Bookings</span>
    						</a>
    					</li>
    				<?php } ?>
    				<?php //if(in_array('Wedding Plan', $business_types)) { ?>	
    					<!-- 
    					<li>
    						<a href="<?php echo base_url('vendor/booking/wedding-bookings'); ?>">
    							<span class="title">Wedding Bookings</span>
    						</a>
    					</li>
    					 -->
    				<?php //} ?>		
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-user"></i>
					<span class="title">My Account</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('vendor/account/manage'); ?>">
							<span class="title">Manage Profile</span>
						</a>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>