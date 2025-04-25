import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, mostrar_informacoes_modal, sucesso } from "../app";
import { pesquisar_tipos_empreendimentos } from "../tipos_empreendimentos/funcoes";
import { lista_formularios } from "./funcoes";

$("#btn_modal_adicionar_formulario").click(async function(){
    abrir_modal('modal_adicionar_formulario', false);
    let tipos_empreendimentos = await pesquisar_tipos_empreendimentos('ativo', 'true');
    $("#adicionar_formulario_tipo_empreendimento").empty();
    for(let i in tipos_empreendimentos){
        $("#adicionar_formulario_tipo_empreendimento").append(`<option value="${tipos_empreendimentos[i].id}">${tipos_empreendimentos[i].nome}</option>`);
    }
    $("#adicionar_formulario_projeto").empty();
    axios.get('projetos/lista')
    .then(response => {        
        let projetos = response.data;
        for(let i in projetos){
            $("#adicionar_formulario_projeto").append(`<option value="${projetos[i].id}">${projetos[i].nome}</option>`);
        }
    })
    .catch(error => {
        erro(error);
    })
    mostrar_informacoes_modal('modal_adicionar_formulario');
 });

$("#btn_adicionar_formulario").click(function(){
    habilitar_botao('btn_adicionar_formulario', false);
    let dados = {
        nome: $("#adicionar_formulario_nome").val(),         
        projeto_id: $("#adicionar_formulario_projeto").val()    
    };
    axios.post('formularios/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_formulario');
        limpar_inputs_modal('modal_adicionar_formulario');
        sucesso(response);        
        lista_formularios();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_formulario', true);
    })
});