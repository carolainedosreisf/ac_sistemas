<?php
    require '../../conexao.php';
    require '../../funcoes.php';
   
    $sql = "SELECT 
                cd_evento
                ,cd_cidade
                ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                ,ds_evento
                ,DATE_FORMAT(dt_evento, '%d/%m/%Y') AS dt_evento_br
                ,DATE_FORMAT(hr_evento, '%H:%i') AS hr_evento
                ,cd_tipoevento
                ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                ,vl_venda
                ,vl_promocao
                ,ifnull(cd_promocao,0) AS cd_promocao
                ,IFNULL(sn_cancelado,'N') AS sn_cancelado
                ,ft_caminho
                ,nr_lotacao
                ,IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_ingresso = (SELECT cd_ingresso 
                                                            FROM ingresso AS i 
                                                            WHERE i.cd_evento = e.cd_evento))
                        ,0) AS qtd_vendas
                ,IF(CONCAT(dt_evento,' ',e.hr_evento) < NOW(),1,0) ocorrido
                ,publica
                ,(IF(CONCAT(dt_evento,' ',e.hr_evento) < NOW(),'S','N')) AS ocorrido
            FROM evento AS e
            ORDER BY cd_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 
    

    echo json_encode($lista);

?>