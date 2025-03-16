import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_tipos_empreendimentos } from './funcoes';

$(document).on('click', '.editar', function(){
    let tipo_empreendimento = $(this).attr('tipo_empreendimento');
    abrir_modal('modal_editar_tipo_empreendimento', false);
    axios.get('tipos_empreendimentos/detalhes/'+tipo_empreendimento)
    .then(response => { 
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        $("#editar_tipo_empreendimento_id").val(dados.id);
        $("#editar_tipo_empreendimento_nome").val(dados.nome);        
        $("#editar_tipo_empreendimento_ativo").attr('checked', ativo);
        mostrar_informacoes_modal('modal_editar_tipo_empreendimento');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_tipo_empreendimento").click(function(){
    habilitar_botao('btn_editar_tipo_empreendimento', false);
    let dados = {
        nome: $("#editar_tipo_empreendimento_nome").val(),        
        ativo: $("#editar_tipo_empreendimento_ativo").prop('checked')
    };
    let tipo_empreendimento = $("#editar_tipo_empreendimento_id").val();
    axios.put('tipos_empreendimentos/editar/'+tipo_empreendimento, dados)
    .then(response => {
        sucesso(response);
        lista_tipos_empreendimentos();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_tipo_empreendimento', true);
    })
});