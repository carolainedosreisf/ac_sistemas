<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $cd_evento = base64_decode($_GET['id']);
    $sql = "SELECT i.cd_compra
                ,i.cd_evento
                ,i.seq
                ,i.nr_lote
                ,(SELECT nm_cadastro FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS nm_cadastro
                ,(SELECT ed_email FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS ed_email
                ,(SELECT nr_cpf FROM cadastro AS ca WHERE ca.cd_cadastro = c.cd_cadastro) AS nr_cpf
                ,IFNULL(i.check_presenca,0) AS check_presenca
            FROM ingresso AS i
            INNER JOIN compra AS c ON c.cd_compra = i.cd_compra
            WHERE cd_evento = {$cd_evento}";

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