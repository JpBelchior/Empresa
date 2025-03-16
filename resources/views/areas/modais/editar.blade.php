<x-modal id="modal_editar_area" label="Editar Área">
    <x-input id="editar_area_id" type="hidden"></x-input>
    <x-input id="editar_area_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_area_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_area" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/areas/editar.js')