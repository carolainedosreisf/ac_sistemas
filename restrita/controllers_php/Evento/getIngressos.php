<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $cd_evento = base64_decode($_GET['id']);
    $sql = "SELECT item.cd_compra
                ,i.cd_evento
                ,i.cd_ingresso
                ,(SELECT nm_cadastro FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS nm_cadastro
                ,(SELECT ed_email FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS ed_email
                ,(SELECT nr_cpf FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS nr_cpf
                ,IFNULL(i.sn_presenca,0) AS sn_presenca
            FROM comprait AS item
            INNER JOIN compra AS c ON c.cd_compra = item.cd_compra
            INNER JOIN ingresso AS i ON i.cd_evento = item.cd_evento AND i.cd_ingresso = item.cd_ingresso
            WHERE item.cd_evento = {$cd_evento}";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $i = 0;

    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[$i] = $item;
        $lista[$i]['nr_cpf'] = formatar_cpf_cnpj($item['nr_cpf']);
        $i++;
    } 
    

    echo json_encode($lista);

?>