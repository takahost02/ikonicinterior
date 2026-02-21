<?php echo e(Form::open(array('url'=>'customer','method'=>'post', 'class'=>'needs-validation', 'novalidate'))); ?>

<div class="modal-body">

    <h5 class="sub-title"><?php echo e(__('Basic Info')); ?></h5>
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('name',__('Name'),array('class'=>'form-label'))); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                <?php echo e(Form::text('name',null,array('class'=>'form-control','required'=>'required' ,'placeholder'=>__('Enter Name')))); ?>

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php if (isset($component)) { $__componentOriginal5d1845474bd0b0647eed674e26ea3910 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5d1845474bd0b0647eed674e26ea3910 = $attributes; } ?>
<?php $component = App\View\Components\Mobile::resolve(['label' => ''.e(__('Contact')).'','name' => 'contact','value' => ''.e(old('contact')).'','required' => true,'placeholder' => 'Enter Contact'] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('mobile'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Mobile::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?> <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5d1845474bd0b0647eed674e26ea3910)): ?>
<?php $attributes = $__attributesOriginal5d1845474bd0b0647eed674e26ea3910; ?>
<?php unset($__attributesOriginal5d1845474bd0b0647eed674e26ea3910); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5d1845474bd0b0647eed674e26ea3910)): ?>
<?php $component = $__componentOriginal5d1845474bd0b0647eed674e26ea3910; ?>
<?php unset($__componentOriginal5d1845474bd0b0647eed674e26ea3910); ?>
<?php endif; ?>
            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('email',__('Email'),['class'=>'form-label'])); ?><?php if (isset($component)) { $__componentOriginaleab1765d328ab3f8835fc5d78676a070 = $component; } ?>
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
                <?php echo e(Form::email('email',null,array('class'=>'form-control' , 'placeholder'=>__('Enter email'),'required'=>'required'))); ?>


            </div>
        </div>

        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('tax_number',__('Tax Number'),['class'=>'form-label'])); ?>

                <?php echo e(Form::text('tax_number',null,array('class'=>'form-control' , 'placeholder' => __('Enter Tax Number')))); ?>

            </div>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('balance',__('Balance'),['class'=>'form-label'])); ?>

                <?php echo e(Form::number('balance',null,array('class'=>'form-control' , 'placeholder' => __('Enter Balance')))); ?>

            </div>
        </div>
        <?php if(!$customFields->isEmpty()): ?>
                    <?php echo $__env->make('customFields.formBuilder', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <?php endif; ?>
    </div>

    <h5 class="sub-title"><?php echo e(__('Billing Address')); ?></h5>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_name',__('Name'),array('class'=>'','class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_name',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Name')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_phone',__('Phone'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_phone',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Phone')))); ?>

            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group">
                <?php echo e(Form::label('billing_address',__('Address'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::textarea('billing_address',null,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))); ?>


            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_city',__('City'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_city',null,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))); ?>


            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_state',__('State'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_state',null,array('class'=>'form-control' , 'placeholder' => __('Enter State')))); ?>

            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_country',__('Country'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_country',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Country')))); ?>

            </div>
        </div>

        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php echo e(Form::label('billing_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                <?php echo e(Form::text('billing_zip',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Zip Code')))); ?>


            </div>
        </div>

    </div>

    <?php if(App\Models\Utility::getValByName('shipping_display')=='on'): ?>
        <div class="col-md-12 text-end">
            <input type="button" id="billing_data" value="<?php echo e(__('Shipping Same As Billing')); ?>" class="btn btn-primary">
        </div>
        <h5 class="sub-title"><?php echo e(__('Shipping Address')); ?></h5>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_name',__('Name'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_name',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Name')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_phone',__('Phone'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_phone',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Phone')))); ?>


                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_address',__('Address'),array('class'=>'form-label'))); ?>

                    <label class="form-label" for="example2cols1Input"></label>
                    <?php echo e(Form::textarea('shipping_address',null,array('class'=>'form-control','rows'=>3 , 'placeholder'=>__('Enter Address')))); ?>


                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_city',__('City'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_city',null,array('class'=>'form-control' , 'placeholder'=>__('Enter City')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_state',__('State'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_state',null,array('class'=>'form-control' , 'placeholder'=>__('Enter State')))); ?>


                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_country',__('Country'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_country',null,array('class'=>'form-control' , 'placeholder'=>__('Enter Country')))); ?>


                </div>
            </div>


            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="form-group">
                    <?php echo e(Form::label('shipping_zip',__('Zip Code'),array('class'=>'form-label'))); ?>

                    <?php echo e(Form::text('shipping_zip',null,array('class'=>'form-control' , 'placeholder' => __('Enter Zip Code')))); ?>


                </div>
            </div>

        </div>
    <?php endif; ?>

</div>
<div class="modal-footer">
    <input type="button" value="<?php echo e(__('Cancel')); ?>" class="btn btn-secondary" data-bs-dismiss="modal">
    <input type="submit" value="<?php echo e(__('Create')); ?>" class="btn btn-primary">
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /home/ikonicinterior/accounts.ikonicinterior.com/resources/views/customer/create.blade.php ENDPATH**/ ?>