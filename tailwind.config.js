const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nico-Moji', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: '#09aac0',
                secondary: '#E00496',
            },
        },
    },

    plugins: [require('@tailwindcss/forms')],
};
