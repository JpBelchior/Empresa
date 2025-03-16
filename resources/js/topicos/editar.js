import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_topicos } from './funcoes';

$(document).on('click', '.editar', function(){
    let topico = $(this).attr('topico');
    abrir_modal('modal_editar_topico', false);
    axios.get('topicos/detalhes/'+topico)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_topico_id").val(dados.id);
        $("#editar_topico_nome").val(dados.nome);        
        $("#editar_topico_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_topico');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_topico").click(function(){
    habilitar_botao('btn_editar_topico', false);
    let dados = {
        nome: $("#editar_topico_nome").val(),        
        ativo: $("#editar_topico_ativo").prop('checked')
    };
    let topico = $("#editar_topico_id").val();
    axios.put('topicos/editar/'+topico, dados)
    .then(response => {
        sucesso(response);
        lista_topicos();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_topico', true);
    })
});