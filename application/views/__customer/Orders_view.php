<main>
	<section class="tourdescription_blk wow zoomIn" data-wow-duration="1s">
		<section class="container">
		    <div class="title_head"><?php echo $text_order_history;?></div>
			<div class="db_wrapper">
				<section class="row">
					<div class="col-sm-12 col-sm-offset-0">
						<div class="db_profile">
							<?php if(isset($customer_invoices) && !empty($customer_invoices)){?>
							<div class="tour_desc_wrap select_tour_wrap">
								<table>
									<thead>
										<tr>
											<th><?php echo $text_invoice_date;?></th>
											<th><?php echo $text_invoice_number;?></th>
											<th><?php echo $text_download;?></th>
										</tr>
									</thead>
									<tbody>
										<?php foreach($customer_invoices as $orders){?>
											<tr>
												<td><?php echo ucwords(str_replace('_',' ', d_to_lu($orders['date_generated'])));?></td>
												<td><?php echo $orders['invoice_no'];?></td>
												<td><a href="<?php echo base_url($orders['invoice_path']);?> " target="_blank"><?php echo $text_download_invoice;?></a></td>
											</tr>
										<?php }?>
									</tbody>
								</table>
									<div class="download_links">
								<div class="row">
									<!-- <div class="col">
										<div class="app_link_blk">
											<a href=""><img src="img/android.png" alt=""></a>
											<a href=""><img src="img/ios.png" alt=""></a>
										</div>
									</div> -->
									<div class="col">
										<div class="pagination_blk">
											<?php echo $pagination; ?>
										</div>
									</div>
								</div>
							</div>
							</div>
							<?php }else{?>
							<h5><?php echo $text_no_bookings;?></h5>
							<?php }?>
						</div>			
					</div>
				</section>				
			</div>
		</section>
	</section>
</main>