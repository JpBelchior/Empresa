import { formatar_data, mesEAnoAtual, erro } from "../app";

$(".estatisticas_load").html(`<svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>`);
$("#resultados_tabela_projetos").empty();
$(document).ready(function () {
    axios.get('usuarios/estatisticas')
        .then(response => {
            let dados = response.data;
            //PROJETOS
            let qtd_projetos = dados.qtd_projetos_mes;
            let total_projetos_criados = dados.total_projetos_criados; 
            let porcentagem_projetos = dados.percentual_projetos;

            $("#icone_card_projetos").html(direcao_seta(porcentagem_projetos));
            $("#numero_absoluto_card_projetos").html(total_projetos_criados); 
            $("#numero_relatorio_card_projetos").html(apresentacao_porcentagem_projetos(porcentagem_projetos));
            //VULNERABILIDADES
            let qtd_vulnerabilidades = dados.qtd_vulnerabilidades_mes;
            let total_vulnerabilidades_geral = dados.total_vulnerabilidades_geral;
            let porcentagem_vulnerabilidades = dados.percentual_vulnerabilidades;
            $("#icone_card_vulnerabilidades").html(direcao_seta_invertida(porcentagem_vulnerabilidades));
            $("#numero_absoluto_card_vulnerabilidades").html(total_vulnerabilidades_geral.toLocaleString());
            $("#numero_relatorio_card_vulnerabilidades").html(apresentacao_porcentagem_vulnerabilidades(porcentagem_vulnerabilidades));
            //RISCOS
          let qtd_riscos = dados.qtd_riscos_mes;
          let total_riscos_geral = dados.total_riscos_geral;
          let porcentagem_riscos = dados.percentual_riscos;

          $("#icone_card_riscos").html(direcao_seta_invertida(porcentagem_riscos));
          $("#numero_absoluto_card_riscos").html(total_riscos_geral.toLocaleString());
          $("#numero_relatorio_card_riscos").html(apresentacao_porcentagem_vulnerabilidades(porcentagem_riscos));
          //RECOMENDAÇÕES
         let qtd_recomendacoes = dados.qtd_recomendacoes_mes;
         let total_recomendacoes_geral = dados.total_recomendacoes_geral; 
         let porcentagem_recomendacoes = dados.percentual_recomendacoes;

         $("#icone_card_recomendacoes").html(direcao_seta(porcentagem_recomendacoes)); 
         $("#numero_absoluto_card_recomendacoes").html(total_recomendacoes_geral.toLocaleString()); 
         $("#numero_relatorio_card_recomendacoes").html(apresentacao_porcentagem_projetos(porcentagem_recomendacoes));
            let lista_projetos = dados.lista_projetos;
            $("#spinner-tabela-projetos").hide();
            for (let i in lista_projetos) {
                let projeto = `<tr class="bg-white border-b border-gray-200">                        
                                <td class="px-6 py-4">
                                    ${lista_projetos[i].nome}
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    ${lista_projetos[i].criador}
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">                                    
                                    ${formatar_data(lista_projetos[i].data_inicio, false)}
                                </td>
                                <td class="px-6 py-4 hidden md:table-cell">
                                    ${formatar_data(lista_projetos[i].data_conclusao, false)}
                                </td>
                                <td class="px-6 py-4">
                                    ${badge_projeto(lista_projetos[i].status)}
                                </td>
                            </tr>`;
                $("#resultados_tabela_projetos").append(projeto);
            }
            let dados_grafico_projetos = dados.grafico_projetos;
            let dados_grafico_riscos = dados.grafico_riscos;
            renderizar_grafico_projetos(dados_grafico_projetos.dias, dados_grafico_projetos.quantidade, dados_grafico_riscos.quantidade);
            $("#grafico_projetos_spinner").hide();
            $("#grafico_projetos").removeClass('hidden');
            let dados_grafico_pilares = dados.grafico_pilares;
            console.log('📊 Dados Pilares:', dados_grafico_pilares);
            renderizar_grafico_pilares(dados_grafico_pilares.pilares, dados_grafico_pilares.estatisticas);
            $("#grafico_pilares_spinner").hide();
            $("#grafico_pilares").removeClass('hidden');
            let dados_grafico_topicos = dados.grafico_topicos;
            renderizar_grafico_topicos(dados_grafico_topicos.topicos, dados_grafico_topicos.quantidade);
            $("#grafico_topicos_spinner").hide();
            $("#grafico_topicos").removeClass('hidden');         
        })
        .catch(error => {
            erro(error);
        })
        .finally(() => {

        })
});

function badge_projeto(status) {
    let badge = "";
    switch (status) {        
        case "Completo": badge = `<div class="completo">${status}</div>`; break;
        case "Em andamento": badge = `<div class="andamento">${status}</div>`; break;        
        default: badge = `<span class="bg-blue-100 text-blue-800 text-xs font-medium me-2 px-2.5 py-0.5 rounded-sm ">${status}</span>`; break;
    }
    return badge;
}

