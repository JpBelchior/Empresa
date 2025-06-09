import{b as u,e as b}from"./funcoes-Duew_XSt.js";function m(){$("#projetos").empty(),axios("projetos/lista").then(o=>{let e=o.data;for(let t in e){let l=e[t].tipos_empreendimentos,i="";for(let a in l){let s=`<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${l[a].tipo_empreendimento.nome}</span>`;i+=s}let n=e[t].usuarios,d="";for(let a in n){let s=`<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">${n[a].usuario.nome}</span>`;d+=s}let r="";(atribuicao=="administrador"||atribuicao=="gerente"||atribuicao=="rh")&&(r=`<button projeto="${e[t].id}" type="button" class=" px-3 py-2 text-xs font-medium text-center inline-flex items-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                        <i class="fas fa-edit"></i>                                    
                                    </button>`),r="";let p=`
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 border-gray-200">                                            
                            <td class="px-6 py-4">
                                ${e[t].nome}                                
                            </td>
                            <td class="px-6 py-4 grid place-items-center">                                
                                ${u(e[t].data_projeto,!1)}                                                                
                            </td>
                            <td class="px-6 py-4">
                                ${i}                                
                            </td>
                            <td class="px-6 py-4">
                                ${d}
                            </td>
                            <td class="px-6 py-4">
                                ${r}                                                            
                            </td>
                        </tr>`;$("#projetos").append(p)}}).catch(o=>{b(o)}).finally(()=>{})}export{m as l};
