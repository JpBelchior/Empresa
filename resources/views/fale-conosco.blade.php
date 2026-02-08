@extends('landing-estrutura')
@section('conteudo')

<!-- NAVBAR -->
<nav class="bg-white relative">
    <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6">
        
        <!-- LOGO -->
        <div class="flex items-center">
            <a href="{{ route('home') }}">
                <img 
                    src="/imagesHomePage/PNG/Landing/SecureScopeLogo.png"
                    alt="Secure Scope"
                    class="h-10 w-auto"
                >
            </a>
        </div>

        <!-- LINKS -->
        <div class="hidden lg:flex items-center gap-10 text-gray-700 font-medium">
            <a href="{{ route('home') }}#segmentos" class="hover:text-sky-500 transition-colors">Segmentos</a>
            <a href="{{ route('home') }}#como-funciona" class="hover:text-sky-500 transition-colors">Plataforma</a> 
            <a href="{{ route('home') }}#institucional" class="hover:text-sky-500 transition-colors">Institucional</a>
        </div>

        <!-- BOTÕES -->
        <div class="hidden lg:flex items-center gap-4">
            <a href="{{ route('fale-conosco') }}"
            class="px-5 py-2 rounded-full bg-sky-500 text-white font-semibold hover:bg-sky-600 transition shadow">
                Solicitar acesso
            </a>
            
            <a href="{{ route('login') }}"
            class="px-5 py-2 rounded-full border border-sky-500 text-sky-500 font-semibold hover:bg-blue-50 transition">
                Acessar plataforma
            </a>
        </div>

        <!-- MOBILE -->
        <button id="mobile-menu-btn" class="lg:hidden text-gray-700">
             <img 
                src="/imagesHomePage/PNG/Landing/IconeEditar.png"
                class="w-8 h-8 object-contain">
        </button>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
</nav>

<!-- MOBILE MENU -->
<div id="mobile-menu" class="hidden lg:hidden bg-white rounded-xl shadow-xl p-6 mx-6 mt-4">
    <div class="flex flex-col gap-4">
        <a href="{{ route('home') }}#segmentos" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Segmentos</a>
        <a href="{{ route('home') }}#como-funciona" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Plataforma</a>
        <a href="{{ route('home') }}#institucional" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Institucional</a>
        <a href="{{ route('fale-conosco') }}" class="bg-sky-500 text-white px-6 py-3 rounded-lg hover:bg-sky-600 text-center font-semibold">
            Solicitar acesso
        </a>
        <a href="{{ route('login') }}" class="border-2 border-sky-500 text-sky-500 px-6 py-3 rounded-lg hover:bg-blue-50 text-center font-semibold">
            Acessar plataforma
        </a>
    </div>
</div>

