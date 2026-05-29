@props([
    'capMax' => 50,
    'count' => 1,
])

@php
    $cap = max(1, (int) $capMax);
    $c = max(1, min((int) $count, $cap));
@endphp

<div {{ $attributes->class(['min-w-0']) }}>
    <span class="flex items-center gap-1.5 text-label-upper text-brand-blue">
        <x-dynamic-component :component="'lucide-users-round'" class="w-3 h-3 text-brand-blue/50" stroke-width="2.5" />
        Pasajeros
    </span>
    <div class="mt-1 flex items-center justify-center gap-2 sm:justify-start">
        <button
            type="button"
            class="hero-pax-minus flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-slate-200 bg-white text-sm font-bold text-slate-500 transition-all hover:bg-slate-50 hover:border-slate-300 active:scale-95 disabled:pointer-events-none disabled:opacity-30"
            aria-label="Menos pasajeros"
        >−</button>
        <input
            type="number"
            inputmode="numeric"
            min="1"
            max="{{ $cap }}"
            step="1"
            value="{{ $c }}"
            class="hero-pax-input min-w-0 w-11 shrink-0 rounded-lg border border-slate-200 bg-white px-1 py-1 text-center text-sm font-bold tabular-nums text-ink-strong [appearance:textfield] [&::-webkit-inner-spin-button]:appearance-none [&::-webkit-outer-spin-button]:appearance-none focus:border-brand-yellow focus:outline-none focus:ring-2 focus:ring-brand-yellow/50 transition-shadow"
            data-hero-pax-count
            autocomplete="off"
            aria-label="Escribir número de pasajeros"
        >
        <button
            type="button"
            class="hero-pax-plus flex h-8 w-8 shrink-0 items-center justify-center rounded-lg border border-brand-blue/20 bg-brand-blue/5 text-sm font-bold text-brand-blue transition-all hover:bg-brand-blue/10 active:scale-95 disabled:pointer-events-none disabled:opacity-30"
            aria-label="Más pasajeros"
        >+</button>
    </div>
</div>
