@extends('estrutura_principal.estrutura')
@section('conteudo')
<div>
    <x-botao id="btn_modal_adicionar_formulario" label="Adicionar Formulário" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div id="formularios">

</div>
<!--<div class="relative overflow-x-auto shadow-md sm:rounded-lg">
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
</div> -->
@include('formularios.modais.adicionar')
@include('formularios.modais.editar')
@vite('resources/js/formularios/index.js')
@endsection