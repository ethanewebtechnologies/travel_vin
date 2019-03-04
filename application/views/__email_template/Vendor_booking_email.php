<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title><?php echo $text_mail_invoice;?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<style>
			.pro_mail_dtl_tbl{
				width: 100%;
				padding: 20px 0;
			}
			.pro_mail_dtl_tbl td{
				padding: 10px;
				text-align: center;
				border: 1px solid #ddd;
			}
			table tr.heading td {
				background: #eee;
				border-bottom: 1px solid #ddd;
				font-weight: bold;
			}
		</style>
    </head>
    <body>
        <div style="width: 800px;margin: 0 auto;font-family: arial;font-size: 14px;">
            <table style="width: 100%;border-top: 0;font-family: arial;font-size: 14px;background: #212121;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td></td>
                        <td style="text-align: center;padding: 10px;">
                            <img src="<?php echo base_url(); ?>assets/admin/logo/sunshine_great_logo.png" alt="">
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;border-top: 0;font-family: arial;font-size: 14px;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="padding: 0 10px;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                            <p style="margin:15px 0; padding: 0 0 60px 0;margin: 10px 0;"><span style="display: inline-block;float: left;margin-top: 20px;    font-size: 18px;"><?php echo $text_greeting_vendor;?>,</span> </p>

                            <p style="margin:15px 0; font-family: 14px;color:green;"> <?php echo $text_admin_booking_message; ?> </p>
							<p style="margin:15px 0; font-family: 14px;color:green;"> <?php echo $item_booking_number; ?> (<?php echo strtoupper($item_booking_type); ?>) </p>
                        </td>
                    </tr>
					<tr class="top">
						<td colspan="2">
							<table class="pro_mail_dtl_tbl">
								<tr class="heading">
									<td>
										<?php echo $text_invoice ;?> <?php echo $invoicedata[0]['bookingdata']['customer_invoice_no']; ?><br>
										<?php echo $text_created; ?> <?php echo date('d-m-y'); ?><br>
									</td>
								</tr>	
								<tr>
									<td>
										<?php echo ucfirst($invoicedata[0]['customerdata'][0]['firstname']) . " " . $invoicedata[0]['customerdata'][0]['lastname']; ?><br>
										<?php echo $invoicedata[0]['customerdata'][0]['email'];?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
                </tbody>
            </table>
            <table style="width: 100%;border-top: 0;font-family: arial;font-size: 14px;background: #212121;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="color: #ddd;"><p style="margin:15px 0; text-align: center;font-size: 12px;">© 2017 <?php echo $text_email_poweredby;?> <a style="color: #d38235;text-decoration: none;" href="http://www.ethanetechnologies.com/" target="_blank">Ethane Web Technologies</a></p></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>