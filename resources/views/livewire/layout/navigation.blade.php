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
        <!-- Brand Header -->
        <div class="mb-4 flex flex-col gap-1 px-3 pt-2">
            <a href="{{ url('/') }}" class="flex items-center gap-3 group">
                <div class="w-9 h-9 rounded-xl bg-primary flex items-center justify-center text-on-primary font-bold shadow-xs group-hover:scale-105 transition-transform">
                    <span class="material-symbols-outlined text-[20px]">school</span>
                </div>
                <div>
                    <h1 class="font-headline-md text-base leading-tight font-bold text-primary">MAN 4 Jombang</h1>
                    <p class="font-label-sm text-[10px] text-on-surface-variant uppercase tracking-wider">Academic Portal</p>
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
                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        <span>Beranda Admin</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.siswa*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">groups</span>
                        <span>Data Siswa</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.guru*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">badge</span>
                        <span>Data Guru &amp; User</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.kelas*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">meeting_room</span>
                        <span>Data Rombel Kelas</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.mapel*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">book</span>
                        <span>Mata Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.jadwal*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.event-ujian*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">assignment</span>
                        <span>Event &amp; Ujian</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.pengaturan*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">settings</span>
                        <span>Pengaturan Akademik</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('admin.import') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('admin.import*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">upload_file</span>
                        <span>Import Excel</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('waka_kurikulum'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Kurikulum</li>
                <li>
                    <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        <span>Dashboard Waka</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.jadwal*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">calendar_month</span>
                        <span>Jadwal Pelajaran</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.event-ujian*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">assignment</span>
                        <span>Event &amp; Asesmen</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.rekap-absensi*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">how_to_reg</span>
                        <span>Rekap Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('waka.rekap-nilai*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">assessment</span>
                        <span>Laporan Rapor Nilai</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('guru'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">KBM &amp; Nilai</li>
                <li>
                    <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">dashboard</span>
                        <span>Beranda Guru</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.absensi*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">fact_check</span>
                        <span>Input Presensi</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.nilai*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">edit_note</span>
                        <span>Input Formatif</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('guru.profil') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('guru.profil*') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">account_box</span>
                        <span>Profil Tenaga Pendidik</span>
                    </a>
                </li>

            @elseif($user && $user->hasRole('siswa'))
                <li class="px-3 pt-2 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Portal Siswa</li>
                <li>
                    <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-semibold transition-all {{ request()->routeIs('siswa.dashboard') ? 'bg-primary text-on-primary font-bold shadow-xs' : 'text-on-surface-variant hover:bg-surface hover:text-text-main' }}">
                        <span class="material-symbols-outlined text-[18px]">person_pin</span>
                        <span>Portal &amp; Profil Siswa</span>
                    </a>
                </li>
            @endif

            <li class="px-3 pt-3 pb-1 text-[10px] font-bold text-outline uppercase tracking-wider">Publik &amp; Info</li>
            <li>
                <a href="{{ url('/kalender') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <span class="material-symbols-outlined text-[18px]">event_note</span>
                    <span>Kalender Madrasah</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/bantuan') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <span class="material-symbols-outlined text-[18px]">help_outline</span>
                    <span>Pusat Bantuan</span>
                </a>
            </li>
            <li>
                <a href="{{ url('/kontak') }}" class="flex items-center gap-3 px-3 py-2 rounded-lg text-xs font-medium text-on-surface-variant hover:bg-surface transition-all">
                    <span class="material-symbols-outlined text-[18px]">support_agent</span>
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
                    <span class="material-symbols-outlined text-[18px]">logout</span>
                </button>
            </div>
        </div>
    </nav>

    <!-- Mobile Header Navigation Topbar -->
    <header class="md:hidden bg-surface-container-lowest border-b border-border-default px-4 h-16 sticky top-0 flex justify-between items-center z-40 shadow-xs">
        <div class="flex items-center gap-3">
            <div class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center text-on-primary font-bold">
                <span class="material-symbols-outlined text-[18px]">school</span>
            </div>
            <span class="font-headline-md text-base text-primary font-extrabold">MAN 4 Jombang</span>
        </div>

        <button @click="mobileOpen = !mobileOpen" aria-label="Toggle navigation" class="p-2 text-on-surface-variant hover:bg-surface-container rounded-lg transition-colors">
            <span class="material-symbols-outlined text-[24px]" x-text="mobileOpen ? 'close' : 'menu'">menu</span>
        </button>
    </header>

    <!-- Mobile Navigation Drawer Overlay -->
    <div x-show="mobileOpen" x-transition class="md:hidden bg-surface-container-lowest border-b border-border-default shadow-xl fixed top-16 left-0 right-0 z-40 p-4 flex flex-col gap-2 max-h-[85vh] overflow-y-auto">
        @if($user && $user->hasRole('admin_tu'))
            <a href="{{ route('admin.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard Admin</span>
            </a>
            <a href="{{ route('admin.siswa') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">groups</span>
                <span>Data Siswa</span>
            </a>
            <a href="{{ route('admin.guru') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">badge</span>
                <span>Data Guru &amp; User</span>
            </a>
            <a href="{{ route('admin.kelas') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">meeting_room</span>
                <span>Data Kelas</span>
            </a>
            <a href="{{ route('admin.mapel') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">book</span>
                <span>Mata Pelajaran</span>
            </a>
            <a href="{{ route('admin.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                <span>Jadwal Pelajaran</span>
            </a>
            <a href="{{ route('admin.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">assignment</span>
                <span>Event &amp; Ujian</span>
            </a>
            <a href="{{ route('admin.pengaturan') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">settings</span>
                <span>Pengaturan Akademik</span>
            </a>
        @elseif($user && $user->hasRole('waka_kurikulum'))
            <a href="{{ route('waka.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Dashboard Waka</span>
            </a>
            <a href="{{ route('waka.jadwal') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">calendar_month</span>
                <span>Jadwal Pelajaran</span>
            </a>
            <a href="{{ route('waka.event-ujian') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">assignment</span>
                <span>Event &amp; Asesmen</span>
            </a>
            <a href="{{ route('waka.rekap-absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">how_to_reg</span>
                <span>Rekap Absensi</span>
            </a>
            <a href="{{ route('waka.rekap-nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">assessment</span>
                <span>Laporan Nilai</span>
            </a>
        @elseif($user && $user->hasRole('guru'))
            <a href="{{ route('guru.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <span class="material-symbols-outlined text-[20px]">dashboard</span>
                <span>Beranda Guru</span>
            </a>
            <a href="{{ route('guru.absensi') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">fact_check</span>
                <span>Input Presensi</span>
            </a>
            <a href="{{ route('guru.nilai') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">edit_note</span>
                <span>Input Formatif</span>
            </a>
            <a href="{{ route('guru.profil') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main">
                <span class="material-symbols-outlined text-[20px]">account_box</span>
                <span>Profil Guru</span>
            </a>
        @elseif($user && $user->hasRole('siswa'))
            <a href="{{ route('siswa.dashboard') }}" wire:navigate class="flex items-center gap-3 px-3 py-2 rounded-lg text-sm text-text-main font-semibold">
                <span class="material-symbols-outlined text-[20px]">person_pin</span>
                <span>Portal Siswa</span>
            </a>
        @endif

        <div class="pt-3 border-t border-border-default/60 flex items-center justify-between">
            <button wire:click="logout" class="w-full h-touch-target bg-error/10 hover:bg-error/20 text-error font-semibold text-sm rounded-lg transition-all flex items-center justify-center gap-2">
                <span class="material-symbols-outlined text-[18px]">logout</span>
                <span>Keluar dari Portal</span>
            </button>
        </div>
    </div>
</div>
