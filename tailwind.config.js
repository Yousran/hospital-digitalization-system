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
                //TODO: Theme Color
                "primary": {
                "50": "#eff2f7",
                "100": "#dfe6ee",
                "200": "#beccdd",
                "300": "#9eb3cd",
                "400": "#7d99bc",
                "500": "#5d80ab",
                "600": "#4a6689",
                "700": "#384d67",
                "800": "#253344",
                "900": "#131a22"
                },
                "secondary": {
                "50": "#eff4f5",
                "100": "#e0e9ec",
                "200": "#c0d3d8",
                "300": "#a1bec5",
                "400": "#81a8b1",
                "500": "#62929e",
                "600": "#4e757e",
                "700": "#3b585f",
                "800": "#273a3f",
                "900": "#141d20"
                },
                "light" : {
                    "500" : "#FDFDFF",
                    "600" : "#EDEDE9",
                    "700" : "#E3E3DD",
                    "800" : "#DADAD2",
                    "900" : "#D1D1C7",
                },
                "dark" : {
                    "100" : "#61686B",
                    "200" : "#575D60",
                    "300" : "#4E5356",
                    "400" : "#393D3F",
                    "500" : "#262A2B",
                },
                transparent: 'transparent',
            }
        },
    },
    plugins: [
        require('flowbite/plugin')({
            datatables: true,
            charts: true,
        }),
    ],
};
