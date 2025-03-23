<x-modal id="modal_editar_pergunta" label="Editar Pergunta">
    <x-input id="editar_pergunta_id" type="hidden"></x-input>
    <x-input id="editar_pergunta_titulo" label="Título" maxlength="1000" obrigatorio="sim"></x-input>    
    <x-select id="editar_pergunta_tematica" label="Temática" obrigatorio="sim"></x-select>
    <x-select id="editar_pergunta_tipo_empreendimento" multiple label="Tipos de empreendimento" obrigatorio="sim"></x-select>
    <x-select id="editar_pergunta_topico" multiple label="Tópicos" obrigatorio="sim"></x-select>
    <x-select id="editar_pergunta_area" multiple label="Áreas" obrigatorio="sim"></x-select>
    <x-select id="editar_pergunta_tag" multiple label="Tags" obrigatorio="sim"></x-select>
    <x-checkbox id="editar_pergunta_ativo" label="Ativo"></x-checkbox>
    <div class="flex justify-center">
        <x-botao id="btn_editar_pergunta" label="Confirmar"></x-botao>
    </div>
</x-modal>
@vite('resources/js/perguntas/editar.js')