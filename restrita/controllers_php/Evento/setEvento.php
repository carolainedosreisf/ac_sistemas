<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data = [
        "cd_cidade" => $obj['cd_cidade'],
        "cd_promocao" => isset($obj['cd_promocao'])?$obj['cd_promocao']:null,
        "vl_promocao" => isset($obj['vl_promocao'])?$obj['vl_promocao']:null,
        "ds_evento" => $obj['ds_evento'],
        "ds_local" => $obj['ds_local'],
        "dt_evento" => formataData($obj['dt_evento'],1),
        "vl_venda" => $obj['vl_venda'],
        "nr_classifi" => $obj['nr_classifi'],
        "cd_tipoevento" => $obj['cd_tipoevento']
    ];

    $id = isset($obj['cd_evento'])?$obj['cd_evento']:0;
    $semAspa = ['cd_cidade','cd_promocao','nr_classifi','cd_tipoevento'];
    if($id){
        $update = montaUpdate($data,$semAspa);
        $sql = "UPDATE evento SET {$update} WHERE cd_evento = {$id}";
        $query = mysqli_query($conexao, $sql);

    }else{
        $insert = montaInsert($data,$semAspa);
        $sql = "INSERT INTO evento ({$insert['colunas']}) VALUES ({$insert['valores']})";
        $query = mysqli_query($conexao, $sql);
    }
    
    echo $query;

?>