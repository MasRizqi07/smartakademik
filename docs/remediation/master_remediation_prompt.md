# MASTER REMEDIATION PROMPT - SmartAkademik (MAN 4 Jombang)

**Agent:** Antigravity
**Repo:** `MasRizqi07/smartakademik` (Laravel + Blade + Livewire 3 + Tailwind 3 + Spatie Permission)
**Authority order:** `docs/PRD.md` (locked MVP scope) > `docs/design-system.md` > `design_prompt.md` > Stitch output in `docs/Design/` (suggestions only, never scope).
**Supersedes:** the build phases of `design_prompt.md`. Its Canonical Decisions (§1) and "What NOT to build" (§6) still stand and were violated; this document enforces them.
**Audited commit:** `0ac189f` ("Update dan Upgrade Penambahan Front End Halaman Ui/UX Design Website"), one squashed commit.

You are fixing, not redesigning. Working code stays. Read §0 and §6 completely before touching any file.

---

## 0. Reality check (verified by direct inspection of the repo, not from your report)

Your last completion report claimed 27 modules, 61/61 tests, "100% sempurna". The report is a self-written narrative with no raw output. Treat everything below as the baseline. Re-measure each item in Phase 0 and paste raw output.

**S1 - Safety / data integrity (`app/Livewire/Guru/AbsensiGuru.php`)**
- `markAllHadir()` loops over every student and calls `Absensi::updateOrCreate(... 'status' => 'hadir')` immediately. It overwrites existing `izin` / `sakit` / `alfa` rows with `hadir` and persists with no review step. This is the exact failure `design_prompt.md` §4.1 forbids, now behind a one-tap button.
- `setPresence($siswaId, $status)` accepts any `$siswaId` and any `$status` string from the client. No whitelist, no check that the student belongs to the jadwal's class. The DB enum (`hadir, izin, sakit, alfa`) is the only backstop.
- `setPresence`, `markAllHadir`, `resetAll`, `saveNote` contain no authorization call of their own. `save()` and `loadSiswas()` call `authorize('create', ...)`, and only inside `if (auth()->user()->hasRole('guru'))`. Selection tampering **is** covered: `tests/Feature/RBACTest.php::test_guru_cannot_access_absensi_for_other_gurus_class` sets `selectedJadwalId` to another guru's jadwal and expects 403 (it works through `updatedSelectedJadwalId` -> `loadSiswas()`). **Not covered:** direct calls to `setPresence` with a foreign `$siswaId` or an arbitrary `$status`, and direct calls to `markAllHadir`, `resetAll`, `saveNote`. `AbsensiGuruTest.php` itself has only two tests (`test_guru_can_see_their_own_jadwal_and_siswa`, `test_guru_can_save_absensi`).
- `loadJadwals()`: a user with no linked `guru` record gets every `JadwalPelajaran` in the school.
- `resetAll()` deletes all attendance rows for a jadwal+date with only a client-side `wire:confirm`.
- Zero tests reference `markAllHadir`.
- **Added after Phase 0 review:** `app/Livewire/Waka/JadwalManager.php` is routed under `admin_tu`, `waka_kurikulum` **and `guru`** (`routes/web.php` lines 43, 54, 67; your own Phase 0 `route:list --path=guru` shows `guru/jadwal -> App\Livewire\Waka\JadwalManager`). Its `create`, `edit`, `store`, `delete` methods have no `authorize`, no role check, and `resources/views/livewire/waka/jadwal-manager.blade.php` has no `@role`/`@can` gating. By code reading, any guru can delete any schedule or change `guru_id` on any jadwal to themselves. `AbsensiPolicy::create` decides ownership through `jadwal->guru->user_id`, so reassigning a jadwal defeats the attendance ownership check in §2. `tests/Feature/JadwalCRUDTest.php` has no denial test. Code-read only, not run-verified.

**S2 - Scope violation (deferred items were built)**
- `routes/web.php` lines 8-13 register `/tentang /fitur /prestasi /kalender /bantuan /kontak`. All six were marked Defer/Cut in `design_prompt.md` §1.5 and §6.
- Three new Livewire components back them: `app/Livewire/PrestasiGaleri.php`, `KalenderAkademik.php`, `KontakSupport.php`. No test references any of the six pages or three components.
- 22 `route('tentang'|'fitur'|'prestasi'|'kalender'|'bantuan'|'kontak')` calls exist in `layouts/app.blade.php`, `layouts/public.blade.php`, `welcome.blade.php`. Removing the routes without guarding these will throw `RouteNotDefinedException` on every page that renders those layouts.

