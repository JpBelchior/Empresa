import './bootstrap';

import { Modal } from 'flowbite';

//SAIR
$("#logout").click(function(){    
    Swal.fire("Saindo...");
    axios.post('logout')
    .then(response => { location.reload(); })
    .catch(error => erro(error))
});

//DESABILITA TODOS OS INPUTS DE TEREM VALORES SUGERIDOS
$("input").attr('autocomplete', 'off');

//CONFIGURAÇÃO DE MODAIS
var modal;

function definir_modal(id){
    const $targetEl = document.getElementById(id);    
    const options = {
        placement: 'center-center',
        backdrop: 'dynamic',
        backdropClasses:
            'bg-gray-900/50 dark:bg-gray-900/80 fixed inset-0 z-40',
        closable: true        
    };
    const instanceOptions = {
      id: id,
      override: true
    };
    modal = new Modal($targetEl, options, instanceOptions);
}

export function abrir_modal(id, mostrar_informacoes = true){
    definir_modal(id);
    $("#"+id+" .spinner").hide();
    $("#"+id+" .informacoes").show();
    if(mostrar_informacoes == false){
        $("#"+id+" .spinner").show();
        $("#"+id+" .informacoes").hide();
    }    
    modal.show();
}

export function mostrar_informacoes_modal(id){
    $("#"+id+" .spinner").hide();
    $("#"+id+" .informacoes").show();
}

export function fechar_modal(id){
    definir_modal(id);
    modal.hide();
}

export function limpar_inputs_modal(id){
    $("#"+id+" input").val('');
    $("#"+id+" select").val('');
    $("#"+id+" textarea").val('');
}

$(document).on('click', '.fechar_modal', function(){
    let este_modal = $(this).attr("data-modal-hide");
    fechar_modal(este_modal);
});

//MÁSCARAS

$('.cpf').mask('000.000.000-00', { reverse: false });
$('.cep').mask('00000-000', { reverse: false });
$('.cnpj').mask('00.000.000/0000-00', { reverse: false });
$('.telefone').mask('(00) 0000-0000', { reverse: false });
$('.celular').mask('(00) 00000-0000', { reverse: false });
$(".dinheiro").mask('999999999999999990.00', { reverse: true });
$(".cpf_cnpj").keyup(function(){    
    let mascara_cpf = '000.000.000-009';
    let mascara_cnpj = '00.000.000/0000-00';
    let tamanho = $(this).val().length;
    if(tamanho <= 14){
        $(this).mask(mascara_cpf, { reverse:false });
    }else{
        $(this).mask(mascara_cnpj, { reverse:false });
    }
});

//BOTÕES
export function habilitar_botao(id, habilita) {
    let spinner = `<div role="status" class="ms-4 spinner">
                        <svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
                        </svg>                    
                    </div>`;
    if (habilita === true) {
        $("#" + id).attr('disabled', false);
        $("#" + id).find('.spinner').remove();
    } else {
        $("#" + id).attr('disabled', true);
        $("#" + id).append(spinner);
    }
}

//SWEETALERT
export function sucesso(response) {
    if (typeof response == 'string') {
        new Swal({
            title: 'Sucesso!',
            icon: 'success',
            text: response
        });
        return;
    }
    new Swal({
        title: 'Sucesso!',
        icon: 'success',
        text: response.data
    });
}

export function info(response) {
    new Swal({
        title: response,
        icon: 'info',
    });
}

export function erro(error) {
    console.log(error);
    if(error.isAxiosError != true){
        new Swal({
            title: 'Erro!',
            icon: 'error',
            text: error
        });
        return;        
    }    
    let response = error.response;
    console.log(response.request.responseText);
    if (response.status == 500) {
        new Swal({
            title: 'Erro!',
            icon: 'error',
            text: 'Erro interno!'
        });        
        return;
    }    
    if (typeof response.data === 'string') {
        new Swal({
            title: 'Erro!',
            icon: 'error',
            text: response.data
        });
        return;
    }
    let texto = '<ul>';
    for (let i in response.data) {
        texto += '<li>'+response.data[i]+'</li>';
    }
    texto += '</ul>';
    new Swal({
        title: 'Erro!',
        icon: 'error',        
        html: texto
    });
}

//TOM SELECT
export function iniciar_select(id){
    return new TomSelect("#"+id, {
        create: false,
        sortField: {
            field: "text",
            direction: "asc"
        }
    });
}

//FORMATAR DATA
export function formatar_data(data, segundos = true) {    
    const dataObj = new Date(data);
    if (isNaN(dataObj)) {
        return "Data inválida";
    }
    const dia = String(dataObj.getDate()).padStart(2, '0');
    const mes = String(dataObj.getMonth() + 1).padStart(2, '0');
    const ano = dataObj.getFullYear();
    if(segundos){
        const horas = String(dataObj.getHours()).padStart(2, '0');
        const minutos = String(dataObj.getMinutes()).padStart(2, '0');
        const segundos = String(dataObj.getSeconds()).padStart(2, '0');
        return `${dia}/${mes}/${ano} ${horas}:${minutos}:${segundos}`;
    }
    return `${dia}/${mes}/${ano}`;    
}

//RETORNAR O BADGE
export function badge(palavra, cor){
    let badge;
    switch(cor){
        case 'preto': badge = `<span class="bg-gray-100 text-gray-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-gray-700 dark:text-gray-300">${palavra}</span>`; break;
        case 'vermelho': badge = `<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">${palavra}</span>`; break;
        case 'verde': badge = `<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">${palavra}</span>`; break;
        case 'amarelo': badge = `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${palavra}</span>`; break;        
        default: badge = `<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-blue-900 dark:text-blue-300">${palavra}</span>`; break;
    };
    return badge;
}