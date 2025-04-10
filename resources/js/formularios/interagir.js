import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_respostas } from './funcoes';

$(document).ready(function(){
    lista_respostas();
});

$(".registrar").click(function(){
    let pergunta = $(this).attr('propriedade');
    let dados = {
        pergunta_id: pergunta,
        resposta: $("#pergunta"+pergunta+" .resposta").val(),
        formulario_id: $("#formulario_id").val()
    };    
    habilitar_botao('btn_registrar_pergunta_id_'+pergunta, false);
    axios.post('/formularios/registrar', dados)
    .then(response => {
        sucesso(response.data.mensagem);
        $("#qtd_perguntas_respondidas").html(`(${response.data.qtd})`);
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_registrar_pergunta_id_'+pergunta, true);
    })  
});

$("#btn_perguntas_respondidas").click(function(){
    abrir_modal('modal_perguntas_respondidas', false);
    lista_respostas();    
    mostrar_informacoes_modal('modal_perguntas_respondidas');
});

$(document).on('click', '.excluir_resposta', function(){
    let resposta = $(this).attr('resposta');
    habilitar_botao('excluir_resposta'+resposta, false);
    axios.delete(app_url+'/formularios/excluir/resposta/'+resposta)
    .then(resposta => {
        sucesso(resposta);
        lista_respostas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        mostrar_informacoes_modal('excluir_resposta'+resposta);
    })
});