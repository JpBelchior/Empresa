<x-modal id="modal_editar_topico" label="Editar Tópicos">
    <x-input id="editar_topico_id" type="hidden"></x-input>
    <x-input id="editar_topico_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>    
    <x-checkbox id="editar_topico_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_topico" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/topicos/editar.js')