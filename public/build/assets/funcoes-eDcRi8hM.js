import{e as s,b as l}from"./funcoes-TE4sOoC0.js";function p(){$("#formularios").empty(),axios("formularios/lista").then(t=>{let e=t.data;for(let a in e){let r=`  <a href="/formularios/formulario/${e[a].id}" class="w-full block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${e[a].nome}</h5>
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
                                    </a>`;$("#formularios").append(r)}}).catch(t=>{s(t)}).finally(()=>{})}function n(){let t=$("#formulario_id").val();$("#perguntas_respondidas").empty(),axios.get(app_url+"/formularios/respostas/formulario/"+t).then(e=>{$("#qtd_perguntas_respondidas").html(`(${e.data.length})`);let a=e.data;for(let r in a){let o=a[r].arquivo_id==null?"<p>(SEM FOTO)</p>":`<img src="${app_url+"/arquivos/exibir/"+a[r].arquivo_id}">`,i=`<tr class="bg-white dark:bg-gray-800">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${a[r].pergunta.titulo}</p>
                                <p>Resposta: ${a[r].resposta}</p>
                                <p>Responsável: ${a[r].usuario.nome}</p>
                                <p>Momento do cadastro: ${l(a[r].data_cadastro,!0)}</p>                                
                                ${o}                                                                
                                <button id="excluir_resposta${a[r].id}" resposta="${a[r].id}" class="excluir_resposta px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-blue-700 dark:focus:ring-red-800">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>                        
                        </tr>`;$("#perguntas_respondidas").append(i)}}).catch(e=>{s(e)})}export{n as a,p as l};
