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

    $enviaFormularioParaNome = 'Teste';
    $enviaFormularioParaEmail = 'guibortolini9@gmail.com';
    $caixaPostalServidorNome = 'Formulário de contato | Rial Seguros';
    $caixaPostalServidorEmail = 'guibortolini9@gmail.com';
    $caixaPostalServidorSenha = 'dbhnhwitinqfjofl';

    $remetenteNome  = $_POST['nome'];
    $remetenteEmail = $_POST['replyto'];
    $assunto  = $_POST['assunto'];

    $mensagemConcatenada = 'Formulário encaminhado via Rial Seguros'.'<br/>';
    $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
    $mensagemConcatenada .= 'Nome: '.$remetenteNome.'<br/>';
    $mensagemConcatenada .= 'E-mail: '.$remetenteEmail.'<br/>';
    $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
    $mensagemConcatenada .= 'Mensagem: "'.$assunto.'"<br/>';

    $mail = new PHPMailer();

    $mail->IsSMTP();
    $mail->SMTPAuth  = true;
    $mail->Charset   = 'utf8_decode()';
    $mail->Host  = 'smtp.'.substr(strstr($caixaPostalServidorEmail, '@'), 1);
    $mail->Port  = '587';
    $mail->Username  = $caixaPostalServidorEmail;
    $mail->Password  = $caixaPostalServidorSenha;
    $mail->From  = $caixaPostalServidorEmail;
    $mail->FromName  = utf8_decode($caixaPostalServidorNome);
    $mail->IsHTML(true);
    $mail->Subject  = utf8_decode($assunto);
    $mail->Body  = utf8_decode($mensagemConcatenada);
    $mail->AddAddress($enviaFormularioParaEmail,utf8_decode($enviaFormularioParaNome));

    if (!$mail->Send()) {
        $mensagemRetorno = 'Erro ao enviar o formulário: ' . $mail->ErrorInfo;
    } else {
        // Redirecionamento para a página de sucesso
        header("Location: retorno-formulario.html");
        exit(); // Certifique-se de que o código não continue a ser executado após o redirecionamento
    }    
}

?>

