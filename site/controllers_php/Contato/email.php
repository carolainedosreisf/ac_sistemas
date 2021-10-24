<?php
// Check for empty fields

	
$name = "Carolaine dos Reis";
$email_address = "teste@teste.com";
$message = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";
	
// Create the email and send the message
$to = 'caroldosreis@gmail.com'; // Add your email address inbetween the '' replacing yourname@yourdomain.com - This is where the form will send a message to.
$email_subject = "Contato através do website de:  $name";
$email_body = "Você recebeu uma mensagem através do formulário do site.\n\n"."Aqui estão os detalhes:\n\nNome: $name\n\nEmail: $email_address\n\nMensagem:\n$message";
$headers = "De: naoresponda@caroldosreis.com\n"; 
$headers .= "Responda para: $email_address";	
mail($to,$email_subject,$email_body,$headers);
return true;			
?>