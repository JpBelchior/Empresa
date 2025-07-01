@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Pilares</h1>
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_tematica" label="Adicionar Pilar" icon="fas fa-plus" cor="verde"></x-botao>
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
        <tbody id="tematicas">

        </tbody>
    </table>
</div>
@include('tematicas.modais.adicionar')
@include('tematicas.modais.editar')
@vite('resources/js/tematicas/index.js')
@endsection