import{e as i}from"./funcoes-CNXYSAtO.js";function p(){$("#usuarios").empty(),axios("usuarios/lista").then(e=>{let t=e.data;for(let s in t){let a=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${t[s].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${t[s].nome}                                
                            </td>
                            <td class="px-6 py-4">
                                ${t[s].cpf_cnpj}                                
                            </td>                            
                            <td class="px-6 py-4">
                                ${t[s].atribuicao}                                
                            </td>                            
                            <td class="px-6 py-4">
                                ${t[s].empresa.razao_social}                                
                            </td>
                            <td class="px-6 py-4">
                                <button usuario="${t[s].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#usuarios").append(a)}}).catch(e=>{i(e)}).finally(()=>{})}export{p as l};
