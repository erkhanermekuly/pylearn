@extends('layouts.auth')

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
                    <h2 class="auth-form-title">{{ __('messages.auth.register_title') }}</h2>
                    <p class="auth-form-subtitle">{{ __('messages.auth.register_subtitle') }}</p>
                </div>

                @if ($errors->any())
                    <div class="auth-error">
                        <ul class="space-y-1">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="auth-field-label" for="register-name">{{ __('messages.auth.full_name') }}</label>
                        <input type="text" id="register-name" name="name" value="{{ old('name') }}" placeholder="{{ __('messages.auth.name_placeholder') }}" required class="auth-field">
                    </div>
                    <div>
                        <label class="auth-field-label" for="register-email">{{ __('messages.common.email') }}</label>
                        <input type="email" id="register-email" name="email" value="{{ old('email') }}" placeholder="{{ __('messages.auth.email_placeholder') }}" required class="auth-field">
                    </div>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label class="auth-field-label" for="register-password">{{ __('messages.auth.password') }}</label>
                            <input type="password" id="register-password" name="password" placeholder="••••••••" required class="auth-field">
                        </div>
                        <div>
                            <label class="auth-field-label" for="register-password-confirm">{{ __('messages.auth.confirm') }}</label>
                            <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="••••••••" required class="auth-field">
                        </div>
                    </div>
                    <button type="submit" class="auth-btn">{{ __('messages.auth.register_btn') }}</button>
                </form>

                <div class="auth-footer">
                    {{ __('messages.auth.has_account') }}
                    <a href="{{ route('login.form') }}">{{ __('messages.auth.login') }}</a>
                </div>

                <div class="mt-6 lg:hidden auth-info-side rounded-2xl">
                    @include('partials.about-author')
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
