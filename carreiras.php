<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

if (isset($_POST['BTEnvia']) && $_SERVER["REQUEST_METHOD"] === "POST" && isset($_FILES["arquivo"])) {
    $arquivoTemporario = $_FILES["arquivo"]["tmp_name"];
    $nomeDoArquivo = $_FILES["arquivo"]["name"];

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                       //Set the SMTP server to send through
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
        $mail->addAttachment($arquivoTemporario, $nomeDoArquivo);

        $nome  = $_POST['nome'];
        $nascimento = $_POST['nascimento'];
        $idade = $_POST['idade'];
        $sexoCandidato= $_POST['sexo-candidato'];
        $estadoCivil = $_POST['estado-civil'];
        $telefone = $_POST['telefone-celular'];
        $naturalidade = $_POST['naturalidade'];
        $nacionalidade = $_POST['nacionalidade'];
        $rg = $_POST['rg'];
        $expedicao = $_POST['expedicao'];
        $cnh = $_POST['cnh'];
        $peso = $_POST['peso'];
        $ocupacao = $_POST['ocupacao'];
        $nacionalidade = $_POST['nacionalidade'];
        $categoria = $_POST['categoria'];
        $email = $_POST['email'];
        $linkedin = $_POST['linkedin'];
        
        $curriculoAnexo = $_FILES['arquivo'];

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Envio de Curriculo | Rial Seguros';
    
        $mensagemConcatenada = 'Formulário encaminhado via Rial Seguros | Trabalhe Conosco'.'<br/>';
        $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
        $mensagemConcatenada .= 'Nome: '.$nome.'<br/>';
        $mensagemConcatenada .= 'Data de Nascimento: '.$nascimento.'<br/>';
        $mensagemConcatenada .= 'Idade: '.$idade.'<br/>';
        $mensagemConcatenada .= 'Sexo do Candidato: '.$sexoCandidato.'<br/>';
        $mensagemConcatenada .= 'Estado Civil: '.$estadoCivil.'<br/>';
        $mensagemConcatenada .= 'Telefone/Celular: '.$telefone.'<br/>';
        $mensagemConcatenada .= 'Naturalidade: '.$naturalidade.'<br/>';
        $mensagemConcatenada .= 'Nacionalidade: '.$nacionalidade.'<br/>';
        $mensagemConcatenada .= 'RG: '.$rg.'<br/>';
        $mensagemConcatenada .= 'Expedição: '.$expedicao.'<br/>';
        $mensagemConcatenada .= 'CNH: '.$cnh.'<br/>';
        $mensagemConcatenada .= 'Categoria: '.$categoria.'<br/>';
        $mensagemConcatenada .= 'Email: '.$email.'<br/>';
        $mensagemConcatenada .= 'Linkedin: '.$linkedin.'<br/><br/>';

        // Adiciona o conteúdo do currículo como texto no corpo do e-mail
        $mensagemConcatenada .= 'Currículo foi anexado ao e-mail.';

        $body = utf8_decode($mensagemConcatenada);

        $mail->Body    = $body;

        $mail->send();
        header("Location: retorno-formulario.html");
        exit(); // Certifique-se de que o código não continue a ser executado após o redirecionamento
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
