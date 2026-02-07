@extends('landing-estrutura')
@section('conteudo')
 <!-- NAVBAR -->
    <nav class="w-[calc(100%+48px)] -ml-6 -mr-6   bg-white relative ">

        <div class="max-w-7xl mx-auto flex items-center justify-between py-4 px-6">

            <!-- LOGO -->
            <div class="flex items-center">
                <img 
                    src="/imagesHomePage/PNG/Landing/SecureScopeLogo.png"
                    alt="Secure Scope"
                    class="h-10 w-auto"
                >
            </div>

            <!-- LINKS -->
            <div class="hidden lg:flex items-center gap-10 text-gray-700 font-medium">
                <a href="#segmentos" class="hover:text-sky-500 transition-colors">Segmentos</a>
                <a href="#plataforma" class="hover:text-sky-500 transition-colors">Plataforma</a>
                <a href="#institucional" class="hover:text-sky-500 transition-colors">Institucional</a>
            </div>

            <!-- BOTÕES -->
            <div class="hidden lg:flex items-center gap-4">
                <a href="#contato"
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
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>
        <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>

    </nav>

<!-- HERO SECTION -->
<section class="w-full min-h-screen bg-white px-6 py-8">

   
    <div class="max-w-7xl mx-auto">
        <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white rounded-xl shadow-xl p-6 mb-8">
                <div class="flex flex-col gap-4">
                    <a href="#segmentos" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Segmentos</a>
                    <a href="#plataforma" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Plataforma</a>
                    <a href="#institucional" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Institucional</a>
                    <a href="#contato" class="text-gray-700 hover:text-blue-600 font-medium py-2 border-b border-gray-100">Solicitar acesso</a>
                    <a href="{{ route('login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700 font-semibold text-center mt-2">
                        Acessar plataforma
                    </a>
                </div>
            </div>

            <!-- DIV AZUL -->
            <div class="bg-blue-100 rounded-3xl overflow-hidden relative px-6 py-12 md:px-12 md:py-16" style="min-height: 850px;">
                
                <!-- CONTEÚDO HERO -->
                <div class="text-center mb-12 relative z-30">
                    
                    <!-- Tag -->
                    <div class="inline-flex items-center gap-3 bg-white px-35 py-1 rounded-full shadow-md mb-8 border border-gray-200">
                        <span class="w-3 h-3 bg-green-500 rounded-full animate-pulse"></span>
                        <span class="text-base md:text-lg  text-black">Plataforma integrada de inspeções e riscos</span>
                    </div>

                    <!-- Título -->
                    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-gray-900 mb-6 leading-tight max-w-4xl mx-auto">
                        A ferramenta mais ágil para inspeções e relatórios de segurança.
                    </h1>
                    
                    <!-- Subtítulo -->
                    <p class="text-lg md:text-2xl text-gray-600 mb-10 max-w-3xl mx-auto">
                        Centralize inspeções, avalie riscos e gere relatórios profissionais 
                        com métricas claras e decisões orientadas por dados precisos.
                    </p>
                    
                    <!-- Botões -->
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-16">
                        <a href="#contato" class="bg-sky-500 text-white px-8 py-2 rounded-lg hover:bg-sky-600 font-semibold text-lg transition-all hover:shadow-lg inline-flex items-center justify-center gap-2">
                            Começar agora
                        </a>
                        <a href="#como-funciona" class="bg-white border-2 border-sky-400 text-sky-400 px-8 py-2 rounded-lg  hover:bg-blue-50  font-semibold text-lg transition-all inline-flex items-center justify-center gap-2">
                            Como funciona
                        </a>
                    </div>
                </div>

                <!-- IMAGEM DE FUNDO -->
                <div class="absolute inset-0 flex items-end justify-center z-0">
                    <img src="{{ asset('imagesHomePage/PNG/Landing/landing-pagecentralart1.png') }}" 
                        alt="Dashboard Central" 
                        class="max-w-full h-auto object-contain"
                        style="max-height: 85%;">
                </div>

                <!-- CARDS E LINHAS -->
                <div class="relative" style="min-height: 500px;"> 
                    <!-- Linha Top Left Card1 -->
                    <svg class="absolute pointer-events-none" style="top: -40px; left: 400px; width: 310px; height: 200px; z-index: 10;">
                        <line x1="600" y1="180" x2="20" y2="180" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Top Right Card2-->
                    <svg class="absolute pointer-events-none" style="top: -40px; right: 250px; width: 280px; height: 200px; z-index: 10;">
                        <line x1="80" y1="180" x2="260" y2="180" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Middle Left -->
                    <svg class="absolute pointer-events-none" style="top: 65%; left: 230px; width: 280px; height: 100px; z-index: 10; transform: translateY(-50%);">
                        <line x1="330" y1="50" x2="-50" y2="50" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Middle Left Vertical Baixo-->
                    <svg class="absolute pointer-events-none" style="top: 70%; left: -50px; width: 280px; height: 100px; z-index: 10; transform: translateY(-50%);">
                        <line x1="280" y1="90" x2="280" y2="20" stroke="#6b7280" stroke-width="4" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Middle Left Vertical Cima-->
                    <svg class="absolute pointer-events-none" style="top: 52%; left: 50px; width: 280px; height: 120px; z-index: 10; transform: translateY(-50%);">
                        <line x1="280" y1="290" x2="280" y2="-20" stroke="#6b7280" stroke-width="4" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Middle Right -->
                    <svg class="absolute pointer-events-none" style="top: 110%; right: 100px; width: 280px; height: 150px; z-index: 10; transform: translateY(-50%);">
                        <line x1="70" y1="50" x2="260" y2="50" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
                    <!-- Linha Middle Right Veritcal Card-->
                    <svg class="absolute pointer-events-none" style="top: 110%; right: 100px; width: 280px; height: 150px; z-index: 10; transform: translateY(-50%);">
                        <line x1="260" y1="50" x2="260" y2="-10" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                    </svg>
            <svg
            class="absolute pointer-events-none"
            style="top: 65%; left: 230px; width: 700px; height: 450px; z-index: 10; transform: translateY(-50%);"
            >
                <!-- horizontal -->
                <line x1="320" y1="224" x2="645" y2="224" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>
                <!-- vertical -->
                <line x1="645" y1="427" x2="645" y2="218" stroke="#6b7280" stroke-width="2" stroke-dasharray="8,6" opacity="0.8"/>

            </svg>
                <!-- Card Top Left: Vulnerabilidades e Riscos -->
                <div class="hidden lg:block absolute" style="top: 40px; left: 250px; z-index: 20;">
                    <img 
                        src="{{ asset('imagesHomePage/PNG/Landing/CardVulnerabRiscos.png') }}"
                        alt="Vulnerabilidades e Riscos"
                        class="rounded-2xl  
                            shadow-[0_10px_40px_rgba(0,191,255,0.18)]
                            hover:-translate-y-1
                            hover:shadow-[0_14px_55px_rgba(0,191,255,0.28)]
                            transition-all duration-300"
                        style="max-width: 170px;">
                </div>

                <!-- Card Top Right: Principais Riscos -->
                <div class="hidden lg:block absolute" style="top: 15px; right: 90px; z-index: 20;">
                    <img 
                        src="{{ asset('imagesHomePage/PNG/Landing/CardRiscos.png') }}"
                        alt="Principais Riscos"
                        class="rounded-2xl
                            shadow-[0_10px_40px_rgba(0,191,255,0.18)]
                            hover:-translate-y-1
                            hover:shadow-[0_14px_55px_rgba(0,191,255,0.28)]
                            transition-all duration-300"
                        style="max-width: 275px;">
                </div>

                <!-- Card Middle Left: Inspeção -->
                <div class="hidden lg:block absolute" style="top: 80%; left: 40px; transform: translateY(-50%); z-index: 20;">
                    <img 
                        src="{{ asset('imagesHomePage/PNG/Landing/CardInspeção.png') }}"
                        alt="Inspeção"
                        class="rounded-2xl
                            shadow-[0_10px_40px_rgba(0,191,255,0.18)]
                            hover:-translate-y-1
                            hover:shadow-[0_14px_55px_rgba(0,191,255,0.28)]
                            transition-all duration-300"
                        style="max-width: 300px; height: auto;">
                </div>

                <!-- Card Middle Right: Projetos -->
                <div class="hidden lg:block absolute" style="top: 85%; right: 20px; transform: translateY(-50%); z-index: 20;">
                    <img 
                        src="{{ asset('imagesHomePage/PNG/Landing/Card-Projetos24Ativos.png') }}"
                        alt="Projetos 24 Ativos"
                        class="rounded-2xl
                            shadow-[0_10px_40px_rgba(0,191,255,0.18)]
                            hover:-translate-y-1
                            hover:shadow-[0_14px_55px_rgba(0,191,255,0.28)]
                            transition-all duration-300"
                        style="max-width: 200px; height: auto;">
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
</section>



