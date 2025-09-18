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
const { info } = require("console");

const {
    processarNaoConformidadesParaRelatorio,
} = require("./utils/lista-paginada");

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
// Função para carregar todas as imagens automaticamente
function carregarImagensEstaticas(dados) {
    if (!dados.imagens) dados.imagens = {};

    // Definir quais imagens estáticas precisamos carregar
    const imagensEstaticas = {
        cidade: ["cidade.jpg", "cidade.jpeg", "cidade.png"],
        pilares: ["pilares.jpg", "pilares.jpeg", "pilares.png"],
        pessoas: ["pessoas.jpg", "pessoas.jpeg", "pessoas.png"],
        tecnologia: ["tecnologia.jpg", "tecnologia.jpeg", "tecnologia.png"],
        gestao: ["gestao.jpg", "gestao.jpeg", "gestao.png"],
        informacoes: ["informacoes.jpg", "informacoes.jpeg", "informacoes.png"],
        processos: ["processos.jpg", "processos.jpeg", "processos.png"],
    };

    console.log("🔍 Carregando imagens estáticas...");

    // Para cada imagem definida, tentar carregar
    for (const [nomeImagem, possiveisNomes] of Object.entries(
        imagensEstaticas
    )) {
        let imagemEncontrada = false;

        for (const nomeArquivo of possiveisNomes) {
            const caminhoCompleto = path.join(
                __dirname,
                "imagens",
                nomeArquivo
            );

            if (fs.existsSync(caminhoCompleto)) {
                console.log(`✅ ${nomeImagem} encontrada: ${nomeArquivo}`);
                dados.imagens[nomeImagem] = imageToBase64(caminhoCompleto);
                imagemEncontrada = true;
                break;
            }
        }

        if (!imagemEncontrada) {
            console.log(`⚠️ ${nomeImagem} não encontrada`);
            dados.imagens[nomeImagem] = null;
        }
    }

    return dados;
}

// Na rota principal, substitua todo o código de carregamento de imagens por:
app.post("/generate-pdf", async (req, res) => {
    try {
        console.log("📨 Recebendo dados para PDF...");

        const dados = req.body;

        // Log inicial dos dados (manter igual)
        console.log("🔍 DADOS RECEBIDOS DO LARAVEL:");
        console.log("Empresa:", dados.dados?.nome_empresa);
        console.log("Cliente:", dados.dados?.nome_cliente);
        console.log("Objetivo:", dados.dados?.objetivo);

        // CARREGAR IMAGENS (manter igual)
        carregarImagensEstaticas(dados);

        // CALCULAR PÁGINAS (manter igual)
        const numeroPaginas = calcularPaginasSumario(
            dados.dados,
            dados.dados_modelo
        );

        // === 🔥 NOVA LÓGICA: PROCESSAR NÃO CONFORMIDADES ===
        console.log("📋 Processando não conformidades...");

        // Verificar se existem respostas nos dados
        const respostas = dados.dados_modelo?.respostas || [];
        console.log(`📊 Total de respostas recebidas: ${respostas.length}`);

        if (respostas.length > 0) {
            // Log das primeiras respostas para debug
            console.log("📋 Estrutura da primeira resposta:", {
                pilar: respostas[0].pilar,
                vulnerabilidade: respostas[0].vulnerabilidade,
                topicos: respostas[0].topicos,
                criticidade: respostas[0].criticidade,
            });
        }

        // Processar não conformidades
        const dadosLista = processarNaoConformidadesParaRelatorio({
            ...dados,
            numeroPaginas,
        });

        // Log do resultado
        console.log(`📋 Resultado do processamento:`);
        console.log(`   - Tem lista: ${dadosLista.temLista}`);
        console.log(`   - Tipo: ${dadosLista.tipoLista}`);
        console.log(`   - Total itens: ${dadosLista.totalItens}`);
        console.log(`   - Total páginas: ${dadosLista.totalPaginas}`);

        // PREPARAR DADOS COMPLETOS
        const dadosProcessados = {
            ...dados,
            numeroPaginas,
            dadosLista, // Dados das não conformidades paginadas
            dataGeracao: moment().format("DD/MM/YYYY HH:mm:ss"),
            timestamp: Date.now(),
        };

        console.log("🎨 Renderizando template EJS...");

        // RENDERIZAR TEMPLATE (igual)
        const html = await ejs.renderFile(
            path.join(__dirname, "templates", "relatorio.ejs"),
            dadosProcessados
        );

        console.log("📄 Gerando PDF com Puppeteer...");

        // GERAR PDF (igual)
        const browser = await puppeteer.launch({
            headless: "new",
            args: ["--no-sandbox", "--disable-setuid-sandbox"],
        });

        const page = await browser.newPage();

        await page.setContent(html, {
            waitUntil: "networkidle0",
            timeout: 30000,
        });

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

        // Log final
        if (dadosLista.temLista) {
            console.log(
                `📋 Lista de não conformidades incluída: ${dadosLista.totalItens} itens em ${dadosLista.totalPaginas} páginas`
            );
        } else {
            console.log(
                "📋 Nenhuma não conformidade encontrada - relatório sem lista adicional"
            );
        }

        // RESPOSTA (igual)
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
});

module.exports = app;
