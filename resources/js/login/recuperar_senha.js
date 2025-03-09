import { sucesso, erro, habilitar_botao } from '../app';

$("#redefinir").click(function () {
    habilitar_botao('redefinir', false);
    const parametros = {
        token: $("#token").val(),
        senha: $("#senha").val(),
        senha_confirmacao: $("#confirma_senha").val()
    }
    console.log(parametros);
    axios.put('/recuperacao_senha/efetivar', parametros)
    .then((response) => {
        sucesso(response);
        location.href = app_url+"?mensagem=Recuperação foi feita com sucesso!";
    })
    .catch((error) => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('redefinir', true);
    });
});