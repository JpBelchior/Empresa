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

function validar_cnpj() {}

function formatar_dinheiro() {}

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