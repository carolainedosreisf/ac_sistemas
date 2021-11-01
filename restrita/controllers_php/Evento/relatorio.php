<?php
    require '../../conexao.php';
   
    $sql = "SELECT 
                cd_evento
                ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                ,ds_evento
                ,DATE_FORMAT(dt_evento, '%d/%m/%Y') AS dt_evento_br
                ,DATE_FORMAT(hr_evento, '%H:%i') AS hr_evento
                ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                ,IFNULL((SELECT ds_promossao FROM promocao AS c WHERE c.cd_promossao = e.cd_promocao),'') AS nome_promocao

                ,IFNULL(sn_cancelado,'N') AS sn_cancelado
                ,nr_lotacao
                ,IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_ingresso = (SELECT cd_ingresso 
                                                            FROM ingresso AS i 
                                                            WHERE i.cd_evento = e.cd_evento))
                        ,0) AS qtd_vendas
            FROM evento AS e
            ORDER BY cd_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $i = 0;

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $cd_evento = $item['cd_evento'];
        $sql_clientes = "SELECT 
                c.nm_cadastro
                ,c.sexo
                ,DATE_FORMAT(c.dt_nascto, '%d/%m/%Y') AS dt_nascto
                ,(SELECT nm_cidade FROM cidade AS b WHERE c.cd_cidade = b.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS b WHERE c.cd_cidade = b.cd_cidade) AS uf_cidade
                ,c.ed_email
                ,c.nr_telefone
                ,c.nr_contato
                ,item.qt_compra
                ,item.vl_compra
                ,(SELECT DATE_FORMAT(dt_compra, '%d/%m/%Y %H:%i') FROM compra AS i WHERE i.cd_compra = item.cd_compra) AS dt_compra_br
            FROM comprait AS item
            INNER JOIN cadastro AS c ON c.cd_cadastro = (SELECT cd_cadastro FROM compra AS i WHERE i.cd_compra = item.cd_compra)
            WHERE (SELECT cd_evento FROM ingresso AS i WHERE i.cd_ingresso = item.cd_ingresso) = {$cd_evento}
            ORDER BY (SELECT dt_compra FROM compra AS i WHERE i.cd_compra = item.cd_compra) DESC";

        $lista[$i] = $item;

        $query_clientes = mysqli_query($conexao, $sql_clientes);
        $qtd = 0;
        $valor = 0;
        $lista[$i]['clientes'] = [];
        while($item_clientes = mysqli_fetch_array($query_clientes, MYSQLI_ASSOC)){
            $lista[$i]['clientes'][] = $item_clientes;
            $qtd += $item_clientes['qt_compra'];
            $valor += $item_clientes['qt_compra'] * $item_clientes['vl_compra'];
        } 

        $lista[$i]['qtd'] = $qtd;
        $lista[$i]['valor'] = $valor;
        $i++;
    } 

    echo json_encode($lista);
?>
