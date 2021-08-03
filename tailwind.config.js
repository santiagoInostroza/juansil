const defaultTheme = require('tailwindcss/defaultTheme');
const ta_gallery_safelist = require('./node_modules/@markusantonwolf/ta-gallery/src/plugin/safelist');


module.exports = {
    purge: [
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        {
            options: {
                safelist: [...ta_gallery_safelist],
            },
        }
    
      
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
        },
        taGallery: {
            animations: ['swing', 'swipe', 'slide', 'rotate', 'snake', 'window', 'scroll', 'fade', 'dynamic'],
            animation_default: 'slide', // default value
            aspect_ratios: [
                // all aspect ratios
                'square',
                'movietone',
                'large',
                'tv',
                'academy',
                'imax',
                'classic',
                'still',
                'modern',
                'common',
                'golden',
                'super',
                'hd',
                'wide',
                {
                    instagram: 3 / 5, // add your own aspect ratio
                },
            ],
        },
    },

    variants: {
        opacity: ['responsive', 'hover', 'focus', 'disabled'],
        overflow: ['hover'],
        taGallery: ['responsive']
    },

    plugins: [
        require('@tailwindcss/ui'),
        require('tailwind-scrollbar-hide'),
        require('@markusantonwolf/ta-gallery')
    ],

    corePlugins: {
        // ...
       container: false,
      }
};
//