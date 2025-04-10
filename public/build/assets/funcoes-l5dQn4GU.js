import{e as a}from"./funcoes-BL8f3KCM.js";function i(){$("#formularios").empty(),axios("formularios/lista").then(o=>{let r=o.data;for(let e in r){let t=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${r[e].nome}
                            </td>
                            <td class="px-6 py-4">
                                ${r[e].projeto.nome}
                            </td>
                            <td class="px-6 py-4">
                                ${r[e].tipo_empreendimento.nome}
                            </td>                            
                            <td class="px-6 py-4">
                                <a target="_blank" href="/formularios/interagir/${r[e].id}" class="px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-eye"></i>                                    
                                </a>
                            </td>                            
                        </tr>`;$("#formularios").append(t)}}).catch(o=>{a(o)}).finally(()=>{})}export{i as l};
