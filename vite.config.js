import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/custom.css', // Tu archivo CSS personalizado
                'resources/js/kxpo.js', // JavaScript de Laravel (si lo usas)
            ],
            refresh: true,
        }),
    ],
});
