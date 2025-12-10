const express = require("express");
const path = require("path");
const moment = require("moment");
const { spawn } = require("child_process");

const app = express();
const PORT = process.env.PORT || 3002;
const HOST = process.env.HOST || "0.0.0.0";

// Middleware - IGUAL AO PDF
app.use(express.json({ limit: "50mb" }));

// Rota de teste - IGUAL AO PDF
app.get("/", (req, res) => {
    res.json({
        status: "PPTX Generator Online",
        timestamp: moment().format("DD/MM/YYYY HH:mm:ss"),
    });
});

// Rota principal - MESMA ESTRUTURA DO PDF
app.post("/generate-pptx", async (req, res) => {
    try {
        console.log("📨 Recebendo dados para PPTX...");

        // IGUAL AO PDF: pegar dados direto
        const dados = req.body;

        console.log("📊 Dados recebidos:");
        console.log("  - Nome empresa:", dados.dados?.nome_empresa);
        console.log("  - Localização:", dados.dados?.localizacao_analise);
        console.log("  - Tem logo?", !!dados.imagens?.logo_empresa);

        console.log("🐍 Gerando PPTX com Python...");

        // Caminho do script Python
        const pythonScript = path.resolve("./generate_ppt.py");

        // Spawn do processo Python
        const python = spawn("python", [pythonScript], {
            stdio: ["pipe", "pipe", "pipe"],
        });

        let pptxBuffer = Buffer.alloc(0);
        let errorOutput = "";

        // Enviar dados JSON para o Python (via stdin)
        python.stdin.write(JSON.stringify(dados), "utf8");
        python.stdin.end();

        // Receber o PPTX (via stdout)
        python.stdout.on("data", (chunk) => {
            pptxBuffer = Buffer.concat([pptxBuffer, chunk]);
        });

        // Capturar erros (via stderr)
        python.stderr.on("data", (data) => {
            const message = data.toString();
            console.log("🐍 Python:", message);
            errorOutput += message;
        });

        // Quando terminar
        python.on("close", (code) => {
            if (code !== 0) {
                console.error("❌ Python retornou erro:", code);
                console.error("Detalhes:", errorOutput);
                return res.status(500).json({
                    error: "Erro ao gerar PPTX",
                    details: errorOutput,
                });
            }

            if (pptxBuffer.length === 0) {
                console.error("❌ PPTX vazio");
                return res.status(500).json({
                    error: "PPTX vazio",
                    details: "Nenhum dado retornado pelo Python",
                });
            }

            console.log("✅ PPTX gerado com sucesso!");
            console.log(`📦 Tamanho: ${pptxBuffer.length} bytes`);

            // RESPOSTA - IGUAL AO PDF (só muda o Content-Type)
            res.set({
                "Content-Type":
                    "application/vnd.openxmlformats-officedocument.presentationml.presentation",
                "Content-Disposition": 'inline; filename="relatorio.pptx"',
                "Content-Length": pptxBuffer.length,
            });

            res.send(pptxBuffer);
        });

        // Erro ao executar Python
        python.on("error", (error) => {
            console.error("❌ Erro ao executar Python:", error);
            res.status(500).json({
                error: "Erro ao executar Python",
                details: error.message,
            });
        });
    } catch (error) {
        console.error("❌ Erro ao gerar PPTX:", error);
        res.status(500).json({
            error: "Erro ao gerar PPTX",
            details: error.message,
        });
    }
});

app.listen(PORT, HOST, () => {
    console.log(`🚀 PPTX Generator rodando em http://${HOST}:${PORT}`);
});

module.exports = app;
