<x-modal id="modal_adicionar_formulario" label="Adicionar Formulário">
    <x-input id="adicionar_formulario_nome" label="Título do formulário" maxlength="255" obrigatorio="sim"></x-input>        
    <x-select id="adicionar_formulario_projeto" label="Projeto" obrigatorio="sim"></x-select>
    <x-select id="adicionar_formulario_tipo_empreendimento" label="Tipo de empreendimento" obrigatorio="sim"></x-select>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_formulario" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/formularios/adicionar.js')