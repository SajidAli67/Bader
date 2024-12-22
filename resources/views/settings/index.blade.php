@extends('layouts.app')

@section('page-title', __('Settings'))


@section('breadcrumb')
    <li class="breadcrumb-item">{{ __('Settings') }}</li>
@endsection

@php
    use App\Models\Utility;
    $color = isset($settings['color']) ? $settings['color'] : 'theme-1';
    $logo = asset('storage/uploads/logo/');

    $file_type = config('files_types');
    $meta_image = Utility::get_file('uploads/metaevent/');

    $local_storage_validation = $settings['local_storage_validation'];
    $local_storage_validations = explode(',', $local_storage_validation);

    $s3_storage_validation = $settings['s3_storage_validation'];
    $s3_storage_validations = explode(',', $s3_storage_validation);

    $wasabi_storage_validation = $settings['wasabi_storage_validation'];
    $wasabi_storage_validations = explode(',', $wasabi_storage_validation);

    $authUser = Auth::user();

    $logo_light = $settings['company_logo_light'] ?? '';
    $logo_dark = $settings['company_logo_dark'] ?? '';
    $company_favicon = $settings['company_favicon'] ?? '';
    $lang = $settings['default_language'] ?? '';

@endphp

@section('content')
    <div class="row p-0 g-0">
        <div class="col-sm-12">
            <div class="row g-0">
                <div class="col-xl-3 border-end border-bottom ">
                    <div class="card shadow-none bg-transparent sticky-top" style="top:30px">
                        <div class="list-group list-group-flush rounded-0" id="useradd-sidenav">
                            <a href="#useradd-1"
                                class="list-group-item list-group-item-action border-0">{{ __('Brand Settings') }}
                                <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                            </a>
                            <a href="#useradd-7"
                                class="list-group-item list-group-item-action border-0">{{ __('Payment Settings') }}
                                <div class="float-end "><i class="ti ti-chevron-right"></i></div>
                            </a>

                            @if ($authUser->type == 'company')
                                <a href="#useradd-8"
                                    class="list-group-item list-group-item-action border-0">{{ __('Google Calendar Settings') }}
                                    <div class="float-end"><i class="ti ti-chevron-right"></i></div>
                                </a>
                            @endif

                            <a href="#useradd-9" class="list-group-item list-group-item-action">{{ __('Email Settings') }}
                                <div class="float-end dark"><i class="ti ti-chevron-right"></i></div>
                            </a>


                        </div>
                    </div>
                </div>

                <div class="col-xl-9" data-bs-spy="scroll" data-bs-target="#useradd-sidenav" data-bs-offset="0" tabindex="0">

                    <!--Business Setting-->
                    <div class="card shadow-none rounded-0 border" id="useradd-1">
                        {{ Form::model($settings, ['route' => 'settings.store', 'method' => 'POST', 'enctype' => 'multipart/form-data'])
                        }}
                        <div class="card-header">
                            <h5>{{ __('Brand Settings') }}</h5>
                            <small class="text-muted">{{ __('Edit your brand details') }}</small>
                        </div>

                        <div class="card-body pb-0  ">
                            <div class="row">
                                <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                    <div class="card shadow-none border rounded-0">
                                        <div class="card-header">
                                            <h5>{{ __('Logo dark') }}</h5>
                                        </div>
                                        <div class="card-body">
                                            <div class=" setting-card">
                                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                                    <div class="logo-content mt-4">
                                                        <a href="{{ $logo .'/' . (isset($logo_dark) && !empty($logo_dark) ? $logo_dark : '/logo-dark.png') }}"
                                                            target="_blank">
                                                            <img class="img_setting" id="blah" alt="your image"
                                                                src="{{ $logo .'/'. (isset($logo_dark) && !empty($logo_dark) ? $logo_dark : '/logo-dark.png').'?timestamp='.time() }}"
                                                                width="200px" class="big-logo">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="company_logo">
                                                            <div class=" bg-primary company_logo_update m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" name="company_logo_dark" id="company_logo"
                                                                class="form-control file" data-filename="company_logo_update"
                                                                onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">

                                                        </label>
                                                    </div>
                                                    @error('company_logo')
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                    <div class="card shadow-none border rounded-0">
                                        <div class="card-header">
                                            <h5>{{ __('Logo Light') }}</h5>
                                        </div>
                                        <div class="card-body ">
                                            <div class=" setting-card">
                                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                                    <div class="logo-content mt-4">

                                                        <a href="{{ $logo .'/'. (isset($logo_light) && !empty($logo_light) ? $logo_light : '/logo-light.png') }}"
                                                            target="_blank">
                                                            <img id="blah1" alt="your image"
                                                                src="{{ $logo .'/'. (isset($logo_light) && !empty($logo_light) ? $logo_light : '/logo-light.png') .'?timestamp='.time()}}"
                                                                width="200px" class="big-logo img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-5">
                                                        <label for="company_logo_light">
                                                            <div class=" bg-primary dark_logo_update m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" name="company_logo_light" id="company_logo_light"
                                                                class="form-control file" data-filename="dark_logo_update"
                                                                onchange="document.getElementById('blah1').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('company_logo_light')
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-sm-6 col-md-6 dashboard-card">
                                    <div class="card shadow-none border rounded-0">
                                        <div class="card-header">
                                            <h5>{{ __('Favicon') }}</h5>
                                        </div>
                                        <div class="card-body pt-0">
                                            <div class=" setting-card">
                                                <div class="d-flex flex-column justify-content-between align-items-center h-100">
                                                    <div class="logo-content mt-4">
                                                        <a href="{{ $logo .'/'. (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : '/favicon.png') }}"
                                                            target="_blank">
                                                            <img id="blah2" alt="your image"
                                                                src="{{ $logo .'/'. (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : '/favicon.png').'?timestamp='.time() }}"
                                                                width="80px" class="big-logo img_setting">
                                                        </a>
                                                    </div>
                                                    <div class="choose-files mt-4">
                                                        <label for="company_favicon">
                                                            <div class="bg-primary company_favicon_update m-auto"> <i
                                                                    class="ti ti-upload px-1"></i>{{ __('Choose file here') }}
                                                            </div>
                                                            <input type="file" name="company_favicon" id="company_favicon"
                                                                class="form-control file" data-filename="company_favicon_update"
                                                                onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                                                        </label>
                                                    </div>
                                                    @error('logo')
                                                    <div class="row">
                                                        <span class="invalid-logo" role="alert">
                                                            <strong class="text-danger">{{ $message }}</strong>
                                                        </span>
                                                    </div>
                                                    @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('title_text', __('Title Text'), ['class' => 'form-label']) }}
                                            {{ Form::text('title_text', $settings['title_text'], ['class' => 'form-control',
                                            'placeholder' => __('Title Text')]) }}
                                            @error('title_text')
                                            <span class="invalid-title_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {{ Form::label('footer_text', __('Footer Text'), ['class' => 'form-label']) }}
                                            {{ Form::text('footer_text', $settings['footer_text'], ['class' =>
                                            'form-control', 'placeholder' => __('Enter Footer Text')]) }}
                                            @error('footer_text')
                                            <span class="invalid-footer_text" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-4">
                                        <div class="form-group">
                                            {{ Form::label('default_language', __('Default Language'), ['class' => 'form-label']) }}
                                            <div class="changeLanguage">

                                                <select name="default_language" id="default_language" class="form-control select">
                                                    @foreach (\App\Models\Utility::languages() as $code => $language)
                                                        <option @if ($lang == $code) selected @endif value="{{ $code }}"> {{ ucFirst($language) }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('default_language')
                                            <span class="invalid-default_language" role="alert">
                                                <strong class="text-danger">{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="row">
                                            <div class="col-4 my-auto">
                                                <div class="form-group">
                                                    <label class="text-dark mb-1 mt-3" for="SITE_RTL">{{ __('Enable RTL') }}</label>
                                                    <div class="">
                                                        <input type="checkbox" name="SITE_RTL" id="SITE_RTL" data-toggle="switchbutton"
                                                            {{ $settings['SITE_RTL']=='on' ? 'checked="checked"' : '' }}
                                                            data-onstyle="primary">
                                                        <label class="form-check-labe" for="SITE_RTL"></label>
                                                    </div>
                                                </div>
                                            </div>


                                        </div>
                                    </div>
                                </div>
                                <h4 class="small-title">{{ __('Theme Customizer') }}</h4>
                                <div class="setting-card setting-logo-box p-3">
                                    <div class="row">
                                        <div class="col-4 my-auto">
                                            <h6 class="mt-2">
                                                <i data-feather="credit-card" class="me-2"></i>{{ __('Primary color settings') }}
                                            </h6>
                                            <hr class="my-2" />

                                            <div class="theme-color themes-color">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-1' ? 'active_color' : '' }}"
                                                    data-value="theme-1" onclick="check_theme('theme-1')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-1"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-2' ? 'active_color' : '' }} "
                                                    data-value="theme-2" onclick="check_theme('theme-2')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-2"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-3' ? 'active_color' : '' }}"
                                                    data-value="theme-3" onclick="check_theme('theme-3')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-3"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-4' ? 'active_color' : '' }}"
                                                    data-value="theme-4" onclick="check_theme('theme-4')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-4"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-5' ? 'active_color' : '' }}"
                                                    data-value="theme-5" onclick="check_theme('theme-5')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-5"
                                                    style="display: none;">
                                                <br>
                                                <a href="#!" class="{{ $settings['color'] == 'theme-6' ? 'active_color' : '' }}"
                                                    data-value="theme-6" onclick="check_theme('theme-6')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-6"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-7' ? 'active_color' : '' }}"
                                                    data-value="theme-7" onclick="check_theme('theme-7')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-7"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-8' ? 'active_color' : '' }}"
                                                    data-value="theme-8" onclick="check_theme('theme-8')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-8"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-9' ? 'active_color' : '' }}"
                                                    data-value="theme-9" onclick="check_theme('theme-9')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-9"
                                                    style="display: none;">
                                                <a href="#!" class="{{ $settings['color'] == 'theme-10' ? 'active_color' : '' }}"
                                                    data-value="theme-10" onclick="check_theme('theme-10')"></a>
                                                <input type="radio" class="theme_color" name="color" value="theme-10"
                                                    style="display: none;">
                                            </div>
                                        </div>
                                        <div class="col-4 ">
                                            <h6 class="mt-2">
                                                <i data-feather="layout" class="me-2"></i>{{ __('Sidebar settings') }}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch">
                                                <input type="checkbox" class="form-check-input" id="site_transparent"
                                                    name="cust_theme_bg" {{ $settings['cust_theme_bg']=='on' ? 'checked'
                                                    : '' }} />

                                                <label class="form-check-label f-w-600 pl-1" for="site_transparent">{{ __('Transparent layout') }}</label>
                                            </div>
                                        </div>
                                        <div class="col-4 ">
                                            <h6 class="mt-2">
                                                <i data-feather="sun" class="me-2"></i>{{ __('Layout settings') }}
                                            </h6>
                                            <hr class="my-2" />
                                            <div class="form-check form-switch mt-2">
                                                <input type="checkbox" class="form-check-input" id="cust-darklayout"
                                                    name="cust_darklayout" {{ $settings['cust_darklayout']=='on' ? 'checked'
                                                    : '' }} />
                                                <label class="form-check-label f-w-600 pl-1" for="cust-darklayout">{{ __('Dark Layout')
                                                    }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-end pb-0 pe-0">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice btn-primary m-r-10" type="submit"
                                            value="{{ __('Save Changes') }}">
                                    </div>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                    <!--Payment Setting-->
                    <div id="useradd-7" class="card shadow-none rounded-0 border">
                        <div class="card-header">
                            <h5>{{ __('Payment Settings') }}</h5>
                            <small class="text-muted">{{ __('These details will be used to collect invoice payments. Each invoice will have a payment button based on the below configuration.') }}</small>
                        </div>
                        <div class="card-body pb-0">

                            {{ Form::model($settings, ['route' => 'payment.settings', 'method' => 'POST']) }}

                            @csrf
                            <div class="row">
                                <div class="form-group col-md-6">
                                    {{ Form::label('site_currency', __('Currency *'), ['class' => 'form-label']) }}
                                    {{ Form::text('site_currency', isset($company_payment_setting['site_currency']) ?
                                    $company_payment_setting['site_currency'] : '', ['class' => 'form-control font-style']) }}
                                    @error('site_currency')
                                    <span class="invalid-site_currency" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    {{ Form::label('site_currency_symbol', __('Currency Symbol *'), ['class' => 'form-label']) }}
                                    {{ Form::text('site_currency_symbol', isset($company_payment_setting['site_currency_symbol']) ?
                                    $company_payment_setting['site_currency_symbol'] : '', ['class' => 'form-control']) }}
                                    @error('site_currency_symbol')
                                    <span class="invalid-site_currency_symbol" role="alert">
                                        <strong class="text-danger">{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="faq justify-content-center">
                                <div class="row">
                                    <div class="accordion accordion-flush setting-accordion" id="accordionExample">
                                        {{-- bank-transfer --}}
                                        <div class="accordion-item ">
                                            <h2 class="accordion-header" id="heading-2-16">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                    data-bs-target="#collapse16" aria-expanded="false" aria-controls="collapse16">
                                                    <span class="d-flex align-items-center">

                                                        {{ __('Bank Transfer') }}
                                                    </span>
                                                    <div class="d-flex align-items-center">
                                                        <span class="me-2">{{ __('Enable') }}</span>
                                                        <div class="form-check form-switch custom-switch-v1">
                                                            <input type="hidden" name="is_bank_enabled" value="off">
                                                            <input type="checkbox" class="form-check-input input-primary"
                                                                name="is_bank_enabled" id="is_bank_enabled" {{
                                                                isset($company_payment_setting['is_bank_enabled']) &&
                                                                $company_payment_setting['is_bank_enabled']=='on' ? 'checked="checked"'
                                                                : '' }}>
                                                            <label class="form-check-label" for="customswitchv1-1"></label>
                                                        </div>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapse16" class="accordion-collapse collapse" aria-labelledby="heading-2-16"
                                                data-bs-parent="#accordionExample">
                                                <div class="accordion-body">
                                                    <div class="row gy-4">
                                                        <div class="col-md-6 mt-3">
                                                            <div class="form-group">
                                                                {!! Form::label('inputname', __('Bank Details'), ['class' =>
                                                                'col-form-label']) !!}

                                                                @php
                                                                $bank_details = !empty($company_payment_setting['bank_details']) ?
                                                                $company_payment_setting['bank_details'] : '';
                                                                @endphp
                                                                {!! Form::textarea('bank_details', $bank_details, [
                                                                'class' => 'form-control',
                                                                'rows' => '6'
                                                                ]) !!}
                                                                <small class="text-xs">
                                                                    {{ __('Example : Bank : Bank Name <br> Account Number : 0000 0000 <br>') }}.
                                                                </small>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                      

                                      
                                    </div>
                                </div>
                                <div class="card-footer text-end pb-0 pe-0">
                                    <div class="form-group">
                                        <input class="btn btn-print-invoice  btn-primary" type="submit"
                                            value="{{ __('Save Changes') }}">
                                    </div>
                                </div>
                                </form>
                            </div>


                        </div>
                        <!-- [ Main Content ] end -->
                    </div>

                    {{-- Google Calendar --}}
                    <div class="" id="useradd-8">
                        <div class="card shadow-none rounded-0 border">
                            {{ Form::open(['url' => route('google.calender.settings'), 'enctype' => 'multipart/form-data']) }}
                            <div class="card-header">
                                <div class="row">

                                    <div class="col-lg-8 col-md-8 col-sm-8">
                                        <h5>{{ __('Google Calendar Settings') }}</h5>
                                    </div>

                                    <div class="col-lg-4 col-md-4 text-end">
                                        <div class="form-check custom-control custom-switch">
                                            <input type="checkbox" class="form-check-input" name="is_enabled"
                                                data-toggle="switchbutton" data-onstyle="primary" id="is_enabled"
                                                {{ isset($settings['is_enabled']) && $settings['is_enabled'] == 'on' ? 'checked' : '' }}>
                                            <label class="custom-control-label form-label" for="is_enabled"></label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        {{ Form::label('Google calendar id', __('Google Calendar Id'), ['class' => 'col-form-label']) }}
                                        {{ Form::text('google_clender_id', !empty($settings['google_clender_id']) ? $settings['google_clender_id'] : '', ['class' => 'form-control ', 'placeholder' => 'Google Calendar Id']) }}
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-12 form-group">
                                        {{ Form::label('Google calendar json file', __('Google Calendar json File'), ['class' => 'col-form-label']) }}
                                        <input type="file" class="form-control" name="google_calender_json_file"
                                            id="file">
                                        {{-- {{Form::text('zoom_secret_key', !empty($settings['zoom_secret_key']) ? $settings['zoom_secret_key'] : '' ,array('class'=>'form-control', 'placeholder'=>'Google Calendar json File'))}} --}}
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn-submit btn btn-primary" type="submit">
                                    {{ __('Save Changes') }}
                                </button>
                            </div>
                            {{ Form::close() }}
                        </div>
                    </div>

                    <!--Email Setting-->
                    <div class="card shadow-none rounded-0 border-bottom" id="useradd-9">
                        <div class="card-header">
                            <h5>{{ __('Email Settings') }}</h5>
                        </div>
                        {{ Form::model($settings,['route' => 'company.email.settings', 'method' => 'post']) }}
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_driver', __('Mail Driver'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_driver', null, ['class' => 'form-control','id'=>'mail_driver', 'placeholder' => __('Enter Mail Driver')]) }}
                                        @error('mail_driver')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_host', __('Mail Host'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_host', null, ['class' => 'form-control ','id'=>'mail_host',
                                        'placeholder' => __('Enter Mail Host')]) }}
                                        @error('mail_host')
                                        <span class="invalid-mail_driver" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_port', __('Mail Port'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_port', null, ['class' => 'form-control','id'=>'mail_port',
                                        'placeholder' => __('Enter Mail Port')]) }}
                                        @error('mail_port')
                                        <span class="invalid-mail_port" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_username', __('Mail Username'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_username', null, ['class' => 'form-control','id'=>'mail_username',
                                        'placeholder' => __('Enter Mail Username')]) }}
                                        @error('mail_username')
                                        <span class="invalid-mail_username" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_password', __('Mail Password'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_password', null, ['class' => 'form-control','id'=>'mail_password',
                                        'placeholder' => __('Enter Mail Password')]) }}
                                        @error('mail_password')
                                        <span class="invalid-mail_password" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_encryption', __('Mail Encryption'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_encryption', null, ['class' => 'form-control','id'=>'mail_encryption',
                                        'placeholder' => __('Enter Mail Encryption')]) }}
                                        @error('mail_encryption')
                                        <span class="invalid-mail_encryption" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_from_address', __('Mail From Address'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_from_address', null, ['class' => 'form-control','id'=>'mail_from_address', 'placeholder' => __('Enter Mail From Address')]) }}
                                        @error('mail_from_address')
                                        <span class="invalid-mail_from_address" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{ Form::label('mail_from_name', __('Mail From Name'), ['class' => 'form-label']) }}
                                        {{ Form::text('mail_from_name', null, ['class' => 'form-control','id'=>'mail_from_name',
                                        'placeholder' => __('Enter Mail From Name')]) }}
                                        @error('mail_from_name')
                                        <span class="invalid-mail_from_name" role="alert">
                                            <strong class="text-danger">{{ $message }}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer pb-0">
                            <div class="row">
                                <div class="form-group col-md-6 col-6">
                                    <a href="#" class="btn btn-primary  send_email" data-title="{{ __('Send Test Mail') }}"
                                        data-url="{{ route('test.mail') }}" >
                                        {{ __('Send Test Mail') }}
                                    </a>
                                </div>
                                <div class="form-group col-md-6 col-6 text-end">
                                    <input class="btn btn-primary" type="submit" value="{{ __('Save Changes') }}">
                                </div>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection



