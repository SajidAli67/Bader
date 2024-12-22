@php
$file_validation = App\Models\Utility::file_upload_validation();
@endphp
@extends('layouts.app')


@section('page-title', __('Client'))


@section('breadcrumb')

<li class="breadcrumb-item">{{ __('Client') }}</li>

@endsection

@section('content')

{{ Form::open(['route' => 'client.store', 'class' => 'frm-submit-data', 'method' => 'post', 'autocomplete' => 'off', 'enctype' => 'multipart/form-data']) }}
<div class="row g-0 pt-0">
    <div class="col-md-1"></div>
    <div class="col-lg-10">
        <div class="card shadow-none rounded-0 border">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-md-12">
                        {!! Form::label('name', __('Name'), ['class' => 'form-label required-sym']) !!}
                        {!! Form::text('name', null, ['class' => 'form-control']) !!}

                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::label('mobile', __('Mobile Number'), ['class' => 'form-label required-sym']) !!}
                        {!! Form::number('mobile', null, ['class' => 'form-control', 'maxlength' => '10', 'minlength' => '10', 'pattern' => '\d{10}' ,'placeholder'=>__('Enter Your Mobile Number')]) !!}
                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::checkbox('isWhatsapp', 1, false, [ 'class'=>'form-check-input', 'id' => 'isWhatsapp']) !!}
                        {!! Form::label('isWhatsapp', __('Same as Mobile Number'), ['class' => 'form-label']) !!}
                    </div>

                    <div class="form-group col-md-12 whatsapp_number">
                        {!! Form::label('whatsapp_number', __('WhatsApp Number'), ['class' => 'form-label','id' => 'whatsapp_number' ]) !!}
                        {!! Form::number('whatsapp_number', null, ['class' => 'form-control','maxlength' => '10', 'minlength' => '10', 'pattern' => '\d{10}']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('id_card', __('ID number'), ['class' => 'form-label','id' => 'id_card' ]) !!}
                        {!! Form::number('id_card', null, ['class' => 'form-control id_card', 'maxlength' => '10', 'minlength' => '10', 'pattern' => '\d{10}']) !!}
                    </div>

                    <div class="form-group col-md-6">
                        {!! Form::label('identity_type', __('Identity type'), ['class' => 'form-label','id' => 'identity_type' ]) !!}
                        <select name="identity_type" id="identity_type" class="form-control identity_type" disabled>
                            <option value="">{{ __('Select type')}}</option>
                            <option value="citizen">{{__('citizen')}}</option>
                            <option value="resident">{{__('resident')}}</option>
                            <option value="visitor">{{__('visitor')}}</option>
                            <option value="commercial_register">{{__('Commercial register')}}</option>
                        </select>
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('experie_date', __('Experie Date'), ['class' => 'col-form-label required-sym']) }}
                        {{ Form::date('experie_date', '2025-01-01', ['class' => 'form-control', 'required' => 'required']) }}
                    </div>

                    <div class="form-group col-md-6">
                        {{ Form::label('dob', __('Date Of Birth'), ['class' => 'col-form-label required-sym']) }}
                        {{ Form::date('dob', '2000-01-01', ['class' => 'form-control', 'required' => 'required']) }}
                    </div>

                    <div class="form-group col-md-12 vat">
                        {{ Form::label('vat', __('VAT'), ['class' => 'col-form-label']) }}
                        {{ Form::number('vat', '', ['class' => 'form-control']) }}
                    </div>

                    <div class="form-group col-md-12">
                        {{ Form::label('Email', __('Email'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('email', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::radio('address_type', 'short', ['class' => 'form-check-input']); !!}
                        {{ Form::label('address_type', __('Short Address'), ['class' => 'form-label']) }}

                        {!! Form::radio('address_type', 'full',['class' => 'form-check-input'] ); !!}
                        {{ Form::label('address_type', __('Full Address'), ['class' => 'form-label']) }}

                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('city', __('City'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('city', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('distric', __('distric'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('distric', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('secondary_code', __('Secondary Code'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('secondary_code', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('street', __('Street'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('street', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('building_number', __('Building Number'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('building_number', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-6 full-address">
                        {{ Form::label('postcode', __('Postcode'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('postcode', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group col-md-12 short-address">
                        {{ Form::label('address_shortcode', __('Address Shortcode'), ['class' => 'form-label required-sym']) }}
                        {!! Form::text('address_shortcode', null, ['class' => 'form-control']) !!}
                    </div>



                    <div class="form-group col-md-12">
                        {!! Form::label('password', __('Password'), ['class' => 'form-label']) !!}
                        {{Form::password('password',array('class'=>'form-control','placeholder'=>__('Enter User Password'),'minlength'=>"8", 'autocomplete' => 'new-password'))}}
                        <span class="small">{{__('Minimum 8 characters')}}</span>
                    </div>

                    <div class="form-group col-md-12">
                        {!! Form::label('branch', __('Branch'), ['class' => 'form-label']) !!}
                        <select class="form-control" id="branch" name="branch">
                            <option value="">{{ __('Select Branch') }}</option>
                            @foreach($branches as $branch)
                            @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                            <option value="{{ $branch->id }}" {{\Auth::user()->branch_id==$branch->id ? 'selected'  : '' }}>{{ $branch->name }}</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-4 choose-files fw-semibold ">


                        <label for="address_file" class="upload__btn">

                            {{ Form::label('case_docs', __('Attach Address'), ['class' => 'col-form-label']) }}



                            <input type="file" name="address_file" id="address_file"
                                class="form-control " multiple />

                        </label>

                    </div>

                    <div class="col-md-4 choose-files fw-semibold ">

                        <label for="id_file" class="upload__btn">

                            {{ Form::label('case_docs', __('Id Card '), ['class' => 'col-form-label']) }}

                            <input type="file" name="id_card_file" id="id_card_file" class="form-control" multiple />

                        </label>
                    </div>
                    
                    <div class="dropzone" id="imageUpload"></div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-md-1"></div>
    <div class="col-md-1"></div>
    <div class="col-lg-10">
        <div class="card shadow-none rounded-0 border ">
            <div class="card-body p-2">
                <div class="form-group col-12 d-flex justify-content-end col-form-label mb-0">
                    <a href="{{ route('contract') }}" class="btn btn-secondary btn-light ms-3">{{ __('Cancel') }}</a>
                    <input type="submit" value="{{ __('Save') }}" class="btn btn-primary ms-2">
                </div>
            </div>
        </div>
    </div>
</div>
{{Form::close()}}

@endsection


@push('custom-script')
<script>
    $('#isWhatsapp').change(function() {
        if ($(this).is(':checked')) {
            $('.whatsapp_number').slideUp()

        } else {
            $('.whatsapp_number').slideDown()
        }
    });
    $('input[name="address_type"]').change(function() {
        var value = $(this).val();
        if (value == 'short') {

            $('.full-address').slideUp()
            $('.short-address').slideDown()
        } else {
            $('.full-address').slideDown()
            $('.short-address').slideUp()
        }
    });
    $('.short-address').slideUp();
    $('.vat').slideUp();

    $('.id_card').keyup(function() {
        const val = $(this).val();
        var first_digi = val[0]
        if (first_digi == '1') {
            $('.identity_type').val('citizen')
        } else if (first_digi == '2') {
            $('.identity_type').val('resident')
        } else if (first_digi == '3') {
            $('.identity_type').val('visitor')
        } else if (first_digi == '3') {
            $('.identity_type').val('visitor')
        } else if (first_digi == '4') {
            $('.identity_type').val('visitor')
        } else if (first_digi == '7') {
            $('.identity_type').val('commercial_register');
            $('.vat').slideDown();
        } else {
            $('.identity_type').val('')
        }

    })
    $('addFile').click(function() {
        $html = `<div class="col-md-4 choose-files fw-semibold ">

                        <label for="id_file" class="upload__btn">

                            {{ Form::label('case_docs', __('Id Card '), ['class' => 'col-form-label']) }}
                            
                            <input type="file" name="id_card_file" id="id_card_file" class="form-control"  multiple />

                        </label>
                    </div>`;
    })
</script>
@endpush