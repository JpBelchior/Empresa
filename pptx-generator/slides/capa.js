const theme = require("../styles/theme");

function criarCapa(pptx, dados) {
    const slide = pptx.addSlide();

    // === FUNDO DIVIDIDO ===
    // Lado esquerdo azul (1/3 da tela)
    slide.addShape(pptx.ShapeType.rect, {
        x: 0,
        y: 0,
        w: 3.33, // 1/3 de 10 polegadas
        h: "100%",
        fill: { color: theme.cores.azulPrincipal },
        line: { type: "none" },
    });

    // Lado direito branco (2/3 da tela)
    slide.addShape(pptx.ShapeType.rect, {
        x: 3.33,
        y: 0,
        w: 6.67, // 2/3 de 10 polegadas
        h: "100%",
        fill: { color: theme.cores.branco },
        line: { type: "none" },
    });

    // === CÍRCULOS DECORATIVOS (dentro do slide) ===
    // Círculo grande
    slide.addShape(pptx.ShapeType.ellipse, {
        x: 0.2,
        y: 0.2,
        w: 1.8,
        h: 1.8,
        fill: { transparency: 80 },
        line: { color: theme.cores.branco, width: 2 },
    });

    // Círculo menor dentro
    slide.addShape(pptx.ShapeType.ellipse, {
        x: 0.6,
        y: 0.6,
        w: 1,
        h: 1,
        fill: { color: theme.cores.azulClaro, transparency: 30 },
        line: { type: "none" },
    });

    // === LOGO DA EMPRESA (se existir) ===
    if (dados.imagens?.logo_empresa) {
        slide.addImage({
            data: dados.imagens.logo_empresa,
            x: 8.5,
            y: 0.5,
            w: 1.2,
            h: 1.2,
            sizing: { type: "contain" },
        });
    }

    // === DATA ===
    const dataFormatada =
        dados.dataGeracao?.split(" ")[0] ||
        new Date().toLocaleDateString("pt-BR");
    slide.addText(dataFormatada, {
        x: 4,
        y: 0.8,
        w: 6,
        h: 0.4,
        align: "center",
        fontSize: 20,
        bold: true,
        color: theme.cores.cinzaTexto,
    });

    // === TÍTULO PRINCIPAL ===
    slide.addText("ANÁLISE\nDE RISCO", {
        x: 4,
        y: 1.5,
        w: 6,
        h: 1.5,
        align: "center",
        fontSize: theme.fontes.tituloPrincipal,
        bold: true,
        color: "000000",
    });

    // === SUBTÍTULO ===
    slide.addText(
        "Conformidade e segurança se alcançam com análise de riscos aplicada.",
        {
            x: 4,
            y: 3.2,
            w: 6,
            h: 0.5,
            align: "center",
            fontSize: 14,
            color: theme.cores.cinzaTexto,
        }
    );

    // === INFORMAÇÕES ===
    const yInicio = 3.8;

    // Preparado para:
    slide.addText("Preparado para:", {
        x: 4,
        y: yInicio,
        w: 6,
        h: 0.3,
        fontSize: 16,
        bold: true,
        color: "000000",
    });

    slide.addText(dados.dados?.nome_cliente || "NOME DO CLIENTE", {
        x: 4.3,
        y: yInicio + 0.3,
        w: 5.7,
        h: 0.3,
        fontSize: 14,
        color: theme.cores.cinzaTexto,
    });

    // Elaborado por:
    slide.addText("Elaborado por:", {
        x: 4,
        y: yInicio + 0.6,
        w: 6,
        h: 0.3,
        fontSize: 16,
        bold: true,
        color: "000000",
    });

    slide.addText(dados.dados?.nome_empresa || "NOME DA EMPRESA", {
        x: 4.3,
        y: yInicio + 0.9,
        w: 5.7,
        h: 0.3,
        fontSize: 14,
        color: theme.cores.cinzaTexto,
    });

    // Local (se existir):
    let yFinal = yInicio + 1.2;
    if (dados.dados?.localizacao_analise) {
        slide.addText("Local:", {
            x: 4,
            y: yFinal,
            w: 6,
            h: 0.3,
            fontSize: 16,
            bold: true,
            color: "000000",
        });

        slide.addText(dados.dados.localizacao_analise, {
            x: 4.3,
            y: yFinal + 0.3,
            w: 5.7,
            h: 0.3,
            fontSize: 14,
            color: theme.cores.cinzaTexto,
        });

        yFinal += 0.6;
    }

    // === ESTATÍSTICA DESTAQUE (ajustado para não sobrepor) ===
    const yBox = yFinal + 0.1; // Espaço após último texto

    slide.addShape(pptx.ShapeType.rect, {
        x: 4.5,
        y: yBox,
        w: 5,
        h: 0.7,
        fill: { color: "EFF6FF" }, // bg-blue-50
        line: { color: theme.cores.azulPrincipal, width: 1, type: "solid" },
    });

    slide.addText(
        String(dados.dados_modelo?.total_perguntas_respondidas || 0),
        {
            x: 4.5,
            y: yBox + 0.05,
            w: 5,
            h: 0.35,
            align: "center",
            fontSize: 32,
            bold: true,
            color: theme.cores.azulEscuro,
        }
    );

    slide.addText("ITENS ANALISADOS", {
        x: 4.5,
        y: yBox + 0.4,
        w: 5,
        h: 0.25,
        align: "center",
        fontSize: 11,
        bold: true,
        color: theme.cores.cinzaTexto,
    });

    console.log("✅ Slide CAPA criado");
}

module.exports = criarCapa;
