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
                    <h2 class="auth-form-title">Тіркелу</h2>
                    <p class="auth-form-subtitle">Python курсын үйрену үшін аккаунт жасаңыз</p>
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
                        <label class="auth-field-label" for="register-name">Толық атыңыз</label>
                        <input type="text" id="register-name" name="name" value="{{ old('name') }}" placeholder="Ахмет Байтұрсынұлы" required class="auth-field">
                    </div>
                    <div>
                        <label class="auth-field-label" for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" value="{{ old('email') }}" placeholder="example@mail.kz" required class="auth-field">
                    </div>
                    <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                        <div>
                            <label class="auth-field-label" for="register-password">Құпия сөз</label>
                            <input type="password" id="register-password" name="password" placeholder="••••••••" required class="auth-field">
                        </div>
                        <div>
                            <label class="auth-field-label" for="register-password-confirm">Растау</label>
                            <input type="password" id="register-password-confirm" name="password_confirmation" placeholder="••••••••" required class="auth-field">
                        </div>
                    </div>
                    <button type="submit" class="auth-btn">Тіркелуді аяқтау</button>
                </form>

                <div class="auth-footer">
                    Аккаунтыңыз бар ма?
                    <a href="{{ route('login.form') }}">Кіру</a>
                </div>

                <div class="mt-6 lg:hidden auth-info-side rounded-2xl">
                    @include('partials.about-author')
                </div>
            </main>
        </div>
    </div>
</div>
@endsection
