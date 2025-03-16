import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_tematicas } from "./funcoes";


$("#btn_modal_adicionar_tematica").click(function(){ abrir_modal('modal_adicionar_tematica') });

$("#btn_adicionar_tematica").click(function(){
    habilitar_botao('btn_adicionar_tematica', false);
    let dados = {
        nome: $("#adicionar_tematica_nome").val(),        
    };
    axios.post('tematicas/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_tematica');
        limpar_inputs_modal('modal_adicionar_tematica');
        sucesso(response);
        lista_tematicas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_tematica', true);
    })
});