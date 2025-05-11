@extends('login.estrutura')
@section('conteudo')
<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div class="space-y-4 md:space-y-6">
            <div>
                <img src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <x-input id="email" label="Email"></x-input>            
            <div class="relative w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                <input type="password" id="senha" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-10">
                    <i id="eyeIcon" class="fas fa-eye"></i>                    
                </button>
            </div>
            <div class="flex justify-between">
                <x-botao id="entrar" label="Entrar" cor="verde"></x-botao>
                <x-botao id="btn_modal_recuperar_senha" label="Recuperar Senha"></x-botao>
            </div>            
        </div>
    </div>
</div>
<x-modal id="modal_recuperar_senha" label="Recuperar Senha">
    <x-input id="cpf_cnpj" label="Informe seu CPF/CNPJ" class="cpf_cnpj"></x-input>
    <x-botao id="btn_recuperar_senha" label="Confirmar solicitação"></x-botao>
</x-modal>
<script>
    function togglePassword() {
        const passwordInput = document.getElementById('senha');
        const eyeIcon = document.getElementById('eyeIcon');

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            eyeIcon.classList.add("text-gray-900");
        } else {
            passwordInput.type = "password";
            eyeIcon.classList.remove("text-gray-900");
        }
    }
</script>
@vite('resources/js/login/login.js')
@endsection