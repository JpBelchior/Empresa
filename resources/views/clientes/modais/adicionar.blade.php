<x-modal id="modal_adicionar_cliente" label="Adicionar Cliente">
    <x-input id="adicionar_cliente_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_cliente" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/clientes/adicionar.js')