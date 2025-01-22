import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue';

export default defineConfig({
    plugins: [
        laravel({
            input: 'resources/js/app.js',
            //refresh: true,
            refresh: [
                'resources/stores/**',
                'app/Livewire/**',
                'app/View/Components/**',
                'lang/**',
                'resources/lang/**',
                'resources/views/**',
                'routes/**'
            ],
            assetsInclude: ['**/*.png', '**/*.jpg', '**/*.svg', '**/*.gif', '**/*.webp', '**/*.ico', '**/*.woff', '**/*.woff2', '**/*.ttf', '**/*.eot'],
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
            '@': '/resources/js',
            '@images': '/resources/images',
        },
    },
});
