import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Plus Jakarta Sans', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'kun-primary': '#8B1E24',
                'kun-light': '#A9262D',
                'kun-gold': '#F4D03F',
                'kun-gold-dark': '#D4B128',
                kun: {
                    maroon: '#8B1E24',
                    'maroon-light': '#A9262D',
                    gold: '#F4D03F',
                    'gold-dark': '#D4B128',
                    slate: '#F8FAFC',
                },
            },
            backgroundImage: {
                'islamic-pattern': "url('/images/pattern-geometry.svg')",
            },
            boxShadow: {
                glow: '0 20px 45px -20px rgba(139, 30, 36, 0.35)',
            },
        },
    },

    plugins: [forms],
};
