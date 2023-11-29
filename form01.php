<?php

    $nome = $_POST['nome'];
    $replyto = $_POST['replyto'];
    $assunto = $_POST['assunto'];

    $para = "guibortolini9@gmail.com";
    $titulo = "Formulário de Contato | Rial Seguros"

    $corpo = "Nome: ".$nome."\n"."Email: ".$replyto."\n"."Assunto: ".$assunto;

    $cabeca = "From: https://rialseguros.com.br"."\n"."Reply-to: ".$replyto."\n"."X=Mailer:PHP/".phpversion();

    if(mail($para,$titulo,$corpo,$cabeca)){
        echo("E-mail enviado com sucesso!");
    }else{
        echo("Houve um erro ao enviar o e-mail!");
    }

?>