<!-- FORTALECENDO DECISÕES TÉCNICAS -->
<section class="relative flex justify-center py-8 bg-gray-200">
    <!-- FUNDO GRADIENTE (quase do tamanho do card) -->
    <div class="w-full max-w-[1280px] px-[6px] bg-white rounded-3xl">
        <!-- CONTEÚDO -->
        <div class="rounded-3xl px-10 py-16">
            <div class="flex flex-col lg:flex-row items-center justify-between gap-14">
                <h2 class="text-4xl md:text-5xl lg:text-5xl font-bold text-gray-900 max-w-xl leading-tight text-center lg:text-left">
                    Fortalecendo Decisões Técnicas em Ambientes Críticos
                </h2>
                <div class="flex flex-col items-center gap-10 text-gray-900 font-semibold">
                    <div class="flex items-center gap-14">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-user-shield text-sky-500 text-2xl w-8 h-8 flex items-center justify-center"></i>
                            <span class="text-2xl">Consultorias de Segurança</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <img 
                                src="/imagesHomePage/PNG/Landing/IconeIndústriaseInfraestrutura.png"
                                class="w-8 h-8 object-contain" >
                            <span class="text-2xl">Indústrias e Infraestrutura</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <i class="fas fa-anchor text-sky-500 text-2xl w-8 h-8 flex items-center justify-center"></i>
                        <span class="text-2xl">Portos e Logística</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
  
   
