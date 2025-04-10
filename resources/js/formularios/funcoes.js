import { erro, formatar_data } from '../app';

export function lista_formularios() {
    $("#formularios").empty();
    axios('formularios/lista')
        .then(response => {
            let formularios = response.data;            
            for (let i in formularios) {                                                                
                let formulario = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${formularios[i].nome}
                            </td>
                            <td class="px-6 py-4">
                                ${formularios[i].projeto.nome}
                            </td>
                            <td class="px-6 py-4">
                                ${formularios[i].tipo_empreendimento.nome}
                            </td>                            
                            <td class="px-6 py-4">
                                <a target="_blank" href="/formularios/interagir/${formularios[i].id}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-eye"></i>                                    
                                </a>
                            </td>                            
                        </tr>`;
                $("#formularios").append(formulario);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}

export function lista_respostas(){        
    let formulario = $("#formulario_id").val();
    $("#perguntas_respondidas").empty();
    axios.get(app_url+'/formularios/respostas/formulario/'+formulario)
    .then(response => {
        $("#qtd_perguntas_respondidas").html(`(${response.data.length})`);        
        let respostas = response.data;                
        for(let i in respostas){
            let linha = `<tr class="bg-white dark:bg-gray-800">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${respostas[i].pergunta.titulo}</p>
                                <p>Resposta: ${respostas[i].resposta}</p>
                                <p>Responsável: ${respostas[i].usuario.nome}</p>
                                <p>Momento do cadastro: ${formatar_data(respostas[i].data_cadastro, true)}</p>                                
                                <button id="excluir_resposta${respostas[i].id}" resposta="${respostas[i].id}" class="excluir_resposta px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-red-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>                        
                        </tr>`;
            $("#perguntas_respondidas").append(linha);
        }
    })
    .catch(error => {
        erro(error);
    });
}

export function pesquisar_formulario(parametro, valor) {
    return new Promise((resolve, reject) => {
    axios.get('funcionarios/pesquisar/'+parametro+"/"+valor)
        .then(response => {
            resolve(response.data);
        })
        .catch(error => {
            reject(error);
        });
    });
}