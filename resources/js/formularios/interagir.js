import { abrir_modal, erro, habilitar_botao, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_respostas } from './funcoes';

$(document).ready(function () {
    lista_respostas();
    renderizar_perguntas();    
});

$(".registrar").click(function () {
    let pergunta = $(this).attr('propriedade');    
    let titulo_pergunta = $("#pergunta" + pergunta + " h5").html();
    let dados = {
        titulo: titulo_pergunta,
        pergunta_id: pergunta,
        resposta: $("#pergunta" + pergunta + " .resposta").val(),
        formulario_id: $("#formulario_id").val()
    };    
    habilitar_botao('btn_registrar_pergunta_id_' + pergunta, false);
    if (online == false) {
        let erro = '';
        if (dados.resposta == '') {
            erro += 'Resposta é obrigatório!';
        }
        if (erro != '') {
            new Swal({
                title: 'Erro!',
                icon: 'error',
                text: erro
            });
            habilitar_botao('btn_registrar_pergunta_id_' + pergunta, true);
            return;
        }
        armazenar_dados_navegador(dados);        
        const Toast = Swal.mixin({
            toast: true,
            position: "top-start",
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.onmouseenter = Swal.stopTimer;
                toast.onmouseleave = Swal.resumeTimer;
            }
        });
        Toast.fire({
            icon: "success",
            title: "Resposta adiciona na fila de espera!"
        });
        habilitar_botao('btn_registrar_pergunta_id_' + pergunta, true);
        return;
    }
    axios.post('/formularios/registrar', dados)
        .then(response => {
            sucesso(response.data.mensagem);
            $("#qtd_perguntas_respondidas").html(`(${response.data.qtd})`);
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {
            habilitar_botao('btn_registrar_pergunta_id_' + pergunta, true);
        })
});

$("#btn_perguntas_respondidas").click(function () {
    abrir_modal('modal_perguntas_respondidas', false);
    lista_respostas();
    mostrar_informacoes_modal('modal_perguntas_respondidas');
});

$(document).on('click', '.excluir_resposta', function () {
    let resposta = $(this).attr('resposta');
    habilitar_botao('excluir_resposta' + resposta, false);
    axios.delete(app_url + '/formularios/excluir/resposta/' + resposta)
        .then(resposta => {
            sucesso(resposta);
            lista_respostas();
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {
            mostrar_informacoes_modal('excluir_resposta' + resposta);
        })
});

var dados_navegador = [];
var online = true;
function estilizar_online(online) {
    if (online) {
        $("#online").removeClass("bg-red-50");
        $("#online").addClass("bg-green-50");
        $("#online").html("ONLINE");
    } else {
        $("#online").removeClass("bg-green-50");
        $("#online").addClass("bg-red-50");
        $("#online").html("OFFLINE");
    }
}

function verificarConexao() {
    const xhr = new XMLHttpRequest();
    xhr.open("GET", url, true);
    xhr.timeout = 5000;
    xhr.onload = function () {
        if (xhr.status >= 200 && xhr.status < 300) {            
            online = true;
            estilizar_online(true);
        } else {            
            online = false;
            estilizar_online(false);
        }
    };
    xhr.onerror = function () {        
        online = false;
        estilizar_online(false);
    };
    xhr.ontimeout = function () {        
        online = false;
        estilizar_online(false);
    };
    xhr.send();
}
setInterval(verificarConexao, 200);
setInterval(salvar_perguntas_espera_banco, 2000);

function armazenar_dados_navegador(dados) {
    dados_navegador.push(dados);    
    localStorage.setItem("dados", JSON.stringify(dados_navegador));
    renderizar_perguntas();
}

function retornar_dados_armazenados() {
    return JSON.parse(localStorage.getItem("dados"));
}

function renderizar_perguntas() {
    let dadosRecuperados = retornar_dados_armazenados();
    $("#perguntas_em_espera_qtd").html(`(${dadosRecuperados.length})`);
    $("#perguntas_respondidas_em_espera").empty();
    for (let i in dadosRecuperados) {
        let dado = `<li class="list-group-item">${dadosRecuperados[i].titulo}: ${dadosRecuperados[i].resposta}</li>`;
        $("#perguntas_respondidas_em_espera").append(dado);
    }
}

function salvar_perguntas_espera_banco() {
    if (online === false) {
        return;
    }
    let dados = {
        dados: retornar_dados_armazenados()
    };        
    if(dados.dados.length > 0){
        axios.post(app_url+"/formularios/registrar_perguntas_em_espera/"+$("#formulario_id").val(), dados)
        .then(response => {
            localStorage.setItem("dados", JSON.stringify([]));
            lista_respostas();
            renderizar_perguntas();
            sucesso("Respostas em espera foram cadastradas!");            
        })
    }    
}
