import{e as d}from"./funcoes-TE4sOoC0.js";function c(){$("#funcionarios").empty(),axios("funcionarios/lista").then(a=>{let t=a.data;for(let e in t){let s=t[e].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-red-900 dark:text-red-300">Inativo</span>',i=`<button usuario="${t[e].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i class="fas fa-edit"></i>                                    
                                    </button>`;t[e].atribuicao=="rh"&&(i=""),atribuicao=="gerente"&&t[e].atribuicao=="gerente"&&(i="");let n=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                
                            <td class="px-6 py-4">
                                ${s}
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
                                ${i}
                            </td>
                        </tr>`;$("#funcionarios").append(n)}}).catch(a=>{d(a)}).finally(()=>{})}function l(a,t){return new Promise((e,o)=>{axios.get("funcionarios/pesquisar/"+a+"/"+t).then(r=>{e(r.data)}).catch(r=>{o(r)})})}export{c as l,l as p};
