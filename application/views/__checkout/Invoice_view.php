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
                                <img src="<?php echo base_url('assets/img/logo.png');?>" style="width:100%; max-width:300px;">
                            </td>
                            
                            <td>
                                Invoice #: <?php echo $email_data[0]['booking_no'];?><br>
                                Created: <?php echo $email_data[0]['booking_date'];?><br>
                                
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
                                <?php echo ucfirst($email_data[0]['firstname'])." ".$email_data[0]['lastname'];?><br>
                                <?php echo $email_data[0]['email'];?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            
            <!--<tr class="heading">
                <td>
                    Payment Method
                </td>
                
                <td>
                    Check #
                </td>
            </tr>
            
            <tr class="details">
                <td>
                    Check
                </td>
                
                <td>
                    1000
                </td>
            </tr>-->
            <tr class="top">
                <td colspan="2">
            <table>
            
            <tr class="heading">
                <td>
                    Tour Name
                </td>
                 <td>
                    Tour Start Date
                </td>
				 <td>
                    Departure Date
                </td>
				<td>
                   Location
                </td>
				<td>
                   Pickup Time
                </td>
                
            </tr>
            <?php for($i=0; $i<count($email_data); $i++){?>
            <tr class="item">
               <td>
                    <?php echo $email_data[$i]['tour_title'];?>
                </td>
                
                <td>
                   <?php echo d_to_lu($email_data[$i]['tour_start_date']);?>
                </td>
				 <td>
                   <?php echo d_to_lu($email_data[$i]['tour_end_date']);?>
                </td>
				 <td>
                   <?php echo $email_data[$i]['country'];?>
                </td>
				<td>
                 <?php echo $email_data[$i]['pickup_time'];?>
                </td>
            </tr>
			<?php $total = $email_data[$i]['booking_amount_paid'];$total = $total+$total;}?>
			</table>
			</td>
			</tr>
			
            <!--
            <tr class="item last">
               
                
               
            </tr>
			<tr class="item last">
                
                
               
            </tr> 
			<tr class="item last">
                <td>
                   City
                </td>
                
                <td>
                   <?php echo $email_data[0]['city'];?>
                </td>
            </tr>
			<tr class="item last">
                
                
                
            </tr>-->
            
            <tr class="total">
                <td>Total</td>
                
                <td>
                   $<?php echo $total;?>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
