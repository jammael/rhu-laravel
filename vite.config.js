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
        host: '0.0.0.0', // Exposes the Vite server to your local Wi-Fi network
        port: 5173,
        https: false,
        hmr: {
            host: '10.196.84.34', // Your laptop's active Wi-Fi IPv4 address
            port: 5173,
            protocol: 'ws',
        },
    },
});
