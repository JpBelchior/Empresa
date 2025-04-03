import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, mostrar_informacoes_modal, sucesso } from "../app";
import { lista_funcionarios } from "./funcoes";

$("#btn_modal_adicionar_usuario").click(function(){
    abrir_modal('modal_adicionar_usuario', false);    
    mostrar_informacoes_modal('modal_adicionar_usuario');
 });

$("#btn_adicionar_usuario").click(function(){
    habilitar_botao('btn_adicionar_usuario', false);
    let dados = {
        nome: $("#adicionar_usuario_nome").val(),
        cpf_cnpj: $("#adicionar_usuario_cpf_cnpj").val(),
        email: $("#adicionar_usuario_email").val(),
        whatsapp: $("#adicionar_usuario_whatsapp").val(),        
        atribuicao: $("#adicionar_usuario_atribuicao").val(),        
    };
    axios.post('funcionarios/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_usuario');
        limpar_inputs_modal('modal_adicionar_usuario');
        sucesso(response);
        lista_funcionarios();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_usuario', true);
    })
});