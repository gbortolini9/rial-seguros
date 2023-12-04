<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['BTEnvia'])) {

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'rialcorretoraemail@gmail.com';         //SMTP username
        $mail->Password   = 'emnwalwalgjmioex';                     //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        $mail->SMTPOptions = array(
            'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
            )
            );

        //Recipients
        $mail->setFrom('rialcorretoraemail@gmail.com', 'Site | Rial Reguros');
        $mail->addAddress('rialcorretoraemail@gmail.com', 'Rial Seguros');  //Add a recipient
        $mail->addAddress('contato@rialseguros.com.br');                    //Name is optional
        $mail->addReplyTo('contato@rialseguros.com.br', 'Information');
        $mail->addCC('rialcorretoraemail@gmail.com');

        $remetenteNome  = $_POST['nome'];
        $remetenteEmail = $_POST['replyto'];
        $assunto  = $_POST['assunto'];

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Formulario de contato encaminhado via Rial Seguros';
    
        $mensagemConcatenada = 'Formulário encaminhado via Rial Seguros'.'<br/>';
        $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
        $mensagemConcatenada .= 'Nome: '.$remetenteNome.'<br/>';
        $mensagemConcatenada .= 'E-mail: '.$remetenteEmail.'<br/>';
        $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
        $mensagemConcatenada .= 'Mensagem: "'.$assunto.'"<br/>';

        $body = utf8_decode($mensagemConcatenada);

        $mail->Body    = $body;

        $mail->send();
        header("Location: retorno-formulario.html");
        exit(); // Certifique-se de que o código não continue a ser executado após o redirecionamento
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}