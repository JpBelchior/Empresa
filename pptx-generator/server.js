const express = require("express");
const PptxGenJS = require("pptxgenjs");
const moment = require("moment");

const { calcularPaginasSumario } = require("./utils/paginacao");
const {
    processarNaoConformidadesParaRelatorio,
    processarRecomendacoesParaRelatorio,
} = require("./utils/lista-paginada");

// Importar slides
const criarCapa = require("./slides/capa");

const app = express();
const PORT = process.env.PORT || 3002;

// Middleware para receber JSON
app.use(express.json({ limit: "50mb" }));

// Rota de teste
app.get("/", (req, res) => {
    res.json({
        status: "PPTX Generator Online ✅",
        timestamp: moment().format("DD/MM/YYYY HH:mm:ss"),
    });
});

// Rota para gerar PPTX
app.post("/generate-pptx", async (req, res) => {
    try {
        console.log("📨 Recebendo dados para PPTX...");
        console.log("📊 Dados recebidos:", JSON.stringify(req.body, null, 2));

        const dados = req.body;

        // Calcular paginação
        const numeroPaginas = calcularPaginasSumario(
            dados.dados || {},
            dados.dados_modelo || {}
        );
        console.log("📄 Páginas calculadas:", numeroPaginas);

        // Processar não conformidades e recomendações
        const dadosLista = processarNaoConformidadesParaRelatorio({
            ...dados,
            numeroPaginas,
        });

        const dadosListaRecomendacoes = processarRecomendacoesParaRelatorio({
            ...dados,
            numeroPaginas,
        });

        // Preparar dados completos
        const dadosProcessados = {
            ...dados,
            numeroPaginas,
            dadosLista,
            dadosListaRecomendacoes,
            dataGeracao: moment().format("DD/MM/YYYY HH:mm:ss"),
        };

        console.log("📊 Criando apresentação PPTX...");

        // Criar apresentação
        const pptx = new PptxGenJS();

        // Configurações
        pptx.layout = "LAYOUT_WIDE"; // 16:9
        pptx.author = dados.dados?.nome_empresa || "Análise de Risco";
        pptx.title = "Relatório de Análise de Risco";

        // Gerar arquivo
        const pptxBuffer = await pptx.write({ outputType: "nodebuffer" });

        // Enviar resposta
        res.set({
            "Content-Type":
                "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "Content-Disposition": `attachment; filename="relatorio-${moment().format(
                "YYYY-MM-DD-HH-mm-ss"
            )}.pptx"`,
            "Content-Length": pptxBuffer.length,
        });

        res.send(pptxBuffer);
    } catch (error) {
        console.error("❌ Erro ao gerar PPTX:", error);
        console.error("Stack:", error.stack);
        res.status(500).json({
            error: "Erro ao gerar PPTX",
            details: error.message,
            stack: error.stack,
        });
    }
});

app.listen(PORT, () => {
    console.log(`🚀 PPTX Generator rodando na porta ${PORT}`);
    console.log(`📍 Acesse: http://localhost:${PORT}`);
});
