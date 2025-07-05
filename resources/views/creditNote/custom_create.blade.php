{{ Form::open(array('route' => array('invoice.custom.credit.note.store'),'mothod'=>'post','class'=>'needs-validation','novalidate')) }}
<div class="modal-body">
    <div class="row">
        <div class="col-md-12">
            {{ Form::label('invoice', __('Invoice'),['class'=>'form-label']) }}<x-required></x-required>
                <select class="form-control select" required="required" id="invoice" name="invoice">
                    <option value="0">{{__('Select Invoice')}}</option>
                    @foreach($invoices as $key=>$invoice)
                        <option value="{{$key}}">{{\Auth::user()->invoiceNumberFormat($invoice)}}</option>
                    @endforeach
                </select>
                <div class="text-xs mt-1">
                    {{ __('Create invoice here.') }} <a href="{{ route('invoice.index') }}"><b>{{ __('Create invoice') }}</b></a>
                </div>
        </div>
        <div class="form-group col-md-6">
            {{ Form::label('amount', __('Amount'),['class'=>'form-label']) }}<x-required></x-required>
            <div class="form-icon-user">
                {{ Form::number('amount', null, array('class' => 'form-control','required'=>'required','step'=>'0.01', 'placeholder'=>__('Enter Amount'))) }}
            </div>
        </div>
        <div class="form-group  col-md-6">
            {{ Form::label('date', __('Date'),['class'=>'form-label']) }}<x-required></x-required>
            <div class="form-icon-user">
                {{Form::date('date',date('Y-m-d'),array('class'=>'form-control','required'=>'required'))}}


            </div>
        </div>
        <div class="form-group col-md-12">
            {{ Form::label('description', __('Description'),['class'=>'form-label']) }}
            {!! Form::textarea('description', null, ['class'=>'form-control','rows'=>'3', 'placeholder'=>__('Enter Description')]) !!}
        </div>

    </div>
</div>
<div class="modal-footer">
    <input type="button" value="{{__('Cancel')}}" class="btn  btn-light" data-bs-dismiss="modal">
    <input type="submit" value="{{__('Create')}}" class="btn  btn-primary">
</div>
{{ Form::close() }}
