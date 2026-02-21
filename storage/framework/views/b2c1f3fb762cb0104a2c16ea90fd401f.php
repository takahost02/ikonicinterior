<?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <li class="list-group-item px-0">
        <div class="row align-items-center justify-content-between">
            <div class="col-sm-auto mb-3 mb-sm-0">
                <div class="d-flex align-items-center">
                    <div class="avatar avatar-sm me-3">
                        <?php
                        $avatar = \App\Models\Utility::get_file('uploads/avatar/');

                        ?>
                        <img <?php if($user->avatar): ?> src="<?php echo e($avatar.$user->avatar); ?>" <?php else: ?> src="<?php echo e($avatar. 'avatar.png'); ?>" <?php endif; ?>  alt="image" class="rounded border-2 border border-primary">

                    </div>
                    <div class="div">
                        <h5 class="m-0"><?php echo e($user->name); ?></h5>
                        <small class="text-muted"><?php echo e($user->email); ?></small>
                    </div>
                </div>
            </div>
            <div class="col-sm-auto text-sm-end d-flex align-items-center">
                <?php if(!empty($user) && $user->type != 'company'): ?>
                        <div class="action-btn me-2">
                            <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.user.destroy',  [$project->id,$user->id]]]); ?>

                            <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para bg-danger" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                            
                            <?php echo Form::close(); ?>

                        </div>
                <?php endif; ?>
            </div>
        </div>
    </li>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/projects/users.blade.php ENDPATH**/ ?>