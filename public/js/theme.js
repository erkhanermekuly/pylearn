(function () {
    const storageKey = 'lumina-theme';

    function getPreferredTheme() {
        const saved = localStorage.getItem(storageKey);
        if (saved === 'light' || saved === 'dark') return saved;
        return window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light';
    }

    function applyTheme(theme) {
        document.documentElement.setAttribute('data-theme', theme);
        localStorage.setItem(storageKey, theme);
        const i18n = window.luminaI18n || {};
        document.querySelectorAll('[data-theme-label]').forEach((el) => {
            el.textContent = theme === 'dark'
                ? (i18n.themeLight || 'Light')
                : (i18n.themeDark || 'Dark');
        });
    }

    window.toggleTheme = function () {
        const current = document.documentElement.getAttribute('data-theme') || 'light';
        applyTheme(current === 'dark' ? 'light' : 'dark');
    };

    applyTheme(getPreferredTheme());
})();
