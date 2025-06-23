import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_clientes } from "./funcoes";


$("#btn_modal_adicionar_cliente").click(function(){ abrir_modal('modal_adicionar_cliente') });

$("#btn_adicionar_cliente").click(function(){
    habilitar_botao('btn_adicionar_cliente', false);
    let dados = {
        nome: $("#adicionar_cliente_nome").val(),        
    };    
    axios.post('clientes/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_cliente');
        limpar_inputs_modal('modal_adicionar_cliente');
        sucesso(response);
        lista_clientes();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_cliente', true);
    })
});