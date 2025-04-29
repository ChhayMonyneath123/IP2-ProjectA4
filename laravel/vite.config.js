import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import laravel from 'laravel-vite-plugin';
import path from 'path'
export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
        vue(),
    ],
    resolve: {
        alias: {
          '@': path.resolve(__dirname, 'resources/js'),
        }
    },
    server: {
        host: '0.0.0.0',  // Add this to make Vite listen on all network interfaces
        port: 5173,       // Explicitly set the port
        hmr: {
            host: 'localhost'  // For Hot Module Replacement
        }
    }
    
});
