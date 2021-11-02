<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data = [
        "ds_album" => isset($obj['ds_album'])?$obj['ds_album']:"",
        "ft_caminho" => $obj['ft_caminho'],
        "cd_evento" => base64_decode($obj['cd_evento']),
    ];

    $insert = montaInsert($data,['cd_evento']);
    $sql = "INSERT INTO album ({$insert['colunas']}) VALUES ({$insert['valores']})";
    $query = mysqli_query($conexao, $sql);
    
    
    echo $query;

?>