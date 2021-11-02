<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    unlink("../../../".$obj['ft_caminho']);

    $id = $obj['cd_album'];
    $sql = "DELETE FROM album WHERE cd_album = {$id}";
    $query = mysqli_query($conexao, $sql);
   
    echo $query;

?>