@push('custom-script')
<script>
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#useradd-sidenav',
        offset: 300
    })

    $(document).ready(function() {

        if ($('#site_transparent').length > 0) {
            var custthemebg = document.querySelector("#site_transparent");
            custthemebg.addEventListener("click", function() {
                if (custthemebg.checked) {
                    document.querySelector(".dash-sidebar").classList.add("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.add("transprent-bg");
                } else {
                    document.querySelector(".dash-sidebar").classList.remove("transprent-bg");
                    document
                        .querySelector(".dash-header:not(.dash-mob-header)")
                        .classList.remove("transprent-bg");
                }
            });
        }

        if ($('#cust-darklayout').length > 0) {
            var custthemedark = document.querySelector("#cust-darklayout");
            custthemedark.addEventListener("click", function() {

                if (custthemedark.checked) {
                    $('#style').attr('href', '{{ env('APP_URL') }}' +
                        '/public/assets/css/style-dark.css');
                    $('#custom-dark').attr('href', '{{ env('APP_URL') }}' +
                        '/public/assets/css/custom-dark.css');
                    $('.dash-sidebar .main-logo a img').attr('src', '{{ $logo }}/{{ $logo_light }}');

                } else {
                    $('#style').attr('href', '{{ env('APP_URL') }}' + '/public/assets/css/style.css');
                    $('.dash-sidebar .main-logo a img').attr('src', '{{ $logo . $logo_dark }}');
                    $('#custom-dark').attr('href', '');

                }
            });
        }
    })



    $(document).ready(function(){
        $(".list-group-item").first().addClass('active');

        $(".list-group-item").on('click',function() {
            $(".list-group-item").removeClass('active')
            $(this).addClass('active');
        });
    })

    function check_theme(color_val) {
        $('#theme_color').prop('checked', false);
        $('input[value="' + color_val + '"]').prop('checked', true);
    }

    $(document).on('change', '[name=storage_setting]', function() {
        if ($(this).val() == 's3') {
            $('.s3-setting').removeClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').addClass('d-none');
        } else if ($(this).val() == 'wasabi') {
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').removeClass('d-none');
            $('.local-setting').addClass('d-none');
        } else {
            $('.s3-setting').addClass('d-none');
            $('.wasabi-setting').addClass('d-none');
            $('.local-setting').removeClass('d-none');
        }
    });



    function enablecookie() {
        const element = $('#enable_cookie').is(':checked');
        $('.cookieDiv').addClass('disabledCookie');
        if (element == true) {
            $('.cookieDiv').removeClass('disabledCookie');
            $("#cookie_logging").attr('checked', true);
        } else {
            $('.cookieDiv').addClass('disabledCookie');
            $("#cookie_logging").attr('checked', false);
        }
    }

    $(document).on("click", '.send_email', function(e) {

        e.preventDefault();
        var title = $(this).attr('data-title');

        var size = 'md';
        var url = $(this).attr('data-url');

        if (typeof url != 'undefined') {
            $("#commanModel .modal-title").html(title);
            $("#commanModel .modal-dialog").addClass('modal-' + size);
            $("#commanModel").modal('show');

            $.post(url, {
                _token: '{{ csrf_token() }}',
                mail_driver: $("#mail_driver").val(),
                mail_host: $("#mail_host").val(),
                mail_port: $("#mail_port").val(),
                mail_username: $("#mail_username").val(),
                mail_password: $("#mail_password").val(),
                mail_encryption: $("#mail_encryption").val(),
                mail_from_address: $("#mail_from_address").val(),
                mail_from_name: $("#mail_from_name").val(),
            }, function(data) {
                $('#commanModel .extra').html(data);
            });
        }
        });
</script>
@endpush
