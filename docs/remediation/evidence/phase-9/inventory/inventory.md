# Mutating Method Authorization Inventory

| Component | Mutating Method | Route & Role Middleware | Method-Level Guard | Invariant / Scoping | Flag |
|---|---|---|---|---|---|
| `App\Livewire\Guru\AbsensiGuru` | `markAllHadir()` | `guru.absensi` (`role:guru`) | `jadwalOrFail()` (`authorize('create', [Absensi::class, $jadwal])`) | Today-only date check (`abort_unless($tanggal === today())`, 422) | Guarded |
| `App\Livewire\Guru\AbsensiGuru` | `resetAll()` | `guru.absensi` (`role:guru`) | `jadwalOrFail()` (`authorize('create', [Absensi::class, $jadwal])`) | Today-only date check (`abort_unless($tanggal === today())`, 422) | Guarded |
| `App\Livewire\Guru\AbsensiGuru` | `setPresence($siswaId, $status)` | `guru.absensi` (`role:guru`) | `jadwalOrFail()` (`authorize('create', [Absensi::class, $jadwal])`) | Today-only date check, status whitelist, class membership | Guarded |
| `App\Livewire\Guru\AbsensiGuru` | `saveNote()` | `guru.absensi` (`role:guru`) | `jadwalOrFail()` (`authorize('create', [Absensi::class, $jadwal])`) | Today-only date check, string max:255 | Guarded |
| `App\Livewire\Guru\AbsensiGuru` | `save()` | `guru.absensi` (`role:guru`) | `jadwalOrFail()` (`authorize('create', [Absensi::class, $jadwal])`) | Today-only date check, status whitelist, string max:255 | Guarded |
| `App\Livewire\Guru\NilaiGuru` | `save()` | `guru.nilai` (`role:guru`) | `$this->authorize('create', [NilaiFormatif::class, $jadwal])` | Ownership of schedule verified by Policy | Guarded |
| `App\Livewire\Guru\ProfilGuru` | `updateProfile()` | `guru.profil` (`role:guru`) | None (mutates `auth()->user()`) | Restricts mutation to own user session | G6 |
| `App\Livewire\Waka\JadwalManager` | `create()` | `admin.jadwal`, `waka.jadwal`, `guru.jadwal` | `ensureCanManage()` (`abort_unless(hasRole('admin_tu'\|'waka_kurikulum'), 403)`) | Read view scoped by `isOwnScheduleOnly()` for guru role | Guarded |
| `App\Livewire\Waka\JadwalManager` | `edit($id)` | `admin.jadwal`, `waka.jadwal`, `guru.jadwal` | `ensureCanManage()` (`abort_unless(hasRole('admin_tu'\|'waka_kurikulum'), 403)`) | Read view scoped by `isOwnScheduleOnly()` for guru role | Guarded |
| `App\Livewire\Waka\JadwalManager` | `store()` | `admin.jadwal`, `waka.jadwal`, `guru.jadwal` | `ensureCanManage()` (`abort_unless(hasRole('admin_tu'\|'waka_kurikulum'), 403)`) | Conflict checks for guru and class | Guarded |
| `App\Livewire\Waka\JadwalManager` | `delete($id)` | `admin.jadwal`, `waka.jadwal`, `guru.jadwal` | `ensureCanManage()` (`abort_unless(hasRole('admin_tu'\|'waka_kurikulum'), 403)`) | Deletion restricted to admin/waka | Guarded |
| `App\Livewire\Admin\EventUjianManager` | `saveEvent()`, `deleteEvent($id)` | `admin.event-ujian`, `waka.event-ujian` | None | Relies on route middleware `role:admin_tu\|waka_kurikulum` | G6 |
| `App\Livewire\Admin\GuruManager` | `store()`, `delete($id)` | `admin.guru` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\ImportExcel` | `import()` | `admin.import` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\KelasManager` | `store()`, `delete($id)` | `admin.kelas` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\MapelManager` | `store()`, `delete($id)` | `admin.mapel` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\PengaturanManager` | `saveSettings()` | `admin.pengaturan` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\SiswaManager` | `store()`, `createUserAccount($id)`, `generateMissingAccounts()`, `delete($id)` | `admin.siswa` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |
| `App\Livewire\Admin\UserRoleManager` | `save()`, `deleteUser($id)` | `admin.users` (`role:admin_tu`) | None | Relies on route middleware `role:admin_tu` | G6 |

### Component Notes:
- `App\Livewire\Admin\JadwalManager`: Fully deleted (orphan removed in Phase 8.4 commit `8aa28a2`).
- `App\Livewire\Waka\JadwalManager`: Guarded at method-level against unauthorized mutations by `ensureCanManage()` and scoped at query-level via `isOwnScheduleOnly()` for teachers.
- `App\Livewire\Guru\AbsensiGuru`: Protected by Livewire `#[Locked]` attribute, `today()` constraint on `mount()`, method-level `authorize()`, and today-only rollover checks on all five write operations (`markAllHadir`, `resetAll`, `setPresence`, `saveNote`, `save`).
