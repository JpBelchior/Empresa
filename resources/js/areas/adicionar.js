import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso } from "../app";
import { lista_areas } from "./funcoes";


$("#btn_modal_adicionar_area").click(function(){ abrir_modal('modal_adicionar_area') });

$("#btn_adicionar_area").click(function(){
    habilitar_botao('btn_adicionar_area', false);
    let dados = {
        nome: $("#adicionar_area_nome").val(),        
    };
    axios.post('areas/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_area');
        limpar_inputs_modal('modal_adicionar_area');
        sucesso(response);
        lista_areas();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_area', true);
    })
});