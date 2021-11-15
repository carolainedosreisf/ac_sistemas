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
                ,count(*) AS qt_compra
                ,SUM(item.vl_compra) AS vl_compra
                ,(SELECT DATE_FORMAT(CONCAT(dt_compra,' ',hr_compra), '%d/%m/%Y %H:%i') FROM compra AS i WHERE i.cd_compra = item.cd_compra) AS dt_compra_br
                ,sum(item.vl_compra) AS vl_reembolso
                ,IFNULL(item.sn_cancelado,'N') AS consciencia_cancelamento
            FROM comprait AS item
            INNER JOIN cadastro AS c ON c.cd_cadastro = (SELECT cd_cadastro FROM compra AS i WHERE i.cd_compra = item.cd_compra)
            WHERE item.cd_evento = {$id}
            GROUP BY c.nm_cadastro,c.sexo,c.dt_nascto,c.cd_cidade,c.ed_email,c.nr_telefone,c.nr_contato,item.vl_compra,sn_cancelado,item.cd_evento,c.cd_cadastro
            ORDER BY item.cd_compra DESC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $qtd = 0;
    $valor = 0;
    $i = 0;

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[$i] = $item;
        $qtd += $item['qt_compra'];
        $valor += $item['vl_compra'];

        $lista[$i]['nr_telefone'] = formatar_telefone($item['nr_telefone']);
        $lista[$i]['nr_contato'] = formatar_telefone($item['nr_contato']);

        $lista[$i]['br_email'] = $item['nr_telefone'] || $item['nr_contato']?1:0;
        $lista[$i]['br_contato'] = $item['nr_telefone']?1:0;

        $i++;
    } 
    
    echo json_encode(['lista'=>$lista,'qtd'=>$qtd,'valor'=>$valor]);

?>