import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso, iniciar_select, fechar_modal } from '../app';
import { lista_projetos } from './funcoes';
import { pesquisar_funcionario } from '../funcionarios/funcoes';
import { pesquisar_clientes } from '../clientes/funcoes';

var select_funcionarios_editar = iniciar_select('editar_projeto_funcionario');
var select_clientes_editar = iniciar_select("editar_projeto_cliente");

$(document).on('click', '.editar', async function(){    
    let projeto = $(this).attr('projeto');
    abrir_modal('modal_editar_projeto', false);
    let funcionarios = await pesquisar_funcionario('ativo', 'true');    
    for(let i in funcionarios){
        select_funcionarios_editar.addOption({ value: funcionarios[i].id, text: funcionarios[i].nome});
    }
    let clientes = await pesquisar_clientes('ativo', 'true');        
    for(let i in clientes){        
        select_clientes_editar.addOption({ value: clientes[i].id, text: clientes[i].nome});
    }
    axios.get('projetos/detalhes/'+projeto)
    .then(response => {
        let dados = response.data;
        $("#editar_projeto_status").val(dados.status);
        $("#editar_projeto_id").val(dados.id);
        $("#editar_projeto_nome").val(dados.nome);
        $("#editar_projeto_data_inicio").val(dados.data_inicio);
        $("#editar_projeto_data_conclusao").val(dados.data_conclusao);
        let opcoes = [];
        let func = dados.usuarios;
        for(let i in func){
            opcoes.push(func[i].usuario_id);
        }
        select_funcionarios_editar.setValue(opcoes);        
        select_clientes_editar.setValue(dados.cliente_id);
        mostrar_informacoes_modal('modal_editar_projeto');
     })
    .catch(error => { erro(error); })
    .finally(() => {  })
});

$("#btn_editar_projeto").click(function(){
    habilitar_botao('btn_editar_projeto', false);
    let dados = {
        status: $("#editar_projeto_status").val(),
        nome: $("#editar_projeto_nome").val(),        
        data_inicio: $("#editar_projeto_data_inicio").val(),        
        data_conclusao: $("#editar_projeto_data_conclusao").val(),        
        cliente: $("#editar_projeto_cliente").val(),        
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