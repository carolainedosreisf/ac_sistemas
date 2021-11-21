<?php
    require '../../conexao.php';
    
    session_start();
    $cd_cadastro = $_SESSION['usuario']['cd_cadastro'];
   
    $sql = "SELECT  
                cd_cadastro
                ,cd_compra
                ,(SELECT ds_fpagto FROM fpagamento AS f WHERE f.cd_fpagto = c.cd_fpagto) AS ds_fpagto
                ,vl_total
                ,CONCAT(dt_compra,' ',hr_compra) AS dt_compra_
                ,DATE_FORMAT(CONCAT(dt_compra,' ',hr_compra), '%d/%m/%Y %H:%i') AS dt_compra_br
            FROM compra AS c
            WHERE cd_cadastro = {$cd_cadastro}
            ORDER BY 5 DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $i = 0;
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $count = 0;

        $lista[$i] = $item;
        $cd_compra = $item['cd_compra'];
        $sql_evento = "SELECT 
                        a.cd_evento
                        ,a.cd_compra
                        ,SUM(a.vl_compra) as vl_venda
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
                        ,COUNT(*) AS qt_compra
                        ,e.motivo_cancelamento
                        ,SUM(a.vl_compra) AS vl_reembolso
                        ,IF(
                            (SELECT DATE_ADD(concat(e.dt_evento,' ',e.hr_evento), INTERVAL 1 DAY) <= NOW()) 
                            AND IFNULL((SELECT sn_presenca 
                                            FROM ingresso AS i 
                                            WHERE i.cd_ingresso = a.cd_ingresso 
                                            AND i.cd_evento = a.cd_evento 
                                            LIMIT 1),'N') = 'S'
                            ,1,0)  AS mostra_certificado
                        ,IF(e.cd_tipoevento=1,a.cd_ingresso,'') AS nr_lote
                    FROM comprait AS a
                    INNER JOIN evento AS e
                    ON e.cd_evento = a.cd_evento
                    WHERE a.cd_compra = {$cd_compra}
                    GROUP BY a.cd_evento,a.cd_compra,a.vl_compra,e.cd_cidade,e.ds_evento,e.dt_evento,e.hr_evento,e.cd_tipoevento,e.sn_cancelado,e.ft_caminho,e.ds_local,e.nr_classifi,e.motivo_cancelamento";
        
        $query_evento = mysqli_query($conexao, $sql_evento);
        while($item_evento = mysqli_fetch_array($query_evento, MYSQLI_ASSOC)){
            $lista[$i]['eventos'][] = $item_evento;
            $count+= $item_evento['qt_compra'];
        }
        $lista[$i]['qt_compra'] = $count;
        $i++;
    } 

    echo json_encode($lista);

?>