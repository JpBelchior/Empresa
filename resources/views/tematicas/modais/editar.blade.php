<x-modal id="modal_editar_tematica" label="Editar Pilar">
    <x-input id="editar_tematica_id" type="hidden"></x-input>
    <x-input id="editar_tematica_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_tematica_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_tematica" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tematicas/editar.js')