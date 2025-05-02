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
    <h1 class="my-4">Auditoria ({{ count($registros) }})</h1>    
    <div class="relative overflow-x-auto">
        <table class="text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">                
                <tr>
                    <th class="px-6 py-3">
                        Usuário
                    </th>
                    <th class="px-6 py-3">
                        Ação
                    </th>
                    <th class="px-6 py-3">
                        IP
                    </th>
                    <th  class="px-6 py-3">
                        Data da ação
                    </th>                    
                </tr>
            </thead>
            <tbody>
                @foreach($registros as $r)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">
                    <td class="pergunta px-6 py-4">{{ $r->nome }}</td>
                    <td class="pergunta px-6 py-4">{{ $r->nome_acao }}</td>
                    <td class="pergunta px-6 py-4">{{ $r->ip }}</td>
                    <td class="pergunta px-6 py-4">{{ formatar_data($r->data_cadastro) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>