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
                numeroPaginaExibicao: String(numeroPaginaReal).padStart(2, "0"),
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
     * Só precisa: filtrar, ordenar por criticidade e paginar
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

        if (naoConformidades.length === 0) {
            return [];
        }

        // PASSO 2: Ordenar por criticidade (Extremo primeiro, Baixo último)
        const ordemCriticidade = {
            Extremo: 1,
            Alto: 2,
            Médio: 3,
            Baixo: 4,
        };

        const naoConformidadesOrdenadas = naoConformidades.sort((a, b) => {
            const criticidadeA = ordemCriticidade[a.criticidade] || 999;
            const criticidadeB = ordemCriticidade[b.criticidade] || 999;
            return criticidadeA - criticidadeB;
        });

        // PASSO 3: Processar dados para o template
        // Como o Laravel já processou, só precisamos ajustar alguns campos
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
                    nc: String(indice + 1).padStart(3, "0"), // Renumerar sequencial: 001, 002, 003...
                    naoConformidadeTexto: `${item.topicos} - nível ${item.vulnerabilidade}`, // Formato para a tabela

                    // Dados extras para debug
                    ncOriginal: item.nc, // Manter o NC original do Laravel
                    indiceOrdenado: indice,
                };
            }
        );

        // Debug: mostrar estatísticas
        console.log(`📋 Não conformidades processadas:`);
        console.log(`   - Total: ${naoConformidadesProcessadas.length}`);

        const contagemCriticidade = {};
        naoConformidadesProcessadas.forEach((item) => {
            contagemCriticidade[item.criticidade] =
                (contagemCriticidade[item.criticidade] || 0) + 1;
        });

        Object.entries(contagemCriticidade).forEach(
            ([criticidade, quantidade]) => {
                console.log(`   - ${criticidade}: ${quantidade} itens`);
            }
        );

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
            numeroPaginas.resumoExecutivo || 6,
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

        // Processar não conformidades (filtrar + ordenar)
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
