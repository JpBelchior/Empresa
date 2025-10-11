const express = require("express");
const PptxGenJS = require("pptxgenjs");

const app = express();
app.use(express.json());

// Rota de teste
app.get("/", (req, res) => {
    res.send("Servidor PPTX funcionando! 🚀");
});

// Rota para gerar PPTX simples
app.post("/gerar", async (req, res) => {
    try {
        const { titulo } = req.body;

        // Cria a apresentação
        const pptx = new PptxGenJS();

        // Adiciona um slide
        const slide = pptx.addSlide();

        slide.addText(titulo || "Minha Primeira Apresentação", {
            x: 1,
            y: 2.5,
            w: 8,
            h: 1,
            fontSize: 44,
            bold: true,
            color: "0088CC",
            align: "center",
        });

        // Gera o arquivo
        const buffer = await pptx.write("nodebuffer");

        // Envia para o cliente
        res.setHeader(
            "Content-Type",
            "application/vnd.openxmlformats-officedocument.presentationml.presentation"
        );
        res.setHeader(
            "Content-Disposition",
            'attachment; filename="apresentacao.pptx"'
        );
        res.send(buffer);
    } catch (error) {
        console.error(error);
        res.status(500).json({ error: error.message });
    }
});

const PORT = 3002;
app.listen(PORT, () => {
    console.log(`✅ Servidor rodando em http://localhost:${PORT}`);
});
