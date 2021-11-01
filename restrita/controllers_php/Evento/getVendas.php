<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $id = base64_decode($_GET['id']);
   
    $sql = "SELECT 
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
            WHERE (SELECT cd_evento FROM ingresso AS i WHERE i.cd_ingresso = item.cd_ingresso) = {$id}
            ORDER BY (SELECT dt_compra FROM compra AS i WHERE i.cd_compra = item.cd_compra) DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $qtd = 0;
    $valor = 0;
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
        $qtd += $item['qt_compra'];
        $valor += $item['qt_compra'] * $item['vl_compra'];
    } 
    
    echo json_encode(['lista'=>$lista,'qtd'=>$qtd,'valor'=>$valor]);

?>