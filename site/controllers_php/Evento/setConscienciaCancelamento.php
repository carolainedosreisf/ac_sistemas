<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $dados = getPostAngular();
    $cd_cadastro = $dados['cd_cadastro'];
    $cd_evento = $dados['cd_evento'];
  

    $data = [
        "sn_cancelado" => 'S'
    ];

    $update = montaUpdate($data);
    $sql = "UPDATE comprait SET {$update} WHERE (SELECT cd_cadastro FROM compra AS c WHERE c.cd_compra = comprait.cd_compra) = {$cd_cadastro} AND cd_evento = {$cd_evento}";
    $query = mysqli_query($conexao, $sql);

    echo $query;
?>