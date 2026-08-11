@props(['type' => 'submit', 'variant' => 'primary', 'icon' => ''])

@php
$baseClasses = 'inline-flex items-center justify-center px-5 py-2.5 rounded-xl font-medium transition-all duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 active:scale-95 gap-2';

$variants = [
    'primary' => 'bg-gradient-to-r from-brand-600 to-brand-500 text-white hover:from-brand-500 hover:to-brand-400 focus:ring-brand-500 shadow-lg shadow-brand-500/30',
    'secondary' => 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:border-slate-300 focus:ring-slate-200 shadow-sm',
    'danger' => 'bg-gradient-to-r from-rose-600 to-rose-500 text-white hover:from-rose-500 hover:to-rose-400 focus:ring-rose-500 shadow-lg shadow-rose-500/30',
    'success' => 'bg-gradient-to-r from-emerald-600 to-emerald-500 text-white hover:from-emerald-500 hover:to-emerald-400 focus:ring-emerald-500 shadow-lg shadow-emerald-500/30',
    'ghost' => 'bg-transparent text-slate-600 hover:bg-slate-100 hover:text-slate-900',
];

$classes = $baseClasses . ' ' . ($variants[$variant] ?? $variants['primary']);
@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => $classes]) }}>
    @if($icon)
        <span class="w-5 h-5">{!! $icon !!}</span>
    @endif
    
    <span wire:loading.remove wire:target="{{ $attributes->get('wire:click') ?? $attributes->get('wire:submit') }}">
        {{ $slot }}
    </span>
    
    @if($attributes->has('wire:click') || $attributes->has('wire:submit'))
    <span wire:loading wire:target="{{ $attributes->get('wire:click') ?? $attributes->get('wire:submit') }}" class="flex items-center gap-2">
        <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-current" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Memproses...
    </span>
    @endif
</button>
