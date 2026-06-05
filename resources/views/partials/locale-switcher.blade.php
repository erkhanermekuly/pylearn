@php
    $current = app()->getLocale();
    $locales = [
        'kk' => 'KZ',
        'ru' => 'RU',
        'en' => 'EN',
    ];
@endphp

<nav class="locale-switcher" aria-label="Language">
    @foreach ($locales as $code => $label)
        @if (!$loop->first)
            <span class="locale-switcher-sep" aria-hidden="true">|</span>
        @endif
        <a href="{{ route('locale.switch', $code) }}"
           class="locale-switcher-link{{ $current === $code ? ' is-active' : '' }}"
           @if($current === $code) aria-current="true" @endif>
            {{ $label }}
        </a>
    @endforeach
</nav>
