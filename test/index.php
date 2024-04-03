<?php
require __DIR__ . '/../lib_notif_ext/autoload.php';
// Importando a classe
use Notification\Email;

// Parâmetros de configuração padrão do e-mail
$host = 'sandbox.smtp.mailtrap.io';
$userName = 'c3ef84959449c0';
$pass = 'c4d4041ab395df';
$port = 2525;
$setFromEmail = 'brunoglobalnegocios@gmail.com';
$setFromName = 'Bruno Vieira';
$smtpSecure = 'tls';
$smtpDebug = 0;

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtém os valores dos campos do formulário
    $host = $_POST['host'] ?? $host;
    $userName = $_POST['userName'] ?? $userName;
    $pass = $_POST['pass'] ?? $pass;
    $port = $_POST['port'] ?? $port;
    $setFromEmail = $_POST['setFromEmail'] ?? $setFromEmail;
    $setFromName = $_POST['setFromName'] ?? $setFromName;
    $smtpSecure = $_POST['smtpSecure'] ?? $smtpSecure;
    $smtpDebug = $_POST['smtpDebug'] ?? $smtpDebug;

    // Obtém os valores dos campos para enviar o e-mail
    $subject = $_POST['subject'] ?? 'Assunto Padrão';
    $body = $_POST['body'] ?? 'Corpo do E-mail Padrão';
    $replyEmail = $_POST['replyEmail'] ?? $setFromEmail;
    $replyName = $_POST['replyName'] ?? $setFromName;
    $addressEmail = $_POST['addressEmail'] ?? null;
    $addressName = $_POST['addressName'] ?? null;

    
    // Instanciando a classe Email com os novos parâmetros do formulário
    $novoEmail = new Email($host, $userName, $pass, $port, $setFromEmail, $setFromName, $smtpSecure, $smtpDebug);
    // Chamando o método sendMail() com os valores do formulário
    $novoEmail->sendMail($subject, $body, $replyEmail, $replyName, $addressEmail, $addressName);
    // Verifica se o endereço de e-mail do destinatário está definido

    if (!$addressEmail) {
        echo "Erro: Preencha as configurações de Destinatario.";
        echo "<br><button onclick='history.back()'>Voltar</button>";
        exit; // Encerra a execução do script
    }

    if ($novoEmail) {
        echo "Email: Enviado com sucesso !!!.";
        echo "<br><button onclick='history.back()'>Voltar</button>";
        exit; // Encerra a execução do script
    } else {
        echo "Erro ao enviar email: ";
        echo "<br><button onclick='history.back()'>Voltar</button>";
        exit; // Encerra a execução do script
    }
}

?>


