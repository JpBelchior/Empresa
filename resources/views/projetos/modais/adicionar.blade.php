<x-modal id="modal_adicionar_projeto" label="Adicionar Projeto">
    <x-input id="adicionar_projeto_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-input id="adicionar_projeto_data" label="Data do projeto" type="date" obrigatorio="sim"></x-input>
    <x-select id="adicionar_projeto_tipo_empreendimento" multiple="sim" placeholder="Tipos de empreendimento" label="Tipo de empreendimentos" obrigatorio="sim"></x-select>
    <x-select id="adicionar_projeto_funcionario" multiple="sim" placeholder="Funcionários" label="Funcionários" obrigatorio="sim"></x-select>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_projeto" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/projetos/adicionar.js')