**S3 - Discipline leaks**
- Dead utility classes: `bg-brand/10`, `bg-status-hadir/15`, `bg-status-alfa/15`, `bg-status-izin/15`, `ring-brand/20`, `border-brand/40` appear in views (e.g. `livewire/waka/rekap-absensi`, `livewire/waka/rekap-nilai`, `livewire/siswa/siswa-dashboard`, `livewire/guru/absensi-guru`). The tokens in `tailwind.config.js` are plain `var(--color-x)` hex values, so Tailwind 3.4 cannot apply an alpha channel. Verified by building the repo's own config and CSS in isolation: `.bg-status-hadir\/15`, `.bg-brand\/10`, `.ring-brand\/20`, `.bg-status-alfa\/15` all produced 0 rules. Result: tinted status badges render with no background.
- Raw Tailwind hues bypass the token layer: 180 occurrences of `(bg|text|border|ring|from|to|via|fill|stroke|shadow)-(emerald|green|amber|sky|rose|red|yellow|orange|teal)-N` across all views. **Baseline for the §4 live-file check at `0ac189f`: 118** (live = everything except the deferred files, so it includes `layouts/public` and `portal`); 57 of those are in strictly operational files. Highest operational offenders: `livewire/admin/jadwal-manager`, `waka/dashboard`.
- Decoration baseline for the §4 live-file check at `0ac189f`: **62 hits**. By file, operational screens (`backdrop-blur`, `animate-float/pulse-subtle/ping`, `hover-lift`, `glass-*`, `mesh-gradient*`, `text-gradient-*`, `shadow-glow*`): dashboards `waka` (10), `admin` (8), `guru` (7), plus `livewire/waka/rekap-nilai` (4), `livewire/admin/event-ujian-manager` (4), `livewire/siswa/siswa-dashboard` (3), `profil-guru` (2), `nilai-guru` (2), `layouts/app.blade.php` (1), `components/data-table` (1), and one hit in each manager. Principle violated: "Efficiency First".

**What was done right (do not redo):** 3-tier token layer in `app.css` / `tailwind.config.js`; Inter + Outfit loaded once; inline SVG icons (no Material Symbols); attendance rows default to `null`, and `save()` refuses to persist until every student is marked; `rekap-absensi` is a real screen now; touch targets present. Backward-compat M3 alias tokens exist and stay.

**Correction to earlier audit:** the phrase "Islamic Emerald" exists only in your report text. `grep -rniE islamic resources app config tailwind.config.js` finds nothing in code. No code action needed; see rule R5.

**Verification limit:** the reviewer's sandbox cannot run `composer install`, so `php artisan test` results are unverified until you paste raw output.

---

## 1. Canonical decisions

| # | Decision | Reason |
|---|---|---|
| D1 | Attendance bulk action becomes **local-state only**: fills only students with no status yet, never overwrites an existing status, writes nothing to the DB, requires `wire:confirm`, and persists only through the existing `save()`. Button label: "Isi Sisa sebagai Hadir". | Keeps the speed benefit, preserves the review step the feature exists to enforce. |
| D2 | Every mutating method in `AbsensiGuru` authorizes through the existing `AbsensiPolicy::create(User, JadwalPelajaran)` **unconditionally**, validates status against a whitelist, and checks the student belongs to the jadwal's `kelas_id`. | `routes/web.php` already restricts the component to `role:guru`; the `hasRole('guru')` conditionals are redundant and weaken the check. |
| D3 | The six deferred pages are **gated, not deleted**, behind `config('features.public_marketing')`, default `false`. `/` redirects to `/portal` when the flag is off. `/portal` and `/login` stay. | Preserves the work, stops un-vetted, untested scope from shipping. Reversible with one env value. |
| D4 | Brand and status tokens get an RGB-channel form so alpha modifiers work, using the same `rgb(var(--x) / <alpha-value>)` pattern already used by the alias tokens. | Fixes the dead `/10 /15 /20` classes without touching call sites. |
| D5 | Semantic raw hues in live files are replaced by tokens. Neutral `slate`/`gray` utilities are tolerated this pass. | Bounded scope; semantic colors carry meaning, neutrals don't. |
| D6 | Decoration is removed from every live file (operational screens, `layouts/app`, `layouts/public`, `portal`). The CSS definitions stay in `app.css` with a `DEFERRED` comment because gated pages still use them. | Avoids breaking gated pages if the flag is ever enabled. |
| D8 | `JadwalManager` mutations (`create`, `edit`, `store`, `delete`) are allowed only for `admin_tu` and `waka_kurikulum`, enforced server-side in the component. The `guru/jadwal` route stays but is read-only for guru: mutation buttons hidden with `@hasanyrole('admin_tu|waka_kurikulum')` AND denied server-side with 403. | A hidden button is not access control; the Livewire methods are callable directly. |
| D7 | One commit per phase, message `phase-N: <summary>`. No squashing, no force-push. | The previous single squashed commit could not be reviewed incrementally. |