</section>

<!-- ESTRUTURE INSPEÇÕES -->
<section id="como-funciona" class="w-full bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-start">
           <div class="bg-white rounded-2xl shadow-xl p-4 w-fit mx-auto">
            <img 
                src="/imagesHomePage/PNG/Landing/ImagemEstrutureinspeções.png"
                alt="Preview de Inspeção"
                class="rounded-xl w-full max-h-[500px] object-contain mx-auto"
            >
        </div>
            <div>
                <h2 class="text-5xl font-bold text-gray-900 mb-10">
                    Estruture inspeções e análises com mais eficiência
                </h2>
                
                <p class="text-lg md:text-2xl text-gray-600 ">
                    Organize inspeções de forma padronizada, consolide avaliações 
                    técnicas e transforme dados de campo em informações claras 
                    para apoiar decisões com mais precisão e menos retrabalho.
                </p>
                <div class="border-t-2  border-gray-300 pt-10 mt-10">

                    <div class="grid md:grid-cols-2 gap-10 mt-10">

                        <!-- Inspeções -->
                        <div class="flex flex-col items-start">
                            <div class="bg-sky-400 w-16 h-16 rounded-xl flex items-center justify-center mb-4 shadow-md">
                                <img src="/imagesHomePage/PNG/Landing/IconeInspeções.png" class="w-8 h-8 object-contain">
                            </div>

                            <h4 class="text-lg md:text-2xl font-bold text-gray-900 mb-2">
                                Inspeções Padronizadas
                            </h4>

                            <p class="text-gray-600 max-w-xs text-sm md:text-xl">
                                Checklists estruturados garantem consistência técnica
                            </p>
                        </div>

                        <!-- Avaliação -->
                        <div class="flex flex-col items-start">
                            <div class="bg-sky-400 w-16 h-16 rounded-xl flex items-center justify-center mb-4 shadow-md">
                                <img src="/imagesHomePage/PNG/Landing/IconeAvaliaçãoObjetiva.png" class="w-8 h-8 object-contain">
                            </div>

                            <h4 class="text-lg md:text-2xl font-bold text-gray-900 mb-2">
                                Avaliação Objetiva
                            </h4>

                            <p class="text-gray-600 max-w-xs text-sm md:text-xl">
                                Critérios objetivos aumentam a confiabilidade da análise
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
</section>


