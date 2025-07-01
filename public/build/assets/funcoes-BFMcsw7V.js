import{e as i}from"./funcoes-DyzI_Slr.js";function p(){$("#topicos").empty(),axios("topicos/lista").then(e=>{let t=e.data;for(let o in t){let r=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${t[o].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${t[o].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button topico="${t[o].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#topicos").append(r)}}).catch(e=>{i(e)}).finally(()=>{})}function c(e,t){return new Promise((o,a)=>{axios.get("topicos/pesquisar/"+e+"/"+t).then(s=>{o(s.data)}).catch(s=>{a(s)})})}export{p as l,c as p};
