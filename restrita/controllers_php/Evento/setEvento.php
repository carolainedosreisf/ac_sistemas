<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();
    $obj['hr_evento'] = str_replace(":","",$obj['hr_evento']);
    $hr = substr($obj['hr_evento'],0,2);
    $min = substr($obj['hr_evento'],2,2);

    $data = [
        "cd_cidade" => $obj['cd_cidade'],
        "cd_promocao" => isset($obj['cd_promocao'])?$obj['cd_promocao']:null,
        "vl_promocao" => isset($obj['vl_promocao'])?$obj['vl_promocao']:null,
        "ds_evento" => $obj['ds_evento'],
        "ds_local" => $obj['ds_local'],
        "dt_evento" => formataData($obj['dt_evento'],1),
        "vl_venda" => $obj['vl_venda'],
        "hr_evento" => ($hr.":".$min.":00"),
        "nr_classifi" => isset($obj['nr_classifi'])?$obj['nr_classifi']:null,
        "cd_tipoevento" => $obj['cd_tipoevento'],
        "nr_lotacao" => $obj['nr_lotacao'],
        "publica" => $obj['publica'],
    ];

    if($obj['publica']=='S'){
        $data['dt_publica'] =  date("Y-m-d H:i:s");
    }

    if(isset($obj['ft_caminho_novo'])){
        if($obj['ft_caminho_novo']){
            $data['ft_caminho'] = $obj['ft_caminho_novo'];

            if(isset($obj['ft_caminho'])){
                if($obj['ft_caminho']){
                    unlink("../../../".$obj['ft_caminho']);
                }
            }
        }
    }

    $id = isset($obj['cd_evento'])?$obj['cd_evento']:0;
    $semAspa = ['cd_cidade','cd_promocao','nr_classifi','cd_tipoevento','nr_lotacao'];
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