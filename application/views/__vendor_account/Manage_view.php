<div class="row">
    <div class="col-md-12">
        <h2>
            Account Details
            <span class="pull-right btn-toolbar">
                <a class="btn btn-blue btn-icon icon-left" href="<?php echo base_url('vendor/account/manage/edit?secure_token=' . $this->security_lib->encrypt($vendor['id'])); ?>">
                    <i class="entypo-pencil"></i> Edit
                </a>
            </span>
        </h2>
        <div class="panel panel-primary">
            <div class="panel-body">
                <table class="table table-striped table-view">
                    <tbody>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Company Legal Name</b>
                            </td>
                            <td class="col-sm-9">
                                <?php echo $vendor['company_legal_name']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Company Logo</b>
                            </td>
                            <td class="col-sm-8">
                            	<?php if(!empty($vendor['company_logo']) && is_file($vendor['company_logo'])) { ?>
                            		<?php echo $optimized->resize($vendor['company_logo'], 150, 150, array(), 'resize_crop'); ?>
                            	<?php } else { ?>	
                            		<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 150, 150, array(), 'resize_crop'); ?>
                            	<?php } ?>	
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Company Email</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $vendor['email']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Company Contact No.</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $vendor['telephone']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Company Address</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo $vendor['address'] . ', ' . $vendor['city'] . ', ' . $vendor['state'] . ', ' . $vendor['country'] . ', ' . $vendor['postal']; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Business Type</b>
                            </td>
                            <td class="col-sm-8">
                            	<?php $business_types = explode(',', $vendor['business_type']); ?>
                            	<?php if(!empty($business_types)) { ?> 
                                	<?php foreach ($business_types as $business_type) { ?>
                                    	<small class="label label-primary"><?php echo html_entity_decode($business_type); ?></small>
                                    <?php } ?>
                                <?php } else { ?>
                                	<?php echo THREE_DASH; ?>
                                <?php }?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Admin Email</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['admin_email']) ? $vendor['admin_email'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Admin Contact</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['admin_contact']) ? $vendor['admin_contact'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Admin Name</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['admin_fullname']) ? $vendor['admin_fullname'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Admin Image</b>
                            </td>
                            <td class="col-sm-8">
                                <?php if(!empty($vendor['admin_image']) && is_file($vendor['admin_image'])) { ?>
                                	<?php echo $optimized->resize($vendor['admin_image'], 150, 150, array(), 'resize_crop'); ?>
                                <?php } else { ?>
                                	<?php echo $optimized->resize('content/image/main/empty/empty.jpg', 150, 150, array(), 'resize_crop'); ?>
                                <?php } ?>	
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>TAX ID</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['tax_id']) ? $vendor['tax_id'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Payment Details</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['payment_details']) ? $vendor['payment_details'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Payment Type</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['credit_debit_payal']) ? $vendor['credit_debit_payal'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Card Number</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['card_number']) ? $vendor['card_number'] : THREE_DASH; ?>
                            </td>
                        </tr>
                        <tr class="row">
                            <td class="col-sm-3 control-label">
                                <b>Expiry CVV</b>
                            </td>
                            <td class="col-sm-8">
                                <?php echo !empty($vendor['expiry_cvv']) ? $vendor['expiry_cvv'] : THREE_DASH; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>