<?php
    require '../../conexao.php';
    
    session_start();
    $cd_cadastro = $_SESSION['usuario']['cd_cadastro'];
   
    $sql = "SELECT  
                cd_cadastro
                ,cd_compra
                ,(SELECT ds_fpagto FROM fpagamento AS f WHERE f.cd_fpagto = c.cd_fpagto) AS ds_fpagto
                ,vl_total
                ,DATE_FORMAT(dt_compra, '%d/%m/%Y %H:%i') AS dt_compra_br
                ,(SELECT sum(qt_compra) FROM comprait AS a WHERE a.cd_compra  = c.cd_compra) AS qt_compra
            FROM compra AS c
            WHERE cd_cadastro = {$cd_cadastro}
            ORDER BY dt_compra DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $lista = [];
    $i = 0;
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[$i] = $item;
        $cd_compra = $item['cd_compra'];
        $sql_evento = "SELECT 
                            a.cd_ingresso
                            ,(SELECT b.ds_ingresso FROM ingresso AS b WHERE b.cd_ingresso = a.cd_ingresso) AS ds_ingresso
                            ,(SELECT b.vl_venda FROM ingresso AS b WHERE b.cd_ingresso = a.cd_ingresso) AS vl_venda
                            ,e.cd_evento
                            ,e.cd_cidade
                            ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                            ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                            ,e.ds_evento
                            ,DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                            ,DATE_FORMAT(e.hr_evento, '%H:%i') AS hr_evento
                            ,e.cd_tipoevento
                            ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                            ,IFNULL(e.sn_cancelado,'N') AS sn_cancelado
                            ,e.ft_caminho
                            ,e.ds_local
                            ,IFNULL(e.nr_classifi,0) AS nr_classifi
                            ,a.qt_compra
                            ,IFNULL(e.sn_cancelado,'N') AS sn_cancelado
                            ,e.motivo_cancelamento
                        FROM comprait AS a
                        INNER JOIN evento AS e
                        ON e.cd_evento = (SELECT b.cd_evento 
                                            FROM ingresso AS b 
                                            WHERE b.cd_ingresso = a.cd_ingresso)
                        WHERE a.cd_compra = {$cd_compra}";
        $query_evento = mysqli_query($conexao, $sql_evento);
        while($item_evento = mysqli_fetch_array($query_evento, MYSQLI_ASSOC)){
            $lista[$i]['eventos'][] = $item_evento;
        }
        $i++;
    } 

    echo json_encode($lista);

?>