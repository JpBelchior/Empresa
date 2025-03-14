import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/app.css', 
                'resources/js/app.js',
                'resources/js/login/login.js',
                'resources/js/login/recuperar_senha.js',
                'resources/js/estrutura/redefinir_senha.js',
                //EMPRESAS
                'resources/js/empresas/empresas.js',
                'resources/js/empresas/funcoes.js',
                'resources/js/empresas/adicionar.js',
                'resources/js/empresas/editar.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
