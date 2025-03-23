import { abrir_modal, erro, mostrar_informacoes_modal, formatar_data, badge } from "../app";

$(document).on('click', '.ver', function(){
    abrir_modal('modal_ver_pergunta', false);
    let pergunta = $(this).attr('pergunta');
    axios('perguntas/detalhes/'+pergunta)
    .then(response => { 
        let dados = response.data;
        $("#ver_pergunta_data_cadastro").html("Data de cadastro: "+formatar_data(dados.data_cadastro));
        let ativo = dados.ativo == true ? "Ativo" : "Inativo";
        let badge_cor = dados.ativo == true ? "verde" : 'vermelho';
        $("#ver_pergunta_ativo").html(badge(ativo, badge_cor));
        $("#ver_pergunta_titulo").html("Título: "+dados.titulo);
        $("#ver_pergunta_tematica").html("Temática: "+dados.tematica.nome);
        let tipos = "Tipos de empreendimentos: ";
        for(let i in dados.tipos_empreendimentos){
            let t = dados.tipos_empreendimentos[i].tipo_empreendimento.nome;
            tipos += badge(t, 'amarelo');
        }
        $("#ver_pergunta_tipo_empreendimento").html(tipos);
        let topicos = "Tópicos: ";
        for(let i in dados.topicos){
            let t = dados.topicos[i].topico.nome;
            topicos += badge(t, 'amarelo');
        }
        $("#ver_pergunta_topico").html(topicos);
        let areas = "Áreas: ";
        for(let i in dados.areas){
            let t = dados.areas[i].area.nome;
            areas += badge(t, 'amarelo');
        }
        $("#ver_pergunta_area").html(areas);
        let tags = "Tags: ";
        for(let i in dados.tags){
            let t = dados.tags[i].tag.nome;
            tags += badge(t, 'amarelo');
        }
        $("#ver_pergunta_tag").html(tags);
     })
    .catch(error => erro(error))
    .finally(() => { 
        mostrar_informacoes_modal('modal_ver_pergunta', true);
     })
});