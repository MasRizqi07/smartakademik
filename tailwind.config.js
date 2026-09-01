import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            fontSize: {
                'body-default': ['14px', { lineHeight: '20px', fontWeight: '400' }],
                'headline-lg': ['24px', { lineHeight: '32px', fontWeight: '600' }],
                'headline-md': ['20px', { lineHeight: '28px', fontWeight: '600' }],
                'input-text': ['16px', { lineHeight: '24px', fontWeight: '400' }],
                'label-sm': ['12px', { lineHeight: '16px', fontWeight: '500' }],
                'label-md': ['14px', { lineHeight: '20px', fontWeight: '500' }],
                'body-lg': ['16px', { lineHeight: '24px', fontWeight: '400' }],
            },
            colors: {
                /* ===== 3-TIER CANONICAL TOKENS ===== */
                brand: {
                    DEFAULT: 'var(--color-brand)',
                    hover: 'var(--color-brand-hover)',
                    surface: 'var(--color-brand-surface)',
                },
                status: {
                    hadir: 'var(--color-status-hadir)',
                    izin: 'var(--color-status-izin)',
                    sakit: 'var(--color-status-sakit)',
                    alfa: 'var(--color-status-alfa)',
                },
                surface: {
                    page: 'var(--color-bg-page)',
                    DEFAULT: 'var(--color-bg-surface)',
                },
                border: {
                    DEFAULT: 'var(--color-border-default)',
                },
                text: {
                    primary: 'var(--color-text-primary)',
                    secondary: 'var(--color-text-secondary)',
                },

                /* ===== BACKWARD-COMPAT ALIASES =====
                   These map the MD3 class names already used in views
                   to the 3-tier values via CSS custom properties.
                   Migrate views file-by-file, then remove these. */
                'surface-container-lowest': 'rgb(var(--color-surface-container-lowest) / <alpha-value>)',
                'surface-container-low': 'rgb(var(--color-surface-container-low) / <alpha-value>)',
                'surface-container': 'rgb(var(--color-surface-container) / <alpha-value>)',
                'surface-container-high': 'rgb(var(--color-surface-container-high) / <alpha-value>)',
                'surface-container-highest': 'rgb(var(--color-surface-container-highest) / <alpha-value>)',
                'surface-bright': 'rgb(var(--color-surface-bright) / <alpha-value>)',
                'surface-dim': 'rgb(var(--color-surface-dim) / <alpha-value>)',
                'surface-variant': 'rgb(var(--color-surface-variant) / <alpha-value>)',
                'on-surface': 'rgb(var(--color-on-surface) / <alpha-value>)',
                'on-surface-variant': 'rgb(var(--color-on-surface-variant) / <alpha-value>)',
                'outline': 'rgb(var(--color-outline) / <alpha-value>)',
                'outline-variant': 'rgb(var(--color-outline-variant) / <alpha-value>)',
                'primary': 'rgb(var(--color-primary) / <alpha-value>)',
                'on-primary': 'rgb(var(--color-on-primary) / <alpha-value>)',
                'primary-container': 'rgb(var(--color-primary-container) / <alpha-value>)',
                'on-primary-container': 'rgb(var(--color-on-primary-container) / <alpha-value>)',
                'inverse-primary': 'rgb(var(--color-inverse-primary) / <alpha-value>)',
                'secondary': 'rgb(var(--color-secondary) / <alpha-value>)',
                'on-secondary': 'rgb(var(--color-on-secondary) / <alpha-value>)',
                'secondary-container': 'rgb(var(--color-secondary-container) / <alpha-value>)',
                'on-secondary-container': 'rgb(var(--color-on-secondary-container) / <alpha-value>)',
                'tertiary': 'rgb(var(--color-tertiary) / <alpha-value>)',
                'on-tertiary': 'rgb(var(--color-on-tertiary) / <alpha-value>)',
                'tertiary-container': 'rgb(var(--color-tertiary-container) / <alpha-value>)',
                'on-tertiary-container': 'rgb(var(--color-on-tertiary-container) / <alpha-value>)',
                'surface-tint': 'rgb(var(--color-surface-tint) / <alpha-value>)',
                'error': '#ba1a1a',
                'on-error': '#ffffff',
                'error-container': '#ffdad6',
                'on-error-container': '#93000a',
                'background': 'rgb(var(--color-surface) / <alpha-value>)',
                'on-background': 'rgb(var(--color-on-surface) / <alpha-value>)',
                'status-hadir': 'var(--color-status-hadir)',
                'status-izin': 'var(--color-status-izin)',
                'status-sakit': 'var(--color-status-sakit)',
                'status-alfa': 'var(--color-status-alfa)',
                'border-default': 'rgb(var(--color-border-default-rgb) / <alpha-value>)',
                'text-main': 'rgb(var(--color-text-main) / <alpha-value>)',
            },
            boxShadow: {
                'card': 'var(--shadow-card)',
                'soft': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01)',
            },
            spacing: {
                'touch-target': '44px',
                'container-padding-mobile': '1rem',
                'list-gap': '0.5rem',
                'section-margin': '1.5rem',
                'grid-gutter': '1rem',
            },
            borderRadius: {
                'DEFAULT': '0.5rem',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.4s ease-out',
            },
            keyframes: {
                fadeIn: {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                slideUp: {
                    '0%': { opacity: '0', transform: 'translateY(20px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
            },
        },
    },

    plugins: [forms],
};
