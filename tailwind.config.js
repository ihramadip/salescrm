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
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                emerald: {
                    50: '#ecfdf5', // Background
                    500: '#10b981', // Primary
                    600: '#059669', // Primary Hover
                },
                slate: {
                    200: '#e2e8f0', // Border
                    500: '#64748b', // Text Soft
                    900: '#0f172a', // Text Dark
                },
            },
        },
    },

    plugins: [forms],
};
