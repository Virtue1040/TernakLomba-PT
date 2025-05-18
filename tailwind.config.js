import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    mode: 'jit',
    darkMode: 'class',
    content: [
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.js",
        "./resources/js/**/*.vue",
    ],    

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                manrope: ['Manrope', 'sans-serif'],
                cabinet: ['Cabinet', 'sans-serif']
            },
        },
    },

    plugins: [forms],
};
