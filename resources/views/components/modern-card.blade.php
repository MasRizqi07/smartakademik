@props(['title' => '', 'icon' => ''])

<div {{ $attributes->merge(['class' => 'bg-white rounded-2xl shadow-soft border border-slate-100 overflow-hidden transition-all duration-300 hover:shadow-lg hover:-translate-y-1']) }}>
    @if($title || $icon)
    <div class="px-6 py-5 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
        <h3 class="text-lg font-semibold text-slate-800 flex items-center gap-2">
            @if($icon)
                <span class="text-brand-500">{!! $icon !!}</span>
            @endif
            {{ $title }}
        </h3>
        @if(isset($action))
            <div>{{ $action }}</div>
        @endif
    </div>
    @endif
    
    <div class="p-6">
        {{ $slot }}
    </div>
    
    @if(isset($footer))
    <div class="px-6 py-4 bg-slate-50 border-t border-slate-100">
        {{ $footer }}
    </div>
    @endif
</div>
