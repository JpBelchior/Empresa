import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso, fechar_modal, limpar_inputs_modal } from '../app';
import { lista_formularios } from './funcoes';

$(document).on('click', '.editar', function(){
    let usuario = $(this).attr('usuario');
    abrir_modal('modal_editar_usuario', false);    
    axios.get('funcionarios/detalhes/'+usuario)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_usuario_id").val(dados.id);
        $("#editar_usuario_nome").val(dados.nome);
        $("#editar_usuario_cpf_cnpj").val(dados.cpf_cnpj);
        $("#editar_usuario_email").val(dados.email);
        $("#editar_usuario_whatsapp").val(dados.whatsapp);        
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
        ativo: $("#editar_usuario_ativo").prop('checked'),
        senha: $("#editar_usuario_senha").val(),
    };
    let usuario = $("#editar_usuario_id").val();
    axios.put('funcionarios/editar/'+usuario, dados)
    .then(response => {
        fechar_modal('modal_editar_usuario');
        limpar_inputs_modal('modal_editar_usuario');
        sucesso(response);        
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_usuario', true);
    })
});