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
                'resources/js/empresas/index.js',
                'resources/js/empresas/funcoes.js',
                'resources/js/empresas/adicionar.js',
                'resources/js/empresas/editar.js',
                //TIPOS DE EMPREENDIMENTOS
                'resources/js/tipos_empreendimentos/index.js',
                'resources/js/tipos_empreendimentos/funcoes.js',
                'resources/js/tipos_empreendimentos/adicionar.js',
                'resources/js/tipos_empreendimentos/editar.js',
                //TÓPICOS
                'resources/js/topicos/index.js',
                'resources/js/topicos/funcoes.js',
                'resources/js/topicos/adicionar.js',
                'resources/js/topicos/editar.js',
                //ÁREAS
                'resources/js/areas/index.js',
                'resources/js/areas/funcoes.js',
                'resources/js/areas/adicionar.js',
                'resources/js/areas/editar.js',
                //TEMÁTICAS
                'resources/js/tematicas/index.js',
                'resources/js/tematicas/funcoes.js',
                'resources/js/tematicas/adicionar.js',
                'resources/js/tematicas/editar.js',
                //TAGS
                'resources/js/tags/index.js',
                'resources/js/tags/funcoes.js',
                'resources/js/tags/adicionar.js',
                'resources/js/tags/editar.js'
            ],
            refresh: true,
        }),
        tailwindcss(),
    ],
});
