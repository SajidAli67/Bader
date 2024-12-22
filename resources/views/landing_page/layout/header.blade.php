
<header>
        <div class="_main_nav">
            <div class="container">
                <div class="row">
                    <div class="col-md-1">
                        <a href="index.html"><img src=" {{ asset('landing/images/logo.png') }}" alt="Bader" class="logo"></a>
                    </div>
                    <div class="col-md-9">
                        <div class="nav">
                            <div class="menu-toggle"></div>
                            <div class="my-nav">
                                <div class="menu">
                                  <ul>
                                    <li><a href="{{ route('home') }}"> {{ __('Home')}}</a></li>
                                    <li><a href="{{ route('about') }}">{{ __('About Us')}}</a></li>
                                    <li><a href="{{ route('services') }}">{{ __('Services')}}</a></li>
                                    <li><a href="{{ route('cashstudy') }}">{{__('Cash Study')}}</a></li>
                                    <li><a href="{{ route('contact') }}">{{ __('Contact Us')}}</a></li>
                                  </ul>
                                </div>
                            </div>
                        </div>    
                    </div>
                    <div class="col-md-2 text-right">
                        <a href="{{ route('change.language',$code) }}" class="btn lang-btn"> {{ Str::upper($code) }} </a>
                        <a href="{{ route('login') }}" class="btn login-btn"> {{ Auth::check() ? __('Dashboard') : __('Login') }} </a>
                    </div>
                </div>
            </div>
        </div>
    </header>