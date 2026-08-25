@props([
    'variant' => 'button', // 'button', 'pill', 'compact'
    'showLabel' => false,
])

<div 
    x-data="{
        isDark: false,
        init() {
            this.isDark = document.documentElement.classList.contains('dark');
            window.addEventListener('theme-changed', (e) => {
                this.isDark = e.detail.isDark;
            });
        },
        toggle() {
            window.toggleTheme();
            this.isDark = document.documentElement.classList.contains('dark');
        }
    }"
    class="inline-flex items-center"
>
    @if($variant === 'pill')
        <!-- Pill Switch Variant -->
        <button 
            type="button"
            role="switch"
            :aria-checked="isDark.toString()"
            aria-label="Beralih mode tema gelap dan terang"
            @click="toggle()"
            {{ $attributes->merge(['class' => 'relative inline-flex h-8 w-16 shrink-0 cursor-pointer items-center rounded-full p-1 transition-colors duration-300 ease-in-out focus:outline-none focus:ring-2 focus:ring-primary focus:ring-offset-2 bg-surface-container border border-border-default dark:bg-surface-container-high dark:border-slate-700']) }}
        >
            <!-- Background Icons -->
            <div class="absolute inset-0 flex items-center justify-between px-2 text-[14px] pointer-events-none select-none">
                <span class="material-symbols-outlined text-amber-500 text-[14px] transition-opacity duration-200" :class="isDark ? 'opacity-40' : 'opacity-100'">light_mode</span>
                <span class="material-symbols-outlined text-indigo-400 text-[14px] transition-opacity duration-200" :class="isDark ? 'opacity-100' : 'opacity-40'">dark_mode</span>
            </div>

            <!-- Sliding Knob -->
            <span 
                class="pointer-events-none relative inline-block h-6 w-6 transform rounded-full bg-white dark:bg-slate-900 shadow-md ring-0 transition duration-300 ease-in-out flex items-center justify-center text-on-surface"
                :class="isDark ? 'translate-x-8' : 'translate-x-0'"
            >
                <template x-if="!isDark">
                    <span class="material-symbols-outlined text-[15px] text-amber-500 animate-fade-in">light_mode</span>
                </template>
                <template x-if="isDark">
                    <span class="material-symbols-outlined text-[15px] text-emerald-400 animate-fade-in">dark_mode</span>
                </template>
            </span>
        </button>

    @elseif($variant === 'compact')
        <!-- Compact Icon Button -->
        <button 
            type="button"
            @click="toggle()"
            :title="isDark ? 'Ganti ke Mode Terang' : 'Ganti ke Mode Gelap'"
            aria-label="Ganti mode tema"
            {{ $attributes->merge(['class' => 'relative w-8 h-8 rounded-lg flex items-center justify-center text-on-surface-variant hover:text-text-main hover:bg-surface-container transition-all active:scale-95']) }}
        >
            <span 
                x-show="!isDark" 
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 rotate-45 scale-75"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                class="material-symbols-outlined text-[18px] text-amber-500"
            >
                light_mode
            </span>
            <span 
                x-show="isDark" 
                x-cloak
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 -rotate-45 scale-75"
                x-transition:enter-end="opacity-100 rotate-0 scale-100"
                class="material-symbols-outlined text-[18px] text-emerald-400"
            >
                dark_mode
            </span>
        </button>

    @else
        <!-- Standard Button Variant with Glow & Hover Feedback -->
        <button 
            type="button"
            @click="toggle()"
            :title="isDark ? 'Ganti ke Mode Terang (Light Mode)' : 'Ganti ke Mode Gelap (Dark Mode)'"
            aria-label="Ganti mode tampilan tema"
            {{ $attributes->merge(['class' => 'relative group px-2.5 py-1.5 rounded-xl border border-border-default bg-surface-container-lowest hover:bg-surface-container text-on-surface-variant hover:text-text-main shadow-xs hover:shadow-sm transition-all duration-200 flex items-center gap-2 active:scale-[0.97]']) }}
        >
            <div class="w-6 h-6 rounded-lg flex items-center justify-center transition-transform group-hover:scale-110">
                <span 
                    x-show="!isDark" 
                    x-transition:enter="transition ease-out duration-250 transform"
                    x-transition:enter-start="opacity-0 rotate-90 scale-50"
                    x-transition:enter-end="opacity-100 rotate-0 scale-100"
                    class="material-symbols-outlined text-[20px] text-amber-500"
                >
                    light_mode
                </span>
                <span 
                    x-show="isDark" 
                    x-cloak
                    x-transition:enter="transition ease-out duration-250 transform"
                    x-transition:enter-start="opacity-0 -rotate-90 scale-50"
                    x-transition:enter-end="opacity-100 rotate-0 scale-100"
                    class="material-symbols-outlined text-[20px] text-emerald-400"
                >
                    dark_mode
                </span>
            </div>

            @if($showLabel)
                <span class="text-xs font-semibold text-text-main pr-1" x-text="isDark ? 'Gelap' : 'Terang'"></span>
            @endif
        </button>
    @endif
</div>
