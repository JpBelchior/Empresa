import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_areas } from './funcoes';

$(document).on('click', '.editar', function(){
    let area = $(this).attr('area');
    abrir_modal('modal_editar_area', false);
    axios.get('areas/detalhes/'+area)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_area_id").val(dados.id);
        $("#editar_area_nome").val(dados.nome);        
        $("#editar_area_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_area');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_area").click(function(){
    habilitar_botao('btn_editar_area', false);
    let dados = {
        nome: $("#editar_area_nome").val(),        
        ativo: $("#editar_area_ativo").prop('checked')
    };
    let area = $("#editar_area_id").val();
    axios.put('areas/editar/'+area, dados)
    .then(response => {
        sucesso(response);
        lista_areas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_area', true);
    })
});