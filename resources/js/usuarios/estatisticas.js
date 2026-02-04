import { formatar_data, mesEAnoAtual, erro } from "../app";

$(".estatisticas_load").html(`<svg aria-hidden="true" class="inline w-4 h-4 text-gray-200 animate-spin fill-blue-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
    </svg>`);
$("#resultados_tabela_projetos").empty();

// Variáveis globais para controle do gráfico de projetos/riscos
let graficoProjetosInstance = null;
let dadosGraficoProjetos = null;
let dadosGraficoRiscos = null;
let modoAtualGrafico = 'projetos'; // 'projetos' ou 'riscos'

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
            // Armazena dados dos gráficos globalmente
            dadosGraficoProjetos = dados.grafico_projetos;
            dadosGraficoRiscos = dados.grafico_riscos;

            definirPeriodoGrafico();

            // Renderiza gráfico inicial (modo Projetos)
            renderizar_grafico_anual();
            atualizarEstiloBotoes();
            $("#grafico_projetos_spinner").hide();
            $("#container_grafico_projetos").removeClass('hidden');
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

// Event listener para o botão de toggle
$(document).on('click', '#btn_projetos', function() {
    if (modoAtualGrafico === 'projetos') return; // Já está selecionado
    
    modoAtualGrafico = 'projetos';
    atualizarEstiloBotoes();
    renderizar_grafico_anual();
});

