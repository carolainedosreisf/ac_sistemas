<?php
    require '../../conexao.php';
    require '../../funcoes.php';
   
    $sql = "SELECT 
                cd_promossao
                ,ds_promossao
                ,DATE_FORMAT(dt_prazoini, '%d/%m/%Y') AS dt_prazoini
                ,DATE_FORMAT(dt_prazofim, '%d/%m/%Y') AS dt_prazofim
                ,vl_promossao
            FROM promocao AS e
            ORDER BY dt_prazofim DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>