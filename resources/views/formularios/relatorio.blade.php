<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ getenv('APP_NAME') }}</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}" type="image/x-png">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        @media print {            
            @page {
                size: landscape;
            }            
            body {
                font-family: Arial, sans-serif;
                margin: 20px;
                color: #000;
            }
        }

        .pergunta{
            width: 500px;
        }
    </style>
    <script>
        window.print()
    </script>
</head>
<body>
    <h1 class="my-4">{{ $formulario->nome }}</h1>
    <h2>Respostas ({{ count($respostas) }})</h2>
    <div class="relative overflow-x-auto">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">                
                <tr>
                    <th class="px-6 py-3">
                        Pergunta
                    </th>
                    <th class="px-6 py-3">
                        Resposta
                    </th>
                    <th  class="px-6 py-3">
                        Responsável
                    </th>
                    <th class="px-6 py-3">
                        Momento do cadastro
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($respostas as $resposta)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="pergunta px-6 py-4">
                        {{ $resposta->pergunta->titulo }}
                    </td>
                    <td class="pergunta px-6 py-4">
                        {{ $resposta->resposta }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $resposta->usuario->nome }}
                    </td>
                    <td class="px-6 py-4">
                        {{ formatar_data($resposta->data_cadastro) }}
                    </td>
                </tr>               
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>