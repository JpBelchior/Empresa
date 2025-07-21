import{e as o}from"./funcoes-CNXYSAtO.js";function l(){$("#tematicas").empty(),axios("tematicas/lista").then(e=>{let t=e.data;for(let a in t){let n=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${t[a].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${t[a].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button tematica="${t[a].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#tematicas").append(n)}}).catch(e=>{o(e)}).finally(()=>{})}function d(e,t){return new Promise((a,i)=>{axios.get("tematicas/pesquisar/"+e+"/"+t).then(s=>{a(s.data)}).catch(s=>{i(s)})})}export{l,d as p};
