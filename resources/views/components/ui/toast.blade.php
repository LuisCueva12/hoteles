<div id="toast-container" class="fixed top-6 right-6 z-[100] pointer-events-none">
    <div id="toast-message" class="flex items-center gap-3 px-4 py-3 bg-white/90 backdrop-blur-md border border-slate-200 shadow-2xl rounded-xl opacity-0 translate-x-10 transition-all duration-500 ease-in-out max-w-sm">
        <div class="flex-shrink-0 w-8 h-8 bg-green-500/10 rounded-lg flex items-center justify-center">
            <x-dynamic-component :component="'lucide-check-circle-2'" class="w-5 h-5 text-green-600" stroke-width="2.5" />
        </div>
        <div class="flex-1">
            <p id="toast-text" class="text-sm font-semibold text-slate-800 leading-tight">¡Mensaje enviado con éxito!</p>
        </div>
        <button onclick="this.parentElement.classList.add('opacity-0', 'translate-x-10')" aria-label="Cerrar notificación" class="ml-2 text-slate-400 hover:text-slate-600 transition-colors pointer-events-auto">
            <x-dynamic-component :component="'lucide-x'" class="w-4 h-4" />
        </button>
    </div>
</div>

<script>
    window.showToast = function(message = null) {
        const toast = document.getElementById('toast-message');
        const text = document.getElementById('toast-text');
        
        if (message) text.innerText = message;
        
        toast.classList.remove('opacity-0', 'translate-x-10');
        toast.classList.add('opacity-100', 'translate-x-0');
        
        setTimeout(() => {
            toast.classList.remove('opacity-100', 'translate-x-0');
            toast.classList.add('opacity-0', 'translate-x-10');
        }, 5000);
    }

    @if(session('success'))
        document.addEventListener('DOMContentLoaded', () => {
            window.showToast("{{ session('success') }}");
        });
    @endif
</script>
