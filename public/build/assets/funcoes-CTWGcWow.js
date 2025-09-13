import{e as n}from"./funcoes-vPaU6AKm.js";function c(){$("#topicos").empty(),axios("topicos/lista").then(e=>{let t=e.data;for(let o in t){let a=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${t[o].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${t[o].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button topico="${t[o].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#topicos").append(a)}}).catch(e=>{n(e)}).finally(()=>{})}function l(e,t){return new Promise((o,i)=>{axios.get("topicos/pesquisar/"+e+"/"+t).then(s=>{o(s.data)}).catch(s=>{i(s)})})}export{c as l,l as p};
