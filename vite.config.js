import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    server: {
        host: '167.99.83.205',  // Replace this with your server IP
        port: 5173,                // The port used by Vite
        hmr: {
            host: '167.99.83.205',  // Set HMR to use the server IP
        },
        watch: {
            ignored: ['**/vendor/**', '**/node_modules/**'], // Ignore vendor and node_modules directories
        },
    },
    plugins: [
        laravel({
            input: [
                'resources/sass/app.scss',
                'resources/js/app.js',
            ],
            refresh: true,
        }),
        vue({
            template: {
                transformAssetUrls: {
                    base: null,
                    includeAbsolute: false,
                },
            },
        }),
    ],
    resolve: {
        alias: {
            vue: 'vue/dist/vue.esm-bundler.js',
        },
    },
});
