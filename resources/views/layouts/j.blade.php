<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Учебник' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body { font-family: 'Montserrat', sans-serif; }
        @media (max-width: 1024px) { .responsive-padding-bottom { padding-bottom: 70px; } }
    </style>
</head>
<body class="bg-gray-50">

    @php
        $isTeacher = auth()->user()->role === "teacher";
        $dashboardUrl = $isTeacher ? '/teacher' : '/';
        $panelTitle = $isTeacher ? 'Мұғалім панелі' : 'Студент панелі';
        $unreadCount = auth()->user()->unreadNotifications->count();
    @endphp

    <header class="bg-white shadow-md p-5 hidden lg:flex justify-between items-center sticky top-0 z-10">
        <a href="{{ $dashboardUrl }}" class="flex items-center gap-4">
            <img src="{{ asset('images/logo.png') }}" class="h-14" alt="Logo">
            <h1 class="text-indigo-700 font-extrabold tracking-wide text-2xl">
                {{ $panelTitle }} / <span class="font-normal text-lg">пән: Бағдарламалау тілдері</span>
            </h1>
        </a>

        <div class="flex items-center space-x-6">
            <a href="{{ route('notifications.history') }}" class="text-indigo-600 text-sm font-medium hover:underline">
                Тарих 📜
            </a>

            <span class="text-gray-700 font-medium text-sm">
                {{ $isTeacher ? 'Қош келдіңіз' : 'Сәлеметсіз бе' }}, <span class="text-indigo-600">{{ auth()->user()->name }}!</span>
            </span>

            <div class="relative" id="notifWrapperDesktop">
                <button id="notifToggleDesktop" class="relative focus:outline-none text-xl">
                    🔔
                    @if($unreadCount)
                        <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[10px] text-white">
                            {{ $unreadCount }}
                        </span>
                    @endif
                </button>

                <div id="notifDropdownDesktop" class="absolute right-0 mt-3 w-80 bg-white shadow-xl rounded-lg p-4 z-50 transition-all duration-200 opacity-0 invisible scale-95 origin-top-right border border-gray-100 max-h-[450px] overflow-y-auto">
                    @include('partials.notifications-list')
                </div>
            </div>

            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-md px-4 py-2 shadow-md">Шығу</a>
        </div>
    </header>

    <footer class="fixed bottom-0 left-0 right-0 bg-white border-t border-gray-200 shadow-lg flex justify-around items-center p-3 lg:hidden z-50">
        <a href="{{ $dashboardUrl }}" class="flex flex-col items-center text-indigo-700 text-[10px]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2h-4a2 2 0 01-2-2v-5H9v5a2 2 0 01-2 2H3a2 2 0 01-2-2V9z"/></svg>
            <span>Басты</span>
        </a>

        <a href="{{ route('notifications.history') }}" class="flex flex-col items-center text-indigo-600 text-[10px]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            <span>Тарих</span>
        </a>

        <div class="relative flex flex-col items-center text-indigo-600 text-[10px]" id="notifWrapperMobile">
            <button id="notifToggleMobile" class="relative focus:outline-none">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6 6 0 10-12 0v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/></svg>
                @if($unreadCount)
                    <span class="absolute -top-1 -right-1 flex h-4 w-4 items-center justify-center rounded-full bg-red-600 text-[10px] text-white font-bold">
                        {{ $unreadCount }}
                    </span>
                @endif
            </button>
            <span>Хабар</span>
            
            <div id="notifDropdownMobile" class="absolute bottom-14 left-1/2 transform -translate-x-1/2 w-72 bg-white shadow-2xl rounded-lg p-4 z-50 opacity-0 invisible transition-all duration-200 border border-gray-100 max-h-64 overflow-y-auto">
                @include('partials.notifications-list')
            </div>
        </div>

        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="flex flex-col items-center text-indigo-600 text-[10px]">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M17 16l4-4m0 0l-4-4m4 4H7"/></svg>
            <span>Шығу</span>
        </a>
    </footer>

    <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">@csrf</form>

    <main class="responsive-padding-bottom">
        @yield('content')
    </main>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const setupDropdown = (toggleId, dropdownId, wrapperId, isDesktop = true) => {
                const toggle = document.getElementById(toggleId);
                const dropdown = document.getElementById(dropdownId);
                const wrapper = document.getElementById(wrapperId);

                toggle?.addEventListener('click', (e) => {
                    e.stopPropagation();
                    const isHidden = dropdown.classList.contains('invisible');
                    
                    // Close all first
                    document.querySelectorAll('[id^="notifDropdown"]').forEach(d => d.classList.add('invisible', 'opacity-0', 'scale-95'));
                    
                    if (isHidden) {
                        dropdown.classList.remove('invisible', 'opacity-0', 'scale-95');
                    }
                });

                document.addEventListener('click', (e) => {
                    if (!wrapper?.contains(e.target)) {
                        dropdown?.classList.add('invisible', 'opacity-0', 'scale-95');
                    }
                });
            };

            setupDropdown('notifToggleDesktop', 'notifDropdownDesktop', 'notifWrapperDesktop');
            setupDropdown('notifToggleMobile', 'notifDropdownMobile', 'notifWrapperMobile', false);

            // AJAX for Mark as Read
            document.addEventListener('submit', async (e) => {
                if (e.target.classList.contains('mark-read-form')) {
                    e.preventDefault();
                    const form = e.target;
                    const id = form.dataset.notificationId;
                    
                    try {
                        const res = await fetch(form.action, {
                            method: 'PATCH',
                            headers: {
                                'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
                                'Accept': 'application/json',
                                'Content-Type': 'application/json'
                            }
                        });

                        if (res.ok) {
                            // Удаляем элементы во всех списках (и моб и десктоп)
                            document.querySelectorAll(`[id*="notification-${id}"]`).forEach(el => el.remove());
                            
                            // Обновляем бейджики
                            document.querySelectorAll('[id^="notifToggle"] span').forEach(badge => {
                                let count = parseInt(badge.textContent) - 1;
                                if (count > 0) badge.textContent = count;
                                else badge.remove();
                            });
                        }
                    } catch (err) {
                        console.error('Error:', err);
                    }
                }
            });
        });
    </script>
</body>
</html>