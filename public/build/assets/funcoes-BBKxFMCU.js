import{b as d,e as u}from"./funcoes-CNXYSAtO.js";function b(){$("#projetos").empty(),axios("projetos/lista").then(a=>{let e=a.data;for(let t in e){let p=e[t].usuarios,l=e[t].tipos_empreendimentos,r="";for(let i in l){let m=`<span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">${l[i].tipo_empreendimento.nome}</span>`;r+=m}let s=e[t].status,o="";switch(s){case"Em andamento":o=`<div class="andamento">${s}</div>`;break;case"Completo":o=`<div class="completo">${s}</div>`;break}let n="";(atribuicao=="administrador"||atribuicao=="gerente"||atribuicao=="rh")&&(n="editar");let c=`  <div projeto="${e[t].id}" class="${n} w-full mb-3 block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 ">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">${e[t].nome} - ${e[t].cliente.nome}</h5>
                                        <p class="font-normal text-gray-700 ">Responsável: ${e[t].usuario_criador.nome}</p>
                                        <div class="flex justify-between text-gray-700">
                                            <p>Data de início: ${d(e[t].data_inicio,!1)}</p>
                                            <p>Data de conclusão: ${d(e[t].data_conclusao,!1)}</p>
                                        </div>                                                                                
                                        <div class="flex flex-wrap gap-2 text-gray-500 text-sm my-2">
                                            ${p.map(i=>`<span class="px-2 py-1 bg-gray-100 rounded">${i.usuario.nome}</span>`).join("")}
                                        </div>
                                        <div class="flex">
                                        ${r}                        
                                        </div>
                                        <div class="flex justify-center mb-3">
                                            ${o}
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 ">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${e[t].porcentagem_preenchimento}%"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <p><span>${e[t].total_perguntas_respondidas}/${e[t].total_perguntas} </span> Perguntas</p>
                                            <p>${e[t].porcentagem_preenchimento.toFixed(2)}%</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-yellow-500">${e[t].total_vulnerabilidades} vulnerabilidades</p>
                                            <p class="text-red-500">${e[t].total_riscos_altissimos} riscos altíssimos</p>
                                            <p class="text-green-500">${e[t].total_recomendacoes} recomendações</p>
                                        </div>
                                    </div>`;$("#projetos").append(c)}}).catch(a=>{u(a)}).finally(()=>{})}export{b as l};
