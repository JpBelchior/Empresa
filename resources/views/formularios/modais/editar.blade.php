<x-modal id="modal_editar_formulario" label="Editar Usuário">
    <x-input id="editar_formulario_id" type="hidden"></x-input>
    <x-input id="editar_formulario_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>        
    <div class="flex justify-center">
        <x-botao id="btn_editar_formulario" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/formularios/editar.js')