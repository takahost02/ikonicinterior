<?php if(isset($call)): ?>
    <?php echo e(Form::model($call, array('route' => array('leads.calls.update', $lead->id, $call->id), 'method' => 'PUT', 'class'=>'needs-validation', 'novalidate'))); ?>

<?php else: ?>
    <?php echo e(Form::open(array('route' => ['leads.calls.store',$lead->id], 'class'=>'needs-validation', 'novalidate'))); ?>

<?php endif; ?>
<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['lead'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-6 form-group">
            <?php echo e(Form::label('subject', __('Subject'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::text('subject', null, array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Subject')))); ?>

        </div>
        <div class="col-6 form-group">
            <?php echo e(Form::label('call_type', __('Call Type'),['class'=>'form-label'])); ?>

            <select name="call_type" id="call_type" class="form-control " required>
                <option value="outbound" <?php if(isset($call->call_type) && $call->call_type == 'outbound'): ?> selected <?php endif; ?>><?php echo e(__('Outbound')); ?></option>
                <option value="inbound" <?php if(isset($call->call_type) && $call->call_type == 'inbound'): ?> selected <?php endif; ?>><?php echo e(__('Inbound')); ?></option>
            </select>
        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('duration', __('Follow Up'),['class'=>'form-label'])); ?>

            <?php echo e(Form::datetimeLocal('duration', old('duration', isset($call->duration) ? \Carbon\Carbon::parse($call->duration)->format('Y-m-d\TH:i') : null), array('class' => 'form-control', 'required' => 'required'))); ?>

        <div class="col-12 form-group">
            <?php echo e(Form::label('user_id', __('Assignee'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <select name="user_id" id="user_id" class="form-control " required>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <option value="<?php echo e($user->getLeadUser->id); ?>" <?php if(isset($call->user_id) && $call->user_id == $user->getLeadUser->id): ?> selected <?php endif; ?>><?php echo e($user->getLeadUser->name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('description', null, array('class' => 'form-control', 'placeholder'=>__('Enter Description')))); ?>

        </div>
        <div class="col-12 form-group">
            <?php echo e(Form::label('call_result', __('Call Result'),['class'=>'form-label'])); ?>

            <?php echo e(Form::textarea('call_result', null, array('class' => 'summernote-simple','id'=>'summernote'))); ?>


        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <?php if(isset($call)): ?>
        <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
    <?php else: ?>
        <input type="submit" value="<?php echo e(__('Add')); ?>" class="btn  btn-primary">
    <?php endif; ?>
</div>
<?php echo e(Form::close()); ?>


<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/leads/calls.blade.php ENDPATH**/ ?>