@extends('estrutura_principal.estrutura')
@section('conteudo')
<div>
    <x-botao id="btn_modal_adicionar_formulario" label="Adicionar Formulário" icon="fas fa-plus" cor="verde"></x-botao>
</div>
<div id="formularios">

</div>
@include('formularios.modais.adicionar')
@include('formularios.modais.editar')
@vite('resources/js/formularios/index.js')
@endsection