<x-modal id="modal_adicionar_topico" label="Adicionar Tópico">
    <x-input id="adicionar_topico_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_topico" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/topicos/adicionar.js')