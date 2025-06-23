import { erro, formatar_data } from '../app';

export function lista_projetos() {
    $("#projetos").empty();
    axios('projetos/lista')
        .then(response => {
            let projetos = response.data;                                                
            for (let i in projetos) {
                let funcionarios = projetos[i].usuarios;                
                let lista_funcionarios = "";
                for(let x in funcionarios){
                    let func = `<li>${funcionarios[x].usuario.nome}</li>`;                
                    lista_funcionarios += func;                    
                }
                lista_funcionarios = `<ul class="max-w-md space-y-1 text-gray-500 list-disc list-inside dark:text-gray-400">${lista_funcionarios}</ul>`;
                let tipos_empreendimentos = projetos[i].tipos_empreendimentos;                                
                let tp = "";
                for(let j in tipos_empreendimentos){
                    let t = `<span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-purple-900 dark:text-purple-300">${tipos_empreendimentos[j].tipo_empreendimento.nome}</span>`;                    
                    tp += t;
                }
                let status = projetos[i].status;
                let badge_status = "";
                switch(status){
                    case "Em andamento": badge_status = `<span class="bg-yellow-100 text-yellow-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-yellow-900 dark:text-yellow-300">Em andamento</span>`; break;
                    case "Completo": badge_status = `<span class="bg-green-100 text-green-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm dark:bg-green-900 dark:text-green-300">Completo</span>`; break;
                    default: ""; break;
                }
                let editar = "";
                if(atribuicao == 'administrador' || atribuicao == 'gerente' || atribuicao == 'rh'){
                    editar = `editar`;
                }
                let projeto = `  <div projeto="${projetos[i].id}" class="${editar} w-full mb-3 block p-6 bg-white border border-black-800 rounded-lg shadow-sm hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
                                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">${projetos[i].nome} - ${projetos[i].cliente.nome}</h5>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Responsável: ${projetos[i].usuario_criador.nome}</p>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Data de início: ${formatar_data(projetos[i].data_inicio, false)}</p>
                                        <p class="font-normal text-gray-700 dark:text-gray-400">Data de conclusão: ${formatar_data(projetos[i].data_conclusao, false)}</p>
                                        ${lista_funcionarios}
                                        <div class="flex">
                                        ${tp}                        
                                        </div>
                                        <div class="flex justify-center mb-3">
                                            ${badge_status}
                                        </div>
                                        <div class="w-full bg-gray-200 rounded-full h-2.5 dark:bg-gray-700">
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