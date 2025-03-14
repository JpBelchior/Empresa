import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_empresas } from './funcoes';

$(document).on('click', '.editar', function(){
    let empresa = $(this).attr('empresa');
    abrir_modal('modal_editar_empresa', false);
    axios.get('empresas/detalhes/'+empresa)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_empresa_id").val(dados.id);
        $("#editar_empresa_razao_social").val(dados.razao_social);
        $("#editar_empresa_cnpj").val(dados.cnpj);
        $("#editar_empresa_email").val(dados.email);
        $("#editar_empresa_whatsapp").val(dados.whatsapp);
        $("#editar_empresa_qtd").val(dados.qtd_usuarios_permitidos);
        $("#editar_empresa_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_empresa');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_empresa").click(function(){
    habilitar_botao('btn_editar_empresa', false);
    let dados = {
        razao_social: $("#editar_empresa_razao_social").val(),
        cnpj: $("#editar_empresa_cnpj").val(),
        email: $("#editar_empresa_email").val(),
        whatsapp: $("#editar_empresa_whatsapp").val(),
        limite_usuarios: $("#editar_empresa_qtd").val(),
        ativo: $("#editar_empresa_ativo").prop('checked')
    };
    let empresa = $("#editar_empresa_id").val();
    axios.put('empresas/editar/'+empresa, dados)
    .then(response => {
        sucesso(response);
        lista_empresas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_empresa', true);
    })
});