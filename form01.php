<?php

    $nome = ($_POST['nome']);
    $replyto = ($_POST['replyto']);
    $assunto = ($_POST['assunto']);

    $para = "guibortolini9@gmail.com";

    $cabeca = "Reply-to: ".$replyto."\n"."X=Mailer:PHP/".phpversion();

    if(mail($para,$assunto,$cabeca)){
        echo("E-mail enviado com sucesso!");
    }else{
        echo("Houve um erro ao enviar o e-mail!");
    }

?>