<section class="w-full bg-gray-200 py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div>
                <h2 class="text-5xl font-bold text-gray-900 mb-6">
                    Relatórios técnicos orientados à tomada de decisão
                </h2>
                
                <p class="text-lg md:text-2xl text-gray-600 mb-8">
                    Relatórios gerados automaticamente consolidam 
                    vulnerabilidades, níveis de risco e prioridades, oferecendo uma 
                    visão clara para tomada de decisão e planejamento das ações.
                </p>
                <div class="w-full h-px bg-gray-200 mb-10"></div>
    
                <!-- MÉTRICAS -->
                <div class="grid grid-cols-2 gap-6">

                    <div class="bg-blue-100 rounded-xl p-6">
                        <p class="text-4xl font-bold text-sky-500 mb-2">–40%</p>
                        <p class="text-gray-700 font-medium md:text-xl">
                            Tempo gasto na consolidação das análises
                        </p>
                    </div>

                    <div class="bg-blue-100 rounded-xl p-6">
                        <p class="text-4xl font-bold text-sky-500 mb-2">+55%</p>
                        <p class="text-gray-700 font-medium md:text-xl">
                            Clareza na priorização dos riscos
                        </p>
                    </div>

                </div>
            </div>
            <div class="relative w-fit mx-auto">

                <!-- card base -->
                <div class="bg-white rounded-2xl shadow-xl p-4">
                    <img 
                        src="/imagesHomePage/PNG/Landing/ImagemRelatóriostécnicos.png"
                        alt="Preview de Relatório"
                        class="rounded-xl max-h-[500px] object-contain"
                    >
                </div>
                
                <img
                    src="/imagesHomePage/PNG/Landing/CardstatsInfo.png"
                    class="absolute bottom-6 right-6 w-64 drop-shadow-xl">
                
            </div>
        </div>
    </div>
    <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
</section>



