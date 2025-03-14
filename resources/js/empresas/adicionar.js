import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_empresas } from "./funcoes";


$("#btn_modal_adicionar_empresa").click(function(){ abrir_modal('modal_adicionar_empresa') });

$("#btn_adicionar_empresa").click(function(){
    habilitar_botao('btn_adicionar_empresa', false);
    let dados = {
        razao_social: $("#adicionar_empresa_razao_social").val(),
        cnpj: $("#adicionar_empresa_cnpj").val(),
        email: $("#adicionar_empresa_email").val(),
        whatsapp: $("#adicionar_empresa_whatsapp").val(),
        limite_usuarios: $("#adicionar_empresa_qtd").val(),
    };
    axios.post('empresas/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_empresa');
        limpar_inputs_modal('modal_adicionar_empresa');
        sucesso(response);
        lista_empresas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_empresa', true);
    })
});