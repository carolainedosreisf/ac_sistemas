<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();
    $cd_evento = $obj['cd_evento'];
    $cd_ingresso = $obj['cd_ingresso'];

    $data = [
        "sn_presenca" => 'S',
    ];

    $update = montaUpdate($data);
    $sql = "UPDATE ingresso SET {$update} WHERE cd_evento = {$cd_evento} AND cd_ingresso = '{$cd_ingresso}'";
    $query = mysqli_query($conexao, $sql);
    
    echo $sql;

?>