import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_clientes } from './funcoes';

$(document).on('click', '.editar', function(){
    let cliente = $(this).attr('cliente');
    abrir_modal('modal_editar_cliente', false);
    axios.get('clientes/detalhes/'+cliente)
    .then(response => { 
        console.log(response);
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_cliente_id").val(dados.id);
        $("#editar_cliente_nome").val(dados.nome);        
        $("#editar_cliente_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_cliente');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_cliente").click(function(){
    habilitar_botao('btn_editar_cliente', false);
    let dados = {
        nome: $("#editar_cliente_nome").val(),        
        ativo: $("#editar_cliente_ativo").prop('checked')
    };
    let cliente = $("#editar_cliente_id").val();
    axios.put('clientes/editar/'+cliente, dados)
    .then(response => {
        sucesso(response);
        lista_clientes();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_cliente', true);
    })
});