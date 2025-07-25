import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/admin.css',
                'resources/js/admin.js',
                'resources/css/app.css',
                'resources/js/app.js',
                'resources/js/home.js',
                'resources/js/single-product.js',
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
