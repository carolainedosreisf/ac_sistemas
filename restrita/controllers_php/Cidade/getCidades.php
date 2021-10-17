<?php
    require '../../conexao.php';
    require '../../funcoes.php';
    $sql = "SELECT 
            cd_cidade
            ,nm_cidade
            ,uf_cidade
        FROM cidade 
        ORDER BY nm_cidade ASC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>