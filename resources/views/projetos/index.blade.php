@extends('estrutura_principal.estrutura')
@section('conteudo')
<h1>Projetos</h1>
@cannot('agente', App\Models\User::class)
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_projeto" label="Adicionar Projeto" icon="fas fa-plus" cor="verde"></x-botao>
</div>
@endcannot
<div id="projetos" class="w-full">

</div>

<script>
    var atribuicao = '{{ Auth::user()->atribuicao }}';
</script>
@include('projetos.modais.adicionar')
@include('projetos.modais.editar')
@vite('resources/js/projetos/index.js')
@endsection