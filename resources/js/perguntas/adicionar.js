import { iniciar_select, abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, mostrar_informacoes_modal, sucesso } from "../app";
import { lista_perguntas } from "./funcoes";
import { pesquisar_tematica } from "../tematicas/funcoes";
import { pesquisar_tipos_empreendimentos } from "../tipos_empreendimentos/funcoes";
import { pesquisar_topicos } from "../topicos/funcoes";
import { pesquisar_areas } from "../areas/funcoes";
import { pesquisar_tags } from "../tags/funcoes";

var numero_foto = 1;

var select_tp = iniciar_select('adicionar_pergunta_tipo_empreendimento');
var select_topico = iniciar_select('adicionar_pergunta_topico');
var select_area = iniciar_select('adicionar_pergunta_area');
var select_tag = iniciar_select('adicionar_pergunta_tag');

$("#btn_modal_adicionar_pergunta").click(async function() {     
    abrir_modal('modal_adicionar_pergunta', false);    
    let tematicas = await pesquisar_tematica('ativo', 'true');
    $("#adicionar_pergunta_tematica").empty();        
    for (let i in tematicas) {        
        let tematica = `<option value="${tematicas[i].id}">${tematicas[i].nome}</option>`;    
        $("#adicionar_pergunta_tematica").append(tematica);
    }
    let tipos_empreendimentos = await pesquisar_tipos_empreendimentos('ativo', 'true');
    for(let i in tipos_empreendimentos){
        select_tp.addOption({ value: tipos_empreendimentos[i].id, text: tipos_empreendimentos[i].nome});
    }
    let topicos = await pesquisar_topicos('ativo', 'true');
    for(let i in topicos){
        select_topico.addOption({ value: topicos[i].id, text: topicos[i].nome });
    }    
    let areas = await pesquisar_areas('ativo', 'true');
    for(let i in areas){
        select_area.addOption({ value: areas[i].id, text: areas[i].nome });
    }
    let tags = await pesquisar_tags('ativo', 'true');
    for(let i in tags){
        select_tag.addOption({ value: tags[i].id, text: tags[i].nome});
    }
    mostrar_informacoes_modal('modal_adicionar_pergunta');
});

$("#btn_adicionar_pergunta").click(function(){
    habilitar_botao('btn_adicionar_pergunta', false);

    let form = new FormData();

    form.append('titulo', $("#adicionar_pergunta_titulo").val());
    form.append('tematica_id', $("#adicionar_pergunta_tematica").val());

    form.append('tipos_empreendimentos', $("#adicionar_pergunta_tipo_empreendimento").val());
    form.append('areas', $("#adicionar_pergunta_area").val());
    form.append('topicos', $("#adicionar_pergunta_topico").val());
    form.append('tags', $("#adicionar_pergunta_tag").val());

    let fotos = document.querySelectorAll(".foto");
    let legendas = document.querySelectorAll(".legenda");
    
    for(let i = 0; i < legendas.length; i++){
        form.append('legendas[]', legendas[i].value ? legendas[i].value : "");
    }
    for (let foto of fotos) {
        if (foto.files && foto.files[0]) {
            form.append('fotos[]', foto.files[0]);
        }else{
            form.append('fotos[]', null);
        }
    }    
    axios.post('perguntas/adicionar', form)
    .then(response => {
        fechar_modal('modal_adicionar_pergunta');
        limpar_inputs_modal('modal_adicionar_pergunta');
        sucesso(response);
        lista_perguntas();
        $("#adicionar_pergunta_fotos").empty();
        numero_foto = 1;
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_pergunta', true);
    })
});

$("#btn_adicionar_foto").click(function(){
    let elemento = `<div id="foto${numero_foto}" class="my-2 border border-radius">                        
                        <input class="foto mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 focus:outline-none " type="file" accept=".png, .jpg, .jpeg">
                        <input type="text"  class="legenda block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 " placeholder="Legenda...">
                        <button foto="foto${numero_foto}" type="button" class="adicionar_pergunta_excluir_foto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2"><i class="fas fa-times"></i></button>
                    </div>`;
    $("#adicionar_pergunta_fotos").append(elemento);                    
    numero_foto++;
});

$(document).on('click', '.adicionar_pergunta_excluir_foto', function(){
    let elemento = $(this).attr('foto');
    $("#"+elemento).remove();
});