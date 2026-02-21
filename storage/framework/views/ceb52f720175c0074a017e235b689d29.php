<?php
    $lang = isset($curr_noti_tempLang->lang) ? $curr_noti_tempLang->lang : 'en';
    if ($lang == null) {
        $lang = 'en';
    }

    $user = \App\Models\User::find(\Auth::user()->creatorId());
    $plan= \App\Models\Plan::getPlan($user->plan);
?>

<?php $__env->startSection('page-title'); ?>
    <?php echo e($notification_template->name); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Dashboard')); ?></a></li>
    <li class="breadcrumb-item active" aria-current="page"><?php echo e(__('Notification Template')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('pre-purpose-css-page'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/summernote/summernote-bs4.css')); ?>">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('action-btn'); ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <?php if($plan->chatgpt == 1): ?>
        <div class="text-end mb-3">
            <a href="#" class="btn btn-sm btn-primary" data-size="medium" data-ajax-popup-over="true"
                data-url="<?php echo e(route('generate', ['notification template'])); ?>" data-bs-toggle="tooltip"
                data-bs-placement="top" title="<?php echo e(__('Generate')); ?>" data-title="<?php echo e(__('Generate Content With AI')); ?>">
                <i class="fas fa-robot"></i><?php echo e(__(' Generate With AI')); ?>

            </a>
        </div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-12 col-12">
            <div class="card">
                <div class="card-header card-body">
                    <h5></h5>
                    <div class="row text-xs">

                        <h6 class="font-weight-bold mb-4"><?php echo e(__('Variables')); ?></h6>
                        <?php
                            $variables = json_decode($curr_noti_tempLang->variables);
                        ?>
                        <?php if(!empty($variables) > 0): ?>
                            <?php $__currentLoopData = $variables; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $var): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col-6 pb-1">
                                    <p class="mb-1"><?php echo e(__($key)); ?> : <span
                                            class="pull-right text-primary"><?php echo e('{' . $var . '}'); ?></span></p>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <h5></h5>
            <div class="row">
                <div class="col-sm-3 col-md-3 col-lg-3 col-xl-3 ">
                    <div class="card sticky-top language-sidebar mb-0">
                        <div class="list-group list-group-flush" id="useradd-sidenav">
                            <?php $__currentLoopData = $languages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $lang): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <a class="list-group-item list-group-item-action border-0 <?php echo e($curr_noti_tempLang->lang == $key ? 'active' : ''); ?>"
                                    href="<?php echo e(route('manage.notification.language', [$notification_template->id, $key])); ?>">
                                    <?php echo e(Str::ucfirst($lang)); ?>

                                </a>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div class="card h-100 p-3">
                        <?php echo e(Form::model($curr_noti_tempLang, ['route' => ['notification-templates.update', $curr_noti_tempLang->parent_id], 'method' => 'PUT'])); ?>

                        <div class="row">
                            <div class="form-group col-12">
                                <?php echo e(Form::label('name', __('Name'), ['class' => 'col-form-label text-dark'])); ?>

                                <?php echo e(Form::text('name', $notification_template->name, ['class' => 'form-control font-style', 'disabled' => 'disabled'])); ?>

                            </div>
                            <div class="form-group col-12">
                                <?php echo e(Form::label('content', __('Notification Message'), ['class' => 'col-form-label text-dark'])); ?>

                                <?php echo e(Form::textarea('content', $curr_noti_tempLang->content, ['class' => 'form-control font-style', 'required' => 'required'])); ?>

                            </div>
                            <div class="col-md-12 text-end">
                                <?php echo e(Form::hidden('lang', null)); ?>

                                <input type="submit" value="<?php echo e(__('Save')); ?>"
                                    class="btn btn-print-invoice  btn-primary">
                            </div>
                        </div>
                        <?php echo e(Form::close()); ?>

                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/notification_templates/show.blade.php ENDPATH**/ ?>