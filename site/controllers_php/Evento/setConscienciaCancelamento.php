<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $dados = getPostAngular();
    $cd_compra = $dados['cd_compra'];
    $cd_evento = $dados['cd_evento'];

    $data = [
        "consciencia_cancelamento" => 1
    ];

    $update = montaUpdate($data,['consciencia_cancelamento']);
    $sql = "UPDATE comprait SET {$update} WHERE cd_compra = {$cd_compra} AND cd_evento = {$cd_evento}";
    $query = mysqli_query($conexao, $sql);

    echo $sql;
?>