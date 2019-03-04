<div class="sidebar-menu">
	<div class="sidebar-menu-inner">
		<header class="logo-env">
            <!-- logo -->
			<div class="logo">
				<a href="<?php echo base_url('admin'); ?>">
					<img src="<?php echo base_url('assets/admin/logo/sunshine_great_logo.png'); ?>" width="120" alt="" />
				</a>
			</div>
			
			<!-- logo collapse icon -->
			<div class="sidebar-collapse">
				<a href="#" class="sidebar-collapse-icon"><!-- add class "with-animation" if you want sidebar to have animation during expanding/collapsing transition -->
					<i class="entypo-menu"></i>
				</a>
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
				<a href="<?php echo base_url('admin/default/dashboard'); ?>">
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
					<li>
						<a href="<?php echo base_url('admin/booking/tour-bookings'); ?>">
							<span class="title">Tour Bookings</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/booking/transportation-bookings'); ?>">
							<span class="title">Transportation Bookings</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/booking/golf-bookings'); ?>">
							<span class="title">Golf Bookings</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/booking/restaurant-bookings'); ?>">
							<span class="title">Restaurants Bookings</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/booking/club-and-bar-bookings'); ?>">
							<span class="title">Clubs &amp; Bars Bookings</span>
						</a>
					</li>
					<!-- 
					<li>
						<a href="<?php echo base_url('admin/booking/wedding-bookings'); ?>">
							<span class="title">Wedding Bookings</span>
						</a>
					</li>
					 -->
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-megaphone"></i>
					<span class="title">Marketing</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/marketing/coupon'); ?>">
							<span class="title">Coupon</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/marketing/subscriber'); ?>">
							<span class="title">Subscriber</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-book-open"></i>
					<span class="title">Catalog</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/catalog/information'); ?>">
							<span class="title">Informations</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/tour-category'); ?>">
							<span class="title">Tour Categories</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/tour'); ?>">
							<span class="title">Tours (Basic/Deals/Elite)</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/transportation'); ?>">
							<span class="title">Transportations</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/golf'); ?>">
							<span class="title">Golfs</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/club-and-bar'); ?>">
							<span class="title">Clubs &amp; Bars</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/restaurant'); ?>">
							<span class="title">Restaurants</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/catalog/wedding'); ?>">
							<span class="title">Weddings</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-list"></i>
					<span class="title">Listings</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/listing/main-country'); ?>">
							<span class="title">Country</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/listing/main-city'); ?>">
							<span class="title">City</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/listing/main-hotel'); ?>">
							<span class="title">Hotels</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/listing/main-airport'); ?>">
							<span class="title">Airports</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-user"></i>
					<span class="title">Customers</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/customer/customer'); ?>">
							<span class="title">Customer</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/customer/customer-type'); ?>">
							<span class="title">Customer Types</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-suitcase"></i>
					<span class="title">Parks</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/agent/accounts'); ?>">
							<span class="title">Park List</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/agent/invoice-request'); ?>">
							<span class="title">Tour Invoice Request</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/agent/transportation-invoice-request'); ?>">
							<span class="title">Transportation Invoice Request</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/agent/golf-invoice-request'); ?>">
							<span class="title">Golf Invoice Request</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/agent/restaurant-invoice-request'); ?>">
							<span class="title">Restaurant Invoice Request</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/agent/club-and-bar-invoice-request'); ?>">
							<span class="title">Club & Bar Invoice Request</span>
						</a>
					</li>
				</ul>
			</li>
			<li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-bag"></i>
					<span class="title">Extra</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/information/page'); ?>">
							<span class="title">Pages</span>
						</a>
					</li>
				</ul>
			</li>
			 <li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-cog"></i>
					<span class="title">Settings</span>
				</a>
				<ul>
					<li class="has-sub">
						<a href="<?php echo base_url('admin/settings/general'); ?>">
							<span class="title">General</span>
						</a>
						<ul>
        					<li>
        						<a href="<?php echo base_url('admin/settings/home-page'); ?>">
        							<span class="title">Home Page</span>
        						</a>
        					</li>
        					<li>
        						<a href="<?php echo base_url('admin/settings/tour-page'); ?>">
        							<span class="title">Tour Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/deals-page'); ?>">
        							<span class="title">Deals Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/elite-page'); ?>">
        							<span class="title">Elite Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/golf-page'); ?>">
        							<span class="title">Golf Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/restaurant-page'); ?>">
        							<span class="title">Restaurant Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/club-and-bar-page'); ?>">
        							<span class="title">Club And Bar Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/transportation-page'); ?>">
        							<span class="title">Transportation Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/wedding-page'); ?>">
        							<span class="title">Wedding Page</span>
        						</a>
        					</li>
							<li>
        						<a href="<?php echo base_url('admin/settings/header-page'); ?>">
        							<span class="title">Header</span>
        						</a>
        					</li>
        					<li>
        						<a href="<?php echo base_url('admin/settings/footer-page'); ?>">
        							<span class="title">Footer</span>
        						</a>
        					</li>
        				</ul>	
					</li>
					<li>
						<a href="<?php echo base_url('admin/settings/banner'); ?>">
							<span class="title">Banners</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/settings/language'); ?>">
							<span class="title">Languages</span>
						</a>
					</li>
					<!--
					   <li>
						<a href="<?php echo base_url('admin/settings/file-manager'); ?>">
							<span class="title">File Manager</span>
						</a>
					</li> 
					 -->
					<li>
						<a href="<?php echo base_url('admin/settings/restricted-zone'); ?>">
							<span class="title">Restricted Zones</span>
						</a>
					</li>
				</ul>
			</li>
			 <li class="has-sub">
				<a href="javascript:void(0);">
					<i class="entypo-lock"></i>
					<span class="title">Accounts</span>
				</a>
				<ul>
					<li>
						<a href="<?php echo base_url('admin/users/users'); ?>">
							<span class="title">Users</span>
						</a>
					</li>
					<li>
						<a href="<?php echo base_url('admin/users/user-group'); ?>">
							<span class="title">User Groups</span>
						</a>
					</li>	
				</ul>
			</li>			
		</ul>
	</div>
