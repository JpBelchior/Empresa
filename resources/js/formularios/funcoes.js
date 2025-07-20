import { erro, formatar_data } from '../app';

export function lista_formularios() {
    $("#formularios").empty();
    axios('formularios/lista')
        .then(response => {
            let formularios = response.data;            
            for (let i in formularios) {
                let formulario = `  <a href="/formularios/formulario/${formularios[i].id}" class="mb-4 w-full block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${formularios[i].nome}</h5>
                                        <p class="font-normal text-gray-700">Data de início: ${formatar_data(formularios[i].data_cadastro)}</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${formularios[i].porcentagem_preenchimento}%"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <p><span>${formularios[i].total_perguntas_respondidas}/${formularios[i].total_perguntas} </span> Perguntas</p>
                                            <p>${formularios[i].porcentagem_preenchimento.toFixed(2)}%</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-yellow-500">${formularios[i].total_vulnerabilidades} vulnerabilidades</p>
                                            <p class="text-red-500">${formularios[i].total_riscos_altissimos} riscos altíssimos</p>
                                            <p class="text-green-500">${formularios[i].total_recomendacoes} recomendações</p>
                                        </div>
                                    </a>`;                
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
            let linha = `<tr class="bg-white">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${respostas[i].pergunta.titulo}</p>
                                <p>Resposta: ${respostas[i].resposta}</p>
                                <p>Responsável: ${respostas[i].usuario.nome}</p>
                                <p>Momento do cadastro: ${formatar_data(respostas[i].data_cadastro, true)}</p>                                
                                ${imagem}                                                                
                                <button id="excluir_resposta${respostas[i].id}" resposta="${respostas[i].id}" class="excluir_resposta px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
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