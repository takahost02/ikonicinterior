<?php if(!empty($customer)): ?>
<div class="d-flex gap-2 align-items-start">
    <div class="row row-gap-1 flex-1">
        <div class="col-lg-6 col-12">
            <h5><?php echo e(__('Bill to')); ?></h5>
            <div class="bill-to">
                <?php if(!empty($customer['billing_name'])): ?>
                        <span><?php echo e($customer['billing_name']); ?></span><br>
                        <span><?php echo e($customer['billing_phone']); ?></span><br>
                        <span><?php echo e($customer['billing_address']); ?></span><br>
                        <span><?php echo e($customer['billing_city'] . ' , '.$customer['billing_state'].' , '.$customer['billing_country'].'.'); ?></span><br>
                        <span><?php echo e($customer['billing_zip']); ?></span>
                <?php else: ?>
                    <br> -
                <?php endif; ?>
            </div>
        </div>
        <div class="col-lg-6 col-12">
            <h5><?php echo e(__('Ship to')); ?></h5>
            <div class="bill-to">
                <?php if(!empty($customer['shipping_name'])): ?>
                        <span><?php echo e($customer['shipping_name']); ?></span><br>
                        <span><?php echo e($customer['shipping_phone']); ?></span><br>
                        <span><?php echo e($customer['shipping_address']); ?></span><br>
                        <span><?php echo e($customer['shipping_city'] . ' , '.$customer['shipping_state'].' , '.$customer['shipping_country'].'.'); ?></span><br>
                        <span><?php echo e($customer['shipping_zip']); ?></span>
                <?php else: ?>
                    <br> -
                <?php endif; ?>
            </div>
        </div>
    </div>
    <a href="#" id="remove" class="text-sm"><?php echo e(__(' Remove')); ?></a>
</div>
<?php endif; ?>
<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/proposal/customer_detail.blade.php ENDPATH**/ ?>