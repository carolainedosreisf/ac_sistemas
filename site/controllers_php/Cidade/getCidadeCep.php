<?php
    require '../../conexao.php';

    $cidade = $_GET['cidade'];
    $uf = $_GET['uf'];

    $sql = "SELECT 
                cd_cidade
            FROM cidade
            WHERE nm_cidade = '{$cidade}' 
            AND uf_cidade = '{$uf}'";

    $query = mysqli_query($conexao, $sql);
    $item = mysqli_fetch_array($query, MYSQLI_ASSOC);

    echo isset($item['cd_cidade'])?$item['cd_cidade']:null

?>