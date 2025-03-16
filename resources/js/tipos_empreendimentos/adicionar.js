import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_tipos_empreendimentos } from "./funcoes";


$("#btn_modal_adicionar_tipo_empreendimento").click(function(){ abrir_modal('modal_adicionar_tipo_empreendimento') });

$("#btn_adicionar_tipo_empreendimento").click(function(){
    habilitar_botao('btn_adicionar_tipo_empreendimento', false);
    let dados = {
        nome: $("#adicionar_tipo_empreendimento_nome").val(),        
    };
    axios.post('tipos_empreendimentos/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_tipo_empreendimento');
        limpar_inputs_modal('modal_adicionar_tipo_empreendimento');
        sucesso(response);
        lista_tipos_empreendimentos();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_tipo_empreendimento', true);
    })
});