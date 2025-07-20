@extends('estrutura_principal.estrutura')
@section('conteudo')
@php 
    $atribuicao = Auth::user()->atribuicao;
@endphp
<script>
    var atribuicao = "{{ $atribuicao }}";
</script>
<h1>Funcionários</h1>
<h3>Limite de usuários: {{ session('limite_usuarios_empresa') }}</h3>
<div class="p-4 mb-4 text-sm text-blue-800 rounded-lg bg-blue-50" role="alert">
  <span class="font-medium">Para que o funcionário Rh seja adicionado, será necessário solicitar ao administrador do sistema!</span>
</div>
@can('rh', App\Models\User::class)
<div class="flex justify-center">
    <x-botao id="btn_modal_adicionar_usuario" label="Adicionar Funcionário" icon="fas fa-plus" cor="verde"></x-botao>
</div>
@endcan
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
                    CPF/CNPJ
                </th>
                <th scope="col" class="px-6 py-3">
                    Atribuição
                </th>                
                <th scope="col" class="px-6 py-3">
                    
                </th>
            </tr>
        </thead>
        <tbody id="funcionarios">

        </tbody>
    </table>
</div>
@include('funcionarios.modais.adicionar')
@include('funcionarios.modais.editar')
@vite('resources/js/funcionarios/index.js')
@endsection