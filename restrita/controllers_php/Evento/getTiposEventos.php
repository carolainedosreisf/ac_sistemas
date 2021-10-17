<?php
    require '../../conexao.php';
    
    $sql = "SELECT 
            cd_tipoevento
            ,ds_evento
        FROM tipoevento 
        ORDER BY cd_tipoevento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>