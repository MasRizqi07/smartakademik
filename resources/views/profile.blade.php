<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-headline-md text-headline-md text-primary font-bold">
                Pengaturan Profil Akun
            </h2>
            <span class="font-label-sm text-on-surface-variant bg-surface-container-high px-3 py-1 rounded-full">
                Akun Saya
            </span>
        </div>
    </x-slot>

    <div class="flex flex-col gap-6">
        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card">
            <div class="max-w-xl">
                <livewire:profile.update-profile-information-form />
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card">
            <div class="max-w-xl">
                <livewire:profile.update-password-form />
            </div>
        </div>

        <div class="bg-surface-container-lowest p-6 rounded-xl border border-border-default shadow-card">
            <div class="max-w-xl">
                <livewire:profile.delete-user-form />
            </div>
        </div>
    </div>
</x-app-layout>

