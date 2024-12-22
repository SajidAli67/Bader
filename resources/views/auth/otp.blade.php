@extends('layouts.guest')
@section('page-title')
{{ __('Verify Email') }}
@endsection

@section('content')
<div class="card-body">
    <div>
        <h2 class="mb-3 f-w-600">{{ __('OTP') }} </h2>
    </div>

    <div class="custom-login-form">
        <form method="POST" action="{{ route('otp.verify') }}" class="needs-validation">
            @csrf
            <input type="hidden" name="email" value="{{ session('email') }}">
            <input type="hidden" name="password" value="{{ session('password') }}">
            <div class="form-group mb-3">
                <label class="form-label">{{ __('OTP') }}</label>
                <input id="otp_code" type="number" class="form-control   @error('otp_code') is-invalid @enderror"
                    name="otp_code" placeholder="{{ __('Enter your OTP') }}"
                    required autofocus>
                @error('otp_code')
                <span class="error invalid-email text-danger" role="alert">
                    <small>{{ $message }}</small>
                </span>
                @enderror
            </div>

            <div class="d-grid">

                <button class="btn btn-primary btn-block mt-2" type="submit">
                    {{ __('Login') }}
                </button>


                <a href="{{ route('regeneratOtp') }}" class="btn btn-primary btn-block mt-2"> Resend</a>
            </div>
        </form>

    </div>
</div>
@endsection()