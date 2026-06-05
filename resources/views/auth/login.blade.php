@extends('layouts.auth')

@push('head-links')
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
@endpush

@push('page-styles')
    <style>body { font-family: 'Inter', sans-serif; }</style>
@endpush

@section('content')
<div class="auth-shell min-h-screen w-full flex items-center justify-center px-4 py-10 md:py-14">
    <div class="w-full max-w-5xl fade-in">
        <div class="auth-split">
            <aside class="auth-info-side hidden lg:flex">
                @include('partials.about-author')
            </aside>

            <main class="auth-form-side">
                <div class="auth-form-header">
                    <div class="auth-form-eyebrow">
                        <img src="{{ asset('images/python-logo.svg') }}" alt="" class="w-4 h-4" aria-hidden="true">
                        {{ __('messages.common.lumina_python') }}
                    </div>
                    <h2 class="auth-form-title">{{ __('messages.auth.welcome') }}</h2>
                    <p class="auth-form-subtitle">{{ __('messages.auth.login_subtitle') }}</p>
                </div>

                @if ($errors->any())
                    <div class="auth-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="auth-field-label" for="login-email">{{ __('messages.common.email') }}</label>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="{{ __('messages.auth.email_placeholder') }}" required class="auth-field">
                    </div>
                    <div>
                        <label class="auth-field-label" for="login-password">{{ __('messages.auth.password') }}</label>
                        <input type="password" id="login-password" name="password" placeholder="••••••••" required class="auth-field">
                    </div>
                    <button type="submit" class="auth-btn">{{ __('messages.auth.login') }}</button>
                </form>

                <div class="auth-footer">
                    {{ __('messages.auth.no_account') }}
                    <a href="{{ route('register.form') }}">{{ __('messages.auth.register_link') }}</a>
                </div>

                <div class="mt-6 lg:hidden auth-info-side rounded-2xl">
                    @include('partials.about-author')
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
