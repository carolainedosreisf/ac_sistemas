<?php
    require '../../conexao.php';
    require '../../funcoes.php';
   
    $sql = "SELECT 
                cd_promocao
                ,ds_promocao
                ,DATE_FORMAT(dt_prazoini, '%d/%m/%Y') AS dt_prazoini_br
                ,DATE_FORMAT(dt_prazofim, '%d/%m/%Y') AS dt_prazofim_br
                ,vl_promocao
                ,IF(
                    IFNULL(CONCAT(dt_prazoini,' 00:00:00'),NOW()) > NOW(),
                    'I',
                    IF(IFNULL(CONCAT(dt_prazofim,' 23:59:59'),NOW()) >= NOW(),
                    'A','I'
                    )) AS status
            FROM promocao AS e
            ORDER BY status ASC,cd_promocao DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $i = 0;
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[$i] = $item;
        $lista[$i]['dt_prazoini'] = $item['dt_prazoini_br'];
        $lista[$i]['dt_prazofim'] = $item['dt_prazofim_br'];
        $i++;
    } 

    echo json_encode($lista);

?>