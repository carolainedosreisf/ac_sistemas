<?php
    require '../../conexao.php';
    require '../../funcoes.php';
    
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
                ,(SELECT cd_ingresso FROM ingresso AS i WHERE i.cd_evento = e.cd_evento) AS cd_ingresso
            FROM evento AS e
            ORDER BY e.dt_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>