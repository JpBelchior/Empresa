import{e as i}from"./funcoes-CNXYSAtO.js";function d(){$("#empresas").empty(),axios("empresas/lista").then(s=>{let t=s.data;for(let e in t){let a=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${t[e].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${t[e].razao_social}                                
                            </td>
                            <td class="px-6 py-4">
                                ${t[e].cnpj}
                            </td>
                            <td class="px-6 py-4">
                                ${t[e].qtd_usuarios_permitidos}
                            </td>
                            <td class="px-6 py-4">
                                <button empresa="${t[e].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#empresas").append(a)}}).catch(s=>{i(s)}).finally(()=>{})}export{d as l};
