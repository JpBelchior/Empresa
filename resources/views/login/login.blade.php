@extends('login.estrutura')
@section('conteudo')
<div class="w-full bg-white rounded-lg shadow dark:border md:mt-0 sm:max-w-md xl:p-0 dark:bg-gray-800 dark:border-gray-700">
    <div class="p-6 space-y-4 md:space-y-6 sm:p-8">
        <div class="space-y-4 md:space-y-6">
            <div>
                <img id="logo" src="{{ asset('img/logo.png') }}" alt="">
            </div>
            <h1>Bem vindo ao Secure Scope!</h1>
            <h2>A plataforma mais ágil para inspeções e relatórios de segurança</h2>
            <x-input id="email" label="Email corporativo"></x-input>            
            <div class="relative w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                <input type="password" id="senha" class="bg-gray-50 border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-10">
                    <i id="eyeIcon" class="fas fa-eye"></i>                    
                </button>
            </div>
            <div class="flex justify-end">
                <a id="btn_modal_recuperar_senha" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Esqueceu a senha?</a>
            </div>
            <div class="">
                <x-botao id="entrar" label="Entrar" cor="azul" class="w-full"></x-botao>                
            </div>            
        </div>
    </div>
</div>
<x-modal id="modal_recuperar_senha" label="Recuperar Senha">
    <p>Informe seu CPF/CNPJ. Enviaremos um link de redefinição de senha para o email associado à sua conta.</p>
    <div class="flex justify-around">
        <x-input id="cpf_cnpj" label="" class="cpf_cnpj" placeholder="000.000.000-00"></x-input>
        <x-botao id="btn_recuperar_senha" label="Confirmar solicitação"></x-botao>
    </div>    
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
@vite('resources/css/login.css')
@endsection