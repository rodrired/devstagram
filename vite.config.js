import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            //refresh: false, // importante: no usar HMR en producción
        }),
        tailwindcss(),
    ],
    server: {
        //hmr: false // desactiva el hot reload
    }
});
