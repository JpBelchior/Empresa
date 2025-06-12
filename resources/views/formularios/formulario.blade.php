@extends('estrutura_principal.estrutura')
@section('conteudo')
@vite('resources/css/formulario.css')
<h1 id="nome_formulario">Formulário {{ $formulario->nome }}</h1>
<input id="formulario_id" type="hidden" value="{{ $formulario->id }}">
@foreach($perguntas as $pergunta)
<a class="card-pergunta mb-3 w-full block p-6 bg-white border border-gray-200 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
    <p class="titulo">{{ $pergunta->titulo }}</p>
    <div class="flex justify-center">
        <button pergunta="{{ $pergunta->id }}" class="responder-pergunta relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative px-5 py-1.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-transparent group-hover:dark:bg-transparent">
                Responder
            </span>
        </button>
    </div>    
</a>
@endforeach
@include('formularios.modais.dados-formulario')
@endsection