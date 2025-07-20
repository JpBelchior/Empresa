@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Áreas</h1>
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_area" label="Adicionar Área" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50">
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
        <tbody id="areas">

        </tbody>
    </table>
</div>
@include('areas.modais.adicionar')
@include('areas.modais.editar')
@vite('resources/js/areas/index.js')
@endsection