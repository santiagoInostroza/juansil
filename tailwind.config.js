const defaultTheme = require('tailwindcss/defaultTheme');
const ta_gallery_safelist = require('./node_modules/@markusantonwolf/ta-gallery/src/plugin/safelist')


module.exports = {
    mode: 'jit',
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
            scale: {
                '175': '1.75',
                '200': '2',
                '250': '2.5',
                '300': '3',
                '400': '4',
                '500': '5',
            },
            transitionDuration: {
                '0': '0ms',
                '2000': '2000ms',
            },
            rotate: {
                '270': '270deg',
              }
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
                    instagram: 80 / 31, // add your own aspect ratio
                    santy: 2 / 1,
                    santy2: 1 / 2,
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