<?php
    $profile = \App\Models\Utility::get_file('uploads/avatar');
?>
<?php $__env->startSection('page-title'); ?>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <?php echo e(__('Manage Companies')); ?>

    <?php else: ?>
        <?php echo e(__('Manage User')); ?>

    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item">
        <a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a>
    </li>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <li class="breadcrumb-item"><?php echo e(__('Companies')); ?></li>
    <?php else: ?>
        <li class="breadcrumb-item"><?php echo e(__('User')); ?></li>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <div class="float-end">
        <?php if(\Auth::user()->type == 'company' || \Auth::user()->type == 'HR'): ?>
            <a href="<?php echo e(route('user.userlog')); ?>" class="btn btn-primary-subtle btn-sm me-1 <?php echo e(Request::segment(1) == 'user'); ?>"
                data-bs-toggle="tooltip" data-bs-placement="top" title="<?php echo e(__('User Logs History')); ?>"><i
                    class="ti ti-user-check"></i>
            </a>
        <?php endif; ?>
        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('create user')): ?>
            <a href="#" data-size="lg" data-url="<?php echo e(route('users.create')); ?>" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(\Auth::user()->type == 'super admin' ?  __('Create Company')  : __('Create User')); ?>" data-bs-original-title="<?php echo e(\Auth::user()->type == 'super admin' ?  __('Create Company')  : __('Create User')); ?>" class="btn btn-sm btn-primary me-1">
                <i class="ti ti-plus"></i>
            </a>
        <?php endif; ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
