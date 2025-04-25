import{e as r}from"./funcoes-C9HBdHmr.js";function p(){$("#empresas").empty(),axios("empresas/lista").then(s=>{let e=s.data;for(let t in e){let a=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${e[t].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${e[t].razao_social}                                
                            </td>
                            <td class="px-6 py-4">
                                ${e[t].cnpj}
                            </td>
                            <td class="px-6 py-4">
                                ${e[t].qtd_usuarios_permitidos}
                            </td>
                            <td class="px-6 py-4">
                                <button empresa="${e[t].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#empresas").append(a)}}).catch(s=>{r(s)}).finally(()=>{})}export{p as l};
