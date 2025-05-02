$(document).ready(function(){
    axios.get('usuarios/estatisticas')
    .then(response => {        
        let projetos = response.data.projetos;
        let formularios = response.data.formularios;
        $("#projetos_spinner").hide();
        $("#formularios_spinner").hide();        
        $("#projetos_texto").html(projetos);
        $("#formularios_texto").html(formularios);        
    })
    .catch(error => {

    })
    .finally(() => {

    })
});