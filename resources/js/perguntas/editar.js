import { abrir_modal, erro, habilitar_botao, iniciar_select, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_perguntas } from './funcoes';

var select_tp = iniciar_select("editar_pergunta_tipo_empreendimento");
var select_topico = iniciar_select("editar_pergunta_topico");
var select_area = iniciar_select("editar_pergunta_area");
var select_tag = iniciar_select("editar_pergunta_tag");

$(document).on('click', '.editar', function(){    
    $("#editar_pergunta_tematica").empty();
    axios.get('tematicas/lista')
    .then(response => {
        let tematicas = response.data;        
        for(let i in tematicas){
            let ativo = tematicas[i].ativo == true ? "Ativo" : "Inativo";
            let tematica = `<option value="${tematicas[i].id}">${tematicas[i].nome}(${ativo})</option>`;
            $("#editar_pergunta_tematica").append(tematica);
        }
    })
    .catch(error => { erro(error) });
    axios.get('tipos_empreendimentos/lista')
    .then(response => {
        let tp = response.data;        
        for(let i in tp){
            let ativo = tp[i].ativo == true ? "Ativo" : "Inativo";
            select_tp.addOption({ value: tp[i].id, text: tp[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('topicos/lista')
    .then(response => {
        let topicos = response.data;
        for(let i in topicos){
            let ativo = topicos[i].ativo == true ? "Ativo" : "Inativo";
            select_topico.addOption({ value: topicos[i].id, text: topicos[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('areas/lista')
    .then(response => {
        let areas = response.data;
        for(let i in areas){
            let ativo = areas[i].ativo == true ? "Ativo" : "Inativo";
            select_area.addOption({ value: areas[i].id, text: areas[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('tags/lista')
    .then(response => {
        let tags = response.data;
        for(let i in tags){
            let ativo = tags[i].ativo == true ? "Ativo" : "Inativo";
            select_tag.addOption({ value: tags[i].id, text: tags[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    abrir_modal('modal_editar_pergunta', false);
    let pergunta = $(this).attr('pergunta');        
    axios.get('perguntas/detalhes/'+pergunta)
    .then(response => {
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        let opcoes = [];
        for(let i in dados.tipos_empreendimentos){
            let t = dados.tipos_empreendimentos[i].id;
            opcoes.push(t);                        
        }
        select_tp.setValue(opcoes);
        opcoes = [];        
        for(let i in dados.topicos){
            let t = dados.topicos[i].id;            
            opcoes.push(t);                        
        }
        select_topico.setValue(opcoes);
        opcoes = [];
        for(let i in dados.areas){
            let t = dados.areas[i].id;
            opcoes.push(t);                       
        }
        select_area.setValue(opcoes);
        opcoes = [];
        for(let i in dados.tags){
            let t = dados.tags[i].id;
            opcoes.push(t);            
        }
        select_tag.setValue(opcoes);
        $("#editar_pergunta_id").val(dados.id);
        $("#editar_pergunta_titulo").val(dados.titulo);
        $("#editar_pergunta_tematica").val(dados.tematica_id);
        $("#editar_pergunta_ativo").prop('checked', ativo);
        mostrar_informacoes_modal('modal_editar_pergunta');
        
     })
    .catch(error => { erro(error); });
});

$("#btn_editar_pergunta").click(function(){
    habilitar_botao('btn_editar_pergunta', false);
    let dados = {
        titulo: $("#editar_pergunta_titulo").val(),
        tematica_id: $("#editar_pergunta_tematica").val(),
        tipos_empreendimentos: $("#editar_pergunta_tipo_empreendimento").val(),
        topicos: $("#editar_pergunta_topico").val(),
        areas: $("#editar_pergunta_area").val(),
        tags: $("#editar_pergunta_tag").val(),
        ativo: $("#editar_pergunta_ativo").prop('checked')
    };
    let pergunta = $("#editar_pergunta_id").val();
    axios.put('perguntas/editar/'+pergunta, dados)
    .then(response => {
        sucesso(response);
        lista_perguntas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_pergunta', true);
    })
});