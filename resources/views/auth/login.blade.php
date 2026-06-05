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
                        Lumina Python
                    </div>
                    <h2 class="auth-form-title">Қош келдіңіз!</h2>
                    <p class="auth-form-subtitle">Python платформасына кіріңіз</p>
                </div>

                @if ($errors->any())
                    <div class="auth-error">{{ $errors->first() }}</div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-5">
                    @csrf
                    <div>
                        <label class="auth-field-label" for="login-email">Email</label>
                        <input type="email" id="login-email" name="email" value="{{ old('email') }}" placeholder="example@mail.kz" required class="auth-field">
                    </div>
                    <div>
                        <label class="auth-field-label" for="login-password">Құпия сөз</label>
                        <input type="password" id="login-password" name="password" placeholder="••••••••" required class="auth-field">
                    </div>
                    <button type="submit" class="auth-btn">Кіру</button>
                </form>

                <div class="auth-footer">
                    Аккаунтыңыз жоқ па?
                    <a href="{{ route('register.form') }}">Тіркелу</a>
                </div>

                <div class="mt-6 lg:hidden auth-info-side rounded-2xl">
                    @include('partials.about-author')
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
