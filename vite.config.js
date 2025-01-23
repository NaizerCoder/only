import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import vue from '@vitejs/plugin-vue'

export default defineConfig({
    plugins: [
        vue(),
        laravel([
            // 'resources/css/app.css',
            'resources/js/app.js',
        ]),
    ],
    // server: {
    //     host: 'only', // Хост сервера разработки
    //     //cors: false
    //     // port: 5180,        // Порт сервера разработки
    //     // strictPort: true,  // Строго использовать указанный порт
    //     // open: false,       // Не открывать браузер автоматически
    //
    // },

});
