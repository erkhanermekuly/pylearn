<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? __('messages.common.app_name') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        (function () {
            const t = localStorage.getItem('lumina-theme');
            const theme = t === 'dark' || t === 'light' ? t : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Montserrat:wght@700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <style>
        body { font-family: 'Inter', sans-serif; }
        .font-heading { font-family: 'Montserrat', sans-serif; }
    </style>
</head>
<body class="antialiased">

    @php
        $role = auth()->user()->role;
        $isTeacher = ($role === "teacher");
    @endphp

<header class="glass-header sticky top-0 z-[100] w-full {{ $isTeacher ? 'hidden lg:flex' : 'flex' }}">
    <div class="mx-auto px-4 lg:px-6 h-16 lg:h-20 flex justify-between items-center w-full">

        <a href="{{ $isTeacher ? '/teacher' : '/' }}" class="flex items-center gap-3 lg:gap-4 group">
            <img src="{{ asset('images/python-logo.svg') }}" class="h-10 w-10 lg:h-12 lg:w-12 group-hover:scale-105 transition-transform" alt="Python">
            <div class="block">
                <p class="font-heading text-sm lg:text-base font-black leading-tight tracking-tight" style="color: var(--text-primary)">{{ __('messages.common.app_name') }}</p>
                <p class="hidden sm:block text-[9px] lg:text-[10px] font-medium uppercase tracking-[0.12em]" style="color: var(--text-secondary)">{{ __('messages.common.tagline') }}</p>
            </div>
        </a>

        <div class="flex items-center space-x-3 lg:space-x-5">
            @if (!$isTeacher)
                <a href="{{ route('student.code-game') }}" class="hidden sm:inline-flex items-center gap-1.5 px-3 py-2 rounded-xl text-[10px] font-black uppercase tracking-wider bg-indigo-50 text-indigo-600 hover:bg-indigo-600 hover:text-white transition-all border border-indigo-100">
                    🧩 {{ __('messages.code_game.nav') }}
                </a>
            @endif
            @include('partials.locale-switcher')
            @include('partials.theme-toggle')

            <div class="flex items-center space-x-3 pr-3 lg:pr-5 border-r" style="border-color: var(--border-color)">
                <div class="flex items-center text-right justify-center text-indigo-500 font-black text-xs lg:text-sm">
                    {{ auth()->user()->name }}
                </div>
            </div>

            <a href="{{ route('logout') }}"
                onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                class="h-9 w-9 lg:h-11 lg:w-auto lg:px-6 flex items-center justify-center rounded-lg lg:rounded-xl bg-indigo-600 text-white text-xs font-bold hover:bg-indigo-700 transition-all shadow-md">
                <span class="hidden lg:inline">{{ __('messages.common.logout') }}</span>
                <svg class="w-5 h-5 lg:hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7" />
                </svg>
            </a>
        </div>
    </div>
</header>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>

    <main>
        @yield('content')
    </main>

    <footer class="border-t py-6 px-4" style="border-color: var(--border-color); background: var(--bg-card-soft)">
        <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-4 text-center md:text-left">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/python-logo.svg') }}" alt="Python" class="w-10 h-10 rounded-lg">
                <div>
                    <p class="text-sm font-black" style="color: var(--text-primary)">{{ __('messages.common.lumina_python') }}</p>
                    <p class="text-xs" style="color: var(--text-secondary)">{{ __('messages.common.author') }}</p>
                </div>
            </div>
            <p class="text-xs max-w-xl" style="color: var(--text-secondary)">
                {{ __('messages.common.footer_desc') }}
            </p>
        </div>
    </footer>

    <script>
        window.luminaI18n = {
            themeDark: @json(__('messages.theme.dark')),
            themeLight: @json(__('messages.theme.light')),
        };
    </script>
    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