<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enviar E-mail</title>
    <link href="./cover.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body class="d-flex h-100 text-bg-dark">
    <div class="container mt-2 w-100">
        
        <header class="mb-3 pb-3 text-center">    
            <h1>Pagina Demostrativa.</h1>
            <p class="lead">Essa biblioteca é projetada para enviar e-mails utilizando a biblioteca 
                <a class="btn btn-sm btn-light fw-bold border-white" href="https://packagist.org/packages/phpmailer/phpmailer" >
                    phpMailer
                </a>. 
                    Executar essa ação de maneira descomplicada é essencial para qualquer sistema. Foi criado um Email ficticio no 
                <a class="btn btn-sm btn-light fw-bold border-white" href="https://mailtrap.io/">
                    Mailtrap
                </a>
            </p>
        </header>

        <main class="px-3">   
            <div class="mb-auto">                   
                <nav class="nav nav-masthead text-white justify-content-center" id="myTab" role="tablist">

                    <a class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-0 active" id="config-tab" data-bs-toggle="pill" data-bs-target="#config" type="button" role="tab" aria-controls="config" aria-selected="true">Configurações de E-mail</button>
                    </a>
                    <a class="nav-item" role="presentation">
                        <button class="nav-link fw-bold py-1 px-0" id="send-tab" data-bs-toggle="pill" data-bs-target="#send" type="button" role="tab" aria-controls="send" aria-selected="false">Enviar E-mail Para</button>
                    </a>
                </nav>
            </div>

            <div class="tab-content mb-3" id="myTabContent">
                <div class="tab-pane fade show active" id="config" role="tabpanel" aria-labelledby="config-tab">
                    <form action="" method="post">
                        <div class="row mb-3">
                            <div class="form-group col-3">
                                <label for="host">Host:</label>
                                <input type="text" class="form-control" id="host" name="host" value="<?php echo $host; ?>">
                            </div>
                            <div class="form-group col-3">
                                <label for="userName">Nome de Usuário:</label>
                                <input type="text" class="form-control" id="userName" name="userName" value="<?php echo $userName; ?>">
                            </div>
                            <div class="form-group col-3">
                                <label for="pass">Senha:</label>
                                <input type="password" class="form-control" id="pass" name="pass" value="<?php echo $pass; ?>">
                            </div>
                            <div class="form-group col-3">
                                <label for="port">Porta:</label>
                                <input type="text" class="form-control" id="port" name="port" value="<?php echo $port; ?>">
                            </div>
                        </div>
                        <div class="row mb-4">                    
                            <div class="form-group col-3">
                                <label for="setFromEmail">E-mail do Remetente:</label>
                                <input type="email" class="form-control" id="setFromEmail" name="setFromEmail" value="<?php echo $setFromEmail; ?>">
                            </div>
                            <div class="form-group col-3">
                                <label for="setFromName">Nome do Remetente:</label>
                                <input type="text" class="form-control" id="setFromName" name="setFromName" value="<?php echo $setFromName; ?>">
                            </div>
                            <div class="form-group col-3">
                                <label for="smtpSecure">Criptografia:</label>
                                <input type="text" class="form-control" id="smtpSecure" name="smtpSecure" value="<?php echo $smtpSecure; ?>">
                            </div>
                            <div class="form-group col-3 mb-3">
                                <label for="smtpDebug">Debug:</label>
                                <input type="text" class="form-control" id="smtpDebug" name="smtpDebug" value="<?php echo $smtpDebug; ?>">
                            </div>
                        </div>    
                        <p class="fw-bold border-white fs-5">
                            Preencha o destinatario "Enviar E-mail Para"                         
                        </p>
                    </form>
                </div>
                <div class="tab-pane fade" id="send" role="tabpanel" aria-labelledby="send-tab">
                    <form action="" method="post">
                    <div class="row mb-3">                        
                        <div class="form-group col-3">
                            <label for="addressEmail">E-mail do Destinatário:</label>
                            <input type="email" class="form-control" id="addressEmail" name="addressEmail">
                        </div>
                        <div class="form-group col-3">
                            <label for="addressName">Nome do Destinatário:</label>
                            <input type="text" class="form-control" id="addressName" name="addressName">
                        </div>
                        <div class="form-group col-3">
                            <label for="replyEmail">E-mail de Resposta:</label>
                            <input type="email" class="form-control" id="replyEmail" name="replyEmail">
                        </div>
                        <div class="form-group col-3">
                            <label for="replyName">Nome de Resposta:</label>
                            <input type="text" class="form-control" id="replyName" name="replyName">
                        </div>
                    </div>
                    <div class="row mb-3">                        
                            <div class="form-group col-3">
                            <label for="subject">Assunto:</label>
                            <input type="text" class="form-control" id="subject" name="subject">
                        </div>
                        <div class="form-group col-9 mb-3">
                            <label for="body">Corpo do E-mail:</label>
                            <textarea class="form-control " rows="1" id="body" name="body" placeholder="Digite aqui seu texto"></textarea>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-primary">Enviar E-mail</button>
                    </form>
                </div>
            </div>
        </main>

        <footer class="mt-auto text-end text-white-50 mt-3 px-3">
            <p>Bruno Vieira <a href="https://www.linkedin.com/in/li2/" class="text-white">Linkedin</a>.</p>
        </footer>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
</body>
</html>