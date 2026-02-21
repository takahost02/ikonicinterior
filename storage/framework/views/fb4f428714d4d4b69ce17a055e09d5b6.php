<div class="col-xl-12">
    <div class="card">
        <div class="card-body table-border-style">
            <div class="table-responsive">
                <table class="table datatable">
                    <thead>
                    <tr>
                        <th><?php echo e(__('Project')); ?></th>
                        <th><?php echo e(__('Status')); ?></th>
                        <th><?php echo e(__('Users')); ?></th>
                        <th><?php echo e(__('Completion')); ?></th>
                        <?php if(Gate::check('create project') ||
                            Gate::check('edit project') ||
                            Gate::check('delete project')): ?>
                            <th class="text-end"><?php echo e(__('Action')); ?></th>
                        <?php endif; ?>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(isset($projects) && !empty($projects) && count($projects) > 0): ?>
                        <?php $__currentLoopData = $projects; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $project): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img <?php echo e($project->img_image); ?> class="wid-40 rounded border-2 border border-primary me-3">
                                        <p class="mb-0"><a href="<?php echo e(route('projects.show',$project)); ?>" class="name mb-0 h6 text-sm"><?php echo e($project->project_name); ?></a></p>
                                    </div>
                                </td>
                                <td class="">
                                    <span class="status_badge badge bg-<?php echo e(\App\Models\Project::$status_color[$project->status]); ?> p-2 px-3 rounded"><?php echo e(__(\App\Models\Project::$project_status[$project->status])); ?></span>
                                </td>
                                <td class="">
                                    <div class="avatar-group" id="project_<?php echo e($project->id); ?>">
                                        <?php if(isset($project->users) && !empty($project->users) && count($project->users) > 0): ?>
                                            <?php $__currentLoopData = $project->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                
                                                    <a href="#" class="avatar rounded-circle">
                                                        <img <?php if($user->avatar): ?> src="<?php echo e(asset('/storage/uploads/avatar/'.$user->avatar)); ?>" <?php else: ?> src="<?php echo e(asset('/storage/uploads/avatar/avatar.png')); ?>" <?php endif; ?> title="<?php echo e($user->name); ?>" style="height:36px;width:36px;">
                                                    </a>
                                                
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            
                                        <?php else: ?>
                                            <?php echo e(__('-')); ?>

                                        <?php endif; ?>
                                    </div>
                                </td>
                                <td>
                                    <h5 class="mb-1 text-success"><?php echo e($project->project_progress($project , $last_task->id)['percentage']); ?></h5>
                                    <div class="progress mb-0">
                                        <div class="progress-bar bg-<?php echo e($project->project_progress($project , $last_task->id)['color']); ?>" style="width: <?php echo e($project->project_progress($project , $last_task->id)['percentage']); ?>;"></div>
                                    </div>
                                </td>
                                <td class="text-end">
                                    <span>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <div class="action-btn me-2">
                                                <a href="#" class="mx-3 btn btn-sm align-items-center bg-warning" data-url="<?php echo e(route('invite.project.member.view', $project->id)); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Invite User')); ?>" data-title="<?php echo e(__('Invite User')); ?>">
                                                    <i class="ti ti-send text-white"></i>
                                                </a>
                                            </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('edit project')): ?>
                                            <div class="action-btn me-2">
                                                    <a href="#" class="mx-3 btn btn-sm align-items-center bg-info" data-url="<?php echo e(URL::to('projects/'.$project->id.'/edit')); ?>" data-ajax-popup="true" data-size="lg" data-bs-toggle="tooltip" title="<?php echo e(__('Edit')); ?>" data-title="<?php echo e(__('Edit Project')); ?>">
                                                        <i class="ti ti-pencil text-white"></i>
                                                    </a>
                                                </div>
                                        <?php endif; ?>
                                        <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('delete project')): ?>
                                            <div class="action-btn ">
                                                    <?php echo Form::open(['method' => 'DELETE', 'route' => ['projects.user.destroy', [$project->id,$user->id]]]); ?>

                                                    <a href="#" class="mx-3 btn btn-sm  align-items-center bs-pass-para bg-danger" data-bs-toggle="tooltip" title="<?php echo e(__('Delete')); ?>"><i class="ti ti-trash text-white"></i></a>
                                                    <?php echo Form::close(); ?>

                                                </div>
                                        <?php endif; ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php else: ?>
                        <tr>
                            <th scope="col" colspan="7"><h6 class="text-center"><?php echo e(__('No Projects Found.')); ?></h6></th>
                        </tr>
                    <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/projects/list.blade.php ENDPATH**/ ?>