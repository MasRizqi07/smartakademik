# Remediation Deviations Log

This document records all deviations, test refactorings, and corrections across Phases 7, 8, and 9.

## 1. Phase 7.4 Scope Expansion and Fallback String Correction (Findings C2 & F6)
- **Files Affected:**
  - `resources/views/admin/dashboard.blade.php` (38 lines changed)
  - `resources/views/guru/dashboard.blade.php` (34 lines changed)
  - `tests/Feature/DashboardMetricsTest.php` (32 lines added)
- **Details:**
  - The fallback literals replaced by dashes (`-`) were specifically: `Budi Santoso`, `Matematika Wajib`, `X-A`, `07:00`, and `08:30` (not the placeholder strings previously mislabelled).
  - In addition to replacing these five fallback literals, Phase 7.4 removed hardcoded static activity feed items and empty placeholder rows (`@empty` mockup rows) to eliminate all fabricated UI data.

## 2. Phase 8.0 Baseline Correction (Finding F3)
- **Details:**
  - The baseline output originally captured in the Phase 8.0 section was run after commits `571c9f7` through `8aa28a2` had already been drafted locally.
  - The true pre-Phase-8 baseline state is commit `4d4dd5a` (88 tests passing with 340 assertions, as verified in the Phase 7 report).
  - Phase 9.0 establishes the true, verified baseline for Phase 9 at commit `720ada1` (95 tests passing with 376 assertions).

## 3. Phase 8.2 Test Refactoring (Rule R15)
- **File Affected:** `tests/Feature/AbsensiGuruTest.php`
- **Details:**
  - `setUp()` was updated to call `Carbon::setTestNow('2023-10-09 08:00:00')` and `tearDown()` to call `Carbon::setTestNow()`.
  - The following existing tests were minimally edited to remove client-side `->set('tanggal', ...)` and mount parameter `'tanggal' => ...` (which are prohibited under Livewire `#[Locked]` and the today-only invariant):
    - `test_guru_can_see_their_own_jadwal_and_siswa`
    - `test_guru_can_save_absensi`
    - `test_method_level_guard_denies_non_owner_direct_mutation`
    - `test_set_presence_rejects_invalid_status`
    - `test_set_presence_rejects_student_from_different_class`
    - `test_mark_all_hadir_is_local_state_only_and_preserves_existing_status`
    - `test_reset_all_and_save_note_by_non_owner_forbidden`
    - `test_save_aborts_with_422_when_status_is_not_whitelisted`
  - **Integrity Verification:** No assertion was changed, weakened, skipped, or deleted.

## 4. Phase 8.4 Test Retargeting (Rule R15)
- **File Affected:** `tests/Feature/JadwalCRUDTest.php`
- **Details:**
  - Removed unused import `use App\Livewire\Admin\JadwalManager;`.
  - `test_can_create_jadwal`: Retargeted from deleted `Admin\JadwalManager` to `Waka\JadwalManager as WakaJadwalManager`.
  - `test_cannot_create_jadwal_with_guru_clash`: Retargeted to `WakaJadwalManager`. Assertion adjusted from `assertHasErrors(['jam_ke'])` to `assertHasErrors(['guru_id'])` because `Waka\JadwalManager` binds schedule clash errors to the `guru_id` field. No business logic or clash assertions were weakened or removed.

## 5. Phase 9.1 Guru Dashboard Fallback Correction (Finding F1)
- **File Affected:** `resources/views/guru/dashboard.blade.php`
- **Details:**
  - Line 113 previously fell back to `JadwalPelajaran::with(['kelas', 'mapel'])->take(3)->get()` when a user with role `guru` had no associated `Guru` record, exposing foreign teachers' schedules.
  - Replaced with `collect()`, allowing the existing empty state to render properly.
  - Added non-vacuous feature test `test_guru_without_guru_record_sees_no_jadwal_on_dashboard` to `tests/Feature/DashboardMetricsTest.php`.
