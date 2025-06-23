<x-modal id="modal_editar_cliente" label="Editar Cliente">
    <x-input id="editar_cliente_id" type="hidden"></x-input>
    <x-input id="editar_cliente_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_cliente_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_cliente" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/clientes/editar.js')