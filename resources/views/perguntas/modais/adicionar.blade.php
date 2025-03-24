<x-modal id="modal_adicionar_pergunta" label="Adicionar Pergunta">
    <x-input id="adicionar_pergunta_titulo" label="Título" maxlength="1000" obrigatorio="sim"></x-input>
    <x-select id="adicionar_pergunta_tematica" label="Temática" obrigatorio="sim"></x-select>
    <x-select id="adicionar_pergunta_tipo_empreendimento" multiple="sim" placeholder="Tipos de empreendimento" label="Tipo de empreendimentos" obrigatorio="sim"></x-select>
    <x-select id="adicionar_pergunta_topico" multiple="sim" placeholder="Tópicos..." label="Tópicos" obrigatorio="sim"></x-select>
    <x-select id="adicionar_pergunta_area" multiple="sim" placeholder="Áreas" label="Áreas" obrigatorio="sim"></x-select>
    <x-select id="adicionar_pergunta_tag" multiple="sim" placeholder="Tags..." label="Tags" obrigatorio="sim"></x-select>
    <x-botao id="btn_adicionar_foto" label="Adicionar foto" icon="fas fa-plus" cor="verde"></x-botao>
    <div id="adicionar_pergunta_fotos"></div>
    <div class="flex justify-center">
        <x-botao id="btn_adicionar_pergunta" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/perguntas/adicionar.js')