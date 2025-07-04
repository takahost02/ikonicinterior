@extends('layouts.admin')
@section('page-title')
    {{ __('Journal Entry Create') }}
@endsection

@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">{{ __('Dashboard') }}</a></li>
    <li class="breadcrumb-item">{{ __('Double Entry') }}</li>
    <li class="breadcrumb-item">{{ __('Journal Entry') }}</li>
@endsection

@push('script-page')
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/jquery.repeater.min.js') }}"></script>
    <script>
        var selector = "body";
        if ($(selector + " .repeater").length) {
            // var $dragAndDrop = $("body .repeater tbody").sortable({
            //     handle: '.sort-handler'
            // });
            var $repeater = $(selector + ' .repeater').repeater({
                initEmpty: false,
                defaultValues: {
                    'status': 1
                },
                show: function() {
                    $(this).slideDown();
                    var file_uploads = $(this).find('input.multi');
                    if (file_uploads.length) {
                        $(this).find('input.multi').MultiFile({
                            max: 3,
                            accept: 'png|jpg|jpeg',
                            max_size: 2048
                        });
                    }
                    if ($('.select2').length) {
                        $('.select2').select2();
                    }
                },
                hide: function(deleteElement) {
                    if (confirm('Are you sure you want to delete this element?')) {
                        $(this).slideUp(deleteElement);
                        $(this).remove();

                        var inputs = $(".debit");
                        var totalDebit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalDebit').html(totalDebit.toFixed(2));


                        var inputs = $(".credit");
                        var totalCredit = 0;
                        for (var i = 0; i < inputs.length; i++) {
                            totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
                        }
                        $('.totalCredit').html(totalCredit.toFixed(2));


                    }
                },
                ready: function(setIndexes) {
                    // $dragAndDrop.on('drop', setIndexes);
                },
                isFirstItemUndeletable: true
            });
            var value = $(selector + " .repeater").attr('data-value');

            if (typeof value != 'undefined' && value.length != 0) {
                value = JSON.parse(value);
                $repeater.setList(value);
                for (var i = 0; i < value.length; i++) {
                    var tr = $('#sortable-table .id[value="' + value[i].id + '"]').parent();
                    tr.find('.item').val(value[i].product_id);
                    changeItem(tr.find('.item'));
                }
            }

        }

        $(document).on('keyup', '.debit', function() {
            var el = $(this).parent().parent().parent().parent();
            var debit = $(this).val();
            var credit = 0;
            el.find('.credit').val(credit);
            el.find('.amount').html(debit);


            var inputs = $(".debit");
            var totalDebit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalDebit = parseFloat(totalDebit) + parseFloat($(inputs[i]).val());
            }
            $('.totalDebit').html(totalDebit.toFixed(2));

            el.find('.credit').attr("disabled", true);
            if (debit == '') {
                el.find('.credit').attr("disabled", false);
            }
        })

        $(document).on('keyup', '.credit', function() {
            var el = $(this).parent().parent().parent().parent();
            var credit = $(this).val();
            var debit = 0;
            el.find('.debit').val(debit);
            el.find('.amount').html(credit);

            var inputs = $(".credit");
            var totalCredit = 0;
            for (var i = 0; i < inputs.length; i++) {
                totalCredit = parseFloat(totalCredit) + parseFloat($(inputs[i]).val());
            }
            $('.totalCredit').html(totalCredit.toFixed(2));

            el.find('.debit').attr("disabled", true);
            if (credit == '') {
                el.find('.debit').attr("disabled", false);
            }
        })
    </script>
@endpush
@php
    $chatGPT = \App\Models\Utility::settings('enable_chatgpt');
    $enable_chatgpt = !empty($chatGPT);