<!-- RECURSOS DA PLATAFORMA -->
<section id="plataforma" class="w-full bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Principais Recursos da Plataforma
            </h2>
            <p class="text-lg  md:text-2xl text-gray-600 max-w-4xl mx-auto">
                Recursos desenvolvidos para organizar inspeções, estruturar análises de risco e apoiar decisões 
                técnicas, reunindo método, clareza operacional e controle em um único ambiente.
            </p>
        </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

        <!-- RECURSO 1 -->
        <div class="bg-gray-50 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all lg:col-span-2">

            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                Análise de Risco Estruturada
            </h3>

            <p class="text-gray-600 mb-6 font-medium md:text-xl">
                Transforme observações de campo em indicadores claros, permitindo 
                classificar, priorizar e justificar tecnicamente cada risco identificado.
            </p>
            <!-- NOVA IMAGEM -->
            <img
                src="/imagesHomePage/PNG/Landing/GraficoAnalisedeRiscoEstruturada.png"
                class="w-full max-h-[300px] object-contain mx-auto"
            >
        </div>


        <!-- RECURSO 2 -->
        <div class="bg-blue-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all">

            <h3 class="text-2xl font-bold  text-gray-900 mb-3">
                Status da Inspeção
            </h3>

            <p class="text-gray-600 mb-7 font-medium md:text-xl">
                Visualize o andamento das inspeções em cada etapa do processo.
            </p>

            <div class="space-y-3 text-sm">
                <div class="bg-white border border-green-200 rounded-lg p-3 flex items-start g-3">
                <img 
                src="/imagesHomePage/PNG/Landing/IconeInspeçãoConcluída.png"
                class="w-5 h-5 mt-1 mr-2 object-contain">
                <div class="col-end-2">
                   <p class="font-semibold text-gray-900 text-lg">Inspeção Concluída <span class="text-gray-600 text-sm font-medium">-50% Riscos</span></p>
                    <p class="text-gray-600">Finalizada em 30 Dez • <span class="text-green-600">Concluída</span></p>
                    </div>
                </div>
                <div class="bg-white border border-yellow-200 rounded-lg p-3 flex items-start gap-3">
                <img 
                src="/imagesHomePage/PNG/Landing/IconeInspeçãoemAnálise.png"
                class="w-5 h-5 mt-1 object-contain">
                <div class="col-end-2">
                    <p class="font-semibold text-gray-900 text-lg">Inspeção em Análise <span class="text-gray-600 text-sm font-medium">5 Vulnerab.</span></p>
                    <p class="text-gray-600">Atualizado em 14 Abr • <span class="text-yellow-600">Em Andamento</span></p>
                </div>
                </div>
            </div>
        </div>

        <!-- RECURSO 3 -->
        <div class="bg-blue-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all">

            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                Gestão de equipe
            </h3>

            <p class="text-gray-600 mb-7 font-medium md:text-xl">
                Defina responsáveis e acompanhe atividades com clareza operacional.
            </p>

            <div class="space-y-4 text-sm">
                <div class="flex items-center justify-between gap-3 p-3 bg-white rounded-lg">
                    <div class="flex">
                        <div class="bg-sky-400 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">AN</div>
                        <div class="ml-2">
                            <p class="font-semibold text-gray-900 text-base">Ana Ribeiro</p>
                            <p class="text-gray-500">Analista</p>
                        </div>
                    </div>
                        <div class="flex">
                           <img 
                                src="/imagesHomePage/PNG/Landing/IconeOlho.png"
                                class="w-10 h-5 object-contain mt"
                            >  
                             <img 
                                    src="/imagesHomePage/PNG/Landing/IconeEditar.png"
                                    class="w-10 h-5 object-contain mt-1"
                            > 
                        </div>
                </div>

                <div class="flex items-center justify-between gap-3 p-3 bg-white rounded-lg">
                    <div class="flex">
                        <div class="bg-sky-400 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">CM</div>
                        <div class="ml-2">
                            <p class="font-semibold text-gray-900 text-base">Carlos Menezes</p>
                            <p class="text-gray-500">Consultor</p>
                        </div>
                    </div>
                        <div class="flex">
                           <img 
                                src="/imagesHomePage/PNG/Landing/IconeOlho.png"
                                class="w-10 h-5 object-contain mt"
                            >  
                             <img 
                                    src="/imagesHomePage/PNG/Landing/IconeEditar.png"
                                    class="w-10 h-5 object-contain mt-1"
                            > 
                        </div>
                </div>

                <div class="flex items-center justify-between gap-3 p-3 bg-white rounded-lg">
                    <div class="flex">
                        <div class="bg-sky-400 w-10 h-10 rounded-full flex items-center justify-center text-white font-bold">MF</div>
                        <div class="ml-2">
                            <p class="font-semibold text-gray-900 text-base">Mariana Fontes</p>
                            <p class="text-gray-500">Coordenadora </p>
                        </div>
                    </div>
                        <div class="flex">
                           <img 
                                src="/imagesHomePage/PNG/Landing/IconeOlho.png"
                                class="w-10 h-5 object-contain mt"
                            >  
                             <img 
                                    src="/imagesHomePage/PNG/Landing/IconeEditar.png"
                                    class="w-10 h-5 object-contain mt-1"
                            > 
                        </div>
                    </div>
                </div>
        </div>

        <!-- RECURSO 4 -->
        <div class="bg-blue-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all">
            <h3 class="text-2xl font-bold text-gray-900 mb-3">
                Vulnerabilidades Mapeadas
            </h3>
            <p class="text-gray-600 mb-4 font-medium md:text-xl">
            Registre e classifique vulnerabilidades identificadas durante inspeções.
            </p>
            <div class="space-y-3 text-sm">
                <div class="border border-gray-200 rounded-lg p-3 bg-white">
                    <div class="flex justify-between items-start mb-2">
                        <p class="font-semibold text-gray-600">Tópico</p>
                        <p class="font-semibold text-gray-600">Risco</p>
                        <p class="font-semibold text-gray-600">Prioridade</p>
                      
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <p class="font-semibold text-base text-gray-900">CFTV</p>
                        <p class="font-semibold text-base text-gray-900 ml-2 ">Alto</p>
                        <p class="font-semibold text-base text-gray-900">Curto Prazo</p>
                      
                    </div>
                      <div class="flex justify-between items-start mb-2">
                        <p class=" text-gray-600">ID: 23012026</p>
                      <img 
                        src="/imagesHomePage/PNG/Landing/LinhaCurtoPrazo.png"
                        class="w-15 h-5 object-contain mt-1"
                    >
                    </div>
                       
                </div>
                <div class="border border-gray-200 rounded-lg p-3 bg-white">
                    <div class="flex justify-between items-start mb-2">
                        <p class="font-semibold text-gray-600">Tópico</p>
                        <p class="font-semibold text-gray-600">Risco</p>
                        <p class="font-semibold text-gray-600">Prioridade</p>
                      
                    </div>
                    <div class="flex justify-between items-start mb-2">
                        <p class="font-semibold text-base text-gray-900">Treinamento</p>
                        <p class="font-semibold text-base text-gray-900 mr-3 ">Médio</p>
                        <p class="font-semibold text-base text-gray-900">Médio Prazo</p>
                      
                    </div>
                      <div class="flex justify-between items-start mb-2">
                        <p class=" text-gray-600">ID: 02022026</p>
                      <img 
                        src="/imagesHomePage/PNG/Landing/LinhaMedioPrazo.png"
                        class="w-15 h-5 object-contain mt-1"
                    >
                    </div>
                       
                </div>
            </div>
        </div>


        <!-- RECURSO 5 -->
            <div class="bg-blue-100 rounded-2xl p-8 shadow-lg hover:shadow-xl transition-all">
                <h3 class="text-2xl font-bold text-gray-900 mb-3">
                Perfis de acesso
                </h3>
                <p class="text-gray-600 mb-4 font-medium md:text-xl">
                Defina funções e organize o acesso de cada colaborador aos projetos.
                </p>
                <div class="border border-gray-200 bg-white rounded-lg px-5 py-7 mt-5">
                    <h1 class="text-xl font-semibold mb-5"> Usuários e Permissões</h1>
                    <div class="flex items-center gap-3 mb-3">
                        <div class="bg-sky-400 w-12 h-12 rounded-full flex items-center justify-center text-white font-bold">MA</div>
                            <p class=" text-gray-900">Mariana Andrade</p>
                    </div>
                    <p class="text-gray-700     mb-5">Função: Consultor</p>
                    <p class="text-gray-700 text-sm bg-gray-50 rounded px-3 py-2 flex">
                       <img 
                        src="/imagesHomePage/PNG/Landing/IconeCardPerfisdeAcesso.png"
                        class="w-15 h-5 object-contain"
                    >
                        Coordenação de Projetos
                    </p>
                </div>
            </div>
        </div>  
    </div>
     <div class="absolute bottom-0 left-0 w-full h-[2px] bg-gradient-to-r from-sky-400 via-sky-500 to-sky-400"></div>
