import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_tematicas } from './funcoes';

$(document).on('click', '.editar', function(){
    let tematica = $(this).attr('tematica');
    abrir_modal('modal_editar_tematica', false);
    axios.get('tematicas/detalhes/'+tematica)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_tematica_id").val(dados.id);
        $("#editar_tematica_nome").val(dados.nome);        
        $("#editar_tematica_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_tematica');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_tematica").click(function(){
    habilitar_botao('btn_editar_tematica', false);
    let dados = {
        nome: $("#editar_tematica_nome").val(),        
        ativo: $("#editar_tematica_ativo").prop('checked')
    };
    let tematica = $("#editar_tematica_id").val();
    axios.put('tematicas/editar/'+tematica, dados)
    .then(response => {
        sucesso(response);
        lista_tematicas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_tematica', true);
    })
});