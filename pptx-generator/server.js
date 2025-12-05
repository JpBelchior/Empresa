const express = require("express");
const PptxGenJS = require("pptxgenjs");
const moment = require("moment");


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
        version: "1.0.0 - Capa Only"
    });
});

// Rota para gerar PPTX
app.post("/generate-pptx", async (req, res) => {
    try {
        console.log("📨 Recebendo dados para PPTX...");
        console.log("📊 Dados recebidos:");
        console.log("  - Nome empresa:", req.body.dados?.nome_empresa);
        console.log("  - Nome cliente:", req.body.dados?.nome_cliente);
        console.log("  - Localização:", req.body.dados?.localizacao_analise);
        console.log("  - Tem logo empresa?", !!req.body.imagens?.logo_empresa);

        const dados = req.body;

        console.log("📊 Criando apresentação PPTX...");

        // Criar apresentação
        const pptx = new PptxGenJS();

        // Configurações básicas
        pptx.layout = "LAYOUT_WIDE"; // 16:9
        pptx.author = dados.dados?.nome_empresa || "Análise de Risco";
        pptx.title = "Relatório de Análise de Risco";

        // 🎨 CRIAR APENAS A CAPA
        console.log("📄 Criando slide: Capa");
        criarCapa(pptx, dados);

        // Gerar arquivo
        console.log("💾 Gerando arquivo PPTX...");
        const pptxBuffer = await pptx.write({ outputType: "nodebuffer" });

        console.log("✅ PPTX gerado com sucesso!");
        console.log(`📦 Tamanho: ${pptxBuffer.length} bytes`);

        // Enviar resposta
        res.set({
            "Content-Type":
                "application/vnd.openxmlformats-officedocument.presentationml.presentation",
            "Content-Disposition": `attachment; filename="relatorio-capa-${moment().format(
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

const HOST = process.env.HOST || "0.0.0.0";

app.listen(PORT, HOST, () => {
    console.log(`🚀 PPTX Generator rodando em http://${HOST}:${PORT}`);
    console.log(`📍 Testando: http://${HOST}:${PORT}`);
    console.log(`🎯 Endpoint: POST http://${HOST}:${PORT}/generate-pptx`);
});