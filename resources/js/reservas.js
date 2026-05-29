const initReservas = () => {
    const fechaInicio = document.getElementById('ws_fecha_inicio');
    const fechaFin = document.getElementById('ws_fecha_fin');

    if (fechaInicio && fechaFin) {
        fechaInicio.addEventListener('change', () => {
            const minFin = new Date(fechaInicio.value);
            minFin.setDate(minFin.getDate() + 1);
            fechaFin.min = minFin.toISOString().split('T')[0];
            if (fechaFin.value && fechaFin.value <= fechaInicio.value) {
                fechaFin.value = minFin.toISOString().split('T')[0];
            }
        });
    }

    const passengerContainers = document.querySelectorAll('.passenger-selector-container');

    passengerContainers.forEach((container) => {
        if (container.dataset.initialized) return;
        container.dataset.initialized = 'true';

        const trigger = container.querySelector('.btn-passenger-trigger');
        const dropdown = container.querySelector('.dropdown-passenger');
        const confirmBtn = container.querySelector('.btn-passenger-confirm');
        const summaryText = container.querySelector('.passenger-summary-text');
        const hiddenInput = container.querySelector('.ws_pasajeros_resumen');
        const hiddenAdultos = container.querySelector('.ws_adultos');
        const hiddenNinos = container.querySelector('.ws_ninos');
        const warningEl = container.querySelector('.pax-warning');

        const maxPasajeros = parseInt(container.getAttribute('data-max')) || 10;

        const displayAdultos = container.closest('form').querySelector('.pax-display-adultos');
        const displayNinos = container.closest('form').querySelector('.pax-display-ninos');

        let state = {
            open: false,
            adultos: 1,
            ninos: 0
        };

        const toggleDropdown = (forceClose = false) => {
            state.open = forceClose ? false : !state.open;
            if (state.open) {
                if (dropdown) dropdown.classList.remove('hidden');
                if (trigger) trigger.classList.add('ring-2', 'ring-brand-blue');
            } else {
                if (dropdown) dropdown.classList.add('hidden');
                if (trigger) trigger.classList.remove('ring-2', 'ring-brand-blue');
            }
        };

        const updateTotal = () => {
            const total = state.adultos + state.ninos;

            if (summaryText) summaryText.textContent = total === 1 ? '1 huésped' : `${total} huéspedes`;
            if (hiddenInput) hiddenInput.value = `${state.adultos} Adulto(s), ${state.ninos} Niño(s)`;
            if (hiddenAdultos) hiddenAdultos.value = String(state.adultos);
            if (hiddenNinos) hiddenNinos.value = String(state.ninos);

            // Update display boxes
            if (displayAdultos) displayAdultos.textContent = state.adultos;
            if (displayNinos) displayNinos.textContent = state.ninos;

            if (warningEl) {
                if (total >= maxPasajeros) warningEl.classList.remove('hidden');
                else warningEl.classList.add('hidden');
            }

            const elAdultos = container.querySelector('.pax-count-adultos');
            const elNinos = container.querySelector('.pax-count-ninos');

            if (elAdultos) elAdultos.textContent = state.adultos;
            if (elNinos) elNinos.textContent = state.ninos;

            const minA = container.querySelector('.btn-pax-minus[data-type="adultos"]');
            if (minA) minA.disabled = state.adultos <= 1;

            const minN = container.querySelector('.btn-pax-minus[data-type="ninos"]');
            if (minN) minN.disabled = state.ninos <= 0;

            const maxReached = total >= maxPasajeros;
            container.querySelectorAll('.btn-pax-plus').forEach(btn => {
                btn.disabled = maxReached;
                if (maxReached) {
                    btn.classList.replace('border-brand-blue', 'border-slate-200');
                    btn.classList.replace('text-brand-blue', 'text-slate-500');
                } else {
                    btn.classList.replace('border-slate-200', 'border-brand-blue');
                    btn.classList.replace('text-slate-500', 'text-brand-blue');
                }
            });
        };

        if (trigger) trigger.addEventListener('click', (e) => {
            e.preventDefault();
            toggleDropdown();
        });

        if (confirmBtn) confirmBtn.addEventListener('click', (e) => {
            e.preventDefault();
            toggleDropdown(true);
        });

        document.addEventListener('click', (e) => {
            if (state.open && !container.contains(e.target)) toggleDropdown(true);
        });

        container.querySelectorAll('.btn-pax-minus, .btn-pax-plus').forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.preventDefault();
                const type = e.target.getAttribute('data-type') || e.target.closest('button').getAttribute('data-type');
                if (!type) return;

                const isPlus = e.target.classList.contains('btn-pax-plus') || e.target.closest('button').classList.contains('btn-pax-plus');

                if (isPlus && (state.adultos + state.ninos) < maxPasajeros) {
                    state[type]++;
                } else if (!isPlus) {
                    if (type === 'adultos' && state[type] > 1) state[type]--;
                    if (type !== 'adultos' && state[type] > 0) state[type]--;
                }

                updateTotal();
            });
        });

        updateTotal();
    });
};

document.addEventListener('DOMContentLoaded', initReservas);
document.addEventListener('livewire:navigated', initReservas);
if (typeof Livewire !== 'undefined') Livewire.hook('message.processed', initReservas);
