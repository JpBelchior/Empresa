import{e as p}from"./funcoes-HOoVbd89.js";function d(){$("#tipos_empreendimentos").empty(),axios("tipos_empreendimentos/lista").then(t=>{let e=t.data;for(let s in e){let o=`
                        <tr class="bg-white border-b border-gray-200">                
                            <td class="px-6 py-4">
                                ${e[s].ativo?'<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Ativo</span>':'<span class="bg-red-100 text-red-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">Inativo</span>'}
                            </td>
                            <td class="px-6 py-4">
                                ${e[s].nome}                                
                            </td>                            
                            <td class="px-6 py-4">
                                <button tipo_empreendimento="${e[s].id}" type="button" class="editar px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 ">
                                    <i class="fas fa-edit"></i>                                    
                                </button>
                            </td>
                        </tr>`;$("#tipos_empreendimentos").append(o)}}).catch(t=>{p(t)}).finally(()=>{})}function m(t,e){return new Promise((s,i)=>{axios.get("tipos_empreendimentos/pesquisar/"+t+"/"+e).then(n=>{s(n.data)}).catch(n=>{i(n)})})}export{d as l,m as p};
