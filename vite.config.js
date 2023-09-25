import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'
import { VitePWA } from 'vite-plugin-pwa'


export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/js/front.js','resources/js/app.js'],
            refresh: true,
        }),
        vue({
            template :{
                transformAssetUrls

            }
        }),
        quasar(),
        VitePWA({
            workbox: {
                cleanupOutdatedCaches: false,
                globPatterns: ['**/*.{js,css,html,ico,png,svg,json,vue,txt,woff2}']

            },
            registerType: 'autoUpdate',
            injectRegister: 'auto',
            manifest:{
                name : 'Keshavarz',
                description : 'test',
                theme_color : '#ffffff',
                background_color : '#ffffff',
                display : 'standalone',
                icons : [
                    {
                        src : "/logo.pnd",
                        sizes : '512x512',
                        type : 'image/png'
                    }

                ]


            }
        }),
    ],
});
