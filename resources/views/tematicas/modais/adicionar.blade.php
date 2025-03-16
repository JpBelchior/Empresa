<x-modal id="modal_adicionar_tematica" label="Adicionar Tópico">
    <x-input id="adicionar_tematica_nome" label="Nome" maxlength="255" obrigatorio="sim"></x-input>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_tematica" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/tematicas/adicionar.js')