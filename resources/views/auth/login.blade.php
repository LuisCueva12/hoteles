<!DOCTYPE html>
<html lang="es" class="h-full">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Acceso Administrativo — {{ config('app.name') }}</title>
    <link rel="icon" type="image/webp" href="{{ asset('favicon.webp') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="h-full bg-slate-50 font-sans antialiased">

<div class="min-h-screen flex">

    {{-- Panel izquierdo: imagen + branding --}}
    <div class="hidden lg:flex lg:w-[55%] xl:w-[60%] relative overflow-hidden bg-brand-blue flex-col">

        {{-- Imagen de fondo --}}
        <img src="{{ asset('img/hero-principal.webp') }}"
            alt="Adventur Hotels"
            class="absolute inset-0 w-full h-full object-cover object-center opacity-40">
        <div class="absolute inset-0"
            style="background: linear-gradient(135deg, rgba(0,31,63,0.95) 0%, rgba(0,31,63,0.75) 50%, rgba(0,31,63,0.60) 100%)"></div>

        {{-- Contenido branding --}}
        <div class="relative z-10 flex flex-col h-full p-12">

            {{-- Logo --}}
            <div class="shrink-0">
                <a href="{{ route('inicio') }}">
                    <img src="{{ asset('img/logo.webp') }}"
                        alt="{{ config('app.name') }}"
                        class="h-12 w-auto object-contain bg-white/90 rounded-xl px-4 py-2">
                </a>
            </div>

            {{-- Texto central --}}
            <div class="flex-1 flex flex-col justify-center max-w-md">
                <p class="text-brand-yellow text-[0.65rem] font-bold uppercase tracking-[0.22em] mb-4">Panel Administrativo</p>
                <h1 class="text-white text-4xl xl:text-5xl font-bold leading-tight mb-5">
                    Gestiona tus<br>
                    <span class="text-brand-yellow">hoteles</span> con<br>
                    total control
                </h1>
                <p class="text-white/55 text-sm leading-relaxed">
                    Administra hoteles, reservas, destinos y configuraciones desde un solo lugar.
                </p>
            </div>

            {{-- Stats bottom --}}
            <div class="shrink-0 flex items-center gap-8">
                <div>
                    <p class="text-white font-bold text-2xl">{{ \App\Models\Hotel::where('activo', true)->count() }}</p>
                    <p class="text-white/40 text-xs font-medium uppercase tracking-wide">Hoteles activos</p>
                </div>
                <div class="w-px h-8 bg-white/15" aria-hidden="true"></div>
                <div>
                    <p class="text-white font-bold text-2xl">{{ \App\Models\Destino::where('activo', true)->count() }}</p>
                    <p class="text-white/40 text-xs font-medium uppercase tracking-wide">Destinos</p>
                </div>
                <div class="w-px h-8 bg-white/15" aria-hidden="true"></div>
                <div>
                    <p class="text-white font-bold text-2xl">{{ \App\Models\Reserva::where('estado', 'pendiente')->count() }}</p>
                    <p class="text-white/40 text-xs font-medium uppercase tracking-wide">Reservas pendientes</p>
                </div>
            </div>

        </div>
    </div>

    {{-- Panel derecho: formulario --}}
    <div class="flex-1 flex flex-col justify-center px-6 py-12 sm:px-12 lg:px-16 xl:px-20 bg-white">

        <div class="w-full max-w-sm mx-auto">

            {{-- Logo mobile --}}
            <div class="lg:hidden mb-8 flex justify-center">
                <img src="{{ asset('img/logo.webp') }}"
                    alt="{{ config('app.name') }}"
                    class="h-10 w-auto object-contain">
            </div>

            {{-- Header --}}
            <div class="mb-8">
                <h2 class="text-slate-900 text-2xl font-bold mb-1">Bienvenido de nuevo</h2>
                <p class="text-slate-500 text-sm">Ingresa tus credenciales para continuar</p>
            </div>

            {{-- Error --}}
            @if($errors->any())
                <div class="mb-5 flex items-start gap-3 bg-red-50 border border-red-200 text-red-700 rounded-xl px-4 py-3.5">
                    <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                    <p class="text-sm font-medium">{{ $errors->first() }}</p>
                </div>
            @endif

            {{-- Formulario --}}
            <form method="POST" action="{{ route('login.post') }}" class="space-y-5">
                @csrf

                {{-- Email --}}
                <div>
                    <label for="email" class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-2">
                        Correo electrónico
                    </label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="email"
                        placeholder="admin@empresa.com"
                        class="w-full px-4 py-3 rounded-xl border @error('email') border-red-300 bg-red-50 @else border-slate-200 bg-slate-50 @enderror text-slate-900 text-sm font-medium placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition-all"
                    >
                </div>

                {{-- Contraseña --}}
                <div>
                    <label for="password" class="block text-xs font-semibold text-slate-600 uppercase tracking-wide mb-2">
                        Contraseña
                    </label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            autocomplete="current-password"
                            placeholder="••••••••"
                            class="w-full px-4 py-3 pr-11 rounded-xl border border-slate-200 bg-slate-50 text-slate-900 text-sm font-medium placeholder:text-slate-400 focus:outline-none focus:ring-2 focus:ring-brand-blue/20 focus:border-brand-blue transition-all"
                        >
                        <button type="button"
                            onclick="togglePassword()"
                            class="absolute right-3.5 top-1/2 -translate-y-1/2 text-slate-400 hover:text-slate-600 transition-colors focus:outline-none"
                            aria-label="Mostrar/ocultar contraseña">
                            <svg id="eye-icon" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                            </svg>
                        </button>
                    </div>
                </div>

                {{-- Recordar --}}
                <div class="flex items-center justify-between">
                    <label class="flex items-center gap-2.5 cursor-pointer group">
                        <input type="checkbox" name="remember" id="remember"
                            class="w-4 h-4 rounded border-slate-300 text-brand-blue focus:ring-brand-blue/20 cursor-pointer">
                        <span class="text-sm text-slate-600 group-hover:text-slate-800 transition-colors">Recordarme</span>
                    </label>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full bg-brand-blue text-white font-bold text-sm py-3.5 px-6 rounded-xl hover:bg-blue-900 active:scale-[0.98] transition-all shadow-sm shadow-brand-blue/20 flex items-center justify-center gap-2 group">
                    Iniciar sesión
                    <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/>
                    </svg>
                </button>

            </form>

            {{-- Footer --}}
            <div class="mt-8 pt-6 border-t border-slate-100 text-center">
                <a href="{{ route('inicio') }}"
                    class="inline-flex items-center gap-1.5 text-slate-400 hover:text-brand-blue text-xs font-medium transition-colors">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                    </svg>
                    Volver al sitio web
                </a>
            </div>

        </div>
    </div>

</div>

<script>
function togglePassword() {
    var input = document.getElementById('password');
    var icon  = document.getElementById('eye-icon');
    if (input.type === 'password') {
        input.type = 'text';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.88 9.88l-3.29-3.29m7.532 7.532l3.29 3.29M3 3l3.59 3.59m0 0A9.953 9.953 0 0112 5c4.478 0 8.268 2.943 9.543 7a10.025 10.025 0 01-4.132 4.411m0 0L21 21"/>';
    } else {
        input.type = 'password';
        icon.innerHTML = '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>';
    }
}
</script>

</body>
</html>
