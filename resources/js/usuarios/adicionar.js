import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, mostrar_informacoes_modal, sucesso } from "../app";
import { lista_usuarios } from "./funcoes";


$("#btn_modal_adicionar_usuario").click(function(){ 
    abrir_modal('modal_adicionar_usuario', false);
    axios.get('empresas/lista')
    .then(response => {
        let empresas = response.data;        
        $("#adicionar_usuario_empresa_id").empty();
        for(let i in empresas){
            let empresa = `<option value="${empresas[i].id}">${empresas[i].razao_social}</option>`;
            $("#adicionar_usuario_empresa_id").append(empresa);
        }        
    })    
    .catch(error => { erro(error); });
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
        empresa_id: $("#adicionar_usuario_empresa_id").val(),        
    };
    axios.post('usuarios/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_usuario');
        limpar_inputs_modal('modal_adicionar_usuario');
        sucesso(response);
        lista_usuarios();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_usuario', true);
    })
});