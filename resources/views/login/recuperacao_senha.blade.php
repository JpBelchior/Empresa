@extends('login.estrutura')
@section('conteudo')
<div class="w-full bg-white rounded-lg shadow md:mt-0 sm:max-w-md xl:p-0">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <form class="space-y-4 md:space-y-6">
            <x-input id="token" type="hidden" value="{{ $token }}"></x-input>
            <x-input id="senha" label="Nova Senha" placeholder="••••••••" type="password"></x-input>
            <x-input id="confirma_senha" label="Confirma Nova Senha" placeholder="••••••••" type="password"></x-input>
            <div class="flex justify-between">
                <x-botao id="redefinir" label="Redefinir" cor="verde"></x-botao>                
            </div>            
        </form>
    </div>
</div>
@vite('resources/js/login/recuperar_senha.js')
@endsection