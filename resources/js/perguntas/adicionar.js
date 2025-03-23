import { iniciar_select, abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, mostrar_informacoes_modal, sucesso } from "../app";
import { lista_perguntas } from "./funcoes";
import { pesquisar_tematica } from "../tematicas/funcoes";
import { pesquisar_tipos_empreendimentos } from "../tipos_empreendimentos/funcoes";
import { pesquisar_topicos } from "../topicos/funcoes";
import { pesquisar_areas } from "../areas/funcoes";
import { pesquisar_tags } from "../tags/funcoes";

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
    let dados = {
        titulo: $("#adicionar_pergunta_titulo").val(),
        tematica_id: $("#adicionar_pergunta_tematica").val(),
        tipos_empreendimentos: $("#adicionar_pergunta_tipo_empreendimento").val(),
        areas: $("#adicionar_pergunta_area").val(),
        topicos: $("#adicionar_pergunta_topico").val(),
        tags: $("#adicionar_pergunta_tag").val()
    };    
    axios.post('perguntas/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_pergunta');
        limpar_inputs_modal('modal_adicionar_pergunta');
        sucesso(response);
        lista_perguntas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_pergunta', true);
    })
});