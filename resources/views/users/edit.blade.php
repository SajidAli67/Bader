@php
$file_validation = App\Models\Utility::file_upload_validation();
@endphp
@extends('layouts.app')
@if ($user->id == Auth::user()->id)
@section('page-title', __('Profile'))
@else
@section('page-title', __('Edit Member'))
@endif


@php
$logo = asset('storage/uploads/profile/');
$settings = App\Models\Utility::settings();
@endphp
@section('breadcrumb')
@if ($user->id == Auth::user()->id)
<li class="breadcrumb-item">{{ __('Profile') }}</li>
@else
<li class="breadcrumb-item">{{ __('Edit Member') }}</li>
@endif
@endsection

@section('content')
<div class="row p-0 g-0">

    <div class="col-sm-12">
        <div class="row g-0">
            <div class="col-xl-3 border-end border-bottom">
                <div class="card shadow-none bg-transparent sticky-top" style="top:70px">
                    <div class="list-group list-group-flush rounded-0" id="useradd-sidenav">
                        <a href="#useradd-1" class="list-group-item list-group-item-action">{{ __('Information') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        @if ($user->id == Auth::user()->id)
                        <a href="#useradd-2"
                            class="list-group-item list-group-item-action">{{ __('Change Password') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        @endif

                        @if ((Auth::user()->type == 'super admin' && $user->id != Auth::user()->id) )
                        <a href="#useradd-3"
                            class="list-group-item list-group-item-action">{{ __('Usage Statistics') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        <a href="#useradd-4" class="list-group-item list-group-item-action">{{ __('Employees') }}
                            <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                        </a>
                        @endif
                    </div>
                </div>
            </div>


            <div class="col-xl-9">
                <div id="useradd-1" class="card  shadow-none rounded-0 border-bottom">

                    <div class="card-header">
                        @if (Auth::user()->id == 1)
                        <h5 class="mb-0">{{ __('Personal Information') }}</h5>
                        @else
                        <h5 class="mb-0">{{ __('Member Information') }}</h5>
                        @endif
                    </div>
                    <div class="card-body">

                        {{ Form::model($user, ['route' => ['users.update', $user->id], 'class' => 'frm-submit-data', 'method' => 'PUT', 'enctype' => 'multipart/form-data']) }}
                        <div class=" setting-card">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6">
                                    <div class="card-body text-center">
                                        <div class="logo-content">

                                            <a href="{{ !empty($user->avatar) ? $logo . '/' . $user : $logo . '/avatar.png' }}"
                                                target="_blank">
                                                <img src="{{ !empty($user->avatar) ? $logo . '/' . $user->avatar : $logo . '/avatar.png' }}"
                                                    width="100" id="profile">
                                            </a>
                                        </div>
                                        <div class="choose-files mt-4">
                                            <label for="profile_pic">
                                                <div class="bg-primary profile_update"
                                                    style="max-width: 100% !important;"> <i
                                                        class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                </div>
                                                <input type="file" class="file" name="profile" accept="image/*"
                                                    id="profile_pic"
                                                    onchange="document.getElementById('profile').src = window.URL.createObjectURL(this.files[0])"
                                                    style="width: 0px !important">
                                                <p style="margin-top: -20px;text-align: center;"><span
                                                        class="text-muted m-0" data-toggle="tooltip"
                                                        title="{{ $file_validation['mimes'] }} {{ __('Max Size: ') }}{{ $file_validation['max_size'] }}"
                                                        data-bs-toggle="tooltip"
                                                        data-bs-placement="top">{{ __('Allowed file extension') }}</span>
                                                </p>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-8 col-sm-6 col-md-6">
                                    <div class="card-body">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                @if($user->type=='company')
                                                <label class="col-form-label text-dark">{{ __('Firm/Advocate Name') }}</label>

                                                @else
                                                <label class="col-form-label text-dark">{{ __('Name') }}</label>
                                                @endif
                                                <input class="form-control " name="name" type="text" id="fullname"
                                                    placeholder="{{ __('Enter Your Name') }}" value="{{ $user->name }}"
                                                    required autocomplete="name">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="email"
                                                    class="col-form-label text-dark">{{ __('Email') }}</label>
                                                <input class="form-control " name="email" type="text"
                                                    id="email" placeholder="{{ __('Enter Your Email Address') }}"
                                                    value="{{ $user->email }}" autocomplete="email" readonly>
                                            </div>
                                        </div>

                                        <div class="col-md-12 {{ ($user->type =='company') ? 'd-none' : '' }}">
                                            {!! Form::label('password', __('Branch'), ['class' => 'form-label']) !!}
                                            <select class="form-control" id="branch" name="branch">
                                                <option value="">{{ __('Select Branch') }}</option>
                                                @foreach($branches as $branch)
                                                @if (\Auth::user()->type == 'super admin' || \Auth::user()->branch_id == $branch->id )
                                                <option value="{{ $branch->id }}" {{ ($branch->id==$user->branch_id) ? 'selected' : ''  }}>{{ $branch->name }}</option>
                                                @endif
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        @if(Auth::user()->type == 'advocate')
                        <div class="row card-body pt-0 pb-0">

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('phone_number', __('Phone Number'), ['class' => 'col-form-label']) }}
                                    {{ Form::number('phone_number', $advocate->phone_number, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('age', __('Age'), ['class' => 'col-form-label']) }}
                                    {{ Form::number('age', $advocate->age, ['class' => 'form-control']) }}
                                </div>
                            </div>



                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('company_name', __('Company Name'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('company_name', $advocate->company_name, ['class' => 'form-control']) }}
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
                                    {{ Form::label('ofc_address_line_1', __('Address Line 1'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('ofc_address_line_1', $advocate->ofc_address_line_1, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('ofc_address_line_2', __('Address Line 2'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('ofc_address_line_2', $advocate->ofc_address_line_2, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('country', __('Country'), ['class' => 'col-form-label']) }}
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
                                        @foreach ($advocate->getStateByCountry($advocate->ofc_country) as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $state->id == $advocate->getSelectedState($advocate->ofc_state) ? 'selected' : '' }}>
                                            {{ $state->region }}
                                        </option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                    <select class="form-control" id="city" name="ofc_city">
                                        <option value="">{{ __('Select City') }}</option>
                                        @foreach ($advocate->getCityByState($advocate->ofc_state) as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $city->id == $advocate->getSelectedCity($advocate->ofc_city) ? 'selected' : '' }}>
                                            {{ $city->city }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('zip_code', __('Zip/Postal Code'), ['class' => 'col-form-label']) }}
                                    {{ Form::number('ofc_zip_code', $advocate->ofc_zip_code, ['class' => 'form-control']) }}
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
                                    {{ Form::label('home_address_line_1', __('Address Line 1'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('home_address_line_1', $advocate->home_address_line_1, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('home_address_line_2', __('Address Line 2'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('home_address_line_2', $advocate->home_address_line_2, ['class' => 'form-control']) }}
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
                                        @foreach ($advocate->getStateByCountry($advocate->home_country) as $state)
                                        <option value="{{ $state->id }}"
                                            {{ $state->id == $advocate->getSelectedState($advocate->home_state) ? 'selected' : '' }}>
                                            {{ $state->region }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                    <select class="form-control" id="home_city" name="home_city">
                                        <option value="">{{ __('Select City') }}</option>
                                        @foreach ($advocate->getCityByState($advocate->home_state) as $city)
                                        <option value="{{ $city->id }}"
                                            {{ $city->id == $advocate->getSelectedCity($advocate->home_city) ? 'selected' : '' }}>
                                            {{ $city->city }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6 col-xs-12">
                                <div class="form-group">
                                    {{ Form::label('zip_code', __('Zip/Postal Code'), ['class' => 'col-form-label']) }}
                                    {{ Form::number('home_zip_code', $advocate->home_zip_code, ['class' => 'form-control']) }}
                                </div>
                            </div>



                            <div class="col-lg-12 text-end mt-2">
                                <input type="submit" value="{{ __('Save Changes') }}"
                                    class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                        @elseif($user->type == 'company')
                        <div class="row card-body pt-0 pb-0">

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('phone_number', __('Phone Number'), ['class' => 'col-form-label']) }}
                                    {{ Form::number('phone_number', $branchDetail->phone, ['class' => 'form-control']) }}
                                </div>
                            </div>

                            <div class="col-md-6 col-sm-6">
                                <div class="form-group">
                                    {{ Form::label('company_mobile', __('Mobile'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('company_mobile',  $branchDetail->mobile, ['class' => 'form-control', 'placeholder' => __('Mobile')]) }}
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('company_vat', __('VAT'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('company_vat',  $branchDetail->vat, ['class' =>
                                        'form-control', 'placeholder' => __('VAT')]) }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-12 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('company_cr', __('C.R'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('company_cr',  $branchDetail->cr, ['class' =>
                                        'form-control', 'placeholder' => __('C.R')]) }}
                                </div>
                            </div>

                            <div class="card-header">
                                <div class="row flex-grow-1">
                                    <div class="col-md d-flex align-items-center">
                                        <h5 class="card-header-title">
                                            {{ __('Address') }}
                                        </h5>
                                    </div>
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('country', __('Country'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('country',  __('Saudi Arabia'), ['class' =>
                                        'form-control','readonly'=>'readonly']) }}
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    {{ Form::label('city', __('City'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('city',  $branchDetail->city, ['class' =>
                                        'form-control', 'placeholder' => __('City')]) }}
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('distric', __('Distric'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('distric',$branchDetail->distric, ['class' =>
                                        'form-control', 'placeholder' => __('Distric')]) }}
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('secondary_code', __('Secondary Code'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('secondary_code', $branchDetail->secondary_code, ['class' =>
                                        'form-control', 'placeholder' => __('Secondary Code')]) }}
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('street', __('Street'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('street', $branchDetail->street, ['class' =>
                                        'form-control', 'placeholder' => __('Street')]) }}
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('building_number', __('Building Number'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('building_number',  $branchDetail->building_number, ['class' =>
                                        'form-control', 'placeholder' => __('Building Number')]) }}
                                </div>
                            </div>

                            <div class="col-lg-4 col-sm-6 col-md-4">
                                <div class="form-group">
                                    {{ Form::label('postcode', __('Postcode'), ['class' => 'col-form-label']) }}
                                    {{ Form::text('postcode', $branchDetail->postcode, ['class' =>
                                        'form-control', 'placeholder' => __('Postcode')]) }}
                                </div>
                            </div>



                            <div class="col-lg-12 text-end mt-2">
                                <input type="submit" value="{{ __('Save Changes') }}"
                                    class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                        @else
                        <div class="row card-body">
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="mobile_number"
                                        class="col-form-label text-dark">{{ __('Mobile Number') }}</label>
                                    <input class="form-control " name="mobile_number" type="number"
                                        id="mobile_number" placeholder="{{ __('Enter Your Mobile Number') }}"
                                        value="{{ !empty($user_detail->mobile_number) ? $user_detail->mobile_number : '' }}"
                                        autocomplete="mobile_number">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="whatsapp"
                                        class="col-form-label text-dark">{{ __('Whatsapp Number') }}</label>
                                    <input class="form-control " name="whatsapp" type="number"
                                        id="whatsapp" placeholder="{{ __('Enter Your Mobile Number') }}"
                                        value="{{ !empty($user_detail->whatsapp) ? $user_detail->whatsapp : '' }}"
                                        autocomplete="whatsapp">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="mobile_number"
                                        class="col-form-label text-dark">{{ __('ID Card') }}</label>
                                    <input class="form-control " name="id_card" type="number"
                                        id="id_card" placeholder="{{ __('Enter Your IC Card') }}"
                                        value="{{ !empty($user_detail->id_card) ? $user_detail->id_card : '' }}"
                                        autocomplete="id_card">
                                </div>
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

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="dob"
                                        class="col-form-label text-dark">{{ __('Date Of Birth') }}</label>
                                    <input class="form-control " name="dob" type="date"
                                        id="dob" placeholder="{{ __('Enter Your Mobile Number') }}"
                                        value="{{ !empty($user_detail->dob) ? $user_detail->dob : '' }}">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="address_shortcode"
                                        class="col-form-label text-dark">{{ __('Address  Shortcode') }}</label>
                                    <input class="form-control " name="address_shortcode" type="text" id="address_shortcode"
                                        placeholder="{{ __('Enter Your Address') }}"
                                        value="{{ !empty($user_detail->address_shortcode) ? $user_detail->address_shortcode : '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="city"
                                        class="col-form-label text-dark">{{ __('City') }}</label>
                                    <input class="form-control " name="city" type="text" id="city"
                                        placeholder="{{ __('Enter Your City') }}"
                                        value="{{ !empty($user_detail->city) ? $user_detail->city : '' }}"
                                        autocomplete="city">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="street"
                                        class="col-form-label text-dark">{{ __('Street') }}</label>
                                    <input class="form-control " name="street" type="text" id="street"
                                        placeholder="{{ __('Enter Your street') }}"
                                        value="{{ !empty($user_detail->street) ? $user_detail->street : '' }}"
                                        autocomplete="street">
                                </div>
                            </div>

                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="distric"
                                        class="col-form-label text-dark">{{ __('Distric') }}</label>
                                    <input class="form-control " name="distric" type="text" id="distric"
                                        placeholder="{{ __('Enter Your distric') }}"
                                        value="{{ !empty($user_detail->distric) ? $user_detail->distric : '' }}"
                                        autocomplete="city">
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="secondary_code"
                                        class="col-form-label text-dark">{{ __('Secondary Code') }}</label>
                                    <input class="form-control " name="secondary_code" type="text" id="secondary_code"
                                        placeholder="{{ __('Enter Your secondary code') }}"
                                        value="{{ !empty($user_detail->secondary_code) ? $user_detail->secondary_code : '' }}">
                                </div>
                            </div>


                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="postcode"
                                        class="col-form-label text-dark">{{ __('postcode') }}</label>
                                    <input class="form-control " name="postcode" type="text" id="postcode"
                                        placeholder="{{ __('Enter Your Postcode') }}"
                                        value="{{ !empty($user_detail->postcode) ? $user_detail->postcode : '' }}">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="zip_code"
                                        class="col-form-label text-dark">{{ __('Zip/Postal Code') }}</label>
                                    <input class="form-control " name="zip_code" type="number" id="zip_code"
                                        placeholder="{{ __('Enter Your Zip/Postal Code') }}"
                                        value="{{ !empty($user_detail->zip_code) ? $user_detail->zip_code : '' }}"
                                        autocomplete="zip_code">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="landmark"
                                        class="col-form-label text-dark">{{ __('Landmark') }}</label>
                                    <input class="form-control " name="landmark" type="text" id="landmark"
                                        placeholder="{{ __('Enter Your Landmark') }}"
                                        value="{{ !empty($user_detail->landmark) ? $user_detail->landmark : '' }}"
                                        autocomplete="landmark">
                                </div>
                            </div>
                            <div class="col-lg-6 col-sm-6">
                                <div class="form-group">
                                    <label for="about"
                                        class="col-form-label text-dark">{{ __('Brief About Yourself') }}</label>
                                    <input class="form-control " name="about" type="text" id="about"
                                        placeholder="{{ __('Enter Your About Yourself') }}"
                                        value="{{ !empty($user_detail->about) ? $user_detail->about : '' }}"
                                        autocomplete="about">
                                </div>
                            </div>
                            <div class="col-lg-12 text-end">
                                <input type="submit" value="{{ __('Save Changes') }}"
                                    class="btn btn-print-invoice  btn-primary m-r-10">
                            </div>
                        </div>
                        @endif

                        </form>

                        {{ Form::close() }}
                    </div>

                </div>
                @if ($user->id == Auth::user()->id)
                <div id="useradd-2" class="card  shadow-none rounded-0 border-bottom">

                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Change Password') }}</h5>
                        <small> {{ __('Details about your member account password change') }}</small>
                    </div>
                    <div class="card-body">
                        {{ Form::open(['route' => ['member.change.password', $user->id], 'method' => 'POST']) }}

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="password"
                                        class="form-label col-form-label text-dark">{{ __('New Password') }}</label>
                                    <input class="form-control" name="password" type="password" id="password"
                                        required autocomplete="password"
                                        placeholder="{{ __('Enter New Password') }}">
                                    @error('password')
                                    <span class="invalid-password" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="confirm_password"
                                        class="form-label col-form-label text-dark">{{ __('Confirm Password') }}</label>
                                    <input class="form-control" name="confirm_password" type="password"
                                        id="confirm_password" required autocomplete="confirm_password"
                                        placeholder="{{ __('Confirm New Password') }}">
                                    @error('confirm_password')
                                    <span class="invalid-confirm_password" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer pr-0">
                            {{ Form::submit(__('Update'), ['class' => 'btn  btn-primary']) }}
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
                @endif

                @if ((Auth::user()->type == 'super admin' && $user->id != Auth::user()->id) )
                <div id="useradd-3" class="card  shadow-none rounded-0 border-bottom">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Usage Statistics') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class=" setting-card">
                            <div class="row">

                                <div class="col-xxl-12 col-lg-12 col-md-12 col-sm-12">
                                    <div class="row">
                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 p-1">
                                            <a href="#">
                                                <div class="col border-end border-bottom">
                                                    <div class="p-4 ">
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="theme-avtar bg-primary">
                                                                <i class="ti ti-users"></i>
                                                            </div>
                                                            <div>
                                                                <p class="text-muted text-sm mb-0">
                                                                    {{ __('Total') }}
                                                                </p>
                                                                <h6 class="mb-0">
                                                                    {{ __('Number of Employees ') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <h3 class="mb-0">{{ count($members) }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 p-1">
                                            <a href="#">
                                                <div class="col border-end border-bottom">
                                                    <div class="p-4">
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="theme-avtar bg-info">
                                                                <i class="ti ti-users"></i>
                                                            </div>
                                                            <div>
                                                                <p class="text-muted text-sm mb-0">
                                                                    {{ __('Total') }}
                                                                </p>
                                                                <h6 class="mb-0">{{ __('Number of Clients') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <h3 class="mb-0">{{ count($client) }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 p-1">
                                            <a href="#">
                                                <div class="col border-end border-bottom">
                                                    <div class="p-4">
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="theme-avtar bg-warning">
                                                                <i class="ti ti-report-money"></i>
                                                            </div>
                                                            <div>
                                                                <p class="text-muted text-sm mb-0">
                                                                    {{ __('Total') }}
                                                                </p>
                                                                <h6 class="mb-0">{{ __('Number of Cases') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <h3 class="mb-0">{{ count($cases) }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                        <div class="col-xxl-6 col-lg-6 col-md-6 col-sm-6 p-1">
                                            <a href="#">
                                                <div class="col border-end border-bottom">
                                                    <div class="p-4">
                                                        <div class="d-flex justify-content-between mb-3">
                                                            <div class="theme-avtar bg-danger">
                                                                <i class="ti ti-database"></i>
                                                            </div>
                                                            <div>
                                                                <p class="text-muted text-sm mb-0">
                                                                    {{ __('Total') }}
                                                                </p>
                                                                <h6 class="mb-0">
                                                                    {{ __('Data - Consumed / Allotted') }}
                                                                </h6>
                                                            </div>
                                                        </div>
                                                        <h3 class="mb-0">{{ count($cases) }}</h3>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="useradd-4" class="card  shadow-none rounded-0 border-bottom">
                    <div class="card-header">
                        <h5 class="mb-0">{{ __('Employees') }}</h5>
                    </div>
                    <div class="card-body">
                        <div class=" setting-card">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table dataTable data-table ">
                                            <thead>
                                                <tr>
                                                    <th>{{ __('#') }}</th>
                                                    <th>{{ __('Name') }}</th>
                                                    <th>{{ __('Role') }}</th>
                                                    <th>{{ __('Email') }}</th>
                                                    <th width="100px">{{ __('Action') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                @foreach ($employee as $key => $employee)
                                                <tr>
                                                    <td>{{ $key + 1 }}</td>
                                                    <td>{{ $employee->name }}</td>
                                                    <td>{{ $employee->type }}</td>
                                                    <td>{{ $employee->email }}</td>
                                                    <td>

                                                        <div class="action-btn bg-light-secondary ms-2">
                                                            <a href="#"
                                                                data-url="{{ route('company.reset', \Crypt::encrypt($employee->id)) }}"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center "
                                                                data-tooltip="Edit" data-ajax-popup="true"
                                                                data-title="{{ __('Reset Password') }}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top"
                                                                title="{{ __('Reset Password') }}">

                                                                <i class="ti ti-key "></i>

                                                            </a>
                                                        </div>


                                                        @if (Auth::user()->can('delete member') ||
                                                        Auth::user()->can('delete user') ||
                                                        (Auth::user()->super_admin_employee == 1 && in_array('delete user', $premission_arr)))
                                                        <div class="action-btn bg-light-secondary ms-2">
                                                            <a href="#"
                                                                class="mx-3 btn btn-sm d-inline-flex align-items-center bs-pass-para "
                                                                data-confirm="{{ __('Are You Sure?') }}"
                                                                data-text="{{ __('This action can not be undone. Do you want to continue?') }}"
                                                                data-confirm-yes="delete-form-{{ $employee->id }}"
                                                                title="{{ __('Delete') }}"
                                                                data-bs-toggle="tooltip"
                                                                data-bs-placement="top">
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        </div>
                                                        @endif

                                                        {!! Form::open([
                                                        'method' => 'DELETE',
                                                        'route' => ['users.destroy', $employee->id],
                                                        'id' => 'delete-form-' . $employee->id,
                                                        ]) !!}
                                                        {!! Form::close() !!}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</div>
@endsection


@push('custom-script')
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300,

    })
    $(".list-group-item").on('click', function() {
        $('.list-group-item').filter(function() {
            return this.href == id;
        }).parent().removeClass('text-primary');
    });
</script>

@if (Auth::user()->type == 'advocate')
<script>
    $(document).ready(function() {

        var get_selected =
            '{{ !empty($advocate->ofc_country) ? $advocate->getCountryName($advocate->ofc_country) : $advocate->getCountryName(113) }}';
        var home_selected =
            '{{ !empty($advocate->home_country) ? $advocate->getCountryName($advocate->home_country) : $advocate->getCountryName(113) }}';

        $.ajax({
            url: "{{ route('get.country') }}",
            type: "GET",
            success: function(result) {

                $.each(result.data, function(key, value) {
                    if (value.id == get_selected) {
                        var selected = 'selected';
                    } else {
                        var selected = '';
                    }

                    if (value.id == home_selected) {
                        var selected_home = 'selected';
                    } else {
                        var selected_home = '';
                    }

                    $("#country").append('<option value="' + value.id + '" ' + selected +
                        ' >' + value
                        .country + "</option>");

                    $("#home_country").append('<option value="' + value.id + '" ' +
                        selected_home + '>' + value
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
                        $("#home_state").append('<option value="' + value.id +
                            '">' +
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
@endif
@endpush