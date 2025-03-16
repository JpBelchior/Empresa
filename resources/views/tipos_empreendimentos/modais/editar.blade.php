<x-modal id="modal_editar_tipo_empreendimento" label="Editar Tipo de Empreendimento">
    <x-input id="editar_tipo_empreendimento_id" type="hidden"></x-input>
    <x-input id="editar_tipo_empreendimento_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_tipo_empreendimento_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_tipo_empreendimento" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tipos_empreendimentos/editar.js')