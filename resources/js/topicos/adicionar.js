import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_topicos } from "./funcoes";


$("#btn_modal_adicionar_topico").click(function(){ abrir_modal('modal_adicionar_topico') });

$("#btn_adicionar_topico").click(function(){
    habilitar_botao('btn_adicionar_topico', false);
    let dados = {
        nome: $("#adicionar_topico_nome").val(),        
    };
    axios.post('topicos/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_topico');
        limpar_inputs_modal('modal_adicionar_topico');
        sucesso(response);
        lista_topicos();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_topico', true);
    })
});