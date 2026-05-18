import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
            detectTls: false,
        })
    ],
    server: {
        host: 'localhost', // Exposes the Vite server to your local Wi-Fi network
        port: 5173,
        https: false,
        hmr: {
            host: 'localhost', // Your laptop's active Wi-Fi IPv4 address
            port: 5173,
            protocol: 'ws',
        },
    },
});
