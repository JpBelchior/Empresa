<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full border-r border-gray-200 sm:translate-x-0 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto">
        <ul class="space-y-2 font-medium">
            <x-opcao_sidebar link="/" label="Dashboard" icon="fas fa-chart-line"></x-opcao_sidebar>                   
            @cannot('agente', App\Models\User::class)
            <x-opcao_sidebar link="/funcionarios" label="Funcionários" icon="fas fa-users"></x-opcao_sidebar>
            <x-opcao_sidebar link="/clientes" label="Clientes" icon="fas fa-address-book"></x-opcao_sidebar>
            @endcannot
            <x-opcao_sidebar link="/projetos" label="Projetos" icon="fa fa-map-pin"></x-opcao_sidebar>
            <x-opcao_sidebar link="/formularios" label="Formulários" icon="fas fa-edit"></x-opcao_sidebar>
            @can('administrador', App\Models\User::class)            
            <x-opcao_sidebar link="/perguntas" label="Perguntas" icon="fas fa-question"></x-opcao_sidebar>
            <x-opcao_sidebar link="/usuarios" label="Usuários" icon="fas fa-user"></x-opcao_sidebar>
            <x-opcao_sidebar link="/auditoria" label="Auditoria" icon="fas fa-check-circle"></x-opcao_sidebar>            
            <x-opcao_sidebar link="/empresas" label="Empresas" icon="fas fa-building"></x-opcao_sidebar>            
            <x-opcao_sidebar link="/tipos_empreendimentos" label="Tipos de empreendimentos" icon="fas fa-border-all"></x-opcao_sidebar>
            <x-opcao_sidebar link="/topicos" label="Tópicos" icon="fas fa-book"></x-opcao_sidebar>
            <x-opcao_sidebar link="/areas" label="Áreas" icon="fas fa-border-style"></x-opcao_sidebar>
            <x-opcao_sidebar link="/tematicas" label="Pilares" icon="fas fa-braille"></x-opcao_sidebar>
            <x-opcao_sidebar link="/tags" label="Tags" icon="fas fa-bookmark"></x-opcao_sidebar>
            @endcan
        </ul>
    </div>
</aside>