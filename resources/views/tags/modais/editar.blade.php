<x-modal id="modal_editar_tag" label="Editar Área">
    <x-input id="editar_tag_id" type="hidden"></x-input>
    <x-input id="editar_tag_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_tag_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_tag" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tags/editar.js')