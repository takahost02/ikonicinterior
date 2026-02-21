<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Debit Notes')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Debit Note')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create debit note')): ?>
            <a href="#" data-url="<?php echo e(route('create.custom.debit.note')); ?>"data-bs-toggle="tooltip" title="<?php echo e(__('Create')); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Create New Debit Note')); ?>" class="btn btn-sm btn-primary">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body table-border-style mt-2">
                    <h5></h5>
                    <div class="table-responsive">
                        <table class="table datatable">
                            <thead>
                            <tr>
                                <th> <?php echo e(__('Debit Note')); ?></th>
                                <th> <?php echo e(__('Bill')); ?></th>
                                <th> <?php echo e(__('Date')); ?></th>
                                <th> <?php echo e(__('Amount')); ?></th>
                                <th> <?php echo e(__('Description')); ?></th>
                                <th> <?php echo e(__('Status')); ?></th>
                                <th width="10%"> <?php echo e(__('Action')); ?></th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php $__currentLoopData = $customDebitNotes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $debitNote): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td class="Id">
                                            <a href="#" class="btn btn-outline-primary"><?php echo e(\App\Models\CustomerDebitNotes::debitNumberFormat($debitNote->debit_id)); ?></a>
                                        </td>
                                        <td class="Id">
                                            <a href="<?php echo e(route('bill.show',\Crypt::encrypt($debitNote->bill))); ?>" class="btn btn-outline-primary"><?php echo e(\Auth::user()->billNumberFormat($debitNote->bills->bill_id)); ?></a>
                                        </td>
                                        <td><?php echo e(Auth::user()->dateFormat($debitNote->date)); ?></td>
                                        <td><?php echo e(Auth::user()->priceFormat($debitNote->amount)); ?></td>
                                        <td><?php echo e(!empty($debitNote->description)?$debitNote->description:'-'); ?></td>
                                        <td>
                                        <?php if($debitNote->status == 0): ?>
                                            <span
                                                class="badge bg-warning p-2 px-3 rounded"><?php echo e(__(\App\Models\CustomerDebitNotes::$statues[$debitNote->status])); ?></span>
                                        <?php elseif($debitNote->status == 1): ?>
                                            <span
                                                class="badge bg-info p-2 px-3 rounded"><?php echo e(__(\App\Models\CustomerDebitNotes::$statues[$debitNote->status])); ?></span>
                                        <?php elseif($debitNote->status == 2): ?>
                                            <span
                                                class="badge bg-primary p-2 px-3 rounded"><?php echo e(__(\App\Models\CustomerDebitNotes::$statues[$debitNote->status])); ?></span>
                                        <?php endif; ?>
                                    </td>
                                        <td>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit debit note')): ?>
                                                <div class="action-btn me-2">
                                                    <a data-url="<?php echo e(route('bill.edit.custom-debit',[$debitNote->bill,$debitNote->id])); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Debit Note')); ?>" href="#" class="mx-3 btn btn-sm align-items-center bg-info" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-original-title="<?php echo e(__('Edit')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete debit note')): ?>
                                                    <div class="action-btn ">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => array('bill.custom-note.delete', $debitNote->bill,$debitNote->id),'class'=>'delete-form-btn','id'=>'delete-form-'.$debitNote->id]); ?>

                                                            <a href="#" class="mx-3 btn btn-sm align-items-center bs-pass-para bg-danger" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>" data-original-title="<?php echo e(__('Delete')); ?>" data-confirm="<?php echo e(__('Are You Sure?').'|'.__('This action can not be undone. Do you want to continue?')); ?>" data-confirm-yes="document.getElementById('delete-form-<?php echo e($debitNote->id); ?>').submit();">
                                                                <i class="ti ti-trash text-white"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                            <?php endif; ?>
                                        </td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>


<?php $__env->startPush('script-page'); ?>
<script>
    $(document).on('click' , '#item' , function(){
        var item_id = $(this).val();
        $.ajax({
            url: "<?php echo e(route('debit-bill.itemprice')); ?>",
            method:'POST',
            data: {
                "item_id": item_id, 
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function (data) {
                if (data !== undefined) {
                    $('#amount').val(data);
                    $('input[name="amount"]').attr('min', 0);
                }
            }
        });        
    });
</script>
<?php $__env->stopPush(); ?>
<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/customerDebitNote/index.blade.php ENDPATH**/ ?>