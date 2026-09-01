<?php

use App\Livewire\Forms\LoginForm;
use Illuminate\Support\Facades\Session;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public LoginForm $form;
    public string $selectedRole = 'guru';

    public function mount(): void
    {
        $role = request()->query('role', 'guru');
        if (in_array($role, ['guru', 'siswa', 'admin', 'waka'])) {
            $this->selectedRole = $role;
        }
    }

    public function setRole(string $role): void
    {
        $this->selectedRole = $role;

        // Auto fill demo credential
        if ($role === 'guru') {
            $this->form->email = 'guru@smartakademik.test';
            $this->form->password = 'password';
        } elseif ($role === 'siswa') {
            $this->form->email = 'siswa@smartakademik.test';
            $this->form->password = 'password';
        } elseif ($role === 'admin') {
            $this->form->email = 'admin@smartakademik.test';
            $this->form->password = 'password';
        } elseif ($role === 'waka') {
            $this->form->email = 'waka@smartakademik.test';
            $this->form->password = 'password';
        }
    }

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

<div class="bg-surface rounded-2xl shadow-card p-6 sm:p-8 w-full border border-border relative overflow-hidden" x-data="{ showPassword: false }">
    <!-- Logo & Header -->
    <div class="text-center mb-6 flex flex-col items-center">
        <div class="w-14 h-14 mb-3 rounded-2xl bg-brand flex items-center justify-center text-white shadow-md">
            <svg class="w-7 h-7" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" />
            </svg>
        </div>
        <h1 class="text-2xl font-extrabold text-brand tracking-tight">MAN 4 Jombang</h1>
        <p class="text-xs text-text-secondary mt-1">Sistem Informasi Akademik Terpadu</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Role Selection Tabs -->
    <div class="mb-6">
        <label class="block text-xs font-semibold text-text-secondary mb-2">Pilih Peran Akun</label>
        <div class="grid grid-cols-4 gap-1.5 p-1 bg-surface-page rounded-xl border border-border">
            <button type="button" wire:click="setRole('guru')" class="py-2 text-xs rounded-lg transition-all font-semibold flex items-center justify-center {{ $selectedRole === 'guru' ? 'bg-brand text-white shadow-xs' : 'text-text-secondary hover:text-brand' }}">
                Guru
            </button>
            <button type="button" wire:click="setRole('siswa')" class="py-2 text-xs rounded-lg transition-all font-semibold flex items-center justify-center {{ $selectedRole === 'siswa' ? 'bg-brand text-white shadow-xs' : 'text-text-secondary hover:text-brand' }}">
                Siswa
            </button>
            <button type="button" wire:click="setRole('waka')" class="py-2 text-xs rounded-lg transition-all font-semibold flex items-center justify-center {{ $selectedRole === 'waka' ? 'bg-brand text-white shadow-xs' : 'text-text-secondary hover:text-brand' }}">
                Waka
            </button>
            <button type="button" wire:click="setRole('admin')" class="py-2 text-xs rounded-lg transition-all font-semibold flex items-center justify-center {{ $selectedRole === 'admin' ? 'bg-brand text-white shadow-xs' : 'text-text-secondary hover:text-brand' }}">
                Admin
            </button>
        </div>
    </div>

    <!-- Login Form -->
    <form wire:submit="login" class="space-y-4">
        <!-- Email / ID -->
        <div>
            <label class="block text-xs font-semibold text-text-primary mb-1.5" for="email">Username / Email / NIP / NISN</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-secondary">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>
                <input wire:model="form.email" id="email" type="email" name="email" required autofocus autocomplete="username" class="block w-full pl-10 pr-3 py-2.5 rounded-lg border border-border bg-surface-page text-sm text-text-primary placeholder:text-text-secondary focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all outline-none" placeholder="Masukkan ID / Email Anda" />
            </div>
            <x-input-error :messages="$errors->get('form.email')" class="mt-1" />
        </div>

        <!-- Password Field -->
        <div>
            <label class="block text-xs font-semibold text-text-primary mb-1.5" for="password">Kata Sandi</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none text-text-secondary">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>
                <input wire:model="form.password" id="password" :type="showPassword ? 'text' : 'password'" name="password" required autocomplete="current-password" class="block w-full pl-10 pr-10 py-2.5 rounded-lg border border-border bg-surface-page text-sm text-text-primary placeholder:text-text-secondary focus:border-brand focus:ring-2 focus:ring-brand/20 transition-all outline-none" placeholder="••••••••" />
                <button type="button" @click="showPassword = !showPassword" aria-label="Toggle password visibility" class="absolute inset-y-0 right-0 pr-3 flex items-center text-text-secondary hover:text-brand transition-colors focus:outline-none">
                    <svg x-show="!showPassword" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                    </svg>
                    <svg x-show="showPassword" x-cloak class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 0 0 1.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.451 10.451 0 0 1 12 4.5c4.756 0 8.773 3.162 10.065 7.498a10.522 10.522 0 0 1-4.293 5.774M6.228 6.228 3 3m3.228 3.228 3.65 3.65m7.894 7.894L21 21m-3.228-3.228-3.65-3.65m0 0a3 3 0 1 0-4.243-4.243m4.242 4.242L9.88 9.88" />
                    </svg>
                </button>
            </div>
            <x-input-error :messages="$errors->get('form.password')" class="mt-1" />
        </div>

        <!-- Remember Me & Forgot Password -->
        <div class="flex items-center justify-between text-xs pt-1">
            <label class="flex items-center gap-2 cursor-pointer">
                <input wire:model="form.remember" id="remember" type="checkbox" name="remember" class="h-4 w-4 rounded border-border text-brand focus:ring-brand focus:ring-offset-1 bg-surface-page cursor-pointer" />
                <span class="text-text-secondary">Ingat Saya</span>
            </label>
            @if (Route::has('password.request'))
                <a class="text-brand hover:underline font-semibold" href="{{ route('password.request') }}" wire:navigate>
                    Lupa Password?
                </a>
            @endif
        </div>

        <!-- Submit Button -->
        <button type="submit" class="w-full py-3 bg-brand hover:bg-brand-hover text-white font-bold text-sm rounded-xl shadow-md transition-all flex items-center justify-center gap-2 active:scale-95">
            <span>Masuk ke Sistem</span>
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5 21 12m0 0-7.5 7.5M21 12H3" />
            </svg>
        </button>
    </form>

    <!-- Back to Public Link -->
    <div class="mt-6 pt-4 border-t border-border text-center text-xs text-text-secondary">
        <a href="{{ route('home') }}" class="hover:text-brand transition-colors inline-flex items-center gap-1">
            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
            </svg>
            <span>Kembali ke Beranda</span>
        </a>
    </div>
</div>
