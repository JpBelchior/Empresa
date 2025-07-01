import{b as c,e as g}from"./funcoes-DyzI_Slr.js";function b(){$("#projetos").empty(),axios("projetos/lista").then(s=>{let e=s.data;for(let t in e){let i=e[t].usuarios,a="";for(let o in i){let l=`<li>${i[o].usuario.nome}</li>`;a+=l}a=`<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">${a}</ul>`;let n=e[t].tipos_empreendimentos,d="";for(let o in n){let l=`<span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-purple-900 dark:text-purple-300">${n[o].tipo_empreendimento.nome}</span>`;d+=l}let m=e[t].status,r="";switch(m){case"Em andamento":r='<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Em andamento</span>';break;case"Completo":r='<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Completo</span>';break}let p="";(atribuicao=="administrador"||atribuicao=="gerente"||atribuicao=="rh")&&(p="editar");let u=`  <div projeto="${e[t].id}" class="${p} w-full mb-3 block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${e[t].nome} - ${e[t].cliente.nome}</h5>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Responsável: ${e[t].usuario_criador.nome}</p>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Data de início: ${c(e[t].data_inicio,!1)}</p>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Data de conclusão: ${c(e[t].data_conclusao,!1)}</p>
                                        ${a}
                                        <div class="flex">
                                        ${d}                        
                                        </div>
                                        <div class="flex justify-center mb-3">
                                            ${r}
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
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
                                    </div>`;$("#projetos").append(u)}}).catch(s=>{g(s)}).finally(()=>{})}export{b as l};
