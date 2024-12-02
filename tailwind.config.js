import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
    ],

    theme: {
        extend: {
            fontFamily: {
                'tiltwarp': ["'tiltwarp'", 'sans'],
                'sans': ["'Montserrat'", ...defaultTheme.fontFamily.sans],
            },
            animation: {
                'text-light': 'text-light 10s linear infinite',
                'background-grad': 'background-grad 5s ease infinite',
            },
            keyframes: {
                'text-light': {
                    '0%': { 'background-position-x': '200%' },
                    '5%': { 'background-position-x': '-40%' },
                    '100%': { 'background-position-x': '-40%' },
                },
                'background-grad':{
                    '0%, 100%': {'background-position': '0% 50%'},
                    '50%': {'background-position': '100% 50%' }
                },
            },
            colors: {
                principal: {
                    50: "#ffebef",
                    100: "#ffe0e3",
                    200: "#ffc7d0",
                    300: "#ff9eae",
                    400: "#ff6682",
                    500: "#fb325e",
                    600: "#e5154d",
                    700: "#c10b3f",
                    800: "#ab0d3f",
                    900: "#910d3b",
                    950: "#55011c",
                },
            },
            boxShadow: {
                custom: ['0 0 0 2px #ffffff, 0 0 0 4px #000000, 0 1px 2px 0 rgba(0, 0, 0, 0)'],
            },
        },
    },

    plugins: [
        forms,
        typography,
    ],
};
