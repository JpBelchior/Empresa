<x-modal id="modal_editar_projeto" label="Editar Projeto">
    <x-input id="editar_projeto_id" type="hidden"></x-input>
    <x-input id="editar_projeto_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-input id="editar_projeto_data" label="Data do projeto" type="date" obrigatorio="sim"></x-input>
    <x-select id="editar_projeto_tipo_empreendimento" multiple="sim" placeholder="Tipos de empreendimento" label="Tipo de empreendimentos" obrigatorio="sim"></x-select>
    <x-select id="editar_projeto_funcionario" multiple="sim" placeholder="Funcionários" label="Funcionários" obrigatorio="sim"></x-select>
    <div class="flex justify-center">
        <x-botao id="btn_editar_projeto" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/projetos/editar.js')