<div class="row">
    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col-xxl-3 col-lg-4 col-sm-6 mb-4">
            <div class="user-card d-flex flex-column h-100">
                <div class="user-card-top d-flex align-items-center justify-content-between flex-1 gap-2 mb-3">
                    <?php if(\Auth::user()->type == 'super admin'): ?>
                        <div class="badge bg-primary p-1 px-2">
                            <?php echo e(!empty($user->currentPlan) ? $user->currentPlan->name : ''); ?>

                        </div>
                    <?php else: ?>
                        <div class="badge bg-primary p-1 px-2">
                            <?php echo e(ucfirst($user->type)); ?>

                        </div>
                    <?php endif; ?>
                    <?php if(Gate::check('edit user') || Gate::check('delete user')): ?>
                        <div class="btn-group card-option">
                            <?php if($user->is_active == 1 && $user->is_disable == 1): ?>
                                <button type="button" class="btn p-0 border-0" data-bs-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="ti ti-dots-vertical"></i>
                                </button>

                                <div class="dropdown-menu icon-dropdown dropdown-menu-end">
                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit user')): ?>
                                        <a href="#!" data-size="lg" data-url="<?php echo e(route('users.edit', $user->id)); ?>"
                                            data-ajax-popup="true" class="dropdown-item"
                                            data-bs-original-title="<?php echo e(\Auth::user()->type == 'super admin' ? __('Edit Company') : __('Edit User')); ?>">
                                            <i class="ti ti-pencil"></i>
                                            <span><?php echo e(__('Edit')); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete user')): ?>
                                        <?php echo Form::open([
                                            'method' => 'DELETE',
                                            'route' => ['users.destroy', $user['id']],
                                            'id' => 'delete-form-' . $user['id'],
                                        ]); ?>

                                        <a href="#!" class="dropdown-item bs-pass-para">
                                            <i class="ti ti-trash"></i>
                                            <span>
                                                <?php if($user->delete_status != 0): ?>
                                                    <?php echo e(__('Delete')); ?>

                                                <?php else: ?>
                                                    <?php echo e(__('Restore')); ?>

                                                <?php endif; ?>
                                            </span>
                                        </a>
                                        <?php echo Form::close(); ?>

                                    <?php endif; ?>

                                    <?php if(Auth::user()->type == 'super admin'): ?>
                                        <a href="<?php echo e(route('login.with.company', $user->id)); ?>" class="dropdown-item"
                                            data-bs-original-title="<?php echo e(__('Login As Company')); ?>">
                                            <i class="ti ti-replace"></i>
                                            <span> <?php echo e(__('Login As Company')); ?></span>
                                        </a>
                                    <?php endif; ?>

                                    <a href="#!" data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                        data-ajax-popup="true" data-size="md" class="dropdown-item"
                                        data-bs-original-title="<?php echo e(__('Reset Password')); ?>">
                                        <i class="ti ti-adjustments"></i>
                                        <span> <?php echo e(__('Reset Password')); ?></span>
                                    </a>

                                    <?php if($user->is_enable_login == 1): ?>
                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                            class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-danger"> <?php echo e(__('Login Disable')); ?></span>
                                        </a>
                                    <?php elseif($user->is_enable_login == 0 && $user->password == null): ?>
                                        <a href="#"
                                            data-url="<?php echo e(route('users.reset', \Crypt::encrypt($user->id))); ?>"
                                            data-ajax-popup="true" data-size="md" class="dropdown-item login_enable"
                                            data-title="<?php echo e(__('New Password')); ?>" class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('users.login', \Crypt::encrypt($user->id))); ?>"
                                            class="dropdown-item">
                                            <i class="ti ti-road-sign"></i>
                                            <span class="text-success"> <?php echo e(__('Login Enable')); ?></span>
                                        </a>
                                    <?php endif; ?>

                                </div>
                            <?php else: ?>
                                <a href="#" class="action-item text-lg"><i class="ti ti-lock"></i></a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="user-info-wrp d-flex align-items-center gap-3 border-bottom pb-3 mb-3">
                    <div class="user-image rounded-1 border-1 border border-primary">
                        <img src="<?php echo e(!empty($user->avatar) ? Utility::get_file('uploads/avatar/') . $user->avatar : asset(Storage::url('uploads/avatar/avatar.png'))); ?>"
                            alt="user-image" height="100%" width="100%">
                    </div>
                    <div class="user-info flex-1">
                        <h5 class="mb-1"><?php echo e($user->name); ?></h5>
                        <?php if($user->delete_status == 0): ?>
                            <h6 class="mb-1"><?php echo e(__('Soft Deleted')); ?></h6>
                        <?php endif; ?>
                        <span class="text-sm text-muted text-break"><?php echo e($user->email); ?></span>
                    </div>
                </div>
                <div class="date-wrp d-flex align-items-center justify-content-between gap-2">
                    <?php
                        $date = \Carbon\Carbon::parse($user->last_login_at)->format('Y-m-d');
                        $time = \Carbon\Carbon::parse($user->last_login_at)->format('H:i:s');
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
                <?php if(\Auth::user()->type == 'super admin'): ?>
                    <div class="btn-wrp d-flex align-items-center gap-2 border-bottom border-top py-3 my-3">
                        <a href="#" data-url="<?php echo e(route('plan.upgrade', $user->id)); ?>" data-size="lg"
                            data-ajax-popup="true" class="btn btn-primary p-2 px-1 w-100"
                            data-title="<?php echo e(__('Upgrade Plan')); ?>"><?php echo e(__('Upgrade Plan')); ?></a>
                        <a href="#" data-url="<?php echo e(route('company.info', $user->id)); ?>" data-size="lg"
                            data-ajax-popup="true" class="btn btn-light-primary p-2 px-1 w-100"
                            data-title="<?php echo e(__('Company Info')); ?>"><?php echo e(__('Admin Hub')); ?></a>
                    </div>
                    <div class="text-center pb-3 mb-3 border-bottom">
                        <span class="text-sm">
                            <?php echo e(__('Plan Expired : ')); ?>

                            <?php echo e(!empty($user->plan_expire_date) ? \Auth::user()->dateFormat($user->plan_expire_date) : __('Lifetime')); ?>

                        </span>
                    </div>
                    <div
                        class="user-count-wrp d-flex align-items-center justify-content-between gap-2">
                        <div class="user-count d-flex align-items-center gap-2" data-bs-toggle="tooltip"
                            title="<?php echo e(__('Users')); ?>">
                            <div class="user-icon d-flex align-items-center justify-content-center">
                                <i class="f-16 ti ti-users text-white"></i>
                            </div>
                            <?php echo e($user->totalCompanyUser($user->id)); ?>

                        </div>
                        <div class="user-count d-flex align-items-center gap-2" data-bs-toggle="tooltip"
                            title="<?php echo e(__('Customers')); ?>">
                            <div class="user-icon d-flex align-items-center justify-content-center">
                                <i class="f-16 ti ti-users text-white"></i>
                            </div>
                            <?php echo e($user->totalCompanyCustomer($user->id)); ?>

                        </div>
                        <div class="user-count d-flex align-items-center gap-2" data-bs-toggle="tooltip"
                            title="<?php echo e(__('Vendors')); ?>">
                            <div class="user-icon d-flex align-items-center justify-content-center">
                                <i class="f-16 ti ti-users text-white"></i>
                            </div>
                            <?php echo e($user->totalCompanyVender($user->id)); ?>

                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    <div class="col-xxl-3 col-lg-4 col-sm-6 mb-4">
        <a href="#" class="btn-addnew-project border-primary" data-ajax-popup="true"
            data-url="<?php echo e(route('users.create')); ?>"
            data-title="<?php echo e(\Auth::user()->type == 'super admin' ? __('Create Company') : __('Create User')); ?>"
            data-bs-toggle="tooltip" title=""
            data-bs-original-title="<?php echo e(\Auth::user()->type == 'super admin' ? __('Create Company') : __('Create User')); ?>">
            <div class="bg-primary proj-add-icon">
                <i class="ti ti-plus"></i>
            </div>
            <h6 class="mt-3 mb-2">
                <?php echo e(\Auth::user()->type == 'super admin' ? __('Create Company') : __('Create User')); ?></h6>
            <p class="text-muted text-center mb-0">
                <?php echo e(\Auth::user()->type == 'super admin' ? __('Click here to add new company') : __('Click here to add new user')); ?>

            </p>
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

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/user/index.blade.php ENDPATH**/ ?>