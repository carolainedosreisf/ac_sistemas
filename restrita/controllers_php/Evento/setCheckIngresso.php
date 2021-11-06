<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();
    $cd_evento = $obj['cd_evento'];
    $cd_compra = $obj['cd_compra'];
    $seq = $obj['seq'];

    $data = [
        "check_presenca" => 1,
    ];

    $update = montaUpdate($data,['check_presenca']);
    $sql = "UPDATE ingresso SET {$update} WHERE cd_evento = {$cd_evento} AND cd_compra = {$cd_compra} AND seq = {$seq}";
    $query = mysqli_query($conexao, $sql);
    
    echo $query;

?>