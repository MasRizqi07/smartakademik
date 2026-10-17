# Sweep Analysis for Scoping Leaks (`sweep.md`)

## Search Pattern
`git grep -nE "take\(|\?\? *\\\\App\\\\Models" -- resources/views/guru resources/views/livewire/guru resources/views/siswa resources/views/livewire/siswa app/Livewire/Guru app/Livewire/Siswa`

## Findings
Total matches: 1

1. `resources/views/guru/dashboard.blade.php:113`:
   - Code: `: \App\Models\JadwalPelajaran::with(['kelas', 'mapel'])->take(3)->get());`
   - Evaluation: If the logged-in user with role `guru` does not have an associated `Guru` record (`$userGuru` is null), the ternary expression previously evaluated this branch and retrieved the first 3 schedules across the entire school regardless of teacher ownership. This leaked foreign teacher schedules onto the user's dashboard.
   - Disposition: Replaced with `: collect());`. The existing `@forelse` empty state now renders cleanly without leaking foreign teacher schedules.

No other instances of `take(` or model query fallbacks were found in any guru or siswa views or Livewire components.
