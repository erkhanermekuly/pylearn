<div class="about-author">
    <div class="about-author-brand">
        <div class="about-author-logo-wrap">
            <img src="{{ asset('images/python-logo.svg') }}" alt="Python">
        </div>
        <div>
            <p class="about-author-eyebrow">{{ __('messages.common.lumina_python') }}</p>
            <h3 class="about-author-title">{{ __('messages.about.title') }}</h3>
        </div>
    </div>

    <p class="about-author-desc">{{ __('messages.about.desc') }}</p>

    <ul class="about-author-features">
        <li>{{ __('messages.about.feature_lessons') }}</li>
        <li>{{ __('messages.about.feature_tests') }}</li>
        <li>{{ __('messages.about.feature_ai') }}</li>
    </ul>

    <div class="about-author-meta">
        <p><strong>{{ __('messages.about.author_label') }}</strong> {{ __('messages.about.author_name') }}</p>
        <p><strong>{{ __('messages.about.goal_label') }}</strong> {{ __('messages.about.goal') }}</p>
    </div>

    <div class="about-author-tags">
        <span>Laravel</span>
        <span>MySQL</span>
        <span>OpenAI</span>
        <span>Tailwind</span>
    </div>
</div>
