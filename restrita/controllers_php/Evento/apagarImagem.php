<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data = [
        "ft_caminho" => null
    ];
           
    unlink("../../../".$obj['ft_caminho']);

    $id = $obj['cd_evento'];
    
    $update = montaUpdate($data);
    $sql = "UPDATE evento SET {$update} WHERE cd_evento = {$id}";
    $query = mysqli_query($conexao, $sql);
   
    echo $query;

?>