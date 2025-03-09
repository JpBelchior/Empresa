<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">        
</head>
<body>
    <h1>Recuperação de Senha</h1>
    <p>Olá, {{ $nome }}</p>
    <p>Você solicitou a redefinição de sua senha. Clique no link abaixo para redefini-la:</p>
    <a href="{{ $link }}">Clique aqui</a>
    <p>Seu link será válido por 10 minutos!</p>
    <p>Momento da solicitação: {{ $momento_solicitacao }}</p>
    <p>Momento da expiração do link: {{ $momento_expiracao }}</p>
    <p>Atenciosamente,<br>{{ getenv("APP_NAME") }}</p>
</body>
</html>