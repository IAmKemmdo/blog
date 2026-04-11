import './bootstrap';

document.addEventListener('DOMContentLoaded', () => {
    const themeToggleButton = document.getElementById('theme-toggle');
    const rootElement = document.documentElement;

    const setCookie = (name, value, days = 365) => {
        const maxAge = days * 24 * 60 * 60;

        document.cookie = `${name}=${encodeURIComponent(value)}; path=/; max-age=${maxAge}; samesite=lax`;
    };

    if (themeToggleButton && rootElement) {
        themeToggleButton.addEventListener('click', () => {
            const isDark = rootElement.classList.toggle('dark');

            setCookie('theme', isDark ? 'dark' : 'light');
        });
    }

    const loadingOverlay = document.getElementById('page-loading-overlay');

    if (!loadingOverlay) {
        return;
    }

    document.addEventListener('click', (event) => {
        const target = event.target;

        if (!(target instanceof Element)) {
            return;
        }

        const link = target.closest('a');

        if (!(link instanceof HTMLAnchorElement)) {
            return;
        }

        if (event.defaultPrevented || event.button !== 0 || event.metaKey || event.ctrlKey || event.shiftKey || event.altKey) {
            return;
        }

        if (link.target === '_blank' || link.hasAttribute('download')) {
            return;
        }

        const href = link.getAttribute('href');

        if (!href || href.startsWith('#') || href.startsWith('mailto:') || href.startsWith('tel:') || href.startsWith('javascript:')) {
            return;
        }

        const url = new URL(link.href, window.location.origin);
        const isPostDetails = /^\/posts\/[^/]+$/.test(url.pathname);
        const isMarkedPostLink = link.dataset.loading === 'post';

        if (url.origin !== window.location.origin || (!isPostDetails && !isMarkedPostLink)) {
            return;
        }

        loadingOverlay.classList.remove('hidden');
        loadingOverlay.classList.add('flex');
    });
});
