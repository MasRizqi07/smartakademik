<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<div x-data="{ mobileOpen: false }">
    <!-- Desktop Sidebar Navbar -->
    <nav class="hidden md:flex bg-surface-container-lowest shadow-sm h-screen w-64 fixed left-0 top-0 flex-col p-4 border-r border-border-default z-40">
        <!-- Brand Header -->
        <div class="mb-6 flex flex-col gap-1 px-3 pt-2">
            <div class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold shadow-xs">
                    <span class="material-symbols-outlined text-[20px]">school</span>
                </div>
                <div>
                    <h1 class="font-headline-md text-[18px] leading-tight font-bold text-primary">MAN 4 Jombang</h1>
                    <p class="font-label-sm text-[11px] text-on-surface-variant uppercase tracking-wider">Academic Portal</p>
                </div>
            </div>
        </div>

        <!-- Navigation Links -->
        <ul class="flex flex-col gap-1 flex-1 overflow-y-auto py-2">
            @php
                $user = auth()->user();
            @endphp

            @if($user && $user->hasRole('admin_tu'))
                <li>
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.siswa*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">groups</span>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.guru*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">badge</span>
                        <span>Data Guru & User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.kelas*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">meeting_room</span>
                        <span>Data Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.mapel*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">book</span>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.import') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('admin.import*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">upload_file</span>
                        <span>Import Excel</span>
                    </a>
                </li>
            @elseif($user && $user->hasRole('waka_kurikulum'))
                <li>
                    <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('waka.dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        <span>Dashboard Waka</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('waka.jadwal*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('waka.rekap-absensi*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                        <span>Rekap Absensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('waka.rekap-nilai*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">assessment</span>
                        <span>Laporan Nilai</span>
                    </a>
                </li>
            @elseif($user && $user->hasRole('guru'))
                <li>
                    <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('guru.dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        <span>Beranda Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('guru.absensi*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">fact_check</span>
                        <span>Input Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('guru.nilai*') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">edit_note</span>
                        <span>Input Formatif</span>
                    </a>
                </li>
            @elseif($user && $user->hasRole('siswa'))
                <li>
                    <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('siswa.dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">person_pin</span>
                        <span>Portal Siswa</span>
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ route('dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('dashboard') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[20px]">dashboard</span>
                        <span>Dashboard</span>
                    </a>
                </li>
            @endif

            <li class="mt-4 pt-3 border-t border-border-default/60">
                <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg font-label-md transition-all {{ request()->routeIs('profile') ? 'bg-secondary-container text-on-secondary-container font-bold' : 'text-on-surface-variant hover:bg-surface-container hover:text-text-main' }}">
                    <span class="material-symbols-outlined text-[20px]">account_circle</span>
                    <span>Profil Pengguna</span>
                </a>
            </li>
        </ul>

        <!-- User Info & Logout Button -->
        <div class="mt-auto pt-4 border-t border-border-default flex flex-col gap-3">
            <div class="flex items-center gap-3 px-2">
                <div class="w-10 h-10 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-sm shadow-xs shrink-0">
                    {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                </div>
                <div class="flex flex-col min-w-0 overflow-hidden">
                    <span class="font-label-md text-text-main truncate font-medium">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                    <span class="font-label-sm text-on-surface-variant truncate text-[11px] uppercase tracking-wider">{{ auth()->user()->roles->pluck('name')->first() ?? 'User' }}</span>
                </div>
            </div>

            <button wire:click="logout" class="w-full h-touch-target bg-error/10 hover:bg-error/20 text-error font-label-md rounded-lg transition-all flex items-center justify-center gap-2 active:scale-95">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                <span>Keluar</span>
            </button>
        </div>
    </nav>

    <!-- Mobile Header Navigation Topbar -->
    <header class="md:hidden bg-surface-container-lowest border-b border-border-default px-4 h-16 sticky top-0 flex justify-between items-center z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-md bg-primary flex items-center justify-center text-on-primary font-bold">
                <span class="material-symbols-outlined text-[18px]">school</span>
            </div>
            <span class="font-headline-md text-headline-md text-primary font-extrabold">MAN 4 Jombang</span>
        </div>

        <button @click="mobileOpen = !mobileOpen" aria-label="Toggle navigation" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">
            <span class="material-symbols-outlined text-[24px]" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
        </button>
    </header>

    <!-- Mobile Navigation Drawer Overlay -->
    <div x-show="mobileOpen" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-2" x-transition:enter-end="opacity-100 translate-y-0" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 translate-y-0" x-transition:leave-end="opacity-0 -translate-y-2" class="md:hidden bg-surface-container-lowest border-b border-border-default shadow-lg fixed top-16 left-0 right-0 z-40 p-4 flex flex-col gap-2">
        @if($user && $user->hasRole('admin_tu'))
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">groups</span>
                <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">badge</span>
                <span>Data Guru & User</span>
            </a>
            <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">meeting_room</span>
                <span>Data Kelas</span>
            </a>
            <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">book</span>
                <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.import') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">upload_file</span>
                <span>Import Excel</span>
            </a>
        @elseif($user && $user->hasRole('waka_kurikulum'))
            <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard Waka</span>
            </a>
            <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                <span>Jadwal Pelajaran</span>
            </a>
            <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                <span>Rekap Absensi</span>
            </a>
            <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">assessment</span>
                <span>Laporan Nilai</span>
            </a>
        @elseif($user && $user->hasRole('guru'))
            <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Beranda Guru</span>
            </a>
            <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">fact_check</span>
                <span>Input Presensi</span>
            </a>
            <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                <span>Input Formatif</span>
            </a>
        @elseif($user && $user->hasRole('siswa'))
            <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md">
                <span class="material-symbols-outlined text-[20px]">person_pin</span>
                <span>Portal Siswa</span>
            </a>
        @endif

        <a href="{{ route('profile') }}" wire:navigate class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-on-surface-variant hover:bg-surface-container font-label-md border-t border-border-default/60 pt-3">
            <span class="material-symbols-outlined text-[20px]">account_circle</span>
            <span>Profil Pengguna</span>
        </a>

        <button wire:click="logout" class="w-full h-touch-target bg-error/10 hover:bg-error/20 text-error font-label-md rounded-lg transition-all flex items-center justify-center gap-2 mt-2">
            <span class="material-symbols-outlined text-[18px]">logout</span>
            <span>Keluar</span>
        </button>
    </div>
</div>
