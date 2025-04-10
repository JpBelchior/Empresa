@extends('estrutura_principal.estrutura')
@section('conteudo')
<style>
    .fixed-div {
        position: fixed; 
        top: 50px;
        right: 0;
        margin: 16px;                
    }
</style>
<div class="flex justify-end">
    <button id="btn_perguntas_respondidas" class="fixed-div bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
        Perguntas respondidas
        <span id="qtd_perguntas_respondidas"></span>
    </button>
</div>
<h1>Formulário: {{ $formulario->nome }}</h1>
<br>
<a href="/formularios" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
    Formularios
</a>
<input id="formulario_id" type="hidden" value="{{ $formulario->id }}">
@foreach($perguntas as $p)
<div id="pergunta{{ $p->pergunta_id }}" class="my-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">    
    <div class="p-5">        
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $p->titulo }}</h5>        
        <x-textarea placeholder="Resposta..." class="resposta"></x-textarea>
        <x-botao id="btn_registrar_pergunta_id_{{ $p->pergunta_id }}" propriedade="{{ $p->pergunta_id }}" label="Responder" cor="verde" label="Registrar" class="registrar"></x-botao>
    </div>
</div>
@endforeach
@include('formularios.modais.perguntas_respondidas')
@vite(['resources/js/formularios/interagir.js'])
@endsection