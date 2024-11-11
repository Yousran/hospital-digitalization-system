import defaultTheme from 'tailwindcss/defaultTheme';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'media',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js'
    ],
    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "primary": "#5D80AB",
                "primary-50": "#81A1C1",
                "secondary": "#4C566A",
                "accent": "#88C0D0",
                "neutral-100": "#D8DEE9",
                "neutral-50": "#E5E9F0",
                "neutral-25": "#ECEFF4",
                "info": "#00a4cb",
                "success": "#009000",
                "warning": "#e69400",
                "error": "#ff7480",
            }
        },
    },
    plugins: [
        require('flowbite/plugin'),
    ],
};
