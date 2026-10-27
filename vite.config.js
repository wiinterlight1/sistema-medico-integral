import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import { bunny } from 'laravel-vite-plugin/fonts';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css',
                 'resources/js/app.js',
                 'resources/css/home.css',
                 'resources/css/navbar.css',
                 'resources/css/pacientes.css',
                 'resources/css/especialidades.css',
                 'resources/css/medicos.css',
                 'resources/css/consultorios.css',
                 'resources/css/citas.css',

                ],
            refresh: true,
            fonts: [
                bunny('Instrument Sans', {
                    weights: [400, 500, 600],
                }),
            ],
        }),
        tailwindcss(),
    ],
    server: {
    host: '0.0.0.0',
    origin: 'http://localhost:5173',
    hmr: {
        host: 'localhost',
    },
    watch: {
        ignored: ['**/storage/framework/views/**'],
    },
},
});
