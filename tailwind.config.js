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
                // Keep Figtree for regular user pages, but add Outfit for the Admin Dashboard
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                outfit: ['Outfit', 'sans-serif'],
            },
            // Adding these TailAdmin specific breakpoints so the sidebar and grid work correctly
            screens: {
                '2xsm': '375px',
                'xsm': '425px',
                '3xl': '2000px',
            },
        },
    },

    plugins: [forms],
};
