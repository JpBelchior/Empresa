import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso, fechar_modal, limpar_inputs_modal } from '../app';
import { lista_usuarios } from './funcoes';

$(document).on('click', '.editar', function(){
    let usuario = $(this).attr('usuario');
    abrir_modal('modal_editar_usuario', false);
    axios.get('empresas/lista')
    .then(response => {
        let empresas = response.data;        
        $("#editar_usuario_empresa_id").empty();
        for(let i in empresas){
            let empresa = `<option value="${empresas[i].id}">${empresas[i].razao_social}</option>`;
            $("#editar_usuario_empresa_id").append(empresa);
        }        
    })
    .catch(error => { erro(error); });
    axios.get('usuarios/detalhes/'+usuario)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_usuario_id").val(dados.id);
        $("#editar_usuario_nome").val(dados.nome);
        $("#editar_usuario_cpf_cnpj").val(dados.cpf_cnpj);
        $("#editar_usuario_email").val(dados.email);
        $("#editar_usuario_whatsapp").val(dados.whatsapp);
        $("#editar_usuario_empresa_id").val(dados.empresa_id);
        $("#editar_usuario_atribuicao").val(dados.atribuicao);
        $("#editar_usuario_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_usuario');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_usuario").click(function(){
    habilitar_botao('btn_editar_usuario', false);
    let dados = {
        nome: $("#editar_usuario_nome").val(),
        cpf_cnpj: $("#editar_usuario_cpf_cnpj").val(),        
        email: $("#editar_usuario_email").val(),        
        whatsapp: $("#editar_usuario_whatsapp").val(),        
        atribuicao: $("#editar_usuario_atribuicao").val(),
        empresa_id: $("#editar_usuario_empresa_id").val(),
        ativo: $("#editar_usuario_ativo").prop('checked'),
    };
    let usuario = $("#editar_usuario_id").val();
    axios.put('usuarios/editar/'+usuario, dados)
    .then(response => {
        fechar_modal('modal_editar_usuario');
        limpar_inputs_modal('modal_editar_usuario');
        sucesso(response);
        lista_usuarios();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_usuario', true);
    })
});