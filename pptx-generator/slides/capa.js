const theme = require("../styles/theme");

function criarCapa(pptx, dados) {
    const slide = pptx.addSlide();

    // FUNDO: Gradiente azul claro → azul escuro
    slide.background = {
        fill: "0066CC",
    };

    // LOGO (canto superior esquerdo)
    if (dados.imagens?.logo_empresa) {
        slide.addImage({
            data: dados.imagens.logo_empresa,
            x: 0.5,
            y: 0.5,
            w: 1.5,
            h: 1.5,
        });
    }

    // DATA (canto inferior esquerdo)
    slide.addText("OUTUBRO", {
        x: 0.5,
        y: 4.8,
        w: 2,
        h: 0.3,
        fontSize: 14,
        color: "FFFFFF",
    });

    slide.addText("2025", {
        x: 0.5,
        y: 5.1,
        w: 2,
        h: 0.5,
        fontSize: 36,
        bold: true,
        color: "FFFFFF",
    });

    // LINHA BRANCA CURVA (borda de elipse grande que corta o fundo)
    slide.addShape(pptx.ShapeType.ellipse, {
        x: 1,
        y: -2,
        w: 12,
        h: 12,
        fill: { type: "none" },
        line: { color: "FFFFFF", width: 6 },
    });

    // TÍTULO (à direita da linha)
    slide.addText("Análise de\nRiscos", {
        x: 5.5,
        y: 2.2,
        w: 4,
        h: 1.2,
        fontSize: 48,
        bold: true,
        color: "FFFFFF",
        align: "left",
    });

    // LOCALIZAÇÃO (embaixo do título)
    const loc = dados.dados?.localizacao_analise || "LOCALIZAÇÃO DA ANÁLISE";
    slide.addText(loc.toUpperCase(), {
        x: 5.5,
        y: 3.6,
        w: 4,
        h: 0.4,
        fontSize: 14,
        color: "FFFFFF",
        align: "left",
    });

    console.log("✅ Capa criada");
}

module.exports = criarCapa;
