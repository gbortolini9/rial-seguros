<?php

    $nome = addcslashes($_POST['nome']);
    $replyto = addcslashes($_POST['replyto']);
    $assunto = addcslashes($_POST['assunto']);

    $para = "guibortolini9@gmail.com";

    $corpo = "Nome: ".$nome."\n"."E-mail: ".$email."\n"."Assunto: ".$assunto."\n".;

    $cabeca = "From: karyne1402@gmail.com"."\n"."Reply-to: ".$replyto."\n"."X=Mailer:PHP/".phpversion();

    if(mail($para,$assunto,$corpo,$cabeca)){
        echo("E-mail enviado com sucesso!");
    }else{
        echo("Houve um erro ao enviar o e-mail!");
    }

?>