Assumption stated: D1 and D3 follow the reviewer's recommendation, which the owner approved in principle. If the owner decides otherwise, they will say so; do not ask, implement as written.

---

## 2. Safety-critical requirements (never lazy)

For `AbsensiGuru` (and any other Livewire component you touch):

1. A private guard used by every mutating method:
```php
private const STATUSES = ['hadir', 'izin', 'sakit', 'alfa'];

private function jadwalOrFail(): JadwalPelajaran
{
    abort_unless($this->selectedJadwalId && $this->tanggal, 422);
    $jadwal = JadwalPelajaran::findOrFail($this->selectedJadwalId);
    $this->authorize('create', [Absensi::class, $jadwal]);   // unconditional
    return $jadwal;
}

private function siswaInKelasOrFail(JadwalPelajaran $jadwal, $siswaId): Siswa
{
    return Siswa::where('id', $siswaId)->where('kelas_id', $jadwal->kelas_id)->firstOrFail();
}
```
2. `setPresence`: `abort_unless(in_array($status, self::STATUSES, true), 422)`, then `jadwalOrFail()`, then `siswaInKelasOrFail()`, then the existing `updateOrCreate`.
3. `saveNote`: `jadwalOrFail()` + `siswaInKelasOrFail()`; validate `noteText` as `nullable|string|max:255` (check the column length first; use the real limit if smaller); update only if a row exists.
4. `resetAll`: `jadwalOrFail()` first. Keep the existing `wire:confirm`.
5. `save()`: iterate the student ids from a fresh DB query (`Siswa::where('kelas_id', $jadwal->kelas_id)->pluck('id')`), not from component state. Keep the "all students must be marked" rule.
6. `loadJadwals()`: if the user has no `guru` record, `$this->jadwals` is an empty collection. Never fall back to all jadwal.
7. `markAllHadir` (D1):
```php
public function markAllHadir(): void
{
    $this->jadwalOrFail();
    $filled = 0;
    foreach ($this->siswas as $siswa) {
        if (empty($this->absensiData[$siswa->id])) {
            $this->absensiData[$siswa->id] = 'hadir';
            $filled++;
        }
    }
    session()->flash('message', "$filled siswa yang belum ditandai diset Hadir (belum tersimpan). Periksa, lalu tekan Simpan.");
}
```
   Blade: add `wire:confirm="Isi semua siswa yang belum ditandai sebagai Hadir? Anda tetap perlu memeriksa lalu menekan Simpan."` to the existing button and change its label. Reuse the existing `wire:confirm` pattern (as on the reset button); do not add a modal component.

Required tests (add to `tests/Feature/AbsensiGuruTest.php`; each must assert something about DB state):
- Method-level guard (defense in depth): with a component whose `selectedJadwalId` points at another guru's jadwal, `setPresence`, `resetAll`, and `saveNote` called directly return 403 and change nothing. Use a technique that bypasses the `updatedSelectedJadwalId` hook so the method guard is what is under test (the hook path is already covered by `RBACTest`). If no such technique works in this Livewire version, say so under Deviations and test the observable outcome instead.
- `setPresence` with status `bolos` is rejected; no row created.
- `setPresence` with a student from a different class is rejected (404/403); no row created.
- `markAllHadir` leaves an existing `izin` row as `izin`, fills only unmarked students in component state, and the `absensi` row count is unchanged immediately after the call.
- After `markAllHadir` then `save()`, all rows exist with expected statuses.
- `resetAll` and `saveNote` by a non-owner are forbidden and change nothing.
- A guru-role user with no `guru` record sees an empty jadwal list.
- The two existing tests still pass unmodified.

