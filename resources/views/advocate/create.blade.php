@extends('layouts.app')

@section('page-title', __('Add Advocate'))


@section('breadcrumb')
<li class="breadcrumb-item">{{ __(' Add Advocate') }}</li>
@endsection
@php
$settings = App\Models\Utility::settings();
@endphp
@section('content')

{{ Form::open(['route' => 'advocate.store','method' => 'post', 'class' => 'frm-submit-data', 'id' => 'frmTarget', 'enctype' => 'multipart/form-data', 'autocomplete' => 'off']) }}
<div class="row g-0 p-0">
    <div class="col-md-1"></div>
    <div class="col-lg-10">
        <div class="p-3">
            <div class="card shadow-none rounded-0 border">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {{ Form::label('name', __('Firm/Advocate Name'), ['class' => 'col-form-label required-sym']) }}
                                {{ Form::text('name',  old('name'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {{ Form::label('email', __('Email Address'), ['class' => 'col-form-label required-sym']) }}
                                {{ Form::text('email', old('email'), ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {{ Form::label('password', __('Password'), ['class' => 'col-form-label required-sym']) }}
                                <input class="form-control" id="password" type="password" name="password"  pattern=".{8,}" minlength="8" autocomplete='new-password'>
                                <span class="small">{{__('Minimum 8 characters')}}</span>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                {{ Form::label('phone_number', __('Phone Number'), ['class' => 'col-form-label required-sym']) }}
                                {{ Form::text('phone_number', null, ['class' => 'form-control']) }}
                            </div>
                        </div>



                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('age', __('Age'), ['class' => 'col-form-label']) }}
                                {{ Form::number('age', null, ['class' => 'form-control']) }}
                            </div>
                        </div>


                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('company_name', __('Company Name'), ['class' => 'col-form-label']) }}
                                {{ Form::text('company_name', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('bank_details', __('Bank Details'), ['class' => 'col-form-label']) !!}
                                {{ Form::textarea('bank_details', null, ['class' => 'form-control', 'rows' => '1']) }}
                            </div>
                            <small class="text-xs">
                                {{ __('Example : Bank : Bank Name <br> Account Number : 0000 0000 <br>') }}.
                            </small>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {!! Form::label('password', __('Branch'), ['class' => 'col-form-label required-sym']) !!}
                                <select class="form-control " id="branch" name="branch" >
                                    <option value="">{{ __('Select Branch') }}</option>
                                    @foreach($branches as $branch)
                                        @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>



                        <div class="card-header">
                            <div class="row flex-grow-1">
                                <div class="col-md d-flex align-items-center">
                                    <h5 class="card-header-title">
                                        {{ __('Office Address') }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('ofc_address_line_1', __('Address Line 1'), ['class' =>
                                'col-form-label']) }}
                                {{ Form::text('ofc_address_line_1', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('ofc_address_line_2', __('Address Line 2'), ['class' =>
                                'col-form-label']) }}
                                {{ Form::text('ofc_address_line_2', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('country', __('Country'), ['class' => 'col-form-label ']) }}
                                <select class="form-control" id="country" name="ofc_country">
                                    <option value="">{{ __('Select Country') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('state', __('State'), ['class' => 'col-form-label']) }}
                                <select class="form-control" id="state" name="ofc_state">
                                    <option value="">{{ __('Select State') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                {{ Form::text('ofc_city', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('zip_code', __('Zip/Postal Code'), ['class' => 'col-form-label']) }}
                                {{ Form::number('ofc_zip_code', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="card-header">
                            <div class="row flex-grow-1">
                                <div class="col-md d-flex align-items-center">
                                    <h5 class="card-header-title">
                                        {{ __('Chamber Address') }}
                                    </h5>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('home_address_line_1', __('Address Line 1'), ['class' =>
                                'col-form-label']) }}
                                {{ Form::text('home_address_line_1', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('home_address_line_2', __('Address Line 2'), ['class' =>
                                'col-form-label']) }}
                                {{ Form::text('home_address_line_2', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('country', __('Country'), ['class' => 'col-form-label']) }}
                                <select class="form-control" id="home_country" name="home_country">
                                    <option value="">{{ __('Select Country') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('state', __('State'), ['class' => 'col-form-label']) }}
                                <select class="form-control" id="home_state" name="home_state">
                                    <option value="">{{ __('Select State') }}</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                {{ Form::text('home_city', null, ['class' => 'form-control']) }}
                            </div>
                        </div>

                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <div class="form-group">
                                {{ Form::label('zip_code', __('Zip/Postal Code'), ['class' => 'col-form-label']) }}
                                {{ Form::number('home_zip_code', null, ['class' => 'form-control']) }}
                            </div>
                        </div>
                        


                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-lg-10">
        <div class="p-3">
            <div class="card shadow-none rounded-0 border ">
                <div class="card-body p-2">
                    <div class="form-group col-12 d-flex justify-content-end col-form-label mb-0">

                        <a href="{{ route('advocate.index') }}" class="btn btn-secondary btn-light ms-3">{{ __('Cancel') }}</a>
                        <button type="submit" id="advocate-store" class="btn btn-primary ms-2"> {{ __('Save') }}</button>
                       
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
{{ Form::close() }}
<!-- [ Main Content ] end -->
@endsection


@push('custom-script')
<script>
    $(document).ready(function() {

        $.ajax({
            url: "{{ route('get.country') }}",
            type: "GET",
            success: function(result) {
                $.each(result.data, function(key, value) {
                    $("#country,#home_country").append('<option value="' + value.id + '">' + value
                        .country + "</option>");

                });
            },
        });


        $("#country").on("change", function() {
            var country_id = this.value;
            $("#state").html("");
            $.ajax({
                url: "{{ route('get.state') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(result) {
                    $.each(result.data, function(key, value) {
                        $("#state").append('<option value="' + value.id + '">' +
                            value.region + "</option>");
                    });
                    $("#city").html('<option value="">Select State First</option>');
                },
            });
        });

        $("#home_country").on("change", function() {
            var country_id = this.value;
            $("#home_state").html("");
            $.ajax({
                url: "{{ route('get.state') }}",
                type: "POST",
                data: {
                    country_id: country_id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(result) {
                    $.each(result.data, function(key, value) {
                        $("#home_state").append('<option value="' + value.id + '">' +
                            value.region + "</option>");
                    });
                    $("#home_city").html('<option value="">Select State First</option>');
                },
            });
        });

        $("#state").on("change", function() {
            var state_id = this.value;
            $("#city").html("");
            $.ajax({
                url: "{{ route('get.city') }}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(result) {
                    $.each(result.data, function(key, value) {
                        $("#city").append('<option value="' + value.id + '">' +
                            value.city + "</option>");
                    });
                },
            });
        });

        $("#home_state").on("change", function() {
            var state_id = this.value;
            $("#home_city").html("");
            $.ajax({
                url: "{{ route('get.city') }}",
                type: "POST",
                data: {
                    state_id: state_id,
                    _token: "{{ csrf_token() }}",
                },
                dataType: "json",
                success: function(result) {
                    $.each(result.data, function(key, value) {
                        $("#home_city").append('<option value="' + value.id + '">' +
                            value.city + "</option>");
                    });
                },
            });
        });
    });
</script>

<script src="{{ asset('public/assets/js/jquery-ui.js') }}"></script>
<script src="{{ asset('public/assets/js/repeater.js') }}"></script>
<script>
    var selector = "body";
    if ($(selector + " .repeater").length) {
        var $dragAndDrop = $("body .repeater tbody").sortable({
            handle: '.sort-handler'
        });
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
                    if ($('.disc_qty').length < 6) {
                        $(".add-row").show();

                    }
                    $(this).slideUp(deleteElement);
                    $(this).remove();

                    var inputs = $(".amount");
                    var subTotal = 0;
                    for (var i = 0; i < inputs.length; i++) {
                        subTotal = parseFloat(subTotal) + parseFloat($(inputs[i]).html());
                    }
                    $('.subTotal').html(subTotal.toFixed(2));
                    $('.totalAmount').html(subTotal.toFixed(2));
                }
            },
            ready: function(setIndexes) {
                $dragAndDrop.on('drop', setIndexes);
            },
            isFirstItemUndeletable: true
        });
        var value = $(selector + " .repeater").attr('data-value');
        if (typeof value != 'undefined' && value.length != 0) {
            value = JSON.parse(value);
            $repeater.setList(value);
        }

    }

    $(".add-row").on('click', function(event) {
        var $length = $('.disc_qty').length;
        if ($length == 5) {
            $(this).hide();
        }
    });

    $(".desc_delete").on('click', function(event) {

        var $length = $('.disc_qty').length;
    });
</script>

{{-- validation --}}
<!-- <script>
    $('#advocate-store').on('click', function() {
        let passwordValue = $("#password").val();
        if (passwordValue.length < 8) {
            show_toastr('Error', 'Password filed must contain 8 characters.', 'error')
            return false;
        }
    })
</script> -->
@endpush