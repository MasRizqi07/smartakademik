@props(['status'])

@php
$baseClasses = 'inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider whitespace-nowrap transition-colors duration-200';

$variants = [
    'Hadir' => 'bg-status-hadir/10 text-status-hadir',
    'Izin'  => 'bg-status-izin/10 text-status-izin',
    'Sakit' => 'bg-status-sakit/10 text-status-sakit',
    'Alfa'  => 'bg-status-alfa/10 text-status-alfa',
    'default' => 'bg-slate-100 text-text-secondary',
];

$classes = $baseClasses . ' ' . ($variants[$status] ?? $variants['default']);

// Heroicon SVG icons (outline, 3.5×3.5)
$icons = [
    'Hadir' => '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"></path></svg>',
    'Izin' => '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>',
    'Sakit' => '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126ZM12 15.75h.007v.008H12v-.008Z"></path></svg>',
    'Alfa' => '<svg class="w-3.5 h-3.5" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"></path></svg>',
    'default' => '',
];
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {!! $icons[$status] ?? $icons['default'] !!}
    {{ $slot->isEmpty() ? $status : $slot }}
</span>
