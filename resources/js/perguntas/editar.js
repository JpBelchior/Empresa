import { abrir_modal, erro, fechar_modal, habilitar_botao, iniciar_select, mostrar_informacoes_modal, sucesso } from '../app';
import { lista_perguntas } from './funcoes';

var select_tp = iniciar_select("editar_pergunta_tipo_empreendimento");
var select_topico = iniciar_select("editar_pergunta_topico");
var select_area = iniciar_select("editar_pergunta_area");
var select_tag = iniciar_select("editar_pergunta_tag");

var numero_foto_editar = 1;
var excluir_fotos = [];

$(document).on('click', '.editar', function(){    
    $("#editar_pergunta_tematica").empty();
    axios.get('tematicas/lista')
    .then(response => {
        let tematicas = response.data;        
        for(let i in tematicas){
            let ativo = tematicas[i].ativo == true ? "Ativo" : "Inativo";
            let tematica = `<option value="${tematicas[i].id}">${tematicas[i].nome}(${ativo})</option>`;
            $("#editar_pergunta_tematica").append(tematica);
        }
    })
    .catch(error => { erro(error) });
    axios.get('tipos_empreendimentos/lista')
    .then(response => {
        let tp = response.data;        
        for(let i in tp){
            let ativo = tp[i].ativo == true ? "Ativo" : "Inativo";
            select_tp.addOption({ value: tp[i].id, text: tp[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('topicos/lista')
    .then(response => {
        let topicos = response.data;
        for(let i in topicos){
            let ativo = topicos[i].ativo == true ? "Ativo" : "Inativo";
            select_topico.addOption({ value: topicos[i].id, text: topicos[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('areas/lista')
    .then(response => {
        let areas = response.data;
        for(let i in areas){
            let ativo = areas[i].ativo == true ? "Ativo" : "Inativo";
            select_area.addOption({ value: areas[i].id, text: areas[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    axios.get('tags/lista')
    .then(response => {
        let tags = response.data;
        for(let i in tags){
            let ativo = tags[i].ativo == true ? "Ativo" : "Inativo";
            select_tag.addOption({ value: tags[i].id, text: tags[i].nome+`(${ativo})` });
        }
    })
    .catch(error => erro(error));
    abrir_modal('modal_editar_pergunta', false);
    let pergunta = $(this).attr('pergunta');        
    axios.get('perguntas/detalhes/'+pergunta)
    .then(response => {
        excluir_fotos = [];
        $("#editar_pergunta_fotos").empty();
        let dados = response.data;
        let ativo = response.data.ativo ? true : false;
        let opcoes = [];
        for(let i in dados.tipos_empreendimentos){
            let t = dados.tipos_empreendimentos[i].tipo_empreendimento_id;
            opcoes.push(t);                        
        }
        select_tp.setValue(opcoes);
        opcoes = [];        
        for(let i in dados.topicos){
            let t = dados.topicos[i].topico_id;            
            opcoes.push(t);                        
        }
        select_topico.setValue(opcoes);        
        opcoes = [];
        for(let i in dados.areas){
            let t = dados.areas[i].area_id;
            opcoes.push(t);                       
        }
        select_area.setValue(opcoes);        
        opcoes = [];
        for(let i in dados.tags){
            let t = dados.tags[i].tag_id;
            opcoes.push(t);            
        }
        select_tag.setValue(opcoes);
        let fotos = dados.fotos;
        for(let i in fotos){            
            let foto = `<div id="foto${numero_foto_editar}" class="max-w-sm bg-white border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700">                            
                            <img class="rounded-t-lg" src="${app_url}/arquivos/exibir/${fotos[i].arquivo_id}" alt="" />                            
                            <div class="p-5">                                
                                <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${fotos[i].legenda}</h5>                                
                                <button foto="foto${numero_foto_editar}" foto_id="${fotos[i].id}" type="button" class="editar_pergunta_excluir_foto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i class="fas fa-times"></i></button>
                            </div>
                        </div>`;
            $("#editar_pergunta_fotos").append(foto);
            numero_foto_editar++;
        }
        $("#editar_pergunta_id").val(dados.id);
        $("#editar_pergunta_titulo").val(dados.titulo);
        $("#editar_pergunta_tematica").val(dados.tematica_id);
        $("#editar_pergunta_ativo").prop('checked', ativo);
        mostrar_informacoes_modal('modal_editar_pergunta');
        
     })
    .catch(error => { erro(error); });
});

$(document).on('click', '.editar_pergunta_excluir_foto', function(){
    let elemento = $(this).attr('foto');
    let foto_id = $(this).attr('foto_id');
    excluir_fotos.push(foto_id);
    $("#"+elemento).remove();
});

$("#btn_editar_pergunta").click(function(){
    habilitar_botao('btn_editar_pergunta', false);
    let form = new FormData();
    form.append('titulo', $("#editar_pergunta_titulo").val());
    form.append('tematica_id', $("#editar_pergunta_tematica").val());
    form.append('tipos_empreendimentos', $("#editar_pergunta_tipo_empreendimento").val());
    form.append('areas', $("#editar_pergunta_area").val());
    form.append('topicos', $("#editar_pergunta_topico").val());
    form.append('tags', $("#editar_pergunta_tag").val());
    form.append('ativo', $("#editar_pergunta_ativo").prop('checked'));
    form.append('fotos_para_excluir', excluir_fotos);
    let fotos = document.querySelectorAll(".foto_editar");
    let legendas = document.querySelectorAll(".legenda_editar");
    for(let i = 0; i < legendas.length; i++){
        form.append('legendas[]', legendas[i].value ? legendas[i].value : "");
    }
    for (let foto of fotos) {
        if (foto.files && foto.files[0]) {
            form.append('fotos[]', foto.files[0]);
        }else{
            form.append('fotos[]', null);
        }
    }
    let pergunta = $("#editar_pergunta_id").val();
    axios.post('perguntas/editar/'+pergunta, form)
    .then(response => {
        sucesso(response);
        lista_perguntas();
        fechar_modal('modal_editar_pergunta');
        numero_foto_editar = 1;
        excluir_fotos = [];
    })
    .catch(error => {
        erro(error);
    })
    .finally(() => {
        habilitar_botao('btn_editar_pergunta', true);
    })
});

$("#btn_adicionar_foto_editar_pergunta").click(function(){
    let elemento = `<div id="foto${numero_foto_editar}" class="my-2 border border-radius">                        
                        <input class="foto_editar mb-2 block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" type="file" accept=".png, .jpg, .jpeg">
                        <input type="text"  class="legenda_editar block w-full p-2 text-gray-900 border border-gray-300 rounded-lg bg-gray-50 text-xs focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Legenda...">
                        <button foto="foto${numero_foto_editar}" type="button" class="adicionar_pergunta_excluir_foto text-white bg-red-700 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900"><i class="fas fa-times"></i></button>
                    </div>`;
    $("#editar_pergunta_fotos").append(elemento);                    
    numero_foto_editar++;
});