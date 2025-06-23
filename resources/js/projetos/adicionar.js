import axios from "axios";
import { abrir_modal, erro, fechar_modal, habilitar_botao, limpar_inputs_modal, sucesso, iniciar_select, mostrar_informacoes_modal } from "../app";
import { lista_projetos } from "./funcoes";
import { pesquisar_tipos_empreendimentos } from "../tipos_empreendimentos/funcoes";
import { pesquisar_funcionario } from "../funcionarios/funcoes";
import { pesquisar_clientes } from "../clientes/funcoes";

var select_cliente = iniciar_select('adicionar_projeto_cliente');
var select_tp = iniciar_select('adicionar_projeto_tipo_empreendimento');
var select_funcionarios = iniciar_select('adicionar_projeto_funcionario');

$("#btn_modal_adicionar_projeto").click(async function(){ 
    abrir_modal('modal_adicionar_projeto', false);
    let clientes = await pesquisar_clientes('ativo', 'true');    
    for(let i in clientes){        
        select_cliente.addOption({ value: clientes[i].id, text: clientes[i].nome});
    }
    let tipos_empreendimentos = await pesquisar_tipos_empreendimentos('ativo', 'true');
    for(let i in tipos_empreendimentos){
        select_tp.addOption({ value: tipos_empreendimentos[i].id, text: tipos_empreendimentos[i].nome});
    }
    let funcionarios = await pesquisar_funcionario('ativo', 'true');    
    for(let i in funcionarios){
        select_funcionarios.addOption({ value: funcionarios[i].id, text: funcionarios[i].nome});
    }
    mostrar_informacoes_modal('modal_adicionar_projeto');
});

$("#btn_adicionar_projeto").click(function(){
    habilitar_botao('btn_adicionar_projeto', false);
    let dados = {
        nome: $("#adicionar_projeto_nome").val(),
        data_inicio: $("#adicionar_projeto_data_inicio").val(),
        data_conclusao: $("#adicionar_projeto_data_conclusao").val(),
        cliente: $("#adicionar_projeto_cliente").val(),
        tipos_empreendimentos: $("#adicionar_projeto_tipo_empreendimento").val(),
        funcionarios: $("#adicionar_projeto_funcionario").val(),
    };
    axios.post('projetos/adicionar', dados)
    .then(response => {
        fechar_modal('modal_adicionar_projeto');
        limpar_inputs_modal('modal_adicionar_projeto');
        sucesso(response);
        lista_projetos();
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_adicionar_projeto', true);
    })
});