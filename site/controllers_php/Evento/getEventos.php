<?php
    require '../../conexao.php';
    require '../../funcoes.php';
    
    $ocorrido = $_GET['ocorrido'];
    $cd_cadastro = $_GET['cd_cadastro'];
    $filtro = "";

    if($ocorrido){
        $filtro .= " AND IF(CONCAT(dt_evento,' ',e.hr_evento) < NOW(),1,0) = 1";
    }else{
        $filtro .= " AND dt_evento > NOW()";

    }

    $sql = "SELECT 
                e.cd_evento
                ,e.cd_cidade
                ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                ,e.ds_evento
                ,DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                ,DATE_FORMAT(e.hr_evento, '%H:%i') AS hr_evento
                ,e.cd_tipoevento
                ,ifnull(e.cd_promocao,0) AS cd_promocao
                ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                ,e.vl_venda
                ,vl_promocao
                ,IFNULL(e.sn_cancelado,'N') AS sn_cancelado
                ,e.ft_caminho
                ,e.ds_local
                ,e.nr_classifi
                ,e.nr_lotacao
                ,e.dt_evento
                ,IF ((IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_evento = e.cd_evento)
                        ,0) >= e.nr_lotacao),1,0) AS lotado
                ,e.cd_evento
                ,IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_evento = e.cd_evento)
                        ,0) AS qtd_vendas
                ,IFNULL(((SELECT 1 
                             FROM comprait AS i
                             WHERE i.cd_evento = e.cd_evento
                            AND (SELECT cd_cadastro 
                                    FROM compra AS c 
                                    WHERE c.cd_compra = i.cd_compra) = {$cd_cadastro}) AND e.cd_tipoevento = 1),0) AS bloq_academico
            FROM evento AS e
            WHERE IFNULL(e.sn_cancelado,'N') = 'N'
            {$filtro}
            AND publica = 'S'
            ORDER BY e.dt_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>