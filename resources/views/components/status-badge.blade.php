@props(['status'])

@php
$baseClasses = 'inline-flex items-center px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-colors duration-200';

$variants = [
    'Hadir' => 'bg-green-100 text-green-700 border border-green-200 shadow-sm shadow-green-100',
    'Izin' => 'bg-amber-100 text-amber-700 border border-amber-200 shadow-sm shadow-amber-100',
    'Sakit' => 'bg-sky-100 text-sky-700 border border-sky-200 shadow-sm shadow-sky-100',
    'Alfa' => 'bg-rose-100 text-rose-700 border border-rose-200 shadow-sm shadow-rose-100',
    'default' => 'bg-slate-100 text-slate-600 border border-slate-200',
];

$classes = $baseClasses . ' ' . ($variants[$status] ?? $variants['default']);

$icons = [
    'Hadir' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>',
    'Izin' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'Sakit' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>',
    'Alfa' => '<svg class="w-3.5 h-3.5 mr-1.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>',
    'default' => '',
];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {!! $icons[$status] ?? $icons['default'] !!}
    {{ $slot->isEmpty() ? $status : $slot }}
</span>