function apresentacao_porcentagem(numero) {
    let elemento = "";
    if (numero > 0) {
        elemento = `+ ${numero.toFixed(2)} %`;
    } else if (numero < 0) {
        elemento = `- ${numero.toFixed(2)} %`;
    }
    return elemento;
}

function direcao_seta(numero) {
    let icone = "";
    if (numero > 0) {
        icone = `<img src="${window.app_url}/images/Seta_alto.png" alt="Seta para cima" class="w-4 h-4">`;
    } else if (numero < 0) {
        icone = `<img src="${window.app_url}/images/Seta_baixo.png" alt="Seta para baixo" class="w-4 h-4">`;
    } else {
        icone = `<i class="fa fa-minus"></i>`; 
    }
    return icone;
}

function direcao_seta_invertida(numero) {
    let icone = "";
    if (numero > 0) {
        
        icone = `<img src="${window.app_url}/images/Seta_baixo.png" alt="↓" class="w-4 h-4">`;
    } else if (numero < 0) {
     
        icone = `<img src="${window.app_url}/images/Seta_alto.png" alt="↑" class="w-4 h-4">`;
    } else {
        icone = `<span class="text-gray-400">—</span>`;
    }
    return icone;
}

function apresentacao_porcentagem_projetos(numero) {
    let valor_absoluto = Math.abs(numero).toFixed(2);
    
    if (numero > 0) {
        return `<span class="text-green-600">${valor_absoluto}%</span> <span class="text-gray-500">a mais que o mês anterior</span>`;
    } else if (numero < 0) {
        return `<span class="text-red-600">${valor_absoluto}%</span> <span class="text-gray-500">a menos que o mês anterior</span>`;
    } else {
        return `<span class="text-gray-500">Igual ao mês anterior</span>`;
    }
}

function apresentacao_porcentagem_vulnerabilidades(numero) {
    let valor_absoluto = Math.abs(numero).toFixed(2);
    
    if (numero > 0) {
        return `<span class="text-red-600">${valor_absoluto}%</span> <span class="text-gray-500">a mais que o mês anterior</span>`;
    } else if (numero < 0) {
        return `<span class="text-green-600">${valor_absoluto}%</span> <span class="text-gray-500">a menos que o mês anterior</span>`;
    } else {
        return `<span class="text-gray-500">Igual ao mês anterior</span>`;
    }
}

function renderizar_grafico_projetos(dias, quantidade_projetos, quantidade_riscos) {
    const ctx = document.getElementById('grafico_projetos').getContext('2d');
    const grafico = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dias, // Dias do mês (1, 2, 3... 31)
            datasets: [{
                label: 'Projetos criados por dia em ' + mesEAnoAtual(), 
                data: quantidade_projetos,
                borderColor: 'rgba(75, 192, 192, 1)',
                fill: false,
                tension: 0.3
            },
            {
                label: 'Riscos dos projetos criados por dia em ' + mesEAnoAtual(), 
                data: quantidade_riscos,
                borderColor: 'red',
                fill: false,
                tension: 0.3
            }]
        },
        options: {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        y: { beginAtZero: true }
    },
    plugins: {
        tooltip: {
            callbacks: {
                title: function(context) {
                    const dia = context[0].label;
                    return 'Dia ' + dia + ' de ' + mesEAnoAtual();
                },
                label: function(context) {
                    const label = context.dataset.label.includes('Risco') 
                        ? 'Riscos dos projetos criados: ' 
                        : 'Projetos criados: ';
                    return label + context.parsed.y;
                }
            }
        }
    }
}
    });
}

function renderizar_grafico_pilares(pilares, estatisticas) {
    const ctx = document.getElementById('grafico_pilares').getContext('2d');

    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: pilares,
            datasets: [{
                label: 'Respostas por pilares em '+mesEAnoAtual(),
                data: estatisticas,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function renderizar_grafico_topicos(topicos, estatisticas) {
    const ctx = document.getElementById('grafico_topicos').getContext('2d');

    const grafico = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: topicos,
            datasets: [{
                label: 'Maiores riscos por tópicos',
                data: estatisticas,
                backgroundColor: [
                    'rgba(54, 162, 235, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 206, 86, 0.7)',
                    'rgba(255, 99, 132, 0.7)'
                ],
                borderColor: [
                    'rgba(54, 162, 235, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(255, 99, 132, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}

function ajustarLarguraCanvas(canvasId) {
    const canvas = document.getElementById(canvasId);
    if (canvas) {
        canvas.width = canvas.parentElement.offsetWidth;
        canvas.height = 250;
    }
}

window.addEventListener('resize', () => {
    ajustarLarguraCanvas('grafico_pilares');
    ajustarLarguraCanvas('grafico_topicos');
    ajustarLarguraCanvas('grafico_projetos');
});

// executar após carregamento inicial
ajustarLarguraCanvas('grafico_pilares');
ajustarLarguraCanvas('grafico_topicos');
ajustarLarguraCanvas('grafico_projetos');
