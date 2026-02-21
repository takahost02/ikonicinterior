<?php
    $profile = \App\Models\Utility::get_file('uploads/avatar/');
?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Manage Client')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <li class="breadcrumb-item"><?php echo e(__('Client')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <a href="#" data-size="md" data-url="<?php echo e(route('clients.create')); ?>" data-ajax-popup="true" data-bs-toggle="tooltip"
            title="<?php echo e(__('Create New Client')); ?>" data-bs-original-title="<?php echo e(__('create New Client')); ?>"
            class="btn btn-sm btn-primary">
            <i class="ti ti-plus"></i>
        </a>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $clients; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $client): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-lg-4 col-sm-6 mb-4">
            <div class="client-card d-flex flex-column h-100">
                <div class="client-info-wrp d-flex flex-1 align-items-center gap-3 border-bottom pb-3 mb-3">
                    <div class="client-image rounded-1 border-1 border border-primary">
                        <img src="<?php echo e(!empty($client->avatar) ? asset(Storage::url('uploads/avatar/' . $client->avatar)) : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                            alt="client-image" height="100%" width="100%">
                    </div>
                    <div class="client-info flex-1">
                        <div class="d-flex align-items-center gap-2">
                            <h5 class="mb-1 flex-1"><?php echo e($client->name); ?></h5>
                            <div class="btn-group card-option">
                                <button type="button" class="btn p-0 border-0" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit client')): ?>
                                        <a href="#!" data-size="md"
                                            data-url="<?php echo e(route('clients.edit', $client->id)); ?>" data-ajax-popup="true"
                                            class="dropdown-item" data-bs-original-title="<?php echo e(__('Edit Client')); ?>">
                                            <i class="ti ti-pencil"></i>
                                            <span><?php echo e(__('Edit')); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete client')): ?>
                                        <?php echo Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['clients.destroy', $client['id']],
                                            'id' => 'delete-form-' . $client['id'],
                                        ]); ?>

                                        <a href="#!" class="dropdown-item bs-pass-para">
                                            <i class="ti ti-trash"></i>
                                            <span>
                                                <?php if($client->delete_status != 0): ?>
                                                    <?php echo e(__('Delete')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('Restore')); ?>

                                                <?php endif; ?>
                                            </span>
                                        </a>

                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>
                                    <?php if($client->is_enable_login == 1): ?>
                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($client->id))); ?>"
                                            class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                        </a>
                                    <?php elseif($client->is_enable_login == 0 && $client->password == null): ?>
                                        <a href="#"
                                            data-url="<?php echo e(route('clients.reset', \Crypt::encrypt($client->id))); ?>"
                                            data-ajax-popup="true" data-size="md" class="dropdown-item login_enable"
                                            data-title="<?php echo e(__('New Password')); ?>" class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($client->id))); ?>"
                                            class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                        </a>
                                    <?php endif; ?>


                                    <a href="#!"
                                        data-url="<?php echo e(route('clients.reset', \Crypt::encrypt($client->id))); ?>"
                                        data-ajax-popup="true" class="dropdown-item"
                                        data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                        <i class="ti ti-adjustments"></i>
                                        <span> <?php echo e(__('Reset Password')); ?></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <span class="text-sm text-muted text-break"><?php echo e($client->email); ?></span>
                    </div>
                </div>
                <div class="project-info-wrp d-flex align-items-center justify-content-between gap-3 border-bottom pb-3 mb-3">
                    <div class="project-info flex-1 f-w-600">
                        <span><?php echo e(__('Deals: ')); ?></span>
                        <?php if($client->clientDeals): ?>
                            <?php echo e($client->clientDeals->count()); ?>

                        <?php endif; ?>
                    </div>
                    <div class="project-info flex-1 text-end f-w-600">
                        <span><?php echo e(__('Projects: ')); ?></span>
                        <?php if($client->clientProjects): ?>
                            <?php echo e($client->clientProjects->count()); ?>

                        <?php endif; ?>
                    </div>
                </div>
                <div class="date-wrp d-flex align-items-center justify-content-between gap-2">
                    <?php
                        $date = \Carbon\Carbon::parse($client->last_login_at)->format('Y-m-d');
                        $time = \Carbon\Carbon::parse($client->last_login_at)->format('H:i:s');
                    ?>
                    <div class="date d-flex align-items-center gap-2">
                        <div class="date-icon d-flex align-items-center justify-content-center">
                            <i class="f-16 ti ti-calendar text-white"></i>
                        </div>
                        <span class="text-sm"><?php echo e($date); ?></span>
                    </div>
                    <div class="time d-flex align-items-center gap-2">
                        <div class="time-icon d-flex align-items-center justify-content-center">
                            <i class="f-16 ti ti-clock text-white"></i>
                        </div>
                        <span class="text-sm"><?php echo e($time); ?></span>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xl-3 col-lg-4 col-sm-6 mb-4">
        <a href="#" data-size="md" data-url="<?php echo e(route('clients.create')); ?>" data-ajax-popup="true"
            data-bs-toggle="tooltip" data-bs-original-title="<?php echo e(__('Create New Client')); ?>"
            class="btn-addnew-project border-primary">
            <div class="bg-primary proj-add-icon">
                <i class="ti ti-plus"></i>
            </div>
            <h6 class="mt-3 mb-2"><?php echo e(__('Create Client')); ?></h6>
            <p class="text-muted text-center mb-0"><?php echo e(__('Click here to add new client')); ?></p>
        </a>
    </div>
</div>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '#password_switch', function() {
            if ($(this).is(':checked')) {
                $('.ps_div').removeClass('d-none');
                $('#password').attr("required", true);

            } else {
                $('.ps_div').addClass('d-none');
                $('#password').val(null);
                $('#password').removeAttr("required");
            }
        });
        $(document).on('click', '.login_enable', function() {
            setTimeout(function() {
                $('.modal-body').append($('<input>', {
                    type: 'hidden',
                    val: 'true',
                    name: 'login_enable'
                }));
            }, 2000);
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/clients/index.blade.php ENDPATH**/ ?>