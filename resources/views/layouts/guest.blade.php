@php
    use App\Models\Utility;
    $settings = Utility::settings();

    $logo = asset('storage/uploads/logo');

    $company_favicon = $settings['company_favicon'] ?? '';

    $SITE_RTL = $settings['SITE_RTL'];
    $color = 'theme-1';

    if (!empty($settings['color'])) {
        $color = $settings['color'];
    }

    $SITE_RTL = 'off';
    if (!empty($settings['SITE_RTL'])) {
        $SITE_RTL = $settings['SITE_RTL'];
    }

    $logo_light = $settings['company_logo_light'] ?? '';
    $logo_dark = $settings['company_logo_dark'] ?? '';
    $company_logo = Utility::get_company_logo();
    $company_logos = $settings['company_logo_light'] ?? '';

    $lang = \App::getLocale('lang');
    if($lang == 'ar' || $lang == 'he'){
        $SITE_RTL = 'on';
    }
@endphp

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="{{ $SITE_RTL == 'on' ? 'rtl' : '' }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimal-ui">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="keywords" content="Dashboard Template" />
    <meta name="author" content="Rajodiya Infotech" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ Utility::getValByName('title_text') ? Utility::getValByName('title_text') : config('app.name', 'AdvocateGo-SaaS') }}
        - @yield('page-title') </title>

    <!-- Primary Meta Tags -->
    <meta name="title" content={{ $settings['meta_keywords'] ?? '' }}>
    <meta name="description" content={{ $settings['meta_description'] ?? '' }}>

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content={{ env('APP_URL') }}>
    <meta property="og:title" content={{ $settings['meta_keywords'] ?? '' }}>
    <meta property="og:description" content={{ $settings['meta_description'] ?? '' }}>
    <meta property="og:image" content={{ asset(Storage::url('uploads/metaevent/' . $settings['meta_image'] ?? '')) }}>

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content={{ env('APP_URL') }}>
    <meta property="twitter:title" content={{ $settings['meta_keywords'] ?? '' }}>
    <meta property="twitter:description" content={{ $settings['meta_description'] ?? '' }}>
    <meta property="twitter:image"
        content={{ asset(Storage::url('uploads/metaevent/' . $settings['meta_image'] ?? '')) }}>


    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Favicon icon -->

    <link rel="icon"
        href="{{ $logo . '/' . (isset($company_favicon) && !empty($company_favicon) ? $company_favicon : 'favicon.png') . '?timestamp=' . time() }}"
        type="image" sizes="800x800">

    <!-- font css -->
    <link rel="stylesheet" href="{{ asset('assets/fonts/tabler-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/fonts/material.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/plugins/notifier.css') }}">

    @if ($settings['cust_darklayout'] == 'on')
        @if (isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
        @endif
        <link rel="stylesheet" href="{{ asset('assets/css/style-dark.css') }}">
    @else
        @if (isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on')
            <link rel="stylesheet" href="{{ asset('assets/css/style-rtl.css') }}" id="main-style-link">
        @else
            <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}" id="main-style-link">
        @endif
    @endif
    @if (isset($settings['SITE_RTL']) && $settings['SITE_RTL'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-auth-rtl.css') }}" id="main-style-link">
    @else
        <link rel="stylesheet" href="{{ asset('assets/css/custom-auth.css') }}" id="main-style-link">
    @endif
    @if ($settings['cust_darklayout'] == 'on')
        <link rel="stylesheet" href="{{ asset('assets/css/custom-dark.css') }}" id="main-style-link">
    @endif
</head>

<body class="{{ $color }}">

    <div class="custom-login">
        <div class="login-bg-img">
            <img src="{{ asset('assets/images/auth/login.jpg') }}" class="login-bg-1">
            
        </div>
        <!-- <div class="bg-login bg-primary"></div> -->

        <div class="custom-login-inner">
            
            <main class="custom-wrapper">
                <div class="custom-row">
                    <div class="card">
                        @yield('content')
                    </div>
                </div>
            </main>
            <footer>
                <div class="auth-footer">
                    <div class="container">
                        <div class="row">
                            <div class="col-12">
                                <span>&copy;
                                    {{ $settings['footer_text'] ? $settings['footer_text'] : config('app.name', 'AdvocateGo SaaS') }}
                                    {{ date('Y') }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>

    <!-- [ auth-signup ] end -->
    @include('layouts.cookie_consent')

    <script src="{{ asset('assets/js/vendor-all.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/feather.js') }}"></script>
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/notifier.js') }}"></script>

    @stack('custom-scripts')

    @if ($message = Session::get('success'))
        <script>
            show_toastr('{{ __('Success') }}', '{!! $message !!}', 'success')
        </script>
    @endif

    @if ($message = Session::get('error'))
        <script>
            show_toastr('{{ __('Error') }}', '{!! $message !!}', 'error')
        </script>
    @endif
</body>

</html>
