<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getenv('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>    
    @include("estrutura_principal.cabecalho")
    @include("estrutura_principal.sidebar")
    <div class="p-4 sm:ml-64">
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg dark:border-gray-700 mt-14">
            <h1>{{ session('nome_empresa') }}</h1>
            @yield('conteudo')  
        </div>
    </div>        
    @include('estrutura_principal.modal_redefinir_senha')
    @include('estrutura_principal.modal_empresas')
</body>
</html>