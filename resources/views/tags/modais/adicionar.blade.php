<x-modal id="modal_adicionar_tag" label="Adicionar Tópico">
    <x-input id="adicionar_tag_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_tag" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tags/adicionar.js')