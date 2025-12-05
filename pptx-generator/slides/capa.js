const theme = require("../styles/theme");

function criarCapa(pptx, dados) {
    console.log("  🎨 Iniciando criação da capa...");

    const slide = pptx.addSlide();

    // ===== FUNDO AZUL =====
    slide.background = {
        fill: theme.cores.azulMedio,
    };
    console.log("  ✅ Fundo azul aplicado");

    // ===== LOGO DA EMPRESA (canto superior esquerdo) =====
    if (dados.imagens?.logo_empresa) {
        try {
            slide.addImage({
                data: dados.imagens.logo_empresa,
                x: 0.5,
                y: 0.5,
                w: 1.5,
                h: 1.5,
            });
            console.log("  ✅ Logo da empresa adicionada");
        } catch (error) {
            console.log(
                "  ⚠️ Erro ao adicionar logo da empresa:",
                error.message
            );
        }
    } else {
        console.log("  ⚠️ Logo da empresa não fornecida");
    }

    // ===== DATA (canto inferior esquerdo) =====
    const agora = new Date();
    const mes = agora.toLocaleString("pt-BR", { month: "long" }).toUpperCase();
    const ano = agora.getFullYear().toString();

    // Mês (menor)
    slide.addText(mes, {
        x: 0.5,
        y: 4.8,
        w: 2,
        h: 0.3,
        fontSize: theme.fontes.textoMedio,
        color: theme.cores.branco,
        bold: true,
        fontFace: "Arial",
    });

    // Ano (maior)
    slide.addText(ano, {
        x: 0.5,
        y: 5.1,
        w: 2,
        h: 0.5,
        fontSize: theme.fontes.subtitulo,
        bold: true,
        color: theme.cores.branco,
        fontFace: "Arial",
    });
    console.log(`  ✅ Data adicionada: ${mes} ${ano}`);

    // ===== CÍRCULO DECORATIVO BRANCO (linha curva) =====
    // Este é um círculo grande que fica parcialmente fora do slide
    // criando o efeito de "linha curva" que você vê no template
    slide.addShape(pptx.ShapeType.ellipse, {
        x: 2, // Posição X
        y: -1.5, // Parcialmente acima do slide
        w: 10, // Largura do círculo
        h: 10, // Altura do círculo
        fill: {
            type: "solid",
            color: theme.cores.branco,
            transparency: 100, // 100% transparente = só a borda
        },
        line: {
            color: theme.cores.branco,
            width: 6, // Espessura da linha
            transparency: 0, // Linha opaca
        },
    });
    console.log("  ✅ Círculo decorativo adicionado");

    // ===== TÍTULO PRINCIPAL =====
    slide.addText("Análise de\nRiscos", {
        x: 5.5,
        y: 2.2,
        w: 4,
        h: 1.2,
        fontSize: theme.fontes.titulo,
        bold: true,
        color: theme.cores.branco,
        align: "left",
        fontFace: "Arial",
        lineSpacing: 28, // Espaçamento entre linhas
    });
    console.log("  ✅ Título principal adicionado");

    // ===== LOCALIZAÇÃO (abaixo do título) =====
    const localizacao =
        dados.dados?.localizacao_analise || "LOCALIZAÇÃO DA ANÁLISE";

    slide.addText(localizacao.toUpperCase(), {
        x: 5.5,
        y: 3.6,
        w: 4,
        h: 0.4,
        fontSize: theme.fontes.textoPequeno,
        color: theme.cores.branco,
        align: "left",
        fontFace: "Arial",
    });
    console.log(`  ✅ Localização adicionada: ${localizacao}`);

    // ===== RODAPÉ (site - canto inferior direito) =====
    slide.addText("www.pwrc.com.br", {
        x: 7.5,
        y: 5.0,
        w: 2,
        h: 0.3,
        fontSize: theme.fontes.textoPequeno,
        color: theme.cores.branco,
        align: "right",
        fontFace: "Arial",
    });
    console.log("  ✅ Rodapé adicionado");

    console.log("  🎉 Capa criada com sucesso!");
}

module.exports = criarCapa;
