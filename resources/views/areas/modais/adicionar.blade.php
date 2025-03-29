<x-modal id="modal_adicionar_area" label="Adicionar Área">
    <x-input id="adicionar_area_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_area" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/areas/adicionar.js')