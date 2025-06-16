import axios from "axios";
import { abrir_modal, erro, fechar_modal, habilitar_botao, sucesso } from "../app";

$(".responder-pergunta").click(function () {
    let pergunta = $(this).attr('pergunta');
    $("#btn_salvar_respostas").attr('pergunta', pergunta);
    let formulario = $("#formulario_id").val();
    axios.get(`${app_url}/respostas/detalhes_resposta/${formulario}/${pergunta}`)
        .then(response => {
            let pergunta = response.data.pergunta;
            let resposta = response.data.resposta;
            $("#titulo_pergunta").html(pergunta.titulo);
            if (resposta == null) {
                badge_adequacao(false);
                badge_prazo(false);
                badge_risco_altissimo(false);
                $("input[name='adequacao']").prop('checked', false);
                $("input[name='probabilidade']").prop('checked', false);
                $("input[name='impacto']").prop('checked', false);
                $("input[name='esforco']").prop('checked', false);
                $("input[name='valor']").prop('checked', false);
                $("#resposta").val("");
            } else {
                $(`input[name='adequacao'][value='${resposta.nivel_adequacao}']`).prop("checked", true);
                badge_adequacao();
                $(`input[name='probabilidade'][value='${resposta.nivel_probabilidade}']`).prop("checked", true);
                $(`input[name='impacto'][value='${resposta.nivel_impacto}']`).prop("checked", true);
                badge_risco_altissimo();
                $(`input[name='esforco'][value='${resposta.nivel_esforco}']`).prop("checked", true);
                $(`input[name='valor'][value='${resposta.nivel_valor}']`).prop("checked", true);
                badge_prazo();
                $("#resposta").val(resposta.resposta);
            }
            abrir_modal("modal_dados_formulario");            
        })
        .catch(error => {
            erro(error);
        })
});

function badge_adequacao(mostrar = true) {
    if (!mostrar) {
        $("#adequado").hide();
        $("#vulneravel").hide();
        return;
    }
    let nivel = $("input[name='adequacao']:checked").val();     
    if (nivel >= vulnerabilidade) {
        $("#adequado").hide();
        $("#vulneravel").show();
    } else {
        $("#adequado").show();
        $("#vulneravel").hide();
    }
}

$("input[name='adequacao']").on('click', function () {
    badge_adequacao();
});

$("input[name='probabilidade']").on('click', function () {
    badge_risco_altissimo();
});

$("input[name='impacto']").on('click', function () {
    badge_risco_altissimo();
});

function badge_risco_altissimo(mostrar = true) {
    if (!mostrar) {
        $("#risco_altissimo").hide();
        return;
    }
    let probabilidade = $("input[name='probabilidade']:checked").val();
    let impacto = $("input[name='impacto']:checked").val();
    let multiplicacao = probabilidade * impacto;
    if (multiplicacao >= risco_altissimo) {
        $("#risco_altissimo").show();
    } else {
        $("#risco_altissimo").hide();
    }
}

$("input[name='esforco']").on('click', function () {
    badge_prazo();
});

$("input[name='valor']").on('click', function () {
    badge_prazo();
});

function badge_prazo(mostrar = true) {
    if (!mostrar) {
        $("#curto_prazo").hide();
        $("#medio_prazo").hide();
        $("#longo_prazo").hide();
        return;
    }
    let esforco = $("input[name='esforco']:checked").val();
    let valor = $("input[name='valor']:checked").val();
    let multiplicacao = esforco * valor;
    if (multiplicacao >= curto_prazo_minimo && multiplicacao <= curto_prazo_maximo) {
        $("#curto_prazo").show();
        $("#medio_prazo").hide();
        $("#longo_prazo").hide();
    }
    if (multiplicacao >= medio_prazo_minimo && multiplicacao <= medio_prazo_maximo) {
        $("#curto_prazo").hide();
        $("#medio_prazo").show();
        $("#longo_prazo").hide();
    }
    if (multiplicacao >= longo_prazo_minimo && multiplicacao <= longo_prazo_maximo) {
        $("#curto_prazo").hide();
        $("#medio_prazo").hide();
        $("#longo_prazo").show();
    }

}

$("#btn_salvar_respostas").click(function () {
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
    form.append("foto", document.getElementById("foto").files[0]);
    axios.post("/formularios/responder_pergunta", form)
        .then(response => {
            sucesso(response.data.mensagem);
            fechar_modal("modal_dados_formulario");
            location.reload();
        })
        .catch(error => { erro(error); })
        .finally(() => {
            habilitar_botao('btn_salvar_respostas', true);
        });
});