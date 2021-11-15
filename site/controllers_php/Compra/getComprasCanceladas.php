<?php
    require '../../conexao.php';
    
    session_start();
    $cancelados = [];
    $cd_cadastro = $_SESSION['usuario']['cd_cadastro'];
    $sql_evento = "SELECT 
                    a.cd_evento
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
                FROM comprait AS a
                INNER JOIN compra AS c 
                ON c.cd_compra = a.cd_compra
                INNER JOIN evento AS e
                ON e.cd_evento = a.cd_evento
                WHERE c.cd_cadastro = {$cd_cadastro}
                AND e.sn_cancelado = 'S' AND IFNULL(a.sn_cancelado,'N') = 'N'
                GROUP BY c.cd_cadastro,a.cd_evento,a.vl_compra,e.cd_cidade,e.ds_evento,e.dt_evento,e.hr_evento,e.cd_tipoevento,e.sn_cancelado,e.ft_caminho,e.ds_local,e.nr_classifi,e.motivo_cancelamento";
        
    $query_evento = mysqli_query($conexao, $sql_evento);
    while($item_evento = mysqli_fetch_array($query_evento, MYSQLI_ASSOC)){
        $cancelados[] = $item_evento;
    }
    echo json_encode($cancelados);
?>

