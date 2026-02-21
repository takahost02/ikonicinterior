<?php echo e(Form::model($category, array('route' => array('product-category.update', $category->id), 'method' => 'PUT', 'class'=>'needs-validation', 'novalidate'))); ?>

<div class="modal-body">

    <div class="row">
        <div class="form-group col-md-12">
            <?php echo e(Form::label('name', __('Category Name'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::text('name', null, array('class' => 'form-control font-style','required'=>'required', 'placeholder'=>__('Enter Category Name')))); ?>

        </div>

        <div class="form-group col-md-12 d-block">
            <?php echo e(Form::label('type', __('Category Type'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::select('type',$types,null, array('class' => 'form-control select cattype','required'=>'required'))); ?>

        </div>


        <div class="form-group col-md-12 account <?php echo e($category->type =='product & service'? 'd-none':''); ?>">
            <?php echo e(Form::label('chart_account_id',__('Account'),['class'=>'form-label'])); ?>

            <select class="form-control select" name="chart_account" id="chart_account" >
            </select>

        </div>



        <div class="form-group col-md-12">
            <?php echo e(Form::label('color', __('Category Color'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
<?php endif; ?>product-unit
            <?php echo e(Form::text('color', null, array('class' => 'form-control jscolor','required'=>'required'))); ?>

            <p class="small"><?php echo e(__('For chart representation')); ?></p>
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Update')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



<script>

    //hide & show chartofaccount

    $(document).on('click', '.cattype', function ()
    {
        var type = $(this).val();
        if (type != 'product & service') {
            $('.account').removeClass('d-none')
            $('.account').addClass('d-block');
        } else {
            $('.account').addClass('d-none')
            $('.account').removeClass('d-block');
        }
    });

    $(document).on('change', '#type', function () {
        var type = $(this).val();

        $.ajax({
            url: '<?php echo e(route('productServiceCategory.getaccount')); ?>',
            type: 'POST',
            data: {
                "type": type,
                "_token": "<?php echo e(csrf_token()); ?>",
            },
            success: function (data) {
                $('#chart_account').empty();
                $('#chart_account').append('<option value=""><?php echo e(__(' --- Select Account ---')); ?></option>');
                $.each(data.chart_accounts, function (key, value) {
                    var select = '';
                    if (key == '<?php echo e($category->chart_account_id); ?>') {
                        select = 'selected';
                    }
                    $('#chart_account').append('<option value="' + key + '"  ' + select + ' class="subAccount">' + value + '</option>');

                    $.each(data.sub_accounts, function (subkey, subvalue) {
                    var select1 = '';

                        if (subvalue.id == '<?php echo e($category->chart_account_id); ?>') {
                        select1 = 'selected';
                    }
                        if(key == subvalue.account)
                        {
                            $('#chart_account').append('<option value="' + subvalue.id + '"  ' + select1 + '>' + '&nbsp; &nbsp;&nbsp;' + subvalue.name + '</option>');
                        }
                });
                });
            }
        });
    });
    $(document).ready(function (){
        $('#type').trigger('change')
    })
</script>
<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/productServiceCategory/edit.blade.php ENDPATH**/ ?>