<?php
    require '../../check_login.php';
    require '../../conexao.php';
    
    $cd_evento = $_GET['cd_evento'];
    $cd_compra = $_GET['cd_compra'];
 
    $sql = "SELECT 
                    cd_ingresso AS nr_lote
                FROM comprait AS a
                WHERE a.cd_compra = {$cd_compra}
                AND a.cd_evento = {$cd_evento}";

    $query = mysqli_query($conexao, $sql);

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    }

    echo json_encode($lista);

?>