### JadwalManager (S1, added after Phase 0)

- Add a private `ensureCanManage()` to `Waka\JadwalManager`: `abort_unless(auth()->user()->hasRole(['admin_tu', 'waka_kurikulum']), 403);`. Call it first in `create`, `edit`, `store`, `delete`, and in `resetForm`-triggering paths that open the form.
- Blade: wrap the add/edit/delete controls in `@hasanyrole('admin_tu|waka_kurikulum') ... @endhasanyrole`.
- Do not change the conflict-detection logic or the list query (see G5).
- Tests (add to `tests/Feature/JadwalCRUDTest.php`): a guru-role user calling `store`, `delete`, `edit`, `create` via `Livewire::test(JadwalManager::class)` gets 403 and the `jadwal_pelajaran` table is unchanged; `admin_tu` and `waka_kurikulum` still succeed; existing tests pass unmodified. Provide the same non-vacuity proof (remove `ensureCanManage()` from `delete`, paste the failure, restore).

### Authorization inventory (report only, no fixes beyond the two components above)

Produce a table of every public method in `app/Livewire/**` that writes or deletes data: component, method, route group(s) that reach it (from `php artisan route:list`), and the authorization present (`authorize`, role check, or none). Flag any component reachable from more than one role group, and any method with none. Fixes for rows other than `AbsensiGuru` and `JadwalManager` wait for owner review (G6).

Non-vacuity proof: for the first test and the `markAllHadir` test, temporarily remove the guard they exercise, paste the failing output, restore the guard, paste the passing output.

---

## 3. Phases

No phase starts before the previous phase's evidence is pasted and reviewed. Severity order: S1, S2, S3.

| Phase | Scope | Exit evidence (raw, verbatim) |
|---|---|---|
| 0 | Read-only. Re-measure every baseline in §0 and the commands in §4. Make no file changes. | Output of each §4 command; `git log --oneline -3`; `php artisan route:list --path=guru` |
| 1 | **S1** `AbsensiGuru` and `JadwalManager` per §2 + view changes + new tests + authorization inventory. | `php artisan test --filter=AbsensiGuruTest` and `--filter=JadwalCRUDTest` full output; the authorization inventory table; the two non-vacuity failure/pass pairs; `git diff --stat`; screenshot (375px) of the confirm prompt and of the page after "Isi Sisa" showing unsaved state message |
| 2 | **S2** Gate deferred pages (§5). | `php artisan route:list` raw; `curl -s -o /dev/null -w "%{http_code}\n"` for `/tentang /fitur /prestasi /kalender /bantuan /kontak` (expect 404), `/` (expect 302 to `/portal`), `/portal` and `/login` (expect 200); full `php artisan test`; the new gating tests |
| 3 | **S3a** Token alpha fix, then semantic hue replacement (§6); commit `scripts/check-discipline.sh` (§4). | `npm run build` raw; `bash scripts/check-discipline.sh` output and exit code; the alpha-presence check in §4 listing every used `/N` class found in built CSS; hue grep end-state = 0 in live files; screenshots of `waka/rekap-absensi` and `siswa/dashboard` showing tinted badges |
| 4 | **S3b** Decoration removal in live files (§7). | Decoration grep end-state = 0 in live files; `npm run build` raw; screenshots of `layouts/app` header, `waka/dashboard`, `portal` at 375px and 1280px |
| 5 | Final verification + `docs/design-system.md` addendum (§8). | Full `php artisan test` raw; `npm run build` raw; all §4 commands re-run; `git log --oneline` showing one commit per phase |

Final phase also re-runs the §4 commands; any non-zero end-state is reported as a failure, not rationalized.

---

## 3.1 Phase 0 follow-up: accepted, with carry-forward rules

Accepted: baselines 118 / 62 / 22 missing alpha classes / `0ac189f` / route list; test runner works (PHP 8.5.9, Laravel 13.24.0, 61 tests, 192 assertions). `laravel/pao` (require-dev) turns `php artisan test` into a JSON summary when it detects an agent; that summary cannot show which tests ran.

