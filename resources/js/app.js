// SmartAkademik Theme Management System (Light / Dark mode)

window.applyTheme = function () {
    const savedTheme = localStorage.getItem('theme');
    const systemPrefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;

    if (savedTheme === 'dark' || (!savedTheme && systemPrefersDark)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }
};

window.toggleTheme = function () {
    const isCurrentlyDark = document.documentElement.classList.contains('dark');
    const newTheme = isCurrentlyDark ? 'light' : 'dark';

    if (newTheme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    localStorage.setItem('theme', newTheme);

    // Dispatch global custom event for components & charts
    window.dispatchEvent(new CustomEvent('theme-changed', {
        detail: { isDark: newTheme === 'dark', theme: newTheme }
    }));
};

// Initial sync
window.applyTheme();

// Livewire 3 wire:navigate persistence
document.addEventListener('livewire:navigated', window.applyTheme);
document.addEventListener('DOMContentLoaded', window.applyTheme);

// Listen to OS system color scheme changes if user hasn't explicitly set a preference
window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
    if (!localStorage.getItem('theme')) {
        if (e.matches) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }
        window.dispatchEvent(new CustomEvent('theme-changed', {
            detail: { isDark: e.matches, theme: e.matches ? 'dark' : 'light' }
        }));
    }
});
