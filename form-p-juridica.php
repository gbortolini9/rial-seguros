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

        $seguroVida  = $_POST['seguro-vida'];
        $teleMedicina = $_POST['telemedicina'];
        $auxilioFuneral = $_POST['auxilio-funeral'];
        $nomeEmpresa = $_POST['nome-empresa'];
        $emailEmpresa = $_POST['email-empresa'];
        $nomeContato = $_POST['nome-contato'];
        $numeroSegurados = $_POST['numero-segurados'];
        $coberturaExistente = $_POST['cobertura-existente'];
        $formaCapitalSegurado = $_POST['forma-capital-segurado'];
        $capitalMedio = $_POST['capital-medio'];
        $capitalUnico = $_POST['capital-unico'];
        $multiploSalarial = $_POST['m-salarial'];
        $idadeMedia = $_POST['idade-grupo-media'];
        $fatura = $_POST['fatura'];

        //Content
        $mail->isHTML(true);                                        //Set email format to HTML
        $mail->Subject = 'Solicitacao de Cotacao Pessoa Juridica | Rial Seguros';
    
        $mensagemConcatenada = 'Formulário encaminhado via Rial Seguros'.'<br/>';
        $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
        $mensagemConcatenada .= 'Seguro(s) Escolhido(s): (Obs.: Considerar "on" como as opções escolhidas)<br/><br/>';
        $mensagemConcatenada .= 'Seguro de vida: '.$seguroVida.'<br/>';
        $mensagemConcatenada .= 'Telemedicina: '.$teleMedicina.'<br/>';
        $mensagemConcatenada .= 'Auxílio Funeral: '.$auxilioFuneral.'<br/>';
        $mensagemConcatenada .= '------------------------------------------------------<br/><br/>';
        $mensagemConcatenada .= 'Empresa: '.$nomeEmpresa.'<br/>';
        $mensagemConcatenada .= 'E-mail da Empresa: '.$emailEmpresa.'<br/>';
        $mensagemConcatenada .= 'Nome do Contato: '.$nomeContato.'<br/>';
        $mensagemConcatenada .= 'Número de Segurados: '.$numeroSegurados.'<br/>';
        $mensagemConcatenada .= 'Cobertura Existente: '.$coberturaExistente.'<br/>';
        $mensagemConcatenada .= 'Forma de Capital Segurado: '.$formaCapitalSegurado.'<br/>';
        $mensagemConcatenada .= 'Capital Médio: '.$capitalMedio.'<br/>';
        $mensagemConcatenada .= 'Capital Único: '.$capitalUnico.'<br/>';
        $mensagemConcatenada .= 'Múltiplo Salarial: '.$multiploSalarial.'<br/>';
        $mensagemConcatenada .= 'Média de Idade do Grupo: '.$idadeMedia.'<br/>';
        $mensagemConcatenada .= 'Fatura/Pagamento Total Mensal: '.$fatura.'<br/>';

        $body = utf8_decode($mensagemConcatenada);

        $mail->Body    = $body;

        $mail->send();
        header("Location: retorno-formulario.html");
        exit(); // Certifique-se de que o código não continue a ser executado após o redirecionamento
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}