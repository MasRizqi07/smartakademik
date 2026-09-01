<?php

use App\Livewire\Actions\Logout;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
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

    /**
     * Switch user role for instant demonstration & testing
     */
    public function switchRole(string $targetRole): void
    {
        $email = match($targetRole) {
            'admin' => 'admin@smartakademik.test',
            'waka' => 'waka@smartakademik.test',
            'guru' => 'guru@smartakademik.test',
            'siswa' => 'siswa@smartakademik.test',
            default => 'admin@smartakademik.test',
        };

        $targetUser = User::where('email', $email)->first();
        if ($targetUser) {
            Auth::login($targetUser);
            $this->redirect(route('dashboard'), navigate: true);
        }
    }
}; ?>

<div x-data="{ mobileOpen: false, roleMenuOpen: false }">
    <!-- Desktop Sidebar Navbar -->
    <nav class="hidden md:flex bg-surface-container-lowest shadow-sm h-screen w-64 fixed left-0 top-0 flex-col p-4 border-r border-border-default z-40">
        <!-- Brand Header & Theme Toggle -->
        <div class="mb-4 flex items-center justify-between px-2 pt-2">
            <a href="{{ url('/') }}" class="flex items-center gap-2.5 group">
                <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold shadow-xs group-hover:scale-105 transition-transform">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
                </div>
                <div>
                    <h1 class="font-headline-md text-sm leading-tight font-bold text-primary">MAN 4 Jombang</h1>
                    <p class="font-label-sm text-[9px] text-on-surface-variant uppercase tracking-wider">Academic Portal</p>
                </div>
            </a>

        </div>

        <!-- Navigation Links -->
        <ul class="flex flex-col gap-1 flex-1 overflow-y-auto py-2 pr-1 space-y-0.5">
            @php
                $user = auth()->user();
            @endphp

            @if($user && $user->hasRole('admin_tu'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Navigasi Admin</li>
                <li>
                    <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Beranda Admin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.siswa*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.guru*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                        <span>Data Guru &amp; User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.kelas*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Data Rombel Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.mapel*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.jadwal*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.event-ujian*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Event &amp; Ujian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.users') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.users*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 19.128a9.38 9.38 0 0 0 2.625.372 9.337 9.337 0 0 0 4.121-.952 4.125 4.125 0 0 0-7.533-2.493M15 19.128v-.003c0-1.113-.285-2.16-.786-3.07M15 19.128v.106A12.318 12.318 0 0 1 8.624 21c-2.331 0-4.512-.645-6.374-1.766l-.001-.109a6.375 6.375 0 0 1 11.964-3.07M12 6.375a3.375 3.375 0 1 1-6.75 0 3.375 3.375 0 0 1 6.75 0Zm8.25 2.25a2.625 2.625 0 1 1-5.25 0 2.625 2.625 0 0 1 5.25 0Z" /></svg>
                        <span>Manajemen User (RBAC)</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.pengaturan*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                        <span>Pengaturan Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.import') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.import*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 16.5v2.25A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75V16.5m-13.5-9L12 3m0 0 4.5 4.5M12 3v13.5" /></svg>
                        <span>Import Excel</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('waka_kurikulum'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Kurikulum</li>
                <li>
                    <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Dashboard Waka</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.jadwal*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.event-ujian*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Event &amp; Asesmen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.rekap-absensi*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Rekap Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.rekap-nilai*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Laporan Rapor Nilai</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.laporan') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.laporan*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 0 1 3 19.875v-6.75ZM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V8.625ZM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 0 1-1.125-1.125V4.125Z" /></svg>
                        <span>Laporan Analitik Sekolah</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('guru'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">KBM &amp; Nilai</li>
                <li>
                    <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Beranda Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.absensi*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Input Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.nilai*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Input Formatif</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.profil') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.profil*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Profil Tenaga Pendidik</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('siswa'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Portal Siswa</li>
                <li>
                    <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('siswa.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                        <span>Portal &amp; Profil Siswa</span>
                    </a>
                </li>
            @endif

            <li class="px-3 pt-3 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Publik &amp; Info</li>
            <li>
                <a href="{{ url('/kalender') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <span>Kalender Madrasah</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/bantuan') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <span>Pusat Bantuan</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/kontak') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                    <span>Hubungi IT Support</span>
                </a>
            </li>
        </ul>

        <!-- Demo Role Switcher Dropdown (Frictionless Paired Evaluation) -->
        <div class="pt-2 border-t border-border-default/60 relative">
            <div class="p-2 bg-surface rounded-xl border border-border-default mb-2">
                <div class="flex items-center justify-between mb-1.5">
                    <span class="text-[10px] font-bold text-primary uppercase tracking-wider">Uji Coba Peran:</span>
                </div>
                <div class="grid grid-cols-4 gap-1">
                    <button wire:click="switchRole('admin')" class="py-1 px-1 rounded text-[10px] font-bold text-center {{ $user && $user->hasRole('admin_tu') ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-primary/20' }}">
                        Admin
                    </button>
                    <button wire:click="switchRole('waka')" class="py-1 px-1 rounded text-[10px] font-bold text-center {{ $user && $user->hasRole('waka_kurikulum') ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-primary/20' }}">
                        Waka
                    </button>
                    <button wire:click="switchRole('guru')" class="py-1 px-1 rounded text-[10px] font-bold text-center {{ $user && $user->hasRole('guru') ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-primary/20' }}">
                        Guru
                    </button>
                    <button wire:click="switchRole('siswa')" class="py-1 px-1 rounded text-[10px] font-bold text-center {{ $user && $user->hasRole('siswa') ? 'bg-primary text-on-primary' : 'bg-surface-container text-on-surface-variant hover:bg-primary/20' }}">
                        Siswa
                    </button>
                </div>
            </div>

            <!-- User Info & Logout Button -->
            <div class="flex items-center justify-between pt-1">
                <div class="flex items-center gap-2.5 min-w-0">
                    <div class="w-8 h-8 rounded-full bg-primary-container text-on-primary-container flex items-center justify-center font-bold text-xs shadow-xs shrink-0">
                        {{ substr(auth()->user()->name ?? 'U', 0, 1) }}
                    </div>
                    <div class="flex flex-col min-w-0 overflow-hidden">
                        <span class="text-xs text-text-main truncate font-bold">{{ auth()->user()->name ?? 'Pengguna' }}</span>
                        <span class="text-[10px] text-on-surface-variant truncate font-semibold uppercase">{{ auth()->user()->roles->pluck('name')->first() ?? 'User' }}</span>
                    </div>
                </div>

                <button wire:click="logout" class="p-2 text-error hover:bg-error/10 rounded-lg transition-colors" title="Keluar">
                    <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Header Navigation Topbar -->
    <header class="md:hidden bg-surface-container-lowest border-b border-border-default px-4 h-16 sticky top-0 flex justify-between items-center z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.438 60.438 0 0 0-.491 6.347A48.62 48.62 0 0 1 12 20.904a48.62 48.62 0 0 1 8.232-4.41 60.46 60.46 0 0 0-.491-6.347m-15.482 0a50.636 50.636 0 0 0-2.658-.813A59.906 59.906 0 0 1 12 3.493a59.903 59.903 0 0 1 10.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.717 50.717 0 0 1 12 13.489a50.702 50.702 0 0 1 7.74-3.342M6.75 15a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Zm0 0v-3.675A55.378 55.378 0 0 1 12 8.443m-7.007 11.55A5.981 5.981 0 0 0 6.75 15.75v-1.5" /></svg>
            </div>
            <span class="font-headline-md text-base text-primary font-extrabold">MAN 4 Jombang</span>
        </div>

        <div class="flex items-center gap-2">

            <button @click="mobileOpen = !mobileOpen" aria-label="Toggle navigation" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
            </button>
        </div>
    </header>

    <!-- Mobile Navigation Drawer Overlay -->
    <div x-show="mobileOpen" x-transition class="md:hidden bg-surface-container-lowest border-b border-border-default shadow-xl fixed top-16 left-0 right-0 z-40 p-4 flex flex-col gap-2 max-h-[85vh] overflow-y-auto">
        @if($user && $user->hasRole('admin_tu'))
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Dashboard Admin</span>
            </a>
            <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" /></svg>
                <span>Data Guru &amp; User</span>
            </a>
            <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Data Kelas</span>
            </a>
            <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                <span>Jadwal Pelajaran</span>
            </a>
            <a href="{{ route('admin.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Event &amp; Ujian</span>
            </a>
            <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.325.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 0 1 1.37.49l1.296 2.247a1.125 1.125 0 0 1-.26 1.431l-1.003.827c-.293.241-.438.613-.43.992a7.723 7.723 0 0 1 0 .255c-.008.378.137.75.43.991l1.004.827c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 0 1-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.47 6.47 0 0 1-.22.128c-.331.183-.581.495-.644.869l-.213 1.281c-.09.543-.56.94-1.11.94h-2.594c-.55 0-1.019-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 0 1-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 0 1-1.369-.49l-1.297-2.247a1.125 1.125 0 0 1 .26-1.431l1.004-.827c.292-.24.437-.613.43-.991a6.932 6.932 0 0 1 0-.255c.007-.38-.138-.751-.43-.992l-1.004-.827a1.125 1.125 0 0 1-.26-1.43l1.297-2.247a1.125 1.125 0 0 1 1.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.086.22-.128.332-.183.582-.495.644-.869l.214-1.28Z" /><path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" /></svg>
                <span>Pengaturan Akademik</span>
            </a>
        @elseif($user && $user->hasRole('waka_kurikulum'))
            <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Dashboard Waka</span>
            </a>
            <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5" /></svg>
                <span>Jadwal Pelajaran</span>
            </a>
            <a href="{{ route('waka.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Event &amp; Asesmen</span>
            </a>
            <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Rekap Absensi</span>
            </a>
            <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Laporan Nilai</span>
            </a>
        @elseif($user && $user->hasRole('guru'))
            <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Beranda Guru</span>
            </a>
            <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Input Presensi</span>
            </a>
            <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Input Formatif</span>
            </a>
            <a href="{{ route('guru.profil') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Profil Guru</span>
            </a>
        @elseif($user && $user->hasRole('siswa'))
            <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Portal Siswa</span>
            </a>
        @endif

        <div class="pt-3 border-t border-border-default/60 flex items-center justify-between gap-3">
            <div class="flex items-center gap-2 text-xs font-semibold text-on-surface-variant">
                <span>Mode Tema:</span>

            </div>
            <button wire:click="logout" class="px-4 py-2 bg-error/10 hover:bg-error/20 text-error font-semibold text-xs rounded-lg transition-all flex items-center justify-center gap-1.5">
                <svg class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" /></svg>
                <span>Keluar</span>
            </button>
        </div>
    </div>
</div>
