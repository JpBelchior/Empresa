<x-modal id="modal_editar_projeto" label="Editar Projeto">
    <x-input id="editar_projeto_id" type="hidden"></x-input>
    <x-select id="editar_projeto_status" label="Status">
        <option value="Em andamento">Em andamento</option>
        <option value="Completo">Completo</option>
    </x-select>
    <x-input id="editar_projeto_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-input id="editar_projeto_data_inicio" label="Data de início" type="date" obrigatorio="sim"></x-input>
    <x-input id="editar_projeto_data_conclusao" label="Data de conclusão" type="date" obrigatorio="sim"></x-input>
    <x-select id="editar_projeto_cliente" placeholder="Nome do cliente" label="Cliente" obrigatorio="sim"></x-select>    
    <x-select id="editar_projeto_funcionario" multiple="sim" placeholder="Funcionários" label="Funcionários" obrigatorio="sim"></x-select>
    <div class="flex justify-center">
        <x-botao id="btn_editar_projeto" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/projetos/editar.js')