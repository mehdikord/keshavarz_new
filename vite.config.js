import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';
import { quasar, transformAssetUrls } from '@quasar/vite-plugin'


export default defineConfig({
    plugins: [
        laravel(
            {
                input: ['resources/css/app.css', 'resources/js/front.js'],
                refresh: true,
            },
            {
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            }

        ),
        vue({
            template :{
                transformAssetUrls

            }
        }),
        quasar()
    ],
});
