@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Auditoria</h1>
<h2>Período</h2>
<div>
    <x-input id="inicio" type="date" label="Início"></x-input>
    <x-input id="fim" type="date" label="Fim"></x-input>
</div>
<div class="mt-4 flex justify-center items-center">
    <a formato="pdf" class="gerar bg-red-500 text-white px-4 py-2 rounded mr-4 hover:bg-red-700">
        <i class="fas fa-file-pdf"></i>
    </a>
    <a formato="excel" class="gerar bg-green-500 text-white px-4 py-2 rounded hover:bg-green-700">
        <i class="fas fa-file-excel"></i>
    </a>
</div>
@vite('resources/js/auditoria/index.js')
@endsection