<!-- HERO SECTION COM FORMULÁRIO -->
<section class="w-full min-h-screen bg-white py-16 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 items-start">
            
            <!-- LADO ESQUERDO - CONTEÚDO -->
            <div class="order-1 lg:order-1 ">
                <h1 class="text-5xl lg:text-7xl  font-semibold text-gray-900 mb-6 leading-tight">
                    Transforme Inspeções<br>
                    em Decisões Técnicas<br>
                    Confiáveis
                </h1>

                <div class="space-y-4 mb-8">
                    <div class="flex items-start gap-3">
                             <img 
                                src="/imagesHomePage/PNG/Fale-Conosco/IconeChecklistSecureScope.png"
                                class="w-7 h-7 object-contain ">
                        <p class="text-2xl text-gray-500">Checklists estruturados e padronizados</p>
                    </div>

                    <div class="flex items-start gap-3">
                             <img 
                                    src="/imagesHomePage/PNG/Fale-Conosco/IconeChecklistSecureScope.png"
                                    class="w-7 h-7 object-contain ">
                        <p class="text-2xl text-gray-500 ">Classificação objetiva de riscos</p>
                    </div>

                    <div class="flex items-start gap-3">
                             <img 
                                src="/imagesHomePage/PNG/Fale-Conosco/IconeChecklistSecureScope.png"
                                class="w-7 h-7 object-contain ">
                        <p class="text-2xl text-gray-500">Relatórios prontos para tomada de decisão</p>
                    </div>
                </div>

                <!-- CARDS DE INFORMAÇÃO -->
               <div class="mt-15 flex justify-center  w-full lg:w-[800px] mx-auto">
                    <img src="/imagesHomePage/PNG/Fale-Conosco/ArteContato.png" 
                        alt="Arte Contato" 
                        class="w-full rounded">
                </div>
            </div>

            <!-- LADO DIREITO - FORMULÁRIO -->
            <div class="order-2 lg:order-2 flex justify-end  lg:mt-25">
                <div class="bg-white rounded-2xl shadow-2xl p-8 lg:p-8 w-96 ">
                    <div class="text-center">
                    <h2 class="text-3xl font-bold text-sky-400 mb-3">Fale Conosco</h2>
                    </div>
                    <p class="text-gray-600 mb-8 text-lg">Preencha os dados abaixo e nossa equipe entrará em contato.</p>

                    <form id="form-contato" class="space-y-4">
                        @csrf
                        
                        <!-- NOME -->
                        <div>
                            <label for="nome" class="block   mb-2">Nome</label>
                            <input 
                                type="text" 
                                id="nome" 
                                name="nome"
                                placeholder="Nome Completo"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition"
                                required
                            >
                        </div>

                        <!-- EMPRESA -->
                        <div>
                            <label for="empresa" class="block mb-2">Empresa</label>
                            <input 
                                type="text" 
                                id="empresa" 
                                name="empresa"
                                placeholder="Empresa ou Organização"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition"
                                required
                            >
                        </div>

                        <!-- EMAIL -->
                        <div>
                            <label for="email" class="block  mb-2">Email Corporativo</label>
                            <input 
                                type="email" 
                                id="email" 
                                name="email"
                                placeholder="nome@empresa.com"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition"
                                required
                            >
                        </div>

                        <!-- TELEFONE -->
                        <div>
                            <label for="telefone" class="block mb-2">Telefone</label>
                            <input 
                                type="tel" 
                                id="telefone" 
                                name="telefone"
                                placeholder="+55 021 555555 555"
                                class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-sky-500 focus:border-sky-500 outline-none transition"
                                required
                            >
                        </div>

                        <!-- BOTÃO -->
                         <div class="items-center justify-center flex ">
                        <button 
                            type="submit"
                            class=" bg-sky-500 text-white w-50  py-2 rounded-lg hover:bg-sky-600 transition-all shadow-lg hover:shadow-xl uppercase tracking-wide"
                        >
                            Solicitar acesso
                        </button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer id="contato" class="w-full bg-slate-900 text-white py-10">
    <div class="w-full px-12">
        <!-- Grid Principal -->
        <div class="grid grid-cols-1 md:grid-cols-6 gap-6 mb-5">
            
            <!-- Coluna 1 - Logo e Descrição -->
            <div class="md:col-span-2 pt-1">
                <img 
                    src="/imagesHomePage/PNG/Landing/SecureScopeLogoBranca.png"
                    alt="Secure Scope"
                    class="h-10 w-auto mb-4"
                >
                <p class="text-white text-xl">
                    Plataforma desenvolvida para apoiar decisões técnicas com 
                    método, rastreabilidade e consistência analítica.
                </p>
                
                <!-- Linha abaixo da descrição -->
                <div class="border-t border-white mt-4"></div>
            </div>

            <!-- Coluna 2 - Fale Conosco -->
            <div class="pt-6">
                <h4 class="text-2xl font-bold mb-3 text-white">Fale conosco</h4>
                <p class="text-white">contato@securescope.com.br</p>
            </div>

            <!-- Coluna 3 - Segmentos -->
            <div class="pt-6">
                <h4 class="text-2xl font-bold mb-3 text-white">Segmentos</h4>
                <ul class="space-y-2">
                    <li><p class="text-white">Consultorias de Segurança</p></li>
                    <li><p class="text-white">Indústrias e Infraestrutura</p></li>
                    <li><p class="text-white">Portos, Logística</p></li>
                </ul>
            </div>

            <!-- Coluna 4 - Plataforma -->
            <div class="pt-6">
                <h4 class="text-2xl font-bold mb-3 text-white">Plataforma</h4>
                <ul class="space-y-2">
                    <li><p class="text-white">Como Funciona</p></li>
                    <li><p class="text-white">Metodologia de Análise</p></li>
                    <li><p class="text-white">Recursos da Plataforma</p></li>
                </ul>
            </div>

            <!-- Coluna 5 - Institucional -->
            <div class="pt-6">
                <h4 class="text-2xl font-bold mb-3 text-white">Institucional</h4>
                <ul class="space-y-2">
                    <li><p class="text-white">Sobre a Plataforma</p></li>
                    <li><p class="text-white">Diferenciais e Princípios</p></li>
                    <li><p class="text-white">Segurança da informação</p></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="text-left">
            <p class="text-gray-300">
                © 2026 Secure Scope. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>

@vite('resources/js/landing/landing.js')



@endsection