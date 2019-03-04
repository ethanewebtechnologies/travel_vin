<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>Sunshine Invoice</title>
    
    <style>
        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 30px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, .15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }
        
        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
        }
        
        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }
        
        .invoice-box table tr td:nth-child(2) {
            text-align: right;
        }
        
        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }
        
        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }
        
        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }
        
        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }
        
        .invoice-box table tr.item td{
            border-bottom: 1px solid #eee;
        }
        
        .invoice-box table tr.item.last td {
            border-bottom: none;
        }
        
        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }
        
        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }
            
            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }
        
        /** RTL **/
        .rtl {
            direction: rtl;
            font-family: Tahoma, 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
        }
        
        .rtl table {
            text-align: right;
        }
        
        .rtl table tr td:nth-child(2) {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="invoice-box">
        <table cellpadding="0" cellspacing="0">
            <tr class="top">
                <td colspan="2">
                    <table>
                        <tr>
                            <td class="title">
                                <img src="<?php echo base_url('assets/img/logo.png'); ?>" style="width: 100%; max-width:300px;">
                            </td>
                            
                            <td>
                            
                                Invoice #: <?php echo $invoice_no; ?><br>
                                Created: <?php echo $invoice_date; ?><br>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <tr class="information">
                <td colspan="2">
                    <table>
                        <tr>
                            <td>
                                Sunshine Hospitality Partners<br>
                                101 E. Chapman Ave<br>Orange, CA 92866<br>
                                (800) 555-1234
                            </td>
                            <td>
                                <?php echo ucfirst($vendor['company_legal_name']); ?><br>
                                <?php echo $vendor['email']; ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr class="top">
                <td colspan="2">
            		<table>
                        <tr class="heading">
                            <td>
                                Booking No.
                            </td>
                             <td>
                                Booking Date
                            </td>
            				<td>
                               Location
                            </td>
                            <td>
                              	Amount
            				</td>
                        </tr>
                        <?php foreach ($invoice_data as $data) { ?>
                            <tr class="item">
                               <td>
                                    <?php echo $data['booking_no']; ?>
                                </td>
                                <td>
            							<?php if($data['booking_date'] != '0000-00-00 00:00:00') { ?>
            								<?php echo d_to_lu($data['booking_date']); ?>
            							<?php } else { ?>	
            								<?php echo THREE_DASH; ?>
            							<?php } ?>
            						</td>
                			      <td>
                			       <?php echo isset($cities[$data['city_id']]) ? $cities[$data['city_id']] : THREE_DASH; ?>, 
                                        <?php echo isset($countries[$data['country_id']]) ? $countries[$data['country_id']] : THREE_DASH; ?>                                                                        
                                    </td>
                				<td>
                                 	<?php echo $data['agent_cost']; ?>
                                </td>
                            </tr>
            			<?php } ?>
            			<tr>
            				<td colspan="2"></td>
            				<td>Total</td>
            				<td><?php echo $grand_total; ?></td>
            			</tr>
            		</table>
            	</td>
            </tr>
        </table>
    </div>
</body>
</html>
