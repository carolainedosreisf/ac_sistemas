<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $id = base64_decode($_GET['id']);
   
    $sql = "SELECT 
                cd_evento
                ,cd_cidade
                ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                ,ds_evento
                ,DATE_FORMAT(dt_evento, '%d/%m/%Y') AS dt_evento
                ,DATE_FORMAT(hr_evento, '%H:%i') AS hr_evento
                ,cd_tipoevento
                ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                ,vl_venda
                ,vl_promocao
                ,sn_cancelado
                ,IFNULL(cd_promocao,0) AS cd_promocao
                ,IF(IFNULL(cd_promocao,0) > 0,vl_promocao,vl_venda) as vl_mostrar
                ,(SELECT ds_promossao FROM promocao AS c WHERE c.cd_promossao = e.cd_promocao) AS nome_promocao
                ,ds_local
                ,ft_caminho
                ,nr_classifi
                ,nr_lotacao
                ,publica
                ,motivo_cancelamento
                ,carga
            FROM evento AS e
            WHERE cd_evento = {$id}";

    $query = mysqli_query($conexao, $sql);
    $item = mysqli_fetch_array($query, MYSQLI_ASSOC);
    
    echo json_encode($item);

?>