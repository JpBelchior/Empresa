<?php

use Illuminate\Support\Facades\Log;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function validar_cpf($cpf)
{
    // Remove caracteres não numéricos
    $cpf = preg_replace('/[^0-9]/', '', $cpf);

    // Verifica se o CPF tem 11 dígitos
    if (strlen($cpf) !== 11 || preg_match('/^(\d)\1{10}$/', $cpf)) {
        return false;
    }

    // Cálculo do primeiro dígito verificador
    $soma = 0;
    for ($i = 0; $i < 9; $i++) {
        $soma += intval($cpf[$i]) * (10 - $i);
    }
    $resto = $soma % 11;
    $digito1 = $resto < 2 ? 0 : 11 - $resto;

    // Cálculo do segundo dígito verificador
    $soma = 0;
    for ($i = 0; $i < 10; $i++) {
        $soma += intval($cpf[$i]) * (11 - $i);
    }
    $resto = $soma % 11;
    $digito2 = $resto < 2 ? 0 : 11 - $resto;

    // Compara os dígitos verificadores com os últimos dois dígitos do CPF
    return $cpf[9] == $digito1 && $cpf[10] == $digito2;
}

function validar_email($email)
{
    return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
}

function enviar_email($email_destinatario, $assunto, $html)
{
    $mail = new PHPMailer(true);
    try {
        $mail->CharSet = 'UTF-8';
        $mail->isSMTP();        
        $mail->Host = env('EMAIL_COMERCIAL_SMTP_SERVER');
        $mail->SMTPAuth = true;
        $mail->Username = env('EMAIL_COMERCIAL');
        $mail->Password = env('EMAIL_COMERCIAL_PASSWORD');
        $mail->SMTPSecure = 'ssl';
        $mail->Port = env('EMAIL_COMERCIAL_PORT');
        $fromEmail = env('EMAIL_COMERCIAL');
        $mail->setFrom($fromEmail, env('EMAIL_COMERCIAL'));        
        $mail->addAddress($email_destinatario);
        $mail->isHTML(true);
        $mail->Subject = $assunto;        
        $mail->Body = $html;
        return $mail->send();
    } catch (Exception $e) {
        Log::error("Erro ao enviar e-mail: {$e->getMessage()}");
        return false;
    }
}

function nome_mes($numero){
    $meses = [
        '01' => 'janeiro',
        '02' => 'fevereiro',
        '03' => 'março',
        '04' => 'abril',
        '05' => 'maio',
        '06' => 'junho',
        '07' => 'julho',
        '08' => 'agosto',
        '09' => 'setembro',
        '10' => 'outubro',
        '11' => 'novembro',
        '12' => 'dezembro'
    ];
    return $meses[$numero];
}

function validar_cnpj($cnpj) {
    // Remove caracteres não numéricos
    $cnpj = preg_replace('/[^0-9]/', '', $cnpj);

    // Verifica se tem 14 dígitos
    if (strlen($cnpj) != 14) {
        return false;
    }

    // Evita CNPJs com todos os números iguais (ex.: 00000000000000)
    if (preg_match('/(\d)\1{13}/', $cnpj)) {
        return false;
    }

    // Cálculo dos dígitos verificadores
    $peso1 = [5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];
    $peso2 = [6, 5, 4, 3, 2, 9, 8, 7, 6, 5, 4, 3, 2];

    // Verifica o primeiro dígito verificador
    for ($t = 0, $soma = 0; $t < 12; $t++) {
        $soma += $cnpj[$t] * $peso1[$t];
    }
    $resto = $soma % 11;
    $digito1 = ($resto < 2) ? 0 : 11 - $resto;

    // Verifica o segundo dígito verificador
    for ($t = 0, $soma = 0; $t < 13; $t++) {
        $soma += $cnpj[$t] * $peso2[$t];
    }
    $resto = $soma % 11;
    $digito2 = ($resto < 2) ? 0 : 11 - $resto;

    // Confirma se os dígitos verificadores estão corretos
    return $cnpj[12] == $digito1 && $cnpj[13] == $digito2;
}

function validar_cpf_cnpj($termo){
    if(validar_cpf($termo) || validar_cnpj($termo)){
        return true;
    }
    return false;
}

function pegarIpUsuario() {
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        // IP de clientes que utilizam proxy
        return $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        // IPs de proxies
        return $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        // IP direto do usuário
        return $_SERVER['REMOTE_ADDR'];
    }
}

function formatar_data($dataHora)
{    
    $data = new DateTime($dataHora);
    return $data->format('d/m/Y H:i:s');
}