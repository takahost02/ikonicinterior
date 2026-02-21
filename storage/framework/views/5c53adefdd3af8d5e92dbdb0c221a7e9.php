<?php echo e(Form::open(array('url' => 'productservice','enctype' => "multipart/form-data", 'class'=>'needs-validation', 'novalidate'))); ?>

<div class="modal-body">
    
    <?php
        $plan= \App\Models\Utility::getChatGPTSettings();
    ?>
    <?php if($plan->chatgpt == 1): ?>
    <div class="text-end mb-3">
        <a href="#" data-size="md" class="btn  btn-primary btn-icon btn-sm" data-ajax-popup-over="true" data-url="<?php echo e(route('generate',['productservice'])); ?>"
           data-bs-placement="top" data-title="<?php echo e(__('Generate content with AI')); ?>">
            <i class="fas fa-robot"></i> <span><?php echo e(__('Generate with AI')); ?></span>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
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
                <?php echo e(Form::text('name', '', array('class' => 'form-control','required'=>'required', 'placeholder' => __('Enter Name')))); ?>

            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sku', __('SKU'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                <div class="input-group">
                    <?php echo e(Form::text('sku', '', ['class' => 'form-control','required' => 'required', 'placeholder' => __('Enter SKU')])); ?>

                    <button class="btn btn-outline-primary" type="button" onclick="generateSKU()"><?php echo e(__('Generate')); ?></button>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('sale_price', __('Sale Price'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                <?php echo e(Form::number('sale_price', '', array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder' => __('Enter Sale Price')))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('sale_chartaccount_id', __('Income Account'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <select name="sale_chartaccount_id" class="form-control" required>
                <option value=""><?php echo e(__('Select Chart of Account')); ?></option>
                <?php $__currentLoopData = $incomeChartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeName => $subtypes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($typeName); ?>">
                        <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subtypeId => $subtypeData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option disabled style="color: #000; font-weight: bold;"><?php echo e($subtypeData['account_name']); ?></option>
                            <?php $__currentLoopData = $subtypeData['chart_of_accounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chartOfAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($chartOfAccount['id']); ?>">
                                    &nbsp;&nbsp;&nbsp;<?php echo e($chartOfAccount['account_name']); ?>

                                </option>
                                <?php $__currentLoopData = $subtypeData['subAccounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($chartOfAccount['id'] == $subAccount['parent_account']): ?>
                                    <option value="<?php echo e($subAccount['id']); ?>" class="ms-5"> &nbsp; &nbsp;&nbsp;&nbsp; <?php echo e(' - '. $subAccount['account_name']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="text-xs mt-1">
                <?php echo e(__('Create account here.')); ?> <a href="<?php echo e(route('chart-of-account.index')); ?>"><b><?php echo e(__('Create account')); ?></b></a>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <?php echo e(Form::label('purchase_price', __('Purchase Price'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                <?php echo e(Form::number('purchase_price', '', array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder' => __('Enter Purchase Price')))); ?>

            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('expense_chartaccount_id', __('Expense Account'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <select name="expense_chartaccount_id" class="form-control" required>
                <option value=""><?php echo e(__('Select Chart of Account')); ?></option>
                <?php $__currentLoopData = $expenseChartAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $typeName => $subtypes): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <optgroup label="<?php echo e($typeName); ?>">
                        <?php $__currentLoopData = $subtypes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subtypeId => $subtypeData): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option disabled style="color: #000; font-weight: bold;"><?php echo e($subtypeData['account_name']); ?></option>
                            <?php $__currentLoopData = $subtypeData['chart_of_accounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $chartOfAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($chartOfAccount['id']); ?>">
                                    &nbsp;&nbsp;&nbsp;<?php echo e($chartOfAccount['account_name']); ?>

                                </option>
                                <?php $__currentLoopData = $subtypeData['subAccounts']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subAccount): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($chartOfAccount['id'] == $subAccount['parent_account']): ?>
                                    <option value="<?php echo e($subAccount['id']); ?>" class="ms-5"> &nbsp; &nbsp;&nbsp;&nbsp; <?php echo e(' - '. $subAccount['account_name']); ?></option>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </optgroup>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </select>
            <div class="text-xs mt-1">
                <?php echo e(__('Create account here.')); ?> <a href="<?php echo e(route('chart-of-account.index')); ?>"><b><?php echo e(__('Create account')); ?></b></a>
            </div>
        </div>

        <div class="form-group col-md-6">
            <?php echo e(Form::label('tax_id', __('Tax'),['class'=>'form-label'])); ?>

            <?php echo e(Form::select('tax_id[]', $tax,null, array('class' => 'form-control select2','id'=>'choices-multiple1','multiple'))); ?>

            <div class=" text-xs mt-1">
                <?php echo e(__('Create tax here. ')); ?><a href="<?php echo e(route('taxes.index')); ?>"><b><?php echo e(__('Create tax')); ?></b></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('category_id', __('Category'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::select('category_id', $category,null, array('class' => 'form-control select','required'=>'required'))); ?>


            <div class=" text-xs mt-1">
                <?php echo e(__('Create category here. ')); ?><a href="<?php echo e(route('product-category.index')); ?>"><b><?php echo e(__('Create Category')); ?></b></a>
            </div>
        </div>
        <div class="form-group col-md-6">
            <?php echo e(Form::label('unit_id', __('Unit'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::select('unit_id', $unit,null, array('class' => 'form-control select','required'=>'required'))); ?>

            <div class=" text-xs mt-1">
                <?php echo e(__('Create unit here. ')); ?><a href="<?php echo e(route('product-unit.index')); ?>"><b><?php echo e(__('Create unit')); ?></b></a>
            </div>
        </div>
        <div class="col-md-6 form-group">
            <?php echo e(Form::label('pro_image',__('Product Image'),['class'=>'form-label'])); ?>

            <div class="choose-file ">
                <label for="pro_image" class="form-label">
                    <input type="file" class="form-control file-validate" name="pro_image" id="pro_image" data-filename="pro_image_create">
                <p id="" class="file-error text-danger"></p>
                    <img id="image" class="mt-3" style="width:25%;"/>
                </label>
            </div>
        </div>



        <div class="col-md-6">
            <div class="form-group">
                <div class="btn-box">
                    <label class="d-block form-label"><?php echo e(__('Type')); ?></label>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input type" id="customRadio5" name="type" value="product" checked="checked" >
                                <label class="custom-control-label form-label" for="customRadio5"><?php echo e(__('Product')); ?></label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-check form-check-inline">
                                <input type="radio" class="form-check-input type" id="customRadio6" name="type" value="service" >
                                <label class="custom-control-label form-label" for="customRadio6"><?php echo e(__('Service')); ?></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="form-group col-md-6 quantity">
            <?php echo e(Form::label('quantity', __('Quantity'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
            <?php echo e(Form::text('quantity',null, array('class' => 'form-control', 'required'=>'required', 'placeholder' => __('Enter Quantity')))); ?>

        </div>

        <div class="form-group col-md-12">
            <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

            <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2', 'placeholder' => __('Enter Description')]); ?>

        </div>

        <?php if(!$customFields->isEmpty()): ?>
                    <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn  btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn  btn-primary">
</div>
<?php echo e(Form::close()); ?>



<script>
    document.getElementById('pro_image').onchange = function () {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }

    //hide & show quantity

    $(document).on('click', '.type', function ()
    {
        var type = $(this).val();
        if (type == 'product') {
            $('.quantity').removeClass('d-none')
            $('.quantity').addClass('d-block');
            $('input[name="quantity"]').prop('required', true);
        } else {
            $('.quantity').addClass('d-none')
            $('.quantity').removeClass('d-block');
            $('input[name="quantity"]').val('').prop('required', false);
        }
    });

    function generateSKU(){
        var sku = 'SKU-' + Math.random().toString(24).substr(2, 7);
        $('input[name=sku]').val(sku.toUpperCase());
    }
</script>
<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/productservice/create.blade.php ENDPATH**/ ?>