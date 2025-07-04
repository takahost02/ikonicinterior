{{ Form::open(array('route' => array('add.bill.payment', $bill->id),'method'=>'post','enctype' => 'multipart/form-data')) }}
<div class="modal-body">

    <div class="row">
        <div class="form-group col-md-6">
            {{ Form::label('date', __('Date'),['class'=>'form-label']) }}
            <div class="form-icon-user">
                {{Form::date('date',null,array('class'=>'form-control','required'=>'required'))}}
                <!-- {{ Form::text('date', null, array('class' => 'form-control pc-datepicker-1','required'=>'required')) }} -->
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label']) }}
            <div class="form-icon-user">
                {{ Form::text('amount',$bill->getDue(), array('class' => 'form-control','required'=>'required', 'placeholder'=>__('Enter Amount'))) }}
            </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('account_id', __('Account'),['class'=>'form-label']) }}
            {{ Form::select('account_id',$accounts,null, array('class' => 'form-control', 'required'=>'required')) }}
        </div>

        <div class="form-group col-md-6">
            {{ Form::label('reference', __('Reference'),['class'=>'form-label']) }}
            <div class="form-icon-user">
                {{ Form::text('reference', '', array('class' => 'form-control', 'placeholder'=>__('Enter Reference'))) }}
            </div>
        </div>
        <div class="form-group  col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {{ Form::textarea('description', '', array('class' => 'form-control','rows'=>3, 'placeholder'=>__('Enter Description'))) }}
        </div>

        <div class="form-group col-md-12">
            {{ Form::label('add_receipt', __('Payment Receipt'), ['class' => 'form-label']) }}
            <div class="choose-file form-group">
                    <input type="file" name="add_receipt" id="files" class="form-control file-validate" data-filename="upload_file" >
                    <span id="" class="file-error text-danger"></span>
                    <img id="image" class="mt-2 border border-primary" src="{{asset(Storage::url('uploads/defualt/defualt.png'))}}" width="120" height="120" />
            </div>
        </div>
    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Add')}}" class="btn btn-primary">
</div>
{{ Form::close() }}
<script>
    document.querySelector(".pc-datepicker-1").flatpickr({
        mode: "range"
    });
</script>
<script>
    document.getElementById('files').onchange = function() {
        var src = URL.createObjectURL(this.files[0])
        document.getElementById('image').src = src
    }
</script>