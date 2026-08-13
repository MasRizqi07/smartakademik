<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">
                Dashboard Portal Siswa
            </h2>
            <span class="font-label-sm text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">
                Siswa Active
            </span>
        </div>
    </x-slot>

    <!-- Welcome Card -->
    <section class="flex flex-col gap-6">
        <div class="bg-surface-container-lowest p-8 rounded-xl border border-border-default shadow-card flex flex-col gap-3">
            <h1 class="font-headline-lg text-headline-lg font-bold text-text-main">
                Selamat Datang, {{ auth()->user()->name }} 🎓
            </h1>
            <p class="font-body-default text-body-default text-on-surface-variant max-w-2xl">
                Pantau progres akademik madrasah Anda, kehadiran presensi harian, serta perolehan nilai tugas dan ulangan harian.
            </p>
        </div>
    </section>
</x-app-layout>

