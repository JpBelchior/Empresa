@extends('estrutura_principal.estrutura')
@section('conteudo')
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_formulario" label="Adicionar Formulário" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>                
                <th scope="col" class="px-6 py-3">
                    Título do formulário
                </th>
                <th scope="col" class="px-6 py-3">
                    Projeto
                </th>                               
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody id="formularios">

        </tbody>
    </table>
</div>
<a id="formulario1" href="#" class="w-full block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">FORMULARIO</h5>
    <p class="font-normal text-gray-700 dark:text-gray-400">Data de início: 11/11/1111</p>
    <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
        <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
    </div>
    <div class="flex justify-between">
        <p><span>11/11 </span> Perguntas</p>
        <p>2%</p>
    </div>
    <div class="flex justify-between">
        <p class="text-yellow-500">V</p>
        <p class="text-red-500">V</p>
        <p class="text-green-500">V</p>
    </div>
</a>
@include('formularios.modais.formulario')
@include('formularios.modais.adicionar')
@include('formularios.modais.editar')
@vite('resources/js/formularios/index.js')
@endsection