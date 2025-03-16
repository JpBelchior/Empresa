<x-modal id="modal_adicionar_tipo_empreendimento" label="Adicionar Tipo de Empreendimento">
    <x-input id="adicionar_tipo_empreendimento_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_tipo_empreendimento" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tipos_empreendimentos/adicionar.js')