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
                'body-default': ['Inter', 'sans-serif'],
                'headline-lg': ['Inter', 'sans-serif'],
                'headline-md': ['Inter', 'sans-serif'],
                'input-text': ['Inter', 'sans-serif'],
                'label-sm': ['Inter', 'sans-serif'],
                'label-md': ['Inter', 'sans-serif'],
                'body-lg': ['Inter', 'sans-serif'],
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
            spacing: {
                'touch-target': '44px',
                'container-padding-mobile': '1rem',
                'list-gap': '0.5rem',
                'section-margin': '1.5rem',
                'grid-gutter': '1rem',
            },
            colors: {
                'surface': '#f7f9fb',
                'surface-dim': '#d8dadc',
                'surface-bright': '#f7f9fb',
                'surface-container-lowest': '#ffffff',
                'surface-container-low': '#f2f4f6',
                'surface-container': '#eceef0',
                'surface-container-high': '#e6e8ea',
                'surface-container-highest': '#e0e3e5',
                'surface-variant': '#e0e3e5',
                'on-surface': '#191c1e',
                'on-surface-variant': '#3d4a42',
                'inverse-surface': '#2d3133',
                'inverse-on-surface': '#eff1f3',
                'outline': '#6d7a72',
                'outline-variant': '#bccac0',
                'surface-tint': '#006c4a',
                'primary': '#006948',
                'on-primary': '#ffffff',
                'primary-container': '#00855d',
                'on-primary-container': '#f5fff7',
                'inverse-primary': '#68dba9',
                'secondary': '#515f74',
                'on-secondary': '#ffffff',
                'secondary-container': '#d5e3fc',
                'on-secondary-container': '#57657a',
                'tertiary': '#006947',
                'on-tertiary': '#ffffff',
                'tertiary-container': '#00855b',
                'on-tertiary-container': '#f5fff6',
                'error': '#ba1a1a',
                'on-error': '#ffffff',
                'error-container': '#ffdad6',
                'on-error-container': '#93000a',
                'primary-fixed': '#85f8c4',
                'primary-fixed-dim': '#68dba9',
                'on-primary-fixed': '#002114',
                'on-primary-fixed-variant': '#005137',
                'secondary-fixed': '#d5e3fc',
                'secondary-fixed-dim': '#b9c7df',
                'on-secondary-fixed': '#0d1c2e',
                'on-secondary-fixed-variant': '#3a485b',
                'tertiary-fixed': '#6ffbbe',
                'tertiary-fixed-dim': '#4edea3',
                'on-tertiary-fixed': '#002113',
                'on-tertiary-fixed-variant': '#005236',
                'background': '#f7f9fb',
                'on-background': '#191c1e',
                'status-hadir': '#22c55e',
                'status-izin': '#f59e0b',
                'status-sakit': '#0ea5e9',
                'status-alfa': '#f43f5e',
                'border-default': '#e2e8f0',
                'text-main': '#0f172a',
                brand: {
                    50: '#ecfdf5',
                    100: '#d1fae5',
                    500: '#006948',
                    600: '#006948',
                    900: '#002114',
                },
                accent: {
                    500: '#515f74',
                }
            },
            boxShadow: {
                'glass': '0 4px 30px rgba(0, 0, 0, 0.1)',
                'glow': '0 0 15px rgba(0, 105, 72, 0.4)',
                'soft': '0 10px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.01)',
                'card': '0 1px 3px 0 rgba(0, 0, 0, 0.1), 0 1px 2px 0 rgba(0, 0, 0, 0.06)',
            },
            borderRadius: {
                'DEFAULT': '0.25rem',
                'lg': '0.5rem',
                'xl': '0.75rem',
                'full': '9999px',
            },
            animation: {
                'fade-in': 'fadeIn 0.5s ease-out',
                'slide-up': 'slideUp 0.4s ease-out',
                'pulse-slow': 'pulse 3s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                'bounce-sm': 'bounceSm 1s infinite',
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
                bounceSm: {
                    '0%, 100%': { transform: 'translateY(-5%)', animationTimingFunction: 'cubic-bezier(0.8,0,1,1)' },
                    '50%': { transform: 'none', animationTimingFunction: 'cubic-bezier(0,0,0.2,1)' },
                }
            }
        },
    },

    plugins: [forms],
};

