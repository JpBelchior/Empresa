// Cálculo de paginação para PPTX (baseado no PDF)
function calcularPaginasSumario(dados, dados_modelo) {
    const numeroPaginas = {};
    let paginaAtual = 1;

    // Capa = slide 1
    numeroPaginas.capa = paginaAtual++;

    // Sumário = slide 2
    numeroPaginas.sumario = paginaAtual++;

    // Objetivo = slide 3
    numeroPaginas.objetivo = paginaAtual++;

    // Metodologia = slide 4
    numeroPaginas.metodologia = paginaAtual++;

    // Panorama = slide 5
    numeroPaginas.panorama = paginaAtual++;

    // Resumo Executivo = slide 6
    numeroPaginas.resumoExecutivo = paginaAtual++;

    // Resumo Executivo Detalhado = slide 7
    numeroPaginas.resumoExecutivo1 = paginaAtual++;

    // Não Conformidades (começa no slide 8)
    numeroPaginas.naoConformidades = paginaAtual;

    // Calcular quantos slides de NC teremos (8 itens por slide)
    const respostas = dados_modelo?.respostas || [];
    const naoConformidades = respostas.filter(
        (r) => parseInt(r.vulnerabilidade) > 1
    );
    const slidesNC = Math.ceil(naoConformidades.length / 8);
    paginaAtual += slidesNC;

    // Recomendações (após NC)
    numeroPaginas.recomendacoes = paginaAtual;

    return numeroPaginas;
}

module.exports = {
    calcularPaginasSumario,
};