Carry-forward rules:
1. All test evidence is captured in text mode: `$env:PAO_DISABLE='true'; php artisan test ...`. Paste the full testdox for filtered runs and for the final full run, including the summary lines. A JSON summary alone is not evidence.
2. The pasted full-run testdox listed 60 tests but its summary said 61. `Tests\Unit\ExampleTest` (`test_that_true_is_true`) is missing from the listing. In the Phase 1 report, paste the unedited full-run text output including that block, or explain the discrepancy. Do not hand-trim output.
3. The follow-up log shows `php artisan route:list`, `find app/Livewire -type f -name "*.php"`, `ls -la app/Livewire/Admin`, `grep -rn "JadwalManager" routes/web.php` were run with no output reported. Under R8 those outputs belong in the report. Re-run them in Phase 1, since the authorization inventory needs them anyway.

---

## 4. Objective checks (definition of "done" for discipline rules)

Deferred files (excluded from live-file checks): `resources/views/{welcome,tentang,fitur,prestasi,kalender,bantuan,kontak}.blade.php`, `resources/views/livewire/{prestasi-galeri,kalender-akademik,kontak-support}.blade.php`.

```bash
LIVE='resources/views'
EXCL='welcome|tentang|fitur|prestasi|kalender|bantuan|kontak|prestasi-galeri|kalender-akademik|kontak-support'

# semantic raw hues in live files (end-state: 0)
grep -rEo "(bg|text|border|ring|from|to|via|fill|stroke|shadow)-(emerald|green|amber|sky|rose|red|yellow|orange|teal)-[0-9]+" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l

# decoration in live files (end-state: 0)
grep -rEn "backdrop-blur|animate-(float|pulse-subtle|ping)|hover-lift|glass-(card|panel|nav)|mesh-gradient|text-gradient|shadow-glow" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l

# every alpha-modified token class used in views must exist in built CSS (end-state: no MISSING lines)
for c in $(grep -rEoh "(bg|text|border|ring)-(brand|status-(hadir|izin|sakit|alfa))(-hover|-surface|-dark)?/[0-9]+" $LIVE --include=*.blade.php | sort -u); do
  esc=$(printf '%s' "$c" | sed 's#/#\\\\/#g')
  grep -q "\.$esc" public/build/assets/*.css || echo "MISSING: $c"
done

# no deferred route name referenced unguarded in live layouts (review every hit; each must sit inside @if(config('features.public_marketing')))
grep -rnE "route\('(tentang|fitur|prestasi|kalender|bantuan|kontak)'\)" resources/views/layouts resources/views/portal.blade.php
```
If the third check cannot run because `public/build` is absent, run `npm run build` first and paste its output.

In Phase 3, commit these checks as `scripts/check-discipline.sh` (run with Git Bash: `bash scripts/check-discipline.sh`; exit code 0 means every end-state holds):
```bash
#!/usr/bin/env bash
set -u
LIVE='resources/views'
EXCL='welcome|tentang|fitur|prestasi|kalender|bantuan|kontak|prestasi-galeri|kalender-akademik|kontak-support'
fail=0
hues=$(grep -rEo "(bg|text|border|ring|from|to|via|fill|stroke|shadow)-(emerald|green|amber|sky|rose|red|yellow|orange|teal)-[0-9]+" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l)
decor=$(grep -rEn "backdrop-blur|animate-(float|pulse-subtle|ping)|hover-lift|glass-(card|panel|nav)|mesh-gradient|text-gradient|shadow-glow" $LIVE --include=*.blade.php | grep -vE "/($EXCL)\.blade\.php" | wc -l)
echo "raw_hues_live=$hues"
echo "decoration_live=$decor"
[ "$hues" -eq 0 ] || fail=1
[ "$decor" -eq 0 ] || fail=1
for c in $(grep -rEoh "(bg|text|border|ring)-(brand|status-(hadir|izin|sakit|alfa))(-hover|-surface|-dark)?/[0-9]+" $LIVE --include=*.blade.php | sort -u); do
  esc=$(printf '%s' "$c" | sed 's#/#\\\\/#g')
  grep -q "\.$esc" public/build/assets/*.css || { echo "MISSING: $c"; fail=1; }
done
exit $fail
```
It does not replace the individual commands above; run both and paste both.

---

