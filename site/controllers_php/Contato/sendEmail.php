<?php
    require '../../funcoes.php';
    require '../../../envia_email.php';

    $obj = getPostAngular();

    $nome = $obj['nome'];
    $email = $obj['email'];
    $assunto = $obj['assunto'];
    $mensagem = $obj['mensagem'];

    $to = 'blablablaeventosempresa@gmail.com'; 
    $email_subject = utf8_decode("Contato através do website de: ".$nome);
    $texto = utf8_decode("
        
    
        <div style='font-size: 16px;line-height: 1.42857143;color: #777;'>
            <div class='bs-callout-default' style='width:80%;padding: 20px;margin: 20px 0;border: 1px solid #eee;border-left-color: #269abc;border-left-width: 5px;border-radius: 3px;'>
                <h3 style='text-align:center;'>
                    Você recebeu uma mensagem através do formulário do site
                </h3>
                <span>
                    <b>Nome: </b>{$nome}<br>
                    <b>Email: </b>{$email} <br>
                    <b>Assunto: </b>{$assunto} <br>
                    <b>Mensagem: </b>{$mensagem} <br>
                </span>
            </div>
        </div>");
        
    $mail->addReplyTo($email, $nome);
    $mail->addAddress($to, 'Empresa contato pelo site');
    $mail->Subject = $email_subject;
    $mail->msgHTML($texto);
    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo 1;
    }

?>