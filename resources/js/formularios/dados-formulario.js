import axios from "axios";
import { abrir_modal, erro, fechar_modal, habilitar_botao, sucesso } from "../app";

$(".responder-pergunta").click(function(){
    let pergunta = $(this).attr('pergunta');
    $("#btn_salvar_respostas").attr('pergunta', pergunta);
    abrir_modal("modal_dados_formulario");
});

$("input[name='adequacao']").on('click', function(){
    let nivel = $(this).val();    
    if(nivel >= vulnerabilidade){
        $("#adequado").hide();
        $("#vulneravel").show();
    }else{
        $("#adequado").show();
        $("#vulneravel").hide();
    }    
});

$("input[name='probabilidade']").on('click', function(){
    badge_risco_altissimo();
});

$("input[name='impacto']").on('click', function(){
    badge_risco_altissimo();    
});

function badge_risco_altissimo(){
    let probabilidade = $("input[name='probabilidade']:checked").val();
    let impacto = $("input[name='impacto']:checked").val();
    let multiplicacao = probabilidade*impacto;
    if(multiplicacao >= risco_altissimo){
        $("#risco_altissimo").show();
    }else{
        $("#risco_altissimo").hide();
    }
}

$("#btn_salvar_respostas").click(function(){    
    habilitar_botao('btn_salvar_respostas', false);
    let pergunta = $(this).attr('pergunta');
    let adequacao = $("input[name='adequacao']:checked").val();
    adequacao = adequacao == undefined ? 1 : adequacao;
    let probabilidade = $("input[name='probabilidade']:checked").val();
    probabilidade = probabilidade == undefined ? 1 : probabilidade;
    let impacto = $("input[name='impacto']:checked").val();
    impacto = impacto == undefined ? 1 : impacto;
    let esforco = $("input[name='esforco']:checked").val();
    esforco = esforco == undefined ? 1 : esforco;
    let valor = $("input[name='valor']:checked").val();
    valor = valor == undefined ? 1 : valor;
    let resposta = $("#resposta").val();
    let form = new FormData();
    form.append('formulario_id', $("#formulario_id").val());
    form.append('pergunta_id', pergunta);
    form.append("adequacao", adequacao);
    form.append("probabilidade", probabilidade);
    form.append("impacto", impacto);
    form.append("esforco", esforco);
    form.append("valor", valor);
    form.append("resposta", resposta);    
    axios.post("/formularios/responder_pergunta", form)
    .then(response => {
        sucesso(response.data.mensagem);
        fechar_modal("modal_dados_formulario");
    })
    .catch(error => { erro(error); })
    .finally(() => {
        habilitar_botao('btn_salvar_respostas', true);
    });
});