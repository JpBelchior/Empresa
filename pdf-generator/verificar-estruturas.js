// Salve como: pdf-generator/verificar-estrutura.js
// Execute: node verificar-estrutura.js

const fs = require("fs");
const path = require("path");

console.log("🔍 VERIFICANDO ESTRUTURA DO PROJETO PDF-GENERATOR");
console.log("=".repeat(60));

// 1. Verificar pasta atual
console.log("📁 Pasta atual:", __dirname);

// 2. Verificar arquivos principais
const arquivosPrincipais = [
    "server.js",
    "package.json",
    "templates/relatorio.ejs",
    "templates/components/capa.ejs",
    "templates/components/sumario.ejs",
    "templates/components/objetivo.ejs",
    "imagens/",
    "utils/paginacao.js",
];

console.log("\n📋 VERIFICANDO ARQUIVOS PRINCIPAIS:");
arquivosPrincipais.forEach((arquivo) => {
    const caminho = path.join(__dirname, arquivo);
    const existe = fs.existsSync(caminho);
    const tipo =
        fs.existsSync(caminho) && fs.statSync(caminho).isDirectory()
            ? "📁"
            : "📄";
    console.log(`   ${tipo} ${arquivo}: ${existe ? "✅" : "❌"}`);
});

// 3. Verificar pasta imagens específicamente
const imagensDir = path.join(__dirname, "imagens");
console.log("\n🖼️ VERIFICANDO PASTA IMAGENS:");
console.log("   Caminho:", imagensDir);
console.log("   Existe:", fs.existsSync(imagensDir) ? "✅" : "❌");

if (fs.existsSync(imagensDir)) {
    try {
        const arquivos = fs.readdirSync(imagensDir);
        console.log("   Arquivos encontrados:", arquivos.length);

        if (arquivos.length > 0) {
            console.log("   Listagem:");
            arquivos.forEach((arquivo) => {
                const caminhoCompleto = path.join(imagensDir, arquivo);
                const stats = fs.statSync(caminhoCompleto);
                const tamanho = (stats.size / 1024).toFixed(2);
                console.log(`     - ${arquivo} (${tamanho} KB)`);
            });
        } else {
            console.log("   📝 Pasta vazia - adicione uma imagem Thalion.jpg");
        }
    } catch (error) {
        console.log("   ❌ Erro ao ler pasta:", error.message);
    }
} else {
    console.log("   📝 COMO CRIAR A PASTA E ADICIONAR IMAGEM:");
    console.log("     mkdir pdf-generator/imagens");
    console.log("     # Copie Thalion.jpg para pdf-generator/imagens/");
}

// 4. Verificar imagens específicas
console.log("\n🎯 PROCURANDO IMAGEM THALION:");
const nomesPossiveis = [
    "Thalion.jpg",
    "thalion.jpg",
    "Thalion.jpeg",
    "thalion.jpeg",
    "Thalion.png",
    "thalion.png",
    "Thalion.JPG",
    "Thalion.JPEG",
];

let imagemEncontrada = false;
nomesPossiveis.forEach((nome) => {
    const caminho = path.join(imagensDir, nome);
    const existe = fs.existsSync(caminho);
    console.log(`   ${nome}: ${existe ? "✅ ENCONTRADA" : "❌"}`);
    if (existe && !imagemEncontrada) {
        imagemEncontrada = true;
        const stats = fs.statSync(caminho);
        console.log(
            `     👆 Esta será usada (${(stats.size / 1024).toFixed(2)} KB)`
        );
    }
});

// 5. Testar servidor de imagens
console.log("\n🌐 TESTE MANUAL DO SERVIDOR:");
console.log("   1. Inicie o servidor: node server.js");
console.log("   2. Teste no navegador: http://localhost:3001/");
if (imagemEncontrada) {
    console.log(
        "   3. Teste a imagem: http://localhost:3001/imagens/Thalion.jpg"
    );
}
console.log("   4. Teste o PDF: http://localhost:3001/test-pdf");

// 6. Instruções de correção
if (!imagemEncontrada) {
    console.log("\n🚨 AÇÃO NECESSÁRIA:");
    console.log("   1. Crie a pasta imagens se não existir:");
    console.log("      mkdir pdf-generator/imagens");
    console.log("   2. Adicione uma imagem com nome Thalion.jpg");
    console.log("   3. Reinicie o servidor Node.js");
}

console.log("\n" + "=".repeat(60));
console.log("✅ Verificação concluída!");

// 7. Verificar permissões (opcional)
try {
    const testFile = path.join(__dirname, "test-permissions.tmp");
    fs.writeFileSync(testFile, "test");
    fs.unlinkSync(testFile);
    console.log("📝 Permissões de escrita: ✅");
} catch (error) {
    console.log("📝 Permissões de escrita: ❌", error.message);
}
