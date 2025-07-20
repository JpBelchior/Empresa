@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Tópicos</h1>
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_topico" label="Adicionar Tópico" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500">
        <thead class="text-xs text-gray-700 uppercase">
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
        <tbody id="topicos">

        </tbody>
    </table>
</div>
@include('topicos.modais.adicionar')
@include('topicos.modais.editar')
@vite('resources/js/topicos/index.js')
@endsection