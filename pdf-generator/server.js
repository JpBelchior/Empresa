const express = require("express");
const puppeteer = require("puppeteer");
const ejs = require("ejs");
const path = require("path");
const moment = require("moment");
const fs = require("fs"); // ADICIONADO

const app = express();
const PORT = process.env.PORT || 3001;

const {
    calcularPaginasSumario,
    mostrarDetalhamento,
} = require("./utils/paginacao");

// Middleware
app.use(express.json({ limit: "50mb" }));
app.use(express.static("assets"));

app.use("/imagens", express.static(path.join(__dirname, "imagens")));
// Configurar EJS
app.set("view engine", "ejs");
app.set("views", path.join(__dirname, "templates"));

// Rota de teste
app.get("/", (req, res) => {
    res.json({
        status: "PDF Generator Online",
        timestamp: moment().format("DD/MM/YYYY HH:mm:ss"),
    });
});

// Função para converter imagem para base64
function imageToBase64(imagePath) {
    try {
        if (fs.existsSync(imagePath)) {
            const imageData = fs.readFileSync(imagePath);
            const base64 = Buffer.from(imageData).toString("base64");
            const ext = path.extname(imagePath).toLowerCase();
            let mimeType = "image/jpeg";

            if (ext === ".png") mimeType = "image/png";
            else if (ext === ".gif") mimeType = "image/gif";
            else if (ext === ".webp") mimeType = "image/webp";

            return `data:${mimeType};base64,${base64}`;
        }
        return null;
    } catch (error) {
        console.error("❌ Erro ao converter imagem:", error);
        return null;
    }
}

// Rota principal para gerar PDF
app.post("/generate-pdf", async (req, res) => {
    try {
        console.log("📨 Recebendo dados para PDF...");

        const dados = req.body;

        console.log("🔍 DADOS RECEBIDOS DO LARAVEL:");
        console.log("Empresa:", dados.dados?.nome_empresa);
        console.log("Cliente:", dados.dados?.nome_cliente);
        console.log("Objetivo:", dados.dados?.objetivo);
        console.log(
            "Total Perguntas:",
            dados.dados_modelo?.total_perguntas_respondidas
        );
        console.log("Pilares:", dados.dados_modelo?.total_pilares);
        console.log("Percentuais:", dados.dados_modelo?.porcentagem_pilar);
        console.log("Tem imagens:", {
            logo_empresa: dados.imagens?.logo_empresa ? "SIM" : "NÃO",
            logo_cliente: dados.imagens?.logo_cliente ? "SIM" : "NÃO",
        });
        console.log("=====================================");

        // CORREÇÃO DA IMAGEM THALION
        if (!dados.imagens) dados.imagens = {};

        console.log("🔍 Procurando imagem Thalion...");
        const possiveisCaminhos = [
            path.join(__dirname, "imagens", "Thalion.jpg"),
            path.join(__dirname, "imagens", "thalion.jpg"),
            path.join(__dirname, "imagens", "Thalion.jpeg"),
            path.join(__dirname, "imagens", "thalion.jpeg"),
            path.join(__dirname, "imagens", "Thalion.png"),
            path.join(__dirname, "imagens", "thalion.png"),
        ];

        let imagemEncontrada = false;
        for (const caminho of possiveisCaminhos) {
            if (fs.existsSync(caminho)) {
                console.log("✅ Imagem encontrada:", caminho);
                dados.imagens.thalion = imageToBase64(caminho);
                imagemEncontrada = true;
                break;
            }
        }

        if (!imagemEncontrada) {
            console.log(
                "⚠️ Imagem Thalion não encontrada. Verificando pasta imagens..."
            );
            try {
                const imagensDir = path.join(__dirname, "imagens");
                if (fs.existsSync(imagensDir)) {
                    console.log("📁 Conteúdo da pasta imagens:");
                    const arquivos = fs.readdirSync(imagensDir);
                    arquivos.forEach((arquivo) =>
                        console.log(`   - ${arquivo}`)
                    );
                } else {
                    console.log("❌ Pasta 'imagens' não existe!");
                    console.log("📍 Caminho esperado:", imagensDir);
                }
            } catch (error) {
                console.log("❌ Erro ao listar pasta imagens:", error.message);
            }
            dados.imagens.thalion = null;
        }

        console.log(
            "🖼️ Status da imagem thalion:",
            dados.imagens.thalion ? "CARREGADA" : "NÃO ENCONTRADA"
        );

        // DEBUG: Listar todas as imagens disponíveis
        console.log("🔍 TODAS AS IMAGENS DISPONÍVEIS:");
        console.log(
            "- logo_empresa:",
            dados.imagens?.logo_empresa ? "SIM" : "NÃO"
        );
        console.log(
            "- logo_cliente:",
            dados.imagens?.logo_cliente ? "SIM" : "NÃO"
        );
        console.log(
            "- imagem_area:",
            dados.imagens?.imagem_area ? "SIM" : "NÃO"
        );
        console.log("- thalion:", dados.imagens?.thalion ? "SIM" : "NÃO");

        const numeroPaginas = calcularPaginasSumario(
            dados.dados,
            dados.dados_modelo
        );

        console.log("📄 PAGINAÇÃO CALCULADA:");
        Object.entries(numeroPaginas).forEach(([secao, pagina]) => {
            console.log(`${secao}: Página ${pagina}`);
        });
        console.log("=====================================");

        // Processar dados (por enquanto só passamos direto)
        const dadosProcessados = {
            ...dados,
            numeroPaginas,
            dataGeracao: moment().format("DD/MM/YYYY HH:mm:ss"),
            timestamp: Date.now(),
        };

        console.log("🎨 Renderizando template EJS...");

        // Renderizar template EJS
        const html = await ejs.renderFile(
            path.join(__dirname, "templates", "relatorio.ejs"),
            dadosProcessados
        );

        console.log("📄 Gerando PDF com Puppeteer...");

        // Gerar PDF com Puppeteer
        const browser = await puppeteer.launch({
            headless: "new",
            args: ["--no-sandbox", "--disable-setuid-sandbox"],
        });

        const page = await browser.newPage();

        // Configurar página para PDF
        await page.setContent(html, {
            waitUntil: "networkidle0",
            timeout: 30000,
        });

        // Gerar PDF
        const pdf = await page.pdf({
            format: "A4",
            printBackground: true,
            margin: {
                top: "1cm",
                right: "1cm",
                bottom: "1cm",
                left: "1cm",
            },
        });

        await browser.close();

        console.log("✅ PDF gerado com sucesso!");

        // Retornar PDF
        res.set({
            "Content-Type": "application/pdf",
            "Content-Disposition": 'inline; filename="relatorio.pdf"',
            "Content-Length": pdf.length,
        });

        res.send(pdf);
    } catch (error) {
        console.error("❌ Erro ao gerar PDF:", error);
        res.status(500).json({
            error: "Erro ao gerar PDF",
            details: error.message,
        });
    }
});

// Iniciar servidor
app.listen(PORT, () => {
    console.log(`🚀 PDF Generator rodando em http://localhost:${PORT}`);
    console.log(`📄 Teste: http://localhost:${PORT}/test-pdf`);
});

module.exports = app;
