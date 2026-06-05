<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title ?? __('messages.common.app_name') }}</title>
    <script>
        (function () {
            const t = localStorage.getItem('lumina-theme');
            const theme = t === 'dark' || t === 'light' ? t : (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
            document.documentElement.setAttribute('data-theme', theme);
        })();
    </script>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/theme.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    @stack('head-links')
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        .fade-in { animation: fadeIn 0.5s ease-in-out; }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
    @stack('page-styles')
</head>
<body class="min-h-screen antialiased">
    <div class="fixed top-5 right-5 z-50 flex items-center gap-2">
        @include('partials.locale-switcher')
        @include('partials.theme-toggle')
    </div>

    @yield('content')

    <script>
        window.luminaI18n = {
            themeDark: @json(__('messages.theme.dark')),
            themeLight: @json(__('messages.theme.light')),
        };
    </script>
    <script src="{{ asset('js/theme.js') }}"></script>
</body>
</html>
