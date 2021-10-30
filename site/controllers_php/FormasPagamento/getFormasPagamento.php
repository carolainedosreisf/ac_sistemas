<?php
    require '../../conexao.php';

    $valor_min = $_GET['valor_min'];
    
    $sql = "SELECT 
            cd_fpagto
            ,ds_fpagto
            ,IFNULL(qt_parcela,1) AS qt_parcela
            ,vl_min
        FROM fpagamento 
        WHERE IFNULL(vl_min,0) <= {$valor_min}
        ORDER BY cd_fpagto DESC";
    $query = mysqli_query($conexao, $sql);
    $lista = [];
    
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>