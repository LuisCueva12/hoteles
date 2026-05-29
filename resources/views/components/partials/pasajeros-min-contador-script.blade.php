<script>
(function () {
    var counterSubmitTimers = {};
    function schedulePaxCounterSubmit(form) {
        if (!form || form.getAttribute('data-pax-counter-auto-submit') !== '1') {
            return;
        }
        var fid = form.id;
        if (!fid) {
            fid = 'pax-ctr-' + String(Math.random()).slice(2);
            form.id = fid;
        }
        clearTimeout(counterSubmitTimers[fid]);
        counterSubmitTimers[fid] = setTimeout(function () {
            if (typeof form.requestSubmit === 'function') {
                form.requestSubmit();
            } else {
                form.submit();
            }
        }, 360);
    }
    function initPaxMinCounterForm(form) {
        if (!form || form.getAttribute('data-pax-min-counter-init') === '1') {
            return;
        }
        form.setAttribute('data-pax-min-counter-init', '1');
        var cap = parseInt(form.getAttribute('data-pax-cap'), 10);
        if (!Number.isFinite(cap) || cap < 1) {
            cap = 50;
        }
        var hidden = form.querySelector('input.hero-pax-hidden[name="pasajeros_min"]');
        if (!hidden) {
            return;
        }
        function readN() {
            var raw = (hidden.value || '').trim();
            if (raw === '') {
                return 1;
            }
            var n = parseInt(raw, 10);
            if (!Number.isFinite(n) || n < 2) {
                return 1;
            }
            return Math.min(cap, n);
        }
        function applyN(n, opts) {
            opts = opts || {};
            n = Math.min(cap, Math.max(1, n));
            hidden.value = n <= 1 ? '' : String(n);
            form.querySelectorAll('[data-hero-pax-count]').forEach(function (el) {
                if (el.tagName === 'INPUT') {
                    el.value = String(n);
                } else {
                    el.textContent = String(n);
                }
            });
            form.querySelectorAll('.hero-pax-minus').forEach(function (btn) {
                btn.disabled = n <= 1;
            });
            form.querySelectorAll('.hero-pax-plus').forEach(function (btn) {
                btn.disabled = n >= cap;
            });
            if (opts.fromUser) {
                schedulePaxCounterSubmit(form);
            }
        }
        function syncFromTypedInput(inp) {
            var raw = (inp.value || '').trim();
            if (raw === '') {
                applyN(1, { fromUser: true });
                return;
            }
            var v = parseInt(raw, 10);
            if (!Number.isFinite(v)) {
                applyN(readN(), { fromUser: false });
                return;
            }
            applyN(v, { fromUser: true });
        }
        form.querySelectorAll('.hero-pax-minus').forEach(function (btn) {
            btn.addEventListener('click', function () {
                applyN(readN() - 1, { fromUser: true });
            });
        });
        form.querySelectorAll('.hero-pax-plus').forEach(function (btn) {
            btn.addEventListener('click', function () {
                applyN(readN() + 1, { fromUser: true });
            });
        });
        form.querySelectorAll('.hero-pax-input').forEach(function (inp) {
            inp.addEventListener('change', function () {
                syncFromTypedInput(inp);
            });
            inp.addEventListener('blur', function () {
                syncFromTypedInput(inp);
            });
        });
        applyN(readN(), { fromUser: false });
    }
    function boot() {
        document.querySelectorAll('form[data-pax-min-counter]').forEach(initPaxMinCounterForm);
    }
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', boot);
    } else {
        boot();
    }
})();
</script>