</div>

<div class="main-content">
	<div class="row">
		<!-- Profile Info and Notifications -->
		<div class="col-md-6 col-sm-8 clearfix">
			<ul class="user-info pull-left pull-none-xsm">
				<!-- Profile Info -->
				<li class="profile-info dropdown"><!-- add class "pull-right" if you want to place this from right -->
					<a href="#" class="dropdown-toggle" data-toggle="dropdown">
						<img src="<?php echo base_url(); ?>" alt="" class="img-circle" width="44" />
						
						<?php 
						    $user = $this->session->userdata('user'); 
						    echo $user['firstname'] . ' ' . $user['lastname'];
						?>
					</a>
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
					<a href="<?php echo base_url('admin/account/logout'); ?>">
						Log Out <i class="entypo-logout right"></i>
					</a>
				</li>
			</ul>
		</div>
	</div>
	<hr>
	<!-- End of Row -->
	<?php 
    	$class_name = $this->router->class;
    	$class_name = ucfirst(str_replace('_', ' ', str_replace('_ctrl', '', $class_name)));
    	
    	$method_name = $this->router->method;
    	$method_name = ucfirst(str_replace('_', ' ', str_replace('_ctrl', '', $method_name)));
	
        $bread = array(
           base_url($this->uri->segment(1)) => 'Home',
            base_url($this->uri->segment(1) . '/' . $this->uri->segment(2).'/'.$this->uri->segment(3)) => $class_name
        );
        
        if($method_name != 'Index') {
            $bread[base_url($this->uri->segment(1) . '/' . $this->uri->segment(2).'/'.$this->uri->segment(3).'/'.$this->uri->segment(4)) .'?' .$_SERVER['QUERY_STRING']] = $method_name;
        }
	   
        echo breadcrumb($bread);
	?>
	<hr>

<?php if($this->session->flashdata('msg-error') != "") { ?>
    <div class="col-md-12">
    	<div class="alert alert-danger"><?php echo $this->session->flashdata('msg-error'); ?></div>
    </div>
<?php } ?>


<?php if($this->session->flashdata('msg-success') != "") { ?>
    <div class="col-md-12">
    	<div class="alert alert-success"><?php echo $this->session->flashdata('msg-success'); ?></div>
    </div>
<?php } ?> 
