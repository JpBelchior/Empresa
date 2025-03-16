import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_tags } from "./funcoes";


$("#btn_modal_adicionar_tag").click(function(){ abrir_modal('modal_adicionar_tag') });

$("#btn_adicionar_tag").click(function(){
    habilitar_botao('btn_adicionar_tag', false);
    let dados = {
        nome: $("#adicionar_tag_nome").val(),        
    };
    axios.post('tags/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_tag');
        limpar_inputs_modal('modal_adicionar_tag');
        sucesso(response);
        lista_tags();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_tag', true);
    })
});