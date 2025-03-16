import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_tags } from './funcoes';

$(document).on('click', '.editar', function(){
    let tag = $(this).attr('tag');
    abrir_modal('modal_editar_tag', false);
    axios.get('tags/detalhes/'+tag)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_tag_id").val(dados.id);
        $("#editar_tag_nome").val(dados.nome);        
        $("#editar_tag_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_tag');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_tag").click(function(){
    habilitar_botao('btn_editar_tag', false);
    let dados = {
        nome: $("#editar_tag_nome").val(),        
        ativo: $("#editar_tag_ativo").prop('checked')
    };
    let tag = $("#editar_tag_id").val();
    axios.put('tags/editar/'+tag, dados)
    .then(response => {
        sucesso(response);
        lista_tags();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_tag', true);
    })
});