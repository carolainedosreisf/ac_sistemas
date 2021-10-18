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
                ,cd_tipoevento
                ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                ,vl_venda
                ,vl_promocao
                ,IFNULL(sn_cancelado,'N') AS sn_cancelado
                ,ft_caminho
            FROM evento AS e
            ORDER BY dt_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    } 

    echo json_encode($lista);

?>