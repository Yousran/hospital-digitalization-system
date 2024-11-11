import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    server: {
        host: '0.0.0.0',
        port: 5173,
        hmr: {
            host: 'localhost', // Hot Module Replacement setup
        },
    },
});
//TODO:dikarenakan vite yang berjalan sangat lambat jika dijalankan melalui docker container
//maka jalankan 'npm run dev' di terminal yang berada di luar container
//pastikan sudah menginstall npm dan node js lalu menjalankan perintah npm install untuk menginstal vite nya