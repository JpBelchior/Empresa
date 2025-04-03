import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso, iniciar_select, fechar_modal } from '../app';
import { lista_projetos } from './funcoes';
import { pesquisar_tipos_empreendimentos } from '../tipos_empreendimentos/funcoes';
import { pesquisar_funcionario } from '../funcionarios/funcoes';

var select_tp_editar = iniciar_select('editar_projeto_tipo_empreendimento');
var select_funcionarios_editar = iniciar_select('editar_projeto_funcionario');

$(document).on('click', '.editar', async function(){
    let projeto = $(this).attr('projeto');
    abrir_modal('modal_editar_projeto', false);
    let tipos_empreendimentos = await pesquisar_tipos_empreendimentos('ativo', 'true');
    for(let i in tipos_empreendimentos){
        select_tp_editar.addOption({ value: tipos_empreendimentos[i].id, text: tipos_empreendimentos[i].nome});
    }
    let funcionarios = await pesquisar_funcionario('ativo', 'true');    
    for(let i in funcionarios){
        select_funcionarios_editar.addOption({ value: funcionarios[i].id, text: funcionarios[i].nome});
    }
    axios.get('projetos/detalhes/'+projeto)
    .then(response => {
        let dados = response.data;
        $("#editar_projeto_id").val(dados.id);
        $("#editar_projeto_nome").val(dados.nome);
        $("#editar_projeto_data").val(dados.data_projeto);
        let opcoes = [];
        let tp = dados.tipos_empreendimentos;
        for(let i in tp){
            opcoes.push(tp[i].tipo_empreendimento_id);
        }        
        select_tp_editar.setValue(opcoes);                
        opcoes = [];
        let func = dados.usuarios;
        for(let i in func){
            opcoes.push(func[i].usuario_id);
        }
        select_funcionarios_editar.setValue(opcoes);        
        mostrar_informacoes_modal('modal_editar_projeto');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_projeto").click(function(){
    habilitar_botao('btn_editar_projeto', false);
    let dados = {
        nome: $("#editar_projeto_nome").val(),        
        data_projeto: $("#editar_projeto_data").val(),
        tipos_empreendimentos: $("#editar_projeto_tipo_empreendimento").val(),
        funcionarios: $("#editar_projeto_funcionario").val(),
    };
    let projeto = $("#editar_projeto_id").val();
    axios.put('projetos/editar/'+projeto, dados)
    .then(response => {
        sucesso(response);
        lista_projetos();
        fechar_modal('modal_editar_projeto');
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_projeto', true);
    })
});