</section>

<!-- PRINCÍPIOS -->
<section id="institucional" class="w-full bg-white py-20">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900 mb-6">
                Princípios que Orientam a Plataforma
            </h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <!-- Princípio 1 -->
            <div class="bg-gradient-to-br from-blue-600 to-blue-700 text-white rounded-2xl p-8 hover:shadow-2xl transition-all">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-wider mb-2 opacity-90">Princípio</p>
                    <h3 class="text-2xl font-bold mb-4">
                        Decisão técnica como base para escolhas seguras em ambientes críticos
                    </h3>
                </div>
                <div class="border-t border-white/20 pt-4">
                    <p class="text-sm font-semibold uppercase tracking-wider opacity-90">Resultado</p>
                    <p class="text-xl font-bold mt-2">Impacta decisões</p>
                </div>
            </div>

            <!-- Princípio 2 -->
            <div class="bg-gradient-to-br from-gray-700 to-gray-800 text-white rounded-2xl p-8 hover:shadow-2xl transition-all">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-wider mb-2 opacity-90">Método</p>
                    <h3 class="text-2xl font-bold mb-4">
                        Estruturas analíticas reduzem vieses e elevam a confiabilidade técnica
                    </h3>
                </div>
                <div class="border-t border-white/20 pt-4">
                    <p class="text-sm font-semibold uppercase tracking-wider opacity-90">Resultado</p>
                    <p class="text-xl font-bold mt-2">Reduz incertezas</p>
                </div>
            </div>

            <!-- Princípio 3 -->
            <div class="bg-gradient-to-br from-cyan-600 to-cyan-700 text-white rounded-2xl p-8 hover:shadow-2xl transition-all">
                <div class="mb-6">
                    <p class="text-sm font-semibold uppercase tracking-wider mb-2 opacity-90">Clareza</p>
                    <h3 class="text-2xl font-bold mb-4">
                        Informações organizadas convertem dados técnicos em prioridades claras
                    </h3>
                </div>
                <div class="border-t border-white/20 pt-4">
                    <p class="text-sm font-semibold uppercase tracking-wider opacity-90">Resultado</p>
                    <p class="text-xl font-bold mt-2">Orienta prioridades</p>
                </div>
            </div>
        </div>

        <!-- Descrição final -->
        <div class="text-center mt-16">
            <p class="text-xl text-gray-700 max-w-3xl mx-auto">
                Plataforma desenvolvida para apoiar decisões técnicas com 
                método, rastreabilidade e consistência analítica.
            </p>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer id="contato" class="w-full bg-gray-900 text-white py-16">
    <div class="max-w-7xl mx-auto px-6">
        <div class="grid md:grid-cols-4 gap-12 mb-12">
            <!-- Coluna 1 - Logo e Contato -->
            <div>
                <div class="flex items-center gap-3 mb-6">
                    <div class="bg-blue-600 w-10 h-10 rounded-lg flex items-center justify-center">
                        <i class="fas fa-shield-alt text-white text-xl"></i>
                    </div>
                    <span class="text-xl font-bold">Secure Scope</span>
                </div>
                <div class="space-y-4">
                    <div>
                        <p class="text-gray-400 text-sm mb-2">Fale conosco</p>
                        <a href="mailto:contato@securescope.com.br" class="text-white hover:text-blue-400 transition-colors">
                            contato@securescope.com.br
                        </a>
                    </div>
                </div>
            </div>

            <!-- Coluna 2 - Segmentos -->
            <div>
                <h4 class="text-lg font-bold mb-6">Segmentos</h4>
                <ul class="space-y-3">
                    <li><a href="#segmentos" class="text-gray-400 hover:text-white transition-colors">Consultorias de Segurança</a></li>
                    <li><a href="#segmentos" class="text-gray-400 hover:text-white transition-colors">Indústrias e Infraestrutura</a></li>
                    <li><a href="#segmentos" class="text-gray-400 hover:text-white transition-colors">Portos, Logística</a></li>
                </ul>
            </div>

            <!-- Coluna 3 - Plataforma -->
            <div>
                <h4 class="text-lg font-bold mb-6">Plataforma</h4>
                <ul class="space-y-3">
                    <li><a href="#como-funciona" class="text-gray-400 hover:text-white transition-colors">Como Funciona</a></li>
                    <li><a href="#plataforma" class="text-gray-400 hover:text-white transition-colors">Metodologia de Análise</a></li>
                    <li><a href="#plataforma" class="text-gray-400 hover:text-white transition-colors">Recursos da Plataforma</a></li>
                </ul>
            </div>

            <!-- Coluna 4 - Institucional -->
            <div>
                <h4 class="text-lg font-bold mb-6">Institucional</h4>
                <ul class="space-y-3">
                    <li><a href="#institucional" class="text-gray-400 hover:text-white transition-colors">Sobre a Plataforma</a></li>
                    <li><a href="#institucional" class="text-gray-400 hover:text-white transition-colors">Diferenciais e Princípios</a></li>
                    <li><a href="#" class="text-gray-400 hover:text-white transition-colors">Segurança da informação</a></li>
                </ul>
            </div>
        </div>

        <!-- Copyright -->
        <div class="border-t border-gray-800 pt-8 text-center">
            <p class="text-gray-400">
                © 2026 Secure Scope. Todos os direitos reservados.
            </p>
        </div>
    </div>
</footer>

{{-- JavaScript modular via Vite --}}
@vite('resources/js/landing/landing.js')

@endsection