<?php echo e(Form::model($lead, array('route' => array('leads.products.update', $lead->id), 'method' => 'PUT', 'class'=>'needs-validation', 'novalidate'))); ?>

<div class="modal-body">
    <div class="row">
        <div class="col-12 form-group">
            <?php echo e(Form::label('products', __('Products'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::select('products[]', $products,false, array('class' => 'form-control select2','id'=>'choices-multiple3','multiple'=>'', 'required' => 'required'))); ?>

            <div class="text-xs mt-1">
                <?php echo e(__('Create product here.')); ?> <a href="<?php echo e(route('productservice.index')); ?>"><b><?php echo e(__('Create product')); ?></b></a>
            </div>
        </div>
    </div>
</div>

<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Add')); ?>" class="btn  btn-primary">
</div>

<?php echo e(Form::close()); ?>



<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/leads/products.blade.php ENDPATH**/ ?>