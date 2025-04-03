import{b as i,e as u}from"./funcoes-BL8f3KCM.js";function b(){$("#projetos").empty(),axios("projetos/lista").then(o=>{let e=o.data;for(let t in e){let l=e[t].tipos_empreendimentos,a="";for(let r in l){let s=`<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${l[r].tipo_empreendimento.nome}</span>`;a+=s}let n=e[t].usuarios,d="";for(let r in n){let s=`<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${n[r].usuario.nome}</span>`;d+=s}let p=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                                            
                            <td class="px-6 py-4">
                                ${e[t].nome}                                
                            </td>
                            <td class="px-6 py-4 grid place-items-center">                                
                                ${i(e[t].data_projeto,!1)}                                                                
                            </td>
                            <td class="px-6 py-4">
                                ${a}                                
                            </td>
                            <td class="px-6 py-4">
                                ${d}
                            </td>
                            <td class="px-6 py-4">
                                <button projeto="${e[t].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#projetos").append(p)}}).catch(o=>{u(o)}).finally(()=>{})}export{b as l};
