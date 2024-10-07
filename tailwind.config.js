import forms from '@tailwindcss/forms';
import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.tsx',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                brand: '#98100A',
                dark: '#101828',
            },
            animation: {
                'toast-enter': 'toast-enter 200ms ease-out',
                'toast-leave': 'toast-leave 150ms ease-in forwards',
            },
            keyframes: {
                'toast-enter': {
                    '0%': {
                        transform: 'scale(0.9)',
                        opacity: '0',
                    },
                    '100%': {
                        transform: 'scale(1)',
                        opacity: '1',
                    },
                },
                'toast-leave': {
                    '0%': {
                        transform: 'scale(1)',
                        opacity: '1',
                    },
                    '100%': {
                        transform: 'scale(0.9)',
                        opacity: '0',
                    },
                },
            },
        },
    },

    plugins: [forms],
};
