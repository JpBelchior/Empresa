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
        <div class="p-4 border-2 border-gray-200 border-dashed rounded-lg mt-14">
            <h1>{{ session('nome_empresa') }}</h1>
            <nav class="flex breadcrumb-estrutura" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                    <li class="inline-flex items-center">
                        <a class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-blue-600">                            
                            {{ session("primeira_sessao") }}
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="rtl:rotate-180 w-3 h-3 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4" />
                            </svg>
                            <a class="ms-1 text-sm font-medium text-gray-700 hover:text-blue-600 md:ms-2">
                                {{ session("segunda_sessao") }}
                            </a>
                        </div>
                    </li>                    
                </ol>
            </nav>
            @yield('conteudo')
        </div>
    </div>
    @include('estrutura_principal.modal_redefinir_senha')
    @include('estrutura_principal.modal_empresas')
</body>

</html>