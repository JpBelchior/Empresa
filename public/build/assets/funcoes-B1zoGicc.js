import{b as r,e as o}from"./funcoes-HOoVbd89.js";function d(){$("#formularios").empty(),axios("formularios/lista").then(s=>{let t=s.data;for(let a in t){let e=`  <a href="/formularios/formulario/${t[a].id}" class="mb-4 w-full block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900">${t[a].nome}</h5>
                                        <p class="font-normal text-gray-700">Data de início: ${r(t[a].data_cadastro)}</p>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${t[a].porcentagem_preenchimento}%"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <p><span>${t[a].total_perguntas_respondidas}/${t[a].total_perguntas} </span> Perguntas</p>
                                            <p>${t[a].porcentagem_preenchimento.toFixed(2)}%</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-yellow-500">${t[a].total_vulnerabilidades} vulnerabilidades</p>
                                            <p class="text-red-500">${t[a].total_riscos_altissimos} riscos altíssimos</p>
                                            <p class="text-green-500">${t[a].total_recomendacoes} recomendações</p>
                                        </div>
                                    </a>`;$("#formularios").append(e)}}).catch(s=>{o(s)}).finally(()=>{})}function p(){let s=$("#formulario_id").val();$("#perguntas_respondidas").empty(),axios.get(app_url+"/formularios/respostas/formulario/"+s).then(t=>{$("#qtd_perguntas_respondidas").html(`(${t.data.length})`);let a=t.data;for(let e in a){let i=a[e].arquivo_id==null?"<p>(SEM FOTO)</p>":`<img src="${app_url+"/arquivos/exibir/"+a[e].arquivo_id}">`,l=`<tr class="bg-white">                        
                            <td class="px-6 py-4">
                                <p>Pergunta: ${a[e].pergunta.titulo}</p>
                                <p>Resposta: ${a[e].resposta}</p>
                                <p>Responsável: ${a[e].usuario.nome}</p>
                                <p>Momento do cadastro: ${r(a[e].data_cadastro,!0)}</p>                                
                                ${i}                                                                
                                <button id="excluir_resposta${a[e].id}" resposta="${a[e].id}" class="excluir_resposta px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>                        
                        </tr>`;$("#perguntas_respondidas").append(l)}}).catch(t=>{o(t)})}export{p as a,d as l};
