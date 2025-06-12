import { erro, formatar_data } from '../app';

export function lista_formularios() {
    $("#formularios").empty();
    axios('formularios/lista')
        .then(response => {
            let formularios = response.data;            
            for (let i in formularios) {
                let formulario = `  <a href="/formularios/formulario/${formularios[i].id}" class="w-full block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${formularios[i].nome}</h5>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Data de início: 11/11/1111</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <p><span>11/11 </span> Perguntas</p>
                                            <p>2%</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-yellow-500">V</p>
                                            <p class="text-red-500">V</p>
                                            <p class="text-green-500">V</p>
                                        </div>
                                    </a>`;
                /* let formulario = `
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${formularios[i].nome}
                            </td>
                            <td class="px-6 py-4">
                                ${formularios[i].projeto.nome}
                            </td>                            
                            <td class="px-6 py-4">
                                <a href="/formularios/interagir/${formularios[i].id}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-eye"></i>                                    
                                </a>
                                <a href="/formularios/relatorio/${formularios[i].id}/pdf" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-file-pdf"></i>                                    
                                </a>
                                <a href="/formularios/relatorio/${formularios[i].id}/excel" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-file-excel"></i>                                    
                                </a>
                            </td>                            
                        </tr>`; */
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
            let imagem = respostas[i].arquivo_id == null ? "<p>(SEM FOTO)</p>" : `<img src="${app_url+"/arquivos/exibir/"+respostas[i].arquivo_id}">`;
            let linha = `<tr class="bg-white dark:bg-gray-800">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${respostas[i].pergunta.titulo}</p>
                                <p>Resposta: ${respostas[i].resposta}</p>
                                <p>Responsável: ${respostas[i].usuario.nome}</p>
                                <p>Momento do cadastro: ${formatar_data(respostas[i].data_cadastro, true)}</p>                                
                                ${imagem}                                                                
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