<?php

use Illuminate\Support\Facades\Route;

// Public Routes
Route::view('/', 'welcome')->name('home');
Route::view('/portal', 'portal')->name('portal');

// Non-MVP pages — deferred per design spec §1.5
// Route::view('/tentang', 'tentang')->name('tentang');
// Route::view('/fitur', 'fitur')->name('fitur');
// Route::view('/prestasi', 'prestasi')->name('prestasi');
// Route::view('/kalender', 'kalender')->name('kalender');
// Route::view('/bantuan', 'bantuan')->name('bantuan');
// Route::view('/kontak', 'kontak')->name('kontak');

// Authenticated Routes
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard — redirects based on role
    Route::get('dashboard', function () {
        $user = auth()->user();

        if ($user->hasRole('admin_tu')) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->hasRole('waka_kurikulum')) {
            return redirect()->route('waka.dashboard');
        } elseif ($user->hasRole('guru')) {
            return redirect()->route('guru.dashboard');
        } elseif ($user->hasRole('siswa')) {
            return redirect()->route('siswa.dashboard');
        }

        return view('dashboard');
    })->name('dashboard');

    Route::view('profile', 'profile')->name('profile');

    // ===== ADMIN/TU ROUTES =====
    Route::middleware('role:admin_tu')->prefix('admin')->name('admin.')->group(function () {
        Route::view('dashboard', 'admin.dashboard')->name('dashboard');
        Route::get('siswa', \App\Livewire\Admin\SiswaManager::class)->name('siswa');
        Route::get('guru', \App\Livewire\Admin\GuruManager::class)->name('guru');
        Route::get('kelas', \App\Livewire\Admin\KelasManager::class)->name('kelas');
        Route::get('mapel', \App\Livewire\Admin\MapelManager::class)->name('mapel');
        Route::get('jadwal', \App\Livewire\Waka\JadwalManager::class)->name('jadwal');
        Route::get('event-ujian', \App\Livewire\Admin\EventUjianManager::class)->name('event-ujian');
        Route::get('pengaturan', \App\Livewire\Admin\PengaturanManager::class)->name('pengaturan');
        Route::get('import', \App\Livewire\Admin\ImportExcel::class)->name('import');
    });

    // ===== WAKA KURIKULUM ROUTES =====
    Route::middleware('role:waka_kurikulum')->prefix('waka')->name('waka.')->group(function () {
        Route::view('dashboard', 'waka.dashboard')->name('dashboard');
        Route::get('jadwal', \App\Livewire\Waka\JadwalManager::class)->name('jadwal');
        Route::get('event-ujian', \App\Livewire\Admin\EventUjianManager::class)->name('event-ujian');
        Route::get('rekap-absensi', \App\Livewire\Waka\RekapAbsensi::class)->name('rekap-absensi');
        Route::get('rekap-nilai', \App\Livewire\Waka\RekapNilai::class)->name('rekap-nilai');
    });

    // ===== GURU ROUTES =====
    Route::middleware('role:guru')->prefix('guru')->name('guru.')->group(function () {
        Route::view('dashboard', 'guru.dashboard')->name('dashboard');
        Route::get('absensi', \App\Livewire\Guru\AbsensiGuru::class)->name('absensi');
        Route::get('nilai', \App\Livewire\Guru\NilaiGuru::class)->name('nilai');
        Route::get('profil', \App\Livewire\Guru\ProfilGuru::class)->name('profil');
        Route::get('jadwal', \App\Livewire\Waka\JadwalManager::class)->name('jadwal');
    });

    // ===== SISWA ROUTES =====
    Route::middleware('role:siswa')->prefix('siswa')->name('siswa.')->group(function () {
        Route::get('dashboard', \App\Livewire\Siswa\SiswaDashboard::class)->name('dashboard');
    });
});

require __DIR__.'/auth.php';
