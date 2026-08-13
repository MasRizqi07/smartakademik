<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;
    public string $selectedRole = 'guru';

    /**
     * Handle an incoming authentication request.
     */
    public function login(): void
    {
        $this->validate();

        $this->form->authenticate();

        Session::regenerate();

        $this->redirectIntended(default: route('dashboard', absolute: false), navigate: true);
    }
}; ?>

<div class="glass-card rounded-xl shadow-soft p-8 w-full border border-border-default/50 relative overflow-hidden" x-data="{ showPassword: false }">
    <!-- Logo & Header -->
    <div class="text-center mb-8 flex flex-col items-center">
        <div class="w-16 h-16 mb-3 rounded-full bg-primary flex items-center justify-center text-on-primary shadow-md">
            <span class="material-symbols-outlined text-[36px]">school</span>
        </div>
        <h1 class="font-headline-lg text-headline-lg text-text-main font-bold tracking-tight">MAN 4 Jombang</h1>
        <p class="font-body-default text-body-default text-on-surface-variant mt-1">Sistem Informasi Akademik Terpadu</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Login Form -->
    <form wire:submit="login" class="space-y-5">
        <!-- Role Selection (Visual Accent Pills) -->
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-2">Login Sebagai</label>
            <div class="flex gap-2">
                <button type="button" @click="$wire.selectedRole = 'guru'" :class="$wire.selectedRole === 'guru' ? 'bg-primary-container text-on-primary-container border-primary-container font-semibold' : 'bg-surface text-secondary border-border-default hover:bg-surface-container'" class="flex-1 h-10 flex items-center justify-center rounded-DEFAULT border font-label-md text-label-md transition-all">
                    Guru
                </button>
                <button type="button" @click="$wire.selectedRole = 'siswa'" :class="$wire.selectedRole === 'siswa' ? 'bg-primary-container text-on-primary-container border-primary-container font-semibold' : 'bg-surface text-secondary border-border-default hover:bg-surface-container'" class="flex-1 h-10 flex items-center justify-center rounded-DEFAULT border font-label-md text-label-md transition-all">
                    Siswa
                </button>
                <button type="button" @click="$wire.selectedRole = 'admin'" :class="$wire.selectedRole === 'admin' ? 'bg-primary-container text-on-primary-container border-primary-container font-semibold' : 'bg-surface text-secondary border-border-default hover:bg-surface-container'" class="flex-1 h-10 flex items-center justify-center rounded-DEFAULT border font-label-md text-label-md transition-all">
                    Admin
                </button>
            </div>
        </div>

        <!-- Username/Email Field -->
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1" for="email">Username / Email / NIP / NISN</label>
            <div class="relative rounded-DEFAULT">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
                    <span class="material-symbols-outlined text-[20px]">person</span>
                </div>
                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" class="block w-full pl-10 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main placeholder:text-outline-variant focus-ring transition-colors" placeholder="Masukkan ID / Email Anda" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <!-- Password Field -->
        <div>
            <label class="block font-label-sm text-label-sm text-on-surface-variant mb-1" for="password">Password</label>
            <div class="relative rounded-DEFAULT">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-outline">
                    <span class="material-symbols-outlined text-[20px]">lock</span>
                </div>
                <input wire:model="form.password" id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" class="block w-full pl-10 pr-10 h-touch-target rounded-DEFAULT border border-border-default bg-surface-bright font-input-text text-input-text text-text-main placeholder:text-outline-variant focus-ring transition-colors" placeholder="••••••••" />
                <button type="button" @click="showPassword = !showPassword" aria-label="Toggle password visibility" class="absolute inset-y-0 right-0 pr-3 flex items-center text-outline hover:text-primary transition-colors focus:outline-none">
                    <span class="material-symbols-outlined text-[20px]" x-text="showPassword ? 'visibility' : 'visibility_off'">visibility_off</span>
                </button>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <!-- Footer Actions -->
        <div class="flex items-center justify-between pt-1">
            <label class="flex items-center gap-2 cursor-pointer group">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded border-border-default text-primary focus:ring-primary focus:ring-2 focus:ring-offset-1 bg-surface-bright transition-all cursor-pointer" />
                <span class="font-body-default text-body-default text-secondary group-hover:text-text-main transition-colors">Ingat Saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="font-label-md text-label-md text-primary hover:text-primary-container hover:underline transition-all" href="{{ route('password.request') }}" wire:navigate>
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full h-touch-target bg-primary hover:bg-primary-container text-on-primary font-label-md text-label-md rounded-DEFAULT shadow-sm hover:shadow-md transition-all flex items-center justify-center gap-2 active:scale-[0.98]">
            <span>Login</span>
            <span class="material-symbols-outlined text-[18px]">login</span>
        </button>
    </form>

    <!-- Support Footer -->
    <div class="mt-6 text-center border-t border-border-default/50 pt-4">
        <p class="font-body-default text-body-default text-outline text-[13px]">Butuh bantuan akses? Hubungi <a href="#" class="text-primary hover:underline font-medium">Tim IT Support</a>.</p>
    </div>
</div>

