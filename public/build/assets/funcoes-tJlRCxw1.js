import{e as u}from"./funcoes-vPaU6AKm.js";function p(){$("#funcionarios").empty(),axios("funcionarios/lista").then(i=>{let t=i.data;for(let e in t){let n=t[e].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inativo</span>',s=`<button usuario="${t[e].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                        <i class="fas fa-edit"></i>                                    
                                    </button>`;t[e].atribuicao=="rh"&&(s=""),atribuicao=="gerente"&&t[e].atribuicao=="gerente"&&(s="");let r=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${n}
                            </td>
                            <td class="px-6 py-4">
                                ${t[e].nome}                                
                            </td>
                            <td class="px-6 py-4">
                                ${t[e].cpf_cnpj}                                
                            </td>                            
                            <td class="px-6 py-4">
                                ${t[e].atribuicao}                                
                            </td>                                                        
                            <td class="px-6 py-4">
                                ${s}
                            </td>
                        </tr>`;$("#funcionarios").append(r)}}).catch(i=>{u(i)}).finally(()=>{})}function d(i,t){return new Promise((e,o)=>{axios.get("funcionarios/pesquisar/"+i+"/"+t).then(a=>{e(a.data)}).catch(a=>{o(a)})})}export{p as l,d as p};
