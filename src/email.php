<?php

namespace Notification;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

class Email {

    private $mail = \stdClass::class;

    public function __construct($host, $userName, $pass, $port, $setFromEmail, $setFromName, $smtpSecure = PHPMailer::ENCRYPTION_STARTTLS, $smtpDebug = SMTP::DEBUG_SERVER){
        $this->mail = new PHPMailer(true); // Inicializa o PHPMailer com exceções ativadas
        $this->mail->SMTPDebug = $smtpDebug; // Habilita a saída de depuração detalhada
        $this->mail->isSMTP(); // Indica que o envio será feito via SMTP
        $this->mail->Host = $host; // Define o servidor SMTP do Gmail
        $this->mail->SMTPAuth = true; // Habilita a autenticação SMTP
        $this->mail->Username = $userName; // Seu e-mail do Gmail
        $this->mail->Password = $pass; // Sua senha do Gmail
        $this->mail->SMTPSecure = $smtpSecure; // Define a criptografia TLS
        $this->mail->Port = $port; // Porta de envio do Gmail
        $this->mail->CharSet = 'UTF-8'; // Define o conjunto de caracteres como UTF-8
        $this->mail->setLanguage('br'); // Define o idioma como português
        $this->mail->isHTML(true); // Indica que o e-mail será em formato HTML
        $this->mail->setFrom( $setFromEmail, $setFromName); // Define o remetente do e-mail
    }

    // metodo para enviar email *** atenção configurar email para nao ter autenticação de 2 formas ***
    public function sendMail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName){
        $this->mail->Subject = (string) $subject;
        $this->mail->Body = $body;
        $this->mail->addReplyTo(  $replyEmail, $replyName);
        $this->mail->addAddress($addressEmail, $addressName);

        try{
            $this->mail->send();
        }catch(Exception $e){
            echo "Erro ao enviar o email:  {$this->mail->ErrorInfo} {$e->getMessage()}";
        }
    }
}
?>