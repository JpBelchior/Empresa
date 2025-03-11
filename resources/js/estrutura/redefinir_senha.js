import { habilitar_botao, erro, sucesso, abrir_modal, fechar_modal } from "../app";

$("#btn_modal_redefinir_senha").click(function(){
    abrir_modal('modal_redefinir_senha');
});

$("#btn_recuperar_senha").click(function(){
    habilitar_botao('btn_recuperar_senha', false);
    let dados = { senha: $("#senha").val(), senha_confirmacao: $("#senha_confirmacao").val() };
    axios.post('redefinir_senha', dados)
    .then(response => { sucesso(response); fechar_modal('modal_redefinir_senha'); })
    .catch(error => { erro(error) })
    .finally(() => { habilitar_botao('btn_recuperar_senha', true); });
});