## 5. Phase 2 detail: gate deferred pages (D3)

1. Create `config/features.php`:
```php
<?php

return [
    'public_marketing' => env('FEATURE_PUBLIC_MARKETING', false),
];
```
2. Add `FEATURE_PUBLIC_MARKETING=false` to `.env.example`. Do not commit `.env`.
3. `routes/web.php`:
```php
Route::view('/portal', 'portal')->name('portal');

if (config('features.public_marketing')) {
    Route::view('/', 'welcome')->name('home');
    Route::view('/tentang', 'tentang')->name('tentang');
    Route::view('/fitur', 'fitur')->name('fitur');
    Route::view('/prestasi', 'prestasi')->name('prestasi');
    Route::view('/kalender', 'kalender')->name('kalender');
    Route::view('/bantuan', 'bantuan')->name('bantuan');
    Route::view('/kontak', 'kontak')->name('kontak');
} else {
    Route::redirect('/', '/portal')->name('home');
}
```
   Keep the route name `home` so existing `route('home')` calls keep working. Note in your report that routes are baked in at `route:cache` time, so toggling requires `php artisan route:clear`.
4. Wrap every `route('tentang'|'fitur'|'prestasi'|'kalender'|'bantuan'|'kontak')` reference in `layouts/app.blade.php` and `layouts/public.blade.php` in `@if(config('features.public_marketing')) ... @endif`. References inside deferred views need no change (unreachable when off).
5. Tests (new file `tests/Feature/PublicGatingTest.php`), flag at its default `false`:
   - each of the six URLs returns 404;
   - `/` redirects to `/portal`; `/portal` and `/login` return 200;
   - each of the four role dashboards (`admin_tu`, `waka_kurikulum`, `guru`, `siswa` test users) renders with 200 and no `RouteNotDefinedException` (this proves the layout guards).
6. If an existing test (e.g. `ExampleTest`) fails only because `/` now redirects, change only that assertion to expect the redirect and list it under Deviations. Do not change any other existing assertion.
7. Do not write tests for the three deferred components in this pass. Enabling the flag outside local development is blocked by STOP gate G2 in §10.

---

## 6. Phase 3 detail: tokens (D4, D5)

**3a. Alpha support.** In `resources/css/app.css` add channel variables next to the existing tier-2 tokens, keeping the hex variables for plain CSS use, with a comment that the channel values must mirror them:
```css
--color-brand-rgb:        5 150 105;
--color-brand-hover-rgb:  4 120 87;
--color-brand-dark-rgb:   6 78 59;
--color-brand-surface-rgb: 236 253 245;
--color-status-hadir-rgb: 34 197 94;
--color-status-izin-rgb:  245 158 11;
--color-status-sakit-rgb: 14 165 233;
--color-status-alfa-rgb:  244 63 94;
```
In `tailwind.config.js` change `brand` and `status` entries to `'rgb(var(--color-brand-rgb) / <alpha-value>)'` etc. Run the §4 alpha check; every used class must be present.

**3b. Semantic replacement map** (live files only; deferred files untouched):

| Raw | Replace with |
|---|---|
| `emerald-50/100` | `brand-surface` |
| `emerald-500/600` | `brand` |
| `emerald-700` | `brand-hover` |
| `emerald-800/900` | `brand-dark` |
| `green-*` meaning present/success | `status-hadir` (generic success: `brand`) |
| `amber-*` meaning izin or warning | `status-izin` |
| `sky-*` meaning sakit or info | `status-sakit` |
| `rose-*` / `red-*` meaning alfa | `status-alfa` |
| `rose-*` / `red-*` meaning form error or destructive action | new token `danger` |
| tints (previously `*-50/100/200`) | the token with alpha, e.g. `bg-status-izin/15` |

Pre-approved single addition: one `danger` token (rose-600 equivalent) in both hex and channel form, defined once. Any other hue (`teal`, `orange`, `yellow`) with no clear semantic: pick the nearest token and list it under Deviations. Hover shading for token colors: use `hover:brightness-95` or `hover:opacity-90`, not a raw hue. Do not touch neutral `slate`/`gray` utilities.

---

## 7. Phase 4 detail: decoration removal (D6)

Replacement map for live files:

