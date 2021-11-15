<?php
    require '../../conexao.php';
    require '../../funcoes.php';
    require '../../../envia_email.php';

    $obj = getPostAngular();
    $cd_evento = $obj['cd_evento'];
    $clientes = [];

    $data = [
        "sn_cancelado" => 'S',
        "motivo_cancelamento" => $obj['motivo_cancelamento']
    ];

    $update = montaUpdate($data);
    $sql_ = "UPDATE evento SET {$update} WHERE cd_evento = {$cd_evento}";
    $query_ = mysqli_query($conexao, $sql_);

    if($query_==1){
        $sql = "SELECT 
                    c.nm_cadastro
                    ,c.ed_email
                    ,SUM(item.vl_compra) AS vl_reembolso
                    ,CONCAT(DATE_FORMAT(e.dt_evento, '%d/%m/%Y'),' ',DATE_FORMAT(e.hr_evento, '%H:%i')) AS dt_evento
                    ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                    ,e.ds_evento
                    ,e.motivo_cancelamento
                FROM comprait AS item
                INNER JOIN cadastro AS c ON c.cd_cadastro = (SELECT cd_cadastro FROM compra AS i WHERE i.cd_compra = item.cd_compra)
                INNER JOIN evento as e ON e.cd_evento = item.cd_evento
                WHERE e.cd_evento = {$cd_evento}
                GROUP BY c.nm_cadastro,c.ed_email,item.vl_compra,e.dt_evento,e.hr_evento,e.cd_tipoevento,e.ds_evento,e.motivo_cancelamento,  c.cd_cadastro, item.cd_evento";
        
        $query = mysqli_query($conexao, $sql);

        while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $clientes[] = $item;
            $valor = number_format($item['vl_reembolso'],2,",",".");
            $to = 'caroldosreis97@gmail.com'; 
            //$to = $item['ed_email']; 
            $email_subject = utf8_decode("Blablabla Eventos avisa: O evento {$item['ds_evento']} ({$item['nome_tipo_evento']}) foi cancelado -----");
            $texto = utf8_decode("<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta http-equiv='X-UA-Compatible' content='IE=edge'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <link rel='preconnect' href='https://fonts.googleapis.com'>
                <link rel='preconnect' href='https://fonts.gstatic.com' crossorigin>
                <link href='https://fonts.googleapis.com/css2?family=Zen+Antique&display=swap' rel='stylesheet'>
                <link href='https://fonts.googleapis.com/css2?family=Roboto&family=Zen+Antique&display=swap' rel='stylesheet'>
            </head>
            <body style='font-size: 16px;line-height: 1.42857143;color: #777;font-family: 'Roboto', sans-serif'>
                <div class='bs-callout-default' style='width:70%;padding: 20px;margin: 20px 0;border: 1px solid #eee;border-left-color: #d9534f;border-left-width: 5px;border-radius: 3px;'>
                    <h3 style='text-align:center;font-family: 'Zen Antique', serif;'>Aviso!</h3>
                    <span>
                        <i>Olá {$item['nm_cadastro']}, o evento que voce comprou foi cancelado, EM BREVE VOCÊ SERÁ REEMBOLSADO!</i><br><br>
                        <b>Evento: </b>{$item['ds_evento']} ({$item['nome_tipo_evento']}) <br>
                        <b>Data Evento: </b>{$item['dt_evento']}<br>
                        <b>Valor a ser reembolsado: </b>R$ {$valor} <br>
                        <b>Motivo do cancelamento: </b>{$item['motivo_cancelamento']}
                    </span>
                </div>
            </body>
            </html>
            ");
            $mail->addReplyTo('blablablaeventosempresa@gmail.com', 'Blablabla Eventos');
            $mail->addAddress($to, 'Empresa contato pelo site');
            $mail->Subject = $email_subject;
            $mail->msgHTML($texto);
            $mail->send();
        } 
    }

    echo $query_;

?>