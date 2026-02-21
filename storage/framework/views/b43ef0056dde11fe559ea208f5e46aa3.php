<?php echo e(Form::open(array('url' => 'form_builder', 'class'=>'needs-validation', 'novalidate'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('name', __('Name'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=> 'required', 'placeholder'=>__('Enter Name')))); ?>

        </div>
        <div class="col-12 form-group">
            <label for="exampleColorInput" class="form-label"><?php echo e(__('Active')); ?></label>
            <div class="d-flex radio-check">
                <div class="form-check form-check-inline">
                    <input type="radio" id="on" value="1" name="is_active" class="form-check-input" checked="checked">
                    <label class="custom-control-label form-label" for="on"><?php echo e(__('On')); ?></label>
                </div>
                <div class="form-check form-check-inline">
                    <input type="radio" id="off" value="0" name="is_active" class="form-check-input">
                    <label class="custom-control-label form-label" for="off"><?php echo e(__('Off')); ?></label>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/form_builder/create.blade.php ENDPATH**/ ?>