| Found | Becomes |
|---|---|
| `glass-card`, `glass-panel`, `glass-nav`, `backdrop-blur*` | `bg-surface border border-border shadow-card rounded-xl` (header: solid `bg-surface border-b border-border`) |
| `hover-lift` | `transition-shadow hover:shadow-md` |
| `animate-ping`, `animate-pulse-subtle`, `animate-float*` | remove; keep status dots static |
| `mesh-gradient*` | `bg-brand-surface` |
| `text-gradient-*` | `text-brand` |
| `shadow-glow*` | `shadow-card` |

`layouts/public.blade.php`: remove the top announcement bar and any decorative glow/mesh elements; keep logo, "Portal", "Masuk", and a minimal footer with the madrasah's official name and address that is already there. `portal.blade.php`: flat `bg-brand-surface` page, three role cards, no glow.

In `app.css`, keep the decoration class definitions but prefix them with `/* DEFERRED: used only by gated public pages (features.public_marketing). Do not use in live screens. */`.

---

## 8. Phase 5 detail: repo memory

Append a short "Post-audit decisions" section to `docs/design-system.md` (max 12 lines) recording: the feature flag and how to toggle it; the rule that brand/status colors must be tokens with alpha via channel variables; the "Isi Sisa sebagai Hadir" semantics; the rule that deferred pages require tests plus an owner decision before the flag is enabled. Update `README.md` only if it currently lists the six public pages as shipped features.

---

## 9. Rules for the whole pass

- R1. Laziness ladder before every change: does it need to exist, does the repo already have it, does the framework do it, is it an installed dependency, can it be one line. No new composer or npm packages.
- R2. No new abstraction beyond the two private guard methods in §2.
- R3. Do not delete the deferred pages, components, models, or migrations.
- R4. Do not edit existing test assertions except the single case in §5.6. Do not weaken, skip, or delete a failing test; report it.
- R5. No religious-branding naming (e.g. "Islamic ...") in code, comments, docs, or commit messages. "Madrasah" and "Santri" as factual UI terms are fine.
- R6. Amber is reserved for `izin` status and warnings; it is not a decorative accent.
- R7. Do not redesign working screens. Touch only what each phase lists.
- R9. Work on a branch: `git switch -c remediation/post-audit` before Phase 1. One commit per phase (`phase-N: ...`). Never push, never merge to `main`, never amend or squash. The owner reviews the branch and merges.
- R10. Tests only touch the test database. Do not run `migrate:fresh`, seeders, or any destructive command against the development database.
- R11. Test evidence is text mode (`PAO_DISABLE=true`), per §3.1.
- R8. Every command you run appears in the report with its raw output, including failed, empty, or abandoned attempts. An omitted attempt is a violation; "NOT VERIFIED: None" is only valid if nothing was left unchecked.

## 10. STOP gates (halt and ask; using a fallback default is a reportable violation)

- G1. Date policy for attendance (`tanggal`): currently any date is accepted. Do NOT change it. Report it as an open question; the owner decides today-only vs a back-dating window.
- G2. Setting `features.public_marketing` to true in any environment other than local development. Requires: tests for the three components, review of what `KontakSupport` persists (validation, rate limiting, spam), and an owner decision recorded in the PRD.
- G3. Any new dependency, migration, or change to the RBAC matrix.
- G5. What a guru should see on `guru/jadwal` (own schedule only vs the whole school's). Currently the whole school's. Do NOT change the list query; report it as an open question.
- G6. Fixing authorization gaps found by the inventory in any component other than `AbsensiGuru` and `JadwalManager`.
- G4. Any test that fails for a reason outside this document's scope: paste the failure and stop on that item.

## 11. Required report format (every phase)

1. Raw command output in fenced blocks, verbatim. Not summarized, not reformatted.
2. `git diff --stat` for the phase's commit.
3. Deviations from this document, each with a reason.
4. NOT VERIFIED: anything you could not run or check.
5. No emoji, no percentages, no superlatives, no self-assigned verdict. "Done" is the reviewer's call after reading the raw output.

## 12. What NOT to do this pass

- Delete or rewrite the six deferred pages or three deferred components.
- Add dark mode, new animation, new icon sets, or new fonts.
- Add tests for the deferred components (deferred along with the pages).
- Touch `docs/Design/*` Stitch artifacts.
- Change migrations, seeders' credentials, or the RBAC role names.
- Report any phase complete from a summary instead of raw output.
