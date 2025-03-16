@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Tipos de empreendimentos</h1>
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_tipo_empreendimento" label="Adicionar Tipo de empreendimento" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Ativo
                </th>
                <th scope="col" class="px-6 py-3">
                    Nome
                </th>               
                <th scope="col" class="px-6 py-3">

                </th>
            </tr>
        </thead>
        <tbody id="tipos_empreendimentos">

        </tbody>
    </table>
</div>
@include('tipos_empreendimentos.modais.adicionar')
@include('tipos_empreendimentos.modais.editar')
@vite('resources/js/tipos_empreendimentos/index.js')
@endsection