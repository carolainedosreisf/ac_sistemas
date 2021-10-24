<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data = [
        "ds_fpagto" => $obj['ds_fpagto'],
        "qt_parcela" => isset($obj['qt_parcela'])?$obj['qt_parcela']:null,
        "vl_min" => isset($obj['vl_min'])?$obj['vl_min']:null
    ];

    $id = isset($obj['cd_fpagto'])?$obj['cd_fpagto']:0;
    $semAspas = ['qt_parcela','vl_min'];
    if($id){
        $update = montaUpdate($data,$semAspas);
        $sql = "UPDATE fpagamento SET {$update} WHERE cd_fpagto = {$id}";
        $query = mysqli_query($conexao, $sql);
        
    }else{
        $insert = montaInsert($data,$semAspas);
        $sql = "INSERT INTO fpagamento ({$insert['colunas']}) VALUES ({$insert['valores']})";
        $query = mysqli_query($conexao, $sql);
    }
    
    echo $query;

?>