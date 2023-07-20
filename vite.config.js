import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'


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
        quasar()
    ],
});
