import{e as o,b as l}from"./funcoes-C9HBdHmr.js";function n(){$("#formularios").empty(),axios("formularios/lista").then(a=>{let r=a.data;for(let e in r){let t=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${r[e].nome}
                            </td>
                            <td class="px-6 py-4">
                                ${r[e].projeto.nome}
                            </td>                            
                            <td class="px-6 py-4">
                                <a href="/formularios/interagir/${r[e].id}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-eye"></i>                                    
                                </a>
                                <a href="/formularios/relatorio/${r[e].id}/pdf" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-file-pdf"></i>                                    
                                </a>
                                <a href="/formularios/relatorio/${r[e].id}/excel" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-file-excel"></i>                                    
                                </a>
                            </td>                            
                        </tr>`;$("#formularios").append(t)}}).catch(a=>{o(a)}).finally(()=>{})}function d(){let a=$("#formulario_id").val();$("#perguntas_respondidas").empty(),axios.get(app_url+"/formularios/respostas/formulario/"+a).then(r=>{$("#qtd_perguntas_respondidas").html(`(${r.data.length})`);let e=r.data;for(let t in e){let s=e[t].arquivo_id==null?"<p>(SEM FOTO)</p>":`<img src="${app_url+"/arquivos/exibir/"+e[t].arquivo_id}">`,i=`<tr class="bg-white dark:bg-gray-800">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${e[t].pergunta.titulo}</p>
                                <p>Resposta: ${e[t].resposta}</p>
                                <p>Responsável: ${e[t].usuario.nome}</p>
                                <p>Momento do cadastro: ${l(e[t].data_cadastro,!0)}</p>                                
                                ${s}                                                                
                                <button id="excluir_resposta${e[t].id}" resposta="${e[t].id}" class="excluir_resposta px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-red-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>                        
                        </tr>`;$("#perguntas_respondidas").append(i)}}).catch(r=>{o(r)})}export{d as a,n as l};
