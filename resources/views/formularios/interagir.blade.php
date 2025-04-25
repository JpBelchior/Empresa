@extends('estrutura_principal.estrutura')
@section('conteudo')
<style>
    .fixed-div {
        position: fixed; 
        top: 50px;        
        margin: 16px;                
    }

    #btn_perguntas_respondidas{
        right: 0;
    }

    #online{
        right: 280px;
    }
</style>
<div class="flex justify-end">
    <button id="btn_perguntas_respondidas" class="fixed-div bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
        Perguntas respondidas
        <span id="qtd_perguntas_respondidas"></span>
    </button>
</div>
<div id="online" class="fixed-div p-4 mb-4 text-sm rounded-lg" role="alert"></div>
<h1>Formulário: {{ $formulario->nome }}</h1>
<h2>{{ count($perguntas) }} perguntas</h2>
<br>
<a href="/formularios" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-lg hover:bg-blue-600 focus:outline-none">
    Formularios
</a>
<input id="formulario_id" type="hidden" value="{{ $formulario->id }}">
@foreach($perguntas as $p)
<div id="pergunta{{ $p->id }}" class="my-4 bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">    
    <div class="p-5">        
        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">{{ $p->titulo }}</h5>        
        <x-textarea placeholder="Resposta..." class="resposta"></x-textarea>
        <x-botao id="btn_registrar_pergunta_id_{{ $p->id }}" propriedade="{{ $p->id }}" label="Responder" cor="verde" label="Registrar" class="registrar"></x-botao>
    </div>
</div>
<script>
    var url = "{{ getenv('REMOTE_URL') }}";
</script>
@endforeach
@include('formularios.modais.perguntas_respondidas')
@vite(['resources/js/formularios/interagir.js'])
@endsection