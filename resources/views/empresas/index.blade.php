@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Empresas</h1>
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_empresa" label="Adicionar empresa" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Ativo
                </th>
                <th scope="col" class="px-6 py-3">
                    Razão Social
                </th>
                <th scope="col" class="px-6 py-3">
                    CNPJ
                </th>
                <th scope="col" class="px-6 py-3">
                    Limite de usuários
                </th>
                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
        </thead>
        <tbody id="empresas">

        </tbody>
    </table>
</div>
@include('empresas.modais.adicionar')
@include('empresas.modais.editar')
@vite('resources/js/empresas/empresas.js')
@endsection