@endphp
@section('content')
    {{ Form::open(['url' => 'journal-entry', 'class' => 'w-100 needs-validation','novalidate']) }}
    <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
    <div class="row mt-4">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        @if ($enable_chatgpt)
                            <div>
                                <a href="#" data-size="md" data-ajax-popup-over="true"
                                    data-url="{{ route('generate', ['journal account']) }}" data-bs-toggle="tooltip"
                                    data-bs-placement="top" title="{{ __('Generate') }}"
                                    data-title="{{ __('Generate content with AI') }}"
                                    class="btn btn-primary btn-sm float-end">
                                    <i class="fas fa-robot"></i>
                                    {{ __('Generate with AI') }}
                                </a>
                            </div>
                        @endif
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                {{ Form::label('journal_number', __('Journal Number'), ['class' => 'form-label']) }}
                                <div class="form-icon-user">
                                    <input type="text" class="form-control"
                                        value="{{ \Auth::user()->journalNumberFormat($journalId) }}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                {{ Form::label('date', __('Transaction Date'), ['class' => 'form-label']) }}<x-required></x-required>
                                <div class="form-icon-user">
                                    {{ Form::date('date', date('Y-m-d'), ['class' => 'form-control', 'required' => 'required']) }}

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <div class="form-group">
                                {{ Form::label('reference', __('Reference'), ['class' => 'form-label']) }}
                                <div class="form-icon-user">
                                    <span><i class="ti ti-joint"></i></span>
                                    {{ Form::text('reference', '', ['class' => 'form-control', 'placeholder'=>__('Enter Reference')]) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8 col-md-8">
                            <div class="form-group">
                                {{ Form::label('description', __('Description'), ['class' => 'form-label']) }}
                                {{ Form::textarea('description', '', ['class' => 'form-control', 'rows' => '3', 'placeholder'=>__('Enter Description')]) }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card repeater">
                <div class="item-section py-4">
                    <div class="row justify-content-between align-items-center">
                        <div class="col-md-12 d-flex align-items-center justify-content-between justify-content-md-end">
                            <a href="#" data-repeater-create="" class="btn btn-primary mr-2" data-toggle="modal"
                                data-target="#add-bank">
                                <i class="ti ti-plus"></i> {{ __('Add Accounts') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body table-border-style">
                    <div class="table-responsive">
                        <table class="table mb-0" data-repeater-list="accounts" id="sortable-table">
                            <thead>
                                <tr>
                                    <th>{{ __('Account') }}</th>
                                    <th>{{ __('Debit') }}</th>
                                    <th>{{ __('Credit') }} </th>
                                    <th>{{ __('Description') }}</th>
                                    <th class="text-end">{{ __('Amount') }} </th>
                                    <th width="2%"></th>
                                </tr>
                            </thead>

                            <tbody class="ui-sortable" data-repeater-item>
                                <tr>
                                    <td width="25%" class="form-group pt-0">
                                        {{ Form::select('account', $accounts, '', ['class' => 'form-control select', 'required' => 'required']) }}

                                    </td>

                                    <td>
                                        <div class="form-group price-input">
                                            {{ Form::text('debit', '', ['class' => 'form-control debit', 'required' => 'required', 'placeholder' => __('Debit'), 'required' => 'required']) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group price-input">
                                            {{ Form::text('credit', '', ['class' => 'form-control credit', 'required' => 'required', 'placeholder' => __('Credit'), 'required' => 'required']) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            {{ Form::text('description', '', ['class' => 'form-control', 'placeholder' => __('Description')]) }}
                                        </div>
                                    </td>
                                    <td class="text-end amount">0.00</td>
                                    <td>
                                        <a href="#" class="ti ti-trash text-white text-danger"
                                            data-repeater-delete></a>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td></td>
                                    <td class="text-end"><strong>{{ __('Total Credit') }}
                                            ({{ \Auth::user()->currencySymbol() }})</strong></td>
                                    <td class="text-end totalCredit">0.00</td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td class="text-end"><strong>{{ __('Total Debit') }}
                                            ({{ \Auth::user()->currencySymbol() }})</strong></td>
                                    <td class="text-end totalDebit">0.00</td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal-footer">
        <input type="button" value="{{ __('Cancel') }}" onclick="location.href = '{{ route('journal-entry.index') }}';"
            class="btn btn-light me-2">
        <input type="submit" value="{{ __('Create') }}" class="btn btn-primary">
    </div>
    {{ Form::close() }}
@endsection
