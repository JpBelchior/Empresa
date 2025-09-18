class ListaPaginada {
    constructor() {
        this.config = {
            itensPorPagina: 8,
        };
    }

    /**
     * Função principal: pagina um vetor
     */
    paginarVetor(vetor, itensPorPagina = 8, paginaInicial = 8) {
        if (!Array.isArray(vetor) || vetor.length === 0) {
            return [];
        }

        const paginas = [];
        const totalPaginas = Math.ceil(vetor.length / itensPorPagina);

        for (let i = 0; i < vetor.length; i += itensPorPagina) {
            const paginaAtual = Math.floor(i / itensPorPagina);
            const numeroPaginaReal = paginaInicial + paginaAtual;

            paginas.push({
                itens: vetor.slice(i, i + itensPorPagina),
                numeroPagina: paginaAtual + 1,
                numeroPaginaReal: numeroPaginaReal,
                numeroPaginaExibicao: numeroPaginaReal,
                totalPaginas: totalPaginas,
                indiceInicio: i + 1,
                indiceFim: Math.min(i + itensPorPagina, vetor.length),
                totalItens: vetor.length,
                ehPrimeiraPagina: paginaAtual === 0,
                ehUltimaPagina: paginaAtual === totalPaginas - 1,
            });
        }

        return paginas;
    }

    /**
     * Processa não conformidades que JÁ VEM processadas do Laravel
     * Filtra, ordena por criticidade e renumera sequencialmente
     * @param {Array} respostas - Array de respostas do Laravel (já processadas)
     * @returns {Array} Array de não conformidades paginadas
     */
    processarNaoConformidades(respostas) {
        if (!Array.isArray(respostas) || respostas.length === 0) {
            console.log("📋 Sem respostas para processar não conformidades");
            return [];
        }

        console.log(
            `📋 Processando ${respostas.length} respostas do Laravel...`
        );

        // PASSO 1: Filtrar só não conformidades (vulnerabilidade > 1)
        const naoConformidades = respostas.filter((resposta) => {
            const vulnerabilidade = parseInt(resposta.vulnerabilidade);
            return vulnerabilidade > 1;
        });

        console.log(
            `📋 Filtradas ${naoConformidades.length} não conformidades (vulnerabilidade > 1)`
        );

        // DEBUG: Mostrar todas as criticidades encontradas
        const criticidadesEncontradas = [
            ...new Set(naoConformidades.map((item) => item.criticidade)),
        ];
        console.log(
            `📋 Criticidades encontradas: ${criticidadesEncontradas.join(", ")}`
        );

        if (naoConformidades.length === 0) {
            return [];
        }

        // PASSO 2: Ordenar por criticidade (ordem correta: vermelho-escuro → verde-claro)
        const ordemCriticidade = {
            "vermelho-escuro": 5, // Mais crítico
            laranja: 4, // Alto
            amarelo: 3, // Médio
            "verde-escuro": 2, // Baixo
            "verde-claro": 1, // Menos crítico
        };

        const naoConformidadesOrdenadas = naoConformidades.sort((a, b) => {
            const criticidadeA = ordemCriticidade[a.criticidade] || 0;
            const criticidadeB = ordemCriticidade[b.criticidade] || 0;

            // Se alguma criticidade não foi encontrada no mapeamento, avisar
            if (criticidadeA === 0) {
                console.log(`⚠️  Criticidade não mapeada: "${a.criticidade}"`);
            }
            if (criticidadeB === 0) {
                console.log(`⚠️  Criticidade não mapeada: "${b.criticidade}"`);
            }

            return criticidadeB - criticidadeA; // Maior criticidade primeiro
        });

        console.log(`📋 Ordenação por criticidade aplicada:`);
        naoConformidadesOrdenadas.slice(0, 5).forEach((item, index) => {
            console.log(
                `   ${index + 1}. ${item.criticidade} - ${item.topicos}`
            );
        });
        if (naoConformidadesOrdenadas.length > 5) {
            console.log(
                `   ... e mais ${naoConformidadesOrdenadas.length - 5} itens`
            );
        }

        // PASSO 3: RENUMERAR sequencialmente após ordenação
        const naoConformidadesProcessadas = naoConformidadesOrdenadas.map(
            (item, indice) => {
                return {
                    // === DADOS QUE O LARAVEL JÁ ENVIA ===
                    pilar: item.pilar,
                    vulnerabilidade: item.vulnerabilidade,
                    topicos: item.topicos,
                    criticidade: item.criticidade,
                    recomendacao: item.recomendacao,

                    // === DADOS PROCESSADOS PARA O TEMPLATE ===
                    nc: String(indice + 1).padStart(3, "0"), // NC sequencial após ordenação: 001, 002, 003...
                    naoConformidadeTexto: `${item.topicos} - nível ${item.vulnerabilidade}`,

                    // === DADOS EXTRAS PARA DEBUG ===
                    ncOriginal: item.nc, // NC original do Laravel
                    indiceOrdenado: indice,
                    posicaoOriginal: respostas.findIndex(
                        (r) =>
                            r.topicos === item.topicos &&
                            r.vulnerabilidade === item.vulnerabilidade
                    ), // Para debug: onde estava originalmente
                };
            }
        );

        // Debug: mostrar estatísticas detalhadas
        console.log(`📋 Não conformidades processadas e renumeradas:`);
        console.log(`   - Total: ${naoConformidadesProcessadas.length}`);

        const contagemCriticidade = {};
        naoConformidadesProcessadas.forEach((item) => {
            contagemCriticidade[item.criticidade] =
                (contagemCriticidade[item.criticidade] || 0) + 1;
        });

        // Mostrar contagem na ordem de criticidade
        const ordemExibicao = [
            "Extremo",
            "Alto",
            "Médio",
            "Baixo",
            "Muito Baixo",
        ];
        ordemExibicao.forEach((criticidade) => {
            if (contagemCriticidade[criticidade]) {
                console.log(
                    `   - ${criticidade}: ${contagemCriticidade[criticidade]} itens`
                );
            }
        });

        // Debug: mostrar primeiros 3 NCs atribuídos
        console.log(`📋 Exemplo de NCs atribuídos:`);
        naoConformidadesProcessadas.slice(0, 3).forEach((item) => {
            console.log(
                `   NC ${item.nc}: ${item.criticidade} - ${item.topicos}`
            );
        });

        return naoConformidadesProcessadas;
    }

    /**
     * Calcular qual página começa a lista baseado nas páginas existentes
     */
    calcularPaginaInicialLista(numeroPaginas) {
        const paginas = [
            numeroPaginas.capa || 1,
            numeroPaginas.sumario || 2,
            numeroPaginas.objetivo || 3,
            numeroPaginas.metodologia || 4,
            numeroPaginas.panorama || 5,
            numeroPaginas.resumoExecutivo || 7,
        ];

        const ultimaPagina = Math.max(...paginas.filter((p) => p > 0));
        return ultimaPagina + 1;
    }

    /**
     * Função principal para processar não conformidades do Laravel para o relatório
     */
    processarNaoConformidadesParaRelatorio(dadosRecebidos) {
        console.log("📋 Processando não conformidades para relatório...");

        // Pegar respostas que JÁ VEM processadas do Laravel
        const respostas = dadosRecebidos.dados_modelo?.respostas || [];

        if (respostas.length === 0) {
            console.log("📋 Sem respostas encontradas nos dados recebidos");
            return {
                paginasLista: [],
                totalItens: 0,
                totalPaginas: 0,
                paginaInicial: 0,
                temLista: false,
                tipoLista: "vazio",
            };
        }

        // Processar não conformidades (filtrar + ordenar + renumerar)
        const naoConformidades = this.processarNaoConformidades(respostas);

        if (naoConformidades.length === 0) {
            console.log(
                "📋 Nenhuma não conformidade encontrada (todas são nível 1)"
            );
            return {
                paginasLista: [],
                totalItens: 0,
                totalPaginas: 0,
                paginaInicial: 0,
                temLista: false,
                tipoLista: "sem_nao_conformidades",
            };
        }

        // Calcular paginação
        const numeroPaginas = dadosRecebidos.numeroPaginas || {};
        const paginaInicial = this.calcularPaginaInicialLista(numeroPaginas);
        const paginasLista = this.paginarVetor(
            naoConformidades,
            this.config.itensPorPagina,
            paginaInicial
        );

        console.log(`📋 Não conformidades paginadas:`);
        console.log(`   - ${naoConformidades.length} itens no total`);
        console.log(`   - ${paginasLista.length} páginas geradas`);
        console.log(`   - Começa na página ${paginaInicial}`);
        console.log(
            `   - Primeira página contém NCs: ${
                paginasLista[0]?.itens.map((item) => item.nc).join(", ") ||
                "nenhum"
            }`
        );

        return {
            paginasLista: paginasLista,
            totalItens: naoConformidades.length,
            totalPaginas: paginasLista.length,
            paginaInicial: paginaInicial,
            temLista: true,
            tipoLista: "naoConformidades",
        };
    }
}

// Exportar uma instância única
const listaPaginada = new ListaPaginada();

module.exports = {
    ListaPaginada,
    processarNaoConformidadesParaRelatorio: (dadosRecebidos) =>
        listaPaginada.processarNaoConformidadesParaRelatorio(dadosRecebidos),
};
