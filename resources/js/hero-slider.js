document.addEventListener('DOMContentLoaded', () => {
    const runners = [];

    document.querySelectorAll('[data-hero-slider]').forEach((root) => {
        const slides = root.querySelectorAll('[data-hero-slide]');
        if (slides.length < 2) {
            return;
        }

        const dots = root.querySelectorAll('[data-hero-dot]');
        const prevBtn = root.querySelector('[data-hero-prev]');
        const nextBtn = root.querySelector('[data-hero-next]');
        const raw = root.getAttribute('data-interval-ms');
        const intervalMs = Math.max(2500, Number.parseInt(raw ?? '5000', 10) || 5000);
        let index = 0;
        let timer = null;

        const show = (idx) => {
            slides.forEach((el, j) => {
                const on = j === idx;
                el.style.opacity = on ? '1' : '0';
                el.style.zIndex = on ? '1' : '0';
                el.setAttribute('aria-hidden', on ? 'false' : 'true');
            });
            dots.forEach((d, j) => {
                const on = j === idx;
                d.classList.toggle('bg-white', on);
                d.classList.toggle('bg-white/50', !on);
                d.setAttribute('aria-current', on ? 'true' : 'false');
            });
            index = idx;
        };

        const next = () => {
            show((index + 1) % slides.length);
        };

        const prev = () => {
            show((index - 1 + slides.length) % slides.length);
        };

        const stop = () => {
            if (timer) {
                clearInterval(timer);
                timer = null;
            }
        };

        const start = () => {
            stop();
            timer = window.setInterval(next, intervalMs);
        };

        const bump = (fn) => {
            fn();
            start();
        };

        prevBtn?.addEventListener('click', () => bump(prev));
        nextBtn?.addEventListener('click', () => bump(next));

        dots.forEach((d, j) => {
            d.addEventListener('click', () => {
                show(j);
                start();
            });
        });

        show(0);

        const pauseOnHover = [prevBtn, nextBtn, ...dots].filter(Boolean);
        pauseOnHover.forEach((el) => {
            el.addEventListener('mouseenter', stop);
            el.addEventListener('mouseleave', start);
        });

        root.addEventListener('focusin', (e) => {
            const t = e.target;
            if (t instanceof HTMLElement && t.closest('[data-hero-prev], [data-hero-next], [data-hero-dot]')) {
                stop();
            }
        });
        root.addEventListener('focusout', (e) => {
            const to = e.relatedTarget;
            if (! to || ! root.contains(to)) {
                start();
            }
        });

        runners.push({ start, stop });
        start();
    });

    if (runners.length === 0) {
        return;
    }

    document.addEventListener('visibilitychange', () => {
        if (document.hidden) {
            runners.forEach(({ stop }) => stop());
        } else {
            runners.forEach(({ start }) => start());
        }
    });
});