$(document).on('click', '#btn_riscos', function() {
    if (modoAtualGrafico === 'riscos') return; // Já está selecionado
    
    modoAtualGrafico = 'riscos';
    atualizarEstiloBotoes();
    renderizar_grafico_anual();
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
function atualizarEstiloBotoes() {
    $('#btn_projetos').toggleClass('ativo', modoAtualGrafico === 'projetos');
    $('#btn_riscos').toggleClass('ativo', modoAtualGrafico === 'riscos');
}

function renderizar_grafico_anual() {
    console.log('🎨 Renderizando gráfico no modo:', modoAtualGrafico);
    
    const canvas = document.getElementById('grafico_projetos');
    const ctx = canvas.getContext('2d');
    
    // Destrói gráfico anterior se existir
    if (graficoProjetosInstance) {
        graficoProjetosInstance.destroy();
    }
    
    // Verificação de segurança
    if (!dadosGraficoProjetos || !dadosGraficoRiscos) {
        console.error('❌ Dados não disponíveis para renderização!');
        return;
    }
    

function criarGradienteAzul(context) {
    const chart = context.chart;
    const {ctx, chartArea, scales} = chart;
    
    if (!chartArea) {
        return 'rgba(59, 130, 246, 0.3)';
    }
    
    // ✅ Pega os dados DIRETAMENTE da variável global
    const valores = dadosGraficoProjetos.quantidade;
    const valorMaximo = Math.max(...valores);
    
    const yScale = scales.y;
    const pixelMaximo = yScale.getPixelForValue(valorMaximo);
    const pixelZero = yScale.getPixelForValue(0);
    
    const gradiente = ctx.createLinearGradient(0, pixelMaximo, 0, pixelZero);
    gradiente.addColorStop(0, 'rgba(59, 130, 246, 0.7)');
    gradiente.addColorStop(0.3, 'rgba(59, 130, 246, 0.5)');
    gradiente.addColorStop(0.7, 'rgba(59, 130, 246, 0.25)');
    gradiente.addColorStop(1, 'rgba(59, 130, 246, 0)');
    
    return gradiente;
}

function criarGradienteVermelho(context) {
    const chart = context.chart;
    const {ctx, chartArea, scales} = chart;
    
    if (!chartArea) {
        return 'rgba(239, 68, 68, 0.3)';
    }
    
   
    const valores = dadosGraficoRiscos.quantidade;
    const valorMaximo = Math.max(...valores);
    
    const yScale = scales.y;
    const pixelMaximo = yScale.getPixelForValue(valorMaximo);
    const pixelZero = yScale.getPixelForValue(0);
    
    const gradiente = ctx.createLinearGradient(0, pixelMaximo, 0, pixelZero);
    gradiente.addColorStop(0, 'rgba(239, 68, 68, 0.7)');
    gradiente.addColorStop(0.3, 'rgba(239, 68, 68, 0.5)');
    gradiente.addColorStop(0.7, 'rgba(239, 68, 68, 0.25)');
    gradiente.addColorStop(1, 'rgba(239, 68, 68, 0)');
    
    return gradiente;
}
    // Configurações dos datasets
    const datasets = [];
    
   if (modoAtualGrafico === 'projetos') {
    // LINHA ATIVA: PROJETOS
    datasets.push({
        label: 'Projetos',
        data: dadosGraficoProjetos.quantidade,
        borderColor: 'rgba(59, 130, 246, 0.9)',       
        backgroundColor: criarGradienteAzul,
        fill: true,
        tension: 0.4,
        borderWidth: 2,                                
        pointRadius: 4,                                
        pointBackgroundColor: 'rgba(59, 130, 246, 0.9)',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointHoverRadius: 6,                           
        pointHoverBackgroundColor: 'rgba(59, 130, 246, 1)',
        pointHoverBorderWidth: 2,
        borderDash: []
    });
    
    // LINHA INATIVA: RISCOS
    datasets.push({
        label: 'Riscos Mapeados',
        data: dadosGraficoRiscos.quantidade,
        borderColor: 'rgba(239, 68, 68, 0.35)',       
        backgroundColor: 'transparent',
        fill: false,
        tension: 0.4,
        borderWidth: 1.5,                            
        pointRadius: 2.5,                             
        pointBackgroundColor: 'rgba(239, 68, 68, 0.35)',
        pointBorderColor: '#fff',
        pointBorderWidth: 1,
        pointHoverRadius: 4,                         
        pointHoverBackgroundColor: 'rgba(239, 68, 68, 0.6)',
        pointHoverBorderWidth: 2,
        borderDash: [5, 5]
    });
} else {
    // LINHA INATIVA: PROJETOS
    datasets.push({
        label: 'Projetos',
        data: dadosGraficoProjetos.quantidade,
        borderColor: 'rgba(59, 130, 246, 0.35)',     
        backgroundColor: 'transparent',
        fill: false,
        tension: 0.4,
        borderWidth: 1.5,                              
        pointRadius: 2.5,                              
        pointBackgroundColor: 'rgba(59, 130, 246, 0.35)',
        pointBorderColor: '#fff',
        pointBorderWidth: 1,
        pointHoverRadius: 4,                          
        pointHoverBackgroundColor: 'rgba(59, 130, 246, 0.6)',
        pointHoverBorderWidth: 2,
        borderDash: [5, 5]
    });
    
    // LINHA ATIVA: RISCOS
    datasets.push({
        label: 'Riscos Mapeados',
        data: dadosGraficoRiscos.quantidade,
        borderColor: 'rgba(239, 68, 68, 0.9)',       
        backgroundColor: criarGradienteVermelho,
        fill: true,
        tension: 0.4,
        borderWidth: 2,                               
        pointRadius: 4,                              
        pointBackgroundColor: 'rgba(239, 68, 68, 0.9)',
        pointBorderColor: '#fff',
        pointBorderWidth: 2,
        pointHoverRadius: 6,                          
        pointHoverBackgroundColor: 'rgba(239, 68, 68, 1)',
        pointHoverBorderWidth: 2,
        borderDash: []
    });
}
    
    graficoProjetosInstance = new Chart(ctx, {
        type: 'line',
        data: {
            labels: dadosGraficoProjetos.meses,
            datasets: datasets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false
            },
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.85)',
                    padding: 12,
                    cornerRadius: 8,
                    titleFont: {
                        size: 14,
                        weight: 'bold'
                    },
                    bodyFont: {
                        size: 13
                    },
                    callbacks: {
                        label: function(context) {
                            return ` ${context.dataset.label}: ${context.parsed.y}`;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            weight: '500',
                            family: 'Archivo'
                        },
                        color: '#6B7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.06)',
                        drawBorder: false
                    },
                    ticks: {
                        font: {
                            size: 12,
                            family: 'Archivo'
                        },
                        padding: 10,
                        precision: 0,
                        color: '#6B7280'
                    }
                }
            }
        }
    });
    
    console.log('✅ Gráfico renderizado com sucesso!');
}

function definirPeriodoGrafico() {
    const hoje = new Date();
    
    // Calcula mês de início (atual - 5)
    const dataInicio = new Date(hoje);
    dataInicio.setMonth(dataInicio.getMonth() - 5);
    const mesInicio = dataInicio.toLocaleString('pt-BR', { month: 'short' }).replace('.', '');
    const anoInicio = dataInicio.getFullYear();
    
    // Calcula mês de fim (atual + 6)
    const dataFim = new Date(hoje);
    dataFim.setMonth(dataFim.getMonth() + 6);
    const mesFim = dataFim.toLocaleString('pt-BR', { month: 'short' }).replace('.', '');
    const anoFim = dataFim.getFullYear();
    
    // Exibe período no formato: Set/2025 – Ago/2026
    $('#periodo_grafico').text(`${mesInicio.charAt(0).toUpperCase() + mesInicio.slice(1)}/${anoInicio} – ${mesFim.charAt(0).toUpperCase() + mesFim.slice(1)}/${anoFim}`);
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
});

// executar após carregamento inicial
ajustarLarguraCanvas('grafico_pilares');
ajustarLarguraCanvas('grafico_topicos');

