<?php
    require 'site/conexao.php';
    require 'site/funcoes.php';

    $sql = "SELECT 
            cd_evento
            ,ifnull(cd_promocao,0) AS cd_promocao
            ,vl_venda
            ,vl_promocao
            ,ds_evento
        FROM evento AS e
        ORDER BY dt_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $token = bin2hex(random_bytes('10'));
        $valor = $item['cd_promocao']>0?$item['vl_promocao']:$item['vl_venda'];
        
        $data = [
            'cd_evento' => $item['cd_evento'],
            'ds_ingresso' => "Ingresso do Evento: ".$item['ds_evento'],
            'nr_lote' => $token,
            'vl_venda' => $valor
        ];

        $insert = montaInsert($data,['cd_evento','vl_venda']);
        $sql = "INSERT INTO ingresso ({$insert['colunas']}) VALUES ({$insert['valores']})";
        mysqli_query($conexao, $sql);

    } 


?>