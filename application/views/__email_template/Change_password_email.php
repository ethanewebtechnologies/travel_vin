<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Reset Password</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
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
                            <p style="margin:15px 0; padding: 0 0 60px 0;margin: 10px 0;"><span style="display: inline-block;float: left;margin-top: 20px;    font-size: 18px;">Hey <?php echo $customer_name; ?>,</span> </p>

                            <p style="margin:15px 0; font-family: 14px;color:green;"> Please click on the below link to reset your password. <a href="<?php echo base_url('admin/account/recovery/reset-password?token=' . $access_token); ?>">Click Here</a> </p>


                            <p style="margin:15px 0; font-family: 14px;"> </p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;font-family: arial;font-size: 14px;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="padding: 10px;border-left: 1px solid #ddd;border-right: 1px solid #ddd;">
                            <p style="margin:15px 0; font-size: 16px;margin-bottom: 0;">Thank You, </p>
                            <p style="margin:15px 0; font-size: 16px;margin-top: 6px;">Admin (Sunshine Hospitality Partners)</p>
                        </td>
                    </tr>
                </tbody>
            </table>
            <table style="width: 100%;border-top: 0;font-family: arial;font-size: 14px;background: #212121;" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="color: #ddd;"><p style="margin:15px 0; text-align: center;font-size: 12px;">© 2017 Sunshine Hospitality Partners - Powered by <a style="color: #d38235;text-decoration: none;" href="http://www.ethanetechnologies.com/" target="_blank">Ethane Web Technologies</a></p></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
</html>