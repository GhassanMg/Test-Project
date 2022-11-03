@extends('layouts.guest')

@section('content')
    <form class="card card-md" action="{{ route('register') }}" method="post" autocomplete="off">
        @csrf

        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('Create new account') }}</h2>

            <div class="mb-3">
                <label class="form-label">{{ __('First Name') }}</label>
                <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="{{ __('First Name') }}">
                @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Last Name') }}</label>
                <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="{{ __('Last Name') }}">
                @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Email address') }}</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="{{ __('Email Address') }}">
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Phone Number') }}</label>
                <input type="Phone" name="phone_number" class="form-control @error('phone_number') is-invalid @enderror" placeholder="{{ __('Phone Number') }}">
                @error('phone_number')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label class="form-label">{{ __('Password') }}</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="{{ __('Password') }}">
                @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            {{-- <div class="mb-3">
                <label class="form-label">{{ __('Repeat Password') }}</label>
                <input type="password" name="password_confirmation" class="form-control form-control-user @error('password_confirmation') is-invalid @enderror" placeholder="{{ __('Repeat Password') }}">
                @error('password_confirmation')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div> --}}

            <div class="form-footer">
                <button type="submit" class="btn btn-primary w-100">{{ __('Create new account') }}</button>
            </div>
        </div>
    </form>

    @if (Route::has('login'))
    <div class="text-center text-muted mt-3">
        {{ __('Already have account?') }} <a href="{{ route('login') }}" tabindex="-1">{{ __('Sign in') }}</a>
    </div>
    @endif

@endsection
