<?php
    require '../../conexao.php';

    $id = base64_decode($_GET['id']);
    
    $sql = "SELECT 
            cd_album
            ,cd_evento
            ,ds_album
            ,ft_caminho
        FROM album 
        WHERE cd_evento = {$id}
        ORDER BY cd_album ASC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>