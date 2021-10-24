<?php
    require '../../conexao.php';
    
    $sql = "SELECT 
            cd_fpagto
            ,ds_fpagto
            ,qt_parcela
            ,vl_min
        FROM fpagamento 
        ORDER BY cd_fpagto DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>