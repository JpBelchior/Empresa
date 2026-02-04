import{b as r,e as m}from"./funcoes-vPaU6AKm.js";function f(){$("#projetos").empty(),axios.get(`${app_url}/projetos/lista`).then(s=>{let e=s.data;for(let a in e){let n=e[a].usuarios,d=e[a].tipos_empreendimentos.map(t=>`<span class="px-2 py-1 bg-blue-100 text-blue-800 rounded text-xs">${t.tipo_empreendimento.nome}</span>`).join(""),o="";e[a].formularios&&e[a].formularios.length>0?o=`<p class="font-normal text-gray-700 mb-2">
                                            <span >Formulários:</span> ${e[a].formularios.map(c=>c.nome).join(", ")}
                                         </p>`:o='<p class="font-normal text-gray-500 mb-2 italic">Nenhum formulário cadastrado</p>';let i="";switch(e[a].status){case"Completo":i=`<div class="completo">${e[a].status}</div>`;break;case"Em andamento":i=`<div class="andamento">${e[a].status}</div>`;break}let l="";(atribuicao=="administrador"||atribuicao=="gerente"||atribuicao=="rh")&&(l="editar");let p=`  <div projeto="${e[a].id}" class="${l} w-full mb-3 block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 ">
                                    <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">${e[a].nome} - ${e[a].cliente.nome}</h5>
                                    <p class="font-normal text-gray-700 ">Responsável: ${e[a].usuario_criador.nome}</p>
                                    
                                    ${o}
                                    
                                    <div class="flex justify-between text-gray-700">
                                        <p>Data de início: ${r(e[a].data_inicio,!1)}</p>
                                        <p>Data de conclusão: ${r(e[a].data_conclusao,!1)}</p>
                                    </div>                                                                                
                                    <div class="flex flex-wrap gap-2 text-gray-500 text-sm my-2">
                                        ${n.map(t=>`<span class="px-2 py-1 bg-gray-100 rounded">${t.usuario.nome}</span>`).join("")}
                                    </div>
                                    <div class="flex">
                                        ${d}                        
                                    </div>
                                    <div class="flex justify-center mb-3">
                                        ${i}
                                    </div>
                                    <div class="w-full bg-gray-200 rounded-full h-2.5 ">
                                        <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${e[a].porcentagem_preenchimento}%"></div>
                                    </div>
                                    <div class="flex justify-between">
                                        <p><span>${e[a].total_perguntas_respondidas}/${e[a].total_perguntas} </span> Perguntas</p>
                                        <p>${e[a].porcentagem_preenchimento.toFixed(2)}%</p>
                                    </div>
                                    <div class="flex justify-between">
                                        <p class="text-yellow-500">${e[a].total_vulnerabilidades} vulnerabilidades</p>
                                        <p class="text-red-500">${e[a].total_riscos_altissimos} riscos altíssimos</p>
                                        <p class="text-green-500">${e[a].total_recomendacoes} recomendações</p>
                                    </div>
                                </div>`;$("#projetos").append(p)}}).catch(s=>{m(s)}).finally(()=>{})}export{f as l};
