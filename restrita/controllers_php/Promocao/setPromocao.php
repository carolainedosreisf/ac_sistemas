<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();
    $dt_prazoini = null;
    $dt_prazofim = null;

    if(isset($obj['dt_prazoini'])){
        if($obj['dt_prazoini']){
            $dt_prazoini = formataData($obj['dt_prazoini'],1);
        }
    }

    if(isset($obj['dt_prazofim'])){
        if($obj['dt_prazofim']){
            $dt_prazofim = formataData($obj['dt_prazofim'],1);
        }
    }

    $data = [
        "ds_promossao" => $obj['ds_promossao'],
        "vl_promossao" => $obj['vl_promossao'],
        "dt_prazoini" => $dt_prazoini,
        "dt_prazofim" => $dt_prazofim
    ];

    $id = isset($obj['cd_promossao'])?$obj['cd_promossao']:0;
    $semAspa = ['vl_promossao'];

    if($id){
        $update = montaUpdate($data,$semAspa);
        $sql = "UPDATE promocao SET {$update} WHERE cd_promossao = {$id}";
        $query = mysqli_query($conexao, $sql);
        
    }else{
        $insert = montaInsert($data,$semAspa);
        $sql = "INSERT INTO promocao ({$insert['colunas']}) VALUES ({$insert['valores']})";
        $query = mysqli_query($conexao, $sql);
    }
    
    echo $query;

?>