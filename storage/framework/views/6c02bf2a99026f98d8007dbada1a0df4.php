<?php echo e(Form::model($project, ['route' => ['projects.update', $project->id], 'method' => 'PUT', 'enctype' => 'multipart/form-data', 'class'=>'needs-validation', 'novalidate'])); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['projects'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('project_name', __('Project Name'), ['class' => 'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaleab1765d328ab3f8835fc5d78676a070 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.required','data' => []] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('required'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $attributes = $__attributesOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__attributesOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaleab1765d328ab3f8835fc5d78676a070)): ?>
<?php $component = $__componentOriginaleab1765d328ab3f8835fc5d78676a070; ?>
<?php unset($__componentOriginaleab1765d328ab3f8835fc5d78676a070); ?>
<?php endif; ?>
                <?php echo e(Form::text('project_name', null, ['class' => 'form-control', 'required' => 'required'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('start_date', __('Start Date'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::date('start_date', null, ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('end_date', __('End Date'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::date('end_date', null, ['class' => 'form-control'])); ?>

            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('client', __('Client'),['class'=>'form-label'])); ?>

                <?php echo Form::select('client', $clients, $project->client_id,array('class' => 'form-control select2','id'=>'choices-multiple1')); ?>

                <div class="text-xs mt-1">
                    <?php echo e(__('Create client here.')); ?> <a href="<?php echo e(route('clients.index')); ?>"><b><?php echo e(__('Create client')); ?></b></a>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-sm-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('budget', __('Budget'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::number('budget', null, ['class' => 'form-control'])); ?>

            </div>
        </div>
        <div class="col-6 col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('estimated_hrs', __('Estimated Hours'),['class' => 'form-label'])); ?>

                <?php echo e(Form::number('estimated_hrs', null, ['class' => 'form-control','min'=>'0','maxlength' => '8'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('description', __('Description'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::textarea('description', null, ['class' => 'form-control', 'rows' => '4', 'cols' => '50'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('tag', __('Tag'), ['class' => 'form-label'])); ?>

                <?php echo e(Form::text('tag', isset($project->tags) ? $project->tags: '', ['class' => 'form-control', 'data-toggle' => 'tags'])); ?>

            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('status', __('Status'), ['class' => 'form-label'])); ?>

                <select name="status" id="status" class="form-control main-element select2" >
                    <?php $__currentLoopData = \App\Models\Project::$project_status; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $v): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($k); ?>" <?php echo e(($project->status == $k) ? 'selected' : ''); ?>><?php echo e(__($v)); ?></option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 col-md-12">
            <?php echo e(Form::label('project_image', __('Project Image'), ['class' => 'form-label'])); ?>

            <div class="form-file mb-3">
                <input type="file" class="form-control file-validate" name="project_image" >
                <p id="" class="file-error text-danger"></p>
            </div>
            <img <?php echo e($project->img_image); ?> class="avatar avatar-xl" alt="project-image">
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/projects/edit.blade.php ENDPATH**/ ?>