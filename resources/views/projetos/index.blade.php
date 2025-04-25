@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Projetos</h1>
@cannot('agente', App\Models\User::class)
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_projeto" label="Adicionar Projeto" icon="fas fa-plus" cor="verde"></x-botao>
</div>
@endcannot
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>                
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>
                <th scope="col" class="px-6 py-3">
                    Data do projeto
                </th>
                <th scope="col" class="px-6 py-3">
                    Tipos de empreendimento
                </th>
                <th scope="col" class="px-6 py-3">
                    Funcionários
                </th>
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody id="projetos">

        </tbody>
    </table>
</div>
<script>
    var atribuicao = '{{ Auth::user()->atribuicao }}';
</script>
@include('projetos.modais.adicionar')
@include('projetos.modais.editar')
@vite('resources/js/projetos/index.js')
@endsection