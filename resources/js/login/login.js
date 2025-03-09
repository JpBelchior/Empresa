import axios from "axios";
import { abrir_modal, erro, habilitar_botao, sucesso } from "../app";

$("#btn_modal_recuperar_senha").click(() => { abrir_modal('modal_recuperar_senha') });

$("#entrar").click(function(){
    habilitar_botao("entrar", false);
    let dados = { email: $("#email").val(), senha: $("#senha").val() };
    axios.post('/verificar_login/', dados)
    .then(response => {        
        location.reload();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao("entrar", true);
    });
});


$("#btn_recuperar_senha").click(function(){
    habilitar_botao("btn_recuperar_senha", false);
    axios.post('recuperacao_senha/solicitar', { cpf_cnpj: $("#cpf_cnpj").val() })
    .then(response => {
        sucesso(response);
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao("btn_recuperar_senha", true);
    })
});

$(document).ready(function(){
    const urlParams = new URLSearchParams(window.location.search);    
    const mensagem = urlParams.get('mensagem');
    if(mensagem){
        sucesso(mensagem);
    }    
});
