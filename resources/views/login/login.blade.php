@extends('login.estrutura')
@section('conteudo')
<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <form class="space-y-4 md:space-y-6">
            <x-input id="email" label="Email"></x-input>
            <x-input id="senha" label="Senha" placeholder="••••••••" type="password"></x-input>
            <div class="flex justify-between">
                <x-botao id="entrar" label="Entrar" cor="verde"></x-botao>
                <x-botao id="btn_modal_recuperar_senha" label="Recuperar Senha"></x-botao>
            </div>            
        </form>
    </div>
</div>
<x-modal id="modal_recuperar_senha" label="Recuperar Senha">
    <x-input id="cpf_cnpj" label="Informe seu CPF/CNPJ" class="cpf_cnpj"></x-input>
    <x-botao id="btn_recuperar_senha" label="Confirmar solicitação"></x-botao>
</x-modal>
@vite('resources/js/login/login.js')
@endsection