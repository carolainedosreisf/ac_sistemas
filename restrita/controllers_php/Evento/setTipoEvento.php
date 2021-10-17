<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data = [
        "ds_evento" => $obj['ds_evento']
    ];

    $id = isset($obj['cd_tipoevento'])?$obj['cd_tipoevento']:0;

    if($id){
        $update = montaUpdate($data);
        $sql = "UPDATE tipoevento SET {$update} WHERE cd_tipoevento = {$id}";
        $query = mysqli_query($conexao, $sql);
        
    }else{
        $insert = montaInsert($data);
        $sql = "INSERT INTO tipoevento ({$insert['colunas']}) VALUES ({$insert['valores']})";
        $query = mysqli_query($conexao, $sql);
    }
    
    echo $query;

?>