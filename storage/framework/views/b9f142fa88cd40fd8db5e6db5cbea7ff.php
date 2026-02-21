<?php
$SITE_RTL = !empty($settings['SITE_RTL'] ) ? $settings['SITE_RTL']  : 'off';

?>
<?php $__env->startPush('script-page'); ?>

<script>
    function closeScript() {
        setTimeout(function () {
            window.open(window.location, '_self').close();
        }, 1000);
    }

    $(window).on('load', function () {
        var element = document.getElementById('boxes');
        var opt = {
            filename: '<?php echo e(App\Models\Utility::contractNumberFormat($contract->id)); ?>',
            image: {type: 'jpeg', quality: 1},
            html2canvas: {scale: 4, dpi: 72, letterRendering: true},
            jsPDF: {unit: 'in', format: 'A4'}
        };

        html2pdf().set(opt).from(element).save().then(closeScript);
    });
</script>

<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Contract')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>


<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
<div class="mt-3">
    <div class="row justify-content-center mb-3">
        <div class="col-sm-9 text-end me-2">
            <div class="all-button-box ">
            <?php if(((\Auth::user()->type =='company') && ($contract->company_signature == '')||(\Auth::user()->type =='client') && ($contract->client_signature == ''))&&$contract->status == 'Start'): ?>
                    <a href="#" class="btn btn-sm btn-primary btn-icon m-" data-bs-toggle="modal"
                        data-bs-target="#exampleModal" data-size="md" data-url="<?php echo e(route('signature',$contract->id)); ?>"
                        data-bs-whatever="<?php echo e(__('signature')); ?>" > <span class="text-white"> <i
                                class="ti ti-pencil text-white" data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('signature')); ?>"></i></span></a>
                    </a>
                    <?php endif; ?>
                <a href="<?php echo e(route('contract.download.pdf',\Crypt::encrypt($contract->id))); ?>" class="btn btn-sm btn-primary btn-icon"  data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('Download')); ?>" target="_blanks">
                    <i class="ti ti-download"></i>
                </a>

            </div>
        </div>
    </div>


    <div class="row justify-content-center">
        <div class="row col-sm-9">
            <div class="card">
                <div class="card-body">
                    <div class="row invoice-title mt-2">
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 ">
                            <img  src="<?php echo e($img); ?>" style="max-width: 150px;"/>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-nd-6 col-lg-6 col-12 text-end">
                            <h3 class="invoice-number"><?php echo e(\Auth::user()->contractNumberFormat($contract->id)); ?></h3>
                        </div>
                    </div>
                    <div class="row align-items-center mb-4">
                        <div class="col-sm-6 mb-3 mb-sm-0 mt-3">
                            <div class="col-lg-12 col-md-8 mb-3">
                                <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Contract Type  :')); ?></h6>
                                <span class="col-md-8"><span class="text-md"><?php echo e($contract->types->name); ?></span></span>
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Contract Value   :')); ?></h6>
                                <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->priceFormat($contract->value)); ?></span></span>
                            </div>
                        </div>
                        <div class="col-sm-6 text-sm-end">
                            <div>
                                <div class="float-end">
                                    <div class="">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('Start Date  :')); ?></h6>
                                        <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->dateFormat($contract->start_date)); ?></span></span>
                                    </div>
                                    <div class="mt-3">
                                        <h6 class="d-inline-block m-0 d-print-none"><?php echo e(__('End Date   :')); ?></h6>
                                        <span class="col-md-8"><span class="text-md"><?php echo e(Auth::user()->dateFormat($contract->end_date)); ?></span></span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="text-md"><?php echo $contract->description; ?></div>
                    <br>
                    <div class="text-md"><?php echo $contract->contract_description; ?></div>
                    <div class="row">
                        <div class="col-6">
                            <div>
                                <img width="200px" src="<?php echo e($contract->company_signature); ?>" >
                            </div>
                            <div>
                                <h5 class="mt-auto"><?php echo e(__('Company Signature')); ?></h5>
                            </div>
                        </div>
                        <div class="col-6 text-end">
                            <div>
                                <img width="200px" src="<?php echo e($contract->client_signature); ?>" >
                            </div>
                            <div>
                                <h5 class="mt-auto"><?php echo e(__('Client Signature')); ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.contractheader', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/contract/preview.blade.php ENDPATH**/ ?>