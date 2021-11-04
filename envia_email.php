<?php
    date_default_timezone_set('Etc/UTC');
    require 'PHPMailer-master/PHPMailerAutoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    //$mail->SMTPDebug = 2;
    $mail->Debugoutput = 'html';
    $mail->Host = 'smtp.gmail.com';
    $mail->Port = 587;
    $mail->SMTPSecure = 'tls';
    $mail->SMTPAuth = true;
    $mail->Username = "blablablaeventosempresa@gmail.com";
    $mail->Password = "12345678*a";
    $mail->setFrom('blablablaeventosempresa@gmail.com', 'Blablabla Eventos');
    $mail->addReplyTo('blablablaeventosempresa@gmail.com', 'Blablabla Eventos');
?>