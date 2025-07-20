@extends('login.estrutura')

@section('conteudo')
<div class="flex items-center justify-center min-h-screen bg-gray-100 px-4">
    <div class="flex flex-col md:flex-row bg-white rounded-lg shadow-lg overflow-hidden max-w-4xl w-full">        

        {{-- 📝 Formulário ao lado direito --}}
        <div class="md:w-1/2 w-full p-6 space-y-6">
            <div>
                <img id="logo" src="{{ asset('img/logo.png') }}" alt="Logo" class="w-32 mx-auto md:mx-0 mb-4">
            </div>
            <h1 class="text-xl font-bold text-gray-900 text-center md:text-left">Bem-vindo ao Secure Scope!</h1>
            <h2 class="text-sm text-gray-600 text-center md:text-left">A plataforma mais ágil para inspeções e relatórios de segurança</h2>

            <x-input id="email" label="Email corporativo"></x-input>

            <div class="relative w-full">
                <label class="block mb-2 text-sm font-medium text-gray-900">Senha</label>
                <input type="password" id="senha" class="border border-gray-300 text-gray-900 rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5" placeholder="••••••••">
                <button type="button" onclick="togglePassword()" class="absolute right-3 top-10">
                    <i id="eyeIcon" class="fas fa-eye"></i>
                </button>
            </div>

            <div class="flex justify-end">
                <a id="btn_modal_recuperar_senha" class="font-medium text-blue-600 hover:underline">Esqueceu a senha?</a>
            </div>

            <x-botao id="entrar" label="Entrar" cor="azul" class="w-full"></x-botao>
        </div>

        {{-- 🖼️ Imagem ao lado esquerdo (visível somente em md+) --}}
        <div class="md:w-1/2 w-full md:block hidden">
            <img src="{{ asset('img/colaboracao.png') }}" alt="Ilustração" class="h-full w-full object-cover">
        </div>
    </div>
</div>

<x-modal id="modal_recuperar_senha" label="Recuperar Senha">
    <p>Informe seu CPF/CNPJ. Enviaremos um link de redefinição de senha para o email associado à sua conta.</p>
    <div class="flex justify-around mt-4">
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
