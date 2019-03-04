<main>
	<section class="content_area wow slideIn" data-wow-duration="1s">
		<section class="container-fluid">
			<section class="row">
				<div class="thankblk">
					<img src="<?php echo base_url('assets/img/tick.png'); ?>" alt=""/>
					<h2><?php echo $text_all_set;?></h2>
					<?php if(isset($order_booking_details) && $order_booking_details != '') { ?>
    					<?php foreach($order_booking_details as $booking_details) { ?>
							<span><?php echo $text_booking;?> #: <?php echo $booking_details['booking_no']; ?></span>
						<?php } ?>
					<?php } ?>	
					<h4><?php echo $text_being_awesome;?>,<br><?php echo $text_enjoy_purchase;?></h4>
					<a href="<?php echo base_url() . $pdf_path; ?>" target="_blank"><?php echo $text_download_invoice;?></a>
				</div>
			</section>
		</section>
	</section>
</main>