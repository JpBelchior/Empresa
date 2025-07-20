import { erro, formatar_data } from '../app';

export function lista_projetos() {
    $("#projetos").empty();
    axios('projetos/lista')
        .then(response => {
            let projetos = response.data;                                                
            for (let i in projetos) {
                let funcionarios = projetos[i].usuarios;                
                /* let lista_funcionarios = "";
                for(let x in funcionarios){
                    let func = `<li>${funcionarios[x].usuario.nome}</li>`;                
                    lista_funcionarios += func;                    
                }
                lista_funcionarios = `<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside ">${lista_funcionarios}</ul>`; */
                let tipos_empreendimentos = projetos[i].tipos_empreendimentos;                                
                let tp = "";
                for(let j in tipos_empreendimentos){
                    let t = `<span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">${tipos_empreendimentos[j].tipo_empreendimento.nome}</span>`;                    
                    tp += t;
                }
                let status = projetos[i].status;
                let badge_status = "";
                switch(status){                    
                    case "Em andamento": badge_status = `<div class="andamento">${status}</div>`; break;
                    case "Completo": badge_status = `<div class="completo">${status}</div>`; break;
                    default: status ; break;
                }
                let editar = "";
                if(atribuicao == 'administrador' || atribuicao == 'gerente' || atribuicao == 'rh'){
                    editar = `editar`;
                }
                let projeto = `  <div projeto="${projetos[i].id}" class="${editar} w-full mb-3 block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 ">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 ">${projetos[i].nome} - ${projetos[i].cliente.nome}</h5>
                                        <p class="font-normal text-gray-700 ">Responsável: ${projetos[i].usuario_criador.nome}</p>
                                        <div class="flex justify-between text-gray-700">
                                            <p>Data de início: ${formatar_data(projetos[i].data_inicio, false)}</p>
                                            <p>Data de conclusão: ${formatar_data(projetos[i].data_conclusao, false)}</p>
                                        </div>                                                                                
                                        <div class="flex flex-wrap gap-2 text-gray-500 text-sm my-2">
                                            ${funcionarios.map(f => `<span class="px-2 py-1 bg-gray-100 rounded">${f.usuario.nome}</span>`).join("")}
                                        </div>
                                        <div class="flex">
                                        ${tp}                        
                                        </div>
                                        <div class="flex justify-center mb-3">
                                            ${badge_status}
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 ">
                                            <div class="bg-blue-600 h-2.5 rounded-full" style="width: ${projetos[i].porcentagem_preenchimento}%"></div>
                                        </div>
                                        <div class="flex justify-between">
                                            <p><span>${projetos[i].total_perguntas_respondidas}/${projetos[i].total_perguntas} </span> Perguntas</p>
                                            <p>${projetos[i].porcentagem_preenchimento.toFixed(2)}%</p>
                                        </div>
                                        <div class="flex justify-between">
                                            <p class="text-yellow-500">${projetos[i].total_vulnerabilidades} vulnerabilidades</p>
                                            <p class="text-red-500">${projetos[i].total_riscos_altissimos} riscos altíssimos</p>
                                            <p class="text-green-500">${projetos[i].total_recomendacoes} recomendações</p>
                                        </div>
                                    </div>`;                
                $("#projetos").append(projeto);
            }
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {})
}